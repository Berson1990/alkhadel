<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class CashPayments extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblCashPayments';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
    protected $fillable = ['TransDate', 'SupplierID', 'Mount' , 'CashierID' ,'Notes'];
	// protected $fillable = ['TransDate', 'SupplierID', 'Mount' , 'CashierID' , 'BankID' , 'Notes'];

    protected $primaryKey = 'TransID';

    /** ---------------------------------------------------------------------
     * CashPayments CashPaymentsTypes Belong to CashPaymentsTypes
     * return @relationship
     * */

    public function Suppliers()
    {
        return $this->belongsTo('App\Http\Models\Suppliers' ,'SupplierID')->select();
    }

    public function Cashiers()
    {
        return $this->belongsTo('App\Http\Models\Cashiers' ,'CashierID')->select();
    }

    // public function Banks()
    // {
    //     return $this->belongsTo('App\Http\Models\Banks' ,'BankID')->select();
    // }

    /*==========================================================================*/

    /* Validate Banks after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'TransDate.required' => trans('cashpayments.required_transdate') ,
            'TransDate.date_format' => trans('cashpayments.required_transdate'),
            'SupplierID.required' => trans('cashpayments.required_supplierid'),
            'Mount.required' => trans('cashpayments.required_mount') ,
            'Mount.numeric' => trans('cashpayments.required_mount_max_min'),
            'Mount.between' => trans('cashpayments.required_mount_max_min'),
            'CashierID.required' => trans('cashpayments.required_cashierid'),
            // 'BankID.required' => trans('cashpayments.required_bankid'),
//            'Notes.required' => trans('cashpayments.required_notes') ,
//            'Notes.min' => trans('cashpayments.required_notes_max_min'),
//            'Notes.max' => trans('cashpayments.required_notes_max_min'),
        );
        $rules =  array(
            'TransDate' => 'required|date_format:"Y/m/d"' ,
            'SupplierID' => 'required' ,
            'Mount' => 'required|numeric|between:0.1,1000000' ,
            'CashierID' => 'required' ,
            // 'BankID' => 'required' ,
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
