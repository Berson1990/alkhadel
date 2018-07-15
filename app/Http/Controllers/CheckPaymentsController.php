<?php namespace App\Http\Controllers;

use App\Http\Models\CheckPayments;
use App\Http\Models\Suppliers;
use App\Http\Models\Banks;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class CheckPaymentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
        $checkpayments = CheckPayments::all();
//            var_dump($checkpayments[]);
        $suppliers = Suppliers::all();
        $banks = Banks::all();
        $js_config = trans('checkpayments');
        // echo "<prev>";
        //      dd($checkpayments[0]);
        // echo "</prev>";

        return view('checkpayments.checkpayments' ,compact('checkpayments' ,'suppliers' , 'banks' ,'js_config'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('checkpayment');
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

        $checkpayments = new CheckPayments();

        $validator = $checkpayments->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($checkpayments->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('checkpayments.exist')]] ;

            }else{*/
                if ($checkpayments = CheckPayments::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('checkpayments.saved')] , 'id' => $checkpayments->TransID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('checkpayments.faildsave')] ];
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
        return redirect('checkpayment');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('checkpayment');
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

        $checkpayments = new CheckPayments();

        $validator = $checkpayments->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($checkpayments->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('checkpayments.exist')]] ;

        }*/else {

            if ($checkpayments->isExistById($id)) {

                if (CheckPayments::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('checkpayments.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('checkpayments.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('checkpayments.notexist')]];
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
        if ($checkpayments = CheckPayments::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('checkpayments.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('checkpayments.notexist')] ];
        }
        return Response()->json($output);
	}

}
