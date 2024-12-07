<?php

namespace Webkul\RestApi\Model;

/**
 *
 */
interface GetterOrdersFullDataInterface
{
    /**
     * @param array $orderMapIds
     * @param string $sourceType
     * @return array
     */
    public static function get(array $orderMapIds, string $sourceType): array;
}
