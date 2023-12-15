<?php

namespace Webkul\RestApi\Http\Controllers\V1\Admin\Customer;

use Webkul\Customer\Repositories\CustomerAddressRepository;
use Webkul\RestApi\Http\Controllers\V1\Admin\AdminController;
use Webkul\RestApi\Http\Resources\V1\Admin\Customer\CustomerAddressResource;

class CustomersAddressesController extends AdminController
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
