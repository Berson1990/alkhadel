<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */
/*Route::get('test','test@test');

Route::resource('', '');*/

//========================================================taqarer=======================
/*bank*/


Route::resource('dailyreport', 'DailyReportController');

Route::resource('dailycashier', 'DailyCashierController');

Route::resource('foreignsuppliersstatment', 'ForeignSuppliersStatmentController');

Route::post('loadforeignsupppliersstatment', 'ForeignSuppliersStatmentController@loadforeignsupppliersStatment');

Route::post('getOtherEx', 'ForeignSuppliersStatmentController@getOtherExpenses');

Route::post('GetCustomMountstatment', 'ForeignSuppliersStatmentController@GetCustomMountStatment');

Route::resource('carryingreprot', 'CarryingReprotController');

Route::post('loadcrrying', 'CarryingReprotController@loadCryying');

Route::post('forignproduct', 'DailyReportController@abordForeign');

Route::post('LoadDeferredBills', 'DailyReportController@LoadDeferredBills');

Route::post('LoadEndBillsDailyReport', 'DailyReportController@LoadEndBillsDailyReport');

Route::post('endbillswithforignproudct', 'DailyReportController@endbillForginProudct');

Route::post('LoadUpperCustomer', 'DailyReportController@LoadUpperCustomer');

Route::post('upperforignprouduct', 'DailyReportController@LoadUpperCustomerWithForeginProuduct');

Route::post('locacustomerswithforignproudct', 'DailyReportController@LoadLocalCustomerWithforienProuduct');

Route::post('LoadLocalCustomer', 'DailyReportController@LoadLocalCustomer');

Route::post('CustomerCacheDeposit', 'DailyReportController@LoadCustomerCachDeposit');

Route::post('CustomerCheckDeposit', 'DailyReportController@LoadCustomerChekDeposit');

Route::post('BankDeposit', 'DailyReportController@LoadBankDepost');

Route::post('SupplierCashPayment', 'DailyReportController@LoadChshPayment');

Route::post('SuppliersCheckPayment', 'DailyReportController@LoadCheckPayment');

Route::post('Expenses', 'DailyReportController@LoadExpenses');

Route::post('getendoutdeal', 'DailyReportController@getendoutdeal');

Route::post('proudctsplade', 'ProductsCardController@LoadProuduct');

Route::post('/productcard/autocomplete', 'ProductsController@AutoCompleteProductName');

Route::resource('productscard', 'ProductsCardController');

Route::resource('expensesgroupreport', 'ExpensesGroupReportController');

Route::post('loadexpensestyps', 'ExpensesGroupReportController@loadExpensesType');

Route::post('loadExpensesGroup', 'ExpensesGroupReportController@loadDataExpensesGroupReort');

Route::post('loadExpensesTypeScreen', 'ExpensesController@loadExpensesTypeScreen');


Route::post('loadExpensesTypeScreen', 'ExpensesController@loadExpensesTypeScreen');
//========================================================taqarer=======================

Route::resource('/product', 'ProductsController');

Route::post('productautocomplete', 'ProductsController@AutoCompleteProductName');

Route::resource('/customer', 'CustomersController');

Route::post('autocompleteCustomer', 'CustomersController@AutoCompleteCustomerName');
//Route::post('/autocompleteCustomer','CustomersController@AutoCompleteCustomerName');

Route::resource('/supplier', 'SuppliersController');

Route::post('supplierautocomplete', 'SuppliersController@AutoCompleteSupplierName');

Route::post('dailyCashierclosed', 'DailyCashierController@DailyCashier');

Route::post('cashiermountNow', 'DailyCashierController@MountOFCashierNOw');

//################

//Route::post('/sales/container/autocomplete','SuppliersController@AutoCompleteSupplierName');
//Route::post('/container/supplier/{supplierid}', 'SalesController@GetSupplierContainers')->where(['id' => '[0-9]+']); // storing data
//Route::post('containersupplier/{supplierid}', 'SalesController@GetSupplierContainers');
##################

