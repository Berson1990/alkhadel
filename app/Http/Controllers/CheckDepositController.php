<?php namespace App\Http\Controllers;

use App\Http\Models\CheckDeposit;
use App\Http\Models\Customers;
use App\Http\Models\Banks;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class CheckDepositController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
        $checkdeposit = CheckDeposit::all();
        $customers = Customers::all();
        $banks = Banks::all();
        $js_config = trans('checkdeposit');
        return view('checkdeposit.checkdeposit' ,compact('checkdeposit' ,'customers', 'banks' ,'js_config'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('checkdeposit');
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

        $checkdeposit = new CheckDeposit();

        $validator = $checkdeposit->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($checkdeposit->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('checkdeposit.exist')]] ;

            }else{*/
                if ($checkdeposit = CheckDeposit::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('checkdeposit.saved')] , 'id' => $checkdeposit->TransID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('checkdeposit.faildsave')] ];
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
        return redirect('checkdeposit');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('checkdeposit');
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

        $checkdeposit = new CheckDeposit();

        $validator = $checkdeposit->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($checkdeposit->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('checkdeposit.exist')]] ;

        }*/else {

            if ($checkdeposit->isExistById($id)) {

                if (CheckDeposit::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('checkdeposit.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('checkdeposit.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('checkdeposit.notexist')]];
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
        if ($checkdeposit = CheckDeposit::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('checkdeposit.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('checkdeposit.notexist')] ];
        }
        return Response()->json($output);
	}

}
