<?php

namespace Webkul\RestApi\Model;

class GetOrdersFullData
{
    /**
     * @var array
     */
    private static $getters = [];

    /**
     * @param string $getterOrderIdsByExternalIds
     * @param string $sourceType
     * @return void
     * @throws \Exception
     */
    public static function addGetter(string $getter, string $sourceType)
    {
        if(!is_subclass_of($getter, GetterOrdersFullDataInterface::class)) {
            throw new \Exception(sprintf('BV Order Getter Full Data must be implement %s', GetterOrdersFullDataInterface::class));
        }

        if(array_key_exists($sourceType, static::$getters)) throw new \Exception('Getter Order Full Data was set, please check and fix it');

        static::$getters[$sourceType] = $getter;
    }

    /**
     * @param array $externalIds
     * @param string $sourceType
     * @return array
     */
    public static function get(array $externalIds, string $sourceType): array
    {
        return static::$getters[$sourceType]::get($externalIds, $sourceType);
    }
}
