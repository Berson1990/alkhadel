<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class Users extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblUsers';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['UserName', 'Password', 'EmployeeID'];

    protected $primaryKey = 'UserID';


    /* Validate Users after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'UserName.required' => 'User Name Is Required Cannot Be Set Empty' ,
            'UserName.min' => 'User Name Character Must Between 3 to 45 Char',
            'Password.required' => 'Password Is Required Cannot Be Set Empty' ,
            'Password.min' => 'Password Character Must Between 3 to 45 Char',
            'EmployeeID.required' => 'Please Select Employee',
        );
        $rules =  array(
            'UserName' => 'required|min:3|max:45' ,
            'Password' => 'required|min:3|max:45' ,
            'EmployeeID' => 'required|integer'
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
     * @param $UserName
     * @return mixed
     */
    public function isExist($inputs){
        return $this->whereRaw('UserName = ?' , [ $inputs['UserName'] ])->count() ;
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
