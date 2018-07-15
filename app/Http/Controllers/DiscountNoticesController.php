<?php namespace App\Http\Controllers;

use App\Http\Models\DiscountNotices;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class DiscountNoticesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $discountnotices = DiscountNotices::all();

        $js_config = trans('discountnotices');
        // dd($js_config);
        // exit();


        return view('discountnotices.discountnotices' ,compact('discountnotices','js_config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return redirect('discountnotice');
    }

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Custom Error Message
     * if fails then return error
     * if pass => Start To check If DiscountNotice Name Is Exist
     * else Create new DiscountNotice
     * @param Request $request
     * @return output with data
     */
    public function store(Request $request)
    {
        $inputs = array_map('trim', Request::all() );

        $discountnotice = new DiscountNotices();

        $validator = $discountnotice->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            if ($discountnotice->isExist( $inputs , 0 ) ){
                $output = ['status' => false  , 'message' => [trans('discountnotices.exist')]] ;

            }else{
                if ($discountnotice = DiscountNotices::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('discountnotices.saved')] , 'id' => $discountnotice->TransID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('discountnotices.faildsave')] ];
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
        return redirect('discountnotice');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        return redirect('discountnotice');
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

        $discountnotice = new DiscountNotices();

        $validator = $discountnotice->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else if ($discountnotice->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('discountnotices.exist')]] ;

        }else {

            if ($discountnotice->isExistById($id)) {

                if (DiscountNotices::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('discountnotices.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('discountnotices.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('discountnotices.notexist')]];
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
        if ($discountnotice = DiscountNotices::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('discountnotices.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('discountnotices.notexist')] ];
        }
        return Response()->json($output);
    }

}
