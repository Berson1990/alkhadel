<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class CustomersDiscount extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblCustomersDiscount';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['TransDate', 'Mount', 'CustomerID', 'Notes'];

    protected $primaryKey = 'TransID';

    /** ---------------------------------------------------------------------
     * CustomersDiscount Customers Belong to Customers
     * return @relationship
     * */
    
    public function Customers()
    {

        return $this->belongsTo('App\Http\Models\Customers' ,'CustomerID')->select();
    }

    /*==========================================================================*/

    /* Validate Banks after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'TransDate.required' => trans('customersdiscount.required_transdate') ,
            'TransDate.date_format' => trans('customersdiscount.required_transdate'),
            'Mount.required' => trans('customersdiscount.required_mount') ,
            'Mount.numeric' => trans('customersdiscount.required_mount_max_min'),
            'Mount.between' => trans('customersdiscount.required_mount_max_min'),
            'CustomerID.required' => trans('customersdiscount.required_customerid'),
//            'Notes.required' => trans('customersdiscount.required_notes') ,
//            'Notes.min' => trans('customersdiscount.required_notes_max_min'),
//            'Notes.max' => trans('customersdiscount.required_notes_max_min'),
        );
        $rules =  array(
            'TransDate' => 'required|date_format:"Y/m/d"' ,
            'Mount' => 'required|numeric|between:0.1,1000000' ,
            'CustomerID' => 'required' ,
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
