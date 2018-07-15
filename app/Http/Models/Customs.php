<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class Customs extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblCustoms';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['CustomName', 'CustomAccountID'];

    protected $primaryKey = 'CustomID';


    /* Validate Customs after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'CustomName.required' => trans('customs.required_customname') ,
            'CustomName.min' => trans('customs.required_custom_max_min'),
            'CustomName.max' => trans('customs.required_custom_max_min'),
        );
        $rules =  array(
            'CustomName' => 'required|min:3|max:45' 
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
     * @param $CustomName
     * @return mixed
     */
    public function isExist($inputs , $CustomID){
        if ($CustomID == 0)
        {
            return $this->whereRaw('CustomName = ?' , [ $inputs['CustomName'] ])->count() ;
        }
        else
        {
           return $this->whereRaw('CustomName = ? and CustomID <> ?' , [ $inputs['CustomName'] , $CustomID ])->count() ; 
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
