<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class CustomerRefund extends Model{
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 
  protected $table ="tblCustomerRefund";


protected $fillable =['RefundDate', 'Refund', 'CustomerID','CashierID', 'Notes'];
	 
	 protected $primaryKey ='RefundID';

 /** ---------------------------------------------------------------------
     * CustomerRefund Customers Belong to Customers
     * return @relationship
     * */
	
    public function Customers()
    {
        return $this->belongsTo('App\Http\Models\Customers' ,'CustomerID')->select();
    }
    	 public function Cashiers()
    {
        return $this->belongsTo('App\Http\Models\Cashiers' ,'CashierID')->select();
    }


	 
   /*==========================================================================*/

    /* Validate CustomerRefund after insert or Update
     * @param $inputs
     * @return mixed
     */

 public function validate ($inputs) {
	
	 $message = array (
	 // we make some change here :)
	        'RefundDate.required' => trans('customerrefund.required_refunddate') ,//change from trans date to refund date
            'RefundDate.date_format' => trans('customerrefund.required_refunddate'),//change from trans date to refund date 
            'Refund.required' => trans('customerrefund.required_refund') ,//change from mount to refund
            'Refund.numeric' => trans('customerrefund.required_refund_max_min'),//change from mount to refund
            'Refund.between' => trans('customerrefund.required_refund_max_min'),//change from mound to refund
            'CustomerID.required' => trans('customerrefund.required_customerid'),
              'CashierID.required' => trans('customerrefund.required_cashierid'),
//            'Notes.required' => trans('customerrefund.required_notes') ,
//            'Notes.min' => trans('customerrefund.required_notes_max_min'),
//            'Notes.max' => trans('customerrefund.required_notes_max_min'),
	 );
	// end of array message 
	 
	 $rules=array(
	 
	 'RefundDate' => 'required|date_format:"Y/m/d"' ,//change from trans date to refund date 
      'Refund' => 'required|numeric|between:0.1,1000000' ,// change from mount to Refund 
      'CustomerID' => 'required' ,
       'CashierID' => 'required' ,
//       'Notes' => 'required|min:3|max:45' ,
	  );// end of rules 
	    $validator = validator::make (
		 $inputs,
		 $message,
		 $rules
		);
		return $validator;
	
   }// end of function validate 

    /**
     * Check if already exist in database befor update
     * @param $id
     * @return mixed
     */
	 
	 public function isExistById($id) {
         return $this->find($id)->count();
	
	 }//end of  check exist
	
	
	




}// end of class
 ?>