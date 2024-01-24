<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;
use App\Admin\Controllers;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/goodsAttribute', Controllers\GoodsSkuController::class);
    $router->resource('/goodsCategory', Controllers\GoodsCategoryController::class);
    $router->resource('/goods', Controllers\GoodsController::class);
    $router->resource('/vendor', Controllers\VendorController::class);

});
