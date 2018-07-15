<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\ExpensesTypes;
use App\Http\Models\Expenses;
use App\Http\Models\ExpensesGroup;
use Illuminate\Http\Response;
use Carbon\Carbon; 
use Request;

class ExpensesGroupReportController extends Controller {
 /*
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$expensesgroup = ExpensesGroup::all();
//        dd($expensesgroup);
		//return "21212121";
//		dd(view('expensesgroupreport.expensesgroupreport' ,compact('expensesgroup')));
		return view('expensesgroupreport.expensesgroupreport' ,compact('expensesgroup'));
	}
    
     public function __construct()
    {
		 $this->expenses = new Expenses(); 
        $this->expensesTypes = new ExpensesTypes();
       $this->expensesGroup =new ExpensesGroup();
    }
	
	
		public function loadExpensesType(){
	
			$input=Request::all();
		 	$ExpensesGroup=$input['ExpenseGroupID'];  
		 
			$input=(array)$input;  
		
			$output=$this->expenses
			->leftjoin($this->expensesTypes->getTable(),$this->expenses->getTable().'.ExpenseTypeID','=',$this->expensesTypes->getTable().'.ExpenseTypeID')
			->where($this->expenses->getTable().'.ExpensesGroupID','=',$ExpensesGroup)
			
		    ->get();  
		
//			dd($output);
			
		 return Response()->json($output);
	}
	
	function loadDataExpensesGroupReort ()
    {
      $input     =Request::all();
      $input     =(array)$input; 
//      $ExpenseTypeID=$input['ExpenseTypeID'];          
      $ExpensesGroup =$input['ExpenseGroupID'];    
      $from      =$input['FromTransDate'];
      $to        =$input['ToTransDate'];
        	

        
        
      $from       = Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
      $to         = Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;
		
      $output= $this->expenses
    ->leftjoin($this->expensesTypes->getTable(),$this->expenses->getTable().'.ExpenseTypeID','=', $this->expensesTypes->getTable().'.ExpenseTypeID')
     ->leftjoin($this->expensesGroup->getTable(),$this->expenses->getTable().'.ExpensesGroupID','=', $this->expensesGroup->getTable().'.ExpensesGroupID')

     ->where($this->expenses->getTable().'.TransDate','>=', $from)
     ->where($this->expenses->getTable().'.TransDate' ,'<=', $to )    
     ->where($this->expenses->getTable().'.ExpensesGroupID','=',$ExpensesGroup)
//    ->where($this->expenses->getTable().'.ExpenseTypeID','=',$ExpenseTypeID)      
    ->get();
//      dd($output);

       return Response()->json($output);      
    }
	
	
	
	
	
	
}
	