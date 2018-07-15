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

class ForignSupplersTotalCommition extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('forignsupplerstotalcommition.forignsupplerstotalcommition');
    }

    public function __construct()
    {
        $this->sales = new Sales();
        $this->salesdetails = new SalesDetails();
        $this->products = new Products();
        $this->customers = new Customers();
        $this->suppliers = new Suppliers();


    }

    function LoadforignCommition()
    {
        $input = Request::all();
        $input = (array)$input;
        $from = $input['FromTransDate'];
        $to = $input['ToTransDate'];

        $from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();
        $to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();


//        $output = DB::SELECT("select SalesDate,RefNo,tblsalesdetails.SupplierID,SupplierName, Weight,Quantity,ProductPrice,WeightType ,tblsalesdetails.Total,tblcontainers.Commision,tblcontainers.Nowlon ,ProductName,ContainerLocalNum ,tblcontainers.OtherExpenses,CustomerName ,ContainerIntNum , Carrying
//                                from tblsalesdetails  LEFT JOIN  tblsales
//								ON tblsalesdetails.SalesID = tblsales.SalesID
//
//                                LEFT JOIN tblcontainers
//								ON tblsalesdetails.ContainerID = tblcontainers.ContainerID
//
//								LEFT JOIN tblproducts
//								ON tblsalesdetails.ProductID = tblproducts.ProductID
//                                LEFT JOIN tblcustomers
//								ON tblsales.CustomerID = tblcustomers.CustomerID
//                                LEFT JOIN tblsuppliers
//								ON tblsalesdetails.SupplierID = tblsuppliers.SupplierID
//
//                               WHERE SalesDate >= '$from'
//								AND   SalesDate <= '$to'
//								AND  tblsuppliers.SupplierType = 1
//
//								Order By tblsales.SalesDate ASC ");

        $output = DB::SELECT("select SalesDate,RefNo,tblsalesdetails.SupplierID,SupplierName,Weight,Quantity,ProductPrice,WeightType,Round(Sum(Total))as Total,tblcontainers.Commision,tblcontainers.Nowlon,ProductName,ContainerLocalNum ,tblcontainers.OtherExpenses,CustomerName ,ContainerIntNum , Carrying                          
                                from tblsalesdetails  LEFT JOIN  tblsales  
								ON tblsalesdetails.SalesID = tblsales.SalesID
					
                                LEFT JOIN tblcontainers 
								ON tblsalesdetails.ContainerID = tblcontainers.ContainerID
								
								LEFT JOIN tblproducts
								ON tblsalesdetails.ProductID = tblproducts.ProductID
                                LEFT JOIN tblcustomers
								ON tblsales.CustomerID = tblcustomers.CustomerID
                                LEFT JOIN tblsuppliers
								ON tblsalesdetails.SupplierID = tblsuppliers.SupplierID
                                        
                               WHERE SalesDate >= '$from' 
								AND   SalesDate <= '$to'
							and tblsuppliers.SupplierType = 1
                            GROUP BY tblsalesdetails.SupplierID , tblsales.SalesDate
                            ORDER By tblsales.SalesDate ASC ");

        return Response()->json($output);
    }


}
