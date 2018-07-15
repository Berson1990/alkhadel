<?php namespace App\Http\Controllers;

use App\Http\Models\Products;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;
use Illuminate\Http\Response as illuminateReponse;


class ProductsController extends Controller {

    private $product;
    public function __construct()
    {
        $this->product = new Products();
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $products = Products::all();

        $js_config = trans('products');
        // dd($js_config);
        // exit();


        return view('products.products' ,compact('products','js_config'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('product');
	}

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Custom Error Message
     * if fails then return error
     * if pass => Start To check If Product Name Is Exist
     * else Create new Product
     * @param Request $request
     * @return output with data
     */
	public function store(Request $request)
	{
        $inputs = array_map('trim', Request::all() );

        $product = new Products();

        $validator = $product->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            if ($product->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('products.exist')]] ;

            }else{
                if ($product = Products::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('products.saved')] , 'id' => $product->ProductID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('products.faildsave')] ];
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
        return redirect('product');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('product');
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

        $product = new Products();

        $validator = $product->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else if ($product->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('products.exist')]] ;

        }else {

            if ($product->isExistById($id)) {

                if (Products::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('products.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('products.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('products.notexist')]];
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
        if ($product = Products::where('ProductID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('products.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('products.notexist')] ];
        }
        return Response()->json($output);
	}

    /**
     * Auto Complete Product Name limited with 10 record only
     * trim all spaces
     * check if input is empty
     * @param $ProductName
     * @return mixed
     */
    public function AutoCompleteProductName()
    {
        $ProductName = Input::get('ProductName');
        $ProductName = trim($ProductName);
        if (strlen($ProductName) < 1) {

            $output = ['status' => false, 'data' => ['message' => 'Type At Lease 1 char', 'id' => '0'], 'code' => illuminateReponse::HTTP_BAD_REQUEST];

        } else {

            $data = $this->product->where('ProductName', 'LIKE', '%' . trim($ProductName) . '%')
                ->limit('10')
                ->select('ProductID', 'ProductName', 'ProductType');
            if ($data->count()) {
                $output = ['status' => true, 'data' => $data->get(), 'code' => illuminateReponse::HTTP_OK];
            } else {
                $output = ['status' => false, 'data' => ['message' => 'no Match Data', 'id' => '0'], 'code' => illuminateReponse::HTTP_BAD_REQUEST];
            }

        }
        return Response::json($output);
    }

}
