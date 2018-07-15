<?php namespace App\Http\Controllers;

use App\Http\Models\BankCashDeposit;
use App\Http\Models\Customers;
use App\Http\Models\Banks;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class BankCashDepositController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// dd("aaaaaa");
        $bankcashdeposit = BankCashDeposit::all();
        $customers = Customers::all();
        $banks = Banks::all();
        // $cashiers = Cashiers::all();
        $js_config = trans('bankcashdeposit');
        // dd($bankcashdeposit);
        return view('bankcashdeposit.bankcashdeposit' ,compact('bankcashdeposit' ,'customers' , 'banks','js_config'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('bankcashdeposit');
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

        $bankcashdeposit = new BankCashDeposit();

        $validator = $bankcashdeposit->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($cashdeposit->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('cashdeposit.exist')]] ;

            }else{*/
                if ($bankcashdeposit = BankCashDeposit::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('bankcashdeposit.saved')] , 'id' => $bankcashdeposit->TransID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('bankcashdeposit.faildsave')] ];
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
        return redirect('bankcashdeposit');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('bankcashdeposit');
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

        $bankcashdeposit = new BankCashDeposit();

        $validator = $bankcashdeposit->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($cashdeposit->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('cashdeposit.exist')]] ;

        }*/else {

            if ($bankcashdeposit->isExistById($id)) {

                if (BankCashDeposit::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('bankcashdeposit.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('bankcashdeposit.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('bankcashdeposit.notexist')]];
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
        if ($bankcashdeposit = BankCashDeposit::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('bankcashdeposit.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('bankcashdeposit.notexist')] ];
        }
        return Response()->json($output);
	}

}
