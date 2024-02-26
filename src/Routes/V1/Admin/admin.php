<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => 'v1/admin',
    'middleware' => ['sanctum.locale'],
], function () {
    /**
     * Authentication routes.
     */
    require 'auth-routes.php';

    /**
     * Order routes
     */
    require 'order-routes.php';

    /**
     * Catalog routes.
     */
    require 'catalog-routes.php';

    /**
     * Customer routes.
     */
    require 'customer-routes.php';

    /**
     * Setting routes.
     */
    require 'setting-routes.php';

    /**
     * Configuration routes.
     */
    require 'configuration-routes.php';
});
