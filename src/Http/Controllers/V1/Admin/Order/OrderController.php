<?php

namespace Webkul\RestApi\Http\Controllers\V1\Admin\Order;

use Illuminate\Http\Request;

use Webkul\RestApi\Http\Controllers\V1\Admin\AdminController;
use Webkul\RestApi\Model\CreateOrderInBv;
use Webkul\RestApi\Model\GetBvIntegrationSourceTypes;
use Webkul\RestApi\Model\GetOrderIdsByExternalIds;

class OrderController extends AdminController
{
    /**
     * @param Request $request
     * @return array
     */
    public function createOrder(Request $request)
    {
        try {
            $request->validate([
                'order' => 'required',
                'source_type' => 'required'
            ]);

            $data = $request->get('order');
            return ['order_number' => CreateOrderInBv::create($data ?? [], $request->get('source_type'))];
        } catch (\Throwable $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getOrderIdsByExternalIds(Request $request)
    {
        $request->validate([
            'order_ids' => 'required',
            'source_type' => 'required'
        ]);

        $orderIds = $request->input('order_ids', []);

        return GetOrderIdsByExternalIds::get($orderIds, $request->get('source_type'));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getBvIntegrationSourceTypes(Request $request)
    {
        return GetBvIntegrationSourceTypes::get();
    }
}
