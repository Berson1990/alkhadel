<?php namespace App\Http\Controllers;

use App\Http\Models\BankCashierTransfer;
use App\Http\Models\Banks;
use App\Http\Models\Cashiers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class BankCashierTransferController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
        $bankcashiertransfer = BankCashierTransfer::all();
        $banks = Banks::all();
        $cashiers = Cashiers::all();
        $js_config = trans('bankcashiertransfer');
        return view('bankcashiertransfer.bankcashiertransfer' ,compact('bankcashiertransfer' ,'banks' , 'cashiers' ,'js_config'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('bankcashiertransfer');
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

        $bankcashiertransfer = new BankCashierTransfer();

        $validator = $bankcashiertransfer->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($bankcashiertransfer->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('bankcashiertransfer.exist')]] ;

            }else{*/
                if ($bankcashiertransfer = BankCashierTransfer::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('bankcashiertransfer.saved')] , 'id' => $bankcashiertransfer->TransID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('bankcashiertransfer.faildsave')] ];
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
        return redirect('bankcashiertransfer');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('bankcashiertransfer');
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

        $bankcashiertransfer = new BankCashierTransfer();

        $validator = $bankcashiertransfer->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($bankcashiertransfer->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('bankcashiertransfer.exist')]] ;

        }*/else {

            if ($bankcashiertransfer->isExistById($id)) {

                if (BankCashierTransfer::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('bankcashiertransfer.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('bankcashiertransfer.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('bankcashiertransfer.notexist')]];
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
        if ($bankcashiertransfer = BankCashierTransfer::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('bankcashiertransfer.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('bankcashiertransfer.notexist')] ];
        }
        return Response()->json($output);
	}

}
