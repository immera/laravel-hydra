<?php

use Immera\Hydra\Controllers\HydraApiController;

$routes = [
    [
        "request" => "get",
        "url" => "/status",
        "controller" => HydraApiController::class,
        "method" => "status"
    ],

    // Customer
    [
        "request" => 'post',
        "url" => '/customers/create',
        "controller" => HydraApiController::class,
        "method" => 'customersCreate'
    ],
    [
        "request" => 'post',
        "url" => '/customers/validate',
        "controller" => HydraApiController::class,
        "method" => 'validateCostumer'
    ],
    [
        "request" => 'post',
        "url" => '/customers/update',
        "controller" => HydraApiController::class,
        "method" => 'updateCostumer'
    ],
    [
        "request" => 'post',
        "url" => '/customers/read',
        "controller" => HydraApiController::class,
        "method" => 'readCostumer'
    ],

    // Sales Price
    [
        "request" => 'get',
        "url" => '/sales/specific',
        "controller" => HydraApiController::class,
        "method" => 'readSalesPrice'
    ],
    [
        "request" => 'get',
        "url" => '/sales',
        "controller" => HydraApiController::class,
        "method" => 'readMultipleSalesPrice'
    ],

    // Sales Line Discounts
    [
        "request" => 'get',
        "url" => '/sales/line/discounts/read',
        "controller" => HydraApiController::class,
        "method" => 'readSalesLineDiscount'
    ],

    // Item
    [
        "request" => 'get',
        "url" => '/item/read',
        "controller" => HydraApiController::class,
        "method" => 'readItem'
    ],
    [
        "request" => 'get',
        "url" => '/item/readMultiple',
        "controller" => HydraApiController::class,
        "method" => 'readMultipleItems'
    ],

    // Sales Order Header
    [
        "request" => 'post',
        "url" => '/sales/order/header/create',
        "controller" => HydraApiController::class,
        "method" => 'salesOrderHeaderCreate'
    ],
    [
        "request" => 'post',
        "url" => '/sales/order/header/update',
        "controller" => HydraApiController::class,
        "method" => 'salesOrderHeaderUpdate'
    ],
    [
        "request" => 'get',
        "url" => '/sales/order/header/read',
        "controller" => HydraApiController::class,
        "method" => 'salesOrderHeaderRead'
    ],
    [
        "request" => 'get',
        "url" => '/sales/order/header/readMultiple',
        "controller" => HydraApiController::class,
        "method" => 'salesOrderHeaderReadMultiple'
    ],

    // Sales Order Lines:
    [
        "request" => 'post',
        "url" => '/sales/order/lines/create',
        "controller" => HydraApiController::class,
        "method" => 'salesOrderLineCreate'
    ],
    [
        "request" => 'post',
        "url" => '/sales/order/lines/update',
        "controller" => HydraApiController::class,
        "method" => 'salesOrderLineUpdate'
    ],
    [
        "request" => 'get',
        "url" => '/sales/order/lines/read',
        "controller" => HydraApiController::class,
        "method" => 'salesOrderLineRead'
    ],
    [
        "request" => 'get',
        "url" => '/sales/order/lines/readMultiple',
        "controller" => HydraApiController::class,
        "method" => 'salesOrderLineReadMultiple'
    ],

    // Sales Invoice Header
    [
        "request" => 'post',
        "url" => '/sales/invoice/header/create',
        "controller" => HydraApiController::class,
        "method" => 'salesInvoiceHeaderCreate'
    ],
    [
        "request" => 'post',
        "url" => '/sales/invoice/header/update',
        "controller" => HydraApiController::class,
        "method" => 'salesInvoiceHeaderUpdate'
    ],
    [
        "request" => 'get',
        "url" => '/sales/invoice/header/read',
        "controller" => HydraApiController::class,
        "method" => 'salesInvoiceHeaderRead'
    ],
    [
        "request" => 'get',
        "url" => '/sales/invoice/header/readMultiple',
        "controller" => HydraApiController::class,
        "method" => 'salesInvoiceHeaderReadMultiple'
    ],

    // Sales Invoice Lines
    [
        "request" => 'post',
        "url" => '/sales/invoice/lines/create',
        "controller" => HydraApiController::class,
        "method" => 'salesInvoiceLinesCreate'
    ],
    [
        "request" => 'post',
        "url" => '/sales/invoice/lines/update',
        "controller" => HydraApiController::class,
        "method" => 'salesInvoiceLinesUpdate'
    ],
    [
        "request" => 'get',
        "url" => '/sales/invoice/lines/read',
        "controller" => HydraApiController::class,
        "method" => 'salesLinesInvoiceRead'
    ],
    [
        "request" => 'get',
        "url" => '/sales/invoice/lines/readMultiple',
        "controller" => HydraApiController::class,
        "method" => 'salesLinesInvoiceReadMultiple'
    ],

    // Cust Ledger Entry
    [
        "request" => 'get',
        "url" => '/costumer/ledger/entry/read',
        "controller" => HydraApiController::class,
        "method" => 'custLedgerEntryRead'
    ],
    // [
    //     "request" => 'post',
    //     "url" => '/costumer/ledger/entry/readMultiple',
    //     "controller" => HydraApiController::class,
    //     "method" => 'custLedgerEntryReadMultiple'
    // ],


    // Stock Items
    [
        "request" => 'get',
        "url" => '/item/stock/read',
        "controller" => HydraApiController::class,
        "method" => 'itemStockRead'
    ],
    [
        "request" => 'get',
        "url" => '/item/stock/readMultiple',
        "controller" => HydraApiController::class,
        "method" => 'itemStockReadMultiple'
    ],

    // Generic Methods
    [
        "request" => 'post',
        "url" => '/methods/print/invoice',
        "controller" => HydraApiController::class,
        "method" => 'fxPostInvoice'
    ],
    [
        "request" => 'post',
        "url" => '/methods/print/document',
        "controller" => HydraApiController::class,
        "method" => 'fxPrintDocument'
    ],
    [
        "request" => 'get',
        "url" => '/methods/sales/price',
        "controller" => HydraApiController::class,
        "method" => 'getSalesPrice'
    ],
];


if (app() instanceof \Illuminate\Foundation\Application) {

    // Code for laravel
    Route::middleware('api')->prefix('api/hydra')->group(function () use ($routes) {
        foreach ($routes as $route) {
            extract($route);
            Route::$request($url, [$controller, $method]);
        }
    });

} else {

    // Code for lumen
    $router = $this->app->router;
    $router->group([
        // 'middleware' => 'api', // API middleware not needed as lumen is for api it self
        'prefix' => 'api/hydra'
    ], function() use ($router, $routes) {
        foreach ($routes as $route) {
            extract($route);
            $router->$request($url, "$controller@$method");
        }
    });

}