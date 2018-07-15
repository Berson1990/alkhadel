<?php namespace App\Http\Controllers;

use App\Http\Models\Drivers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;
use Illuminate\Http\Response as illuminateReponse;


class DriversController extends Controller {

    private $driver;

    public function __construct(){
        $this->driver = new Drivers();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $drivers = Drivers::all();

        $js_config = trans('drivers');
        // dd($js_config);
        // exit();


        return view('drivers.drivers' ,compact('drivers','js_config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return redirect('driver');
    }

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Driver Error Message
     * if fails then return error
     * if pass => Start To check If Driver Name Is Exist
     * else Create new Driver
     * @param Request $request
     * @return output with data
     */
    public function store(Request $request)
    {
        $inputs = array_map('trim', Request::all() );

        $driver = new Drivers();

        $validator = $driver->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            if ($driver->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('drivers.exist')]] ;

            }else{
                if ($driver = Drivers::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('drivers.saved')] , 'id' => $driver->DriverID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('drivers.faildsave')] ];
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
        return redirect('driver');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        return redirect('driver');
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

        $driver = new Drivers();

        $validator = $driver->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else if ($driver->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('drivers.exist')]] ;

        }else {

            if ($driver->isExistById($id)) {

                if (Drivers::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('drivers.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('drivers.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('drivers.notexist')]];
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
        if ($driver = Drivers::where('DriverID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('drivers.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('drivers.notexist')] ];
        }
        return Response()->json($output);
    }

    /**
     * Auto Complete Supplier Name limited with 10 record only
     * trim all spaces
     * check if input is empty
     * @param $SupplierName
     * @return mixed
     */
    public function AutoCompleteDriverName(){

        $DriverName = Input::get('DriverName');
        $DriverName  = trim($DriverName);
        if (strlen($DriverName) < 1){

            $output = ['status' => false , 'data' => ['message' => 'Type At Lease 1 char' ,'id' => '0'],'code' => illuminateReponse::HTTP_BAD_REQUEST];

        }else{

            $data = $this->driver->where('DriverName', 'LIKE', '%'. trim($DriverName) .'%')
                ->limit('10')
                ->select('DriverID' ,'DriverName');
            if ($data->count()){
                $output = ['status' => true , 'data' => $data->get() ,'code' => illuminateReponse::HTTP_OK];
            }else{
                $output = ['status' => false , 'data' => ['message' => 'no Match Data' ,'id' => '0'] ,'code' => illuminateReponse::HTTP_BAD_REQUEST];
            }

        }

        return Response::json($output);
    }
}
