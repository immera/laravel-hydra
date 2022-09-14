<?php

namespace Immera\Hydra;

use Illuminate\Support\Str;
use SoapClient;

class Hydra
{
    /**
     * SOAP Helper function
     *
     * @param string $endpoint
     * @return SoapClient
     */
    private function soap(string $endpoint): SoapClient
    {
        return new SoapClient(Str::finish(config('hydra.domain'), '/') . $endpoint, [
            'cache_wsdl' => WSDL_CACHE_NONE,
            'login' => config('hydra.username'),
            'password' => config('hydra.password'),
        ]);
    }

    /**
     * Costumer Create
     *
     * @param string $name
     * @param string $vat
     * @param string $address
     * @param string $postcode
     * @param string $city
     * @param string $phone
     * @param string $email
     * @param string $homepage
     * @return object
     */
    public function customersCreate(
        string $name,
        string $vat,
        string $address,
        string $postcode,
        string $city,
        string $phone,
        string $email,
        string $homepage
    ): object {
        $result = $this
            ->soap('Page/WsCustomers')
            ->create([
                'WsCustomers' => [
                    'Name' => $name,
                    'VATRegistrationNo' => $vat,
                    'Address' => $address,
                    'PostCode' => $postcode,
                    'City' => $city,
                    'PhoneNo' => $phone,
                    'Email' => $email,
                    'Homepage' => $homepage,
                ],
            ]);

        return $result->WsCustomers ?? null;
    }

    /**
     * Validate Costumer
     *
     * @param string $email
     * @param string $vat
     * @return boolean
     */
    public function validateCostumer(string $email, string $vat): bool
    {
        $result = $this
            ->soap('Page/WsCustomers')
            ->readMultiple([
                'filter' => [
                    [
                        'Field' => 'Email',
                        'Criteria' => "=$email",
                    ],
                    [
                        'Field' => 'VATRegistrationNo',
                        'Criteria' => "=$vat",
                    ],
                ],
                'setSize' => 1,
            ]);

        return property_exists($result->ReadMultiple_Result, "WsCustomers");

        return $result->ReadMultiple_Result->WsCustomers ? true : false ;
    }

    /**
     * Update Costumer
     *
     * @param string $name
     * @param string $vat
     * @param string $address
     * @param string $postcode
     * @param string $city
     * @param string $phone
     * @param string $email
     * @param string $homepage
     * @return object
     */
    public function updateCostumer(
        string $key,
        string $name,
        string $name2,
        string $vat,
        string $address,
        string $address2,
        string $postcode,
        string $city,
        string $phone,
        string $email,
        string $homepage
    ): object {
        $result = $this
            ->soap('Page/WsCustomers')
            ->update([
                'WsCustomers' => [
                    'Key' => $key,
                    'Name' => $name,
                    'Name2' => $name2,
                    'VATRegistrationNo' => $vat,
                    'Address' => $address,
                    'Address2' => $address2,
                    'PostCode' => $postcode,
                    'City' => $city,
                    'PhoneNo' => $phone,
                    'Email' => $email,
                    'HomePage' => $homepage
                ],
            ]);

        return $result->WsCustomers ?? (object) [];
    }

    /**
     * Read Costumer
     *
     * @param string $no
     * @return object
     */
    public function readCostumer(
        string $no
    ): object {
        $result = $this
            ->soap('Page/WsCustomers')
            ->read([
                'No' => $no
            ]);

        return $result->WsCustomers ?? (object) [];
    }
    
    /**
     * Read Sales Price
     *
     * @param string $itemno
     * @param string $salestype
     * @param string $salescode
     * @param date $startingdate
     * @param string $currencycode
     * @param string $measurecode
     * @param decimal $quantity
     * @return object
     */
    public function readSalesPrice(
        string $itemno,
        string $salestype,
        string $salescode,
        string $startingdate,
        string $currencycode,
        string $measurecode,
        string $quantity
    ): object {
        $result = $this
            ->soap('Page/WsSalesPrice')
            ->read([
                'Item_No' => $itemno,
                'Sales_Type' => $salestype,
                'Sales_Code' => $salescode,
                'Starting_Date' => $startingdate,
                'Currency_Code' => $currencycode,
                'Unit_of_Measure_Code' => $measurecode,
                'Minimum_Quantity' => $quantity
            ]);

        return $result->WsSalesPrice ?? (object) [];
    }

