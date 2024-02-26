<?php

namespace Webkul\RestApi\Model;

/**
 *
 */
interface GetterOrderIdsByExternalIdsInterface
{
    /**
     * @param array $externalIds
     * @param string $sourceType
     * @return array
     */
    public static function get(array $externalIds, string $sourceType): array;
}
