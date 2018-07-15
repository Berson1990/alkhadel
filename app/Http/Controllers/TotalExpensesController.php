<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\ExpensesTypes;
use App\Http\Models\Cashiers;
use App\Http\Models\Expenses;
use App\Http\Models\ExpensesGroup;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Request;

class TotalExpensesController extends Controller {
 /*
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
          //  return "testing the routes";
		return view('totalexpenses.totalexpenses');
	}

    
    
//       public function index()
//    {
//        //
//        $expensestypes = ExpensesTypes::all();
//
//        $js_config = trans('expensestypes');
//        // dd($js_config);
//        // exit();
//
//
//        return view('expensestypes.expensestypes' ,compact('expensestypes','js_config'));
//    }


    
    
    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}  public function __construct()
    {
        $this->Et = new ExpensesTypes();
        $this->Ex = new Expenses();
        $this->cashiers = new Cashiers();
        $this->expensesGroup  = new ExpensesGroup();
    }

    // 
    
    public function loadData()
	{ 
        $input=Request::all();
        $input=(array)$input;

        $from=$input['FromTransDate'];
        $to=$input['ToTransDate'];
        $from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;
        $to =   Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;

        $output =$this->Ex
            ->leftjoin($this->Et->getTable(),$this->Ex->getTable().'.ExpenseTypeID','=', $this->Et->getTable().'.ExpenseTypeID')
     ->leftjoin($this->expensesGroup->getTable(),$this->Ex->getTable().'.ExpensesGroupID','=', $this->expensesGroup->getTable().'.ExpensesGroupID')
            ->leftjoin($this->cashiers->getTable(),$this->Ex->getTable().'.CashierID','=', $this->cashiers->getTable().'.CashierID')
            ->where($this->Ex->getTable().'.TransDate','>=', $from  )
            ->where($this->Ex->getTable().'.TransDate' ,'<=', $to    )
            ->get();
//        dd($output);
        return Response()->json($output);
        
		
	}
}