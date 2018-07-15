<?php namespace App\Http\Controllers;

use App\Http\Models\Employees;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class EmployeesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $employees = Employees::all();

        $js_config = trans('employees');
        // dd($js_config);
        // exit();


        return view('employees.employees' ,compact('employees','js_config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return redirect('employee');
    }

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Employee Error Message
     * if fails then return error
     * if pass => Start To check If Employee Name Is Exist
     * else Create new Employee
     * @param Request $request
     * @return output with data
     */
    public function store(Request $request)
    {
        $inputs = array_map('trim', Request::all() );

        $employee = new Employees();

        $validator = $employee->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            if ($employee->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('employees.exist')]] ;

            }else{
                if ($employee = Employees::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('employees.saved')] , 'id' => $employee->EmployeeID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('employees.faildsave')] ];
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
        return redirect('employee');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        return redirect('employee');
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

        $employee = new Employees();

        $validator = $employee->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else if ($employee->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('employees.exist')]] ;

        }else {

            if ($employee->isExistById($id)) {

                if (Employees::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('employees.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('employees.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('employees.notexist')]];
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
        if ($employee = Employees::where('EmployeeID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('employees.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('employees.notexist')] ];
        }
        return Response()->json($output);
    }

}
