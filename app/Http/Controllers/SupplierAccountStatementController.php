<?php namespace App\Http\Controllers;

use App\Http\Models\Suppliers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;
use DB;

class SupplierAccountStatementController extends Controller {

	public function index()
	{
		
        $Suppliers = Suppliers::all();
       

        return view('supplieraccountstatement.supplieraccountstatement' ,compact('Suppliers'));

	}

	

    public function loadData(){
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $Supplier=$input['SupplierIDas'];

     // $query1 = DB::table('tblcashdeposit')
     $query1 = DB::table('tblcheckpayments')
     ->selectRaw( 'TransDate')
     ->selectRaw( 'Mount')
     ->selectRaw( 'Notes')
     ->where('TransDate','>=', $from)
     ->where('TransDate' ,'<=', $to )
     ->where('SupplierID' ,'=', $Supplier )
     ->get();
     return Response()->json($query1);
 
    }
    public function loadData2(){
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $Supplier=$input['SupplierIDas'];

     
     $query2 = DB::table('tblsupplieropeningbalance')
     ->selectRaw( 'TransDate')
     ->selectRaw( 'Mount')
     ->selectRaw( 'Notes')
     ->selectRaw( 'Debt')
     ->where('TransDate','>=', $from)
     ->where('TransDate' ,'<=', $to )
     ->where('SupplierID' ,'=', $Supplier )
     ->get();
    return Response()->json($query2);
     
    }

    public function loadData3(){
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $Supplier=$input['SupplierIDas'];

     
     $query3 = DB::table('tblcashpayments')
     ->selectRaw( 'TransDate')
     ->selectRaw( 'Mount')
     ->selectRaw( 'Notes')
     ->where('TransDate','>=', $from)
     ->where('TransDate' ,'<=', $to )
     ->where('SupplierID' ,'=', $Supplier )
     ->get();
    return Response()->json($query3);
     
    }

    public function loadData4(){
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $Supplier=$input['SupplierIDas'];

     
     $query4 = DB::table('tblsupplierrefund')
     ->selectRaw( 'RefundDate')
     ->selectRaw( 'Refund')
     ->selectRaw( 'Notes')
     ->where('RefundDate','>=', $from)
     ->where('RefundDate' ,'<=', $to )
     ->where('SupplierID' ,'=', $Supplier )
     ->get();
    return Response()->json($query4);
     
    }

    public function loadData5(){
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $Supplier=$input['SupplierIDas'];

     
     $query5 = DB::table('tblsuppliersdiscount')
     ->selectRaw( 'TransDate')
     ->selectRaw( 'Mount')
     ->selectRaw( 'Notes')
     ->where('TransDate','>=', $from)
     ->where('TransDate' ,'<=', $to )
     ->where('SupplierID' ,'=', $Supplier )
     ->get();
    return Response()->json($query5);
     
    }

}
