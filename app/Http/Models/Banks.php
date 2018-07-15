<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class Banks extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblbanks';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['BankName', 'AccountNumber', 'CurrencyID'];

    protected $primaryKey = 'BankID';

    /** ---------------------------------------------------------------------
     * Banks Currencies Belong to Currencies
     * return @relationship
     * */
    
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
            'BankName.required' => trans('banks.required_bankname') ,
            'BankName.min' => trans('banks.required_bank_max_min'),
            'BankName.max' => trans('banks.required_bank_max_min'),
            'AccountNumber.required' => trans('banks.required_accountnumber'),
            'AccountNumber.min' => trans('banks.required_accountnumber_max_min'),
            'AccountNumber.max' => trans('banks.required_accountnumber_max_min'),
            'CurrencyID.required' => trans('banks.required_currencyid'),
        );                                        
        $rules =  array(
            'BankName' => 'required|min:3|max:45' ,
            'AccountNumber' => 'required|min:3|max:45',
            'CurrencyID' => 'required',
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
     * @param $BankName
     * @return mixed
     */
    public function isExist($inputs ,$BankID)
    {
        // dd($inputs);
        if ($BankID == 0)
        {
            return $this->whereRaw('BankName = ?' , [ $inputs['BankName'] ])->count() ;
        }
        else
        {
           return $this->whereRaw('BankName = ? and BankID <> ?' , [ $inputs['BankName'] , $BankID ])->count() ; 
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
