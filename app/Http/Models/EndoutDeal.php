<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response as illuminateReponse;

class EndoutDeal extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblEndoutdeal';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['SalesID' ,'valuesold' ,'billexpenses' ,'commision' ,'Total_1' ,'estimatedvalue' ,'internalexpenses' ,'Total_2' ];

    protected $primaryKey = 'Serial';

	   /**
     * SalesDetails Belong to Sales
     * @relationship
     * */
    public function Sales()
    {
        return $this->belongsTo('App\Http\Models\Sales', 'SalesID')->select();
    }


    /* Validate EndOutDeal after insert or Update
     * @param $inputs
     * @return mixed
     */
    public function validate($inputs  ){

        $message = [
        ];
        $rules =  array(
//            'SalesID' => 'required|integer|exists:tblSales,SalesID|unique:tblEndoutdeal' ,
            'valuesold' => 'required|numeric' ,
           'valuesold' => 'required|numeric' ,
            'commision' => 'required|numeric' ,
            'estimatedvalue' => 'required|numeric' ,
            'internalexpenses' => 'required|numeric'
        );

//        switch($type){
//            case "update" :
//               $rules = array_except($rules ,['SalesID']);
////                $rules = array_except($rules ,['SalesID']);
//                break;
//        }

        $validator = Validator::make(
            $inputs ,
            $rules ,
//			$type,
            $message
        )->messages()->toArray();
        return $validator;
    }

    /***
     * Insert New EndoutDeal and Check If Inserted Or Not
     * @param $inputs
     * @return array
     */
    public function InsertEndoutdeal($inputs){

        try{
            $this->create($inputs);
            $output = ['status' => true , 'message' => ['End Deal Inserted'] ,'code' => illuminateReponse::HTTP_ACCEPTED];
        }catch(\Exception $e) {

            $output = ['status' => false , 'message' => 'Cannot Close End Deal , Plz Reload Page' ,'code' => illuminateReponse::HTTP_BAD_REQUEST];
        }
        return $output;
    }
    /**
     * Check If Serial Exist
     * @param $id
     */
    public function IsEnddealAlreadyExist($id){
        return Validator::make(
            ['Serial' => $id], // inputs
            ['Serial' => 'required|exists:tblEndoutdeal,Serial'], // Rules
            [ // Messages
                'Serial.required' => 'Select EndoutDeal From List To Edit or Delete',
                'Serial.exists' => 'Selected EndoutDeal Doesnt Exist , Please Reload Page'
            ]
        )->messages()->toArray();
    }
    /**
     * Check If SalesID Exist
     * @param $id
     */
    public function IsEnddealAlreadyExistBySalesID($id){
        return $this->where(['SalesID' => $id])->select('Serial') -> count();
    }
 
}
