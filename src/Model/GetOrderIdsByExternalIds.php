<?php

namespace Webkul\RestApi\Model;

class GetOrderIdsByExternalIds
{
    /**
     * @var array
     */
    private static $getterOrderIdsByExternalIds = [];

    /**
     * @param string $getterOrderIdsByExternalIds
     * @param string $sourceType
     * @return void
     * @throws \Exception
     */
    public static function addGetter(string $getterOrderIdsByExternalIds, string $sourceType)
    {
        if(!is_subclass_of($getterOrderIdsByExternalIds, GetterOrderIdsByExternalIdsInterface::class)) {
            throw new \Exception(sprintf('BV Order Getter must be implement %s', GetterOrderIdsByExternalIdsInterface::class));
        }

        if(array_key_exists($sourceType, static::$getterOrderIdsByExternalIds)) throw new \Exception('Getter Order Ids was set, please check and fix it');

        static::$getterOrderIdsByExternalIds[$sourceType] = $getterOrderIdsByExternalIds;
    }

    /**
     * @param array $externalIds
     * @param string $sourceType
     * @return array
     */
    public static function get(array $externalIds, string $sourceType): array
    {
        return static::$getterOrderIdsByExternalIds[$sourceType]::get($externalIds, $sourceType);
    }
}
