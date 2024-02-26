<?php

namespace Webkul\RestApi\Model;

interface BvOrderCreatorInterface
{
    public static function create(array $data): int;
}
