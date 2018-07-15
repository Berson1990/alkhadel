<?php namespace App\Http\Controllers;

use App\Http\Models\Cashiers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;
use Illuminate\Http\Response as illuminateReponse;

class CashiersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//model
        $cashiers = Cashiers::all();

        $js_config = trans('cashiers');
        // dd($js_config);
        // exit();


        return view('cashiers.cashiers' ,compact('cashiers','js_config'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('cashier');
	}

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Custom Error Message
     * if fails then return error
     * if pass => Start To check If Cashier Name Is Exist
     * else Create new Cashier
     * @param Request $request
     * @return output with data
     */
	public function store(Request $request)
	{
        $inputs = array_map('trim', Request::all() );
        $inputs['CashierAccountID'] = 0;

        $cashier = new Cashiers();

        $validator = $cashier->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            if ($cashier->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('cashiers.exist')]] ;

            }else{
                if ($cashier = Cashiers::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('cashiers.saved')] , 'id' => $cashier->CashierID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('cashiers.faildsave')] ];
                }
            }
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
        return redirect('cashier');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('cashier');
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

        $cashier = new Cashiers();

        $validator = $cashier->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else if ($cashier->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('cashiers.exist')]] ;

        }else {

            if ($cashier->isExistById($id)) {

                if (Cashiers::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('cashiers.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('cashiers.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('cashiers.notexist')]];
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
        if ($cashier = Cashiers::where('CashierID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('cashiers.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('cashiers.notexist')] ];
        }
        return Response()->json($output);
	}
	
	public function __construct()
    {
        $this->cashiers = new Cashiers();

    }
	
		 public function AutoCompletetCashier(){

        $CashierName = Input::get('CashierName');
        $CashierName  = trim($CashierName);
        if (strlen($CashierName) < 1){

            $output = ['status' => false , 'data' => ['message' => 'Type At Lease 1 char' ,'id' => '0'],'code' => illuminateReponse::HTTP_BAD_REQUEST];

        }else{

            $data = $this->cashiers->where('CashierName', 'LIKE', '%'. trim($CashierName) .'%')
                ->limit('5')
                ->select('CashierID' ,'CashierName','CashierAccountID');
            if ($data->count()){
                $output = ['status' => true , 'data' => $data->get() ,'code' => illuminateReponse::HTTP_OK];
            }else{
                $output = ['status' => false , 'data' => ['message' => 'no Match Data' ,'id' => '0'] ,'code' => illuminateReponse::HTTP_BAD_REQUEST];
            }

        }
//     dd($output);
        return Response::json($output);
    }

}
