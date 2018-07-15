<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class CashierTransfer extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblCashierTransfer';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['TransDate', 'FromCashierID', 'ToCashierID', 'Mount', 'Notes'];

    protected $primaryKey = 'TransID';

    /** ---------------------------------------------------------------------
     * CashierTransfer CashierTransferTypes Belong to CashierTransferTypes
     * return @relationship
     * */
    
    public function FromCashiers()
    {
        return $this->belongsTo('App\Http\Models\Cashiers' ,'FromCashierID')->select();
    }

    public function ToCashiers()
    {
        return $this->belongsTo('App\Http\Models\Cashiers' ,'ToCashierID')->select();
    }

    /*==========================================================================*/

    /* Validate Banks after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'TransDate.required' => trans('cashiertransfer.required_transdate') ,
            'TransDate.date_format' => trans('cashiertransfer.required_transdate'),
            'FromCashierID.required' => trans('cashiertransfer.required_fromcashierid'),
            'ToCashierID.required' => trans('cashiertransfer.required_tocashierid'),
            'Mount.required' => trans('cashiertransfer.required_mount') ,
            'Mount.numeric' => trans('cashiertransfer.required_mount_max_min'),
            'Mount.between' => trans('cashiertransfer.required_mount_max_min'),
            'Notes.required' => trans('cashiertransfer.required_notes') ,
            'Notes.min' => trans('cashiertransfer.required_notes_max_min'),
            'Notes.max' => trans('cashiertransfer.required_notes_max_min'),
            'SameChshier' => trans('cashiertransfer.required_samechshier'),
        );
        $rules =  array(
            'TransDate' => 'required|date_format:"Y/m/d"' ,
            'FromCashierID' => 'required' ,
            'ToCashierID' => 'required' ,
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
