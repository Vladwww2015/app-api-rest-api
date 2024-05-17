<?php

namespace Webkul\RestApi\Model;

class GetProductReadyToApiFlags
{
    /**
     * @var array
     */
    private static $flags = [];

    /**
     * @param string $flag
     * @return void
     */
    public static function add(string $flag)
    {
        static::$flags[$flag] = $flag;
    }

    /**
     * @return array
     */
    public static function get(): array
    {
        return static::$flags;
    }
}
