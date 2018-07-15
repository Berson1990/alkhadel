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

class OneCustomerController extends Controller {
	public function index()
	{  
         $totalcustomers = Customers::all();
         $totalsuppliers = Suppliers::all();

   return view("onecustomer.onecustomer",compact('totalcustomers','totalsuppliers'));
	}


 public function __construct()
    {
        $this->sales = new Sales();
        $this->salesdetails = new SalesDetails();
        $this->products = new Products();
        $this->customers = new Customers();
		$this->suppliers = new Suppliers();
    }

	    public function loadData()
	{ 
         
        $input=Request::all();
        $input=(array)$input;
       
          
          if (isset($input['checkCustomers']))
          {
              $CheckCustomers=$input['checkCustomers'];
          }
          else
          {
              $CheckCustomers = 0 ;
          }
            

          
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
       $from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
       $to =   Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;
        $prouductType=$input['ProuductID'];
//          dd($prouductType);
          
if($CheckCustomers > 0  )
{
	
     $Suppliers=$input['SupplierID'];
    $Customers=$input['CustomersID'];
    
    $output =$this->sales
   ->leftjoin($this->salesdetails->getTable(),$this->sales->getTable().'.SalesID','=', $this->salesdetails->getTable().'.SalesID')
   ->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')
   ->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')
     ->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
   
   ->where($this->sales->getTable().'.SalesDate','>=', $from)
   ->where($this->sales->getTable().'.SalesDate' ,'<=', $to )
   ->where($this->products->getTable().'.ProductType' , $prouductType)           
   ->where($this->salesdetails->getTable().'.SupplierID',$Suppliers )
   ->get();
        
//		dd($output);
  return Response()->json($output);
    
}else if($CheckCustomers == 0 ){
    
//    $prouductType=$input['ProuductID'];
    $Customers=$input['CustomersID'];
   $output =$this->sales
   ->leftjoin($this->salesdetails->getTable(),$this->sales->getTable().'.SalesID','=', $this->salesdetails->getTable().'.SalesID')
   ->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')
   ->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')
    ->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
   
   ->where($this->sales->getTable().'.SalesDate','>=', $from)
   ->where($this->sales->getTable().'.SalesDate' ,'<=', $to )
  ->where($this->products->getTable().'.ProductType' , $prouductType)         
   ->where($this->sales->getTable().'.CustomerID',$Customers )           
   ->get();   
    
//		dd($output);
return Response()->json($output); 

}
    
    
	}//end of function load data
} // end of class