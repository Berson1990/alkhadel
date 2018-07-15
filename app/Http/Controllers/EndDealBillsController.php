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

class EndDealBillsController extends Controller {
	
	
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
         
   return view("enddealbills.enddealbills",compact('totalcustomers','totalsuppliers'));
	}
	
	
	    public function loadEndBills()
	{ 
         
        $input=Request::all();
	// dd($input);	
        $input=(array)$input;
		
        $from=$input['FromTransDate'];
        $to=$input['ToTransDate'];
//			$CheckSuppliers=$input['checkSuppliers']
//				 dd($CheckSuppliers);
       $from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
       $to =   Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;
          
			
          if (isset($input['checkCustomers']))
          {
              $CheckCustomers=$input['checkCustomers'];

          }
          else
          {
			  $CheckCustomers=0;

          }
			
          
         if(isset($input['checkSuppliers']))
		 {
			 
			   $CheckSuppliers=$input['checkSuppliers'];
		 }else{
			   $CheckSuppliers = 0 ;
		 }


			
if( $CheckCustomers > 0 && $CheckSuppliers > 0  )
{

	$Suppliers=$input['SupplierID'];
    $Customers=$input['CustomersID'];

// dd($Customers);
	
	$output=DB::select("select DISTINCT tblendoutdeal.SalesID,valuesold,billexpenses,tblendoutdeal.commision,Total_1,CustomerName,estimatedvalue,internalexpenses,Total_2 ,RefNo  ,SalesDate from tblendoutdeal  join tblsales 
	 on tblendoutdeal.SalesID = tblsales.SalesID 
	 join tblsalesdetails 
	 on tblendoutdeal.SalesID = tblsalesdetails.SalesID
	 left join tblcustomers on tblcustomers.CustomerID = tblsales.CustomerID
	  WHERE SalesDate >= '$from' 
		AND   SalesDate <= '$to'
		AND tblsalesdetails.SupplierID ='$Suppliers'
		AND tblsales.CustomerID='$Customers'");
	

        
//	dd($output);
  return Response()->json($output);
	
}else if($CheckCustomers == 0 && $CheckSuppliers == 0 )
{
	

//	$Suppliers=$input['SupplierID'];
//    $Customers=$input['CustomersID'];
	
	$output=DB::select("select DISTINCT tblendoutdeal.SalesID,valuesold,billexpenses,tblendoutdeal.commision,Total_1,CustomerName,estimatedvalue,internalexpenses,Total_2 ,RefNo ,SalesDate from tblendoutdeal  join tblsales 
	 on tblendoutdeal.SalesID = tblsales.SalesID 
	 join tblsalesdetails 
	 on tblendoutdeal.SalesID = tblsalesdetails.SalesID
      join tblcustomers 
      on  tblcustomers.CustomerID =tblsales.CustomerID
	  WHERE SalesDate >= '$from' 
		AND   SalesDate <= '$to'");
	
	
	

	
return Response()->json($output); 

}else if($CheckCustomers == 0 && $CheckSuppliers > 0 )
{
	

//    $Customers=$input['CustomersID'];
	$Suppliers=$input['SupplierID'];
	
		$output=DB::select("select DISTINCT tblendoutdeal.SalesID,valuesold,billexpenses,tblendoutdeal.commision,Total_1,CustomerName,estimatedvalue,internalexpenses,Total_2 ,RefNo ,SalesDate from tblendoutdeal  join tblsales 
	 on tblendoutdeal.SalesID = tblsales.SalesID 
	 join tblsalesdetails 
	 on tblendoutdeal.SalesID = tblsalesdetails.SalesID
      join tblcustomers 
      on  tblcustomers.CustomerID =tblsales.CustomerID
	  WHERE SalesDate >= '$from' 
		AND   SalesDate <= '$to'
		AND tblsalesdetails.SupplierID = '$Suppliers'");
	
	
	
return Response()->json($output);  
	
}else if($CheckSuppliers == 0 && $CheckCustomers > 0 )
  
{

    $Customers=$input['CustomersID'];
//	dd($Customers);

	
//	$Suppliers=$input['SupplierID'];
//    $Customers=$input['CustomersID'];
	
    
	$output=DB::select("select DISTINCT tblendoutdeal.SalesID,valuesold,billexpenses,tblendoutdeal.commision,Total_1,CustomerName,estimatedvalue,internalexpenses,Total_2,SalesDate ,RefNo from tblendoutdeal  join tblsales 
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
	
}
	
	
	
//laod dietales of product 
	    public function loadBillsDetalis()
	{ 
         
        $input=Request::all();
//	dd($input);	
        $input=(array)$input;
		
        $from=$input['FromTransDate'];
        $to=$input['ToTransDate'];
//			$CheckSuppliers=$input['checkSuppliers']
//				 dd($CheckSuppliers);
       $from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
       $to =   Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;
          
			
          if (isset($input['checkCustomers']))
          {
              $CheckCustomers=$input['checkCustomers'];
//			   $CheckSuppliers=$input['checkSuppliers'];
          }
          else
          {
			  $CheckCustomers=0;
//              $CheckSuppliers = 0 ;
          }
          
         if(isset($input['checkSuppliers']))
		 {
			 
			   $CheckSuppliers=$input['checkSuppliers'];
		 }else{
			   $CheckSuppliers = 0 ;
		 }

       
          
if( $CheckCustomers > 0 && $CheckSuppliers > 0  )
{

	$Suppliers=$input['SupplierID'];
    $Customers=$input['CustomersID'];
   
             $output=DB::select("select  tblsales.SalesDate,CustomerName,SupplierName,ProductName,RefNo
    ,Weight,ProductPrice,Total from tblsales  join tblsalesdetails on tblsales.SalesID = tblsalesdetails. SalesID join tblproducts 

     on  tblproducts.ProductID = tblsalesdetails.ProductID
     join tblsuppliers
     on tblsuppliers.SupplierID = tblsalesdetails.SupplierID  

     join tblcustomers 
      on  tblcustomers.CustomerID =tblsales.CustomerID
     
      WHERE SalesDate >= '$from' 
		AND   SalesDate <= '$to'
        And  CustomerType = '1'
        
        ");
	

  return Response()->json($output);
	
}else if($CheckCustomers == 0 && $CheckSuppliers == 0 )
{
	
    
         $output=DB::select("select  tblsales.SalesDate ,CustomerName,SupplierName,ProductName,RefNo
    ,Weight,ProductPrice,Total from tblsales  join tblsalesdetails on tblsales.SalesID = tblsalesdetails.SalesID   join tblproducts 

     on  tblproducts.ProductID = tblsalesdetails.ProductID
     join tblsuppliers
     on tblsuppliers.SupplierID = tblsalesdetails.SupplierID  
     join tblcustomers 
      on  tblcustomers.CustomerID =tblsales.CustomerID

     
        WHERE SalesDate >= '$from' 
		AND   SalesDate <= '$to'
          And  CustomerType = '1'
        ");
	
    
    

	
return Response()->json($output);    
    
    
    
}else if( $CheckSuppliers > 0 && $CheckCustomers == 0 )
{
	

//    $Customers=$input['CustomersID'];
	$Suppliers=$input['SupplierID'];
    
        $output=DB::select("select  tblsales.SalesDate ,CustomerName, SupplierName,ProductName ,RefNo
    ,Weight,ProductPrice,Total from tblsales  join tblsalesdetails on tblsales.SalesID = tblsalesdetails. SalesID     join tblproducts 

     on  tblproducts.ProductID = tblsalesdetails.ProductID
     join tblsuppliers
     on tblsuppliers.SupplierID = tblsalesdetails.SupplierID  

     join tblcustomers 
      on  tblcustomers.CustomerID =tblsales.CustomerID
     
      WHERE SalesDate >= '$from' 
		AND   SalesDate <= '$to'
          And  CustomerType = '1'
		AND tblsuppliers.SupplierID='$Suppliers'");
	
    
    
 
return Response()->json($output);
	

 }else if($CheckCustomers > 0 && $CheckSuppliers == 0){

   $Customers=$input['CustomersID'];
   

    $output=DB::select("select  tblsales.SalesDate,CustomerName ,SupplierName,ProductName,RefNo
    ,Weight,ProductPrice,Total from tblsales  join tblsalesdetails on tblsales.SalesID = tblsalesdetails.SalesID   join tblproducts 

     on  tblproducts.ProductID = tblsalesdetails.ProductID
     join tblsuppliers
     on tblsuppliers.SupplierID = tblsalesdetails.SupplierID  

     join tblcustomers 
      on  tblcustomers.CustomerID =tblsales.CustomerID
     
      WHERE SalesDate >= '$from' 
		AND   SalesDate <= '$to'
          And  CustomerType = '1'
		AND tblsales.CustomerID='$Customers'");
	
    
    
//	dd($output);
	
return Response()->json($output);    
}
	
}//end of function	
	
}//end of class