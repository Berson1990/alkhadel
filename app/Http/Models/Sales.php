<?php namespace App\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Request;

class Sales extends Model{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tblSales';

    protected $primaryKey = 'SalesID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['CustomerID', 'SalesDate', 'Discount', 'Nowlon', 'DriverID', 'Custody', 'RefNo', 'TotalCarrying'];

    public function GetInputs(){

        switch(Request::input('CType')){
            case "0" : // Local Customer
                $inputs = Request::only('CType' ,'SalesDate' ,'SupplierID' ,'CustomerID' ,'Commision' ,'Carrying' ,'Discount' ,'ProductID' ,'ContainerID' ,'WeightType' ,'Weight','Quantity','ProductPrice' ,'RefNo');
                break;
            case "1" : // brand
                $inputs = Request::only('CType' ,'SalesDate' ,'SupplierID' ,'CustomerID' ,'Commision' ,'Carrying' ,'Discount' ,'ProductID' ,'ContainerID' ,'WeightType' ,'Weight','Quantity','ProductPrice' ,'RefNo' ,'Nowlon' ,'DriverID' ,'Custody' );
                break;
            case "2" : // upper Egypt
                $inputs = Request::only('CType' ,'SalesDate' ,'SupplierID' ,'CustomerID' ,'Commision' ,'Carrying' ,'Discount' ,'ProductID' ,'ContainerID' ,'WeightType' ,'Weight','Quantity','ProductPrice' ,'RefNo' ,'Custody' ,'RefNo' );
                break;
        }
        return $inputs;
    }
    /**
     * Validate Inputs Before Store
     * @param $CustomerType
     */
    public function Validateinputs($inputs ,$type =null){
        $inputs = array_map('trim' ,$inputs);
        extract($inputs);
        /***
         * For Errors
        $inputs['CustomerID'] = 310;
        $inputs['SupplierID'] = 510;
        $inputs['SalesDate'] = 510;
        $Weight = 0;
        $ProductPrice = 0;
        $inputs['DriverID'] = 510;
        $inputs['Nowlon'] = "asd";
        $inputs['Custody'] = "asf";
         */
        /**
         * Check If Container ID is Equal Zero to set null
         */
        if (isset($inputs['SupplierID']) && isset($inputs['ContainerID'])){
            $Container = new Containers();
            $Container->IsSupplierAndContainerExist($inputs['SupplierID'],$inputs['ContainerID']) ?: $inputs['ContainerID'] = null;
        }

        // Start Validation After Switch Case To get All that changed With Customer Type
        $validator = Validator::make($inputs ,$this->_ValidationRules($type) ,$this->_ValidationMessage() );

        return $validator->messages()->toArray() ;
    }


    /**
     * Validation Message
     * @return array
     */
    private function _ValidationMessage(){
        return array(

//            'CustomerID.required' => 'Please Select Customer Name From List',
            'CustomerID.required' => 'من فضلك اختار تاجر',
//            'CustomerID.exists' => 'Selected Customer Not EXist In Database',
            'CustomerID.exists' =>  'هذا التاجر غير متواجد فى قاعدة البيانات',

//            'SupplierID.required' => 'Please Select Supplier Name From List',
            'SupplierID.required' => 'برجاء ادخال اسم الفلاح ',
            
//            'SupplierID.exists' => 'Selected Supplier Not EXist In Database',
            
            'SupplierID.exists' => 'هذا الفلاح غير متواجد فى قاعدة البيانات',

//            'ProductID.required' => 'Please Select Product Name From List',
            'ProductID.required' => 'من فضلك اختر اسم المنتج ',
            
//            'ProductID.exists' => 'Selected Product Not EXist In Database',
            'ProductID.exists' => 'اسم المنتج غير موجود فى قاعدة البيانات ',

//            'Weight.required' => 'Please Type Product Weight',
            'Weight.required' => ' من فضلك ادخل وزن المنتج ',
            
//            'ProductPrice.required' => 'Please Type Product Price',
            'ProductPrice.required' => 'من فضلك اختر سعر المنتج ',

//            'SalesDate.required' => 'Please Select Date',
            'SalesDate.required' => ' من فضلك اختار تاريخ ',
            
//            'SalesDate.date_format' => 'Invalid Date Format',
//            'SalesDate.date_format' => 'Invalid Date Format',

//            'Carrying.required' => 'Please Enter Carrying Value',
            'Carrying.required' => ' ادخل قيمة المشال',
            
            'Carrying.numeric' => 'المشال يجب ان يكون ارقام ',

            'TotalCarrying.numeric' => 'المشال الكلى يجب ان يكون ارقام ',

//            'Discount.required' => 'Please Enter Discount Value',
            'Discount.required' => 'من فضلك ادخل قيمة الخصم',
//            'Quantity.required' => 'Please Enter Quantity Value',
            'Quantity.required' => 'من فضلك ادخل عدد المنتج',
            
            'WeightType.required' => 'Weight Type Is Required',
//            'WeightType.required' => 'Weight Type Is Required',
            'Nowlon.integer' => 'النولون يجب ان يكون ارقام ',
            'Custody.integer' => 'العهدة يجب ان تكون ارقام',
//            'DriverID.integer' => 'DriverID Must Be Integer',
//            'DriverID.exist' => 'DriverID Doesnt Exist Please Select From Database',

        );
    }

