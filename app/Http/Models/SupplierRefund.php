<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class SupplierRefund extends Model{
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 
  protected $table ="tblSupplierRefund";


protected $fillable =['RefundDate', 'Refund', 'SupplierID','CashierID', 'Notes'];
	 
	 protected $primaryKey ='RefundID';

 /** ---------------------------------------------------------------------
     * SupplierRefund Suppliers Belong to Suppliers
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

    /* Validate SupplierRefund after insert or Update
     * @param $inputs
     * @return mixed
     */

 public function validate ($inputs) {
	
	 $message = array (
	 // we make some change here :)
	        'RefundDate.required' => trans('supplierrefund.required_refunddate') ,//change from trans date to refund date
            'RefundDate.date_format' => trans('supplierrefund.required_refunddate'),//change from trans date to refund date 
            'Refund.required' => trans('supplierrefund.required_refund') ,//change from mount to refund
            'Refund.numeric' => trans('supplierrefund.required_refund_max_min'),//change from mount to refund
            'Refund.between' => trans('supplierrefund.required_refund_max_min'),//change from mound to refund
            'SupplierID.required' => trans('supplierrefund.required_supplierid'),
            'CashierID.required' => trans('supplierrefund.required_cashierid'),
//            'Notes.required' => trans('supplierrefund.required_notes') ,
//            'Notes.min' => trans('supplierrefund.required_notes_max_min'),
//            'Notes.max' => trans('supplierrefund.required_notes_max_min'),
	 );
	// end of array message 
	 
	 $rules=array(
	 
	 'RefundDate' => 'required|date_format:"Y/m/d"' ,//change from trans date to refund date 
      'Refund' => 'required|numeric|between:0.1,1000000' ,// change from mount to Refund 
      'SupplierID' => 'required' ,
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