<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class BankOpeningBalance extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblbankopeningbalance';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['TransDate', 'BankID', 'AccountNumber' , 'Mount', 'CurrencyID' , 'Notes'];

    protected $primaryKey = 'TransID';

    /** ---------------------------------------------------------------------
     * BankOpeningBalance BankOpeningBalanceTypes Belong to BankOpeningBalanceTypes
     * return @relationship
     * */
    
    public function Banks()
    {
        return $this->belongsTo('App\Http\Models\Banks' ,'BankID')->select();
    }

    public function Currencies()
    {
        return $this->belongsTo('App\Http\Models\Currencies' ,'CurrencyID')->select();
    }

    /*==========================================================================*/

    /* Validate Banks after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'TransDate.required' => trans('bankopeningbalance.required_transdate') ,
            'TransDate.date_format' => trans('bankopeningbalance.required_transdate'),
            'BankID.required' => trans('bankopeningbalance.required_bankid'),
            'AccountNumber.required' => trans('bankopeningbalance.required_accountnumber') ,
            'AccountNumber.min' => trans('bankopeningbalance.required_accountnumber_max_min'),
            'AccountNumber.max' => trans('bankopeningbalance.required_accountnumber_max_min'),
            'Mount.required' => trans('bankopeningbalance.required_mount') ,
            'Mount.numeric' => trans('bankopeningbalance.required_mount_max_min'),
            'Mount.between' => trans('bankopeningbalance.required_mount_max_min'),
            'CurrencyID.required' => trans('bankopeningbalance.required_currencyid'),
            'Notes.required' => trans('bankopeningbalance.required_notes') ,
            'Notes.min' => trans('bankopeningbalance.required_notes_max_min'),
            'Notes.max' => trans('bankopeningbalance.required_notes_max_min'),
        );
        $rules =  array(
            'TransDate' => 'required|date_format:"Y/m/d"' ,
            'BankID' => 'required' ,
            'AccountNumber' => 'required|min:3|max:45' ,
            'Mount' => 'required|numeric|between:0.1,1000000' ,
            'CurrencyID' => 'required' ,
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
