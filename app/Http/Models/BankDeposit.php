<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class BankDeposit extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblbankdeposit';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['TransDate', 'CustomerID', 'BankID', 'Mount', 'Notes'];

    protected $primaryKey = 'TransID';

    /** ---------------------------------------------------------------------
     * CheckDeposit CheckDepositTypes Belong to CheckDepositTypes
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
            'TransDate.required' => trans('checkdeposit.required_transdate') ,
            'TransDate.date_format' => trans('checkdeposit.required_transdate'),
            'CustomerID.required' => trans('checkdeposit.required_customerid'),
            'BankID.required' => trans('checkdeposit.required_bankid'),
//            'CheckNo.required' => trans('checkdeposit.required_checkNo') ,
//            'CheckNo.min' => trans('checkdeposit.required_checkno_max_min'),
//            'CheckNo.max' => trans('checkdeposit.required_checkno_max_min'),
//            'CheckDate.required' => trans('checkdeposit.required_checkdate') ,
//            'CheckDate.date_format' => trans('checkdeposit.required_checkdate'),
//            'Notes.required' => trans('checkdeposit.required_notes') ,
//            'Notes.min' => trans('checkdeposit.required_notes_max_min'),
//            'Notes.max' => trans('checkdeposit.required_notes_max_min'),
        );
        $rules =  array(
            'TransDate' => 'required|date_format:"Y/m/d"' ,
            'CustomerID' => 'required' ,
            'BankID' => 'required' ,
//            'CheckNo' => 'required|min:3|max:45' ,
//            'CheckDate' => 'required|date_format:"Y/m/d"' ,
//            'Notes' => 'required|min:3|max:45' ,
        );
        $validator = Validator::make(
            $inputs ,
            $rules ,
            $message
        );
        return $validator;
    }

    // /**
    //  * Check if already exist in database
    //  * @param $BankName
    //  * @return mixed
    //  */
    // public function isExist($inputs ,$BankID)
    // {
    //     // dd($inputs);
    //     if ($BankID == 0)
    //     {
    //         return $this->whereRaw('BankName = ?' , [ $inputs['BankName'] ])->count() ;
    //     }
    //     else
    //     {
    //        return $this->whereRaw('BankName = ? and BankID <> ?' , [ $inputs['BankName'] , $BankID ])->count() ; 
    //     }
        
    // }

    /**
     * Check if already exist in database befor update
     * @param $id
     * @return mixed
     */
    public function isExistById($id){
        return $this->find($id)->count() ;
    }

}
