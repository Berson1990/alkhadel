<?php namespace App\Http\Controllers;


use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Response;


use App\Http\Models\CashDeposit;

use App\Http\Models\CheckDeposit;

use App\Http\Models\CustomersDiscount;

use App\Http\Models\CustomerOpeningBalance;

use App\Http\Models\CustomerRefund;

use App\Http\Models\BankCashDeposit;

use DB;


use App\Http\Models\Products;

use App\Http\Models\SalesDetails;

use App\Http\Models\Sales;

use App\Http\Models\Suppliers;

use App\Http\Models\Customers;

use Carbon\Carbon;

use Request;

use Illuminate\Database\Query\Builder;


class CustomersBillsController extends Controller
{

    public function index()

    {

        $supplierbills = Suppliers::all();

        return view('customersbills.customersbills', compact('supplierbills'));

    }


    public function __construct()

    {


        $this->cashDeposit = new CashDeposit();

        $this->checkDeposit = new CheckDeposit();

        $this->customersDiscount = new CustomersDiscount();

        $this->customerOpeningBalance = new CustomerOpeningBalance();

        $this->customerRefund = new CustomerRefund();

        $this->sales = new Sales();

        $this->salesdetails = new SalesDetails();

        $this->products = new Products();

        $this->suppliers = new Suppliers();

        $this->customers = new Customers();

        $this->bankcashdeposit = new BankCashDeposit();

    }


    function loadBills()

