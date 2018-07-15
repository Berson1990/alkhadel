<?php namespace App\Http\Controllers;

use App\Http\Models\SettlementSuppliersAccount;
use App\Http\Models\Cashiers;
use App\Http\Models\Suppliers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class SettlementSuppliersAccountController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $opening = SettlementSuppliersAccount::all();
		
//        $suppliers = Suppliers::all();
//        $cashiers = Cashiers::all();
        $js_config = trans('settlementsuppliersaccount');

        // dd($js_config);
 return view('settlementsuppliersaccount.settlementsuppliersaccount' ,compact('opening' ,'js_config'));
//dd(view('settlementsuppliersaccount.settlementsuppliersaccount' ,compact('opening' ,'js_config')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return redirect('settlementsuppliersaccount');
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
//         dd ($inputs);
        $opening = new SettlementSuppliersAccount();

        $validator = $opening->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($suppliersdiscount->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('suppliersdiscount.exist')]] ;

            }else{*/
//			dd($inputs);
            if ($opening = SettlementSuppliersAccount::create($inputs)){

                $output = ['status' => true , 'message' => [trans('settlementsuppliersaccount.saved')] , 'id' => $opening->TransID] ;
//                 dd($opening);
            }else{
                $output = ['status' => false , 'message' => [trans('settlementsuppliersaccount.faildsave')] ];
            }
            /*}*/
        }
//		dd($output);
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
        return redirect('settlementsuppliersaccount');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        return redirect('settlementsuppliersaccount');
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

        $opening = new SettlementSuppliersAccount();

        $validator = $opening->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($suppliersdiscount->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('suppliersdiscount.exist')]] ;

        }*/else {

            if ($opening->isExistById($id)) {

                if (SettlementSuppliersAccount::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('settlementsuppliersaccount.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('settlementsuppliersaccount.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('settlementsuppliersaccount.notexist')]];
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
        if ($opening = SettlementSuppliersAccount::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('settlementsuppliersaccount.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('settlementsuppliersaccount.notexist')] ];
        }
        return Response()->json($output);
    }

}
