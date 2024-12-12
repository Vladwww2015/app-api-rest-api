<?php

namespace Webkul\RestApi\Http\Controllers\V1\Admin\Catalog;

use Webkul\Product\Models\ProductCustomerGroupPrice;
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
        if(core()->getProductSourceGroupPriceAlgorithm() === 'all') {
            return ['count_total' => $this->getRepositoryInstance()->count()];
        }

        /**
         * @var $model ProductCustomerGroupPrice
         */
        $model = $this->getRepositoryInstance()->getModel();
        $query = $model->query()->groupBy('product_id', 'customer_group_id');

        return ['count_total' => $query->count()];
    }
}
