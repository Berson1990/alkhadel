<?php namespace App\Http\Controllers;

use App\Http\Models\Users;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $users = Users::all();

        $js_config = trans('users');
        // dd($js_config);
        // exit();


        return view('users.users' ,compact('users','js_config'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('user');
	}

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Custom Error Message
     * if fails then return error
     * if pass => Start To check If User Name Is Exist
     * else Create new User
     * @param Request $request
     * @return output with data
     */
	public function store(Request $request)
	{
        $inputs = array_map('trim', Request::all() );

        $user = new Users();

        $validator = $user->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            if ($user->isExist( $inputs ) ){

                $output = ['status' => false  , 'message' => [trans('users.exist')]] ;

            }else{
                if ($user = Users::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('saved')] , 'id' => $user->UserID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('faildsave')] ];
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
        return redirect('user');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('user');
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

        $user = new Users();

        $validator = $user->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else if ($user->isExist($inputs) ){

            $output = ['status' => false  , 'message' => [trans('users.exist')]] ;

        }else {

            if ($user->isExistById($id)) {

                if (Users::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('users.notexist')]];
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
        if ($user = Users::where('UserID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('users.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('users.notexist')] ];
        }
        return Response()->json($output);
	}

}
