<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class Customers extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblCustomers';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['CustomerName', 'CustomerType', 'CustomerAccountID'];

    protected $primaryKey = 'CustomerID';


    /* Validate Customers after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'CustomerName.required' => trans('customers.required_customername') ,
            'CustomerName.min' => trans('customers.required_customer_max_min'),
            'CustomerName.max' => trans('customers.required_customer_max_min'),
            'CustomerType.required' => trans('customers.required_customertype'),
//            'CustomerID.deleted' => trans('customers.delete'),
        );
        $rules =  array(
            'CustomerName' => 'required|min:3|max:45' ,
            'CustomerType' => 'required|max:2|integer'
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
     * @param $CustomerName
     * @param $CustomerType
     * @return mixed
     */
    public function isExist($inputs , $CustomerID){
        if ($CustomerID == 0)
        {
            return $this->whereRaw('CustomerName = ? ' , [ $inputs['CustomerName'] ])->count() ;
        }
        else
        {
           return $this->whereRaw('CustomerName = ? and CustomerID <> ?' , [ $inputs['CustomerName'],   $CustomerID ])->count() ; 
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
