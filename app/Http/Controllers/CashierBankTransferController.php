<?php namespace App\Http\Controllers;

use App\Http\Models\CashierBankTransfer;
use App\Http\Models\Cashiers;
use App\Http\Models\Banks;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class CashierBankTransferController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
        $cashierbanktransfer = CashierBankTransfer::all();
        $cashiers = Cashiers::all();
        $banks = Banks::all();
        $js_config = trans('cashierbanktransfer');
        return view('cashierbanktransfer.cashierbanktransfer' ,compact('cashierbanktransfer' ,'cashiers' , 'banks' ,'js_config'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('cashierbanktransfer');
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

        $cashierbanktransfer = new CashierBankTransfer();

        $validator = $cashierbanktransfer->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($cashierbanktransfer->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('cashierbanktransfer.exist')]] ;

            }else{*/
                if ($cashierbanktransfer = CashierBankTransfer::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('cashierbanktransfer.saved')] , 'id' => $cashierbanktransfer->TransID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('cashierbanktransfer.faildsave')] ];
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
        return redirect('cashierbanktransfer');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('cashierbanktransfer');
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

        $cashierbanktransfer = new CashierBankTransfer();

        $validator = $cashierbanktransfer->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($cashierbanktransfer->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('cashierbanktransfer.exist')]] ;

        }*/else {

            if ($cashierbanktransfer->isExistById($id)) {

                if (CashierBankTransfer::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('cashierbanktransfer.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('cashierbanktransfer.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('cashierbanktransfer.notexist')]];
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
        if ($cashierbanktransfer = CashierBankTransfer::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('cashierbanktransfer.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('cashierbanktransfer.notexist')] ];
        }
        return Response()->json($output);
	}

}
