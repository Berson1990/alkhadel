<?php namespace App\Http\Controllers;

use App\Http\Models\Banks;
use App\Http\Models\Currencies;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;
use Illuminate\Http\Response as illuminateReponse;


class BanksController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
        $banks = Banks::all();
        $currencies = Currencies::all();
        $js_config = trans('banks');
        return view('banks.banks' ,compact('banks' ,'currencies','js_config'));
//            dd(view('banks.banks' ,compact('banks' ,'currencies','js_config')));
        //Currencies();
        // $bank = new Banks();
        // print_r($bank::find(1)->Currencies()->get()[0]->CurrencyID);
        // exit();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('banks');
	}

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Custom Error Message
     * if fails then return error
     * if pass => Start To check If Bank Name Is Exist
     * else Create new Bank
     * @param Request $request
     * @return output with data
     */
	public function store(Request $request)
	{
        $inputs = array_map('trim', Request::all() );
//        $inputs['SupplierAccountID'] = 0 ;

        $bank = new Banks();

        $validator = $bank->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            if ($bank->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('banks.exist')]] ;

            }else{
                if ($bank = Banks::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('banks.saved')] , 'id' => $bank->BankID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('banks.faildsave')] ];
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
        return redirect('bank');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('banks');
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

        $bank = new Banks();

        $validator = $bank->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else if ($bank->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('banks.exist')]] ;

        }else {

            if ($bank->isExistById($id)) {

                if (Banks::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('banks.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('banks.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('banks.notexist')]];
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
        if ($bank = Banks::where('BankID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('banks.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('banks.notexist')] ];
        }
        return Response()->json($output);
	}
	
		public function __construct()
    {
        $this->bank = new Banks();

    }
	
	
	
	    public function AutoCompleteBank(){

        $BankName = Input::get('BankName');
        $BankName  = trim($BankName);
        if (strlen($BankName) < 1){

            $output = ['status' => false , 'data' => ['message' => 'Type At Lease 1 char' ,'id' => '0'],'code' => illuminateReponse::HTTP_BAD_REQUEST];

        }else{

            $data = $this->bank->where('BankName', 'LIKE', '%'. trim($BankName) .'%')
                ->limit('10')
                ->select('BankID' ,'BankName','AccountNumber');
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
