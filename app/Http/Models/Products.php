<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class Products extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblProducts';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['ProductName', 'ProductType'];

    protected $primaryKey = 'ProductID';


    /* Validate Products after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'ProductName.required' => trans('products.required_productname'),
            'ProductName.min' => trans('products.required_product_max_min'),
            'ProductName.max' => trans('products.required_product_max_min'),
            'ProductType.required' => trans('products.required_producttype'),
        );
        $rules =  array(
            'ProductName' => 'required|min:3|max:45' ,
            'ProductType' => 'required|max:1|integer'
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
     * @param $ProductName
     * @param $ProductType
     * @return mixed
     */
    public function isExist($inputs, $ProductID){
        if ($ProductID == 0)
        {
            return $this->whereRaw('ProductName = ? and ProductType = ?' , [ $inputs['ProductName'] , $inputs['ProductType'] ])->count() ;
        }
        else
        {
           return $this->whereRaw('ProductName = ? and ProductType = ? and ProductID <> ?' , [ $inputs['ProductName'] , $inputs['ProductType'] , $ProductID ])->count() ; 
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
