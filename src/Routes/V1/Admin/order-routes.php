<?php

use Illuminate\Support\Facades\Route;
use Webkul\RestApi\Http\Controllers\V1\Admin\Order\OrderController;

Route::group(
    [
        'middleware' => ['auth:sanctum', 'sanctum.admin'],
        'prefix'     => 'order',
    ], function () {

    Route::post('create', [OrderController::class, 'createOrder']);

    Route::post('get-order-ids-by-external-ids', [OrderController::class, 'getOrderIdsByExternalIds']);

    Route::post('get-bv-integration-source-types', [OrderController::class, 'getBvIntegrationSourceTypes']);
});
