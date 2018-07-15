<?php namespace App\Http\Controllers;

use App\Http\Models\CashierTransfer;
use App\Http\Models\Cashiers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class CashierTransferController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
        $cashiertransfer = CashierTransfer::all();
        $cashiers = Cashiers::all();
        $js_config = trans('cashiertransfer');
        return view('cashiertransfer.cashiertransfer' ,compact('cashiertransfer' ,'cashiers','js_config'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('cashiertransfer');
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

        $cashiertransfer = new CashierTransfer();

        $validator = $cashiertransfer->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($cashiertransfer->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('cashiertransfer.exist')]] ;

            }else{*/
                if ($cashiertransfer = CashierTransfer::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('cashiertransfer.saved')] , 'id' => $cashiertransfer->TransID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('cashiertransfer.faildsave')] ];
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
        return redirect('cashiertransfer');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('cashiertransfer');
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

        $cashiertransfer = new CashierTransfer();

        $validator = $cashiertransfer->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($cashiertransfer->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('cashiertransfer.exist')]] ;

        }*/else {

            if ($cashiertransfer->isExistById($id)) {

                if (CashierTransfer::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('cashiertransfer.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('cashiertransfer.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('cashiertransfer.notexist')]];
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
        if ($cashiertransfer = CashierTransfer::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('cashiertransfer.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('cashiertransfer.notexist')] ];
        }
        return Response()->json($output);
	}

}
