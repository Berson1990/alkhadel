<?php namespace App\Http\Controllers;

use App\Http\Models\Suppliers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;

use Illuminate\Http\Response as illuminateReponse;


class SuppliersController extends Controller {
    private $supplier;
    public function __construct(){
        $this->supplier = new Suppliers();
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $suppliers = Suppliers::all();
//       return Response()->json($suppliers);
        $js_config = trans('suppliers');
        // dd($js_config);
        // exit();


        return view('suppliers.suppliers' ,compact('suppliers','js_config'));
	}
	public function getSuppleirs(){

        $suppliers = Suppliers::all();
        return Response()->json($suppliers);

    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('supplier');
	}

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Custom Error Message
     * if fails then return error
     * if pass => Start To check If Supplier Name Is Exist
     * else Create new Supplier
     * @param Request $request
     * @return output with data
     */
	public function store(Request $request)
	{
        $inputs = array_map('trim', Request::all() );
        $inputs['SupplierAccountID'] = 0 ;

        $supplier = new Suppliers();

        $validator = $supplier->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            if ($supplier->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('suppliers.exist')]] ;

            }else{
                if ($supplier = Suppliers::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('suppliers.saved')] , 'id' => $supplier->SupplierID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('suppliers.faildsave')] ];
                }
            }
        }
//        dd($output);
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
        return redirect('supplier');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('supplier');
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

        $supplier = new Suppliers();

        $validator = $supplier->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else if ($supplier->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('suppliers.exist')]] ;

        }else {

            if ($supplier->isExistById($id)) {

                if (Suppliers::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('suppliers.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('suppliers.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('suppliers.notexist')]];
            }
        }
//             dd($output);
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
        if ($supplier = Suppliers::where('SupplierID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('suppliers.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('suppliers.notexist')] ];
        }
        return Response()->json($output);
	}


    /**
     * Auto Complete Supplier Name limited with 10 record only
     * trim all spaces
     * check if input is empty
     * @param $SupplierName
     * @return mixed
     */
    public function AutoCompleteSupplierName(){

        $SupplierName = Input::get('SupplierName');
        $SupplierName  = trim($SupplierName);
        if (strlen($SupplierName) < 1){

            $output = ['status' => false , 'data' => ['message' => 'Type At Lease 1 char' ,'id' => '0'],'code' => illuminateReponse::HTTP_BAD_REQUEST];

        }else{

            $data = $this->supplier->where('SupplierName', 'LIKE', '%'. trim($SupplierName) .'%')
                ->limit('10')
                ->select('SupplierID' ,'SupplierName','SupplierType','SupplierCommision');
            if ($data->count()){
                $output = ['status' => true , 'data' => $data->get() ,'code' => illuminateReponse::HTTP_OK];
            }else{
                $output = ['status' => false , 'data' => ['message' => 'no Match Data' ,'id' => '0'] ,'code' => illuminateReponse::HTTP_BAD_REQUEST];
            }

        }
//        dd($output);
        return Response::json($output);
    }
    public function AutoCompleteSupplierNamelocal(){

        $SupplierName = Input::get('SupplierName');
        $SupplierName  = trim($SupplierName);
        if (strlen($SupplierName)< 1){

            $output = ['status' => false , 'data' => ['message' => 'Type At Lease 1 char' ,'id' => '0'],'code' => illuminateReponse::HTTP_BAD_REQUEST];

        }else{

            $data = $this->supplier->where('SupplierType', '=', 0)
                                   ->where('SupplierName', 'LIKE', '%'. trim($SupplierName) .'%')
                ->limit('20')
//                ->limit('10')
                ->select('SupplierID' ,'SupplierName','SupplierType','SupplierCommision');
            if ($data->count()){
                $output = ['status' => true , 'data' => $data->get() ,'code' => illuminateReponse::HTTP_OK];
            }else{
                $output = ['status' => false , 'data' => ['message' => 'no Match Data' ,'id' => '0'] ,'code' => illuminateReponse::HTTP_BAD_REQUEST];
            }

        }
//        dd($output);
        return Response::json($output);
    }


}
