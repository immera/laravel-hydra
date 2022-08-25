<?php

use App\Http\Controllers\HydraWebServiceController;

Route::middleware('api')->prefix('api/hydra')->group(function () {

    // Status
    Route::get('/status', function () {
        return ['status' => true];
    });

    // Costumers
    Route::post('/customers/create', function () {
        return app('hydra')->customersCreate(
            request()->get('name'),
            request()->get('vat'),
            request()->get('address'),
            request()->get('postcode'),
            request()->get('city'),
            request()->get('phone'),
            request()->get('email'),
            request()->get('homepage'),
        );
    });

    Route::post('/customers/validate', function () {
        return app('hydra')->validateCostumer(
            request()->get('email'),
            request()->get('vat'),
        );
    });

    Route::post('/customers/update', function () { //TO DO
        return app('hydra')->updateCostumer(
            request()->get('key'),
            request()->get('name'),
            request()->get('name2'),
            request()->get('vat'),
            request()->get('address'),
            request()->get('address2'),
            request()->get('postcode'),
            request()->get('city'),
            request()->get('phone'),
            request()->get('email'),
            request()->get('homepage'),
        );
    });

    Route::post('/customers/read', function () {
        return app('hydra')->readCostumer(
            request()->get('no'),
        );
    });

    // Sales Price
    Route::get('/sales/specific', function () {
        return app('hydra')->readSalesPrice(
            request()->get('itemno'),
            request()->get('salestype'),
            request()->get('salescode'),
            request()->get('startingdate'),
            request()->get('currencycode'),
            request()->get('measurecode'),
            request()->get('quantity'),
        );
    });

    Route::get('/sales', function () {
        return app('hydra')->readMultipleSalesPrice(
            request()->get('size'),
        );
    });

    // Sales Line Discounts
    Route::get('/sales/line/discounts/read', function () {
        return app('hydra')->readSalesLineDiscount(
            request()->get('key'),
            request()->get('type'),
            request()->get('code'),
            request()->get('salestype'),
            request()->get('salescode'),
            request()->get('startingdate'),
            request()->get('endingdate'),
            request()->get('unitprice'),
            request()->get('priceincludesvat'),
        );
    });

    // Item
    Route::get('/item/read', function () {
        return app('hydra')->readItem(
            request()->get('no'),
        );
    });

    Route::get('/item/readMultiple', function () {
        return app('hydra')->readMultipleItems(
            request()->get('size'),
            request()->get('email'),
        );
    });

    // Sales Order Header
    Route::post('/sales/order/header/create', function () {
        return app('hydra')->salesOrderHeaderCreate(
            request()->get('selltocustomerno'),
            request()->get('selltocustomername'),
            request()->get('postingnoseries'),
            request()->get('prepaymentnoseries'),
            request()->get('selltoaddress'),
            request()->get('selltoaddress2'),
            request()->get('selltocity'),
            request()->get('selltopostcode'),
            request()->get('selltocontryregioncode'),
            request()->get('selltocontract'),
            request()->get('postingdate'),
            request()->get('orderdate'),
            request()->get('duedate'),
            request()->get('requestdeliverydate'),
            request()->get('externaldocumentno'),
        );
    });

    Route::post('/sales/order/header/update', function () { //TO DO
        return app('hydra')->salesOrderHeaderUpdate(
            request()->get('key'),
            request()->get('no'),
            request()->get('selltocustomerno'),
            request()->get('selltocustomername'),
            request()->get('postingnoseries'),
            request()->get('prepaymentnoseries'),
            request()->get('selltoaddress'),
            request()->get('selltoaddress2'),
            request()->get('selltocity'),
            request()->get('selltopostcode'),
            request()->get('selltocontryregioncode'),
            request()->get('selltocontract'),
            request()->get('postingdate'),
            request()->get('orderdate'),
            request()->get('duedate'),
            request()->get('requestdeliverydate'),
            request()->get('externaldocumentno'),
        );
    });

    Route::get('/sales/order/header/read', function () {
        return app('hydra')->salesOrderHeaderRead(
            request()->get('no'),
        );
    });

    Route::get('/sales/order/header/readMultiple', function () {
        return app('hydra')->salesOrderHeaderReadMultiple(
            request()->get('no'),
        );
    });

    // Sales Order Lines:
    Route::post('/sales/order/lines/create', function () {
        return app('hydra')->salesOrderLineCreate(
            request()->get('documentno'),
            request()->get('no'),
            request()->get('type'),
            request()->get('description'),
            request()->get('description2'),
            request()->get('quantity'),
            request()->get('measurecode'),
            request()->get('unitprice'),
            request()->get('linediscountpercent'),
        );
    });

    Route::post('/sales/order/lines/update', function () { //TO DO
        return app('hydra')->salesOrderLineUpdate(
            request()->get('key'),
            request()->get('type'),
            request()->get('no'),
            request()->get('description'),
            request()->get('description2'),
            request()->get('quantity'),
            request()->get('measurecode'),
            request()->get('unitprice'),
            request()->get('linediscountpercent'),
        );
    });

    Route::get('/sales/order/lines/read', function () {
        return app('hydra')->salesOrderLineRead(
            request()->get('documentno'),
            request()->get('lineno'),
        );
    });

    Route::get('/sales/order/lines/readMultiple', function () {
        return app('hydra')->salesOrderLineReadMultiple(
            request()->get('no'),
        );
    });

    // Sales Invoice Header
    Route::post('/sales/invoice/header/create', function () {
        return app('hydra')->salesInvoiceHeaderCreate(
            request()->get('selltocustomerno'),
            request()->get('selltocustomername'),
            request()->get('postingnoseries'),
            request()->get('prepaymentnoseries'),
            request()->get('selltoaddress'),
            request()->get('selltoaddress2'),
            request()->get('selltocity'),
            request()->get('selltopostcode'),
            request()->get('selltocountryregioncode'),
            request()->get('selltocontact'),
            request()->get('postingdate'),
            request()->get('duedate'),
        );
    });

    Route::post('/sales/invoice/header/update', function () {
        return app('hydra')->salesInvoiceHeaderUpdate(
            request()->get('key'),
            request()->get('no'),
            request()->get('selltocustomerno'),
            request()->get('selltocustomername'),
            request()->get('postingnoseries'),
            request()->get('prepaymentnoseries'),
            request()->get('selltoaddress'),
            request()->get('selltoaddress2'),
            request()->get('selltocity'),
            request()->get('selltopostcode'),
            request()->get('selltocountryregioncode'),
            request()->get('selltocontact'),
            request()->get('postingdate'),
            request()->get('duedate'),
        );
    });

    Route::get('/sales/invoice/header/read', function () {
        return app('hydra')->salesInvoiceHeaderRead(
            request()->get('no'),
        );
    });

    Route::get('/sales/invoice/header/readMultiple', function () {
        return app('hydra')->salesInvoiceHeaderReadMultiple(
            request()->get('no'),
        );
    });

    // Sales Invoice Lines
    Route::post('/sales/invoice/lines/create', function () {
        return app('hydra')->salesInvoiceLinesCreate(
            request()->get('documentno'),
            request()->get('type'),
            request()->get('no'),
            request()->get('description'),
            request()->get('description2'),
            request()->get('quantity'),
            request()->get('measyrecode'),
            request()->get('unitprice'),
            request()->get('linediscountpercent'),
        );
    });

    Route::post('/sales/invoice/lines/update', function () {
        return app('hydra')->salesInvoiceLinesUpdate(
            request()->get('key'),
            request()->get('documentno'),
            request()->get('type'),
            request()->get('no'),
            request()->get('description'),
            request()->get('description2'),
            request()->get('quantity'),
            request()->get('measyrecode'),
            request()->get('unitprice'),
            request()->get('linediscountpercent'),
        );
    });

    Route::get('/sales/invoice/lines/read', function () {
        return app('hydra')->salesLinesInvoiceRead(
            request()->get('documentno'),
            request()->get('lineno'),
        );
    });

    Route::get('/sales/invoice/lines/readMultiple', function () {
        return app('hydra')->salesLinesInvoiceReadMultiple(
            request()->get('documentno'),
        );
    });

    // Cust Ledger Entry
    Route::get('/costumer/ledger/entry/read', function () {
        return app('hydra')->custLedgerEntryRead(
            request()->get('entryno'),
        );
    });

    // Route::post('/costumer/ledger/entry/readMultiple', function () {
    //     return app('hydra')->custLedgerEntryReadMultiple(
    //         request()->get('customerno'),
    //     );
    // });

    // Stock Items
    Route::get('/item/stock/read', function () {
        return app('hydra')->itemStockRead(
            request()->get('no'),
        );
    });

    Route::get('/item/stock/readMultiple', function () {
        return app('hydra')->itemStockReadMultiple(
            request()->get('inventorybylocation'),
        );
    });

    // Generic Methods
    Route::post('/methods/print/invoice', function () {
        return app('hydra')->fxPostInvoice(
            request()->get('pinvoiceno'),
        );
    });

    Route::post('/methods/print/document', function () {
        return app('hydra')->fxPrintDocument(
            request()->get('pinvoiceno'),
        );
    });

    Route::get('/methods/sales/price', function () {
        return app('hydra')->getSalesPrice(
            request()->get('pcustomer'),
            request()->get('pitemno'),
            request()->get('pcustomerpricetable'),
            request()->get('pdate'),
        );
    });
});
