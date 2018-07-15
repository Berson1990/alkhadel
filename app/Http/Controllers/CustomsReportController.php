<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Http\Models\CustomOpeningBalance;
use App\Http\Models\Customs;
use App\Http\Models\CustomRefund;
use App\Http\Models\ContainerCustoms;
use App\Http\Models\CustomePayment;
use App\Http\Models\Containers;
use Carbon\Carbon;
use Request;

class CustomsReportController extends Controller {
    
    
    
   public function index()
	{  
     
   return view("customsreport.customsreport");
	}
    
     public function __construct()
    {
        $this->customOpeningBalance = new CustomOpeningBalance();
        $this->customs = new Customs();
        $this->containercustoms = new ContainerCustoms();
        $this->customepayment = new CustomePayment();
        $this->containers = new Containers();
        $this->customrefund = new CustomRefund();
       
    }
    
   function GetCustomsPayment()
   {
       
       $input=Request::all();
        $input=(array)$input;
       
       $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
       $from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
       $to =   Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;
        $CustomName=$input['CustomID'];
       
      
       $output=$this->customepayment
->leftjoin($this->customs->getTable(),$this->customepayment->getTable().'.CustomID','=', $this->customs->getTable().'.CustomID')
    ->where($this->customepayment->getTable().'.TransDate','>=', $from)
   ->where($this->customepayment->getTable().'.TransDate' ,'<=', $to )
   ->where($this->customs->getTable().'.CustomID' , $CustomName)
   ->get();    
    //		dd($output);
  return Response()->json($output);   
       
   }
    
    
   function GetCustomsOpeinigStatment()
   {
       
       $input=Request::all();
        $input=(array)$input;
       
       $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
       $from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
       $to =   Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;
        $CustomName=$input['CustomID'];
       
      
       $output=$this->customOpeningBalance
->leftjoin($this->customs->getTable(),$this->customOpeningBalance->getTable().'.CustomID','=', $this->customs->getTable().'.CustomID')
   //  ->where($this->customOpeningBalance->getTable().'.TransDate','>=', $from)
   // ->where($this->customOpeningBalance->getTable().'.TransDate' ,'<=', $to )
   ->where($this->customs->getTable().'.CustomID' , $CustomName)
   ->get();    
    //		dd($output);
  return Response()->json($output);   
       
   }
        
    
       function getVlueCustomContiner()
   {
       
       $input=Request::all();
        $input=(array)$input;
       
       // $from=$input['FromTransDate'];
      // $to=$input['ToTransDate'];
       // $from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
       // $to =   Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;
        $CustomName=$input['CustomID'];
       
      
       $output=$this->containercustoms
->leftjoin($this->containers->getTable(),$this->containercustoms->getTable().'.ContainerID','=', $this->containers->getTable().'.ContainerID')
->leftjoin($this->customs->getTable(),$this->containercustoms->getTable().'.CustomID','=', $this->customs->getTable().'.CustomID')
    // ->where($this->containers->getTable().'.ContainerOpenDate','>=', $from)
   // ->where($this->containers->getTable().'.ContainerEndDate' ,'<=', $to )
   ->where($this->customs->getTable().'.CustomID' , $CustomName)
   ->get();    
   		// dd($output);
  return Response()->json($output);   
       
   }
        
    
    
    function GetCustomsRefund ()
    {
       $input=Request::all();
       $input=(array)$input;
       $from=$input['FromTransDate'];
       $to=$input['ToTransDate'];
       $from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
       $to =   Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;
       $CustomName=$input['CustomID'];

        $output = $this->customrefund
         ->leftjoin($this->customs->getTable(),$this->customrefund->getTable().'.CustomID','=', $this->customs->getTable().'.CustomID')
        ->where($this->customrefund->getTable().'.RefundDate','>=', $from)
        ->where($this->customrefund->getTable().'.RefundDate' ,'<=', $to )
        ->where($this->customs->getTable().'.CustomID' , $CustomName)
        ->get();

          // dd($output);
         return Response()->json($output);    


    }// end of function 
    
    
    
    
    
    
    
    
    
    
    
}





?>