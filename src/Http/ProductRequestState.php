<?php

namespace Webkul\RestApi\Http;

class ProductRequestState
{
    protected static $columns = [];
    
    protected static $withAttributesFlag = false;
    
    public static function changeWithAttributes(bool $flag)
    {
        static::$withAttributesFlag = $flag;
    }
    
    public static function changeResponseColumns(array $columns)
    {
        static::$columns = $columns;
    }
    
    public static function getResponseColumns()
    {
        return static::$columns;
    }
    
    public static function checkWithAttributes(): bool
    {
        return static::$withAttributesFlag;
    }
}