    /**
     * Read Multiple Sales Price
     *
     * @param string $item_no
     * @param string $size
     * @return object if 1
     * @return object more than 1
     */
    public function readMultipleSalesPrice(
        string $item_no,
        string $size
    ){
        $result = $this
            ->soap('Page/WsSalesPrice')
            ->readMultiple([
                'filter' => [
                    [
                        'Field' => 'Item_No',
                        'Criteria' => "$item_no",
                    ],
                ],
                'setSize' => $size,
            ]);

        return $result->ReadMultiple_Result->WsSalesPrice ?? [];
    }

    

    /**
     * Read Line Discounts
     *
     * @param enum $type
     * @param string $code
     * @param enum $salestype
     * @param string $salescode
     * @param date $startingdate
     * @param string $currencycode
     * @param string $measurecode
     * @param decimal $quantity
     * @return object
     */
    public function readSalesLineDiscount(
        string $type,
        string $code,
        string $salestype,
        string $salescode,
        string $startingdate,
        string $currencycode,
        string $measurecode,
        string $quantity
    ): object {
        $result = $this
            ->soap('Page/WsSalesLineDiscounts')
            ->read([
                'Type' => $type,
                'Code' => $code,
                'Sales_Type' => $salestype,
                'Sales_Code' => $salescode,
                'Starting_Date' => $startingdate,
                'Currency_Code' => $currencycode,
                'Unit_of_Measure_Code' => $measurecode,
                'Minimum_Quantity' => $quantity
            ]);

        return $result->WsSalesLineDiscounts ?? (object) [];
    }

    /**
     * Read Multiple Sales Price
     *
     * @param string $email
     * @param string $vat
     * @return object the costumer
     */
    public function readMultipleSalesLineDiscount(
        string $email,
        string $size
    ): object {
        $result = $this
            ->soap('Page/WsSalesLineDiscounts')
            ->readMultiple([
                'filter' => [
                    [
                        'Field' => 'Code',
                        'Criteria' => '*',
                    ],
                ],
                'setSize' => 1,
            ]);

        return $result->ReadMultiple_Result->WsSalesLineDiscounts ?? (object) [];
    }
    

    /**
     * Read Item
     *
     * @param string $no
     * @return object
     */
    public function readItem(
        string $no
    ): object {
        $result = $this
            ->soap('Page/WsItems')
            ->read([
                'No' => $no,
            ]);

        return $result->WsItems ?? (object) [];
    }

    /**
     * Read Items
     *
     * @param string $no
     * @param string $size
     * @return object if 1
     * @return object more than 1
     */
    public function readMultipleItems(
        string $no,
        string $size,
    ){
        $result = $this
            ->soap('Page/WsItems')
            ->readMultiple([
                'filter' => [
                    [
                        'Field' => 'No',
                        'Criteria' => "$no",
                    ],
                ],
                'setSize' => $size,
            ]);

        return $result->ReadMultiple_Result->WsItems ?? (array) [];
    }

