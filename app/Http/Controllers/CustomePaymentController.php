<?php namespace App\Http\Controllers;

use App\Http\Models\Cashiers;
use App\Http\Models\CustomePayment;
use App\Http\Models\Customs;
use Illuminate\Support\Facades\Redirect;
use Request;
use Response;

class CustomePaymentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {

		$opening = CustomePayment::all();
		$custom = Customs::all();
		$cashiers = Cashiers::all();
		$js_config = trans('customepayment');

		return view('custompayment.customepayment', compact('opening', 'custom', 'cashiers', 'js_config'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return redirect('customepayment');
	}

	/**
	 * Store a newly created resource in storage.
	 * check Request Validtor with Custom Error Message
	 * if fails then return error
	 * else Create new Customer Discount
	 * @param Request $request
	 * @return output with data
	 */
	public function store(Request $request) {
		$inputs = array_map('trim', Request::all());

		$opening = new CustomePayment();

		$validator = $opening->validate($inputs);

		if ($validator->fails()) {

			$output = ['status' => false, 'message' => $validator->messages()->toArray()];

		} else {

			/*if ($customersdiscount->isExist( $inputs , 0 ) ){

				                $output = ['status' => false  , 'message' => [trans('customersdiscount.exist')]] ;

			*/
			if ($opening = CustomePayment::create($inputs)) {

				$output = ['status' => true, 'message' => [trans('customepayment.saved')], 'id' => $opening->TransID];

			} else {
				$output = ['status' => false, 'message' => [trans('customepayment.faildsave')]];
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
	public function show($id) {
		return redirect('customepayment');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $id
	 * @return Response
	 */
	public function edit($id) {
		return redirect('customepayment');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$inputs = array_map('trim', Request::all());

		$opening = new CustomePayment();

		$validator = $opening->validate($inputs);

		if ($validator->fails()) {

			$output = ['status' => false, 'message' => $validator->messages()->toArray()];

		} /*else if ($customersdiscount->isExist($inputs , $id) ){

	            $output = ['status' => false  , 'message' => [trans('customersdiscount.exist')]] ;

*/else {

			if ($opening->isExistById($id)) {

				if (CustomePayment::find($id)->update($inputs)) {

					$output = ['status' => true, 'message' => [trans('customepayment.saved')], 'data' => $inputs];

				} else {

					$output = ['status' => false, 'message' => [trans('customepayment.faildsave')]];

				}

			} else {
				$output = ['status' => false, 'message' => [trans('customepayment.notexist')]];
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
	public function destroy($id) {
		//
		if ($opening = CustomePayment::where('TransID', '=', $id)->delete()) {

			$output = ['status' => true, 'message' => [trans('customepayment.deleted')]];

		} else {
			$output = ['status' => false, 'message' => [trans('customepayment.notexist')]];
		}
		return Response()->json($output);
	}

}