Route::resource('employee', 'EmployeesController');

Route::resource('custom', 'CustomsController');

Route::resource('cashier', 'CashiersController');

Route::resource('banks', 'BanksController');

Route::resource('driver', 'DriversController');

//$router->resource('driver','App\Http\Controllers\DriversController');

//Route::group(['prefix' => 'driver'] ,function(){
//    Route::post('/autocomplete','DriversController@AutoCompleteDriverName');
//});
Route::get('getallsuppliers','SuppliersController@getSuppleirs');

Route::post('driverautocomplete', 'DriversController@AutoCompleteDriverName');

Route::resource('currency', 'CurrenciesController');

Route::resource('carrying', 'CarryingController');

Route::resource('enddealbills', 'EndDealBillsController');

Route::resource('stockholder', 'StockHoldersController');

Route::resource('expensestypes', 'ExpensesTypesController');

Route::resource('customersdiscount', 'CustomersDiscountController');

Route::resource('suppliersdiscount', 'SuppliersDiscountController');

Route::resource('cashieropeningbalance', 'CashierOpeningBalanceController');

Route::resource('holderdrawal', 'HolderDrawalsController');

Route::resource('onecustomer', 'OneCustomerController');

Route::resource('supplieraccountstatement', 'SupplierAccountStatementController');

Route::resource('customeraccountstatement', 'CustomerAccountStatementController');

Route::resource('deferredbills', 'DeferredBillsController');

Route::resource('expenses', 'ExpensesController');

Route::resource('totalexpenses', 'TotalExpensesController');

Route::resource('onetotalexpenses', 'OneTotalExpensesController');

Route::resource('onetotalsuppliers', 'OneTotalSuppliersController');

//Route::resource('supplieropeningbalance','SupplierOpeningBalanceController');

Route::resource('supplieropeningbalance', 'SupplierOpeningBalanceController');

Route::resource('supplierbills', 'SupplierBillsController');

Route::resource('totalcustomersdata', 'TotalCustomersDataController');

Route::resource('totallocalcustomers', 'TotalLocalCustomer');

Route::resource('totaltravelcustomers', 'TotalTravelCustomerController');

Route::resource('localsupplerstotalcommition', 'LocalSupplersTotalCommition');

Route::resource('forignsupplerstotalcommition', 'ForignSupplersTotalCommition');

Route::resource('localsupplerstotalqlmia', 'LocalSupplersTotalQlmia');

/////////// Accounting \\\\\\\\\\\\\\\\\\\

Route::resource('cashdeposit', 'CashDepositController');

Route::resource('bankcashdeposit', 'BankCashDepositController');

Route::resource('checkdeposit', 'CheckDepositController');

Route::resource('cashpayment', 'CashPaymentsController');

Route::resource('checkpayment', 'CheckPaymentsController');
//-------------------------------------------------------------
Route::resource('cashiertransfer', 'CashierTransferController');

Route::resource('cashierbanktransfer', 'CashierBankTransferController');

Route::resource('bankopeningbalance', 'BankOpeningBalanceController');

Route::resource('bankcashiertransfer', 'BankCashierTransferController');
//-------------------------------------------------------------

Route::resource('addnotice', 'AddNoticesController');

Route::resource('discountnotice', 'DiscountNoticesController');

Route::resource('expensesgroup', 'ExpensesGroupController');

Route::resource('expensescp', 'ExpensesCpController');
/**
 * Integration
 */

Route::post('loadOneSupplierData', 'OneTotalSuppliersController@loadData');


Route::post('getsupplersvalue', 'TotalCustomersController@getTottalSupplers');

Route::post('loadData', 'TotalExpensesController@loadData');

Route::post('loadD', 'CashierOpeningBalanceController@loadData');

Route::post('loadD2', 'CashierOpeningBalanceController@loadData2');

Route::post('loadD3', 'CashierOpeningBalanceController@loadData3');

Route::post('loadD4', 'CashierOpeningBalanceController@loadData4');

Route::post('loadD5', 'CashierOpeningBalanceController@loadData5');

