<?php namespace App\Http\Controllers;

use App\Http\Models\Expenses;
use App\Http\Models\ExpensesTypes;
use App\Http\Models\ExpensesGroup;
use App\Http\Models\Cashiers;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class ExpensesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        $expenses = Expenses::all();
		
        $expensestypes = ExpensesTypes::all();
		
        $group =ExpensesGroup::all();
		$cashiers =Cashiers::all();
//		dd($expenses);
        $js_config = trans('expenses');
//		dd(view('expenses.expenses' ,compact('expenses' ,'expensestypes','group','js_config')));
        return view('expenses.expenses' ,compact('expenses' ,'expensestypes','group','cashiers','js_config'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return redirect('expense');
	}

    /**
     * Store a newly created resource in storage.
     * check Request Validtor with Custom Error Message
     * if fails then return error
     * else Create new Customer Discount
     * @param Request $request
     * @return output with data
     */

	public function store(Request $request)
	{
        $inputs = array_map('trim', Request::all() );
//		dd($inputs);
        $expenses = new Expenses();

        $validator = $expenses->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }else{

            /*if ($expenses->isExist( $inputs , 0 ) ){

                $output = ['status' => false  , 'message' => [trans('expenses.exist')]] ;

            }else{*/
                if ($expenses = Expenses::create($inputs)){

                    $output = ['status' => true , 'message' => [trans('expenses.saved')] , 'id' => $expenses->TransID] ;

                }else{
                    $output = ['status' => false , 'message' => [trans('expenses.faildsave')] ];
                }
            /*}*/
        }
        return Response()->json($output);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return redirect('expense');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
	public function edit($id)
	{
        return redirect('expense');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $inputs = array_map('trim', Request::all() );

        $expenses = new Expenses();

        $validator = $expenses->validate($inputs);

        if ($validator->fails()){

            $output = ['status' => false  , 'message' => $validator->messages()->toArray() ];

        }/*else if ($expenses->isExist($inputs , $id) ){

            $output = ['status' => false  , 'message' => [trans('expenses.exist')]] ;

        }*/else {

            if ($expenses->isExistById($id)) {

                if (Expenses::find($id)->update($inputs)) {

                    $output = ['status' => true, 'message' => [trans('expenses.saved')], 'data' => $inputs ];

                } else {

                    $output = ['status' => false, 'message' => [trans('expenses.faildsave')]];

                }

            } else {
                $output = ['status' => false, 'message' => [trans('expenses.notexist')]];
            }
        }

        return Response()->json($output);
	}

	/**
	 * Remove the specified resource from Proudcts.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        if ($expenses = Expenses::where('TransID', '=', $id)->delete() ){

            $output = ['status' => true , 'message' => [trans('expenses.deleted')] ] ;

        }else{
            $output = ['status' => false , 'message' => [ trans('expenses.notexist')] ];
        }
        return Response()->json($output);
	}

	  public function __construct()
    {
		 $this->expenses = new Expenses(); 
        $this->expensesTypes = new ExpensesTypes();
       $this->expensesGroup =new ExpensesGroup();
    }
	
	
	
	public function loadExpensesTypeScreen(){
	
			$input=Request::all();
		 	$ExpensesGroup=$input['ExpensesGroupID'];  
			$input=(array)$input;  
		
			$output=$this->expensesTypes
//			->leftjoin($this->expensesGroup->getTable(),$this->expensesTypes->getTable().'.ExpenseTypeID','=',$this->expensesGroup->getTable().'.ExpenseTypeID')
			->where($this->expensesTypes->getTable().'.ExpensesGroupID','=',$ExpensesGroup)
		    ->get();  
		
//		dd($output);
			
		 return Response()->json($output);
	}
	
	
	
		public function loadTransIDData(){
	
			$input=Request::all();
//			dd($input);
		 	$transID=$input['TransID']; 
//			dd($transID);
			$input=(array)$input;  
			
			$output=$this->expenses
//			->leftjoin($this->expensesTypes->getTable(),$this->expenses->getTable().'.ExpenseTypeID','=',$this->expensesTypes->getTable().'.ExpenseTypeID')
//			->leftjoin($this->expensesGroup->getTable(),$this->expenses->getTable().'.ExpensesGroupID','=',$this->expensesGroup->getTable().'.ExpensesGroupID')
			->where($this->expenses->getTable().'.TransID','=',$transID)
		    ->get();  
		
//			dd($output);
			
		 return Response()->json($output);
	}
	
	
	
}
