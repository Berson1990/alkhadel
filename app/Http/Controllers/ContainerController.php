<?php namespace App\Http\Controllers;

use App\Http\Models\ContainerCustoms;
use App\Http\Models\Drivers;
use App\Http\Models\Suppliers;
use App\Http\Models\Containers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as illuminateReponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class ContainerController extends Controller
{

    private $supplier, $container, $driver;

    /** 10 /06 /2015
     * Must Before Insert Or Update Container
     * Check If SupplierType Equal (1) Cause he is External Supplier
     */

    public function __construct()
    {
        $this->supplier = new Suppliers();
        $this->container = new Containers();
        $this->ccontainer = new ContainerCustoms();
        $this->driver = new Drivers();

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $containers = $this->container->all();
        $suppliers = $this->supplier->where(['SupplierType' => '1'])->get();

        return view('containers.containers', compact(['containers', 'suppliers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {


//        dd("eeee");
//        exit();

        $inputs = $this->ClearInputs(Request::all());
//        return Response::json($inputs);
//dd($inputs);
        $errors = $this->container->Validate($inputs);

        if (!$errors) {

            $inputs = $this->TransFormInputs($inputs);
//            return Response::json($inputs);

//         return Response::json($inputs);

            $Container = $this->container->create($inputs);


            $output = ['status' => true, 'container' => $Container, 'message' => 'New Container Aded with local Num ' . $inputs['ContainerLocalNum'], 'code' => illuminateReponse::HTTP_CREATED];

        } else {

            $output = ['status' => false, 'message' => $errors, 'code' => illuminateReponse::HTTP_BAD_REQUEST];
        }
        // dd($output);
        return Response::json($output);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Getmethod with ajax and check If id Exist In database
     * Get Container Details By ID expected Update_at & created_ats
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

        $errors = $this->IsContainerExist($id);

        if (!$errors) {

            $Container = $this->container->find($id);

            $Container->ContainerOpenDate = $Container->ContainerOpenDate;

            $Container->ContainerEndDate = $Container->ContainerEndDate;
            // dd($Container['ContainerType']);
            if ($Container['ContainerType'] == 1)//{
//                $output = ['status' => true , 'data' => [
//                'Container' => array_except($Container->toArray() , ['DriverID' ,'created_at' ,'updated_at']) ,
//'Driver' => array_except($this->driver->find($Container->DriverID)->toArray() , ['created_at' ,'updated_at']) ,
//                        ]
            {
                $output = ['status' => true, 'data' => [
                    'Container' => array_except($Container->toArray(), ['CarNumber', 'DriverID', 'created_at', 'updated_at']),

                ]
                    , 'code' => illuminateReponse::HTTP_OK];


            }
//                    ,'code' => illuminateReponse::HTTP_OK];
            // dd($output);

            else if ($Container['ContainerType'] == 0) {
                $output = ['status' => true, 'data' => [
                    'Container' => array_except($Container->toArray(), ['CarNumber', 'DriverID', 'created_at', 'updated_at']),

                ]
                    , 'code' => illuminateReponse::HTTP_OK];


            }
        } else {

            $output = ['status' => false, 'message' => $errors, 'code' => illuminateReponse::HTTP_BAD_REQUEST];

        }
        // dd($output);
        return Response::json($output);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $errors = $this->container->Validate($inputs = array_merge(Request::all(), ['ContainerID' => $id]), 'update'); // Type is Update to check If Container ID Is Exist

        if (!$errors) {

            $inputs = $this->TransFormInputs($inputs);
            // dd($inputs);

            $this->container->find($id)->update(array_except($inputs, ['ContainerLocalNum']));


            $output = ['status' => true, 'message' => 'Container Details Updated', 'code' => illuminateReponse::HTTP_OK];

        } else {

            $output = ['status' => false, 'message' => $errors, 'code' => illuminateReponse::HTTP_BAD_REQUEST];
        }

        return Response::json($output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $errors = $this->IsContainerExist($id);

        if (!$errors) {
            try {
                $Container = $this->container->destroy($id);
                $output = ['status' => true, 'message' => 'Container Deleted', 'code' => illuminateReponse::HTTP_OK];
            } catch (\Exception $e) {
                $output = ['status' => false, 'message' => ['error' => 'This Container Have A many Prodcts'], 'code' => illuminateReponse::HTTP_BAD_REQUEST];
            }

        } else {

            $output = ['status' => false, 'message' => $errors, 'code' => illuminateReponse::HTTP_BAD_REQUEST];

        }
        return Response::json($output);
    }

    /**
     * Get Max Numer Of Container
     * @param Request $request
     * @return mixed
     */
    public function GetMaxContainer(Request $request)
    {
        $output = $this->container->GetMaxContainer(Request::all(), 'getmaxcontainer');
        return Response::json($output);
    }

    /**
     * @param $inputs
     * @return max
     */
    public function ContainerMaxLocalNum($inputs)
    {
//        $inputs = Request::all();

//        $year = Carbon::createFromFormat('d/m/Y', $inputs['ContainerOpenDate'])->format('Y');
        
        $max = $this->container->where(['SupplierID' => $inputs['SupplierID']])
            ->select("ContainerLocalNum")
            ->orderby('created_at', 'desc')
            ->limit(1)
            ->get();


        if (Count($max) == 0) {
            $max = 0;
        } else {
            foreach ($max as $max) {
                $max = $max->ContainerLocalNum;

            }
        }
        return $max;
    }

    /**
     * TransFormInputs
     * get max local number
     * Conver Container Date To another Format
     * Set input date as null if not found
     * @param $inputs
     * @return $inputs
     */
    public function TransFormInputs($inputs)
    {

        $inputs['ContainerLocalNum'] = $this->ContainerMaxLocalNum($inputs) + 1;

        $inputs['ContainerOpenDate'] = Carbon::createFromFormat('d/m/Y', $inputs['ContainerOpenDate'])->toDateString();
        $inputs['ContainerEndDate'] = $inputs['ContainerEndDate'] ? Carbon::createFromFormat('d/m/Y', $inputs['ContainerEndDate'])->toDateString() : null;
        return $inputs;
    }

    /**
     * Change Container Status by Toggle
     * @param $id
     * @return mixed
     */
    public function ChangeContainerStatus($id)
    {

        $errors = $this->IsContainerExist($id);

        if (!$errors) {

            $ContainerStatus = $this->container->find($id)->ContainerStatus;

            $this->container->find($id)->update(['ContainerStatus' => $ContainerStatus > 0 ? 0 : 1]);

            $output = ['status' => true, 'message' => $ContainerStatus > 0 ? 'Container Closed' : 'Container Open', 'container' => $ContainerStatus > 0 ? (Boolean)0 : (Boolean)1, 'code' => illuminateReponse::HTTP_OK];

        } else {

            $output = ['status' => false, 'message' => $errors, 'code' => illuminateReponse::HTTP_BAD_REQUEST];

        }
        return Response::json($output);

    }

    /**
     * Get Container Sales Sales Details and Products
     * @param $id
     * @return mixed
     */
    public function GetContainerProductsAndCustoms($id)
    {

        $errors = $this->IsContainerExist($id);

        if (!$errors) {
            $ccustoms = $this->ccontainer->where(['ContainerID' => $id])->with('Customs')->get();

            $products = $this->container->find($id)->SalesDetails()
                ->with(['Sales' => function ($Sales) {
                    $Sales->with(['Customer' => function ($customer) {
                        $customer->get();
                    }]);
                }
                ])->with('Product')->get();

            $output = ['status' => true, 'data' => ['products' => $products, 'ccustoms' => $ccustoms], 'code' => illuminateReponse::HTTP_OK];

        } else {

            $output = ['status' => false, 'message' => $errors, 'code' => illuminateReponse::HTTP_BAD_REQUEST];

        }
        return Response::json($output);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function ContainerDetails($id)
    {

        $errors = $this->IsContainerExist($id);

        if (!$errors) {

            $data = $this->container->find($id);

            $output = ['status' => true, 'data' => $data, 'code' => illuminateReponse::HTTP_OK];

        } else {

            $output = ['status' => false, 'message' => $errors, 'code' => illuminateReponse::HTTP_BAD_REQUEST];

        }

        return Response::json($output);
    }

    /**
     * Check If Container Exist
     * @param $id
     */
    private function IsContainerExist($id)
    {
        return Validator::make(
            ['ContainerID' => $id], // inputs
            ['ContainerID' => 'required|exists:tblContainers,ContainerID'], // Rules
            [ // Messages
                'ContainerID.required' => 'Select Container To Edit From List',
                'ContainerID.exists' => 'Selectd Container Doesnt Exist , Please Reload Page'
            ]
        )->messages()->toArray();
    }

    /***
     * Get Open Container y Supplier ID
     * @param $SupplierID
     * @return mixed
     * @usedin Sales Screen
     */
    public function GetSupplierContainers()
    {

//		dd("555555555555555");
//            exit();
        $SupplierID = Input::get('SupplierID') ?: 0;
        $localnum = Input::get('LocalNum');

//        $errors = $this->supplier->isExistById($SupplierID);
//		print_r("#$errors#");
        if ($this->supplier->isExistById($SupplierID)) {

            // Chec If LocalContainerNum not empty and more than zero so pust ContainerLocalNum Value to where Statement
            $attrbuites = ['SupplierID' => $SupplierID, 'ContainerStatus' => '1'];

            empty($localnum) && $localnum < 1 ?: $attrbuites['ContainerLocalNum'] = $localnum;

            $data = $this->container->where($attrbuites)->select('ContainerID', 'ContainerIntNum', 'ContainerLocalNum')
                ->get();
            // Check If Supplier Has open Container or Not
            if ($data->count()) {

                $output = ['status' => true, 'data' => $data, 'code' => illuminateReponse::HTTP_OK];

            } else {

                $output = ['status' => false, 'message' => ['No Open Conatainer'], 'code' => illuminateReponse::HTTP_OK];

            }
        } else {

            $output = ['status' => false, 'message' => $errors, 'code' => illuminateReponse::HTTP_BAD_REQUEST];

//			print_r($errors);
//			return Response()->json($errors);
        }
        return Response::json($output);
    }

    /**
     * Clear Inputs
     * @param $inputs
     * @return array
     */
    private function ClearInputs($inputs)
    {
        $inputs = array_only($inputs, [
            'SupplierID', 'ContainerOpenDate', 'ContainerIntNum', 'ContainerEndDate', 'OtherExpenses',
            'Commision', 'ContainerType', 'CarNumber', 'Nowlon', 'DriverID', 'ContainerStatus',
        ]);

        if ($inputs['ContainerType'] == '0') {

            $inputs['DriverID'] = null;
            $inputs['CarNumber'] = null;
            $inputs['Nowlon'] = '0';

        } else if (empty($inputs['Nowlon'])) {
            $inputs['Nowlon'] = '0';
        }

        return $inputs;
    }
}