    /**
     * Sales Order Header Create
     *
     * @param string $selltocustomerno
     * @param string $selltocustomername
     * @param string $postingnoseries
     * @param string $postcode
     * @param string $prepaymentnoseries
     * @param string $selltoaddress
     * @param string $selltoaddress2
     * @param string $selltocity
     * @param string $selltopostcode
     * @param string $selltocontryregioncode
     * @param string $selltocontract
     * @param string $postingdate
     * @param string $orderdate
     * @param string $duedate
     * @param string $requestdeliverydate
     * @param string $externaldocumentno
     * @return object
     */
    public function salesOrderHeaderCreate(
        string $selltocustomerno,
        string $selltocustomername,
        string $postingnoseries,
        string $prepaymentnoseries,
        string $selltoaddress,
        string $selltoaddress2,
        string $selltocity,
        string $selltopostcode,
        string $selltocontryregioncode,
        string $selltocontract,
        string $postingdate,
        string $orderdate,
        string $duedate,
        string $requestdeliverydate,
        string $externaldocumentno
    ): object {
        $result = $this
            ->soap('Page/WsSalesOrderHeader')
            ->create([
                'WsSalesOrderHeader' => [
                    'Sell_to_Customer_No' => $selltocustomerno,
                    'Sell_to_Customer_Name' => $selltocustomername,
                    'Posting_No_Series' => $postingnoseries,
                    'Prepayment_No_Series' => $prepaymentnoseries,
                    'Sell_to_Address' => $selltoaddress,
                    'Sell_to_Address_2' => $selltoaddress2,
                    'Sell_to_City' => $selltocity,
                    'Sell_to_Post_Code' => $selltopostcode,
                    'Sell_to_Country_Region_Code' => $selltocontryregioncode,
                    'Sell_to_Contact' => $selltocontract,
                    'Posting_Date' => $postingdate,
                    'Order_Date' => $orderdate,
                    'Due_Date' => $duedate,
                    'Requested_Delivery_Date' => $requestdeliverydate,
                    'External_Document_No' => $externaldocumentno,
                ],
            ]);

        return $result->WsSalesOrderHeader ?? null;
    }
    
    /**
     * Sales Order Header Update
     *
     * @param string $key
     * @param string $no
     * @param string $selltocustomerno
     * @param string $selltocustomername
     * @param string $postingnoseries
     * @param string $postcode
     * @param string $prepaymentnoseries
     * @param string $selltoaddress
     * @param string $selltoaddress2
     * @param string $selltocity
     * @param string $selltopostcode
     * @param string $selltocontryregioncode
     * @param string $selltocontract
     * @param string $postingdate
     * @param string $orderdate
     * @param string $duedate
     * @param string $requestdeliverydate
     * @param string $externaldocumentno
     * @return object
     */
    public function salesOrderHeaderUpdate(
        string $key,
        string $no,
        string $selltocustomerno,
        string $selltocustomername,
        string $postingnoseries,
        string $prepaymentnoseries,
        string $selltoaddress,
        string $selltoaddress2,
        string $selltocity,
        string $selltopostcode,
        string $selltocontryregioncode,
        string $selltocontract,
        string $postingdate,
        string $orderdate,
        string $duedate,
        string $requestdeliverydate,
        string $externaldocumentno
    ): object {
        $result = $this
            ->soap('Page/WsSalesOrderHeader')
            ->update([
                'WsSalesOrderHeader' => [
                    'Key' => $key,
                    'No' => $no,
                    'Sell_to_Customer_No' => $selltocustomerno,
                    'Sell_to_Customer_Name' => $selltocustomername,
                    'Posting_No_Series' => $postingnoseries,
                    'Prepayment_No_Series' => $prepaymentnoseries,
                    'Sell_to_Address' => $selltoaddress,
                    'Sell_to_Address_2' => $selltoaddress2,
                    'Sell_to_City' => $selltocity,
                    'Sell_to_Post_Code' => $selltopostcode,
                    'Sell_to_Country_Region_Code' => $selltocontryregioncode,
                    'Sell_to_Contact' => $selltocontract,
                    'Posting_Date' => $postingdate,
                    'Order_Date' => $orderdate,
                    'Due_Date' => $duedate,
                    'Requested_Delivery_Date' => $requestdeliverydate,
                    'External_Document_No' => $externaldocumentno,
                ],
            ]);

        return $result->WsSalesOrderHeader ?? (object) [];
    }

