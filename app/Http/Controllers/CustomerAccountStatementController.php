<?php namespace App\Http\Controllers;

use App\Http\Models\Customers;
use App\Http\Models\CustomerOpeningBalance;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;
use DB;

class CustomerAccountStatementController extends Controller {

	public function index()
	{
		
        $Customers = Customers::all();
       
        // $x=CustomerOpeningBalance::all();
        // dd($x);
        return view('customeraccountstatement.customeraccountstatement' ,compact('Customers'));

	}

	

    public function loadData(){
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $Customer=$input['CustomerIDas'];

     // $query1 = DB::table('tblcashdeposit')
     $query1 = DB::table('tblcheckdeposit')
     ->selectRaw( 'TransDate')
     ->selectRaw( 'Mount')
     ->selectRaw( 'Notes')
     ->where('TransDate','>=', $from)
     ->where('TransDate' ,'<=', $to )
     ->where('CustomerID' ,'=', $Customer )
     ->get();
     return Response()->json($query1);
 
    }
    public function loadData2(){
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $Customer=$input['CustomerIDas'];

     
     $query2 = DB::table('tblcustomeropeningbalance')
     ->selectRaw( 'TransDate')
     ->selectRaw( 'Mount')
     ->selectRaw( 'Notes')
     ->selectRaw( 'Debt')
     ->where('TransDate','>=', $from)
     ->where('TransDate' ,'<=', $to )
     ->where('CustomerID' ,'=', $Customer )
     ->get();
    return Response()->json($query2);
     // return 0;
    }

    public function loadData3(){
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $Customer=$input['CustomerIDas'];

     
     $query3 = DB::table('tblcashdeposit')
     ->selectRaw( 'TransDate')
     ->selectRaw( 'Mount')
     ->selectRaw( 'Notes')
     ->where('TransDate','>=', $from)
     ->where('TransDate' ,'<=', $to )
     ->where('CustomerID' ,'=', $Customer )
     ->get();
    return Response()->json($query3);
     
    }

    public function loadData4(){
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $Customer=$input['CustomerIDas'];

     
     $query4 = DB::table('tblcustomerrefund')
     ->selectRaw( 'RefundDate')
     ->selectRaw( 'Refund')
     ->selectRaw( 'Notes')
     ->where('RefundDate','>=', $from)
     ->where('RefundDate' ,'<=', $to )
     ->where('CustomerID' ,'=', $Customer )
     ->get();
    return Response()->json($query4);
     
    }

    public function loadData5(){
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $Customer=$input['CustomerIDas'];

     
     $query5 = DB::table('tblcustomersdiscount')
     ->selectRaw( 'TransDate')
     ->selectRaw( 'Mount')
     ->selectRaw( 'Notes')
     ->where('TransDate','>=', $from)
     ->where('TransDate' ,'<=', $to )
     ->where('CustomerID' ,'=', $Customer )
     ->get();
    return Response()->json($query5);
     
    }

}
