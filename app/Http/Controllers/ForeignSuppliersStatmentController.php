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

class ForeignSuppliersStatmentController extends Controller {
	
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
        return view('foreignsuppliersstatment.foreignsuppliersstatment',compact('suppliers'));
        
	}
    
    
    
    public function loadforeignsupppliersStatment()
	{
		$input=Request::all();
	
		 $Suppliers=$input['SupplierID'];  

		$input=(array)$input;    
		$from=$input['FromTransDate'];
		$to=$input['ToTransDate'];
		$from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
		$to =   Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;
		
		
		$output=DB::select("select SalesDate, Weight,Quantity,ProductPrice,WeightType ,Total,tblcontainers.Commision,tblcontainers.Nowlon ,ProductName,ContainerLocalNum ,tblcontainers.OtherExpenses,CustomerName ,ContainerIntNum ,Carrying                            
                                from tblsalesdetails  LEFT JOIN  tblsales  
								ON tblsalesdetails.SalesID = tblsales.SalesID
								
					
                                LEFT JOIN tblcontainers 
								ON tblsalesdetails.ContainerID = tblcontainers.ContainerID
								
								LEFT JOIN tblproducts
								ON tblsalesdetails.ProductID = tblproducts.ProductID
                                LEFT JOIN tblcustomers
								ON tblsales.CustomerID = tblcustomers.CustomerID

                               WHERE SalesDate >= '$from' 
								AND   SalesDate <= '$to'
								AND tblsalesdetails.SupplierID = '$Suppliers'");
		
//			$myObject= (object) array_merge((array) $output, (array) $output2);
//			$json = json_encode($myObject);
		
//		dd($output);
		 return Response()->json($output);
   
	}
	public function GetCustomMountStatment(){
		$input=Request::all();
        
//		dd($input);
//		$Container=$input['ContainerID'];  
         $Suppliers=$input['SupplierID'];  
 
		$input=(array)$input;
		$output2=	DB::select(" select CustomName ,CustomMount 
        from tblcontainercustoms 
        LEFT JOIN tblcontainers 
        ON tblcontainers.ContainerID = tblcontainercustoms.ContainerID 
         LEFT JOIN tblcustoms 
        ON tblcontainercustoms.CustomID = tblcustoms.CustomID 
        WHERE tblcontainers.SupplierID = '$Suppliers' ");
	
//		dd($output2);

 return Response()->json($output2);
  
	}

  public function getOtherExpenses()
	{
		$input=Request::all();
		$Suppliers=$input['SupplierID']; 
		$input=(array)$input;    
		$from=$input['FromTransDate'];
		$to=$input['ToTransDate'];
		$from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
		$to =   Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;
		
		
		$output=DB::select("select SalesDate, Weight,Quantity,ProductPrice,WeightType,SUM(Total) as Total,CustomMount,tblcontainers.Nowlon,tblcontainers.Commision,tblcontainers.Nowlon ,ProductName,ContainerLocalNum ,tblcontainers.OtherExpenses,CustomerName ,ContainerIntNum ,Carrying                         
                                                   
                                from tblsalesdetails  LEFT JOIN  tblsales  
								ON tblsalesdetails.SalesID = tblsales.SalesID
								
					
                                LEFT JOIN tblcontainers 
								ON tblsalesdetails.ContainerID = tblcontainers.ContainerID
								
								LEFT JOIN tblproducts
								ON tblsalesdetails.ProductID = tblproducts.ProductID
                                LEFT JOIN tblcustomers
								ON tblsales.CustomerID = tblcustomers.CustomerID
								 LEFT join tblcontainercustoms 
                                on tblcontainers.ContainerID = tblcontainercustoms.ContainerID
                               WHERE SalesDate >= '$from' 
								AND   SalesDate <= '$to'
								AND tblsalesdetails.SupplierID = '$Suppliers'
								Group by ContainerIntNum");
		

		 return Response()->json($output);
   
   
	}
	
	
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}




?>    
    