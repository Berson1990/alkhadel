<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class BankCashierTransfer extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblbankcashiertransfer';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['TransDate', 'BankID', 'CashierID', 'Mount', 'Notes'];

    protected $primaryKey = 'TransID';

    /** ---------------------------------------------------------------------
     * BankCashierTransfer BankCashierTransferTypes Belong to BankCashierTransferTypes
     * return @relationship
     * */
    
    public function Banks()
    {
        return $this->belongsTo('App\Http\Models\Banks' ,'BankID')->select();
    }

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
            'TransDate.required' => trans('bankcashiertransfer.required_transdate') ,
            'TransDate.date_format' => trans('bankcashiertransfer.required_transdate'),
            'BankID.required' => trans('bankcashiertransfer.required_bankid'),
            'CashierID.required' => trans('bankcashiertransfer.required_cashierid'),
            'Mount.required' => trans('bankcashiertransfer.required_mount') ,
            'Mount.numeric' => trans('bankcashiertransfer.required_mount_max_min'),
            'Mount.between' => trans('bankcashiertransfer.required_mount_max_min'),
            'Notes.required' => trans('bankcashiertransfer.required_notes') ,
            'Notes.min' => trans('bankcashiertransfer.required_notes_max_min'),
            'Notes.max' => trans('bankcashiertransfer.required_notes_max_min'),
        );
        $rules =  array(
            'TransDate' => 'required|date_format:"Y/m/d"' ,
            'BankID' => 'required' ,
            'CashierID' => 'required' ,
            'Mount' => 'required|numeric|between:0.1,1000000' ,
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
