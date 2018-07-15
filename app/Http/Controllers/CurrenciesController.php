<?php namespace App\Http\Controllers;

use App\Http\Models\Currencies;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class CurrenciesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $currencies = Currencies::all();

        $js_config = trans('currencies');
        // dd($js_config);
        // exit();


        return view('currencies.currencies' ,compact('currencies','js_config'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('currency');
	}

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Custom Error Message
     * if fails then return error
     * if pass => Start To check If Currency Name Is Exist
     * else Create new Currency
     * @param Request $request
     * @return output with data
     */
	public function store(Request $request)
	{
        $inputs = array_map('trim', Request::all() );

        $currency = new Currencies();

        $validator = $currency->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            if ($currency->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('currencies.exist')]] ;

            }else{
                if ($currency = Currencies::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('currencies.saved')] , 'id' => $currency->CurrencyID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('currencies.faildsave')] ];
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
        return redirect('currency');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('currency');
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

        $currency = new Currencies();

        $validator = $currency->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else if ($currency->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('currencies.exist')]] ;

        }else {

            if ($currency->isExistById($id)) {

                if (Currencies::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('currencies.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('currencies.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('currencies.notexist')]];
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
        if ($currency = Currencies::where('CurrencyID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('currencies.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('currencies.notexist')] ];
        }
        return Response()->json($output);
	}

}
