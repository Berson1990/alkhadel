<?php namespace App\Http\Controllers;

use App\Http\Models\CashPayments;
use App\Http\Models\Suppliers;
use App\Http\Models\Cashiers;
use App\Http\Models\Banks;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class CashPaymentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
        $cashpayments = CashPayments::all();
//        dd($cashpayments);
        $suppliers = Suppliers::all();
        $cashiers = Cashiers::all();
        // $banks = Banks::all();
        $js_config = trans('cashpayments');
        return Response()->json($cashpayments);
//        return view('cashpayments.cashpayments' ,compact('cashpayments' ,'suppliers' , 'cashiers' , 'js_config'));
        // return view('cashpayments.cashpayments' ,compact('cashpayments' ,'suppliers' , 'cashiers' , 'banks' ,'js_config'));
//       
//        echo "<pre>";
//
//        var_dump($cashpayments); 
//        echo "</pre>";
//
//        die();
//        
//        return $cashpayments;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('cashpayment');
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

        $cashpayments = new CashPayments();

        $validator = $cashpayments->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($cashpayments->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('cashpayments.exist')]] ;

            }else{*/
                if ($cashpayments = CashPayments::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('cashpayments.saved')] , 'id' => $cashpayments->TransID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('cashpayments.faildsave')] ];
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
        return redirect('cashpayment');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('cashpayment');
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

        $cashpayments = new CashPayments();

        $validator = $cashpayments->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($cashpayments->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('cashpayments.exist')]] ;

        }*/else {

            if ($cashpayments->isExistById($id)) {

                if (CashPayments::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('cashpayments.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('cashpayments.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('cashpayments.notexist')]];
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
        if ($cashpayments = CashPayments::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('cashpayments.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('cashpayments.notexist')] ];
        }
        return Response()->json($output);
	}

}
