<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class Carrying extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblcarrying';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['Local', 'Imported'];

    protected $primaryKey = 'CarryingID';


    /* Validate Carrying after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'Local.required' => trans('carrying.required_local') ,
            'Local.numeric' => trans('carrying.required_local_max_min'),
            'Imported.required' => trans('carrying.required_imported') ,
            'Imported.numeric' => trans('carrying.required_imported_max_min'),
        );
        $rules =  array(
            'Local' => 'required|numeric|between:0.1,1000000' ,
            'Imported' => 'required|numeric|between:0.1,1000000'
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
     * @param $SupplierName
     * @return mixed
     */
    /* MH
        public function isExist($inputs){
             return $this->whereRaw('SupplierName = ?' , [ $inputs['SupplierName'] ])->count() ;
         }
    */

    /**
     * Check if already exist in database befor update
     * @param $id
     * @return mixed
     */
        public function isExistById($id){
            return $this->find($id)->count() ;
        }

}
