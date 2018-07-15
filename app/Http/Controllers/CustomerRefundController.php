<?php namespace App\Http\Controllers;

use App\Http\Models\CustomerRefund;
use App\Http\Models\Customers;
use App\Http\Models\Cashiers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class CustomerRefundController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
$cashiers = Cashiers::all();
        $opening = CustomerRefund::all();
		
        $customers = Customers::all();
    
		$js_config = trans('customerrefund');
      //      var_dump($opening);die();
        return view('customerrefund.customerrefund' ,compact('cashiers','opening' ,'customers','js_config'));
// dd(view('customerrefund.customerrefund' ,compact('cashiers','opening' ,'customers','js_config')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return redirect('customerrefund');
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

        $opening = new CustomerRefund();

        $validator = $opening->validate($inputs);
        
        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($customersdiscount->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('customersdiscount.exist')]] ;

            }else{*/
            if ($opening = CustomerRefund::create($inputs)){

                $output = ['status' => true , 'message' => [trans('customerrefund.saved')] , 'id' => $opening->	RefundID] ;

            }else{
                $output = ['status' => false , 'message' => [trans('customerrefund.faildsave')] ];
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
        return redirect('customerrefund');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        return redirect('customerrefund');
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

        $opening = new CustomerRefund();

        $validator = $opening->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($customersdiscount->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('customersdiscount.exist')]] ;

        }*/else {

            if ($opening->isExistById($id)) {

                if (CustomerRefund::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('customerrefund.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('customerrefund.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('customerrefund.notexist')]];
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
        if ($opening = CustomerRefund::where('RefundID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('customerrefund.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('customerrefund.notexist')] ];
        }
        return Response()->json($output);
    }

}
