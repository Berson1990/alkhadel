<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Response;
use Illuminate\Http\Response as illuminateReponse;
use App\Http\Models\Customers;
use App\Http\Models\Suppliers;
use App\Http\Models\Products;
use App\Http\Models\SalesDetails;
use App\Http\Models\Sales;
use App\Http\Models\EndoutDeal;
use App\Http\Models\Banks;
use App\Http\Models\CashDeposit;
use App\Http\Models\CheckDeposit;
use App\Http\Models\BankCashDeposit;// Under Constraction 
use App\Http\Models\Cashiers;
use App\Http\Models\CashPayments;
use App\Http\Models\CheckPayments;

use App\Http\Models\Expenses;
use App\Http\Models\ExpensesTypes;
use Carbon\Carbon;
use Request;
use DB;
use Input;
use Illuminate\Support\Facades\Redirect;
use Response;

class DailyReportController extends Controller {
	
	
	public function __construct()
    {
        $this->sales = new Sales();
        $this->salesdetails = new SalesDetails();
        $this->products = new Products();
        $this->customers = new Customers();
		$this->suppliers = new Suppliers();
		$this->endoutdeal = new EndoutDeal();
		$this->cashiers = new Cashiers();
		
		$this->cashDeposit = new CashDeposit();
		$this->checkDeposit = new CheckDeposit();
		$this->bankDeposit = new BankCashDeposit();
		$this->banks = new Banks();
		$this->cashPayments = new CashPayments();
		$this->checkPayments = new CheckPayments();
		$this->expenses = new Expenses();
		$this->expensesTypes = new ExpensesTypes();
    }

	
	
	public function index()
	{  
       
         
   return view("dailyreport.dailyreport");
	}
	
  public function LoadDeferredBills()
  {
  
	  	$input=Request::all();
        $input=(array)$input;
//			dd($input);
        $date=$input['FromTransDate'];
//       dd($date);
	  	$date = Carbon::createFromFormat('Y/m/d', $date)->toDateString() ;
//         dd($date);
    $output =$this->sales
->leftjoin($this->salesdetails->getTable(),$this->sales->getTable().'.SalesID','=', $this->salesdetails->getTable().'.SalesID')      
->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')
->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')
->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
   
   ->where($this->sales->getTable().'.SalesDate','>=', $date)
   ->where($this->sales->getTable().'.SalesDate','<=', $date)
   ->where($this->customers->getTable().'.CustomerType','=',1 )
   ->where($this->products->getTable().'.ProductType','=', 0 )

 ->get();
	

        
//		dd($output);
  return Response()->json($output);
	
  } // end of function 
	

