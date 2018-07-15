<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class Currencies extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblCurrencies';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['CurrencyName', 'CurrencySymbol'];

    protected $primaryKey = 'CurrencyID';

      public function Banks()
    {
        $this->hasMany('App\Http\Models\Banks' , 'CurrencyID');
    }


    /* Validate Currencys after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'CurrencyName.required' => trans('currencies.required_currencyname') ,
            'CurrencyName.min' => trans('currencies.required_currency_max_min'),
            'CurrencyName.max' => trans('currencies.required_currency_max_min'),
            'CurrencySymbol.required' => trans('currencies.required_currencysymbol') ,
            'CurrencySymbol.min' => trans('currencies.required_currency_symbol_max_min'),
            'CurrencySymbol.max' => trans('currencies.required_currency_symbol_max_min'),
        );
        $rules =  array(
            'CurrencyName' => 'required|min:3|max:45' ,
            'CurrencySymbol' => 'required|min:1|max:3' 
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
     * @param $CurrencyName
     * @return mixed
     */
    public function isExist($inputs , $CurrencyID){
        if ($CurrencyID == 0)
        {
            return $this->whereRaw('CurrencyName = ?' , [ $inputs['CurrencyName'] ])->count() ;
        }
        else
        {
           return $this->whereRaw('CurrencyName = ? and CurrencyID <> ?' , [ $inputs['CurrencyName'] , $CurrencyID ])->count() ; 
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
