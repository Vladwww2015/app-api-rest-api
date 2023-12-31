<?php

use Illuminate\Support\Facades\Route;
use Webkul\RestApi\Http\Controllers\V1\Admin\Order\OrderController;

Route::group(
    [
        'middleware' => ['auth:sanctum', 'sanctum.admin'],
        'prefix'     => 'order',
    ], function () {
        
    Route::post('create', [OrderController::class, 'createOrder']);
});
