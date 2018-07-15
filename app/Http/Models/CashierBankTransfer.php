<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class CashierBankTransfer extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblCashierBankTransfer';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['TransDate', 'Mount', 'CashierID', 'BankID', 'Notes'];

    protected $primaryKey = 'TransID';

    /** ---------------------------------------------------------------------
     * CashierBankTransfer CashierBankTransferTypes Belong to CashierBankTransferTypes
     * return @relationship
     * */
    
    public function Cashiers()
    {
        return $this->belongsTo('App\Http\Models\Cashiers' ,'CashierID')->select();
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
            'TransDate.required' => trans('cashierbanktransfer.required_transdate') ,
            'TransDate.date_format' => trans('cashierbanktransfer.required_transdate'),
            'Mount.required' => trans('cashierbanktransfer.required_mount') ,
            'Mount.numeric' => trans('cashierbanktransfer.required_mount_max_min'),
            'Mount.between' => trans('cashierbanktransfer.required_mount_max_min'),
            'CashierID.required' => trans('cashierbanktransfer.required_cashierid'),
            'BankID.required' => trans('cashierbanktransfer.required_bankid'),
            'Notes.required' => trans('cashierbanktransfer.required_notes') ,
            'Notes.min' => trans('cashierbanktransfer.required_notes_max_min'),
            'Notes.max' => trans('cashierbanktransfer.required_notes_max_min'),
        );
        $rules =  array(
            'TransDate' => 'required|date_format:"Y/m/d"' ,
            'Mount' => 'required|numeric|between:0.1,1000000' ,
            'BankID' => 'required' ,
            'CashierID' => 'required' ,
            'Notes' => 'required|min:3|max:45' ,
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
