<?php namespace App\Http\Controllers;

use App\Http\Models\SupplierOpeningBalance;
use App\Http\Models\Suppliers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;
use DB;

class SupplierOpeningBalanceController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $opening = SupplierOpeningBalance::all();
        $suppliers = Suppliers::all();
        $js_config = trans('supplieropeningbalance');

        // dd($opening);
        return view('supplieropeningbalance.supplieropeningbalance' ,compact('opening' ,'suppliers','js_config'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return redirect('supplieropeningbalance');
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
        // dd($inputs);
        $opening = new SupplierOpeningBalance();

        $validator = $opening->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($suppliersdiscount->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('suppliersdiscount.exist')]] ;

            }else{*/
            if ($opening = SupplierOpeningBalance::create($inputs)){

                $output = ['status' => true , 'message' => [trans('supplieropeningbalance.saved')] , 'id' => $opening->TransID] ;

            }else{
                $output = ['status' => false , 'message' => [trans('supplieropeningbalance.faildsave')] ];
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
        return redirect('supplieropeningbalance');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        return redirect('supplieropeningbalance');
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

        $opening = new SupplierOpeningBalance();

        $validator = $opening->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($suppliersdiscount->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('suppliersdiscount.exist')]] ;

        }*/else {

            if ($opening->isExistById($id)) {

                if (SupplierOpeningBalance::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('supplieropeningbalance.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('supplieropeningbalance.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('supplieropeningbalance.notexist')]];
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
        if ($opening = SupplierOpeningBalance::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('supplieropeningbalance.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('supplieropeningbalance.notexist')] ];
        }
        return Response()->json($output);
    }

     public function CombineSupplierOpeningBalance(){

     $output = DB::select("select IFNULL(SUM(Mount),0)as Mount1 , Debt FROM `tblsupplieropeningbalance`
           Where Debt = 0 ");

    $output2 = DB::select("select IFNULL(SUM(Mount),0)as Mount2 , Debt FROM `tblsupplieropeningbalance`
        Where Debt = 1 ");
// dd($output);
    $output3 = array_merge($output,$output2);

      return Response()->json($output3);


    }

}
