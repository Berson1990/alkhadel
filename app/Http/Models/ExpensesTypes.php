<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class ExpensesTypes extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblExpensesTypes';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['ExpenseTypeName','ExpensesGroupID'];

    protected $primaryKey = 'ExpenseTypeID';
    				
    public function ExpensesGroup()
    {
        return $this->belongsTo('App\Http\Models\ExpensesGroup' ,'ExpensesGroupID')->select();
    } 

    /* Validate ExpensesTypes after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'ExpenseTypeName.required' => trans('expensestypes.required_expensetypename') ,
            'ExpenseTypeName.min' => trans('expensestypes.required_expensetypename_max_min'),
            'ExpenseTypeName.max' => trans('expensestypes.required_expensetypename_max_min'),
			'ExpensesGroupID.required'=>trans('expensestypes.required_expensegroupid'),
        );
        $rules =  array(
            'ExpenseTypeName' => 'required|min:3|max:45',
			 'ExpensesGroupID' => 'required',

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
     * @param $ExpenseTypeName
     * @return mixed
     */
    public function isExist($inputs, $ExpenseTypeID){
        if ($ExpenseTypeID == 0)
        {
            return $this->whereRaw('ExpenseTypeName = ?' , [ $inputs['ExpenseTypeName'] ])->count() ;
        }
        else
        {
           return $this->whereRaw('ExpenseTypeName = ? and ExpenseTypeID <> ?' , [ $inputs['ExpenseTypeName'] , $ExpenseTypeID ])->count() ; 
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
