<?php namespace App\Http\Controllers;

use App\Http\Models\HolderDrawals;
use App\Http\Models\StockHolders;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class HolderDrawalsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
        $holderdrawals = HolderDrawals::all();
		
        $stockholders = StockHolders::all();
        $js_config = trans('holderdrawals');
//		 dd($holderdrawals);
        return view('holderdrawals.holderdrawals' ,compact('holderdrawals' ,'stockholders','js_config'));
				dd(view('holderdrawals.holderdrawals' ));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('holderdrawals');
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

        $holderdrawals = new HolderDrawals();

        $validator = $holderdrawals->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($holderdrawals->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('holderdrawals.exist')]] ;

            }else{*/
                if ($holderdrawals = HolderDrawals::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('holderdrawals.saved')] , 'id' => $holderdrawals->TransID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('holderdrawals.faildsave')] ];
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
        return redirect('holderdrawals');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('holderdrawals');
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

        $holderdrawals = new HolderDrawals();

        $validator = $holderdrawals->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($holderdrawals->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('holderdrawals.exist')]] ;

        }*/else {

            if ($holderdrawals->isExistById($id)) {

                if (HolderDrawals::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('holderdrawals.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('holderdrawals.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('holderdrawals.notexist')]];
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
        if ($holderdrawals = HolderDrawals::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('holderdrawals.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('holderdrawals.notexist')] ];
        }
        return Response()->json($output);
	}

}
