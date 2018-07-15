<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Response;
use App\Http\Models\Customers;
use App\Http\Models\Products;
use App\Http\Models\SalesDetails;
use App\Http\Models\Sales;
use App\Http\Models\Suppliers;
use App\Http\Models\Containers;
use App\Http\Models\ContainerCustoms;
use DB;
use Response;
use Carbon\Carbon;
use Request;
use Input;
use Illuminate\Http\Response as illuminateReponse;

class ForeignSuppliersController extends Controller {
	
	public function __construct()
    {
        $this->suppliers = new Suppliers();
        $this->salesdetails = new SalesDetails();
        $this->sales = new Sales();
        $this->products = new Products();
		
        $this->containers = new Containers();
        $this->containercustoms = new ContainerCustoms();
    
        
        
        
    } 
	public function index()
	{  
		 $suppliers=$this->suppliers
		 ->where($this->suppliers->getTable().'.SupplierType','=', 1  )
			 ->get();
        return view('foreignsuppliers.foreignsuppliers',compact('suppliers'));
        
	}
	
	public function loadforeignContainers(){
	
			$input=Request::all();
		 	$Suppliers=$input['SupplierID'];  
//		   dd($Suppliers)
			$input=(array)$input;  
		
			$containers=$this->containers
			->where($this->containers->getTable().'.SupplierID','=',$Suppliers)
		    ->get();  
		
//			dd($containers);
		 return Response()->json($containers);
	}
    
		public function loadSerialContainers(){
	
			$input=Request::all();
		 	$Suppliers=$input['SupplierID'];  
//		   dd($Suppliers)
			$input=(array)$input;  
		
			$output=$this->containers
			->where($this->containers->getTable().'.SupplierID','=',$Suppliers)
		    ->get();  
		
//			dd($containers);
		 return Response()->json($output);
	}
	
	
	
	public function loadforeignsupppliers()
	{
		$input=Request::all();
//	dd($input);
		 $Suppliers=$input['SupplierID'];  

        
//		 $Container=$input['ContainerID'];
        
         if (isset($input['ContainerID']))
         {
             $Container=$input['ContainerID'];      
             
         }else {
              $Container= 0; 
             
         }
        
		 $serialContainer=$input['SerialContainerID'];
       
//		 dd($Container);
		$input=(array)$input;    
		$from=$input['FromTransDate'];
		$to=$input['ToTransDate'];
		$from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
		$to =   Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;
		
		
$output=DB::select("select SalesDate,RefNo,tblsalesdetails.SupplierID,SupplierName, Weight,Quantity,ProductPrice,WeightType ,Total,tblcontainers.Commision,tblcontainers.Nowlon ,ProductName,ContainerLocalNum ,tblcontainers.OtherExpenses,CustomerName ,ContainerIntNum ,Carrying                            
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
								AND tblsalesdetails.SupplierID = '$Suppliers'
								AND tblcontainers.ContainerIntNum = '$Container'

								OR tblcontainers.ContainerLocalNum = '$serialContainer'
                                ");
		
//			$myObject= (object) array_merge((array) $output, (array) $output2);
//			$json = json_encode($myObject);
		
//		dd($output);
		 return Response()->json($output);
   
	}
	public function GetCustomMount(){
		$input=Request::all();
//		dd($input);
//		 $Container=$input['ContainerID'];  
// 		dd($Container);
        
            if (isset($input['ContainerID']))
         {
             $Container=$input['ContainerID'];      
             
         }else {
              $Container= 0; 
             
         }
        
        
        
        
        
		$input=(array)$input;
		$output2=	DB::select(" select CustomName ,CustomMount ,ContainerIntNum
        from tblcontainercustoms 
        LEFT JOIN tblcontainers 
        ON tblcontainers.ContainerID = tblcontainercustoms.ContainerID 
         LEFT JOIN tblcustoms 
        ON tblcontainercustoms.CustomID = tblcustoms.CustomID 
        WHERE tblcontainers.ContainerIntNum = '$Container' ");
	
//		dd($output2);

				 return Response()->json($output2);
  
	}
	
	
	    public function AutoCompleteForiegnSupplier(){

        $SupplierName = Input::get('SupplierName');
        $SupplierName  = trim($SupplierName);
        if (strlen($SupplierName) < 1){

            $output = ['status' => false , 'data' => ['message' => 'Type At Lease 1 char' ,'id' => '0'],'code' => illuminateReponse::HTTP_BAD_REQUEST];

        }else{

            $data = $this->suppliers->where('SupplierType', '=', "1")
                ->limit('10')
                ->select('SupplierID' ,'SupplierName','SupplierType','SupplierCommision');
            if ($data->count()){
                $output = ['status' => true , 'data' => $data->get() ,'code' => illuminateReponse::HTTP_OK];
            }else{
                $output = ['status' => false , 'data' => ['message' => 'no Match Data' ,'id' => '0'] ,'code' => illuminateReponse::HTTP_BAD_REQUEST];
            }

        }
//   dd($output);
        return Response::json($output);
    }

	
//	public function AutoCompleteSupplierName()
//	{
//		
//		
//		        $SupplierName = Input::get('SupplierName');
//                $SupplierName = trim($SupplierName);
//
//        if (strlen($SupplierName) < 1){
//
//            $output = ['status' => false , 'data' => ['message' => 'Type At Lease 1 char' ,'id' => '0'],'code' => illuminateReponse::HTTP_BAD_REQUEST];
//
//        }else{
//
//            $data = $this->suppliers->where('SupplierName', 'LIKE', '%'. trim($SupplierName) .'%')
//                ->limit('10')
//                ->select('SupplierID' ,'SupplierName');
//            if ($data->count()){
//                $output = ['status' => true , 'data' => $data->get() ,'code' => illuminateReponse::HTTP_OK];
//            }else{
//                $output = ['status' => false , 'data' => ['message' => 'no Match Data' ,'id' => '0'] ,'code' => illuminateReponse::HTTP_BAD_REQUEST];
//            }
//
//        }
////	
////	  	 $suppliers=$this->suppliers
////			 ->where($this->suppliers->getTable().'.SupplierType','=', 1  )
////			 ->get();
//		
//	 return Response()->json($output);
//	    
//	}
//	
	
	
	
	
}
?>