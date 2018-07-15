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


class CarryingReprotController extends Controller {
    
	public function index()
	{  
	  $supplierbills = Suppliers::all();
    return view('carryingreprot.carryingreprot');     
	}
    
    
      public function __construct()
    {
      
       $this->cashDeposit             = new CashDeposit();
       $this->checkDeposit            = new CheckDeposit();
       $this->customersDiscount       = new CustomersDiscount();    
       $this->customerOpeningBalance  = new CustomerOpeningBalance();
       $this->customerRefund          = new CustomerRefund();
       $this->sales                   = new Sales();
       $this->salesdetails            = new SalesDetails();
       $this->products                = new Products();
       $this->suppliers               = new Suppliers();              
       $this->customers               = new Customers();              
      }
    
    
    
      function loadCryying()    
    {
      $input     =Request::all();
//          dd($input);
      $input     =(array)$input; 
//      $customers =$input['CustomerID'];    
      $from      =$input['FromTransDate'];
      $to        =$input['ToTransDate'];
//     $prouductType=$input['ProuductID'];    
        
           if (isset($input['checkProuduct']))
          {
              $checkproduct=$input['checkProuduct'];
          }
          else
          {
              $checkproduct = 0 ;
                $prouductType=0;
          }  
          
          
          
          
        
      $from       = Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
      $to         = Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;
          
        if( $checkproduct > 0 )  
        {
            $prouductType=$input['ProuductID'];    
      $output     = $this->sales
     ->leftjoin($this->salesdetails->getTable(),$this->sales->getTable().'.SalesID','=', $this->salesdetails->getTable().'.SalesID')
     ->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID') 
          ->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')
     ->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
     ->where($this->sales->getTable().'.SalesDate','>=', $from)
     ->where($this->sales->getTable().'.SalesDate' ,'<=', $to )  
         ->where($this->products->getTable().'.ProductType' , $prouductType)        
//     ->where($this->sales->getTable().'.CustomerID',$customers )
     ->get();
         
      }else if ( $checkproduct == 0){
            
            
                  $output     = $this->sales
     ->leftjoin($this->salesdetails->getTable(),$this->sales->getTable().'.SalesID','=', $this->salesdetails->getTable().'.SalesID')
     ->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID') 
          ->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')
     ->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
     ->where($this->sales->getTable().'.SalesDate','>=', $from)
     ->where($this->sales->getTable().'.SalesDate' ,'<=', $to )  
      
//     ->where($this->sales->getTable().'.CustomerID',$customers )
     ->get();

            
        }
          
 
//      dd($output);
       return Response()->json($output);      
    }// end of function 
}// end of class 
?>    