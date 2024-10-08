<?php

use Illuminate\Support\Facades\Route;
use Webkul\RestApi\Http\Controllers\V1\Admin\Order\OrderController;

Route::group(
    [
        'middleware' => ['auth:sanctum', 'sanctum.admin'],
        'prefix'     => 'order',
    ], function () {

    Route::post('create', [OrderController::class, 'createOrder']);

    Route::get('get-order-ids', [OrderController::class, 'getOrderIdsByExternalIds']);

    Route::get('get-bv-integration-source-types', [OrderController::class, 'getBvIntegrationSourceTypes']);


    Route::post('get-orders-full-data', [OrderController::class, 'getOrdersFullData']);
});
