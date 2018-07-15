<?php namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Response;
use App\Http\Models\BankCashierTransfer;
use App\Http\Models\CashDeposit;
use App\Http\Models\CashierBankTransfer;
use App\Http\Models\CashierOpeningBalance;
use App\Http\Models\Cashiers;
use App\Http\Models\CashierTransfer;
use App\Http\Models\CashPayments;
use App\Http\Models\CustomePayment;
use App\Http\Models\CustomerRefund;
use App\Http\Models\Customers;
use App\Http\Models\CustomRefund;
use App\Http\Models\Customs;
use App\Http\Models\Expenses;
use App\Http\Models\ExpensesGroup;
use App\Http\Models\ExpensesTypes;
use App\Http\Models\SettlementSuppliersAccount;
use App\Http\Models\SupplierRefund;
use App\Http\Models\Suppliers;
use App\Http\Models\Banks;
use Carbon\Carbon;
use DB;
use Request;
use Response;

class SettlementCashierController extends Controller {

	public function index() {
		// $supplierbills = Suppliers::all();
		return view('settlementcashier.settlementcashier');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function __construct() {
		$this->cashieropeningbalance = new CashierOpeningBalance();
		$this->cashiers = new Cashiers();
		$this->expenses = new Expenses();
		$this->expensestypes = new ExpensesTypes();
		$this->expensesGroup = new ExpensesGroup();
		$this->cashDeposit = new CashDeposit();
		$this->customerRefund = new CustomerRefund();
		$this->cashPayments = new CashPayments();
		$this->supplierRefund = new SupplierRefund();
		$this->customePayment = new CustomePayment();
		$this->customRefund = new CustomRefund();
		$this->customerRefund = new CustomerRefund();
		$this->cashierBankTransfer = new CashierBankTransfer();
		$this->bankCashierTransfer = new BankCashierTransfer();
		$this->cashierOpeningBalance = new CashierOpeningBalance();
		$this->customs = new Customs();
		$this->suppliers = new Suppliers();
		$this->customers = new Customers();
		$this->settlementSuppliersAccount = new SettlementSuppliersAccount();
		$this->cashierTransfer = new CashierTransfer();
		$this->banks = new Banks();
	}

	public function LoadSettlement() {

		$input = Request::all();
		$input = (array) $input;
//			dd($input);
		$cashier = $input['CashierID'];
		$from = $input['FromTransDate'];
		$to = $input['ToTransDate'];

//       dd($from);
		$from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
		$to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

		$output = DB::select("select  tblexpenses.TransDate ,tblcashieropeningbalance.TransDate as trans ,tblexpenses.Mount as mountex, tblcashieropeningbalance.Mount ,ExpenseTypeName,CashierName from tblcashieropeningbalance LEFT  JOIN tblexpenses
	 on tblcashieropeningbalance.CashierID = tblexpenses.CashierID
	LEFT  JOIN tblcashiers
	 on tblcashieropeningbalance.CashierID = tblcashiers.CashierID
	LEFT JOIN  tblexpensestypes
	  on tblexpenses.ExpenseTypeID = tblexpensestypes.ExpenseTypeID
	  WHERE tblcashieropeningbalance.TransDate >= '$from'
		AND   tblcashieropeningbalance.TransDate <= '$to'
		AND tblcashieropeningbalance.CashierID ='$cashier'");

		 // dd($output);
		return Response()->json($output);

	} // end of function

	public function loadsttCustomrsdeposit() {

		$input = Request::all();
		$input = (array) $input;
//			dd($input);
		$cashier = $input['CashierID'];
		$from = $input['FromTransDate'];
		$to = $input['ToTransDate'];

//       dd($from);
		$from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
		$to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

		// 	$output = DB::select("select * from `tblCashiers`
		// left join `tblCustomerRefund` on `tblCashiers`.`CashierID` = `tblCustomerRefund`.`CashierID`
		//  left join `tblCashDeposit` on `tblCashiers`.`CashierID` = `tblCashDeposit`.`CashierID`
		//  left join `tblCustomers` on `tblCustomerRefund`.`CustomerID` = `tblCustomers`.`CustomerID`
		//  left join `tblCustomers` as Customers on `tblCashDeposit`.`CustomerID` = `Customers`.`CustomerID`
		// where `tblCashDeposit`.`TransDate` >= '$from'
		// and `tblCashDeposit`.`TransDate` <= '$to'
		// and `tblCustomerRefund`.`RefundDate` >= '$from'
		//  and `tblCustomerRefund`.`RefundDate` <= '$to'
		//   and `tblCashiers`.`CashierID` = '$cashier'");

		$output = $this->cashiers
			->Leftjoin($this->cashDeposit->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->cashDeposit->getTable() . '.CashierID')
			->Leftjoin($this->customers->getTable(), $this->cashDeposit->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
			->where($this->cashDeposit->getTable() . '.TransDate', '>=', $from)
			->where($this->cashDeposit->getTable() . '.TransDate', '<=', $to)
			->where($this->cashiers->getTable() . '.CashierID', $cashier)
			->get();

		// dd($output);
		return Response()->json($output);
	}

	public function loadsttCustomrRefund() {

		$input = Request::all();
		$input = (array) $input;
//			dd($input);
		$cashier = $input['CashierID'];
		$from = $input['FromTransDate'];
		$to = $input['ToTransDate'];

//       dd($from);
		$from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
		$to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

		// 	$output = DB::select("select * from `tblCashiers`
		// left join `tblSupplierRefund` on `tblCashiers`.`CashierID` = `tblSupplierRefund`.`CashierID`
		//  left join `tblCashPayments` on `tblCashiers`.`CashierID` = `tblCashPayments`.`CashierID`
		//  left join `tblSuppliers` on `tblSupplierRefund`.`SupplierID` = `tblSuppliers`.`SupplierID`
		//  left join `tblSuppliers` as Suppliers on `tblCashPayments`.`SupplierID` = `Suppliers`.`SupplierID`
		// where `tblCashPayments`.`TransDate` >= '$from'
		// and `tblCashPayments`.`TransDate` <= '$to'
		// and `tblSupplierRefund`.`RefundDate` >= '$from'
		//  and `tblSupplierRefund`.`RefundDate` <= '$to'
		//   and `tblCashiers`.`CashierID` = '$cashier'");

		// $output = $this->cashiers
		// 	->Leftjoin($this->customerRefund->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->customerRefund->getTable() . '.CashierID')
		// 	->Leftjoin($this->cashDeposit->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->cashDeposit->getTable() . '.CashierID')
		// 	->Leftjoin($this->customers->getTable(), $this->customerRefund->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->Leftjoin($this->customers->getTable('as c'), $this->cashDeposit->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '>=', $from)
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '<=', $to)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '>=', $from)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '<=', $to)
		// 	->where($this->cashiers->getTable() . '.CashierID', $cashier)
		// 	->get();

		$output = $this->cashiers
			->Leftjoin($this->customerRefund->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->customerRefund->getTable() . '.CashierID')
			->Leftjoin($this->customers->getTable(), $this->customerRefund->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
			->where($this->customerRefund->getTable() . '.RefundDate', '>=', $from)
			->where($this->customerRefund->getTable() . '.RefundDate', '<=', $to)
			->where($this->cashiers->getTable() . '.CashierID', $cashier)
			->get();

		// dd($output);
		return Response()->json($output);
	}

	public function loadsttSupplierPayment() {

		$input = Request::all();
		$input = (array) $input;
//			dd($input);
		$cashier = $input['CashierID'];
		$from = $input['FromTransDate'];
		$to = $input['ToTransDate'];

//       dd($from);
		$from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
		$to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

		// 	$output = DB::select("select * from `tblCashiers`
		// left join `tblCustomRefund` on `tblCashiers`.`CashierID` = `tblCustomRefund`.`CashierID`
		//  left join `tblCustomesPayment` on `tblCashiers`.`CashierID` = `tblCustomesPayment`.`CashierID`
		//  left join `tblCustoms` on `tblCustomRefund`.`CustomID` = `tblcustoms`.`CustomID`
		//  left join `tblCustoms` as Customs on `tblCustomRefund`.`CustomID` = `Customs`.`CustomID`
		// where `tblCustomesPayment`.`TransDate` >= '$from'
		// and `tblCustomesPayment`.`TransDate` <= '$to'
		// and `tblCustomRefund`.`RefundDate` >= '$from'
		//  and `tblCustomRefund`.`RefundDate` <= '$to'
		//   and `tblCashiers`.`CashierID` = '$cashier'");

		// $output = $this->cashiers
		// 	->Leftjoin($this->customerRefund->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->customerRefund->getTable() . '.CashierID')
		// 	->Leftjoin($this->cashDeposit->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->cashDeposit->getTable() . '.CashierID')
		// 	->Leftjoin($this->customers->getTable(), $this->customerRefund->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->Leftjoin($this->customers->getTable('as c'), $this->cashDeposit->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '>=', $from)
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '<=', $to)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '>=', $from)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '<=', $to)
		// 	->where($this->cashiers->getTable() . '.CashierID', $cashier)
		// 	->get();

		$output = $this->cashiers
			->Leftjoin($this->cashPayments->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->cashPayments->getTable() . '.CashierID')
			->Leftjoin($this->suppliers->getTable(), $this->cashPayments->getTable() . '.SupplierID', '=', $this->suppliers->getTable() . '.SupplierID')
			->where($this->cashPayments->getTable() . '.TransDate', '>=', $from)
			->where($this->cashPayments->getTable() . '.TransDate', '<=', $to)
			->where($this->cashiers->getTable() . '.CashierID', $cashier)
			->get();

		// dd($output);
		return Response()->json($output);
	}

	public function loadsttSupplierRefund() {

		$input = Request::all();
		$input = (array) $input;
//			dd($input);
		$cashier = $input['CashierID'];
		$from = $input['FromTransDate'];
		$to = $input['ToTransDate'];

//       dd($from);
		$from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
		$to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

		// 	$output = DB::select("select * from `tblCashiers`
		// left join `tblCustomRefund` on `tblCashiers`.`CashierID` = `tblCustomRefund`.`CashierID`
		//  left join `tblCustomesPayment` on `tblCashiers`.`CashierID` = `tblCustomesPayment`.`CashierID`
		//  left join `tblCustoms` on `tblCustomRefund`.`CustomID` = `tblcustoms`.`CustomID`
		//  left join `tblCustoms` as Customs on `tblCustomRefund`.`CustomID` = `Customs`.`CustomID`
		// where `tblCustomesPayment`.`TransDate` >= '$from'
		// and `tblCustomesPayment`.`TransDate` <= '$to'
		// and `tblCustomRefund`.`RefundDate` >= '$from'
		//  and `tblCustomRefund`.`RefundDate` <= '$to'
		//   and `tblCashiers`.`CashierID` = '$cashier'");

		// $output = $this->cashiers
		// 	->Leftjoin($this->customerRefund->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->customerRefund->getTable() . '.CashierID')
		// 	->Leftjoin($this->cashDeposit->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->cashDeposit->getTable() . '.CashierID')
		// 	->Leftjoin($this->customers->getTable(), $this->customerRefund->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->Leftjoin($this->customers->getTable('as c'), $this->cashDeposit->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '>=', $from)
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '<=', $to)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '>=', $from)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '<=', $to)
		// 	->where($this->cashiers->getTable() . '.CashierID', $cashier)
		// 	->get();

		$output = $this->cashiers
			->Leftjoin($this->supplierRefund->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->supplierRefund->getTable() . '.CashierID')
			->Leftjoin($this->suppliers->getTable(), $this->supplierRefund->getTable() . '.SupplierID', '=', $this->suppliers->getTable() . '.SupplierID')
			->where($this->supplierRefund->getTable() . '.RefundDate', '>=', $from)
			->where($this->supplierRefund->getTable() . '.RefundDate', '<=', $to)
			->where($this->cashiers->getTable() . '.CashierID', $cashier)
			->get();

		// dd($output);
		return Response()->json($output);
	}

	public function loadsttSupplierFinal() {

		$input = Request::all();
		$input = (array) $input;
//			dd($input);
		$cashier = $input['CashierID'];
		$from = $input['FromTransDate'];
		$to = $input['ToTransDate'];

//       dd($from);
		$from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
		$to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

		// 	$output = DB::select("select * from `tblCashiers`
		// left join `tblCustomRefund` on `tblCashiers`.`CashierID` = `tblCustomRefund`.`CashierID`
		//  left join `tblCustomesPayment` on `tblCashiers`.`CashierID` = `tblCustomesPayment`.`CashierID`
		//  left join `tblCustoms` on `tblCustomRefund`.`CustomID` = `tblcustoms`.`CustomID`
		//  left join `tblCustoms` as Customs on `tblCustomRefund`.`CustomID` = `Customs`.`CustomID`
		// where `tblCustomesPayment`.`TransDate` >= '$from'
		// and `tblCustomesPayment`.`TransDate` <= '$to'
		// and `tblCustomRefund`.`RefundDate` >= '$from'
		//  and `tblCustomRefund`.`RefundDate` <= '$to'
		//   and `tblCashiers`.`CashierID` = '$cashier'");

		// $output = $this->cashiers
		// 	->Leftjoin($this->customerRefund->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->customerRefund->getTable() . '.CashierID')
		// 	->Leftjoin($this->cashDeposit->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->cashDeposit->getTable() . '.CashierID')
		// 	->Leftjoin($this->customers->getTable(), $this->customerRefund->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->Leftjoin($this->customers->getTable('as c'), $this->cashDeposit->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '>=', $from)
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '<=', $to)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '>=', $from)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '<=', $to)
		// 	->where($this->cashiers->getTable() . '.CashierID', $cashier)
		// 	->get();

		$output = $this->cashiers
			->Leftjoin($this->settlementSuppliersAccount->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->settlementSuppliersAccount->getTable() . '.CashierID')
			->Leftjoin($this->suppliers->getTable(), $this->settlementSuppliersAccount->getTable() . '.SupplierID', '=', $this->suppliers->getTable() . '.SupplierID')
			->where($this->settlementSuppliersAccount->getTable() . '.TransDate', '>=', $from)
			->where($this->settlementSuppliersAccount->getTable() . '.TransDate', '<=', $to)
			->where($this->cashiers->getTable() . '.CashierID', $cashier)
			->get();

		// dd($output);
		return Response()->json($output);
	}

	public function loadsttCutompay() {

		$input = Request::all();
		$input = (array) $input;
//			dd($input);
		$cashier = $input['CashierID'];
		$from = $input['FromTransDate'];
		$to = $input['ToTransDate'];

//       dd($from);
		$from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
		$to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

		// 	$output = DB::select("select * from `tblCashiers`
		// left join `tblCustomRefund` on `tblCashiers`.`CashierID` = `tblCustomRefund`.`CashierID`
		//  left join `tblCustomesPayment` on `tblCashiers`.`CashierID` = `tblCustomesPayment`.`CashierID`
		//  left join `tblCustoms` on `tblCustomRefund`.`CustomID` = `tblcustoms`.`CustomID`
		//  left join `tblCustoms` as Customs on `tblCustomRefund`.`CustomID` = `Customs`.`CustomID`
		// where `tblCustomesPayment`.`TransDate` >= '$from'
		// and `tblCustomesPayment`.`TransDate` <= '$to'
		// and `tblCustomRefund`.`RefundDate` >= '$from'
		//  and `tblCustomRefund`.`RefundDate` <= '$to'
		//   and `tblCashiers`.`CashierID` = '$cashier'");

		// $output = $this->cashiers
		// 	->Leftjoin($this->customerRefund->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->customerRefund->getTable() . '.CashierID')
		// 	->Leftjoin($this->cashDeposit->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->cashDeposit->getTable() . '.CashierID')
		// 	->Leftjoin($this->customers->getTable(), $this->customerRefund->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->Leftjoin($this->customers->getTable('as c'), $this->cashDeposit->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '>=', $from)
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '<=', $to)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '>=', $from)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '<=', $to)
		// 	->where($this->cashiers->getTable() . '.CashierID', $cashier)
		// 	->get();

		$output = $this->cashiers
			->Leftjoin($this->customePayment->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->customePayment->getTable() . '.CashierID')
			->Leftjoin($this->customs->getTable(), $this->customePayment->getTable() . '.CustomID', '=', $this->customs->getTable() . '.CustomID')
			->where($this->customePayment->getTable() . '.TransDate', '>=', $from)
			->where($this->customePayment->getTable() . '.TransDate', '<=', $to)
			->where($this->cashiers->getTable() . '.CashierID', $cashier)
			->get();

		// dd($output);
		return Response()->json($output);
	}

	public function loadsttCutomRefund() {

		$input = Request::all();
		$input = (array) $input;
//			dd($input);
		$cashier = $input['CashierID'];
		$from = $input['FromTransDate'];
		$to = $input['ToTransDate'];

//       dd($from);
		$from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
		$to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

		// 	$output = DB::select("select * from `tblCashiers`
		// left join `tblCustomRefund` on `tblCashiers`.`CashierID` = `tblCustomRefund`.`CashierID`
		//  left join `tblCustomesPayment` on `tblCashiers`.`CashierID` = `tblCustomesPayment`.`CashierID`
		//  left join `tblCustoms` on `tblCustomRefund`.`CustomID` = `tblcustoms`.`CustomID`
		//  left join `tblCustoms` as Customs on `tblCustomRefund`.`CustomID` = `Customs`.`CustomID`
		// where `tblCustomesPayment`.`TransDate` >= '$from'
		// and `tblCustomesPayment`.`TransDate` <= '$to'
		// and `tblCustomRefund`.`RefundDate` >= '$from'
		//  and `tblCustomRefund`.`RefundDate` <= '$to'
		//   and `tblCashiers`.`CashierID` = '$cashier'");

		// $output = $this->cashiers
		// 	->Leftjoin($this->customerRefund->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->customerRefund->getTable() . '.CashierID')
		// 	->Leftjoin($this->cashDeposit->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->cashDeposit->getTable() . '.CashierID')
		// 	->Leftjoin($this->customers->getTable(), $this->customerRefund->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->Leftjoin($this->customers->getTable('as c'), $this->cashDeposit->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '>=', $from)
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '<=', $to)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '>=', $from)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '<=', $to)
		// 	->where($this->cashiers->getTable() . '.CashierID', $cashier)
		// 	->get();

		$output = $this->cashiers
			->Leftjoin($this->customRefund->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->customRefund->getTable() . '.CashierID')
			->Leftjoin($this->customs->getTable(), $this->customRefund->getTable() . '.CustomID', '=', $this->customs->getTable() . '.CustomID')
			->where($this->customRefund->getTable() . '.RefundDate', '>=', $from)
			->where($this->customRefund->getTable() . '.RefundDate', '<=', $to)
			->where($this->cashiers->getTable() . '.CashierID', $cashier)
			->get();

		// dd($output);
		return Response()->json($output);
	}

	public function loadsttTransCTC() {

		$input = Request::all();
		$input = (array) $input;
//			dd($input);
		$cashier = $input['CashierID'];
		$from = $input['FromTransDate'];
		$to = $input['ToTransDate'];

//       dd($from);
		$from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
		$to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

		$output = DB::select("select * from `tblCashierTransfer`
				left join `tblCashiers` as Cashiers on `tblCashierTransfer`.`FromCashierID` = `Cashiers`.`CashierID`
				left join `tblCashiers` as CashiersT on `tblCashierTransfer`.`ToCashierID` = `CashiersT`.`CashierID`
				 where `tblCashierTransfer`.`TransDate` >= '$from'
				 and `tblCashierTransfer`.`TransDate` <= '$to'
				 and `Cashiers`.`CashierID` = '$cashier'");

		// $output = $this->cashiers
		// 	->Leftjoin($this->customerRefund->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->customerRefund->getTable() . '.CashierID')
		// 	->Leftjoin($this->cashDeposit->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->cashDeposit->getTable() . '.CashierID')
		// 	->Leftjoin($this->customers->getTable(), $this->customerRefund->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->Leftjoin($this->customers->getTable('as c'), $this->cashDeposit->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '>=', $from)
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '<=', $to)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '>=', $from)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '<=', $to)
		// 	->where($this->cashiers->getTable() . '.CashierID', $cashier)
		// 	->get();

		// $output = $this->cashiers
		// 	->Leftjoin($this->cashierTransfer->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->cashierTransfer->getTable() . '.FromCashierID')
		// 	->Leftjoin($this->cashierTransfer->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->cashierTransfer->getTable() . '.ToCashierID')
		// 	->where($this->cashierTransfer->getTable() . '.TransDate', '>=', $from)
		// 	->where($this->cashierTransfer->getTable() . '.TransDate', '<=', $to)
		// 	->where($this->cashiers->getTable() . '.CashierID', $cashier)
		// 	->get();

		// dd($output);
		return Response()->json($output);
	}

	public function loadsttTransCTB() {

		$input = Request::all();
		$input = (array) $input;
//			dd($input);
		$cashier = $input['CashierID'];
		$from = $input['FromTransDate'];
		$to = $input['ToTransDate'];

//       dd($from);
		$from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
		$to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

		// 	$output = DB::select("select * from `tblCashiers`
		// left join `tblCustomRefund` on `tblCashiers`.`CashierID` = `tblCustomRefund`.`CashierID`
		//  left join `tblCustomesPayment` on `tblCashiers`.`CashierID` = `tblCustomesPayment`.`CashierID`
		//  left join `tblCustoms` on `tblCustomRefund`.`CustomID` = `tblcustoms`.`CustomID`
		//  left join `tblCustoms` as Customs on `tblCustomRefund`.`CustomID` = `Customs`.`CustomID`
		// where `tblCustomesPayment`.`TransDate` >= '$from'
		// and `tblCustomesPayment`.`TransDate` <= '$to'
		// and `tblCustomRefund`.`RefundDate` >= '$from'
		//  and `tblCustomRefund`.`RefundDate` <= '$to'
		//   and `tblCashiers`.`CashierID` = '$cashier'");

		// $output = $this->cashiers
		// 	->Leftjoin($this->customerRefund->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->customerRefund->getTable() . '.CashierID')
		// 	->Leftjoin($this->cashDeposit->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->cashDeposit->getTable() . '.CashierID')
		// 	->Leftjoin($this->customers->getTable(), $this->customerRefund->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->Leftjoin($this->customers->getTable('as c'), $this->cashDeposit->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '>=', $from)
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '<=', $to)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '>=', $from)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '<=', $to)
		// 	->where($this->cashiers->getTable() . '.CashierID', $cashier)
		// 	->get();

		$output = $this->cashiers
			->Leftjoin($this->cashierBankTransfer->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->cashierBankTransfer->getTable() . '.CashierID')
			->Leftjoin($this->banks->getTable(), $this->cashierBankTransfer->getTable() . '.BankID', '=', $this->banks->getTable() . '.BankID')
			->where($this->cashierBankTransfer->getTable() . '.TransDate', '>=', $from)
			->where($this->cashierBankTransfer->getTable() . '.TransDate', '<=', $to)
			->where($this->cashiers->getTable() . '.CashierID', $cashier)
			->get();

		// dd($output);
		return Response()->json($output);
	}

	public function loadsttTransBTC() {

		$input = Request::all();
		$input = (array) $input;
//			dd($input);
		$cashier = $input['CashierID'];
		$from = $input['FromTransDate'];
		$to = $input['ToTransDate'];

//       dd($from);
		$from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
		$to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

		// 	$output = DB::select("select * from `tblCashiers`
		// left join `tblCustomRefund` on `tblCashiers`.`CashierID` = `tblCustomRefund`.`CashierID`
		//  left join `tblCustomesPayment` on `tblCashiers`.`CashierID` = `tblCustomesPayment`.`CashierID`
		//  left join `tblCustoms` on `tblCustomRefund`.`CustomID` = `tblcustoms`.`CustomID`
		//  left join `tblCustoms` as Customs on `tblCustomRefund`.`CustomID` = `Customs`.`CustomID`
		// where `tblCustomesPayment`.`TransDate` >= '$from'
		// and `tblCustomesPayment`.`TransDate` <= '$to'
		// and `tblCustomRefund`.`RefundDate` >= '$from'
		//  and `tblCustomRefund`.`RefundDate` <= '$to'
		//   and `tblCashiers`.`CashierID` = '$cashier'");

		// $output = $this->cashiers
		// 	->Leftjoin($this->customerRefund->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->customerRefund->getTable() . '.CashierID')
		// 	->Leftjoin($this->cashDeposit->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->cashDeposit->getTable() . '.CashierID')
		// 	->Leftjoin($this->customers->getTable(), $this->customerRefund->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->Leftjoin($this->customers->getTable('as c'), $this->cashDeposit->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '>=', $from)
		// 	->where($this->cashDeposit->getTable() . '.TransDate', '<=', $to)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '>=', $from)
		// 	->where($this->customerRefund->getTable() . '.RefundDate', '<=', $to)
		// 	->where($this->cashiers->getTable() . '.CashierID', $cashier)
		// 	->get();

		$output = $this->cashiers
			->Leftjoin($this->bankCashierTransfer->getTable(), $this->cashiers->getTable() . '.CashierID', '=', $this->bankCashierTransfer->getTable() . '.CashierID')
			->Leftjoin($this->banks->getTable(), $this->bankCashierTransfer->getTable() . '.BankID', '=', $this->banks->getTable() . '.BankID')
			->where($this->bankCashierTransfer->getTable() . '.TransDate', '>=', $from)
			->where($this->bankCashierTransfer->getTable() . '.TransDate', '<=', $to)
			->where($this->cashiers->getTable() . '.CashierID', $cashier)
			->get();

		// dd($output);
		return Response()->json($output);
	}



// 	function DailyCashier(){
// // 
// $input = Request::all();
// 		$input = (array) $input;
// 			// dd($input);
// 		$Cashier_ID = $input["CashierID"];
// 		$FromDate = $input["FromTransDate"];
// 		$ToDate = $input["ToTransDate"];
// 		// dd("function");
// 	 //  		// dd($fromDate);
//   //    		 // dd($cashier,$fromDate,$toDate);
// 		// $fromDate = Carbon::createFromFormat('Y/m/d', $fromDate)->toDateString();
// 		// $toDate = Carbon::createFromFormat('Y/m/d', $toDate)->toDateString();
// 		// 		dd($fromDate);



// 	    $output = DB::select('call get_Chashier_Mount(?,?,?)', array($FromDate,$ToDate,$Cashier_ID));
// 				dd($output);
// 			return Response()->json($output);

// 	}

} // end of class

?>