<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class SupplierOpeningBalance extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblSupplierOpeningBalance';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['TransDate', 'Mount', 'SupplierID', 'Notes' ,'Debt'];

    protected $primaryKey = 'TransID';

    /** ---------------------------------------------------------------------
     * SupplierOpeningBalance Suppliers Belong to Suppliers
     * return @relationship
     * */
    
    public function Suppliers()
    {
        return $this->belongsTo('App\Http\Models\Suppliers' ,'SupplierID')->select();
    }

    /*==========================================================================*/

    /* Validate Banks after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'TransDate.required' => trans('supplieropeningbalance.required_transdate') ,
            'TransDate.date_format' => trans('supplieropeningbalance.required_transdate'),
            'Mount.required' => trans('supplieropeningbalance.required_mount') ,
            'Mount.numeric' => trans('supplieropeningbalance.required_mount_max_min'),
            'Mount.between' => trans('supplieropeningbalance.required_mount_max_min'),
            'SupplierID.required' => trans('supplieropeningbalance.required_supplierid'),

            'Debt.required' => trans('supplieropeningbalance.required_debt'),
//            'Notes.required' => trans('supplieropeningbalance.required_notes') ,
//            'Notes.min' => trans('supplieropeningbalance.required_notes_max_min'),
//            'Notes.max' => trans('supplieropeningbalance.required_notes_max_min'),
        );
        $rules =  array(
            'TransDate' => 'required|date_format:"Y/m/d"' ,
            'Mount' => 'required|numeric|between:0.1,1000000' ,
            'SupplierID' => 'required' ,
            'Debt' => 'required' ,
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
