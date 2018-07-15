<?php namespace App\Http\Controllers;

use App\Http\Models\ExpensesTypes;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;

class ExpensesTypesPrintController extends Controller {
	
	  public function index()
    {
        //
       /* $expensestypesprint = ExpensesTypes::all();
        $js_config = trans('expensestypesprint');
        // dd($js_config);
        // exit();*/
     // return view('expensestypesprint.expensestypesprint' ,compact('expensestypesprint','js_config'));
	 return view('expensestypesprint.expensestypesprint');
    }
	
	
	
	
    /*	
	public function printtable()
	{
	  return redirect('expensestypesprint');	
	}*/
	
	public function create()
	{
		return redirect('expensestypesprint');
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
		 return redirect('expensestypesprint');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return redirect('expensestypesprint');
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
	}
	
	
	
	
	
}// end of class 
	
	
?>