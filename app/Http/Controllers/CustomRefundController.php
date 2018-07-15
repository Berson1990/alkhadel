<?php namespace App\Http\Controllers;

use App\Http\Models\CustomRefund;
use App\Http\Models\Customs;
use App\Http\Models\Cashiers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class CustomRefundController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
$cashiers = Cashiers::all();
        $opening = CustomRefund::all();
		
        $customs = Customs::all();
    
		$js_config = trans('customrefund');
      //      var_dump($opening);die();
        return view('customrefund.customrefund' ,compact('cashiers','opening' ,'customers','js_config'));
        	dd(view('customrefund.customrefund' ,compact('cashiers','opening' ,'customers','js_config')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return redirect('customrefund');
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

        $opening = new customrefund();

        $validator = $opening->validate($inputs);
        
        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($customersdiscount->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('customersdiscount.exist')]] ;

            }else{*/
            if ($opening = customrefund::create($inputs)){

                $output = ['status' => true , 'message' => [trans('customrefund.saved')] , 'id' => $opening->	RefundID] ;

            }else{
                $output = ['status' => false , 'message' => [trans('customrefund.faildsave')] ];
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
        return redirect('customrefund');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        return redirect('customrefund');
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

        $opening = new customrefund();

        $validator = $opening->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($customersdiscount->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('customersdiscount.exist')]] ;

        }*/else {

            if ($opening->isExistById($id)) {

                if (customrefund::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('customrefund.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('customrefund.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('customrefund.notexist')]];
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
        if ($opening = customrefund::where('RefundID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('customrefund.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('customrefund.notexist')] ];
        }
        return Response()->json($output);
    }

}

