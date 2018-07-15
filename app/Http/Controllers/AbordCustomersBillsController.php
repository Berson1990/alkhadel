<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;


use App\Http\Models\CashDeposit;
use App\Http\Models\CheckDeposit;
use App\Http\Models\CustomersDiscount;
use App\Http\Models\CustomerOpeningBalance;
use App\Http\Models\CustomerRefund;

use DB;

use App\Http\Models\Products;
use App\Http\Models\SalesDetails;
use App\Http\Models\Sales;
use App\Http\Models\Suppliers;
use App\Http\Models\Customers;
use Carbon\Carbon;
use Request;
use Illuminate\Database\Query\Builder;


class AbordCustomersBillsController extends Controller {
	public function index()
	{  
	  $supplierbills = Suppliers::all();
    return view('abordcustomerbills.abordcustomerbills');     
	}
    
   public function loadEndBillsAbordCustomer()
	{ 
         
        $input=Request::all();
        // dd("a7a ala elsob7");
	// dd($input);

        $input=(array)$input;
		
        $from=$input['FromTransDate'];
        $to=$input['ToTransDate'];
//			$CheckSuppliers=$input['checkSuppliers']
//				 dd($CheckSuppliers);
         $Customers=$input['CustomerID'];
       $from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
       $to =   Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;



          $output=DB::select("select DISTINCT tblendoutdeal.SalesID,valuesold,billexpenses,tblendoutdeal.commision,Total_1,CustomerName ,estimatedvalue,internalexpenses,Total_2,SalesDate ,RefNo from tblendoutdeal  join tblsales 
	 on tblendoutdeal.SalesID = tblsales.SalesID 
	 join tblsalesdetails 
	 on tblendoutdeal.SalesID = tblsalesdetails.SalesID
      join tblcustomers 
      on  tblcustomers.CustomerID =tblsales.CustomerID
	  WHERE SalesDate >= '$from' 
		AND   SalesDate <= '$to'
		AND tblsales.CustomerID='$Customers'");
	

return Response()->json($output);    
}
	


 }// end of class   