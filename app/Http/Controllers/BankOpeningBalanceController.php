<?php namespace App\Http\Controllers;

use App\Http\Models\BankOpeningBalance;
use App\Http\Models\Banks;
use App\Http\Models\Currencies;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class BankOpeningBalanceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
        $bankopeningbalance = BankOpeningBalance::all();
        $banks = Banks::all();
        $currencies = Currencies::all();
        $js_config = trans('bankopeningbalance');
        return view('bankopeningbalance.bankopeningbalance' ,compact('bankopeningbalance' ,'banks' , 'currencies' ,'js_config'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('bankopeningbalance');
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

        $bankopeningbalance = new BankOpeningBalance();

        $validator = $bankopeningbalance->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($bankopeningbalance->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('bankopeningbalance.exist')]] ;

            }else{*/
                if ($bankopeningbalance = BankOpeningBalance::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('bankopeningbalance.saved')] , 'id' => $bankopeningbalance->TransID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('bankopeningbalance.faildsave')] ];
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
        return redirect('bankopeningbalance');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('bankopeningbalance');
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

        $bankopeningbalance = new BankOpeningBalance();

        $validator = $bankopeningbalance->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($bankopeningbalance->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('bankopeningbalance.exist')]] ;

        }*/else {

            if ($bankopeningbalance->isExistById($id)) {

                if (BankOpeningBalance::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('bankopeningbalance.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('bankopeningbalance.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('bankopeningbalance.notexist')]];
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
        if ($bankopeningbalance = BankOpeningBalance::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('bankopeningbalance.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('bankopeningbalance.notexist')] ];
        }
        return Response()->json($output);
	}

}
