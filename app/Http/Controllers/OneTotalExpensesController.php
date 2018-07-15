<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\ExpensesTypes;
use App\Http\Models\Expenses;
use Illuminate\Http\Response;
use Carbon\Carbon; 
use Request;

class OneTotalExpensesController extends Controller {
 /*
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$onetotalexpenses = ExpensesTypes::all();
        
		//return "21212121";
		return view('onetotalexpenses.onetotalexpenses' ,compact('onetotalexpenses'));
	}
    
     public function __construct()
    {
		 $this->Ex = new Expenses(); 
        $this->Et = new ExpensesTypes();
       
    }


	public function loadData()
	{ 
     
        $input=Request::all();
        $input=(array)$input;
//	    var_dump(input);die();
//        dd($input);
       $from=$input['FromTransDate'];
       $to=$input['ToTransDate'];
       $from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString();
       $to =     Carbon::createFromFormat('Y/m/d', $to)->toDateString();
        $ExpenseTypeID=$input['ExpenseTypeID'];
        
       $output =$this->Ex->
	         leftjoin($this->Et->getTable(),$this->Ex->getTable().'.ExpenseTypeID','=', $this->Et->getTable().'.ExpenseTypeID')
	        ->where($this->Ex->getTable().'.TransDate','>=', $from  )
            ->where($this->Ex->getTable().'.TransDate' ,'<=', $to   )
			->where($this->Et->getTable().'.ExpenseTypeID' ,$ExpenseTypeID)
            ->get();
		
//     dd($output); 
	     return Response()->json($output);	
	}
}//end of class


?>