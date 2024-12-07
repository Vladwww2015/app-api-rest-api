<?php

namespace Webkul\RestApi\Http;

class ProductRequestState
{
    protected static $columns = [];

    /**
     * @var bool
     */
    protected static $withAttributesFlag = false;

    /**
     * @param bool $flag
     * @return void
     */
    public static function changeWithAttributes(bool $flag)
    {
        static::$withAttributesFlag = $flag;
    }

    /**
     * @param array $columns
     * @return void
     */
    public static function changeResponseColumns(array $columns)
    {
        static::$columns = $columns;
    }

    /**
     * @return array
     */
    public static function getResponseColumns()
    {
        return static::$columns;
    }

    /**
     * @return bool
     */
    public static function checkWithAttributes(): bool
    {
        return static::$withAttributesFlag;
    }
}