    {

        $input = Request::all();

//          dd($input);

        $input = (array)$input;

        $customers = $input['CustomerID'];

        $from = $input['FromTransDate'];

        $to = $input['ToTransDate'];


//     $prouductType=$input['ProuductID'];   


        if (isset($input['checkProuduct'])) {

            $checkproduct = $input['checkProuduct'];

        } else {

            $checkproduct = 0;

            $prouductType = 0;

        }


        $from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();

        $to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();


        if ($checkproduct > 0) {

            $prouductType = $input['ProuductID'];


            $output = $this->sales
                ->select(
                    $this->sales->getTable().'.*',
                    $this->salesdetails->getTable().'.*',
                    $this->customers->getTable().'.*',
                    $this->suppliers->getTable().'.*',
                    $this->products->getTable().'.*',
                    DB::raw('sum('.$this->sales->getTable().'.Custody '.') as Custody ')

                )
                ->leftjoin($this->salesdetails->getTable(), $this->sales->getTable() . '.SalesID', '=', $this->salesdetails->getTable() . '.SalesID')
                ->leftjoin($this->suppliers->getTable(), $this->salesdetails->getTable() . '.SupplierID', '=', $this->suppliers->getTable() . '.SupplierID')
                ->leftjoin($this->customers->getTable(), $this->sales->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
                ->leftjoin($this->products->getTable(), $this->salesdetails->getTable() . '.ProductID', '=', $this->products->getTable() . '.ProductID')
                ->where($this->sales->getTable() . '.SalesDate', '>=', $from)
                ->where($this->sales->getTable() . '.SalesDate', '<=', $to)
                ->where($this->products->getTable() . '.ProductType', $prouductType)
                ->where($this->sales->getTable() . '.CustomerID', $customers)
                ->get();


        } else if ($checkproduct == 0) {


//             $prouductType=$input['ProuductID'];    


            $output = $this->sales
                ->select(
                    $this->sales->getTable().'.*',
                    $this->salesdetails->getTable().'.*',
                    $this->customers->getTable().'.*',
                    $this->suppliers->getTable().'.*',
                    $this->products->getTable().'.*',
                    DB::raw('sum('.$this->sales->getTable().'.Custody '.') as Custody ')

                )
                ->leftjoin($this->salesdetails->getTable(), $this->sales->getTable() . '.SalesID', '=', $this->salesdetails->getTable() . '.SalesID')
                ->leftjoin($this->suppliers->getTable(), $this->salesdetails->getTable() . '.SupplierID', '=', $this->suppliers->getTable() . '.SupplierID')
                ->leftjoin($this->customers->getTable(), $this->sales->getTable() . '.CustomerID', '=', $this->customers->getTable() . '.CustomerID')
                ->leftjoin($this->products->getTable(), $this->salesdetails->getTable() . '.ProductID', '=', $this->products->getTable() . '.ProductID')
                ->where($this->sales->getTable() . '.SalesDate', '>=', $from)
                ->where($this->sales->getTable() . '.SalesDate', '<=', $to)
                ->where($this->sales->getTable() . '.CustomerID', $customers)
                ->get();


        }


//      dd($output);

        return Response()->json($output);

    }


    function CustomerDeposit()

    {


        $input = Request::all();

//        dd($input);

        $input = (array)$input;

        $customers = $input['CustomerID'];

        $from = $input['FromTransDate'];

        $to = $input['ToTransDate'];

        $from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();

        $to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();


        $cashDeposit = $this->customers->select(

            $this->cashDeposit->getTable() . '.TransDate',

            $this->cashDeposit->getTable() . '.Mount',

            $this->cashDeposit->getTable() . '.Notes'
        )
            ->where($this->cashDeposit->getTable() . '.TransDate', '>=', $from)
            ->where($this->cashDeposit->getTable() . '.TransDate', '<=', $to)
            ->where($this->customers->getTable() . '.CustomerID', '=', $customers);

        $checkdeposit = $this->customers->select(

            $this->checkDeposit->getTable() . '.TransDate as CheckTransDate',

            $this->checkDeposit->getTable() . '.Mount as CheckMount',

            $this->checkDeposit->getTable() . '.Notes as CheckNotes',

            $this->checkDeposit->getTable() . '.CheckNo'

        )
            ->where($this->checkDeposit->getTable() . '.TransDate', '>=', $from)
            ->where($this->checkDeposit->getTable() . '.TransDate', '<=', $to)
            ->where($this->customers->getTable() . '.CustomerID', '=', $customers);

        $bankdeposit = $this->customers->select(

            $this->bankcashdeposit->getTable() . '.TransDate as BankTransDate',

            $this->bankcashdeposit->getTable() . '.Mount as BankMount',

            $this->bankcashdeposit->getTable() . '.Notes as BankNotes'

        )
            ->where($this->customers->getTable() . '.CustomerID', '=', $customers)
            ->where($this->bankcashdeposit->getTable() . '.TransDate', '>=', $from)
            ->where($this->bankcashdeposit->getTable() . '.TransDate', '<=', $to);


        $output =  $cashDeposit->union($checkdeposit)->union($bankdeposit)->get();


        /*
          $output = DB::select("select TransDate,Mount,'نقدى' PaymentType , ' ' CheckNo , Notes
                         from tblcashdeposit
                         WHERE TransDate >='$from'
                         AND  TransDate <='$to'
                         AND CustomerID = '$customers'

                         Union
                         Select TransDate,Mount, 'شيك' PaymentType , CheckNo, Notes
                         from tblcheckdeposit
                         WHERE TransDate >='$from'
                         AND  TransDate <='$to'
                         AND CustomerID = '$customers'

                         Union
                         Select TransDate,Mount, 'ايداع بنكى' PaymentType , ' 'CheckNo, Notes
                         from tblbankcashdeposit
                        WHERE TransDate >='$from'
                         AND  TransDate <='$to'
                         AND CustomerID = '$customers'

                         ");*/


        return Response()->json($output);

    }


    function CustomerRefund()

    {

        $input = Request::all();

        $input = (array)$input;

        $customers = $input['CustomerID'];

        $from = $input['FromTransDate'];

        $to = $input['ToTransDate'];

        $from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();

        $to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();


        $output =

            $this->customerRefund
                ->where($this->customerRefund->getTable() . '.CustomerID', $customers)
                ->where($this->customerRefund->getTable() . '.RefundDate', '>=', $from)
                ->where($this->customerRefund->getTable() . '.RefundDate', '<=', $to)
                ->get();


        return Response()->json($output);

    }


    /*  function CustomerDeposit()

      {





        $input=Request::all();

  //        dd($input);

        $input=(array)$input;

        $customers =$input['CustomerID'];

        $from=$input['FromTransDate'];

        $to=$input['ToTransDate'];

        $from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;

        $to =     Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;



          $output = DB::select("select TransDate,Mount,'نقدى' PaymentType , ' ' CheckNo , Notes

                                  from tblcashdeposit

                                  WHERE TransDate >='$from'

                                  AND  TransDate <='$to'

                                  AND CustomerID = '$customers'

                                  GROUP BY  TransID



                                  Union

                                  Select TransDate,Mount, 'شيك' PaymentType , CheckNo, Notes

                                  from tblcheckdeposit

                                  WHERE TransDate >='$from'

                                  AND  TransDate <='$to'

                                  AND CustomerID = '$customers'

                                   GROUP BY  TransID



                                  Union

                                  Select TransDate,Mount, 'ايداع بنكى' PaymentType , ' 'CheckNo, Notes

                                  from tblbankcashdeposit

                                 WHERE TransDate >='$from'

                                  AND  TransDate <='$to'

                                  AND CustomerID = '$customers'

                                   GROUP BY  TransID ");







       return Response()->json($output);

      }*/


    function loadCustomerDiscount()
    {

        $input = Request::all();

        $input = (array)$input;

        $customers = $input['CustomerID'];

        $from = $input['FromTransDate'];

        $to = $input['ToTransDate'];

        $from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();

        $to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();


        $output =

            $this->customersDiscount
                ->where($this->customersDiscount->getTable() . '.CustomerID', $customers)
                ->where($this->customersDiscount->getTable() . '.TransDate', '>=', $from)
                ->where($this->customersDiscount->getTable() . '.TransDate', '<=', $to)
                ->get();


        return Response()->json($output);

    }



// //customer open date 

//       function CustomerOpeningDate() {


//     $input=Request::all();

//       $input=(array)$input; 

//      $customers =$input['CustomerID'];        


//       $from=$input['FromTransDate'];

//       $to=$input['ToTransDate'];

//       $from =   Carbon::createFromFormat('Y/m/d', $from)->toDateString() ;

//       $to =     Carbon::createFromFormat('Y/m/d', $to)->toDateString() ;


//     $query1 = DB::table('tblcustomeropeningbalance')

//         ->selectRaw('TransDate')

//         ->orderby("TransDate","asc")

//         ->take(1)

//         ->where($this->customerOpeningBalance->getTable().'.CustomerID',$customers );  


//         $query2 = DB::table('tblcashdeposit')

//         ->selectRaw( 'TransDate')

//         ->orderby("TransDate","asc")

//         ->take(1) 

//         ->where($this->cashDeposit->getTable().'.CustomerID',$customers );  


//         $query3 = DB::table('tblcheckdeposit')

//         ->orderby("TransDate","asc")

//         ->selectRaw( 'TransDate')

//         ->take(1)

//         ->where($this->checkDeposit->getTable().'.CustomerID',$customers );   


//         $query4 = DB::table('tblcustomerrefund')

//         ->orderby("RefundDate","asc")

//         ->selectRaw( 'RefundDate')

//         ->take(1)

//         ->where($this->customerRefund->getTable().'.CustomerID',$customers );


//         $query5 = DB::table('tblcustomersdiscount')


//         ->union($query4)

//         ->union($query3)

//         ->union($query2)

//         ->union($query1)

//         ->selectRaw( 'TransDate')

//         ->orderby("TransDate","asc")

//         ->take(1)

//         ->where($this->customersDiscount->getTable().'.CustomerID',$customers )

//         ->get();


//         return Response()->json($query5);      


//     }


//    public function CustomerOpeningBalance()

//   {


//       $input    = Request::json();

//       $input    = (array)$input; 


//       foreach ($input as $key => $value) {

//       $startDate = $value['startDate'];

//       $fromDate  = $value['fromDate'];

//       }


//       $startDate = date("Y/m/d", strtotime($startDate));

//       $fromDate  = date('Y/m/d', strtotime("yesterday", strtotime($fromDate)));

//       $fromDate  = Carbon::createFromFormat('Y/m/d', $fromDate)->toDateString() ;

//       $startDate = Carbon::createFromFormat('Y/m/d', $startDate)->toDateString() ;


//       $query1 = DB::table('tblcustomeropeningbalance')

//         ->selectRaw('Mount')

//         ->where('TransDate','>=', $startDate)

//         ->where('TransDate' ,'<=', $fromDate )

//         ->get();    


//         $customerOpeningBalance=0;


//         foreach ($query1 as $key => $value) {

//           $customerOpeningBalance+=$value->Mount;

//         }


//         $query2 = DB::table('tblcashdeposit')

//         ->selectRaw( 'Mount')

//         ->where('TransDate','>=', $startDate)

//         ->where('TransDate' ,'<=', $fromDate )

//         ->get();

//         $cashdeposit=0;


//         foreach ($query2 as $key => $value) {

//            $cashdeposit+=$value->Mount;

//         }


//         $query3 = DB::table('tblcheckdeposit')

//         ->selectRaw( 'Mount')

//         ->where('TransDate','>=', $startDate)

//         ->where('TransDate' ,'<=', $fromDate )

//         ->get();

//         $checkdeposit=0;


//         foreach ($query3 as $key => $value) {

//          $checkdeposit+=$value->Mount;

//         }


//         $query4 = DB::table('tblcustomerrefund')

//         ->selectRaw( 'Refund')

//         ->where('RefundDate','>=', $startDate)

//         ->where('RefundDate' ,'<=', $fromDate)

//         ->get();

//         $customerrefund=0;      


//         foreach ($query4 as $key => $value) {

//            $customerrefund+=$value->Refund;

//         }


//         $query5 = DB::table('tblcustomersdiscount')  

//         ->selectRaw( 'Mount')

//         ->where('TransDate','>=', $startDate)

//         ->where('TransDate' ,'<=', $fromDate )

//         ->get();    

//         $customersdiscount=0;


//         foreach ($query5 as $key => $value) {

//           $customersdiscount+=$value->Mount;

//         }


//         $total=$customerOpeningBalance+$cashdeposit+$checkdeposit+$customersdiscount-$customerrefund;

//         // echo $suppliersdiscount." ";

//         // echo $checkpayments." ";

//         // echo $cashpayments." ";

//         // echo $supplierOpeningBalance." ";

//         // echo $supplierrefund."   ";

// //        dd($total);

//        return $total;  

//   }  


    public function GetCustomersOpeningBalnce()

    {


        $input = Request::all();

//          dd($input);

        $input = (array)$input;

        $customers = $input['CustomerID'];

        $from = $input['FromTransDate'];

        $to = $input['ToTransDate'];

        $from = Carbon::createFromFormat('Y/m/d', $from)->toDateString();

        $to = Carbon::createFromFormat('Y/m/d', $to)->toDateString();


        $output = $this->customerOpeningBalance
//     ->where($this->customerOpeningBalance->getTable().'.TransDate','>=', $from)

//     ->where($this->customerOpeningBalance->getTable().'.TransDate' ,'<=', $to )    

            ->where($this->customerOpeningBalance->getTable() . '.CustomerID', $customers)
            ->get();

//        dd($output);

        return Response()->json($output);

    }


}//end of class 

