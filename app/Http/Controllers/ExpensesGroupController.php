<?php namespace App\Http\Controllers;

//use App\Http\Models\ExpensesTypes;
use App\Http\Models\ExpensesGroup;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class ExpensesGroupController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
//        $expensestypes = ExpensesTypes::all();
        $expensesgroup = ExpensesGroup::all();

        $js_config = trans('expensesgroup');
        // dd($js_config);
        // exit();
      

        return view('expensesgroup.expensesgroup' ,compact('expensesgroup','js_config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return redirect('expensesgroup');
    }

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with ExpenseGroup Error Message
     * if fails then return error
     * if pass => Start To check If ExpenseGroup Name Is Exist
     * else Create new ExpenseGroup
     * @param Request $request
     * @return output with data
     */
    public function store(Request $request)
    {
        // dd($request);
        $inputs = array_map('trim', Request::all() );

        $expensesgroup = new ExpensesGroup();

        $validator = $expensesgroup->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            if ($expensesgroup->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('expensesgroup.exist')]] ;

            }else{
                if ($expensesgroup = ExpensesGroup::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('expensesgroup.saved')] , 'id' => $expensesgroup->ExpensesGroupID];

                }else{
                    $output = ['status' => false , 'message' => [trans('expensesgroup.faildsave')] ];
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
//    public function show($id)
//    {
//        return redirect('expensestypes');
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        return redirect('expensesgroup');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
       // dd($id);
        $inputs = array_map('trim', Request::all() );

         $expensesgroup = new ExpensesGroup();

        $validator = $expensesgroup->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else if ($expensesgroup->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('expensesgroup.exist')]] ;

        }else {

            if ($expensesgroup->isExistById($id)) {

                if (ExpensesGroup::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('expensesgroup.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('expensesgroup.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('expensesgroup.notexist')]];
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
        if ($expensesgroup = ExpensesGroup::where('ExpensesGroupID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('expensesgroup.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('expensesgroup.notexist')] ];
        }
        return Response()->json($output);
    }

}
