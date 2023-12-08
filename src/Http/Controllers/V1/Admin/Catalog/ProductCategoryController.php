<?php

namespace Webkul\RestApi\Http\Controllers\V1\Admin\Catalog;

use Webkul\Product\Repositories\ProductCategoryRepository;
use Webkul\RestApi\Http\Resources\V1\Admin\Catalog\ProductCategoryResource;

class ProductCategoryController extends CatalogController
{
    /**
     * Repository class name.
     *
     * @return string
     */
    public function repository()
    {
        return ProductCategoryRepository::class;
    }

    /**
     * Resource class name.
     *
     * @return string
     */
    public function resource()
    {
        return ProductCategoryResource::class;
    }
}
