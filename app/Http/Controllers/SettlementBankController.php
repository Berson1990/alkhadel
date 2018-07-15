<?php namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Models\Cashiers; /*done*/
use App\Http\Models\Customers;/*done*/
use App\Http\Models\Suppliers;/*done*/
use App\Http\Models\Banks;/*done*/
use App\Http\Models\BankCashierTransfer;/*done*/
use App\Http\Models\CashierBankTransfer;/*done*/
use App\Http\Models\BankOpeningBalance;/*done*/
use App\Http\Models\Currencies;/*done*/
use App\Http\Models\CheckDeposit;/*done*/
use App\Http\Models\BankCashDeposit;/*done*/
use App\Http\Models\CheckPayments;/*done*/
use Carbon\Carbon;
use DB;
use Request;
use Response;

class SettlementBankController extends Controller {

	public function index() {
		

		return view('settlementbank.settlementbank');
		
	}


	public function __construct() {

			$this->cashierBankTransfer = new CashierBankTransfer();
		    $this->bankCashierTransfer = new BankCashierTransfer();
	        $this->suppliers = new Suppliers();
		    $this->customers = new Customers();
		    $this->bankOpeningBalance = new BankOpeningBalance();
		    $this->currencies = new Currencies();
		    $this->checkDeposit = new CheckDeposit();
		    $this->bankCashDeposit = new BankCashDeposit();
		    $this->checkPayments = new CheckPayments();
		    $this->banks = new Banks();
		    $this->cashiers = new Cashiers();
  
	}

function checkDeposit(){

$input = Request::all();
		$input = (array) $input;
		$banks = $input['BankID'];
		$from = $input['FromTransDate'];
		$to = $input['ToTransDate'];
$from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
		$to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

		$output = $this->banks
			->Leftjoin($this->checkDeposit->getTable(), $this->banks->getTable() . '.BankID', '=', $this->checkDeposit->getTable() . '.BankID')
			->Leftjoin($this->customers->getTable(), $this->checkDeposit->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
			->where($this->checkDeposit->getTable() . '.TransDate', '>=', $from)
			->where($this->checkDeposit->getTable() . '.TransDate', '<=', $to)
			->where($this->banks->getTable() . '.BankID', $banks)
			->get();

// dd($output);


	return Response()->json($output);

	
}
function CashDeposit(){
$input = Request::all();
		$input = (array) $input;
			// dd($input);
		$banks = $input['BankID'];
		$from = $input['FromTransDate'];
		$to = $input['ToTransDate'];

$from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
		$to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

	$output = $this->banks
			->Leftjoin($this->bankCashDeposit->getTable(), $this->banks->getTable() . '.BankID', '=', $this->bankCashDeposit->getTable() . '.BankID')
			->Leftjoin($this->customers->getTable(), $this->bankCashDeposit->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
			->where($this->bankCashDeposit->getTable() . '.TransDate', '>=', $from)
			->where($this->bankCashDeposit->getTable() . '.TransDate', '<=', $to)
			->where($this->banks->getTable() . '.BankID', $banks)
			->get();

// dd($output);


	return Response()->json($output);




	
}
function CheckPayment(){
$input = Request::all();
		$input = (array) $input;
			// dd($input);
		$banks = $input['BankID'];
		$from = $input['FromTransDate'];
		$to = $input['ToTransDate'];
$from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
		$to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

	$output = $this->banks
			->Leftjoin($this->checkPayments->getTable(), $this->banks->getTable() . '.BankID', '=', $this->checkPayments->getTable() . '.BankID')
			->Leftjoin($this->suppliers->getTable(), $this->checkPayments->getTable() . '.SupplierID', '=', $this->suppliers->getTable() . '.SupplierID')
			->where($this->checkPayments->getTable() . '.TransDate', '>=', $from)
			->where($this->checkPayments->getTable() . '.TransDate', '<=', $to)
			->where($this->banks->getTable() . '.BankID', $banks)
			->get();

// dd($output);


	return Response()->json($output);
	
}

function TransfairCashierToBank(){
$input = Request::all();
		$input = (array) $input;
			// dd($input);
		$banks = $input['BankID'];
		$from = $input['FromTransDate'];
		$to = $input['ToTransDate'];

$from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
		$to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

	$output = $this->banks
			->Leftjoin($this->cashierBankTransfer->getTable(), $this->banks->getTable() . '.BankID', '=', $this->cashierBankTransfer->getTable() . '.BankID')
			->Leftjoin($this->cashiers->getTable(), $this->cashierBankTransfer->getTable() . '.CashierID', '=', $this->cashiers->getTable() . '.CashierID')
			->where($this->cashierBankTransfer->getTable() . '.TransDate', '>=', $from)
			->where($this->cashierBankTransfer->getTable() . '.TransDate', '<=', $to)
			->where($this->banks->getTable() . '.BankID', $banks)
			->get();


// dd($output);

	return Response()->json($output);
	
}

function TransfairBankToCashier(){

$input = Request::all();
		$input = (array) $input;
			// dd($input);
		$banks = $input['BankID'];
		$from = $input['FromTransDate'];
		$to = $input['ToTransDate'];

$from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
		$to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

	$output = $this->banks
	        ->Leftjoin($this->bankCashierTransfer->getTable(), $this->banks->getTable() . '.BankID', '=', $this->bankCashierTransfer->getTable() . '.BankID')
			->Leftjoin($this->cashiers->getTable(), $this->bankCashierTransfer->getTable() . '.CashierID', '=', $this->cashiers->getTable() . '.CashierID')
			->where($this->bankCashierTransfer->getTable() . '.TransDate', '>=', $from)
			->where($this->bankCashierTransfer->getTable() . '.TransDate', '<=', $to)
			->where($this->banks->getTable() . '.BankID', $banks)
			->get();

		// dd($output);
		return Response()->json($output);



	
}
function BankOepningBalnce(){

$input = Request::all();
		$input = (array) $input;
			// dd($input);
		$banks = $input['BankID'];
		$from = $input['FromTransDate'];
		$to = $input['ToTransDate'];

$from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
		$to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

// $output = DB::select("select tblbanks.BankName,
// Sum(IFNULL(tblbankopeningbalance.Mount ,0)) as BOB,
// Sum(IFNULL(tblbankcashiertransfer.Mount ,0)) as CTB,
// Sum(IFNULL(tblcheckdeposit.Mount ,0)) as CKD,
// Sum(IFNULL(tblbankcashdeposit.Mount ,0)) as CD,
// Sum(IFNULL(tblcashpayments.Mount ,0)) as CP,
// Sum(IFNULL(tblcashierbanktransfer.Mount ,0)) as BTC
// from tblbanks
// LEFT JOIN tblbankopeningbalance on tblbanks.BankID = tblbankopeningbalance.BankID
// LEFT JOIN tblbankcashiertransfer on tblbanks.BankID = tblbankcashiertransfer.BankID
// LEFT JOIN tblcheckdeposit  on tblbanks.BankID = tblcheckdeposit.BankID
// LEFT JOIN tblbankcashdeposit  on tblbanks.BankID = tblbankcashdeposit.BankID
// LEFT JOIN tblcashpayments  on tblbanks.BankID = tblcashpayments.BankID
// LEFT JOIN tblcashierbanktransfer  on tblbanks.BankID = tblcashierbanktransfer.BankID

// where tblbanks.BankID = '$banks'

// and tblbankopeningbalance.TransDate >='$from'
// and tblbankopeningbalance.TransDate <='$to'

// and tblbankcashiertransfer.TransDate >='$from'
// and tblbankcashiertransfer.TransDate <='$to'

// and tblcheckdeposit.TransDate >='$from'
// and tblcheckdeposit.TransDate <='$to'

// and tblbankcashdeposit.TransDate >='$from'
// and tblbankcashdeposit.TransDate <='$to'

// and tblcashpayments.TransDate >='$from'
// and tblcashpayments.TransDate <='$to'

// and tblcashierbanktransfer.TransDate >='$from'
// and tblcashierbanktransfer.TransDate <='$to'

// ");
$output = DB::select("select * from tblbankopeningbalance where BankID='$banks'");

// dd($output);

return Response()->json($output);
}




}//end of class 

?>	