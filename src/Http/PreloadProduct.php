<?php

namespace Webkul\RestApi\Http;

use Illuminate\Support\Facades\DB;
use Webkul\Product\Models\Product;

class PreloadProduct
{
    protected static $productMap = [];

    public static function preload(array $items = null, array $productIds = [])
    {
        $productIds = $productIds ?: array_map(fn($item) => $item['product_id'], $items);

        if($productIds) static::preloadProductSkuMap($productIds);

    }

    public static function getSkuByProductId(int $productId)
    {
        return static::$productMap[$productId] ?? '';
    }

    protected static function preloadProductSkuMap(array $productIds)
    {
        foreach (
            DB::table(static::getProductTable())
                ->whereIn('id', array_unique($productIds))
                ->get(['id', 'sku']) as $item) {
            static::$productMap[$item->id] = $item->sku;
        }
    }

    protected static function getProductTable()
    {
        return (new Product)->getTable();
    }
}
