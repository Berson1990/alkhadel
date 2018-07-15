<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class CashierOpeningBalance extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblCashierOpeningBalance';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['TransDate', 'Mount', 'CashierID', 'Notes'];

    protected $primaryKey = 'TransID';

    /** ---------------------------------------------------------------------
     * CashierOpeningBalance Customers Belong to Customers
     * return @relationship
     * */
    
    public function Cashiers()
    {
        return $this->belongsTo('App\Http\Models\Cashiers' ,'CashierID')->select();
    }

    /*==========================================================================*/

    /* Validate Banks after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'TransDate.required' => trans('cashieropeningbalance.required_transdate') ,
            'TransDate.date_format' => trans('cashieropeningbalance.required_transdate'),
            'Mount.required' => trans('cashieropeningbalance.required_mount') ,
            'Mount.numeric' => trans('cashieropeningbalance.required_mount_max_min'),
            'Mount.between' => trans('cashieropeningbalance.required_mount_max_min'),
            'CashierID.required' => trans('cashieropeningbalance.required_cashierid'),
//            'Notes.required' => trans('cashieropeningbalance.required_notes') ,
//            'Notes.min' => trans('cashieropeningbalance.required_notes_max_min'),
//            'Notes.max' => trans('cashieropeningbalance.required_notes_max_min'),
        );
        $rules =  array(
            'TransDate' => 'required|date_format:"Y/m/d"' ,
            'Mount' => 'required|numeric|between:0.1,1000000' ,
            'CashierID' => 'required' ,
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
