<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Http\Models\Customers;
use App\Http\Models\Suppliers;
use App\Http\Models\Products;
use App\Http\Models\SalesDetails;
use App\Http\Models\Sales;
use Carbon\Carbon;
use Request;
use DB;

class TotalLocalCustomer extends Controller
{

    public function index()
    {

        return view('totallocalcustomers.totallocalcustomers');

    }

    public function __construct()
    {
        $this->sales = new Sales();
        $this->salesdetails = new SalesDetails();
        $this->products = new Products();
        $this->customers = new Customers();
        $this->suppliers = new Suppliers();


    }

    public function loadTotallocalCustomersData()
    {
        $input = Request::all();

//       dd($input);


        $from = $input['FromTransDate'];
        $to = $input['ToTransDate'];
        $from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
        $to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();
        $prouductType = $input['ProuductID'];


//        $output = $this->sales
//            ->leftjoin($this->salesdetails->getTable(), $this->sales->getTable() . '.SalesID', '=', $this->salesdetails->getTable() . '.SalesID')
//            ->leftjoin($this->customers->getTable(), $this->sales->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
//            ->leftjoin($this->products->getTable(), $this->salesdetails->getTable() . '.ProductID', '=', $this->products->getTable() . '.ProductID')
//            ->leftjoin($this->suppliers->getTable(), $this->salesdetails->getTable() . '.SupplierID', '=', $this->suppliers->getTable() . '.SupplierID')
//            ->where($this->sales->getTable() . '.SalesDate', '>=', $from)
//            ->where($this->sales->getTable() . '.SalesDate', '<=', $to)
//            ->where($this->products->getTable() . '.ProductType', $prouductType)
//            ->where($this->customers->getTable().'.CustomerType','!=',1)
//            ->groupBy('tblsales.SalesID')
//            ->groupBy('tblsales.SalesDate')
//            ->get();
        $output = DB::SELECT("select * , Sum(`tblSalesDetails`.`Total`) as Total , Sum(Carrying) as Carrying from `tblSales` 
left join `tblSalesDetails` on `tblSales`.`SalesID` = `tblSalesDetails`.`SalesID` 
left join `tblCustomers` on `tblSales`.`CustomerID` = `tblCustomers`.`CustomerID` 
left join `tblProducts` on `tblSalesDetails`.`ProductID` = `tblProducts`.`ProductID` 
left join `tblSuppliers` on `tblSalesDetails`.`SupplierID` = `tblSuppliers`.`SupplierID` 
where `tblSales`.`SalesDate` >= '$from' 
and `tblSales`.`SalesDate` <= '$to' 
and `tblProducts`.`ProductType` = '$prouductType' 
and `tblCustomers`.`CustomerType` != 1 
group by `tblsales`.`SalesID`, `tblSales`.`SalesDate`");

        // dd($output);
        return Response()->json($output);


    }


}
