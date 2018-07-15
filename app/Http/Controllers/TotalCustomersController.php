<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Http\Models\Customers;
use App\Http\Models\Products;
use App\Http\Models\SalesDetails;
use App\Http\Models\Sales;
use App\Http\Models\Suppliers;
use Carbon\Carbon;
use Request;
use DB;

class TotalCustomersController extends Controller {
	public function index()
	{  
        
        $totalcustomers = Customers::all();
        return view('totalcustomers.totalcustomers',compact('totalcustomers'));
        
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
//          dd($input);
        $input=(array)$input;    
          
//          dd($input['isCustomer']);
          
          
          
        $from=$input['FromTransDate'];
        $to=$input['ToTransDate'];
        $from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
        $to =   Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;

     
                  if (isset($input['SuppliersTypes']))
          {
              $CheckSuppliers=$input['SuppliersTypes'];
          }
          else
          {
              $CheckSuppliers = 0 ;
          }
          
                         if (isset($input['isCustomer']))
          {
              $CheckCustomers=$input['isCustomer'];
          }
          else
          {
              $CheckCustomers = 0 ;
          }
          
          
          
          
          
          
          
          if( $CheckSuppliers > 0 &&$CheckCustomers > 0 ){

            
        $Customers=$input['CustomerID'];
        $SuppliersType=$input['SupplierTypeID'];
          
                          $output =$this->salesdetails
            ->leftjoin($this->sales->getTable(),$this->salesdetails->getTable().'.SalesID','=', $this->sales->getTable().'.SalesID')
            
            ->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
           
            ->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID') 
->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')
            ->where($this->sales->getTable().'.SalesDate','>=', $from  )
            ->where($this->sales->getTable().'.SalesDate' ,'<=', $to    )
             ->where($this->sales->getTable().'.CustomerID' , $Customers  )
             ->where($this->suppliers->getTable().'.SupplierType' , $SuppliersType  )
             // ->groupBy('ProductName')
                               ->orderBy('SupplierName', 'asc')
                               ->orderBy('ProductName', 'asc')
                               
            ->get();
//        dd($output);
        return Response()->json($output);
        
          
          }
           
          
          else if($CheckSuppliers == 0 &&$CheckCustomers == 0){
           
                                  $output =$this->salesdetails
            ->leftjoin($this->sales->getTable(),$this->salesdetails->getTable().'.SalesID','=', $this->sales->getTable().'.SalesID')
            
            ->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
           
            ->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID') 
->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')
            ->where($this->sales->getTable().'.SalesDate','>=', $from  )
            ->where($this->sales->getTable().'.SalesDate' ,'<=', $to    )
//             ->where($this->sales->getTable().'.CustomerID' , $Customers  )
//             ->where($this->suppliers->getTable().'.SupplierType' , $SuppliersType  )
              // ->groupBy('ProductName')
                                     ->orderBy('SupplierName', 'asc')  
                                     ->orderBy('ProductName', 'asc')
                                     
            ->get();  
//        dd($output);
        return Response()->json($output);
              
        
          }if($CheckSuppliers > 0 &&$CheckCustomers == 0){
              
              
                          
//        $Customers=$input['CustomerID'];
        $SuppliersType=$input['SupplierTypeID'];
          
                   $output =$this->salesdetails
            ->leftjoin($this->sales->getTable(),$this->salesdetails->getTable().'.SalesID','=', $this->sales->getTable().'.SalesID')
            
            ->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
           
            ->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID') 
->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')
            ->where($this->sales->getTable().'.SalesDate','>=', $from  )
            ->where($this->sales->getTable().'.SalesDate' ,'<=', $to    )
//             ->where($this->sales->getTable().'.CustomerID' , $Customers  )
             ->where($this->suppliers->getTable().'.SupplierType' , $SuppliersType  )
                // ->groupBy('ProductName')
                       ->orderBy('SupplierName', 'asc')
                       ->orderBy('ProductName', 'asc')
                      

//                       ->groupBy('SupplierName')
            ->get();
       // dd($output);
        return Response()->json($output);
              
              
              
              
          }else if ($CheckSuppliers == 0 &&$CheckCustomers > 0){
              
                    $Customers=$input['CustomerID'];
//        $SuppliersType=$input['SupplierTypeID'];
          
                          $output =$this->sales
            ->leftjoin($this->salesdetails->getTable(),$this->sales->getTable().'.SalesID','=', $this->salesdetails->getTable().'.SalesID')
            
            ->leftjoin($this->products->getTable(),$this->salesdetails->getTable().'.ProductID','=', $this->products->getTable().'.ProductID')
           
            ->leftjoin($this->customers->getTable(),$this->sales->getTable().'.CustomerID','=', $this->customers->getTable().'.CustomerID') 
->leftjoin($this->suppliers->getTable(),$this->salesdetails->getTable().'.SupplierID','=', $this->suppliers->getTable().'.SupplierID')
            ->where($this->sales->getTable().'.SalesDate','>=', $from  )
            ->where($this->sales->getTable().'.SalesDate' ,'<=', $to    )
             ->where($this->sales->getTable().'.CustomerID' , $Customers  )
//             ->where($this->suppliers->getTable().'.SupplierType' , $SuppliersType  )
                               // ->groupBy('ProductName')
                               ->orderBy('SupplierName', 'asc')
                               ->orderBy('ProductName', 'asc')
                                
            ->get();
       // dd($output);
        return Response()->json($output); 

          }

      }
          
