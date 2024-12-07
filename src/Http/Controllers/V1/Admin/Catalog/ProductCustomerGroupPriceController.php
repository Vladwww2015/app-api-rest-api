<?php

namespace Webkul\RestApi\Http\Controllers\V1\Admin\Catalog;

use Webkul\Product\Repositories\ProductCustomerGroupPriceRepository;
use Webkul\RestApi\Http\Resources\V1\Admin\Catalog\ProductCustomerGroupPriceResource;

class ProductCustomerGroupPriceController extends CatalogController
{
    /**
     * Repository class name.
     *
     * @return string
     */
    public function repository()
    {
        return ProductCustomerGroupPriceRepository::class;
    }

    public function getRepositoryInstance()
    {
        return app($this->repository());
    }

    /**
     * Resource class name.
     *
     * @return string
     */
    public function resource()
    {
        return ProductCustomerGroupPriceResource::class;
    }

    public function getCountTotal()
    {
        return ['count_total' => $this->getRepositoryInstance()->count()];
    }
}