Route::post('loadD6', 'CashierOpeningBalanceController@loadData6');

Route::post('loadD7', 'CashierOpeningBalanceController@loadData7');

Route::post('loadD8', 'CashierOpeningBalanceController@loadData8');

Route::post('loadDa', 'SupplierAccountStatementController@loadData');

Route::post('loadDa2', 'SupplierAccountStatementController@loadData2');

Route::post('loadDa3', 'SupplierAccountStatementController@loadData3');

Route::post('loadDa4', 'SupplierAccountStatementController@loadData4');

Route::post('loadDa5', 'SupplierAccountStatementController@loadData5');

Route::post('loadDb', 'CustomerAccountStatementController@loadData');

Route::post('loadDb2', 'CustomerAccountStatementController@loadData2');

Route::post('loadDb3', 'CustomerAccountStatementController@loadData3');

Route::post('loadDb4', 'CustomerAccountStatementController@loadData4');

Route::post('loadDb5', 'CustomerAccountStatementController@loadData5');

Route::post('loadTotalCustomersData', 'TotalCustomersDataController@loadTotalCustomersData');

Route::post('loadTotalLocalCustomersData', 'TotalLocalCustomer@loadTotallocalCustomersData');

Route::post('loadTotalTravelCustomersData', 'TotalTravelCustomerController@loadTotalTravelCustomersData');

Route::post('combine', 'TotalCustomersDataController@combine');

Route::post('loadOneCustomerData', 'OneCustomerController@loadData');

Route::post('loadCustomersData', 'TotalCustomersController@loadData');

Route::post('loadOneData', 'OneTotalExpensesController@loadData');

Route::post('LoadData', 'SupplierBillsController@loadData');

Route::post('Loadlocalcommition', 'LocalSupplersTotalCommition@LoadlocalCommition');

Route::post('foriegnSupplers', 'ForignSupplersTotalCommition@LoadforignCommition');

Route::post('Loadqlmia', 'LocalSupplersTotalQlmia@LoadlocalQlmia');

Route::post('SuppliersOpeningBalanceStatment', 'SupplierBillsController@GetSupplierOpeningBalnceStatment');

Route::post('CustomersBillsLoadData', 'CustomersBillsController@loadBills');

Route::post('LoadCustomerRefund', 'CustomersBillsController@CustomerRefund');

Route::post('CustomerOpeningDate', 'CustomersBillsController@CustomerOpeningDate');

Route::post('OpeningDate', 'SupplierBillsController@OpeningDate');

Route::post('LoadPayments', 'SupplierBillsController@LoadPayments');

Route::post('Customerdeposit', 'CustomersBillsController@CustomerDeposit');

Route::post('custOpeningBalance', 'CustomersBillsController@CustomerOpeningBalance');

Route::post('LoadCustomerDiscount', 'CustomersBillsController@loadCustomerDiscount');

Route::post('getCustomerOpeningBalnce2', 'CustomersBillsController@GetCustomersOpeningBalnce');

Route::post('LoadRefund', 'SupplierBillsController@LoadRefund');

Route::post('LoadDiscount', 'SupplierBillsController@LoadDiscount');

Route::post('OpeningBalance', 'SupplierBillsController@OpeningBalance');

Route::post('loadforeignsupppliers', 'ForeignSuppliersController@loadforeignsupppliers');

Route::post('loadforeignContainers', 'ForeignSuppliersController@loadforeignContainers');

Route::post('loadserialContainers', 'ForeignSuppliersController@loadSerialContainers');

Route::post('GetCustomMount', 'ForeignSuppliersController@GetCustomMount');

Route::post('dBills', 'DeferredBillsController@loadBills');

Route::post('abordcustomerautocomplete', 'DeferredBillsController@AutoCompleteAbordCustomer');

Route::post('cachierautocomplete', 'CashiersController@AutoCompletetCashier');

Route::post('bankautocomplete', 'BanksController@AutoCompleteBank');

