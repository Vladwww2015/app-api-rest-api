<?php
namespace Webkul\RestApi\Model;

class CreateOrderInBv
{
    /**
     * @var array
     */
    private static $bvOrderCreator = [];

    /**
     * @param string $bvOrderCreator
     * @param string $sourceCode
     * @return void
     * @throws \Exception
     */
    public static function addBvOrderCreator(string $bvOrderCreator, string $sourceType)
    {
        if(!is_subclass_of($bvOrderCreator, BvOrderCreatorInterface::class)) {
            throw new \Exception(sprintf('BV Order Creator must be implement %s', BvOrderCreatorInterface::class));
        }

        if(array_key_exists($sourceType, static::$bvOrderCreator)) {
            throw new \Exception(sprintf('BV Order Creator with %s source code has already been installed, please check and fix the duplication!', $sourceType));
        }

        static::$bvOrderCreator[$sourceType] = $bvOrderCreator;
    }

    /**
     * @param array $data
     * @param string $sourceType
     * @return int
     */
    public static function create(array $data, string $sourceType): int
    {
        return static::$bvOrderCreator[$sourceType]::create($data, $sourceType);
    }
}
