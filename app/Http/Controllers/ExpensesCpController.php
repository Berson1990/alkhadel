<?php namespace App\Http\Controllers;

use App\Http\Models\ExpensesTypes;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use Response;


class ExpensesCpController extends Controller {

    public function index()
    {
        return view('expensescp.expensescp');
    }

    public function create()
    {
        return redirect('expensescp');
    }

  
    public function show($id)
    {
        return redirect('expensescp');
    }

    public function edit($id)
    {
        return redirect('expensescp');
    }

}
