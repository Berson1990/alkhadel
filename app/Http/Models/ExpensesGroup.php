<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class ExpensesGroup extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table ='tblExpensesGroup';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable =['ExpensesGroupName'];

    protected $primaryKey = 'ExpensesGroupID';

    /** ---------------------------------------------------------------------
     * expensestypes id Belong to expensestypes
     * expensestypes id Belong to expensestypes
     * return @relationship
     * */
    


    /*==========================================================================*/

    /* Validate Banks after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

//        dd($inputs);
        
        $message = array(
            'ExpensesGroupName.required' => trans('expensesgroup.required_expensegroupname') ,
            'ExpensesGroupName.min' => trans('expensesgroup.required_expensegroupname_max_min'),
            'ExpensesGroupName.max' => trans('expensesgroup.required_expensegroupname_max_min'),
//            'ExpenseTypeID.required' => trans('expensesgroup.required_expensetypeid'),
        );
        $rules =  array(
            'ExpensesGroupName' => 'required|min:3|max:45' ,
//            'ExpenseTypeID' => 'required' ,
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
     * @param $ExpensesgroupID
     * @return mixed
     */
    public function isExist($inputs ,$ExpensesGroupID)
    {
        // dd($inputs);
       // dd($ExpensesGroupID);
        if ($ExpensesGroupID == 0)
        {
            return $this->whereRaw('ExpensesGroupName = ?' , [ $inputs['ExpensesGroupName'] ])->count() ;
        }
        else
        {
         return $this->whereRaw('ExpensesGroupName = ? and ExpensesGroupID <> ?' , [ $inputs['ExpensesGroupName'] , $ExpensesGroupID ])->count() ; 
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
?>