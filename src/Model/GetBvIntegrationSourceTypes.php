<?php

namespace Webkul\RestApi\Model;

class GetBvIntegrationSourceTypes
{
    /**
     * @var array
     */
    private static $bvIntegrationSourceTypes = [];

    /**
     * @param string $sourceType
     * @return void
     */
    public static function add(string $sourceType)
    {
        static::$bvIntegrationSourceTypes[$sourceType] = $sourceType;
    }

    /**
     * @return array
     */
    public static function get(): array
    {
        return static::$bvIntegrationSourceTypes;
    }
}