    /**
     * Read Sales Order Header
     *
     * @param string $no
     * @return object
     */
    public function salesOrderHeaderRead(
        string $no
    ): object {
        $result = $this
            ->soap('Page/WsSalesOrderHeader')
            ->read([
                'No' => $no
            ]);

        return $result->WsSalesOrderHeader ?? (object) [];
    }

    /**
     * Read Multiple Costumer
     *
     * @param string $no
     * @param string $size
     * @return object if 1
     * @return object more than 1
     */
    public function salesOrderHeaderReadMultiple(
        string $no,
        string $size,
    ) {
        $result = $this
            ->soap('Page/WsSalesOrderHeader')
            ->readMultiple([
                'filter' => [
                    [
                        'Field' => 'No',
                        'Criteria' => "$no",
                    ],
                ],
                'setSize' => $size,
            ]);

        return $result->ReadMultiple_Result->WsCustomers ?? (array) [];
    }

    /**
     * Sales Order Line Create
     *
     * @param string $documentno
     * @param string $type
     * @param string $description
     * @param string $description2
     * @param string $quantity
     * @param string $measurecode
     * @param string $unitprice
     * @param string $linediscountpercent
     * @return object
     */
    public function salesOrderLineCreate(
        string $documentno,
        string $type,
        string $description,
        string $description2,
        string $quantity,
        string $measurecode,
        string $unitprice,
        string $linediscountpercent
    ): object {

        $result = $this
            ->soap('Page/WsSalesOrderLines')
            ->create([
                'WsSalesOrderLines' => [
                    'Type' => $type,
                    'Document_No' => $documentno,
                    'Description' => $description,
                    'Descriptio\n_2' => $description2,
                    'Quantity' => $quantity,
                    'Unit_of_Measure_Code' => $measurecode,
                    'Unit_Price' => $unitprice,
                    'Line_Discount_Percent' => $linediscountpercent,
                ],
            ]);

        return $result->WsSalesOrderLines ?? null;
    }

    /**
     * Update Sales Order Line 
     *
     * @param string $key
     * @param string $type
     * @param string $no
     * @param string $description
     * @param string $description2
     * @param string $quantity
     * @param string $measurecode
     * @param string $unitprice
     * @param string $linediscountpercent
     * @return object
     */
    public function salesOrderLineUpdate(
        string $key,
        string $type,
        string $no,
        string $description,
        string $description2,
        string $quantity,
        string $measurecode,
        string $unitprice,
        string $linediscountpercent
    ): object {
        $result = $this
            ->soap('Page/WsSalesOrderLines')
            ->update([
                'WsSalesOrderLines' => [
                    'Key' => $key,
                    'Type' => $type,
                    'No' => $no,
                    'Description' => $description,
                    'Descriptio\n_2' => $description2,
                    'Quantity' => $quantity,
                    'Unit_of_Measure_Code' => $measurecode,
                    'Unit_Price' => $unitprice,
                    'Line_Discount_Percent' => $linediscountpercent,
                ],
            ]);

        return $result->WsSalesOrderLines ?? (object) [];
    }

    /**
     * Read Sales Order Line
     *
     * @param string $documentno
     * @param string $lineno
     * @return object
     */
    public function salesOrderLineRead(
        string $documentno,
        string $lineno
    ): object {
        $result = $this
            ->soap('Page/WsSalesOrderLines')
            ->read([
                'Document_No' => $documentno,
                'Line_No' => $lineno
            ]);

        return $result->WsSalesOrderLines ?? (object) [];
    }

    /**
     * Read Multiple  Sales Order Line
     *
     * @param string $no
     * @param string $size
     * @return object if 1
     * @return object more than 1
     */
    public function salesOrderLineReadMultiple(
        string $no,
        string $size,
    ) {
        $result = $this
            ->soap('Page/WsSalesOrderLines')
            ->readMultiple([
                'filter' => [
                    [
                        'Field' => 'No',
                        'Criteria' => "$no",
                    ],
                ],
                'setSize' => $size,
            ]);

        return $result->ReadMultiple_Result->WsSalesOrderLines ?? (object) [];
    }


