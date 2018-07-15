<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class StockHolders extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblStockHolders';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['StockHolderName', 'StockHolderPercentage' , 'StockHolderAccountID'];

    protected $primaryKey = 'StockHolderID';


    /* Validate StockHolders after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'StockHolderName.required' => trans('stockHolders.required_stockHoldername') ,
            'StockHolderName.min' => trans('stockHolders.required_stockHolder_max_min'),
            'StockHolderName.max' => trans('stockHolders.required_stockHolder_max_min'),
            'StockHolderPercentage.required' => trans('stockHolders.required_stockHoldersymbol') ,
            'StockHolderPercentage.numeric' => trans('stockHolders.required_stockholderpercentage_max_min'),
            'StockHolderPercentage.between' => trans('stockHolders.required_stockholderpercentage_max_min'),
        );
        $rules =  array(
            'StockHolderName' => 'required|min:3|max:45' ,
            'StockHolderPercentage' => 'required|numeric|between:0.1,100' 
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
     * @param $StockHolderName
     * @return mixed
     */
    public function isExist($inputs, $StockHolderID){
        if ($StockHolderID == 0)
        {
            return $this->whereRaw('StockHolderName = ?' , [ $inputs['StockHolderName'] ])->count() ;
        }
        else
        {
           return $this->whereRaw('StockHolderName = ? and StockHolderID <> ?' , [ $inputs['StockHolderName'] , $StockHolderID ])->count() ; 
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
