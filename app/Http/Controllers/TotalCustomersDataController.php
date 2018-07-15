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

class TotalCustomersDataController extends Controller {
	public function index()
	{  
        $totalsuppliers = Suppliers::all();

        return view('totalcustomersdata.totalcustomersdata',compact('totalsuppliers'));
        
	}
    
    
    public function __construct()
    {
        $this->sales = new Sales();
        $this->salesdetails = new SalesDetails();
        $this->products = new Products();
        $this->customers = new Customers();
        $this->suppliers = new Suppliers();
        
        
        
    }

    public function combine(){
      $input=Request::all();
      $input=(array)$input;  
 
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
      $to =     Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;   

        $results = DB::select("select Discount,Nowlon,Custody,CustomerType,Carrying  
                                from tblsales 
                                LEFT OUTER JOIN tblcustomers
                                ON tblsales.CustomerID=tblcustomers.CustomerID

                                LEFT OUTER JOIN tblsalesdetails
                                ON tblsales.SalesID=tblsalesdetails.SalesID

                                WHERE SalesDate >= '$from' AND SalesDate <= '$to' ");
        // dd($results);

      return Response()->json($output);
    }

      public function loadTotalCustomersData ()
	{ 
        $input=Request::all();
        $input=(array)$input;    
      
          
          
        $from=$input['FromTransDate'];
        $to=$input['ToTransDate'];
        $from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
        $to =   Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;
        $prouductType=$input['ProuductID'];
     
          
          if(isset($input['isCustomer'])){

          
        $Supplier=$input['SupplierID'];
          
                          $output =$this->sales
            ->leftjoin($this->salesdetails->getTable(),$this->sales->getTable().'.SalesID','=', $this->salesdetails->getTable().'.SalesID')
           
             ->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')
            
            ->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
           
           ->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')

            ->where($this->sales->getTable().'.SalesDate','>=', $from  )
            ->where($this->sales->getTable().'.SalesDate' ,'<=', $to    )
             ->where($this->products->getTable().'.ProductType' , $prouductType)  
             ->where($this->salesdetails->getTable().'.SupplierID' , $Supplier  )
            ->get();
        
        return Response()->json($output);
        
        
          }
           
          
          else{
           
               $output =$this->sales
            ->leftjoin($this->salesdetails->getTable(),$this->sales->getTable().'.SalesID','=', $this->salesdetails->getTable().'.SalesID')
            
            ->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID')
            
            ->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
            
            ->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')
            
            ->where($this->sales->getTable().'.SalesDate','>=', $from  )
            ->where($this->sales->getTable().'.SalesDate' ,'<=', $to    )
                    ->where($this->products->getTable().'.ProductType' , $prouductType)  
           
            
            ->get();
          
          // dd($output);
        return Response()->json($output);
              
        
          }
          
          
 
        
          
   
		
	}
    
}?>
