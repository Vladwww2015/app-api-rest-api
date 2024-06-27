<?php

use Illuminate\Support\Facades\Route;
use Webkul\RestApi\Http\Controllers\V1\Admin\Catalog\AttributeController;
use Webkul\RestApi\Http\Controllers\V1\Admin\Catalog\AttributeFamilyController;
use Webkul\RestApi\Http\Controllers\V1\Admin\Catalog\CategoryController;
use Webkul\RestApi\Http\Controllers\V1\Admin\Catalog\ProductController;
use Webkul\RestApi\Http\Controllers\V1\Admin\Catalog\ProductCategoryController;
use Webkul\RestApi\Http\Controllers\V1\Admin\Catalog\ProductCustomerGroupPriceController;
use Webkul\RestApi\Http\Controllers\V1\Admin\Catalog\ProductsInventoriesController;
use Webkul\RestApi\Http\Controllers\V1\Admin\Product\ReadyToApiController;

Route::group([
    'middleware' => ['auth:sanctum', 'sanctum.admin'],
    'prefix'     => 'catalog',
], function () {

    Route::get('products-categories', [ProductCategoryController::class, 'allResources']);

    Route::get('products-customer-group-prices', [ProductCustomerGroupPriceController::class, 'allResources']);

    Route::get('products-customer-group-price-total', [ProductCustomerGroupPriceController::class, 'getCountTotal']);
    Route::get('products-inventories', [ProductsInventoriesController::class, 'allResources']);

    /**
     * Product routes.
     */
    Route::controller(ProductController::class)->prefix('products')->group(function () {
        Route::get('', 'allResources');

        Route::get('get-count-total', 'getCountTotal');

        Route::post('', 'store');

        Route::get('{id}', 'getResource');

        Route::put('{id}', 'update');

        Route::post('{id}/inventories', 'updateInventories');

        Route::delete('{id}', 'destroy');

        Route::post('mass-update', 'massUpdate');

        Route::post('mass-destroy', 'massDestroy');
    });

    /**
     * Category routes.
     */
    Route::controller(CategoryController::class)->prefix('categories')->group(function () {
        Route::get('', 'allResources');

        Route::post('', 'store');

        Route::get('{id}', 'getResource');

        Route::put('{id}', 'update');

        Route::delete('{id}', 'destroy');

        Route::post('mass-update', 'massUpdate');

        Route::post('mass-destroy', 'massDestroy');
    });

    /**
     * Attribute routes.
     */
    Route::controller(AttributeController::class)->prefix('attributes')->group(function () {
        Route::get('', 'allResources');

        Route::post('', 'store');

        Route::get('{id}', 'getResource');

        Route::put('{id}', 'update');

        Route::delete('{id}', 'destroy');

        Route::post('mass-destroy', 'massDestroy');
    });

    /**
     * Attribute family routes.
     */
    Route::controller(AttributeFamilyController::class)->prefix('attribute-families')->group(function () {
        Route::get('', 'allResources');

        Route::post('', 'store');

        Route::get('{id}', 'getResource');

        Route::put('{id}', 'update');

        Route::delete('{id}', 'destroy');
    });
});

Route::group([
    'middleware' => ['auth:sanctum', 'sanctum.admin'],
    'prefix'     => 'product-ready-to-api',
], function () {

    Route::get('get-flags', [ReadyToApiController::class, 'getFlags']);

});
