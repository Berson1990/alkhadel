<?php namespace App\Http\Controllers;

use App\Http\Models\CustomerOpeningBalance;
use App\Http\Models\Customers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;
use DB;


class CustomerOpeningBalanceController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $opening = CustomerOpeningBalance::all();
        $customers = Customers::all();
        $js_config = trans('customeropeningbalance');

        return view('customeropeningbalance.customeropeningbalance' ,compact('opening' ,'customers','js_config'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return redirect('customeropeningbalance');
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

        $opening = new CustomerOpeningBalance();
    
        $validator = $opening->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($customersdiscount->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('customersdiscount.exist')]] ;

            }else{*/
            if ($opening = CustomerOpeningBalance::create($inputs)){
                
                 // dd($opening);
                $output = ['status' => true , 'message' => [trans('customeropeningbalance.saved')] , 'id' => $opening->TransID] ;


            }else{
                $output = ['status' => false , 'message' => [trans('customeropeningbalance.faildsave')] ];
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
        return redirect('customeropeningbalance');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        return redirect('customeropeningbalance');
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

        $opening = new CustomerOpeningBalance();

        $validator = $opening->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($customersdiscount->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('customersdiscount.exist')]] ;

        }*/else {

            if ($opening->isExistById($id)) {

                if (CustomerOpeningBalance::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('customeropeningbalance.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('customeropeningbalance.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('customeropeningbalance.notexist')]];
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
        if ($opening = CustomerOpeningBalance::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('customeropeningbalance.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('customeropeningbalance.notexist')] ];
        }
        return Response()->json($output);
    }


    public function CombineCustomerOpeningBalance(){

     $output = DB::select("select IFNULL(SUM(Mount),0)as Mount1 , Debt FROM `tblcustomeropeningbalance`
           Where Debt = 0 ");

    $output2 = DB::select("select IFNULL(SUM(Mount),0)as Mount2 , Debt FROM `tblcustomeropeningbalance`
        Where Debt = 1 ");
// dd($output);
    $output3 = array_merge($output,$output2);

      return Response()->json($output3);


    }






}