    /**
     * Sales Invoice Header Create
     *
     * @param string $selltocustomerno
     * @param string $selltocustomername
     * @param string $postingnoseries
     * @param string $prepaymentnoseries
     * @param string $selltoaddress
     * @param string $selltoaddress2
     * @param string $selltocity
     * @param string $selltopostcode
     * @param string $selltocountryregioncode
     * @param string $selltocontact
     * @param string $postingdate
     * @param string $duedate
     * @return object
     */
    public function salesInvoiceHeaderCreate(
        string $selltocustomerno,
        string $selltocustomername,
        string $postingnoseries,
        string $prepaymentnoseries,
        string $selltoaddress,
        string $selltoaddress2,
        string $selltocity,
        string $selltopostcode,
        string $selltocountryregioncode,
        string $selltocontact,
        string $postingdate,
        string $duedate
    ): object {

        $result = $this
            ->soap('Page/WsSalesInvoiceHeader')
            ->create([
                'WsSalesInvoiceHeader' => [
                    'Sell_to_Customer_No' => $selltocustomerno,
                    'Sell_to_Customer_Name' => $selltocustomername,
                    'Posting_No_Series' => $postingnoseries,
                    'Prepayment_No_Series' => $prepaymentnoseries,
                    'Sell_to_Address' => $selltoaddress,
                    'Sell_to_Address_2' => $selltoaddress2,
                    'Sell_to_City' => $selltocity,
                    'Sell_to_Post_Code' => $selltopostcode,
                    'Sell_to_Country_Region_Code' => $selltocountryregioncode,
                    'Sell_to_Contact' => $selltocontact,
                    'Posting_Date' => $postingdate,
                    'Due_Date' => $duedate,
                ],
            ]);

        return $result->WsSalesInvoiceHeader ?? null;
    }

     /**
     * Sales Invoice Header Update
     *
     * @param string $key
     * @param string $no
     * @param string $selltocustomerno
     * @param string $selltocustomername
     * @param string $postingnoseries
     * @param string $prepaymentnoseries
     * @param string $selltoaddress
     * @param string $selltoaddress2
     * @param string $selltocity
     * @param string $selltopostcode
     * @param string $selltocountryregioncode
     * @param string $selltocontact
     * @param string $postingdate
     * @param string $duedate
     * @return object
     */
    public function salesInvoiceHeaderUpdate(
        string $key,
        string $no,
        string $selltocustomerno,
        string $selltocustomername,
        string $postingnoseries,
        string $prepaymentnoseries,
        string $selltoaddress,
        string $selltoaddress2,
        string $selltocity,
        string $selltopostcode,
        string $selltocountryregioncode,
        string $selltocontact,
        string $postingdate,
        string $duedate
    ): object {

        $result = $this
            ->soap('Page/WsSalesInvoiceHeader')
            ->update([
                'WsSalesInvoiceHeader' => [
                    'Key' => $key,
                    'No' => $no,
                    'Sell_to_Customer_No' => $selltocustomerno,
                    'Sell_to_Customer_Name' => $selltocustomername,
                    'Posting_No_Series' => $postingnoseries,
                    'Prepayment_No_Series' => $prepaymentnoseries,
                    'Sell_to_Address' => $selltoaddress,
                    'Sell_to_Address_2' => $selltoaddress2,
                    'Sell_to_City' => $selltocity,
                    'Sell_to_Post_Code' => $selltopostcode,
                    'Sell_to_Country_Region_Code' => $selltocountryregioncode,
                    'Sell_to_Contact' => $selltocontact,
                    'Posting_Date' => $postingdate,
                    'Due_Date' => $duedate,
                ],
            ]);

        return $result->WsSalesInvoiceHeader ?? null;
    }

