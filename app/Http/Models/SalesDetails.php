<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Request;

class SalesDetails extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblSalesDetails';
	/**
	 * Set Id of Sales Details
	 * */
	protected $primaryKey = 'Serial';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['SalesID', 'ProductID', 'Weight', 'WeightType', 'Quantity', 'ProductPrice', 'Total', 'Carrying', 'SupplierID', 'Commision', 'ContainerID'];

	/**
	 * SalesDetails Belong to Sales
	 * @relationship
	 * */
	public function Sales() {
		return $this->belongsTo('App\Http\Models\Sales', 'SalesID')->select();
	}
	/**
	 * SalesDetails Belong to ProductID
	 * @relationship
	 * */
	public function Product() {
		return $this->belongsTo('App\Http\Models\Products', 'ProductID')->select('ProductID', 'ProductName', 'ProductType');
	}
	/**
	 * SalesDetails Belong to SupplierID
	 * @relationship
	 * */
	public function Supplier() {
		return $this->belongsTo('App\Http\Models\Suppliers', 'SupplierID')->select();
	}
	/**
	 * SalesDetails Belong to ContainerID
	 * @relationship
	 * */
	public function Container() {
		return $this->belongsTo('App\Http\Models\Containers', 'ContainerID')->select();
	}
	/**
	 * Get Sales Details y ID
	 * Get SalesDetails Row
	 * get Sales ID
	 * Check if salesdetails is found and count > 0
	 * get driver details for current sales details
	 * @param serial of Sales Details
	 */
	public function getsalesdetailsById($serial) {

		$data = $this->find($serial);

		$Sales = Sales::find(($data->Sales()->get()->first()->SalesID));
		 // dd($Sales);

		if ($data && $data->count()) {

			$driver = $Sales->Driver()->get()->toArray();

			$output = ['status' => true, 'data' =>
				[
					'salesdetails' => array_except($data->toArray(), ['created_at', 'updated_at']),
					'Container' => array_except($data->Container()->get()->first(), ['created_at', 'updated_at']),
					'sales' => array_except($data->Sales()->get()->first()->toArray(), ['created_at', 'updated_at']),
					'customer' => array_except($Sales->Customer()->get()->first()->toArray(), ['created_at', 'updated_at']),
					'supplier' => array_except($data->Supplier()->get()->first()->toArray(), ['created_at', 'updated_at']),
					'product' => $data->Product()->get()->first(),
					'driver' => count($driver) ? $driver[0]['DriverName'] : 'No Selected Driver',
				]];

		} else {
			$output = ['status' => false, 'message' => 'invalid Selction ,Please Reload Page'];
		}

		return Response()->json($output);

	}

	/***
		     * check Weight Type is => by wazna (1)
		     * so Weight will be = 1 and total = Quantity * ProductPrice    <== by qnt
		     * else total will be = weight by default                       <== by weight (kilo)
		     * @param $inputs
		     * @return mixed
	*/
	private function GetTotal($inputs) {
		if ($inputs['WeightType'] > 0) {
			$inputs['Weight'] = 1;
			$inputs['Total'] = $inputs['Quantity'] * $inputs['ProductPrice'];
		} else {
			$inputs['Total'] = $inputs['Weight'] * $inputs['ProductPrice'] * $inputs['Quantity'];
		};
		return $inputs;
	}

	/***
		     * Add New Sales Details After Add Or Update
		     * @param $inputs
		     * @param $id
		     * @return array
	*/
	public function AddSalesDetails($inputs, $id) {
		$quantity = null;
		// get Total value
		$inputs = $this->GetTotal($inputs);

		$inputs['SalesID'] = $id;

		/**
		 * Check Container ID Is Exist By Supplier Ot No
		 * I Stopped Here
		 */
		$Container = new Containers();

		// Check if container and Supplier Exist SO continue else set as null
		$Container->IsSupplierAndContainerExist($inputs['SupplierID'], $inputs['ContainerID']) ?: $inputs['ContainerID'] = null;

		$attributes = array_only($inputs, ['ProductID', 'Weight', 'WeightType', 'Quantity', 'ProductPrice', 'SalesID', 'Total', 'Carrying', 'Commision', 'SupplierID', 'ContainerID']);

		// Insert Sales Details After Belong to Sales ID
		if (SalesDetails::Create($attributes)) {
			$output = ['status' => true, 'message' => 'New Details Added'];
		} else {
			$output = ['status' => false, 'message' => 'Cannot Add New Sales Date'];
		}
		return $output;
	}
	/***
		     * Add New Sales Details After Add Or Update Master(Sales)
		     * @param $inputs
		     * @param $id
		     * @return array
	*/
	public function UpdateSalesDetails($inputs, $serial, $SalesID, $OrginalSalesID = null) {

// dd($inputs, $serial, $SalesID, $OrginalSalesID);
		$quantity = null;
		$output = [];
		// get Total value
		$inputs = $this->GetTotal($inputs);
        
            // dd($inputs);
		if (isset($inputs['move'])) {
                // dd($inputs['move']);
			if ($SalesID != $OrginalSalesID) {
				$output['serial'] = $serial;
			}
			$inputs['SalesID'] = $SalesID;

		} else {
			if ($OrginalSalesID) {
				//  if nuil
				$inputs['SalesID'] = $OrginalSalesID;
			} else {
				$inputs['SalesID'] = $SalesID;
			}
		}
		$Container = new Containers();
		$Container->IsSupplierAndContainerExist($inputs['SupplierID'], $inputs['ContainerID']) ?: $inputs['ContainerID'] = null;

		$attributes = array_only($inputs, ['ProductID', 'Weight', 'WeightType', 'Quantity', 'ProductPrice', 'SalesID', 'Total', 'Carrying', 'SupplierID', 'Commision', 'ContainerID']);
// dd($attributes);
// Insert Sales Details After Belong to Sales ID
		if (SalesDetails::find($serial)->update($attributes)) {
			$output = array_merge($output, ['status' => true, 'message' => 'Sales Details Updated']);
//dd($output);
		} else {
			$output = ['status' => false, 'message' => 'Cannot Update Sales Details'];
		}
//dd($output);
		return $output;
	}

	/**
	 * delete sales and salesdetails that related with sales tables
	 * @param $id It encrypted SalesID
	 * @return mixed
	 */
	public function DeleteSalesDetails($SalesID) {

		$message = array(
			'SalesID.required' => 'Please Select Serial From List ,Or Reload Page',
			'SalesID.integer' => 'Please Select Serial From List ,Or Reload Page',
			'SalesID.exists' => 'Sales Number Doesnt Exist ,Please Reload Page',
		);

		$rules = array('SalesID' => 'required|integer|exists:tblSales,SalesID');

		$validator = Validator::make(['SalesID' => $SalesID], $rules, $message);

		$errors = $validator->messages()->toArray();
		if ($errors) {
			$output = ['status' => false, 'message' => $errors];
		} else {

			$serial = [];
			foreach (Request::all() as $k => $v) {
				$value = preg_replace('/[^0-9]/', '', $k);

				if ($this->where(['SalesID' => $SalesID, 'Serial' => $value])->delete()) {

					$serial[] = $value;

				}
			}
			if (count($serial) > 0) {
				$output = ['status' => true, 'message' => 'Sales Deteled', 'serials' => $serial];
			} else {
				$output = ['status' => false, 'message' => ['Please Select By Check Boxex']];
			}

		}
		return $output;
	}

}
