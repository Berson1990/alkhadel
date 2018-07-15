<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class BankCashDeposit extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblbankcashdeposit';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['TransDate', 'CustomerID', 'BankID', 'Mount', 'Notes'];

    protected $primaryKey = 'TransID';

    /** ---------------------------------------------------------------------
     * CashDeposit CashDepositTypes Belong to CashDepositTypes
     * return @relationship
     * */
    
    public function Customers()
    {
        return $this->belongsTo('App\Http\Models\Customers' ,'CustomerID')->select();
    }


    public function Banks()
    {
        return $this->belongsTo('App\Http\Models\Banks' ,'BankID')->select();
    }

    /*==========================================================================*/

    /* Validate Banks after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'TransDate.required' => trans('cashdeposit.required_transdate') ,
            'TransDate.date_format' => trans('cashdeposit.required_transdate'),
            'CustomerID.required' => trans('cashdeposit.required_customerid'),
            'BankID.required' => trans('cashdeposit.required_bankid'),
            'Mount.required' => trans('cashdeposit.required_mount') ,
            'Mount.numeric' => trans('cashdeposit.required_mount_max_min'),
            'Mount.between' => trans('cashdeposit.required_mount_max_min'),
//            'Notes.required' => trans('cashdeposit.required_notes') ,
//            'Notes.min' => trans('cashdeposit.required_notes_max_min'),
//            'Notes.max' => trans('cashdeposit.required_notes_max_min'),
        );
        $rules =  array(
            'TransDate' => 'required|date_format:"Y/m/d"' ,
            'CustomerID' => 'required' ,
            'BankID' => 'required' ,
            'Mount' => 'required|numeric|between:0.1,1000000' ,
//            'Notes' => 'required|min:3|max:45' ,
        );
        $validator = Validator::make(
            $inputs ,
            $rules ,
            $message
        );
        return $validator;
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
