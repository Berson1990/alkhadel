<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

use App\Http\Models\Customers;
use App\Http\Models\Suppliers;
use App\Http\Models\CashPayments;
use App\Http\Models\CheckPayments;
use App\Http\Models\SuppliersDiscount;
use App\Http\Models\SupplierOpeningBalance;
use App\Http\Models\SupplierRefund;

use DB;

use App\Http\Models\Products;
use App\Http\Models\SalesDetails;
use App\Http\Models\Sales;
use Carbon\Carbon;
use Request;
use Illuminate\Database\Query\Builder;


class SupplierBillsController extends Controller
{
    public function index()
    {
        $supplierbills = Suppliers::all();
        return view('supplierbills.supplierbills', compact('supplierbills'));
    }


    public function __construct()
    {
        $this->suppliers = new Suppliers();
        $this->cashpayments = new CashPayments();
        $this->checkpayments = new CheckPayments();
        $this->suppliersDiscount = new SuppliersDiscount();
        $this->supplierOpeningBalance = new SupplierOpeningBalance();
        $this->supplierRefund = new SupplierRefund();
        $this->sales = new Sales();
        $this->salesdetails = new SalesDetails();
        $this->products = new Products();
        $this->Customers = new Customers();
//       $this->SupplierOpeningBalance               = new SupplierOpeningBalance();

    }

    function loadData()
    {
        $input = Request::all();
//        dd($input);
        $input = (array)$input;
        $Suppliers = $input['SupplierID'];
        $from = $input['FromTransDate'];
        $to = $input['ToTransDate'];


        $from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
        $to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();
        $output = $this->sales
            ->leftjoin($this->salesdetails->getTable(), $this->sales->getTable() . '.SalesID', '=', $this->salesdetails->getTable() . '.SalesID')
            ->leftjoin($this->suppliers->getTable(), $this->salesdetails->getTable() . '.SupplierID', '=', $this->suppliers->getTable() . '.SupplierID')
            ->leftjoin($this->products->getTable(), $this->salesdetails->getTable() . '.ProductID', '=', $this->products->getTable() . '.ProductID')
            ->leftjoin($this->Customers->getTable(), $this->sales->getTable() . '.CustomerID', '=', $this->Customers->getTable() . '.CustomerID')
            ->where($this->sales->getTable() . '.SalesDate', '>=', $from)
            ->where($this->sales->getTable() . '.SalesDate', '<=', $to)
            ->where($this->salesdetails->getTable() . '.SupplierID', $Suppliers)
            ->get();
        // dd($output);

        return Response()->json($output);
    }

    function OpeningDate()
    {

        $input = Request::all();
        $input = (array)$input;
        $Suppliers = $input['SupplierID'];

        $from = $input['FromTransDate'];
        $to = $input['ToTransDate'];
        $from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
        $to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();


        $query1 = DB::table('tblsupplieropeningbalance')
            ->selectRaw('TransDate')
            ->orderby("TransDate", "asc")
            ->take(1)
            ->where($this->supplierOpeningBalance->getTable() . '.SupplierID', $Suppliers);


        $query2 = DB::table('tblcashpayments')
            ->selectRaw('TransDate')
            ->orderby("TransDate", "asc")
            ->take(1)
            ->where($this->cashpayments->getTable() . '.SupplierID', $Suppliers);


        $query3 = DB::table('tblcheckpayments')
            ->orderby("TransDate", "asc")
            ->selectRaw('TransDate')
            ->take(1)
            ->where($this->checkpayments->getTable() . '.SupplierID', $Suppliers);


        $query4 = DB::table('tblsupplierrefund')
            ->orderby("RefundDate", "asc")
            ->selectRaw('RefundDate')
            ->take(1)
            ->where($this->supplierRefund->getTable() . '.SupplierID', $Suppliers);

        $query5 = DB::table('tblsuppliersdiscount')
            ->union($query4)
            ->union($query3)
            ->union($query2)
            ->union($query1)
            ->selectRaw('TransDate')
            ->orderby("TransDate", "asc")
            ->take(1)
            ->where($this->suppliersDiscount->getTable() . '.SupplierID', $Suppliers)
            ->get();

        return Response()->json($query5);

    }

