<?php namespace App\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Validator;

class Containers extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblContainers';
    /**
     * Primary Key
     * @var string
     */
    protected $primaryKey = 'ContainerID';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['SupplierID' ,'ContainerIntNum' ,'ContainerLocalNum' ,'ContainerOpenDate' ,'ContainerEndDate'
        ,'Commision' ,'OtherExpenses' ,'ContainerStatus' ,'ContainerType' ,'CarNumber' ,'DriverID','Nowlon' ];

    /**
     * Container Belong to SupplierID
     * @relationship
     * */
    public function Supplier()
    {
        return $this->belongsTo('App\Http\Models\Suppliers', 'SupplierID')->select();
    }
    /**
     * Container Belong to DriverID
     * @relationship
     * */
    public function Driver()
    {
        return $this->belongsTo('App\Http\Models\Drivers', 'DriverID')->select('DriverID' ,'DriverName');
    }

    /**
     * Validation Message
     * @return array
     */
    private function _ValidationMessage(){
        return [
            'SupplierID' => 'يجب ادخال اسم المورد',
            'DriverID' => '',
            'ContainerOpenDate' => '',
            'ContainerEndDate' => '',
            'ContainerIntNum' => '',
            'ContainerLocalNum' => '',
            'OtherExpenses' => '',
            'Commision' => '',
            'ContainerStatus' => '',
            'CarNumber' => '',
            'Nowlon' => '',
            'ContainerType' => '',
        ];
    }

    /**
     * Valdation Rules
     * @return $rules
     */
    private function _ValidationRules($type){
        $rules = [
            'SupplierID' => 'required|exists:tblSuppliers,SupplierID',
//            'DriverID' => 'exists:tblDrivers,DriverID',
            'ContainerOpenDate' => 'required|date_format:"d/m/Y"',
//            'ContainerEndDate' => 'date_format:"d/m/Y"',
//            'ContainerOpenDate' =>  'ContainerOpenDate < ContainerEndDate',
            // 'ContainerIntNum' => 'required|between:0,65000',
//            'OtherExpenses' => 'required|numeric|between:0,65000',
            // 'Commision' => 'required|numeric|between:0,65000',
            'ContainerStatus' => 'required|numeric|between:0,1',
            'ContainerType' => 'required|numeric|between:0,1',
            'Nowlon' => 'numeric',
        ];

        switch($type){
            case "getmaxcontainer" :
                $rules = array_only($rules , ['SupplierID' ,'ContainerOpenDate']);
                break;
            case "update" :
                $rules = array_merge($rules , ['ContainerID' => 'required|exists:tblContainers,ContainerID'] );
                break;
        }

        return $rules;
    }

    /**
     * Validate All Inputs Before Insert In Database
     * @param $inputs
     * @return mixed
     */
    public function Validate($inputs ,$type = null){
        $inputs = array_map('trim' ,$inputs);
        $validator = Validator::make($inputs ,$this->_ValidationRules($type) ,$this->_ValidationMessage() );

        return $validator->messages()->toArray();
    }

    /**
     * Get Max Local Container Number
     * @param $inputs
     * @param $type
     * @return array
     */
    public function GetMaxContainer($inputs ,$type )
    {
        $errors = $this->Validate($inputs ,$type);

        if (!$errors){

            $lastyear = Carbon::createFromFormat('d/m/Y', $inputs['ContainerOpenDate'])->format('Y') - 1 ;

            $max = $this->where(['SupplierID' => $inputs['SupplierID']])
                      ->whereRaw("ContainerOpenDate between '$lastyear-01-01' and '$lastyear-12-31'" )
                      ->max('ContainerLocalNum');

            $output = ['status' => true , 'data'=>['max' => $max  ,'year' => $lastyear] ,'code' => Response::HTTP_ACCEPTED];
        }else{
            $output = ['status' => false , 'message' => $errors ,'code' => Response::HTTP_BAD_REQUEST];
        }
        return $output;
    }

    /**
     * return Container End Date
     * @return static
     */
    public function getContainerEndDateAttribute(){
        if ($this->attributes['ContainerEndDate']){
            return Carbon::parse($this->attributes['ContainerEndDate'])->format('d/m/Y');
        }else{
            return null;
        }
    }

    /**
     * return Container Open Date
     * @return static
     */
    public function getContainerOpenDateAttribute()
    {
        return Carbon::parse($this->attributes['ContainerOpenDate'])->format('d/m/Y');
//    $open  =   Carbon::parse($this->attributes['ContainerOpenDate'])->format('d/m/Y');
//    $end  =   Carbon::parse($this->attributes['ContainerEndDate'])->format('d/m/Y');
//        
//        if ($end < $open)
//        {
//         return error;
//        }
    }
    /**
     * Container Has Many Sales Details Products
     * use array map to split Created_at and updated_at
     * */
    public function SalesDetails()
    {
        return $this->hasMany('App\Http\Models\SalesDetails' , 'ContainerID');
    }

    /**
     * Check If Container ANd Supplier Is Already Exist or no
     * to check If Supplier Is wkala 5argia Or No
     * @param $SupplierID
     * @param $ContainerID
     * @return mixed
     */
    public function IsSupplierAndContainerExist($SupplierID, $ContainerID){
        return $this->where([
            'SupplierID' => $SupplierID ,
            'ContainerID' => $ContainerID ,
        ])->get()->count();
        
    }

}
