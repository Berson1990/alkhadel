<?php namespace App\Http\Controllers;

use App\Http\Models\CustomersDiscount;
use App\Http\Models\Customers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class CustomersDiscountController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
        $customersdiscount = CustomersDiscount::all();
        $customers = Customers::all();
        $js_config = trans('customersdiscount');
        return view('customersdiscount.customersdiscount' ,compact('customersdiscount' ,'customers','js_config'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('customersdiscount');
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

        $customersdiscount = new CustomersDiscount();

        $validator = $customersdiscount->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($customersdiscount->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('customersdiscount.exist')]] ;

            }else{*/
                if ($customersdiscount = CustomersDiscount::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('customersdiscount.saved')] , 'id' => $customersdiscount->TransID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('customersdiscount.faildsave')] ];
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
        return redirect('customersdiscount');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('customersdiscount');
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

        $customersdiscount = new CustomersDiscount();

        $validator = $customersdiscount->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($customersdiscount->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('customersdiscount.exist')]] ;

        }*/else {

            if ($customersdiscount->isExistById($id)) {

                if (CustomersDiscount::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('customersdiscount.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('customersdiscount.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('customersdiscount.notexist')]];
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
        if ($customersdiscount = CustomersDiscount::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('customersdiscount.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('customersdiscount.notexist')] ];
        }
        return Response()->json($output);
	}

}
