<?php

namespace Immera\Hydra\Controllers;

use App\Http\Controllers\Controller;

class HydraApiController extends Controller {

    // For status check.
    public function status () {
        return ['status' => true];
    }

    // --- CUSTOMER APIS ----
    public function customersCreate () {
        return app('hydra')->customersCreate(
            request()->get('name'),
            request()->get('vat'),
            request()->get('address'),
            request()->get('postcode'),
            request()->get('city'),
            request()->get('phone'),
            request()->get('email'),
            request()->get('homepage')
        );
    }

    public function validateCostumer () {
        return app('hydra')->validateCostumer(
            request()->get('email'),
            request()->get('vat')
        );
    }

    public function updateCostumer () { //TO DO
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
            request()->get('homepage')
        );
    }

    public function readCostumer() {
        return app('hydra')->readCostumer(
            request()->get('no')
        );
    }

    // --- Sales Price ---
    public function readSalesPrice () {
        return app('hydra')->readSalesPrice(
            request()->get('itemno'),
            request()->get('salestype'),
            request()->get('salescode'),
            request()->get('startingdate'),
            request()->get('currencycode'),
            request()->get('measurecode'),
            request()->get('quantity')
        );
    }

    public function readMultipleSalesPrice () {
        return app('hydra')->readMultipleSalesPrice(
            request()->get('item_no'),
            request()->get('size'),
        );
    }

    // --- Sales Line Discounts ---
    public function readSalesLineDiscount () {
        return app('hydra')->readSalesLineDiscount(
            request()->get('key'),
            request()->get('type'),
            request()->get('code'),
            request()->get('salestype'),
            request()->get('salescode'),
            request()->get('startingdate'),
            request()->get('endingdate'),
            request()->get('unitprice'),
            request()->get('priceincludesvat')
        );
    }

    // --- Item ---
    public function readItem () {
        return app('hydra')->readItem(
            request()->get('no')
        );
    }

    public function readMultipleItems () {
        return app('hydra')->readMultipleItems(
            request()->get('no'),
            request()->get('size'),
        );
    }

    // --- Sales Order Header ---
    public function salesOrderHeaderCreate () {
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
            request()->get('externaldocumentno')
        );
    }

    public function salesOrderHeaderUpdate () {
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
            request()->get('externaldocumentno')
        );
    }

    public function salesOrderHeaderRead () {
        return app('hydra')->salesOrderHeaderRead(
            request()->get('no')
        );
    }

    public function salesOrderHeaderReadMultiple () {
        return app('hydra')->salesOrderHeaderReadMultiple(
            request()->get('no'),
            request()->get('size'),
        );
    }

    // --- Sales Order Lines ---
    public function salesOrderLineCreate () {
        return app('hydra')->salesOrderLineCreate(
            request()->get('documentno'),
            request()->get('no'),
            request()->get('type'),
            request()->get('description'),
            request()->get('description2'),
            request()->get('quantity'),
            request()->get('measurecode'),
            request()->get('unitprice'),
            request()->get('linediscountpercent')
        );
    }

    public function salesOrderLineUpdate () {
        return app('hydra')->salesOrderLineUpdate(
            request()->get('key'),
            request()->get('type'),
            request()->get('no'),
            request()->get('description'),
            request()->get('description2'),
            request()->get('quantity'),
            request()->get('measurecode'),
            request()->get('unitprice'),
            request()->get('linediscountpercent')
        );
    }

    public function salesOrderLineRead () {
        return app('hydra')->salesOrderLineRead(
            request()->get('documentno'),
            request()->get('lineno')
        );
    }

    public function salesOrderLineReadMultiple () {
        return app('hydra')->salesOrderLineReadMultiple(
            request()->get('no'),
            request()->get('size'),
        );
    }

    // --- Sales Invoice Header ---
    public function salesInvoiceHeaderCreate () {
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
            request()->get('duedate')
        );
    }

    public function salesInvoiceHeaderUpdate () {
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
            request()->get('duedate')
        );
    }

    public function salesInvoiceHeaderRead () {
        return app('hydra')->salesInvoiceHeaderRead(
            request()->get('no')
        );
    }

    public function salesInvoiceHeaderReadMultiple () {
        return app('hydra')->salesInvoiceHeaderReadMultiple(
            request()->get('no'),
            request()->get('size'),
        );
    }

    // --- Sales Invoice Lines ---
    public function salesInvoiceLinesCreate () {
        return app('hydra')->salesInvoiceLinesCreate(
            request()->get('documentno'),
            request()->get('type'),
            request()->get('no'),
            request()->get('description'),
            request()->get('description2'),
            request()->get('quantity'),
            request()->get('measyrecode'),
            request()->get('unitprice'),
            request()->get('linediscountpercent')
        );
    }

    public function salesInvoiceLinesUpdate () {
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
            request()->get('linediscountpercent')
        );
    }

    public function salesLinesInvoiceRead () {
        return app('hydra')->salesLinesInvoiceRead(
            request()->get('documentno'),
            request()->get('lineno')
        );
    }

    public function salesLinesInvoiceReadMultiple () {
        return app('hydra')->salesLinesInvoiceReadMultiple(
            request()->get('documentno'),
            request()->get('size')
        );
    }

    // Cust Ledger Entry
    public function custLedgerEntryRead () {
        return app('hydra')->custLedgerEntryRead(
            request()->get('entryno')
        );
    }

    public function custLedgerEntryReadMultiple () {
        return app('hydra')->custLedgerEntryReadMultiple(
            request()->get('customerno'),
            request()->get('size')
        );
    }

    // --- Stock Items ---
    public function itemStockRead () {
        return app('hydra')->itemStockRead(
            request()->get('no')
        );
    }

    public function itemStockReadMultiple () {
        return app('hydra')->itemStockReadMultiple(
            request()->get('inventorybylocation'),
            request()->get('size'),
        );
    }

    // --- Generic Methods ---
    public function fxPostInvoice () {
        return app('hydra')->fxPostInvoice(
            request()->get('pinvoiceno')
        );
    }

    public function fxPrintDocument () {
        return app('hydra')->fxPrintDocument(
            request()->get('pinvoiceno')
        );
    }

    public function getSalesPrice () {
        return app('hydra')->getSalesPrice(
            request()->get('pcustomer'),
            request()->get('pitemno'),
            request()->get('pcustomerpricetable'),
            request()->get('pdate')
        );
    }

}