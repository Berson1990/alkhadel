<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class Suppliers extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblSuppliers';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['SupplierType', 'SupplierName', 'SupplierCommision' , 'Kalamia' , 'CollectType' , 'SupplierAccountID'];                                                 
                        
    protected $primaryKey = 'SupplierID';


    /* Validate Suppliers after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        // dd($inputs);

        $message = array(
            'SupplierName.required' => trans('suppliers.required_suppliername') ,
            'SupplierName.min' => trans('suppliers.required_supplier_max_min'),
            'SupplierName.max' => trans('suppliers.required_supplier_max_min'),
            'SupplierCommision.required' => trans('suppliers.required_commission') ,
            'SupplierCommision.numeric' => trans('suppliers.required_commission_max_min'),
            'SupplierCommision.between' => trans('suppliers.required_commission_max_min'),
            'Kalamia.required' => trans('suppliers.required_kalamia') ,
            'Kalamia.numeric' => trans('suppliers.required_kalamia_max_min'),
            'Kalamia.between' => trans('suppliers.required_kalamia_max_min'),
            'SupplierType.required' => trans('suppliers.required_suppliertype'),
            'CollectType.required' => trans('suppliers.required_collecttype'),
        );
        $rules =  array(
            'SupplierName' => 'required|min:3|max:45' ,
            'SupplierType' => 'required|max:1|integer',
            'CollectType' => 'required|max:1|integer',
//            'SupplierCommision' => 'required|numeric|between:0.1,100' ,
//            'Kalamia' =>'|numeric|between:0.1,100' ,
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
    public function isExist($inputs, $SupplierID){
        if ($SupplierID == 0)
        {
            return $this->whereRaw('SupplierName = ? and SupplierType = ?' , [ $inputs['SupplierName'] , $inputs['SupplierType'] ])->count() ;
        }
        else
        {
           return $this->whereRaw('SupplierName = ? and SupplierType = ? and SupplierID <> ?' , [ $inputs['SupplierName'] , $inputs['SupplierType'] , $SupplierID ])->count() ; 
        }
    }

    /**
     * Check if already exist in database befor update
     * @param $id
     * @return mixed
     */
    public function isExistById($id){
//		print_r("##Count=##");
//		print_r($this->find($id)->count());
        return $this->find($id)->count() ;
    }

}