    /**
     * Read Sales Order Line
     *
     * @param string $no
     * @return object
     */
    public function salesInvoiceHeaderRead(
        string $no
    ): object {
        $result = $this
            ->soap('Page/WsSalesInvoiceHeader')
            ->read([
                'No' => $no,
            ]);

        return $result->WsSalesInvoiceHeader ?? (object) [];
    }

    /**
     * Read Multiple  Sales Order Line
     *
     * @param string $no
     * @param string $size
     * @return object if 1
     * @return object more than 1
     */
    public function salesInvoiceHeaderReadMultiple(
        string $no,
        string $size,
    ) {
        $result = $this
            ->soap('Page/WsSalesOrderLines')
            ->readMultiple([
                'filter' => [
                    [
                        'Field' => 'No',
                        'Criteria' => "$no",
                    ],
                ],
                'setSize' => $size,
            ]);

        return $result->ReadMultiple_Result->WsSalesOrderLines ?? (array) [];
    }
    

    /**
     * Sales Invoice Lines Create
     *
     * @param string documentno
     * @param string type
     * @param string no
     * @param string  description
     * @param string  description2
     * @param string quantity
     * @param string  measyrecode
     * @param string  unitprice
     * @param string  linediscountpercent
     * @return object
     */
    public function salesInvoiceLinesCreate(
        string  $documentno,
        string  $type,
        string  $no,
        string  $description,
        string  $description2,
        string  $quantity,
        string  $measyrecode,
        string  $unitprice,
        string  $linediscountpercent
    ): object {

        $result = $this
            ->soap('Page/WsSalesInvoiceLines')
            ->create([
                'WsSalesInvoiceLines' => [
                    'Document_No' => $documentno,
                    'Type' => $type,
                    'No' => $no,
                    'Description' => $description,
                    'Description_2' => $description2,
                    'Quantity' => $quantity,
                    'Unit_of_Measure_Code' => $measyrecode,
                    'Unit_Price' => $unitprice,
                    'Line_Discount_Percent' => $linediscountpercent,
                ],
            ]);

        return $result->WsSalesInvoiceLines ?? null;
    }


    /**
     * Sales Invoice Lines Update
     *
     * @param string key
     * @param string documentno
     * @param string type
     * @param string no
     * @param string  description
     * @param string  description2
     * @param string quantity
     * @param string  measyrecode
     * @param string  unitprice
     * @param string  linediscountpercent
     * @param string  amount
     * @param string  amountincludingvat
     * @return object
     */
    public function salesInvoiceLinesUpdate(
        string $key,
        string $documentno,
        string $type,
        string $no,
        string  $description,
        string  $description2,
        string $quantity,
        string  $measyrecode,
        string  $unitprice,
        string  $linediscountpercent,
        string  $amount,
        string  $amountincludingvat
    ): object {

        $result = $this
            ->soap('Page/WsSalesInvoiceLines')
            ->update([
                'WsSalesInvoiceLines' => [
                    'Key' => $key,
                    'Document_No' => $documentno,
                    'Type' => $type,
                    'No' => $no,
                    'Description' => $description,
                    'Description_2' => $description2,
                    'Quantity' => $quantity,
                    'Unit_of_Measure_Code' => $measyrecode,
                    'Unit_Price' => $unitprice,
                    'Line_Discount_Percent' => $linediscountpercent,
                    'Amount' => $amount,
                    'Amount_Including_VAT' => $amountincludingvat
                ],
            ]);

        return $result->WsSalesInvoiceLines ?? null;
    }

    /**
     * Sales Invoice Lines Read
     *
     * @param string $documentno
     * @param string $lineno
     * @return object
     */
    public function salesLinesInvoiceRead(
        string $documentno,
        string $lineno
    ): object {
        $result = $this
            ->soap('Page/WsSalesInvoiceLines')
            ->read([
                'Document_No' => $documentno,
                'Line_No' => $lineno,
            ]);

        return $result->WsSalesInvoiceLines ?? (object) [];
    }