	  public function abordForeign()
  {
  
	  	$input=Request::all();
        $input=(array)$input;
//			dd($input);
        $date=$input['FromTransDate'];
//       dd($date);
	  	$date = Carbon::createFromFormat('Y/m/d', $date)->toDateString() ;
//         dd($date);
    $output =$this->sales
->leftjoin($this->salesdetails->getTable(),$this->sales->getTable().'.SalesID','=', $this->salesdetails->getTable().'.SalesID')      
->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')
->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')
->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
   
   ->where($this->sales->getTable().'.SalesDate','>=', $date)
   ->where($this->sales->getTable().'.SalesDate','<=', $date)
   ->where($this->customers->getTable().'.CustomerType','=',1 )
   ->where($this->products->getTable().'.ProductType','=', 1 )

 ->get();
	

        
//		dd($output);
  return Response()->json($output);
	
  } // end of function 
	
	

	
	
	  
	public function getendoutdeal()
	{
	   $output =DB::select("select *  from tblendoutdeal");
//	dd($output);   
	return Response()->json($output); 
	}   // end of function 
  
	

	
	public function LoadEndBillsDailyReport()
	{
		
		
	  	$input=Request::all();
        $input=(array)$input;
//			dd($input);

	  $date=$input['FromTransDate'];
		//			dd($input);
			$date = Carbon::createFromFormat('Y/m/d', $date)->toDateString() ;
		//			dd($input);
		
//		  $output =$this->endoutdeal
//->leftjoin($this->salesdetails->getTable(),$this->endoutdeal->getTable().'.SalesID','=', $this->salesdetails->getTable().'.SalesID')      
//->leftjoin($this->sales->getTable(),$this->endoutdeal->getTable().'.SalesID','=', $this->sales->getTable().'.SalesID')      
//->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')
//->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')
//->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')  
//   ->where($this->sales->getTable().'.SalesDate','>=', $date)
//   ->where($this->sales->getTable().'.SalesDate' ,'<=', $date )
//    ->where($this->customers->getTable().'.CustomerType','=',1 )
//	   ->where($this->products->getTable().'.ProductType','=', 0 )		  
//    ->get();

 /*
 select DISTINCT tblsales.SalesDate , CustomerName , SupplierName ,ProductName ,RefNo,tblsalesdetails.Weight,ProductPrice,Total,Quantity,Nowlon,Discount,Carrying from tblendoutdeal  join tblsales 
	 on tblendoutdeal.SalesID = tblsales.SalesID 
    join tblsalesdetails 
	 on tblendoutdeal.SalesID = tblsalesdetails.SalesID
     join tblproducts 
     on  tblproducts.ProductID = tblsalesdetails.ProductID
     join tblsuppliers
     on tblsuppliers.SupplierID = tblsalesdetails.SupplierID
     
     join tblcustomers 
      on  tblcustomers.CustomerID =tblsales.CustomerID
 
 
 */       
        
        
        
   
             $output=DB::select("select DISTINCT tblsales.SalesDate , CustomerName , SupplierName ,ProductName ,RefNo,tblsalesdetails.Weight,ProductPrice,Total,Quantity,Nowlon,Discount,Carrying from tblendoutdeal  join tblsales 
	 on tblendoutdeal.SalesID = tblsales.SalesID 
    join tblsalesdetails 
	 on tblendoutdeal.SalesID = tblsalesdetails.SalesID
     join tblproducts 
     on  tblproducts.ProductID = tblsalesdetails.ProductID
     join tblsuppliers
     on tblsuppliers.SupplierID = tblsalesdetails.SupplierID
     
     join tblcustomers 
      on  tblcustomers.CustomerID =tblsales.CustomerID
     
      WHERE SalesDate >= '$date' 
		AND   SalesDate <= '$date'
        AND  CustomerType = 1
        And  ProductType = 0
        ");
        
        
        
        
//		dd($output);   
	return Response()->json($output); 

	}//end of function 
  

		public function endbillForginProudct()
	{
		
		
	  	$input=Request::all();
        $input=(array)$input;
//			dd($input);

	  $date=$input['FromTransDate'];
		//			dd($input);
			$date = Carbon::createFromFormat('Y/m/d', $date)->toDateString() ;
		//			dd($input);
		
		  $output =$this->endoutdeal
->leftjoin($this->salesdetails->getTable(),$this->endoutdeal->getTable().'.SalesID','=', $this->salesdetails->getTable().'.SalesID')      
->leftjoin($this->sales->getTable(),$this->endoutdeal->getTable().'.SalesID','=', $this->sales->getTable().'.SalesID')      
->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')
->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')
->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')  
   ->where($this->sales->getTable().'.SalesDate','>=', $date)
   ->where($this->sales->getTable().'.SalesDate' ,'<=', $date )
    ->where($this->customers->getTable().'.CustomerType','=',1 )
	   ->where($this->products->getTable().'.ProductType','=', 1 )		  
    ->get();
		
//		dd($output);   
	return Response()->json($output); 

	}//end of function 
	
	
	
	
//========================================================================================	
	
 public function LoadUpperCustomer()
  {
  
	  	$input=Request::all();
        $input=(array)$input;
//			dd($input);
        $date=$input['FromTransDate'];
//       dd($date);
	  	$date = Carbon::createFromFormat('Y/m/d', $date)->toDateString() ;
//         dd($date);
    $output =$this->sales
->leftjoin($this->salesdetails->getTable(),$this->sales->getTable().'.SalesID','=', $this->salesdetails->getTable().'.SalesID')      
->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')
->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')
->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
   
   ->where($this->sales->getTable().'.SalesDate','>=', $date)
   ->where($this->sales->getTable().'.SalesDate','<=', $date)
   ->where($this->customers->getTable().'.CustomerType','=',2 )
 ->where($this->products->getTable().'.ProductType','=', 0 )		

 ->get();
	

        
//		dd($output);
  return Response()->json($output);
	
  } // end of function 
//=======================================================================
	
	 public function LoadUpperCustomerWithForeginProuduct()
  {
  
	  	$input=Request::all();
        $input=(array)$input;
//			dd($input);
        $date=$input['FromTransDate'];
//       dd($date);
	  	$date = Carbon::createFromFormat('Y/m/d', $date)->toDateString() ;
//         dd($date);
    $output =$this->sales
->leftjoin($this->salesdetails->getTable(),$this->sales->getTable().'.SalesID','=', $this->salesdetails->getTable().'.SalesID')      
->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')
->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')
->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
   
   ->where($this->sales->getTable().'.SalesDate','>=', $date)
   ->where($this->sales->getTable().'.SalesDate','<=', $date)
   ->where($this->customers->getTable().'.CustomerType','=',2 )
 ->where($this->products->getTable().'.ProductType','=', 1 )		

 ->get();
	

        
//		dd($output);
  return Response()->json($output);
	
  } // end of function 
	  	
	
	
	
	  	
	
 public function LoadLocalCustomer()
  {
  
	  	$input=Request::all();
        $input=(array)$input;
//			dd($input);
        $date=$input['FromTransDate'];
//       dd($date);
	  	$date = Carbon::createFromFormat('Y/m/d', $date)->toDateString() ;
//         dd($date);
    $output =$this->sales
->leftjoin($this->salesdetails->getTable(),$this->sales->getTable().'.SalesID','=', $this->salesdetails->getTable().'.SalesID')      
->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')
->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')
->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
   
   ->where($this->sales->getTable().'.SalesDate','>=', $date)
   ->where($this->sales->getTable().'.SalesDate','<=', $date)
   ->where($this->customers->getTable().'.CustomerType','=',0 )
 	->where($this->products->getTable().'.ProductType','=', 0 )	
 ->get();
	

        
//		dd($output);
  return Response()->json($output);
	
  } // end of function 
	
	  		 public function LoadLocalCustomerWithforienProuduct()
  {
  
	  	$input=Request::all();
        $input=(array)$input;
//			dd($input);
        $date=$input['FromTransDate'];
//       dd($date);
	  	$date = Carbon::createFromFormat('Y/m/d', $date)->toDateString() ;
//         dd($date);
    $output =$this->sales
->leftjoin($this->salesdetails->getTable(),$this->sales->getTable().'.SalesID','=', $this->salesdetails->getTable().'.SalesID')      
->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')
->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')
->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
   
   ->where($this->sales->getTable().'.SalesDate','>=', $date)
   ->where($this->sales->getTable().'.SalesDate','<=', $date)
   ->where($this->customers->getTable().'.CustomerType','=',0 )
   ->where($this->products->getTable().'.ProductType','=', 1 )	

 ->get();
	

        
//		dd($output);
  return Response()->json($output);
	
  } // end of function 
	  		
	
	
	public function LoadCustomerCachDeposit()
  {
  
	  	$input=Request::all();
        $input=(array)$input;
//			dd($input);
        $date=$input['FromTransDate'];
//       dd($date);
	  	$date = Carbon::createFromFormat('Y/m/d', $date)->toDateString() ;
//         dd($date);
    $output =$this->cashDeposit
->leftjoin($this->customers->getTable(),$this->cashDeposit->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')      

   
   ->where($this->cashDeposit->getTable().'.TransDate','>=', $date)
   ->where($this->cashDeposit->getTable().'.TransDate','<=', $date)
//   ->where($this->customers->getTable().'.CustomerType','=',0 )

 ->get();
	

        
//		dd($output);
  return Response()->json($output);
	
  } // end of function 
	
	
	
		public function LoadCustomerChekDeposit()
  {
  
	  	$input=Request::all();
        $input=(array)$input;
//			dd($input);
        $date=$input['FromTransDate'];
//       dd($date);
	  	$date = Carbon::createFromFormat('Y/m/d', $date)->toDateString() ;
//         dd($date);
    $output =$this->checkDeposit
		->leftjoin($this->banks->getTable(),$this->checkDeposit->getTable().'.BanKID','=', $this->banks->getTable().'.BanKID') 
->leftjoin($this->customers->getTable(),$this->checkDeposit->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')      

   
   ->where($this->checkDeposit->getTable().'.TransDate','>=', $date)
   ->where($this->checkDeposit->getTable().'.TransDate','<=', $date)
//   ->where($this->customers->getTable().'.CustomerType','=',0 )

 ->get();
	

        
//		dd($output);
  return Response()->json($output);
	
  } // end of function 
	
//	StellUnderConstruction 
			public function LoadBankDepost()
  {
  
	  	$input=Request::all();
        $input=(array)$input;
//			dd($input);
        $date=$input['FromTransDate'];
//       dd($date);
	  	$date = Carbon::createFromFormat('Y/m/d', $date)->toDateString() ;
//         dd($date);
    $output =$this->bankDeposit
->leftjoin($this->banks->getTable(),$this->bankDeposit->getTable().'.BanKID','=', $this->banks->getTable().'.BanKID')      
->leftjoin($this->customers->getTable(),$this->bankDeposit->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')      

   
   ->where($this->bankDeposit->getTable().'.TransDate','>=', $date)
   ->where($this->bankDeposit->getTable().'.TransDate','<=', $date)
//   ->where($this->customers->getTable().'.CustomerType','=',0 )

 ->get();
	

        
//		dd($output);
  return Response()->json($output);
				
	
  } // end of function 	
	
	

			public function LoadChshPayment()
  {
  
	  	$input=Request::all();
        $input=(array)$input;
//			dd($input);
        $date=$input['FromTransDate'];
//       dd($date);
	  	$date = Carbon::createFromFormat('Y/m/d', $date)->toDateString() ;
//         dd($date);
    $output =$this->cashPayments
->leftjoin($this->suppliers->getTable(),$this->cashPayments->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')      

   
   ->where($this->cashPayments->getTable().'.TransDate','>=', $date)
   ->where($this->cashPayments->getTable().'.TransDate','<=', $date)
//   ->where($this->customers->getTable().'.CustomerType','=',0 )

 ->get();
	

        
//		dd($output);
  return Response()->json($output);
	
				
  } // end of function 		
	
	
	public function LoadCheckPayment()
  {
  
	  	$input=Request::all();
        $input=(array)$input;
//			dd($input);
        $date=$input['FromTransDate'];
//       dd($date);
	  	$date = Carbon::createFromFormat('Y/m/d', $date)->toDateString() ;
//         dd($date);
    $output =$this->checkPayments
		->leftjoin($this->banks->getTable(),$this->checkPayments->getTable().'.BanKID','=', $this->banks->getTable().'.BanKID')   
->leftjoin($this->suppliers->getTable(),$this->checkPayments->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')      

   
   ->where($this->checkPayments->getTable().'.TransDate','>=', $date)
   ->where($this->checkPayments->getTable().'.TransDate','<=', $date)
//   ->where($this->customers->getTable().'.CustomerType','=',0 )

 ->get();
	

        
//		dd($output);
  return Response()->json($output);
	
  } // end of function 
	
		public function LoadExpenses()
  {
  
			

	  	$input=Request::all();
        $input=(array)$input;
//			dd($input);
        $date=$input['FromTransDate'];
//       dd($date);
	  	$date = Carbon::createFromFormat('Y/m/d', $date)->toDateString() ;
//         dd($date);
    $output =$this->expenses
->leftjoin($this->cashiers->getTable(),$this->expenses->getTable().'.CashierID','=', $this->cashiers->getTable().'.CashierID')     
->leftjoin($this->expensesTypes->getTable(),$this->expenses->getTable().'.ExpenseTypeID','=', $this->expensesTypes->getTable().'.ExpenseTypeID')      

   
   ->where($this->expenses->getTable().'.TransDate','>=', $date)
   ->where($this->expenses->getTable().'.TransDate','<=', $date)
//   ->where($this->customers->getTable().'.CustomerType','=',0 )

 ->get();
	

        
//		dd($output);
  return Response()->json($output);
	
  } // end of function 
	

}//end of class 