<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class Drivers extends Model{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tblDrivers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['DriverName'];

    protected $primaryKey = 'DriverID';


    /* Validate Drivers after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'DriverName.required' => trans('drivers.required_drivername') ,
            'DriverName.min' => trans('drivers.required_driver_max_min'),
            'DriverName.max' => trans('drivers.required_driver_max_min'),
        );
        $rules =  array(
            'DriverName' => 'required|min:3|max:45'
        );
        $validator = Validator::make(
            $inputs ,
            $rules ,
            $message
        );
        return $validator;
    }
    /**
     * Check if already exist in database
     * @param $DriverName
     * @return mixed
     */
    public function isExist($inputs, $DriverID){
        if ($DriverID == 0)
        {
            return $this->whereRaw('DriverName = ?' , [ $inputs['DriverName'] ])->count() ;
        }
        else
        {
            return $this->whereRaw('DriverName = ? and DriverID <> ?' , [ $inputs['DriverName'] , $DriverID ])->count() ;
        }
    }

    /**
     * Check if already exist in database befor update
     * @param $id
     * @return mixed
     */
    public function isExistById($id){
        return $this->find($id)->count() ;
    }

}