    public function OpeningBalance()
    {

        $input = Request::json();
        $input = (array)$input;

        foreach ($input as $key => $value) {
            $startDate = $value['startDate'];
            $fromDate = $value['fromDate'];
        }

        $startDate = date("Y/m/d", strtotime($startDate));
        $fromDate = date('Y/m/d', strtotime("yesterday", strtotime($fromDate)));
        $fromDate = Carbon::createFromFormat('Y/m/d', $fromDate)->toDateString();
        $startDate = Carbon::createFromFormat('Y/m/d', $startDate)->toDateString();


        $query1 = DB::table('tblsupplieropeningbalance')
            ->selectRaw('Mount')
            ->where('TransDate', '>=', $startDate)
            ->where('TransDate', '<=', $fromDate)
            ->get();

        $supplierOpeningBalance = 0;

        foreach ($query1 as $key => $value) {
            $supplierOpeningBalance += $value->Mount;
        }

        $query2 = DB::table('tblcashpayments')
            ->selectRaw('Mount')
            ->where('TransDate', '>=', $startDate)
            ->where('TransDate', '<=', $fromDate)
            ->get();
        $cashpayments = 0;

        foreach ($query2 as $key => $value) {
            $cashpayments += $value->Mount;
        }

        $query3 = DB::table('tblcheckpayments')
            ->selectRaw('Mount')
            ->where('TransDate', '>=', $startDate)
            ->where('TransDate', '<=', $fromDate)
            ->get();
        $checkpayments = 0;

        foreach ($query3 as $key => $value) {
            $checkpayments += $value->Mount;
        }

        $query4 = DB::table('tblsupplierrefund')
            ->selectRaw('Refund')
            ->where('RefundDate', '>=', $startDate)
            ->where('RefundDate', '<=', $fromDate)
            ->get();
        $supplierrefund = 0;

        foreach ($query4 as $key => $value) {
            $supplierrefund += $value->Refund;
        }

        $query5 = DB::table('tblsuppliersdiscount')
            ->selectRaw('Mount')
            ->where('TransDate', '>=', $startDate)
            ->where('TransDate', '<=', $fromDate)
            ->get();
        $suppliersdiscount = 0;

        foreach ($query5 as $key => $value) {
            $suppliersdiscount += $value->Mount;
        }

        $total = $supplierOpeningBalance + $checkpayments + $cashpayments + $suppliersdiscount - $supplierrefund;
        // echo $suppliersdiscount." ";
        // echo $checkpayments." ";
        // echo $cashpayments." ";
        // echo $supplierOpeningBalance." ";
        // echo $supplierrefund."   ";

        return $total;
    }

    function LoadPayments()
    {

        $input = Request::all();
        $input = (array)$input;
        $Suppliers = $input['SupplierID'];

        $from = $input['FromTransDate'];
        $to = $input['ToTransDate'];
        $from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
        $to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

        $results = DB::select("select TransDate,Mount,'نقدى' PaymentType , ' ' CheckNo , Notes  
                                from tblcashpayments 
                                Where TransDate >= '$from'
                                AND TransDate <=  '$to'
                                And SupplierID = '$Suppliers'
                                Union
                                Select TransDate,Mount, 'شيك' PaymentType , CheckNo, Notes 
                                from tblcheckpayments
                                Where TransDate >= '$from'
                                AND TransDate <=  '$to'
                                And SupplierID = '$Suppliers'");


        return Response()->json($results);
    }

    function LoadRefund()
    {
        $input = Request::all();
        $input = (array)$input;
        $Suppliers = $input['SupplierID'];
        $from = $input['FromTransDate'];
        $to = $input['ToTransDate'];
        $from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
        $to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

        $output =
            $this->supplierRefund
                ->where($this->supplierRefund->getTable() . '.SupplierID', $Suppliers)
                ->where($this->supplierRefund->getTable() . '.RefundDate', '>=', $from)
                ->where($this->supplierRefund->getTable() . '.RefundDate', '<=', $to)
                ->get();

        return Response()->json($output);
    }


    function LoadDiscount()
    {
        $input = Request::all();
        $input = (array)$input;
        $Suppliers = $input['SupplierID'];
        $from = $input['FromTransDate'];
        $to = $input['ToTransDate'];
        $from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
        $to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

        $output =
            $this->suppliersDiscount
                ->where($this->suppliersDiscount->getTable() . '.SupplierID', $Suppliers)
                ->where($this->suppliersDiscount->getTable() . '.TransDate', '>=', $from)
                ->where($this->suppliersDiscount->getTable() . '.TransDate', '<=', $to)
                ->get();

        return Response()->json($output);
    }


    public function GetSupplierOpeningBalnceStatment()
    {

        $input = Request::all();
//          dd($input);
        $input = (array)$input;
        $suppliers = $input['SupplierID'];
        $from = $input['FromTransDate'];
        $to = $input['ToTransDate'];
        $from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
        $to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();

        $output = $this->supplierOpeningBalance
//     ->where($this->supplierOpeningBalance->getTable().'.TransDate','>=', $from)
//     ->where($this->supplierOpeningBalance->getTable().'.TransDate' ,'<=', $to )    
            ->where($this->supplierOpeningBalance->getTable() . '.SupplierID', $suppliers)
            ->get();
//        dd($output);
        return Response()->json($output);
    }


}

?>