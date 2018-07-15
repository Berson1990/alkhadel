<?php namespace App\Http\Controllers;

use App\Http\Models\CashierOpeningBalance;
use App\Http\Models\Cashiers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;
use DB;




class CashierOpeningBalanceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
        $opening = CashierOpeningBalance::all();
        $cashiers = Cashiers::all();
        $cash = Cashiers::all();

        $js_config = trans('cashieropeningbalance');

        return view('cashieropeningbalance.cashieropeningbalance' ,compact('opening','cash','cashiers','js_config'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('cashieropeningbalance');
	}

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Custom Error Message
     * if fails then return error
     * else Create new Customer Discount
     * @param Request $request
     * @return output with data
     */
	public function store(Request $request)
	{
        $inputs = array_map('trim', Request::all() );

        $opening = new CashierOpeningBalance();

        $validator = $opening->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($customersdiscount->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('customersdiscount.exist')]] ;

            }else{*/
                if ($opening = CashierOpeningBalance::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('cashieropeningbalance.saved')] , 'id' => $opening->TransID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('cashieropeningbalance.faildsave')] ];
                }
            /*}*/
        }
        return Response()->json($output);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return redirect('cashieropeningbalance');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('cashieropeningbalance');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $inputs = array_map('trim', Request::all() );

        $opening = new CashierOpeningBalance();

        $validator = $opening->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($customersdiscount->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('customersdiscount.exist')]] ;

        }*/else {

            if ($opening->isExistById($id)) {

                if (CashierOpeningBalance::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('cashieropeningbalance.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('cashieropeningbalance.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('cashieropeningbalance.notexist')]];
            }
        }

        return Response()->json($output);
	}

	/**
	 * Remove the specified resource from Proudcts.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        if ($opening = CashierOpeningBalance::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('cashieropeningbalance.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('cashieropeningbalance.notexist')] ];
        }
        return Response()->json($output);
	}
	


    public function loadData(){
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $cashier=$input['CashierID2'];

     $query1 = DB::table('tblcashdeposit')
     ->selectRaw( 'TransDate')
     ->selectRaw( 'Mount')
     ->selectRaw( 'Notes')
     ->where('TransDate','>=', $from)
     ->where('TransDate' ,'<=', $to )
     ->where('CashierID' ,'=', $cashier )
     ->get();
     return Response()->json($query1);
 
    }
    public function loadData2(){
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $cashier=$input['CashierID2'];

     
     $query2 = DB::table('tblcashieropeningbalance')
     ->selectRaw( 'TransDate')
     ->selectRaw( 'Mount')
     ->selectRaw( 'Notes')
     ->where('TransDate','>=', $from)
     ->where('TransDate' ,'<=', $to )
     ->where('CashierID' ,'=', $cashier )
     ->get();
    return Response()->json($query2);
     
    }

    public function loadData3(){
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $cashier=$input['CashierID2'];

     
     $query3 = DB::table('tblcashpayments')
     ->selectRaw( 'TransDate')
     ->selectRaw( 'Mount')
     ->selectRaw( 'Notes')
     ->where('TransDate','>=', $from)
     ->where('TransDate' ,'<=', $to )
     ->where('CashierID' ,'=', $cashier )
     ->get();
    return Response()->json($query3);
     
    } 

    public function loadData4(){
    
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $cashier=$input['CashierID2'];

     
     $query4 = DB::table('tblsupplierrefund')
     ->selectRaw( 'RefundDate')
     ->selectRaw( 'Refund')
     ->selectRaw( 'Notes')
     ->where('RefundDate','>=', $from)
     ->where('RefundDate' ,'<=', $to )
     ->where('CashierID' ,'=', $cashier )
     ->get();
    return Response()->json($query4);
     
    }
    public function loadData5(){
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $cashier=$input['CashierID2'];

     //c2b
     $query5 = DB::table('tblcashierbanktransfer')
     ->selectRaw( 'TransDate')
     ->selectRaw( 'Mount')
     ->selectRaw( 'Notes')
     ->where('TransDate','>=', $from)
     ->where('TransDate' ,'<=', $to )
     ->where('CashierID' ,'=', $cashier )
     ->get();
    return Response()->json($query5);
     
    }
    //b2c 
    public function loadData6(){
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $cashier=$input['CashierID2'];

     
     $query6 = DB::table('tblbankcashiertransfer')
     ->selectRaw( 'TransDate')
     ->selectRaw( 'Mount')
     ->selectRaw( 'Notes')
     ->where('TransDate','>=', $from)
     ->where('TransDate' ,'<=', $to )
     ->where('CashierID' ,'=', $cashier )
     ->get();
    return Response()->json($query6);
     
    } 

     public function loadData7(){
    
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $cashier=$input['CashierID2'];

     
     $query7 = DB::table('tblcustomerrefund')
     ->selectRaw( 'RefundDate')
     ->selectRaw( 'Refund')
     ->selectRaw( 'Notes')
     ->where('RefundDate','>=', $from)
     ->where('RefundDate' ,'<=', $to )
     ->where('CashierID' ,'=', $cashier )
     ->get();
    return Response()->json($query7);
     
    }
      public function loadData8(){
      $input=Request::all();
      $input=(array)$input;   
      $from=$input['FromTransDate'];
      $to=$input['ToTransDate'];
      $cashier=$input['CashierID2'];

     
     $query8 = DB::table('tblexpenses')
     ->selectRaw( 'TransDate')
     ->selectRaw( 'Mount')
     ->selectRaw( 'Notes')
     ->where('TransDate','>=', $from)
     ->where('TransDate' ,'<=', $to )
     ->where('CashierID' ,'=', $cashier )
     ->get();
     // dd($query8);
    return Response()->json($query8);
     
    } 

}
