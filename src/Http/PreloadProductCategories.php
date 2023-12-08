<?php

namespace Webkul\RestApi\Http;

use Illuminate\Support\Facades\DB;
use Webkul\Category\Models\Category;
use Webkul\Product\Models\Product;

class PreloadProductCategories
{
    protected static $categoryMap = [];
    protected static $productMap = [];
    
    public static function preload(array $items, string $table)
    {
        $productIds = array_map(fn($item) => $item['product_id'], $items);
        $categoryIds = array_map(fn($item) => $item['category_id'], $items);

        static::preloadCategoryCodeMap($categoryIds);
        static::preloadProductSkuMap($productIds);
    }
    
    public static function getSkuByProductId(int $productId)
    {
        return static::$productMap[$productId] ?? '';
    }
    
    public static function getCodeByCategoryId(int $categoryId)
    {
        return static::$categoryMap[$categoryId] ?? '';
    }

    protected static function preloadCategoryCodeMap(array $categoryIds)
    {
        foreach (
            DB::table(static::getCategoryTable())
             ->whereIn('id', array_unique($categoryIds))
             ->get(['id', 'code']) as $item) {
            static::$categoryMap[$item->id] = $item->code;
        }
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

    protected static function getCategoryTable()
    {
        return (new Category)->getTable();
    }

    protected static function getProductTable()
    {
        return (new Product)->getTable();
    }
}
