<?php namespace App\Http\Controllers;

use App\Http\Models\Customers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;
use Illuminate\Http\Response as illuminateReponse;


class CustomersController extends Controller {

    private $customer;
    public function __construct(){
        $this->customer = new Customers();
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $customers = Customers::all();

        $js_config = trans('customers');
        // dd($js_config);
        // exit();


        return view('customers.customers' ,compact('customers','js_config'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('customer');
	}

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Custom Error Message
     * if fails then return error
     * if pass => Start To check If Customer Name Is Exist
     * else Create new Customer
     * @param Request $request
     * @return output with data
     */
	public function store(Request $request)
	{
        $inputs = array_map('trim', Request::all() );
        $inputs['CustomerAccountID'] = 0;

        $customer = new Customers();

        $validator = $customer->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            if ($customer->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('customers.exist')]] ;

            }else{
                if ($customer = Customers::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('customers.saved')] , 'id' => $customer->CustomerID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('customers.faildsave')] ];
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
        return redirect('customer');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('customer');
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

        $customer = new Customers();

        $validator = $customer->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else if ($customer->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('customers.exist')]] ;

        }else {

            if ($customer->isExistById($id)) {

                if (Customers::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('customers.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('customers.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('customers.notexist')]];
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
        if ($customer = Customers::where('CustomerID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('customers.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('customers.notexist')] ];
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
    public function AutoCompleteCustomerName(){

        
        
        $CustomerName = Input::get('CustomerName');
        $CustomerName  = trim($CustomerName);
        if (strlen($CustomerName) < 1){

            $output = ['status' => false , 'data' => ['message' => 'Type At Lease 1 char' ,'id' => '0'],'code' => illuminateReponse::HTTP_BAD_REQUEST];

        }else{

            $data = $this->customer->where('CustomerName', 'LIKE', '%'. trim($CustomerName) .'%')
                ->limit('50')
                ->select('CustomerID' ,'CustomerName','CustomerType');
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
