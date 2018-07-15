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
use Carbon\Carbon;
use Request;
use DB;
use Input;
use Illuminate\Support\Facades\Redirect;
use Response;

class DeferredBillsController extends Controller {
	
	
	public function __construct()
    {
        $this->sales = new Sales();
        $this->salesdetails = new SalesDetails();
        $this->products = new Products();
        $this->customers = new Customers();
		$this->suppliers = new Suppliers();
		$this->endoutdeal = new EndoutDeal();
    }

	
	
	public function index()
	{  
         $totalcustomers=$this->customers
		 ->where($this->customers->getTable().'.CustomerType','=', 1  )
		 ->get();
		
         $totalsuppliers = suppliers::all();

   return view("deferredbills.deferredbills",compact('totalcustomers','totalsuppliers'));
	}


 
	    public function loadBills()
	{ 
         
        $input=Request::all();
        $input=(array)$input;
//			dd($input);
        $from=$input['FromTransDate'];
        $to=$input['ToTransDate'];
       $from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
       $to =   Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;
          
			
          if (isset($input['checkSuppliers']))
          {
              $CheckSuppliers=$input['checkSuppliers'];
          }
          else
          {
              $CheckSuppliers = 0 ;
          }
          
  

         // dd($CheckCustomers);
          
if($CheckSuppliers > 0)
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
   ->where($this->sales->getTable().'.CustomerID',$Customers )           
   ->where($this->salesdetails->getTable().'.SupplierID',$Suppliers )
 ->get();
	

        
//		dd($output);
  return Response()->json($output);
	
}else if($CheckSuppliers == 0){
	

    $Customers=$input['CustomersID'];
   $output =$this->sales
   ->leftjoin($this->salesdetails->getTable(),$this->sales->getTable().'.SalesID','=', $this->salesdetails->getTable().'.SalesID')     
   ->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')
   ->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')
    ->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
   
   ->where($this->sales->getTable().'.SalesDate','>=', $from)
   ->where($this->sales->getTable().'.SalesDate' ,'<=', $to )
   ->where($this->sales->getTable().'.CustomerID',$Customers )
	   ->get();     

    
//		dd($output);
	
return Response()->json($output);    
}
        		
	}//end of function load bills
	
	
	public function endoutdeal()
	{
	   $output =DB::select("select SalesID,created_at from tblendoutdeal");
//	dd($output);   
	return Response()->json($output); 
	}
	
	    public function AutoCompleteAbordCustomer(){

        $CustomerName = Input::get('CustomerName');
        $CustomerName  = trim($CustomerName);
        if (strlen($CustomerName) < 1){

            $output = ['status' => false , 'data' => ['message' => 'Type At Lease 1 char' ,'id' => '0'],'code' => illuminateReponse::HTTP_BAD_REQUEST];

        }else{

            $data = $this->customers->where('CustomerType', '=', "1")
                ->limit('30')
                ->select('CustomerID' ,'CustomerName','CustomerType');
            if ($data->count()){
                $output = ['status' => true , 'data' => $data->get() ,'code' => illuminateReponse::HTTP_OK];
            }else{
                $output = ['status' => false , 'data' => ['message' => 'no Match Data' ,'id' => '0'] ,'code' => illuminateReponse::HTTP_BAD_REQUEST];
            }

        }
//         dd($output);
    return Response::json($output);
    }
	
}//end of class