Route::post('gettotalvalueofopeningbalance', 'CustomerOpeningBalanceController@CombineCustomerOpeningBalance');
Route::post('gettotalvalueofopeningbalancesuppliers', 'SupplierOpeningBalanceController@CombineSupplierOpeningBalance');
/*Bank Report Route Start*/
Route::post('settlementCashdeposit', 'SettlementBankController@checkDeposit');
Route::post('settlementCashd', 'SettlementBankController@CashDeposit');
Route::post('settlementCashpayment', 'SettlementBankController@CheckPayment');
Route::post('settlementctb', 'SettlementBankController@TransfairCashierToBank');
Route::post('settlementbtc', 'SettlementBankController@TransfairBankToCashier');
Route::post('settlementbankopeningbalance', 'SettlementBankController@BankOepningBalnce');

/*Bank Report end */
/* Cashier Report Start*/

/*Customer*/
Route::post('settlementcashierreport', 'SettlementCashierController@LoadSettlement');

Route::post('loadcasherCustomer', 'SettlementCashierController@loadsttCustomrsdeposit');

Route::post('loadcasherCustomerRefund', 'SettlementCashierController@loadsttCustomrRefund');

/*Suppliers*/

Route::post('CashierSuppPayment', 'SettlementCashierController@loadsttSupplierPayment');

Route::post('CashierSuppRefund', 'SettlementCashierController@loadsttSupplierRefund');

Route::post('CashierFinal', 'SettlementCashierController@loadsttSupplierFinal');

/*Custom*/

Route::post('CustomPay', 'SettlementCashierController@loadsttCutompay');

Route::post('CustomRefund', 'SettlementCashierController@loadsttCutomRefund');

/*Transfair from Cashier to Cashier*/
Route::post('cashierTocashier', 'SettlementCashierController@loadsttTransCTC');
/*TransFair from Cashier to Bank*/
Route::post('cashierToBank', 'SettlementCashierController@loadsttTransCTB');
/*Transfir fro Bank to Cashier*/
Route::post('cshiertoBank', 'SettlementCashierController@loadsttTransBTC');
/* Cashier Report End */
Route::post('/foreignsupplier/autocomplete', 'ForeignSuppliersController@AutoCompleteForiegnSupplier');

Route::post('endoutdeal', 'DeferredBillsController@endoutdeal');

Route::post('loadendbills', 'EndDealBillsController@loadEndBills');

Route::post('loadBillsDetalis', 'EndDealBillsController@loadBillsDetalis');

/*Cashir Validation */
Route::post('cvalidation', 'CashierValidationController@cashiervalidation');

Route::post('cvalidationFromCashier', 'CashierValidationController@cashierFrom');

Route::post('cvalidationToCashier', 'CashierValidationController@Tocahier');

//Route::post('getdiscountandcryying', 'SalesController@getDisAndCry');

Route::get('/home', 'SalesController@index');
Route::get('/', 'SalesController@index');

Route::group(['prefix' => 'sales'], function () {

    Route::get('edit/{id}', 'SalesController@edit');

    Route::get('bill/edit/{id}', 'SalesController@edit'); // edit data
    /* just for test */
    Route::post('bill/Ctype/{salesid}', 'SalesController@getCType'); // get Ctype data

    Route::delete('/salesdetails/{serial}', 'SalesController@SalesDetailsDestroy');

    Route::delete('/bill/delete/{salesid}', 'SalesController@destroy'); // delete bill

    Route::delete('/bill/deleteBills/{salesid}', 'SalesController@DestroyMaster'); // delete all  bill Master And detalis

    Route::post('/bill/update/{salesid}', 'SalesController@updatebill'); // update data

    // Route::post('/bill/transfer/{salesid}', 'SalesController@TransferPro'); // Transfer pro

    Route::post('master/{salesid}/edit', 'SalesController@updatemaster'); // Updateing data

    Route::get('/endoutdeal', 'SalesController@endoutdeal');

    Route::post('/endoutdeal/save/{CryptedSalesID}', 'SalesController@SaveEndOutDeal');

    Route::get('/endoutdeal/edit', 'SalesController@EditEndoutDeal');

    Route::put('/endoutdeal/update/{salesid}', 'SalesController@UpdateEndoutDeal');

//    Route::put('/endoutdeal/getdiscount/{salesid}', 'SalesController@getDisAndCry');

//    Route::post('getrefs', 'SalesController@GetRefsForDeal');
    Route::post('sales/endoutdeal/getrefs', 'SalesController@GetRefsForDeal');

    Route::post('/store', 'SalesController@store');

    Route::post('/update/{serial}', 'SalesController@update')->where(['id' => '[0-9]+']); // storing data

//    Route::post('/getsuppliercontainers/{supplierid}', 'SalesController@GetSupplierContainers')->where(['id' => '[0-9]+']); // storing data

});

