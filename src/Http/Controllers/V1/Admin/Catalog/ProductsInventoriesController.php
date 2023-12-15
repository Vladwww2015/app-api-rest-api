<?php

namespace Webkul\RestApi\Http\Controllers\V1\Admin\Catalog;

use Webkul\Product\Repositories\ProductInventoryRepository;

use Webkul\RestApi\Http\Controllers\V1\Admin\AdminController;
use Webkul\RestApi\Http\Resources\V1\Admin\Catalog\ProductsInventoriesResource;

class ProductsInventoriesController extends AdminController
{
    /**
     * Repository class name.
     *
     * @return string
     */
    public function repository()
    {
        return ProductInventoryRepository::class;
    }

    /**
     * Resource class name.
     *
     * @return string
     */
    public function resource()
    {
        return ProductsInventoriesResource::class;
    }
}
