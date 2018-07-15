<?php namespace App\Http\Controllers;

use App\Http\Models\ContainerCustoms;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as illuminateReponse;

use Illuminate\Support\Facades\Validator;
use Request;

class ContainerCustomsController extends Controller {


    private $ccustoms;
    public function __construct()
    {
        $this->ccustoms = new ContainerCustoms();
    }
	/**
	 * Store a newly created resource in storage.
	 * validate
     * check if error found
     * create ContainerCustomer
	 * @return Response
	 */
	public function store()
	{
        $errors = $this->ccustoms->Validate($inputs = Request::all());

        if (!$errors){

            $inputs  = $this->TransFormInputs($inputs);

            $CreatedCContainer = $this->ccustoms->create($inputs);

            $output = ['status' => true , 'message' => 'New Custom Added To Container','Serial' => $CreatedCContainer->Serial ,'code' => illuminateReponse::HTTP_CREATED];

        }else{

            $output = ['status' => false , 'message' => $errors ,'code' => illuminateReponse::HTTP_BAD_REQUEST];
        }
        return Response::json($output);
	}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $errors = $this->IsCCustomsExist($id);
        if (!$errors){

            $Container = $this->ccustoms->destroy($id);

            $output = ['status' => true , 'message' => 'Customs Deleted From Selected Container' ,'code' => illuminateReponse::HTTP_OK];

        }else{

            $output = ['status' => false , 'message' => $errors ,'code' => illuminateReponse::HTTP_BAD_REQUEST];

        }
        return Response::json($output);
    }


    /**
     * Getmethod with ajax and check If id Exist In database
     * Get Container Details By ID expected Update_at & created_ats
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $errors = $this->IsCCustomsExist($id);

        if (!$errors){

            $CCustom = $this->ccustoms->find($id);

            $output = ['status' => true , 'data' => array_except($CCustom->toArray() , ['created_at' ,'updated_at']) ,'code' => illuminateReponse::HTTP_OK];

        }else{

            $output = ['status' => false , 'message' => $errors ,'code' => illuminateReponse::HTTP_BAD_REQUEST];

        }
        return Response::json($output);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

        $errors = $this->ccustoms->Validate($inputs = array_merge(Request::all() , ['Serial' => $id]) ,'update' ); // Type is Update to check If ContainerCustomID Is Exist

        if (!$errors){

            $inputs  = $this->TransFormInputs($inputs);

            $this->ccustoms->find($id)->update(array_except($inputs ,['Serial']));

            $output = ['status' => true , 'message' => 'Container Custom Details Updated' ,'code' => illuminateReponse::HTTP_OK];

        }else{

            $output = ['status' => false , 'message' => $errors ,'code' => illuminateReponse::HTTP_BAD_REQUEST];
        }
        return Response::json($output);
    }

    /**
     * TransFormInputs
     * trim spaces from inputs
     * @param $inputs
     * @return $inputs
     */
    private function TransFormInputs($inputs){

        $inputs = array_map('trim' ,$inputs);

        return $inputs;
    }
    /**
     * Check If Container Exist
     * @param $id
     */
    private function IsCCustomsExist($id){
        return Validator::make(
            ['Serial' => $id], // inputs
            ['Serial' => 'required|exists:tblContainerCustoms,Serial'], // Rules
            [ // Messages
                'Serial.required' => 'Select Custom From Container Customs List To Edit or Delete',
                'Serial.exists' => 'Selected Custom Doesnt Exist , Please Reload Page'
            ]
        )->messages()->toArray();
    }

}
