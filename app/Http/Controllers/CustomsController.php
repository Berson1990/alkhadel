<?php namespace App\Http\Controllers;

use App\Http\Models\Customs;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;
use Illuminate\Http\Response as illuminateReponse;


class CustomsController extends Controller {

    private $customs;

    /**
     * Construct Declare Custom model
     */
    public function __construct(){
        $this->customs = new Customs();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $customs = Customs::all();

        $js_config = trans('customs');
        // dd($js_config);
        // exit();


        return view('customs.customs' ,compact('customs','js_config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return redirect('custom');
    }

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Custom Error Message
     * if fails then return error
     * if pass => Start To check If Custom Name Is Exist
     * else Create new Custom
     * @param Request $request
     * @return output with data
     */
    public function store(Request $request)
    {
        $inputs = array_map('trim', Request::all() );
        $inputs['CustomAccountID'] = 0;

        $custom = new Customs();

        $validator = $custom->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            if ($custom->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('customs.exist')]] ;

            }else{
                if ($custom = Customs::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('customs.saved')] , 'id' => $custom->CustomID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('customs.faildsave')] ];
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
        return redirect('custom');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        return redirect('custom');
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

        $custom = new Customs();

        $validator = $custom->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else if ($custom->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('customs.exist')]] ;

        }else {

            if ($custom->isExistById($id)) {

                if (Customs::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('customs.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('customs.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('customs.notexist')]];
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
        if ($custom = Customs::where('CustomID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('customs.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('customs.notexist')] ];
        }
        return Response()->json($output);
    }

    /**
     * Auto Complete Customs Name limited with 10 record only
     * trim all spaces
     * check if input is empty
     * @param $CustomName
     * @return mixed
     */
    public function AutoCompleteCustomsName(){

        $CustomName = Input::get('CustomName');
        $CustomName = trim($CustomName);

        if (strlen($CustomName) < 1){

            $output = ['status' => false , 'data' => ['message' => 'Type At Lease 1 char' ,'id' => '0'],'code' => illuminateReponse::HTTP_BAD_REQUEST];

        }else{

            $data = $this->customs->where('CustomName', 'LIKE', '%'. trim($CustomName) .'%')
                ->limit('10')
                ->select('CustomID' ,'CustomName');
            if ($data->count()){
                $output = ['status' => true , 'data' => $data->get() ,'code' => illuminateReponse::HTTP_OK];
            }else{
                $output = ['status' => false , 'data' => ['message' => 'no Match Data' ,'id' => '0'] ,'code' => illuminateReponse::HTTP_BAD_REQUEST];
            }

        }

        return Response::json($output);
    }

}
