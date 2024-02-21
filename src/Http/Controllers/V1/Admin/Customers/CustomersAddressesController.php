<?php

namespace Webkul\RestApi\Http\Controllers\V1\Admin\Customers;

use Webkul\Customer\Repositories\CustomerAddressRepository;
use Webkul\RestApi\Http\Resources\V1\Admin\Customer\CustomerAddressResource;

class CustomersAddressesController extends BaseController
{
    /**
     * Repository class name.
     *
     * @return string
     */
    public function repository()
    {
        return CustomerAddressRepository::class;
    }

    /**
     * Resource class name.
     *
     * @return string
     */
    public function resource()
    {
        return CustomerAddressResource::class;
    }
}
