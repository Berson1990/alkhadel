<?php namespace App\Http\Controllers;

use App\Http\Models\SupplierRefund;
use App\Http\Models\Suppliers;
use App\Http\Models\Cashiers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class SupplierRefundController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cashiers = Cashiers::all();
        $opening = SupplierRefund::all();
		// dd($opening);
        $suppliers = Suppliers::all();
    
		$js_config = trans('supplierrefund');
      //      var_dump($opening);die();
        return view('supplierrefund.supplierrefund' ,compact('cashiers','opening' ,'suppliers','js_config'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return redirect('supplierrefund');
    }

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Custom Error Message
     * if fails then return error
     * else Create new Supplier Discount
     * @param Request $request
     * @return output with data
     */
    public function store(Request $request)
    {
        $inputs = array_map('trim', Request::all() );

        $opening = new SupplierRefund();

        $validator = $opening->validate($inputs);
        
        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($suppliersdiscount->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('suppliersdiscount.exist')]] ;

            }else{*/
            if ($opening = SupplierRefund::create($inputs)){

                $output = ['status' => true , 'message' => [trans('supplierrefund.saved')] , 'id' => $opening->	RefundID] ;

            }else{
                $output = ['status' => false , 'message' => [trans('supplierrefund.faildsave')] ];
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
        return redirect('supplierrefund');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        return redirect('supplierrefund');
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

        $opening = new SupplierRefund();

        $validator = $opening->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($suppliersdiscount->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('suppliersdiscount.exist')]] ;

        }*/else {

            if ($opening->isExistById($id)) {

                if (SupplierRefund::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('supplierrefund.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('supplierrefund.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('supplierrefund.notexist')]];
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
        if ($opening = SupplierRefund::where('RefundID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('supplierrefund.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('supplierrefund.notexist')] ];
        }
        return Response()->json($output);
    }

}
