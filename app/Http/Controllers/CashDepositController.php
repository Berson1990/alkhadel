<?php namespace App\Http\Controllers;

use App\Http\Models\CashDeposit;
use App\Http\Models\Customers;
use App\Http\Models\Cashiers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class CashDepositController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
        $cashdeposit = CashDeposit::all();
        $customers = Customers::all();
      
        $cashiers = Cashiers::all();
        $js_config = trans('cashdeposit');
        // dd($cashdeposit);
        return view('cashdeposit.cashdeposit' ,compact('cashdeposit' ,'customers' , 'cashiers' ,'js_config'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('cashdeposit');
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

        $cashdeposit = new CashDeposit();

        $validator = $cashdeposit->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($cashdeposit->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('cashdeposit.exist')]] ;

            }else{*/
                if ($cashdeposit = CashDeposit::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('cashdeposit.saved')] , 'id' => $cashdeposit->TransID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('cashdeposit.faildsave')] ];
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
        return redirect('cashdeposit');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('cashdeposit');
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

        $cashdeposit = new CashDeposit();

        $validator = $cashdeposit->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($cashdeposit->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('cashdeposit.exist')]] ;

        }*/else {

            if ($cashdeposit->isExistById($id)) {

                if (CashDeposit::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('cashdeposit.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('cashdeposit.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('cashdeposit.notexist')]];
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
        if ($cashdeposit = CashDeposit::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('cashdeposit.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('cashdeposit.notexist')] ];
        }
        return Response()->json($output);
	}

}
