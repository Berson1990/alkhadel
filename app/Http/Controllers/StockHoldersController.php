<?php namespace App\Http\Controllers;

use App\Http\Models\StockHolders;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class StockHoldersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $stockHolders = StockHolders::all();

        $js_config = trans('stockHolders');
        // dd($js_config);
        // exit();


        return view('stockHolders.stockHolders' ,compact('stockHolders','js_config'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('stockholder');
	}

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Custom Error Message
     * if fails then return error
     * if pass => Start To check If StockHolder Name Is Exist
     * else Create new StockHolder
     * @param Request $request
     * @return output with data
     */
	public function store(Request $request)
	{
        $inputs = array_map('trim', Request::all() );
        $inputs['StockHolderAccountID'] = 0 ;

        $stockHolder = new StockHolders();

        $validator = $stockHolder->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            if ($stockHolder->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('stockHolders.exist')]] ;

            }else{
                if ($stockHolder = StockHolders::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('stockHolders.saved')] , 'id' => $stockHolder->StockHolderID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('stockHolders.faildsave')] ];
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
        return redirect('stockholder');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('stockholder');
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

        $stockHolder = new StockHolders();

        $validator = $stockHolder->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else if ($stockHolder->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('stockHolders.exist')]] ;

        }else {

            if ($stockHolder->isExistById($id)) {

                if (StockHolders::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('stockHolders.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('stockHolders.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('stockHolders.notexist')]];
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
        if ($stockHolder = StockHolders::where('StockHolderID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('stockHolders.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('stockHolders.notexist')] ];
        }
        return Response()->json($output);
	}

}
