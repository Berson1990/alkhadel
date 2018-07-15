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

class LocalSupplersTotalCommition extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('localsupplerstotalcommition.localsupplerstotalcommition');
    }

    public function __construct()
    {
        $this->sales = new Sales();
        $this->salesdetails = new SalesDetails();
        $this->products = new Products();
        $this->customers = new Customers();
        $this->suppliers = new Suppliers();


    }

    function LoadlocalCommition()
    {
        $input = Request::all();
        $input = (array)$input;
        $from = $input['FromTransDate'];
        $to = $input['ToTransDate'];

        $from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
        $to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();


        $output = DB::SELECT("select * ,SUM(`tblSalesDetails`.`Total`) as Total from `tblSales`
left join `tblSalesDetails` on `tblSales`.`SalesID` = `tblSalesDetails`.`SalesID` 
left join `tblSuppliers` on `tblSalesDetails`.`SupplierID` = `tblSuppliers`.`SupplierID` 
left join `tblProducts` on `tblSalesDetails`.`ProductID` = `tblProducts`.`ProductID`
left join `tblCustomers` on `tblSales`.`CustomerID` = `tblCustomers`.`CustomerID`
where `tblSales`.`SalesDate` >= '$from'
and `tblSales`.`SalesDate` <= '$to'
and `tblSuppliers`.`SupplierType` = 0 
GROUP By `tblSalesDetails`.`SupplierID`,tblsales.SalesDate ");

        return Response()->json($output);
    }

}