    /**
     * Sales Invoice Lines Read Multiple
     *
     * @param string $documentno
     * @param string $size
     * @return object
     */
    public function salesLinesInvoiceReadMultiple(
        string $documentno,
        string $size,
    ) {
        $result = $this
            ->soap('Page/WsSalesInvoiceLines')
            ->readMultiple([
                'filter' => [
                    [
                        'Field' => 'Document_No',
                        'Criteria' => "$documentno",
                    ],
                ],
                'setSize' => $size,
            ]);

        return $result->ReadMultiple_Result->WsSalesInvoiceLines ?? (array) [];
    }

    /**
     * Cust Ledger Entry Read
     *
     * @param string $entryno
     * @return object
     */
    public function custLedgerEntryRead(
        string $entryno
    ): object {
        $result = $this
            ->soap('Page/WsCustLedgerEntry')
            ->read([
                'Entry_No' => $entryno
            ]);

        return $result->WsCustLedgerEntry ?? (object) [];
    }

    /**
     * Cust Ledger Entry Read Multiple
     *
     * @param string $customerno
     * @param string $size
     * @return object if 1
     * @return object more than 1
     */
    public function custLedgerEntryReadMultiple(
        string $customerno,
        string $size,
    ) {
        $result = $this
            ->soap('Page/WsCustLedgerEntry')
            ->readMultiple([
                'filter' => [
                    [
                        'Field' => 'Customer_No',
                        'Criteria' => "$customerno",
                    ],
                ],
                'setSize' => $size,
            ]);

        return $result->ReadMultiple_Result->WsCustLedgerEntry ?? (array) [];
    }

    /**
     * Read Item Stock
     *
     * @param string $no
     * @return object
     */
    public function itemStockRead(
        string $no
    ): object {
        $result = $this
            ->soap('Page/WsStockItems')
            ->read([
                'No' => $no
            ]);

        return $result->WsStockItems ?? (object) [];
    }

    /**
     * Read Multiple Items Stock
     *
     * @param string $inventorybylocation
     * @param string $size
     * @return object if 1
     * @return object more than 1
     */
    public function itemStockReadMultiple(
        string $no,
        string $size
    ) {
        $result = $this
            ->soap('Page/WsStockItems')
            ->readMultiple([
                'filter' => [
                    [
                        'Field' => 'No',
                        'Criteria' => "$no",
                    ],
                ],
                'setSize' => $size,
            ]);

        return $result->ReadMultiple_Result->WsStockItems ?? (array) [];
    }

    /**
     * FX POST INVOICE 
     *
     * @param string $pinvoiceno
     * @return object
     */
    public function fxPostInvoice(
        string $pinvoiceno
    ): object {
        $result = $this
            ->soap('Codeunit/WsGenericMethods')
            ->FxPostInvoice([
                'pInvoiceNo' => $pinvoiceno
            ]);

        return $result->WsGenericMethods ?? (object) [];
    }

    /**
     * FX PRINT DOCUMENT 
     *
     * @param string $pinvoiceno
     * @return object
     */
    public function fxPrintDocument(
        string $pinvoiceno
    ): object {
        $result = $this
            ->soap('Codeunit/WsGenericMethods')
            ->fxPostInvoice([
                'pInvoiceNo' => $pinvoiceno
            ]);

        return $result->WsGenericMethods ?? (object) [];
    }

    /**
     * FX GET SALES PRICE
     *
     * @param string $pcustomer
     * @param string $pitemno
     * @param string $pcustomerpricetable
     * @param string $pdate
     * @return object
     */
    public function getSalesPrice(
        string $pcustomer,
        string $pitemno,
        string $pcustomerpricetable,
        string $pdate
    ): object {
        $result = $this
            ->soap('Page/fxGetSalesPrice')
            ->fxPostInvoice([
                'pCustomer' => $pcustomer,
                'pItemNo' => $pitemno,
                'pCustomerPriceTable' => $pcustomerpricetable,
                'pDate ' => $pdate,
            ]);

        return $result->fxGetSalesPrice ?? (object) [];
    }
}