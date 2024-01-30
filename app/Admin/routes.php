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
    $router->resource('/goodsCategory', Controllers\GoodsCategoryController::class);

    $router->get('/goods/skuList', [Controllers\GoodsController::class, 'skuList']);
    $router->get('/goods/skuStockList', [Controllers\GoodsController::class, 'skuStockList']);
    $router->resource('/goods', Controllers\GoodsController::class);
    $router->resource('/skuLog', Controllers\SkuLogController::class);

    $router->resource('/vendor', Controllers\VendorController::class);
    $router->resource('/order', Controllers\OrderController::class);
    $router->resource('/myOrder', Controllers\MyOrderController::class);
    $router->resource('/entry', Controllers\EntryController::class);

});
