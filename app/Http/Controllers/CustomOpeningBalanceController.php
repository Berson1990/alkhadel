<?php namespace App\Http\Controllers;

use App\Http\Models\CustomOpeningBalance;
use App\Http\Models\Customs;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class CustomOpeningBalanceController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $opening = CustomOpeningBalance::all();
        $custom = Customs::all();
        $js_config2 = trans('customopeningbalance');

        return view('customopeningbalance.customopeningbalance' ,compact('opening' ,'custom','js_config2'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return redirect('customopeningbalance');
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

        $opening = new CustomOpeningBalance();

        $validator = $opening->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($customersdiscount->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('customersdiscount.exist')]] ;

            }else{*/
            if ($opening = CustomOpeningBalance::create($inputs)){

                $output = ['status' => true , 'message' => [trans('customopeningbalance.saved')] , 'id' => $opening->TransID];

            }else{
                $output = ['status' => false , 'message' => [trans('customopeningbalance.faildsave')] ];
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
        return redirect('customopeningbalance');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        return redirect('customopeningbalance');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $inputs = array_map('trim', Request::all());

        $opening = new CustomOpeningBalance();

        $validator = $opening->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($customersdiscount->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('customersdiscount.exist')]] ;

        }*/else {

            if ($opening->isExistById($id)) {

                if (CustomOpeningBalance::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('customopeningbalance.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('customopeningbalance.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('customopeningbalance.notexist')]];
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
        if ($opening = CustomOpeningBalance::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('customopeningbalance.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('customopeningbalance.notexist')] ];
        }
        return Response()->json($output);
    }

}
