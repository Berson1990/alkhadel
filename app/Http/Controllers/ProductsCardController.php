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





use Carbon\Carbon;
use Request;
use DB;
use Input;
use Illuminate\Support\Facades\Redirect;
use Response;

class ProductsCardController extends Controller {
	
	
	public function __construct()
    {
        $this->sales = new Sales();
        $this->salesdetails = new SalesDetails();
        $this->products = new Products();
        $this->customers = new Customers();
		$this->suppliers = new Suppliers();

	}
	
	
	public function index()
	{  
       
         
   return view("productscard.productscard");
	}
	
	
	
	 public function LoadProuduct()
  {
  
	  	$input=Request::all();
        $input=(array)$input;
//			dd($input);
		$products =$input['ProdcutID']; 
        $from =$input['FromTransDate'];
        $to =$input['ToTransDate'];
		 
//       dd($date);
	        $from = Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
      $to = Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;
//         dd($date);
    $output =$this->salesdetails
->leftjoin($this->sales->getTable(),$this->salesdetails->getTable().'.SalesID','=', $this->sales->getTable().'.SalesID')
->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
   
   ->where($this->sales->getTable().'.SalesDate','>=', $from)
   ->where($this->sales->getTable().'.SalesDate','<=',  $to )
   ->where($this->salesdetails->getTable().'.ProductID','=',$products )

 ->get();
	

        
//		dd($output);
  return Response()->json($output);
	
  } // end of function 
	  
}//end of class