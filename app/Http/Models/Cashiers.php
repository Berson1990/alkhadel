<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class Cashiers extends Model{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tblCashiers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['CashierName', 'CashierAccountID'];

    protected $primaryKey = 'CashierID';

    /**-----------------------------------------------------------
     * Sales Has Many Banks
     * */

    // public function Banks()
    // {
    //     $this->hasMany('App\Http\Models\Banks' , 'BankID');
    // }

    /*=============================================================*/

    /* Validate Cashiers after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'CashierName.required' => trans('cashiers.required_cashiername') ,
            'CashierName.min' => trans('cashiers.required_cashier_max_min'),
            'CashierName.max' => trans('cashiers.required_cashier_max_min'),
        );
        $rules =  array(
            'CashierName' => 'required|min:3|max:45' ,
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
     * @param $CashierName
     * @return mixed
     */
    public function isExist($inputs , $CashierID){
        if ($CashierID == 0)
        {
            return $this->whereRaw('CashierName = ?' , [ $inputs['CashierName'] ])->count() ;
        }
        else
        {
           return $this->whereRaw('CashierName = ? and CashierID <> ?' , [ $inputs['CashierName'] , $CashierID ])->count() ; 
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
