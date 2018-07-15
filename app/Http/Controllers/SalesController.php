<?php namespace App\Http\Controllers;

use App\Http\Models\Carrying;
use App\Http\Models\Containers;
use App\Http\Models\Customers;
use App\Http\Models\Drivers;
use App\Http\Models\EndoutDeal;
use App\Http\Models\Products;
use App\Http\Models\Sales;
use App\Http\Models\SalesDetails;
use App\Http\Models\Suppliers;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\Response as illuminateReponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Request;

//use DB;

class SalesController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * return void
	 */
	private $sales, $salesdetails, $customer, $suppliers, $products, $drivers, $containers, $endoutdeal;

	public function __construct() {
		$this->middleware('guest');
		$this->sales = new Sales();
		$this->salesdetails = new SalesDetails();
		$this->customer = new Customers();
		$this->suppliers = new Suppliers();
		$this->products = new Products();
		$this->drivers = new Drivers();
		$this->containers = new Containers();
		$this->endoutdeal = new EndoutDeal();
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * return Response
	 */
	public function index() {
		$Carrying = Carrying::find(1);
		$customers = Customers::all();
		$containers = Containers::all();
		$suppliers = Suppliers::all();
		$products = Products::all();
		$drivers = Drivers::all();
		return view('sales.home', compact(['json', 'customers', 'suppliers', 'products', 'drivers', 'Carrying', 'containers']));
	}
	/**
	 * get Customer Type From Customer ID
	 * Filter Inputs by CustomerType
	 * Validate Filterd Inputs
	 * Check Errors if not Found
	 * check if this ill already exist or not
	 * ( true) if not exist => filter inupts to insert in Sales Table after then Add Sales Details
	 * (false) if exist => update bill after that Add Sales Details
	 * Store New Sales Deal
	 * start With Trim All inputs and get every type Specific
	 * param Request $request
	 */
	public function store(Request $request) {

		$CType = Customers::find(Request::input('CustomerID'))->CustomerType;

		Input::merge(['CType' => $CType]);

		$inputs = $this->sales->GetInputs();
		// dd($inputs);
		$errors = $this->sales->Validateinputs($inputs);
		// dd($errors);
		// Check Error
		if (!$errors) {

			$inputs['SalesDate'] = Carbon::createFromFormat('Y/m/d', $inputs['SalesDate'])->toDateString();
			// dd($inputs);
			$Sales = Sales::where(array_only($inputs, ['CustomerID', 'SalesDate', 'RefNo']));
			// dd($Sales);
			// Check If Not Found then Create new Sales record
			if ($Sales->count() < 1) {

				// get attributes by customing Customer Type
				$attributes = $this->sales->SalesAttributesByCustomerType($inputs);
				// dd($attributes);
				try {
					// Check If true Then add New Sales Details
					$newSales = Sales::create($attributes);

					$output = $this->salesdetails->AddSalesDetails($inputs, $newSales->SalesID);
					// dd($output);

				} catch (\Exception $e) {
					// if false return ourput With errors
					$output = ['status' => false, 'message' => 'Cannot Add New Sales Master'];
				}

			} else {
				/* **
					                 * No Need To Update , Now Update Will Be from id => UpdateMSales Button
					                 * $attributes = $this->sales->SalesAttributesByCustomerType($inputs);
					                 * update all else Customer and Sales Dates
					                 * Sales::find($Sales->first()->SalesID)->update(array_except($attributes ,['SalesDate','CustomerID'] ));
				*/
				$output = $this->salesdetails->AddSalesDetails($inputs, $Sales->first()->SalesID);
				// dd($output);
			}

		} else {
			$output = ['status' => false, 'message' => $errors];
		}

		return Response()->json($output);
	}
	/**
	 * get sales date and reformat to able inserting in database
	 * Get SalesDetails using => Sales Inner Join SalesDetails using
	 * check if found sales details or no
	 * param $CustomerID
	 * param $SalesDate
	 * as ajax Request
	 * return array
	 */
	public function getcustomerdetails(Request $request) {

		$request = Request::all();
		$request['SalesDate'] = Carbon::createFromFormat('Y/m/d', $request['SalesDate'])->toDateString();
		// check if refno is set or no to get customer bill by ref and customer id with date => updated in 09-07-2015
		if (isset($request['RefNo'])) {
			trim($request['RefNo']) > 0 ?: $request['RefNo'] = 1;
		}

		$Sales = $this->sales->where($request)->get()->first();

		if (count($Sales)) {

			//  $Sales->Customers = $this->customer->where(['SalesID' => $Sales->SalesID]);

			$Sales->SalesDetails = $this->salesdetails->where(['SalesID' => $Sales->SalesID])
				->with('Supplier')
				->with('Product')->get();

			$Sales->SalesID = Crypt::encrypt($Sales->SalesID);

			$output = ['status' => true, 'data' => $Sales];
		} else {
			$output = ['status' => false];
		}

		//dd($output);
		return Response()->json($output);
	}

	/**
	 * Get Sales Details By ID
	 * param $serial of Sales Details
	 */
	public function getsalesdetailsById($serial) {

		return $this->salesdetails->getsalesdetailsById($serial);

	}
	/*
		     * Update Sales Details
		     * @param $serial => id of sales Details
	*/
	public function update($serial) {

		$inputs = array_map('trim', Request::all());
           // dd($inputs);
		// print_r($inputs);
		$inputs = $this->sales->RemovePrefix($inputs);

		$inputs['CType'] = Customers::find($inputs['CustomerID'])->CustomerType;

		$errors = $this->sales->Validateinputs($inputs);

		// Check Error
		if (!$errors) {

			$inputs['SalesDate'] = Carbon::createFromFormat('Y/m/d', $inputs['SalesDate'])->toDateString();

			$Sales = Sales::where(array_only($inputs, ['CustomerID', 'SalesDate' ,'refno']));
			// dd($Sales);

			// Check If Not Found then Create new Sales record
			if ($Sales->count() < 1) {

				$attributes = $this->sales->SalesAttributesByCustomerType($inputs);

				// Check If true Then add New Sales Details
				if ($newSales = Sales::create($attributes)) {

					$output = $this->salesdetails->UpdateSalesDetails($inputs, $serial, $newSales->SalesID);

				} else {
					// if false return output With errors
					$output = ['status' => false, 'message' => 'Cannot Add New Sales Date'];
				}

			} else {

				$output = $this->salesdetails->UpdateSalesDetails($inputs, $serial, $Sales->first()->SalesID);

				// i going to update sales if sales already found in database

				/***
					                 * No Need To Update , Now Update Will Be from id => UpdateMSales Button
					                 * $attributes = array_only($inputs , ['Discount' ,'Nowlon' ,'Custody' ] );
					                 * Sales::find($Sales->first()->SalesID)->update( $attributes );
				*/

			}

		} else {
			$output = ['status' => false, 'message' => $errors];
		}

		return Response()->json($output);
	}

	/**
	 * Delete Sales Details
	 * param Request $request
	 */
	public function SalesDetailsDestroy($serial) {
		// dd("Delete");
		$message = array(
			'Serial.required' => 'Please Select Serial From List ,Or Reload Page',
			'Serial.integer' => 'Please Select Serial From List ,Or Reload Page',
			'Serial.exists' => 'Serial Number Doesnt Exist ,Please Reload Page',
		);

		$rules = array('Serial' => 'required|integer|exists:tblSalesDetails,Serial');

		$validator = Validator::make(['Serial' => $serial], $rules, $message);

		$errors = $validator->messages()->toArray();
		if ($errors) {
			$output = ['status' => false, 'message' => $errors];
		} else {
			if (SalesDetails::destroy($serial)) {
				$output = ['status' => true, 'message' => 'Sales Deteled'];
			} else {
				$output = ['status' => false, 'message' => ['Cannot Delete Selected Serial']];
			}
		}

		return Response()->json($output);

	}

	/**
	 * param $id
	 * join Sales <=> SalesDetails
	 * join Sales <=> SalesDriver
	 * join SalesDetails <=> Products
	 * join SalesDetails <=> Supplier
	 * return Customers, Suppliers ,Products ,Drivers ,Carring ,Join Query (Info about Sales )
	 */
	public function edit($id) {

		$id = $this->checkencryption($id);

		$Sales = $this->sales
			->leftjoin($this->drivers->getTable(), $this->drivers->getTable() . '.DriverID',
				'=', $this->sales->getTable() . '.DriverID')

			->where([$this->sales->getTable() . '.SalesID' => $id])
			->get();

		$SalesDetails = $this->salesdetails

			->join($this->products->getTable(), $this->products->getTable() . '.ProductID',
				'=', $this->salesdetails->getTable() . '.ProductID')

			->join($this->suppliers->getTable(), $this->suppliers->getTable() . '.SupplierID',
				'=', $this->salesdetails->getTable() . '.SupplierID')

			->where([$this->salesdetails->getTable() . '.SalesID' => $id])
			->get();

		$Sales->get(0)->SalesDate = Carbon::createFromFormat('Y-m-d', $Sales->get(0)->SalesDate)->format('Y/m/d');

		$customers = Customers::all();
		$suppliers = Suppliers::all();
		$products = Products::all();
		$Carrying = Carrying::find(1);
		$drivers = Drivers::all();
		return view
		('sales.editbill', compact(['customers', 'suppliers', 'products', 'drivers', 'Carrying']))
			->with('Sales', $Sales->get(0))
			->with('SalesDetails', $SalesDetails)
			/*->with('SalesID',$id )*/;
	}

	/**
	 * delete sales and salesdetails that related with sales tables
	 * param $id It encrypted SalesID
	 * return mixed
	 */
	public function destroy($salesid) {
		// dd("$salesid");
		//        exit();
		$output = $this->salesdetails->DeleteSalesDetails($this->checkencryption($salesid));

		return Response()->json($output);
	}

	public function DestroyMaster($salesid) {

		$output = $this->sales->destroy($this->checkencryption($salesid));
		// dd($this->sales->destroy($this->checkencryption($salesid)));
		return Response()->json($output);
	}

	function getCType($salesid) {

		$SalesID = $this->checkencryption($salesid);
// dd($SalesID);
		// $input=Request::all();
		// dd($input);
		// $input=(array)$input;
		// $Customers=$input['CustomerID'];
		$output = $this->sales
			->leftjoin($this->customer->getTable(), $this->sales->getTable() . '.CustomerID', '=', $this->customer->getTable() . '.CustomerID')
			->where($this->sales->getTable() . '.SalesID', $SalesID)
			->get();
		// dd($output);
		return Response()->json($output);

	}

  //    public function TransferPro($salesid){

  //     $salesid = $this->checkencryption($salesid);
		// // dd($salesid);
		// $serials = []; // to set serial that updated to another Customer
		// $MasterInputs = Input::get('master');
		// // dd($MasterInputs);
		// parse_str($MasterInputs, $MasterInputs);

		// $MasterInputs['CType'] = $this->customer->find($MasterInputs['CustomerID'])->CustomerType;
		// // dd($MasterInputs['CustomerID']);
		// $CustomerID =$MasterInputs['CustomerID'];
		// // dd($CustomerID);
		// $DetailsInputs = Input::except(['master']);
		// // dd($DetailsInputs);
		// $DetailsInputs = $this->sales->RemoveCustomPrefix($DetailsInputs); 
  //       dd($DetailsInputs);
        

    
  //     return Response()->json($output);

  //    }

	/**
	 *
	 * param $salesid => id of sales
	 * */
	// public function updatebill($salesid) {

	// 	$salesid = $this->checkencryption($salesid);
	// 	// dd($salesid);
	// 	$serials = []; // to set serial that updated to another Customer
	// 	$MasterInputs = Input::get('master');
	// 	// dd($MasterInputs);
	// 	parse_str($MasterInputs, $MasterInputs);

	// 	$MasterInputs['CType'] = $this->customer->find($MasterInputs['CustomerID'])->CustomerType;
	// 	// dd($MasterInputs['CustomerID']);
	// 	$DetailsInputs = Input::except(['master']);
	// 	// dd($DetailsInputs);
	// 	$DetailsInputs = $this->sales->RemoveCustomPrefix($DetailsInputs);
	// 	// dd($DetailsInputs);
	// 	// Check And Validate Inputs
	// 	$errors = $this->sales->Validateinputs($MasterInputs, 'only_master');
	// 	// dd($errors);
	// 	// Check If error found on MasterInputs
	// 	if (!$errors) {

	// 		$Sales = $this->sales->where($this->sales->getTable() . '.SalesID', $salesid);
	// 		// dd($Sales);
	// 		// Check IF masterinputs not Exist

	// 		if ($Sales->count() < 1) {
	// 			//dd("Create New Row IN Data Base ");
	// 			$attributes = $this->sales->SalesAttributesByCustomerType($MasterInputs);

	// 			// Create New Sales
	// 			$newSales = Sales::create($attributes);

	// 		} else {
	// 			// dd("notupdated");
	// 			$attributes = $this->sales->SalesAttributesByCustomerType($MasterInputs);
 //               // dd($attributes);
	// 			// update Master

	// 			if (Sales::find($Sales->first()->SalesID)->update($attributes)) {
	// 				// dd(Sales::find($Sales->first()->SalesID)->update($attributes));
	// 				$output = ['status' => true, 'message' => ['تم تعديل البيانات الاساسيه بنجاح ']];
	// 				// dd($output);
	// 			} else {

	// 				$output = ['status' => false, 'message' => ['لم يتم تعديل الشاشه الاساسيه ']];
	// 			}

	// 		}

	// 		DB::beginTransaction();
	// 			// dd($DetailsInputs);
	// 		foreach ($DetailsInputs as $k => $record) {
	// 			// dd($DetailsInputs);
	// 			// dd($k);
	// 			// dd($record);
	// 			$errors = $this->sales->Validateinputs($record, 'only_details');
	// 			// dd($errors);
	// 			// check if found error to exit and roll back if already inserted record
	// 			if ($errors) {
	// 				$output = ['status' => false, 'message' => $errors];
	// 				// dd($output);
	// 				break;
	// 			} else {
	// 				//update in database
	// 	$output = $this->salesdetails->UpdateSalesDetails($record, $k, $Sales->first()->SalesID, $salesid);
	// 	// $output = $this->salesdetails->update($DetailsInputs);
	// 	// $output =  (Sales::find($Sales->first()->SalesID)->update($DetailsInputs));
	// 				// dd($output);

	// 				isset($output['serial']) ? $serials['serials'][] = $output['serial'] : false;
	// 			}
	// 		}
	// 		if ($output['status'] == true) {
	// 			// dd(($output['status'] == true));
	// 			DB::commit();
	// 		} else {
	// 			DB::rollback();
	// 		}

	// 	} else {
	// 		$output = ['status' => false, 'message' => $errors];
	// 		// dd($output);
	// 	}
	// 		// dd($output, $serials);
	// 	return Response()->json(array_merge($output, $serials));
	// }


	 public function updatebill($salesid){
 
        $salesid = $this->checkencryption($salesid);

        $serials= []; // to set serial that updated to another Customer
          
        $MasterInputs = Input::get('master');

        parse_str($MasterInputs ,$MasterInputs);

        $MasterInputs['CType'] = $this->customer->find($MasterInputs['CustomerID'])->CustomerType;


        $DetailsInputs = Input::except(['master']);
         // dd($DetailsInputs);
        $DetailsInputs = $this->sales->RemoveCustomPrefix($DetailsInputs);

        // Check And Validate Inputs
        $errors = $this->sales->Validateinputs($MasterInputs,'only_master');

        // Check If error found on MasterInputs
        if (!$errors){
            // Format Sales Date
            $MasterInputs['SalesDate'] = Carbon::createFromFormat('Y/m/d', $MasterInputs['SalesDate'])->toDateString();


            // $MasterInputs['CustomerID'] = '7'; // to check error temp line

            $Sales = Sales::where( array_only($MasterInputs ,['SalesID','CustomerID','SalesDate','RefNo'] ) );
            // Check IF masterinputs not Exist
            if ( $Sales->count() < 1 ){

                $attributes = $this->sales->SalesAttributesByCustomerType($MasterInputs);

                // Create New Sales
                $newSales = Sales::create( $attributes );

            }else{
                $attributes = $this->sales->SalesAttributesByCustomerType($MasterInputs);

                // update Master
                if (Sales::find($Sales->first()->SalesID)->update($attributes)){
                    $output = ['status' => true , 'message' => ['Master Sales Updated'] ];
                }else{
                    $output = ['status' => false , 'message' => ['Cannot Update Master'] ];
                }
            }

            DB::beginTransaction();
            foreach ($DetailsInputs as $k => $record) {

                $errors = $this->sales->Validateinputs($record,'only_details');

                // check if found error to exit and roll back if already inserted record
                if ($errors){
                    $output = ['status' => false , 'message' => $errors ];
                    break;
                }else{
                    //update in database
                    $output = $this->salesdetails->UpdateSalesDetails($record , $k ,$Sales->first()->SalesID ,$salesid );
                    isset($output['serial']) ? $serials['serials'][] = $output['serial'] : false ;
                }
            }
            if ($output['status'] == true){
                DB::commit();
            }else{
                DB::rollback();
            }

        }else{
            $output = ['status' => false , 'message' => $errors ];
        }

        return Response()->json(array_merge($output,$serials));
    }


	/**
	 * check if string can be decrypt or its fake
	 *  $encrypted
	 * int
	 */
	private function checkencryption($encrypted) {
		try {
			return Crypt::decrypt($encrypted);

		} catch (\Exception $e) {
			return 0;
		}
	}

	/**
	 * Update Master Sales Only
	 *  $salesid
	 * n mixed
	 */
	public function updatemaster($salesid) {
// dd("yyyyyyyyyyyyyy");
		$salesid = $this->checkencryption($salesid);

		if (is_numeric($salesid) && $salesid > 0) {

			$output = $this->sales->updatemaster($salesid);

		} else {

			$output = ['status' => false, 'message' => ['No Sales Master Found , Please Change Customer Or Sales Date to Found Sales Master']];

		}

		return Response()->json($output);
	}
	/**
	 * End Deal Function
	 * View
	 */
	public function endoutdeal() {

		$customers = $this->customer->where(['CustomerType' => '1'])->get(); // wakala 5argia only
		return view('sales.endoutdeal', compact(['customers']));

	}

	/**
	 * Savind End OUT Deal
	 */
	public function SaveEndOutDeal($SalesID) {

		$vars = array_only(Request::all(), ['valuesold', 'billexpenses', 'commision'
			, 'estimatedvalue', 'internalexpenses']);
		$vars['SalesID'] = $this->checkencryption($SalesID);

		if (!$errors = $this->endoutdeal->validate($vars)) {
			// No Error
			$inputs = function () use ($vars) {
				$vars['Total_1'] = $vars['valuesold'] - $vars['billexpenses'] - $vars['commision'];
				$vars['Total_2'] = $vars['estimatedvalue'] + $vars['internalexpenses'];
				return $vars;
			};
			$output = $this->endoutdeal->InsertEndoutdeal($inputs());
		} else {
			// Found Error
			$output = ['status' => false, 'message' => $errors, 'code' => illuminateReponse::HTTP_BAD_REQUEST];
		}

		return Response()->json($output);
	}

	/**
	 * Get data about every bill
	 * So developer Not Need To use ajax to get Nowlon , Commissiontotal Carrying
	 * mixed
	 */
	public function GetRefsForDeal() {

//        dd("aaa");
		//        exit();
		$input = Request::all();
		$input['SalesDate'] = Carbon::createFromFormat('Y/m/d', $input['SalesDate'])->toDateString();

		$Sales = $this->sales->where(array_only($input, ['CustomerID', 'SalesDate']))
			->get();

		$data = [];
		foreach ($Sales as $k => $v) {
			$data[$k]['exist'] = (boolean) $this->endoutdeal->IsEnddealAlreadyExistBySalesID($v->SalesID);
			$data[$k]['id'] = Crypt::encrypt($v->SalesID);
			$data[$k]['refno'] = $v->RefNo;
			$data[$k]['total'] = $this->salesdetails->where(['SalesID' => $v->SalesID])->sum('Total');
			$data[$k]['totalcaring'] = $this->salesdetails->where(['SalesID' => $v->SalesID])->sum('Carrying');
			$data[$k]['nowlon'] = $v->Nowlon;
			$data[$k]['custody'] = $v->Custody;
			$data[$k]['discount'] = $v->Discount;
			$data[$k]['totalcarrying'] = $v->TotalCarrying;

		}

		return Response()->json($data);
	}

	/**
	 * Get Supplier Containers
	 *  $SupplierID
	 *  mixed
	 */
	public function GetSupplierContainers($SupplierID) {
//        dd("500000");
		//        exit();
		$data = $this->containers->where([
			'SupplierID' => $SupplierID,
			'ContainerEndDate' => null,
		])->get();
		return Response()->json($data);

	}

	/**
	 * Edit Deal If Exist
	 * $SalesID
	 *  $this
	 */
	public function EditEndoutDeal() {
		$SalesID = Input::get('key');
		$SalesID = function () use ($SalesID) {
			$SalesID = $this->checkencryption($SalesID);
			if ($SalesID && $this->endoutdeal->IsEnddealAlreadyExistBySalesID($SalesID)) {
				return $SalesID;
			} else {
				return 0;
			}
		};

		$endoutdeal = $this->endoutdeal->where(['SalesID' => $SalesID()])->get();
		if (!$endoutdeal->count()) {
			return Redirect::to('/sales/endoutdeal/')->with('errors', 'Invalid Selected Deal');
		}

		return view('sales.endoutdeal')->with('deal', $endoutdeal->first());

	}

	/**
	 * Get Sales Id
	 * Update Deal If Exist
	 *  $SalesID
	 *  $this
	 */
	public function UpdateEndoutDeal($SalesID) {

		$SalesID = function () use ($SalesID) {
			$SalesID = $this->checkencryption($SalesID);
			if ($SalesID && $this->endoutdeal->IsEnddealAlreadyExistBySalesID($SalesID)) {
				return $SalesID;
			} else {
				return 0;
			}
		};
		$vars = array_only(Request::all(), ['valuesold', 'billexpenses', 'commision'
			, 'estimatedvalue', 'internalexpenses']);

		if (!$errors = $this->endoutdeal->validate($vars, 'update')) {
			// No Error
			$inputs = function () use ($vars) {
				$vars['Total_1'] = $vars['valuesold'] - $vars['billexpenses'] - $vars['commision'];
				$vars['Total_2'] = $vars['estimatedvalue'] + $vars['internalexpenses'];
				return $vars;
			};

			$this->endoutdeal->where(['SalesID' => $SalesID()])->update($inputs());

			$output = ['status' => true, 'message' => ['EndOutDeal Updated'], 'code' => illuminateReponse::HTTP_OK];

		} else {
			// Found Error
			$output = ['status' => false, 'message' => $errors, 'code' => illuminateReponse::HTTP_BAD_REQUEST];
		}

		return Response()->json($output);
	}

	public function getCustomerType() {
		// get customer type
		$input = Request::all();
		$input = (array) $input;
		$Customers = $input['CustomerID'];
		$output = $this->customer
			->where($this->customer->getTable() . '.CustomerID', $Customers)
			->get();
		// dd($output);
		return Response()->json($output);

	}

	public function getDriver() {

		$input = Request::all();
		$input = (array) $input;
		$Customers = $input['CustomerID'];
		$output = $this->drivers
			->leftjoin($this->sales->getTable(), $this->drivers->getTable() . '.DriverID', '=', $this->sales->getTable() . '.DriverID')
			->where($this->sales->getTable() . '.CustomerID', $Customers)
			->get();
		//dd($output);
		return Response()->json($output);

	}

} //end of class
