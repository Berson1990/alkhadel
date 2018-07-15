<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
/*Increses Cashiers*/
use App\Http\Models\BankCashierTransfer;
use App\Http\Models\CashDeposit;
use App\Http\Models\CashierBankTransfer;
use App\Http\Models\CashierOpeningBalance;
use App\Http\Models\CashierTransfer;

/* Decrise Cashier */
use App\Http\Models\CashPayments;
use App\Http\Models\CustomerRefund;
use App\Http\Models\CustomRefund;
use App\Http\Models\SupplierRefund;
use DB;
use Request;

class CashierValidationController extends Controller {

	// CashierID

	public function __construct() {
		/*increse*/

		$this->cashdeposit = new CashDeposit();
		$this->cashieropeningbalance = new CashierOpeningBalance();
		$this->supplierrefund = new SupplierRefund();
		$this->bankcashiertransfer = new BankCashierTransfer();
		$this->cashiertransfer = new CashierTransfer();
		$this->customrefund = new CustomRefund();

		/*decrise*/
		$this->customerrefund = new CustomerRefund();
		$this->cashpayments = new CashPayments();
		$this->cashierbanktransfer = new CashierBankTransfer();

	}

	public function cashiervalidation() {

		$input = Request::all();

		$CashierName = $input["CashierID"];
		// dd($CashierName);

/*just try*/
/*
1-COB => Cashier opening balance
2-CD  => CashDeposit
3-BCT => Bank Cashier Tranfaier
4-SPR => Supplier  Refund
5-CUR =>  Custom refund
6-CP  => Cashpayment
7-CR  => Cutomer Refund
8-CBT =>Cashier Bank Transfair
9-CT  => Cashier Transfair
9-CT2  => Cashier Transfair2
10-Ex =>Expenses
11-CUSP =>CustomPayment
 */


$output = DB::select("select 

	IFNULL(tblcashieropeningbalance.Mount, 0) as COB,

  (Select tblcashiers.CashierName  from 
  tblcashiers WHERE tblcashiers.CashierID = tblcashieropeningbalance.CashierID ) as  CashierName ,
 
 (Select SUM(IFNULL(tblcashdeposit.Mount, 0))  from 
  tblcashdeposit WHERE tblcashdeposit.CashierID = tblcashieropeningbalance.CashierID ) as  CD ,
 
 (Select SUM(IFNULL(tblbankcashiertransfer.Mount, 0))  from 
  tblbankcashiertransfer WHERE tblbankcashiertransfer.CashierID = tblcashieropeningbalance.CashierID ) as  BCT,

  (Select SUM(IFNULL(tblsupplierrefund.Refund, 0))  from 
  tblsupplierrefund WHERE tblsupplierrefund.CashierID = tblcashieropeningbalance.CashierID ) as  SPR,

   (Select SUM(IFNULL(tblcustomrefund.Refund, 0))  from 
  tblcustomrefund WHERE tblcustomrefund.CashierID = tblcashieropeningbalance.CashierID ) as  CUR,

   (Select SUM(IFNULL(tblcustomrefund.Refund, 0))  from 
  tblcustomrefund WHERE tblcustomrefund.CashierID = tblcashieropeningbalance.CashierID ) as  CUR,
  
 (Select SUM(IFNULL(tblcashpayments.Mount, 0))  from 
  tblcashpayments WHERE tblcashpayments.CashierID = tblcashieropeningbalance.CashierID) as  CP,
  
  
 (Select SUM(IFNULL(tblcashiertransfer.Mount, 0))  from 
  tblcashiertransfer WHERE tblcashiertransfer.FromCashierID = tblcashieropeningbalance.CashierID) as  CT,
  
 (Select SUM(IFNULL(tblcashiertransfer.Mount, 0))  from 
  tblcashiertransfer WHERE tblcashiertransfer.ToCashierID = tblcashieropeningbalance.CashierID) as  CT2,

 (Select SUM(IFNULL(tblcustomerrefund.Refund, 0))  from 
  tblcustomerrefund WHERE tblcustomerrefund.CashierID = tblcashieropeningbalance.CashierID) as  CR,


 (Select SUM(IFNULL(tblcashierbanktransfer.Mount, 0))  from 
  tblcashierbanktransfer WHERE tblcashierbanktransfer.CashierID = tblcashieropeningbalance.CashierID) as  CBT,

 (Select SUM(IFNULL(tblexpenses.Mount, 0))  from 
  tblexpenses WHERE tblexpenses.CashierID = tblcashieropeningbalance.CashierID) as  EX,

 (Select SUM(IFNULL(tblcustomespayment.Mount, 0))  from 
  tblcustomespayment WHERE tblcustomespayment.CashierID = tblcashieropeningbalance.CashierID) as  CUSP

from tblcashieropeningbalance
where tblcashieropeningbalance.CashierID = '$CashierName'");

// dd($output);

// 		$output = DB::select(" select DISTINCT
// tblcashiers.CashierName,
// IFNULL(tblcashieropeningbalance.Mount, 0) as COB,

// SUM(IFNULL(tblcashdeposit.Mount, 0)) as CD,

// SUM(IFNULL(tblbankcashiertransfer.Mount, 0)) as BCT,

// SUM(IFNULL(tblsupplierrefund.Refund, 0)) as SPR ,

// SUM(IFNULL(tblcustomrefund.Refund , 0)) as CUR,

// SUM(IFNULL(tblcashpayments.Mount, 0)) as CP,

// SUM(IFNULL(tblcashiertransfer.Mount, 0)) as CT,

// SUM(IFNULL(tblcashiertransfer.Mount, 0)) as CT2,

// SUM(IFNULL(tblcustomerrefund.Refund, 0)) as CR,

// SUM(IFNULL(tblcashierbanktransfer.Mount, 0))as CBT,

// SUM(IFNULL(tblexpenses.Mount, 0))as EX,

// SUM(IFNULL(tblcustomespayment.Mount, 0))as CUSP

// from tblcashieropeningbalance
// LEFT JOIN tblcashdeposit on tblcashieropeningbalance.CashierID = tblcashdeposit.CashierID
// LEFT JOIN tblbankcashiertransfer on tblcashieropeningbalance.CashierID = tblbankcashiertransfer.CashierID
// LEFT JOIN tblsupplierrefund  on tblcashieropeningbalance.CashierID = tblsupplierrefund.CashierID
// LEFT JOIN tblcustomrefund  on tblcashieropeningbalance.CashierID = tblcustomrefund.CashierID
// LEFT JOIN tblcashpayments  on tblcashieropeningbalance.CashierID = tblcashpayments.CashierID
// LEFT JOIN tblcustomerrefund  on tblcashieropeningbalance.CashierID = tblcustomerrefund.CashierID
// LEFT JOIN tblcashierbanktransfer  on tblcashieropeningbalance.CashierID = tblcashierbanktransfer.CashierID
// LEFT JOIN tblcashiertransfer  on tblcashieropeningbalance.CashierID = tblcashiertransfer.FromCashierID
// LEFT JOIN tblcashiertransfer as tblcashiertransfer2 on tblcashieropeningbalance.CashierID = tblcashiertransfer2.ToCashierID
// LEFT JOIN tblcashiers as tblcashiers on tblcashieropeningbalance.CashierID = tblcashiers.CashierID
// LEFT JOIN tblexpenses as tblexpenses on tblcashieropeningbalance.CashierID = tblexpenses.CashierID
// LEFT JOIN tblcustomespayment as tblcustomespayment on tblcashieropeningbalance.CashierID = tblcustomespayment.CashierID
//  where tblcashieropeningbalance.CashierID ='$CashierName'");
// 		dd($output);
// dd($output);
		return Response()->json($output);

	} //end of function

/*function to cashier transfaier */
	public function cashierFrom() {

		$input = Request::all();

		$CashierName = $input["FromCashierID"];
		// dd($CashierName);

/*just try*/
/*
1-COB => Cashier opening balance
2-CD  => CashDeposit
3-BCT => Bank Cashier Tranfaier
4-SPR => Supplier  Refund
5-CUR =>  Custom refund
6-CP  => Cashpayment
7-CR  => Cutomer Refund
8-CBT =>Cashier Bank Transfair
9-CT  => Cashier Transfair
9-CT2  => Cashier Transfair2
10-Ex =>Expenses
11-CUSP =>CustomPayment
 */
// 		$output = DB::select(" select
// tblcashiers.CashierName,
// IFNULL(tblcashieropeningbalance.Mount, 0) as COB,
// SUM(IFNULL(tblcashdeposit.Mount, 0)) as CD,
// SUM(IFNULL(tblbankcashiertransfer.Mount, 0)) as BCT,
// SUM(IFNULL(tblsupplierrefund.Refund, 0)) as SPR ,
// SUM(IFNULL(tblcustomrefund.Refund , 0)) as CUR,
// SUM(IFNULL(tblcashiertransfer.Mount, 0)) as CT2,
// SUM(IFNULL(tblcashpayments.Mount, 0)) as CP,
// SUM(IFNULL(tblcustomerrefund.Refund, 0)) as CR,
// SUM(IFNULL(tblcashierbanktransfer.Mount, 0))as CBT,
// SUM(IFNULL(tblexpenses.Mount, 0))as EX,
// SUM(IFNULL(tblcustomespayment.Mount, 0))as CUSP
// from tblcashieropeningbalance
// LEFT JOIN tblcashdeposit on tblcashieropeningbalance.CashierID = tblcashdeposit.CashierID
// LEFT JOIN tblbankcashiertransfer on tblcashieropeningbalance.CashierID = tblbankcashiertransfer.CashierID
// LEFT JOIN tblsupplierrefund  on tblcashieropeningbalance.CashierID = tblsupplierrefund.CashierID
// LEFT JOIN tblcustomrefund  on tblcashieropeningbalance.CashierID = tblcustomrefund.CashierID
// LEFT JOIN tblcashpayments  on tblcashieropeningbalance.CashierID = tblcashpayments.CashierID
// LEFT JOIN tblcustomerrefund  on tblcashieropeningbalance.CashierID = tblcustomerrefund.CashierID
// LEFT JOIN tblcashierbanktransfer  on tblcashieropeningbalance.CashierID = tblcashierbanktransfer.CashierID
// LEFT JOIN tblcashiertransfer  on tblcashieropeningbalance.CashierID = tblcashiertransfer.FromCashierID
// LEFT JOIN tblcashiertransfer as tblcashiertransfer2 on tblcashieropeningbalance.CashierID = tblcashiertransfer2.ToCashierID
// LEFT JOIN tblcashiers as tblcashiers on tblcashieropeningbalance.CashierID = tblcashiers.CashierID
// LEFT JOIN tblexpenses as tblexpenses on tblcashieropeningbalance.CashierID = tblexpenses.CashierID
// LEFT JOIN tblcustomespayment as tblcustomespayment on tblcashieropeningbalance.CashierID = tblcustomespayment.CashierID
//  where tblcashieropeningbalance.CashierID ='$CashierName'");
		// dd($output);
      
   $output = DB::select("select 

  IFNULL(tblcashieropeningbalance.Mount, 0) as COB,

  (Select tblcashiers.CashierName  from 
  tblcashiers WHERE tblcashiers.CashierID = tblcashieropeningbalance.CashierID ) as  CashierName ,
 
 (Select SUM(IFNULL(tblcashdeposit.Mount, 0))  from 
  tblcashdeposit WHERE tblcashdeposit.CashierID = tblcashieropeningbalance.CashierID ) as  CD ,
 
 (Select SUM(IFNULL(tblbankcashiertransfer.Mount, 0))  from 
  tblbankcashiertransfer WHERE tblbankcashiertransfer.CashierID = tblcashieropeningbalance.CashierID ) as  BCT,

  (Select SUM(IFNULL(tblsupplierrefund.Refund, 0))  from 
  tblsupplierrefund WHERE tblsupplierrefund.CashierID = tblcashieropeningbalance.CashierID ) as  SPR,

   (Select SUM(IFNULL(tblcustomrefund.Refund, 0))  from 
  tblcustomrefund WHERE tblcustomrefund.CashierID = tblcashieropeningbalance.CashierID ) as  CUR,

   (Select SUM(IFNULL(tblcustomrefund.Refund, 0))  from 
  tblcustomrefund WHERE tblcustomrefund.CashierID = tblcashieropeningbalance.CashierID ) as  CUR,
  
 (Select SUM(IFNULL(tblcashpayments.Mount, 0))  from 
  tblcashpayments WHERE tblcashpayments.CashierID = tblcashieropeningbalance.CashierID) as  CP,
  
 (Select SUM(IFNULL(tblcashiertransfer.Mount, 0))  from 
  tblcashiertransfer WHERE tblcashiertransfer.FromCashierID = tblcashieropeningbalance.CashierID) as  CT,
 
 (Select SUM(IFNULL(tblcashiertransfer.Mount, 0))  from 
  tblcashiertransfer WHERE tblcashiertransfer.ToCashierID = tblcashieropeningbalance.CashierID) as  CT2,
  
 (Select SUM(IFNULL(tblcustomerrefund.Refund, 0))  from 
  tblcustomerrefund WHERE tblcustomerrefund.CashierID = tblcashieropeningbalance.CashierID) as  CR,


 (Select SUM(IFNULL(tblcashierbanktransfer.Mount, 0))  from 
  tblcashierbanktransfer WHERE tblcashierbanktransfer.CashierID = tblcashieropeningbalance.CashierID) as  CBT,

 (Select SUM(IFNULL(tblexpenses.Mount, 0))  from 
  tblexpenses WHERE tblexpenses.CashierID = tblcashieropeningbalance.CashierID) as  EX,

 (Select SUM(IFNULL(tblcustomespayment.Mount, 0))  from 
  tblcustomespayment WHERE tblcustomespayment.CashierID = tblcashieropeningbalance.CashierID) as  CUSP

from tblcashieropeningbalance
where tblcashieropeningbalance.CashierID = '$CashierName'");


/*

   (Select SUM(IFNULL(tblcashiertransfer.Mount, 0))  from 
  tblcashiertransfer WHERE tblcashiertransfer.ToCashierID = tblcashieropeningbalance.CashierID) as  CT2,


*/
		return Response()->json($output);

	} //end of function

/*function to cashier transfaier */
	public function Tocahier() {

		$input = Request::all();

		$CashierName = $input["ToCashierID"];
		// dd($CashierName);

/*just try*/
/*
1-COB => Cashier opening balance
2-CD  => CashDeposit
3-BCT => Bank Cashier Tranfaier
4-SPR => Supplier  Refund
5-CUR =>  Custom refund
6-CP  => Cashpayment
7-CR  => Cutomer Refund
8-CBT =>Cashier Bank Transfair
9-CT  => Cashier Transfair
9-CT2  => Cashier Transfair2
10-Ex =>Expenses
11-CUSP =>CustomPayment
 */
// 		$output = DB::select("select
// tblcashiers.CashierName,
// IFNULL(tblcashieropeningbalance.Mount, 0) as COB,
// SUM(IFNULL(tblcashdeposit.Mount, 0)) as CD,
// SUM(IFNULL(tblbankcashiertransfer.Mount, 0)) as BCT,
// SUM(IFNULL(tblsupplierrefund.Refund, 0)) as SPR ,
// SUM(IFNULL(tblcustomrefund.Refund , 0)) as CUR,
// SUM(IFNULL(CT.Mount, 0)) as CT,
// SUM(IFNULL(CT2.Mount, 0)) as CT2,
// SUM(IFNULL(tblcashpayments.Mount, 0)) as CP,
// SUM(IFNULL(tblcustomerrefund.Refund, 0)) as CR,
// SUM(IFNULL(tblcashierbanktransfer.Mount, 0))as CBT,
// SUM(IFNULL(tblexpenses.Mount, 0))as EX,
// SUM(IFNULL(tblcustomespayment.Mount, 0))as CUSP
// from tblcashieropeningbalance
// LEFT JOIN tblcashdeposit on tblcashieropeningbalance.CashierID = tblcashdeposit.CashierID
// LEFT JOIN tblbankcashiertransfer on tblcashieropeningbalance.CashierID = tblbankcashiertransfer.CashierID
// LEFT JOIN tblsupplierrefund  on tblcashieropeningbalance.CashierID = tblsupplierrefund.CashierID
// LEFT JOIN tblcustomrefund  on tblcashieropeningbalance.CashierID = tblcustomrefund.CashierID
// LEFT JOIN tblcashpayments  on tblcashieropeningbalance.CashierID = tblcashpayments.CashierID
// LEFT JOIN tblcustomerrefund  on tblcashieropeningbalance.CashierID = tblcustomerrefund.CashierID
// LEFT JOIN tblcashierbanktransfer  on tblcashieropeningbalance.CashierID = tblcashierbanktransfer.CashierID
// LEFT JOIN tblcashiertransfer as CT  on tblcashieropeningbalance.CashierID = CT.FromCashierID
// LEFT JOIN tblcashiertransfer as CT2 on tblcashieropeningbalance.CashierID = CT2.ToCashierID
// LEFT JOIN tblcashiers as tblcashiers on tblcashieropeningbalance.CashierID = tblcashiers.CashierID
// LEFT JOIN tblexpenses as tblexpenses on tblcashieropeningbalance.CashierID = tblexpenses.CashierID
// LEFT JOIN tblcustomespayment as tblcustomespayment on tblcashieropeningbalance.CashierID = tblcustomespayment.CashierID
//  where tblcashieropeningbalance.CashierID ='$CashierName'");
		// dd($output);
       $output = DB::select("select 

	IFNULL(tblcashieropeningbalance.Mount, 0) as COB,

  (Select tblcashiers.CashierName  from 
  tblcashiers WHERE tblcashiers.CashierID = tblcashieropeningbalance.CashierID ) as  CashierName ,
 
 (Select SUM(IFNULL(tblcashdeposit.Mount, 0))  from 
  tblcashdeposit WHERE tblcashdeposit.CashierID = tblcashieropeningbalance.CashierID ) as  CD ,
 
 (Select SUM(IFNULL(tblbankcashiertransfer.Mount, 0))  from 
  tblbankcashiertransfer WHERE tblbankcashiertransfer.CashierID = tblcashieropeningbalance.CashierID ) as  BCT,

  (Select SUM(IFNULL(tblsupplierrefund.Refund, 0))  from 
  tblsupplierrefund WHERE tblsupplierrefund.CashierID = tblcashieropeningbalance.CashierID ) as  SPR,

   (Select SUM(IFNULL(tblcustomrefund.Refund, 0))  from 
  tblcustomrefund WHERE tblcustomrefund.CashierID = tblcashieropeningbalance.CashierID ) as  CUR,

   (Select SUM(IFNULL(tblcustomrefund.Refund, 0))  from 
  tblcustomrefund WHERE tblcustomrefund.CashierID = tblcashieropeningbalance.CashierID ) as  CUR,
  
 (Select SUM(IFNULL(tblcashpayments.Mount, 0))  from 
  tblcashpayments WHERE tblcashpayments.CashierID = tblcashieropeningbalance.CashierID) as  CP,
  
  
 (Select SUM(IFNULL(tblcashiertransfer.Mount, 0))  from 
  tblcashiertransfer WHERE tblcashiertransfer.FromCashierID = tblcashieropeningbalance.CashierID) as  CT,
  
 (Select SUM(IFNULL(tblcashiertransfer.Mount, 0))  from 
  tblcashiertransfer WHERE tblcashiertransfer.ToCashierID = tblcashieropeningbalance.CashierID) as  CT2,

 (Select SUM(IFNULL(tblcustomerrefund.Refund, 0))  from 
  tblcustomerrefund WHERE tblcustomerrefund.CashierID = tblcashieropeningbalance.CashierID) as  CR,


 (Select SUM(IFNULL(tblcashierbanktransfer.Mount, 0))  from 
  tblcashierbanktransfer WHERE tblcashierbanktransfer.CashierID = tblcashieropeningbalance.CashierID) as  CBT,

 (Select SUM(IFNULL(tblexpenses.Mount, 0))  from 
  tblexpenses WHERE tblexpenses.CashierID = tblcashieropeningbalance.CashierID) as  EX,

 (Select SUM(IFNULL(tblcustomespayment.Mount, 0))  from 
  tblcustomespayment WHERE tblcustomespayment.CashierID = tblcashieropeningbalance.CashierID) as  CUSP

from tblcashieropeningbalance
where tblcashieropeningbalance.CashierID = '$CashierName'");
     
		return Response()->json($output);

	} //end of function

} //end of class



?>