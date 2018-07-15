<?php namespace App\Http\Controllers;

use App\Http\Models\ExpensesTypes;
use App\Http\Models\ExpensesGroup;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;




class ExpensesTypesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $expensestypes = ExpensesTypes::all();
		$expensesgroup = ExpensesGroup::all();

        $js_config = trans('expensestypes');
        // dd($js_config);
        // exit();


        return view('expensestypes.expensestypes' ,compact('expensestypes','expensesgroup','js_config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return redirect('expensestypes');
    }

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with ExpenseType Error Message
     * if fails then return error
     * if pass => Start To check If ExpenseType Name Is Exist
     * else Create new ExpensesTypes
     * @param Request $request
     * @return output with data
     */
    public function store(Request $request)
    {
        $inputs = array_map('trim', Request::all() );

        $expensetype = new ExpensesTypes();

        $validator = $expensetype->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            if ($expensetype->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('expensestypes.exist')]] ;

            }else{
                if ($expensetype = ExpensesTypes::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('expensestypes.saved')] , 'id' => $expensetype->ExpenseTypeID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('expensestypes.faildsave')] ];
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
        return redirect('expensestypes');
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

        $expensetype = new ExpensesTypes();

        $validator = $expensetype->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else if ($expensetype->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('expensestypes.exist')]] ;

        }else {

            if ($expensetype->isExistById($id)) {

                if (ExpensesTypes::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('expensestypes.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('expensestypes.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('expensestypes.notexist')]];
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
        if ($expensetype = ExpensesTypes::where('ExpenseTypeID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('expensestypes.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('expensestypes.notexist')] ];
        }
        return Response()->json($output);
    }

}
