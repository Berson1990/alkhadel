<?php namespace App\Http\Controllers;

use App\Http\Models\SuppliersDiscount;
use App\Http\Models\Suppliers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class SuppliersDiscountController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
        $suppliersdiscount = SuppliersDiscount::all();
        $suppliers = Suppliers::all();
        $js_config = trans('suppliersdiscount');
        return view('suppliersdiscount.suppliersdiscount' ,compact('suppliersdiscount' ,'suppliers','js_config'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('suppliersdiscount');
	}

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Custom Error Message
     * if fails then return error
     * else Create new Supplier Discount
     * @param Request $request
     * @return output with data
     */
	public function store(Request $request)
	{
        $inputs = array_map('trim', Request::all() );

        $suppliersdiscount = new SuppliersDiscount();

        $validator = $suppliersdiscount->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($suppliersdiscount->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('suppliersdiscount.exist')]] ;

            }else{*/
                if ($suppliersdiscount = SuppliersDiscount::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('suppliersdiscount.saved')] , 'id' => $suppliersdiscount->TransID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('suppliersdiscount.faildsave')] ];
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
        return redirect('suppliersdiscount');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('suppliersdiscount');
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

        $suppliersdiscount = new SuppliersDiscount();

        $validator = $suppliersdiscount->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($suppliersdiscount->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('suppliersdiscount.exist')]] ;

        }*/else {

            if ($suppliersdiscount->isExistById($id)) {

                if (SuppliersDiscount::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('suppliersdiscount.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('suppliersdiscount.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('suppliersdiscount.notexist')]];
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
        if ($suppliersdiscount = SuppliersDiscount::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('suppliersdiscount.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('suppliersdiscount.notexist')] ];
        }
        return Response()->json($output);
	}

}
