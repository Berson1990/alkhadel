<?php namespace App\Http\Controllers;

use App\Http\Models\Carrying;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class CarryingController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $carrying = Carrying::all();

        $js_config = trans('carrying');
        // dd($js_config);
        // exit();


        return view('carrying.carrying',compact('carrying','js_config'));
//        dd( view('carrying.carrying' ,compact('carrying')));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('carrying');
	}

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Custom Error Message
     * if fails then return error
     * if pass => Start To check If Carrying Name Is Exist
     * else Create new Carrying
     * @param Request $request
     * @return output with data
     */
	public function store(Request $request)
	{
        $inputs = array_map('trim', Request::all() );

        $carrying = new Carrying();

        $validator = $carrying->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            if ($carrying->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('carrying.exist')]] ;

            }else{
                if ($carrying = Carrying::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('carrying.saved')] , 'id' => $carrying->CarryingID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('carrying.faildsave')] ];
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
        return redirect('carrying');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('carrying');
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

        $carrying = new Carrying();

        $validator = $carrying->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($carrying->isExist($inputs) ){

            $output = ['status' => false  , 'message' => [trans('carrying.exist')]] ;

        }*/else {

            if ($carrying->isExistById($id)) {

                if (Carrying::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('carrying.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('carrying.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('carrying.notexist')]];
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
        if ($carrying = Carrying::where('CarryingID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('carrying.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('carrying.notexist')] ];
        }
        return Response()->json($output);
	}

}