    /**
     * Validation Rules
     * @return array
     */
    private function _ValidationRules($type){
        $rules = array(
            'SalesDate' => 'required|date_format:"Y/m/d"' ,
            'SupplierID' => 'required|exists:tblSuppliers,SupplierID' ,
            'CustomerID' => 'required|exists:tblCustomers,CustomerID' ,
            'Commision' => 'numeric' ,
            'ProductID' => 'required|integer|exists:tblProducts,ProductID' ,
//            'Weight' => 'required|integer' ,
            'Weight' => 'required' ,
            'WeightType' => 'required|integer' ,
            'Quantity' => 'required|integer|between:1,65000' ,
            'Carrying' => 'required|min:0|numeric' ,
            'ProductPrice' => 'required|numeric',
            /* Wakala 5argia Validation */
            'DriverID' => 'integer|exists:tblDrivers,DriverID',
            'Nowlon' => 'integer',
            'Custody' => 'integer',
            'ContainerID' => 'integer|exists:tblContainers,ContainerID',
            /* Upper Egypt Validation */

        );
        if ($type){
            switch($type){
                case 'only_master':
                    $rules = array_only($rules,['SalesDate' ,'CustomerID' ,'RefNo','Nowlon','Discount' ,'Custody' ,'DriverID' ]);
                    $rules ['TotalCarrying'] = 'required|numeric';
                    $rules ['RefNo'] = 'required|numeric|between:1,999';
//                    $rules ['Discount'] = 'required|numeric|between:0,99.9';
                    break;
                case 'home_only_master':
                    $rules = array_only($rules,['SalesDate' ,'CustomerID' ,'RefNo','Nowlon','Discount' ,'Custody' ,'DriverID' ]);
                    $rules ['SalesID'] = 'required|integer|exists:tblSales,SalesID';
                    $rules ['RefNo'] = 'required|numeric|between:1,999';
//                    $rules ['Discount'] = 'required|numeric|between:0,99.9';
                    break;
                case 'only_details':
                    $rules = array_only($rules,[
                        'SupplierID' ,'ProductID' ,'Weight' ,'WeightType' ,'Quantity' ,'Carrying' ,
                        'ProductPrice' ,'Commision','ContainerID'
                    ]);
                    break;
            }
        }

        return $rules;
    }

    /**
     * Get Sales Atrrtibutes By Customer ID To Insert In Sales Table
     * @param $inputs
     * @return array
     */
    public function SalesAttributesByCustomerType($inputs){
        switch ($inputs['CType']){
            case '0'; // local Customer

                $attributes = array_only($inputs ,['CustomerID','SalesDate','Discount' ,'RefNo' ,'TotalCarrying'] );
                break;
            case '1'; // brand

                $attributes = array_only($inputs ,['CustomerID','SalesDate','Discount' ,'RefNo' ,'Nowlon' ,'Custody' ,'DriverID' ,'TotalCarrying'] );
                break;
            case '2'; // upper egypt

                $attributes = array_only($inputs ,['CustomerID' ,'SalesDate' ,'Discount' ,'Custody' ,'RefNo' ,'TotalCarrying'] );
                break;
        }
        return $attributes;
    }
    /**
     * Sales Has Many Sales Details
     * */
    public function SalesDetails()
    {
        return $this->hasMany('App\Http\Models\SalesDetails' , 'SalesID');
    }
    /**
     * Remove Prefix (up_) from keys to start add in Database
     * @param $inputs
     * @return array
     */
    public function RemovePrefix($inputs)
    {
        return array_combine(
            array_map(
                function ($k) {
                    return str_replace( 'up_', "", $k);
                },
                array_keys($inputs)
            ),
            array_values($inputs)
        );
    }
    /**
     * Remove Prefix (_) from keys to start add in Database
     * @param $inputs
     * @return array
     */
    public function RemoveCustomPrefix($inputs){

        $output = array();

        foreach ($inputs as $k => $v) {

            parse_str($inputs[$k] , $output[$k]);

            $output[$k] = array_combine(
                array_map(
                    function ($k) {
                        return explode('_',$k )[0];
                    },
                    array_keys($output[$k])
                ),
                array_values($output[$k])
            );
            $output[$k] = array_map('trim' ,$output[$k]);
        }
        return $output;
    }
    /**
     * Sales Belong to ProductID
     * @relationship
     * */
    public function product()
    {
        return $this->belongsTo('App\Http\Models\Products' ,'ProductID')->select();
    }
    /**
     * Sales Belong to DriverID
     * @relationship
     * */
    public function Driver()
    {
        return $this->belongsTo('App\Http\Models\Drivers' ,'DriverID')->select();
    }
    /**
     * Sales Belong to SupplierID
     * @relationship
     * */
    public function Supplier()
    {
        return $this->belongsTo('App\Http\Models\Suppliers' ,'SupplierID')->select();
    }
    /**
     * Sales Belong to CustomerID
     * @relationship
     * */
    public function Customer()
    {
        return $this->belongsTo('App\Http\Models\Customers' ,'CustomerID')->select();
    }
    /**
     * Update Master Sales Only
     * @param $salesid
     * @return mixed
     */
    public function updatemaster($salesid){

        $inputs = Request::all();

        $inputs['CType'] = Customers::find($inputs['CustomerID'])->CustomerType;

        $inputs = $this->SalesAttributesByCustomerType($inputs);

        $inputs['SalesID'] = $salesid;

        $errors = $this->Validateinputs($inputs,'home_only_master');

        if( !$errors ) {

            $inputs['SalesDate'] = Carbon::createFromFormat('Y/m/d', $inputs['SalesDate'])->toDateString();

            if ($this->find($salesid)->update(array_except($inputs , ['CType' ,'TotalCarrying']) ) ){

                $output = ['status' => true , 'message' => ['Master Details Updated'] ];

            }

        }else{
            $output = ['status' => false , 'message' => $errors ];
        }

        return $output;
    }
}

