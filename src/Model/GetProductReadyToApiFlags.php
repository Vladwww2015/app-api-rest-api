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
    public static function add(string $flag, string $label)
    {
        static::$flags[$flag] = $label;
    }

    /**
     * @return array
     */
    public static function get(): array
    {
        return static::$flags;
    }
}
