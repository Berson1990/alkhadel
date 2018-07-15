<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class Employees extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblEmployees';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['EmployeeName'];

    protected $primaryKey = 'EmployeeID';


    /* Validate Employees after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'EmployeeName.required' => trans('employees.required_employeename') ,
            'EmployeeName.min' => trans('employees.required_employee_max_min'),
            'EmployeeName.max' => trans('employees.required_employee_max_min'),
        );
        $rules =  array(
            'EmployeeName' => 'required|min:3|max:45' 
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
     * @param $EmployeeName
     * @return mixed
     */
    public function isExist($inputs, $EmployeeID){
        //dd($EmployeeID);
        if ($EmployeeID == 0)
        {
            return $this->whereRaw('EmployeeName = ?' , [ $inputs['EmployeeName'] ])->count() ;
        }
        else
        {
           return $this->whereRaw('EmployeeName = ? and EmployeeID <> ?' , [ $inputs['EmployeeName'] , $EmployeeID ])->count() ; 
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