Route::post('salesdetails/{serial}', 'SalesController@getsalesdetailsById');

Route::post('salesdetailscustomer', 'SalesController@getcustomerdetails');

Route::post('Customer', 'SalesController@getCustomerType');

Route::post('getDrivers', 'SalesController@getDriver');

Route::group(['prefix' => 'container'], function () {
    Route::post('getmaxcontainer', 'ContainerController@GetMaxContainer');
    Route::post('{container}/changeCstatus', 'ContainerController@ChangeContainerStatus');
    Route::post('{container}/getCCustomsandProducts', 'ContainerController@GetContainerProductsAndCustoms');
    Route::post('{container}/details', 'ContainerController@ContainerDetails');
    Route::post('supplier', 'ContainerController@GetSupplierContainers');

});

Route::post('suppliercontainer', 'ContainerController@GetSupplierContainers');
Route::resource('container', 'ContainerController');

//Route::group(['prefix' => 'custom'] ,function(){
//    Route::post('autocomplete', 'CustomsController@AutoCompleteCustomsName');
//});

//Route::post('autocomplete', 'CustomsController@AutoCompleteCustomsName');
Route::post('autocomplete', 'CustomsController@AutoCompleteCustomsName');

Route::resource('containercustoms', 'ContainerCustomsController', ['only' => ['store', 'destroy', 'edit', 'update']]);
//Route::resource('cntainercustoms', 'ContainerCustomsController' , ['only' => ['store' , 'destroy' ,'edit' ,'update'] ] ) ;

Route::resource('customerscp', 'CustomersCpController');

Route::resource('customsreport', 'CustomsReportController');

Route::resource('loadCustompayment', 'CustomsReportController@GetCustomsPayment');
Route::resource('customefinalstatment', 'CustomsReportController@GetCustomsOpeinigStatment');
Route::resource('customcontinaer', 'CustomsReportController@getVlueCustomContiner');
Route::resource('CustomrefundData', 'CustomsReportController@GetCustomsRefund');

Route::resource('customopeningbalance', 'CustomOpeningBalanceController');

Route::resource('customrefund', 'CustomRefundController');

Route::resource('customeropeningbalance', 'CustomerOpeningBalanceController');


Route::resource('customepayment', 'CustomePaymentController');

Route::resource('customerrefund', 'CustomerRefundController');

Route::resource('supplierscp', 'SuppliersCpController');

Route::resource('customecp', 'CustomecpController');

Route::resource('totalcustomers', 'TotalCustomersController');

Route::resource('supplierrefund', 'SupplierRefundController');

Route::resource('foreignsuppliers', 'ForeignSuppliersController');

Route::resource('supplieraccountstatement', 'SupplierAccountStatementController');

Route::resource('settlementsuppliersaccount', 'SettlementSuppliersAccountController');

Route::resource('settlementcashier', 'SettlementCashierController');

Route::resource('settlementbank', 'SettlementBankController');

Route::resource('customersbills', 'CustomersBillsController');

Route::resource('abordcustomerbills', 'AbordCustomersBillsController');

Route::resource('loadendbillsabourdcustomer', 'AbordCustomersBillsController@loadEndBillsAbordCustomer');

Route::post('localnum','ContainerController@ContainerMaxLocalNum');
