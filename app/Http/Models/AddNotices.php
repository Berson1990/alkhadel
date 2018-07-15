<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class AddNotices extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tbladdnotices';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['CheckNo', 'NoticeNo'];

    protected $primaryKey = 'TransID';

    //   public function Banks()
    // {
    //     $this->hasMany('App\Http\Models\Banks' , 'CurrencyID');
    // }


    /* Validate Currencys after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs){

        $message = array(
            'CheckNo.required' => trans('addnotices.required_checkno') ,
            'CheckNo.min' => trans('addnotices.required_checkno_max_min'),
            'CheckNo.max' => trans('addnotices.required_checkno_max_min'),
            'NoticeNo.required' => trans('addnotices.required_noticeno') ,
            'NoticeNo.min' => trans('discountnotices.required_noticeno_max_min'),
            'NoticeNo.max' => trans('discountnotices.required_noticeno_max_min'),
        );
        $rules =  array(
            'CheckNo' => 'required|min:3|max:45' ,
            'NoticeNo' => 'required|min:3|max:45' 
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
     * @param $CurrencyName
     * @return mixed
     */
    public function isExist($inputs , $TransID){
        if ($TransID == 0)
        {
            return $this->whereRaw('CheckNo = ?' , [ $inputs['CheckNo'] ])->count() ;
        }
        else
        {
           return $this->whereRaw('CheckNo = ? and TransID <> ?' , [ $inputs['CheckNo'] , $TransID ])->count() ; 
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
