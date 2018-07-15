<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class CustomePayment extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblCustomesPayment';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['TransDate', 'CashierID', 'Mount', 'CustomID', 'Notes'];

	protected $primaryKey = 'TransID';

	/** ---------------------------------------------------------------------
	 * CustomerOpeningBalance Customers Belong to Customers
	 * return @relationship
	 * */

	public function Customs() {
		return $this->belongsTo('App\Http\Models\Customs', 'CustomID')->select();
	}

	public function Cashiers() {
		return $this->belongsTo('App\Http\Models\Cashiers', 'CashierID')->select();
	}

	/*==========================================================================*/

	/* Validate Banks after insert or Update
		     * @param $inputs
		     * @return mixed
	*/
	public function validate($inputs) {

		$message = array(
			'TransDate.required' => trans('customepayment.required_transdate'),
			'TransDate.date_format' => trans('customepayment.required_transdate'),
			'Mount.required' => trans('customepayment.required_mount'),
			'Mount.numeric' => trans('customepayment.required_mount_max_min'),
			'Mount.between' => trans('customepayment.required_mount_max_min'),
			'CustomID.required' => trans('customepayment.required_customid'),
			'CashierID.required' => trans('customepayment.required_cashierid'),
//            'Debt.required' => trans('customeropeningbalance.required_debt'),
			//            'Notes.required' => trans('customeropeningbalance.required_notes') ,
			//            'Notes.min' => trans('customeropeningbalance.required_notes_max_min'),
			//            'Notes.max' => trans('customeropeningbalance.required_notes_max_min'),
		);
		$rules = array(
			'TransDate' => 'required|date_format:"Y/m/d"',
			'Mount' => 'required|numeric|between:0.1,1000000',
			'CustomID' => 'required',
			'CashierID' => 'required',
//            'Debt' => 'required' ,
			//            'Notes' => 'required|min:3|max:45' ,
		);
		$validator = Validator::make(
			$inputs,
			$rules,
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
	public function isExistById($id) {
		return $this->find($id)->count();
	}

}
