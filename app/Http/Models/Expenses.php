<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class Expenses extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblExpenses';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['TransDate', 'Mount', 'ExpensesGroupID','ExpenseTypeID','CashierID', 'Notes'];

    protected $primaryKey = 'TransID';

    /** ---------------------------------------------------------------------
     * Expenses ExpensesTypes Belong to ExpensesTypes
     * return @relationship
     * */
	 // some problem mybe exist
      public function Cashiers()
    {
        return $this->belongsTo('App\Http\Models\Cashiers' ,'CashierID')->select();
    } 
	
    public function ExpensesGroup()
    {
        return $this->belongsTo('App\Http\Models\ExpensesGroup' ,'ExpensesGroupID')->select();
    } 
	public function ExpensesTypes()
    {
        return $this->belongsTo('App\Http\Models\ExpensesTypes' ,'ExpenseTypeID')->select();
    }

    /*==========================================================================*/

    /* Validate Banks after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'TransDate.required' => trans('expenses.required_transdate') ,
            'TransDate.date_format' => trans('expenses.required_transdate'),
            'Mount.required' => trans('expenses.required_mount') ,
            'Mount.numeric' => trans('expenses.required_mount_max_min'),
            'Mount.between' => trans('expenses.required_mount_max_min'),
            'ExpensesGroupID.required' => trans('expenses.required_expensegroupid'),
//            'ExpenseTypeID.required' => trans('expenses.required_expensetypeid'),
            'CashierID.required' => trans('expenses.required_cashierid'),
//            'Notes.required' => trans('expenses.required_notes') ,
//            'Notes.min' => trans('expenses.required_notes_max_min'),
//            'Notes.max' => trans('expenses.required_notes_max_min'),
        );
        $rules =  array(
            'TransDate' => 'required|date_format:"Y/m/d"' ,
            'Mount' => 'required|numeric|between:0.1,1000000',
            'ExpensesGroupID' => 'required',
//            'ExpenseTypeID' => 'required',
            'CashierID' => 'required',
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
