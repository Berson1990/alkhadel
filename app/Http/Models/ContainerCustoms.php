<?php namespace App\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Validator;

class ContainerCustoms extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tblContainerCustoms';
    /**
     * Primary Key
     * @var string
     */
    protected $primaryKey = 'Serial';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['ContainerID' ,'CustomID' ,'CustomMount' ];


    /**
     * Validate All Inputs Before Insert In Database
     * @param $inputs
     * @return mixed
     */
    public function Validate($inputs ,$type = null){

        $validator = Validator::make($inputs ,$this->_ValidationRules($type) ,$this->_ValidationMessage() );

        return $validator->messages()->toArray();
    }

    /**
     * Validation Message
     * @return array
     */
    // dont forget custmize message with localization
    private function _ValidationMessage(){
        return [];
        return [
            'ContainerID.required' => 'required',
            'CustomID.required' => 'required',
            'CustomMount.required' => 'required',
            'ContainerID.exists' => 'exists',
            'CustomID.exists' => 'exists',
            'CustomMount.numeric' => 'numeric',
        ];
    }

    /**
     * Valdation Rules
     * @return $rules
     */
    private function _ValidationRules($type){
        $rules = [
            'ContainerID' => 'required|exists:tblContainers,ContainerID',
            'CustomID' => 'required|exists:tblCustoms,CustomID',
            'CustomMount' => 'required|numeric|between:0,200000',
        ];

        switch($type){
            case "update" :
                $rules = array_merge($rules , ['Serial' => 'required|exists:tblContainerCustoms,Serial'] );
                break;
        }

        return $rules;
    }
    /**
     * ContainerCustoms CustomID Belong to tblCustoms.Serial
     * @relationship
     * */
    public function Customs()
    {
        return $this->belongsTo('App\Http\Models\Customs', 'CustomID')->select() ;
    }

}
