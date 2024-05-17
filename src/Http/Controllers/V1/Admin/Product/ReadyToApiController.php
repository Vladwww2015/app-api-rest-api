<?php

namespace Webkul\RestApi\Http\Controllers\V1\Admin\Product;

use Webkul\RestApi\Model\GetProductReadyToApiFlags;
use Webkul\RestApi\Http\Controllers\V1\Admin\AdminController;

class ReadyToApiController extends AdminController
{

    /**
     * @return array
     */
    public function getFlags()
    {
        return GetProductReadyToApiFlags::get();
    }
}
