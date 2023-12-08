<?php
namespace Webkul\RestApi\Http;

use Illuminate\Support\Facades\DB;
use Webkul\Attribute\Models\Attribute;
use Webkul\Attribute\Models\AttributeOption;
use Webkul\Product\Contracts\Product;
use Webkul\Product\Models\ProductAttributeValue;
use stdClass;

class PreloadedProductAttributesStorage
{
    protected static $loadedAttributeValues = [];

    protected static $productAttributesMapper = [];

    protected static $attributesOptionsMapper = [];

    public static function preload(array $items, array $attributes = [])
    {
        if(!$items) return;
        if(!static::$productAttributesMapper) {
            $item = current($items);
            if(!$item->getTable()) return;
            $table = $item->getTable();
            $productTableAttributes = DB::getSchemaBuilder()->getColumnListing($table);

            foreach (DB::table(static::getProductAttributeTable(), 'pr_at_val')
                ->join('attributes', function ($join) {
                    $join->on('attributes.id', '=', 'pr_at_val.attribute_id');
                })
                ->groupBy('pr_at_val.attribute_id', 'attributes.code')
                ->get(['code']) as $attributeData) {
                $productAttributes[] = $attributeData->code;
            }

            if(!$attributes || $attributes === ['*']) {
                static::$productAttributesMapper = $productAttributes;
            } else {
                static::$productAttributesMapper = array_filter(
                    $productAttributes,
                    fn($attributeCode) => in_array($attributeCode, $attributes)
                );
            }

            static::$productAttributesMapper = array_filter(
                static::$productAttributesMapper,
                fn($attributeCode) => !in_array($attributeCode, $productTableAttributes)
            );
        }

        $productIds = array_map(fn($product) => $product->id, $items);
        static::preloadAttributesValues($productIds);
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

    protected static function preloadAttributesValues(array $productIds)
    {
        $productIds = array_filter($productIds, fn($id) => !in_array($id, static::$loadedAttributeValues));

        if(!static::$productAttributesMapper || !$productIds) return;

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

        static::preloadAttributesOptions($aggregatedAttributesMapType);

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
                $result[$item->product_id][$attributeCode] =
                    static::caclulateAttributeValue($attributeObj, $item, $aggregatedAttributesMapType);
            }

            foreach ($batchCollection['defaultValues'] as $item) {
                $attributeCode = $aggregatedAttributesMapType[$item->attribute_id]['code'];
                if(is_null($result[$item->product_id][$attributeCode])) {
                    $result[$item->product_id][$attributeCode] =
                        static::caclulateAttributeValue($attributeObj, $item, $aggregatedAttributesMapType);
                }
            }
        }

        return self::$loadedAttributeValues = $result;
    }

    protected static function caclulateAttributeValue(Attribute $attributeObj, stdClass $item, array $aggregatedAttributesMapType)
    {
        $attributeCode = $aggregatedAttributesMapType[$item->attribute_id]['code'];
        $attributeType = $aggregatedAttributesMapType[$item->attribute_id]['type'];
        $attributeColumnType = $attributeObj->attributeTypeFields[$attributeType];

        $value = $item->{$attributeColumnType};

        return static::$attributesOptionsMapper['options'][$attributeCode][$value] ??
            static::$attributesOptionsMapper['optionsDefault'][$attributeCode][$value] ?? $value;
    }

    protected static function preloadAttributesOptions(array $attributeIds)
    {
        $locale = core()->checkRequestedLocaleCodeInRequestedChannel();
        $defaultLocale = core()->getDefaultChannelLocaleCode();

        foreach (DB::table(static::getAttributeOptionTable(), 'attr_option')
                     ->whereIn('attribute_id', array_keys($attributeIds))
                     ->join('attribute_option_translations', function($join) use($locale) {
                            $join->on('attr_option.id', '=', 'attribute_option_translations.attribute_option_id')
                                    ->on('attribute_option_translations.locale', '=', DB::raw(DB::escape($locale)));
                     })
                     ->get([
                         'attribute_option_translations.locale',
                         'attribute_option_translations.label',
                         'attr_option.id',
                         'attr_option.attribute_id',
                         'attr_option.admin_name',
                         'attr_option.swatch_value',
                     ]) as $option
        ) {
            static::$attributesOptionsMapper['options'][$attributeIds[$option->attribute_id]['code']][$option->id] = $option;
        }

        if($locale != $defaultLocale) {
            foreach (DB::table(static::getAttributeOptionTable(), 'attr_option')
                         ->whereIn('attribute_id', array_keys($attributeIds))
                         ->join('attribute_option_translations', function($join) use ($defaultLocale) {
                             $join->on('attr_option.id', '=', 'attribute_option_translations.attribute_option_id')
                                 ->on('attribute_option_translations.locale', '=', DB::raw(DB::escape($defaultLocale)));

                         })
                         ->get([
                             'attribute_option_translations.locale',
                             'attribute_option_translations.label',
                             'attr_option.id',
                             'attr_option.attribute_id',
                             'attr_option.admin_name',
                             'attr_option.swatch_value',
                         ]) as $option
            ) {
                static::$attributesOptionsMapper['optionsDefault'][$attributeIds[$option->attribute_id]['code']][$option->id] = $option;
            }
        }
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

    protected static function getAttributeOptionTable()
    {
        return (new AttributeOption)->getTable();
    }
}