   function getTottalSupplers(){

             $input=Request::all();
//          dd($input);
        $input=(array)$input;    
          
//          dd($input['isCustomer']);
          
          
          
        $from=$input['FromTransDate'];
        $to=$input['ToTransDate'];
        $from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
        $to =   Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;

     
                  if (isset($input['SuppliersTypes']))
          {
              $CheckSuppliers=$input['SuppliersTypes'];


          }
          else
          {
              $CheckSuppliers = 0 ;
          }
          
                         if (isset($input['isCustomer']))
          {
              $CheckCustomers=$input['isCustomer'];
          }
          else
          {
              $CheckCustomers = 0 ;
          }
          
      if( $CheckSuppliers > 0 &&$CheckCustomers > 0 ){

           $Customers=$input['CustomerID'];
           $SuppliersType=$input['SupplierTypeID'];

    $output = DB::select("Select tblsuppliers.SupplierID ,tblsuppliers.SupplierName  ,SUM(tblsalesdetails.Total) as Total, SUM(tblsalesdetails.Weight) as Weight,  SUM(tblsalesdetails.Quantity)as Quantity  from tblsalesdetails 
          LEFT JOIN tblsales  on tblsales.SalesID = tblsalesdetails.SalesID
          LEFT JOIN tblsuppliers on tblsalesdetails.SupplierID = tblsuppliers.SupplierID

          WHERE tblsales.SalesDate >= '$from' 
          AND   tblsales.SalesDate <= '$to'
          AND   tblsuppliers.SupplierType  = '$SuppliersType'

          AND  tblsales.CustomerID = '$Customers'
          GROUP BY tblsalesdetails.SupplierID
          ORDER BY tblsuppliers.SupplierName ASC ");

               return Response()->json($output); 


        }else if($CheckSuppliers == 0 &&$CheckCustomers == 0){


              $output = DB::select("Select tblsuppliers.SupplierID ,tblsuppliers.SupplierName  ,SUM(tblsalesdetails.Total) as Total , SUM(tblsalesdetails.Total) as Total, SUM(tblsalesdetails.Weight) as Weight,  SUM(tblsalesdetails.Quantity)as Quantity from tblsalesdetails 
          LEFT JOIN tblsales  on tblsales.SalesID = tblsalesdetails.SalesID
          LEFT JOIN tblsuppliers on tblsalesdetails.SupplierID = tblsuppliers.SupplierID
          WHERE tblsales.SalesDate >= '$from' 
          AND   tblsales.SalesDate <= '$to'
          GROUP BY tblsalesdetails.SupplierID
           ORDER BY tblsuppliers.SupplierName ASC ");

                     return Response()->json($output); 

        }if($CheckSuppliers > 0 &&$CheckCustomers == 0){


                  $SuppliersType=$input['SupplierTypeID'];

              $output = DB::select("Select tblsuppliers.SupplierID ,tblsuppliers.SupplierName  ,SUM(tblsalesdetails.Total) as Total ,SUM(tblsalesdetails.Total) as Total, SUM(tblsalesdetails.Weight) as Weight,  SUM(tblsalesdetails.Quantity)as Quantity  from tblsalesdetails 
          LEFT JOIN tblsales  on tblsales.SalesID = tblsalesdetails.SalesID
          LEFT JOIN tblsuppliers on tblsalesdetails.SupplierID = tblsuppliers.SupplierID
          WHERE tblsales.SalesDate >= '$from' 
          AND   tblsales.SalesDate <= '$to'
          AND  tblsuppliers.SupplierType  = '$SuppliersType'
          GROUP BY tblsalesdetails.SupplierID
           ORDER BY tblsuppliers.SupplierName ASC ");

    return Response()->json($output); 

        }else if ($CheckSuppliers == 0 &&$CheckCustomers > 0){


                    $Customers=$input['CustomerID'];

              $output = DB::select("Select tblsuppliers.SupplierID ,tblsuppliers.SupplierName  ,SUM(tblsalesdetails.Total) as Total , SUM(tblsalesdetails.Total) as Total, SUM(tblsalesdetails.Weight) as Weight,  SUM(tblsalesdetails.Quantity)as Quantity from tblsalesdetails 
          LEFT JOIN tblsales  on tblsales.SalesID = tblsalesdetails.SalesID
          LEFT JOIN tblsuppliers on tblsalesdetails.SupplierID = tblsuppliers.SupplierID
         
          WHERE tblsales.SalesDate >= '$from' 
          AND   tblsales.SalesDate <= '$to'
          AND  tblsales.CustomerID = '$Customers'
          GROUP BY tblsalesdetails.SupplierID
          ORDER BY tblsuppliers.SupplierName ASC ");

                   return Response()->json($output); 

        } 
        // dd($output);
       
   }// end of function 
		
	
    
}

?>
