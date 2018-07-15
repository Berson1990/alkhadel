<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class SettlementSuppliersAccount extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblSettlementSuppliersAccount';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
    protected $fillable = ['TransDate', 'SupplierID', 'Mount', 'CashierID' ,'Dept','Notes'];

    protected $primaryKey = 'TransID';

    /** ---------------------------------------------------------------------
     * CustomerOpeningBalance Customers Belong to Customers
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

    /*==========================================================================*/

    /* Validate Banks after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'TransDate.required' => trans('settlementsuppliersaccount.required_transdate') ,
            'TransDate.date_format' => trans('settlementsuppliersaccount.required_transdate'),
            'Mount.required' => trans('settlementsuppliersaccount.required_mount') ,
            'Mount.numeric' => trans('settlementsuppliersaccount.required_mount_max_min'),
            'Mount.between' => trans('settlementsuppliersaccount.required_mount_max_min'),
            'SupplierID.required' => trans('settlementsuppliersaccount.required_supplierid'),
            'CashierID.required' => trans('settlementsuppliersaccount.required_cashierid'),
            'Dept.required' => trans('settlementsuppliersaccount.required_dept'),
//            'Notes.required' => trans('customeropeningbalance.required_notes') ,
//            'Notes.min' => trans('customeropeningbalance.required_notes_max_min'),
//            'Notes.max' => trans('customeropeningbalance.required_notes_max_min'),
        );
        $rules =  array(
            'TransDate' => 'required|date_format:"Y/m/d"' ,
            'Mount' => 'required|numeric|between:0.1,1000000' ,
            'SupplierID' => 'required' ,
            'CashierID' => 'required' ,
            'Dept' => 'required' ,
//          'Notes' => 'required|min:3|max:45' ,
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
