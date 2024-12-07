<?php

namespace Webkul\RestApi\Http;

use Illuminate\Support\Facades\DB;
use Webkul\Customer\Models\CustomerGroup;

class PreloadCustomerGroup
{
    protected static $customerGroups = [];

    public static function preload()
    {
        foreach (
            DB::table(static::getTable())
                ->get(['id', 'code', 'name']) as $item) {
            static::$customerGroups[$item->id] = [
                'code' => $item->code,
                'name' => $item->name,
            ];
        }
    }

    public static function getCodeById(int $id)
    {
        return static::$customerGroups[$id]['code'] ?? '';
    }
    
    public static function getNameById(int $id)
    {
        return static::$customerGroups[$id]['name'] ?? '';
    }


    protected static function getTable()
    {
        return (new CustomerGroup)->getTable();
    }
}
