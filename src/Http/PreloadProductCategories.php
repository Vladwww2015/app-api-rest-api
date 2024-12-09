<?php

namespace Webkul\RestApi\Http;

use Illuminate\Support\Facades\DB;
use Webkul\Category\Models\Category;

class PreloadProductCategories extends PreloadProduct
{
    protected static $categoryMap = [];

    public static function preload(array $items = null, array $productIds = [])
    {
        parent::preload($items, $productIds);
        $categoryIds = array_map(fn($item) => $item['category_id'], $items);

        static::preloadCategoryCodeMap($categoryIds);
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

    protected static function getCategoryTable()
    {
        return (new Category)->getTable();
    }
}
