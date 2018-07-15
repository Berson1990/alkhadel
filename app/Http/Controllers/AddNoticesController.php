<?php namespace App\Http\Controllers;

use App\Http\Models\AddNotices;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class AddNoticesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $addnotices = AddNotices::all();

        $js_config = trans('addnotices');
        // dd($js_config);
        // exit();


        return view('addnotices.addnotices' ,compact('addnotices','js_config'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('addnotice');
	}

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Custom Error Message
     * if fails then return error
     * if pass => Start To check If AddNotice Name Is Exist
     * else Create new AddNotice
     * @param Request $request
     * @return output with data
     */
	public function store(Request $request)
	{
        $inputs = array_map('trim', Request::all() );

        $addnotice = new AddNotices();

        $validator = $addnotice->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            if ($addnotice->isExist( $inputs , 0 ) ){
                $output = ['status' => false  , 'message' => [trans('addnotices.exist')]] ;

            }else{
                if ($addnotice = AddNotices::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('addnotices.saved')] , 'id' => $addnotice->TransID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('addnotices.faildsave')] ];
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
        return redirect('addnotice');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('addnotice');
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

        $addnotice = new AddNotices();

        $validator = $addnotice->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else if ($addnotice->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('addnotices.exist')]] ;

        }else {

            if ($addnotice->isExistById($id)) {

                if (AddNotices::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('addnotices.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('addnotices.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('addnotices.notexist')]];
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
        if ($addnotice = AddNotices::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('addnotices.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('addnotices.notexist')] ];
        }
        return Response()->json($output);
	}

}
