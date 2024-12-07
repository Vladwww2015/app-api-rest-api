<?php

namespace Webkul\RestApi\Http;

use Illuminate\Support\Facades\DB;
use Webkul\Inventory\Models\InventorySource;

class PreloadInventorySource
{
    protected static $inventorySources = [];

    public static function preload()
    {
        foreach (
            DB::table(static::getTable())
                ->get(['id', 'code']) as $item) {
            static::$inventorySources[$item->id] = $item->code;
        }
    }

    public static function getCodeById(int $id)
    {
        return static::$inventorySources[$id] ?? '';
    }


    protected static function getTable()
    {
        return (new InventorySource)->getTable();
    }
}
