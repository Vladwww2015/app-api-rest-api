<?php
namespace Webkul\RestApi\Http;

use Illuminate\Support\Facades\DB;
use Webkul\Attribute\Models\Attribute;
use Webkul\Product\Contracts\Product;
use Webkul\Product\Models\ProductAttributeValue;

class PreloadedProductAttributesStorage
{
    protected static $loadedAttributeValues = [];

    protected static $productAttributesMapper = [];

    public static function preload(array $items, array $attributes = [])
    {
        if(!static::$productAttributesMapper) {
            $item = current($items);
            if(!($item instanceof Product)) {
                return;
            }

            $productAttributes = array_keys($item->attributesToArray());
            if(!$attributes || $attributes === ['*']) {
                static::$productAttributesMapper = $productAttributes;
            } else {
                static::$productAttributesMapper = array_filter($productAttributes, fn($attributeCode) => in_array($attributeCode, $attributes));
            }
        }

        $productIds = array_map(fn($product) => $product->id, $items);
        static::preloadAttributes($productIds);
    }

    protected static function preloadAttributes(array $productIds)
    {
        $productIds = array_filter($productIds, fn($id) => !in_array($id, static::$loadedAttributeValues));

        if(!static::$productAttributesMapper || !$productIds) return;

        $locale = core()->checkRequestedLocaleCodeInRequestedChannel();
        $channel = core()->getRequestedChannelCode();
        $attributeObj = static::getAttributeObject();

        $attributesPerLocal = $attributesPerChannel = $attributesPerChannelAndLocal = [];

        $locale = core()->checkRequestedLocaleCodeInRequestedChannel();
        $channel = core()->getRequestedChannelCode();
        $defaultLocale = core()->getDefaultChannelLocaleCode();
        $defaultChannel = core()->getDefaultChannelCode();

        $attributes = DB::table(static::getAttributeTable())
            ->whereIn('code', static::$productAttributesMapper)
            ->get(['id', 'type', 'code', 'value_per_locale', 'value_per_channel']);

        $aggregatedAttributes = $aggregatedAttributesMapType = [];
        foreach ($attributes as $attribute) {
            $aggregatedAttributes[sprintf(
                '%s_%s',
                $attribute->value_per_locale,
                $attribute->value_per_channel
            )][] = $attribute->id;

            $aggregatedAttributesMapType[$attribute->id] = [
                'type' => $attribute->type,
                'code' => $attribute->code
            ];
        }

        $batchData = [];

        foreach ($aggregatedAttributes as $keyData => $attributes) {
            [$isLocale, $isChannel] = explode('_', $keyData);
            $attributeValues = $defaultAttributeValues = [];
            if($isLocale && $isChannel) {
                $attributeValues = DB::table(static::getProductAttributeTable())
                    ->where('channel', '=', $channel)
                    ->where('locale', '=', $locale)
                    ->whereIn('product_id', $productIds)
                    ->whereIn('attribute_id', $attributes)
                    ->get();

                if(
                    $channel != $defaultChannel &&
                    $locale != $defaultChannel
                ) {
                    $defaultAttributeValues = DB::table(static::getProductAttributeTable())
                        ->where('locale', '=', $defaultLocale)
                        ->where('channel', '=', $defaultChannel)
                        ->whereIn('product_id', $productIds)
                        ->whereIn('attribute_id', $attributes)
                        ->get();
                }
            } else if($isChannel) {
                $attributeValues = DB::table(static::getProductAttributeTable())
                    ->where('channel', '=', $channel)
                    ->whereIn('product_id', $productIds)
                    ->whereIn('attribute_id', $attributes)
                    ->get();

                if($channel != $defaultChannel) {
                    $defaultAttributeValues = DB::table(static::getProductAttributeTable())
                        ->where('channel', '=', $defaultChannel)
                        ->whereIn('product_id', $productIds)
                        ->whereIn('attribute_id', $attributes)
                        ->get();
                }
            } else if($isLocale) {
                $attributeValues = DB::table(static::getProductAttributeTable())
                    ->where('locale', '=', $locale)
                    ->whereIn('product_id', $productIds)
                    ->whereIn('attribute_id', $attributes)
                    ->get();

                if($locale != $defaultLocale) {
                    $defaultAttributeValues = DB::table(static::getProductAttributeTable())
                        ->where('locale', '=', $defaultLocale)
                        ->whereIn('product_id', $productIds)
                        ->whereIn('attribute_id', $attributes)
                        ->get();
                }
            } else {
                $attributeValues = DB::table(static::getProductAttributeTable())
                    ->whereIn('product_id', $productIds)
                    ->whereIn('attribute_id', $attributes)
                    ->get();
            }

            $batchData[] = [
                'values' => $attributeValues,
                'defaultValues' => $defaultAttributeValues
            ];
        }

        $result = [];
        foreach ($batchData as $batchCollection) {
            foreach ($batchCollection['values'] as $item) {
                $attributeCode = $aggregatedAttributesMapType[$item->attribute_id]['code'];
                $attributeType = $aggregatedAttributesMapType[$item->attribute_id]['type'];
                $attributeColumnType = $attributeObj->attributeTypeFields[$attributeType];
                $result[$item->product_id][$attributeCode] = $item->{$attributeColumnType};
            }

            foreach ($batchCollection['defaultValues'] as $item) {
                if(is_null($result[$item->product_id][$attributeCode])) {
                    $attributeCode = $aggregatedAttributesMapType[$item->attribute_id]['code'];
                    $attributeType = $aggregatedAttributesMapType[$item->attribute_id]['type'];
                    $attributeColumnType = $attributeObj->attributeTypeFields[$attributeType];

                    $result[$item->product_id][$attributeCode] = $item->{$attributeColumnType};
                }
            }
        }


        return self::$loadedAttributeValues = $result;
    }

    public static function getAttributeValues($productId)
    {
        return array_merge(
            array_fill_keys(static::$productAttributesMapper, null),
                self::$loadedAttributeValues[$productId] ?? []
        );
    }

    public static function getAttributeValue($productId, string $attributeCode)
    {
        return self::$loadedAttributeValues[$productId][$attributeCode] ?? null;
    }


    protected static function getProductAttributeTable()
    {
        return (new ProductAttributeValue)->getTable();
    }

    protected static function getAttributeTable()
    {
        return static::getAttributeObject()->getTable();
    }

    protected static function getAttributeObject()
    {
        return (new Attribute);
    }
}
