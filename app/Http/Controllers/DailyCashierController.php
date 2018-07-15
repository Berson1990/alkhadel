<?php namespace App\Http\Controllers;
use Carbon\Carbon;
use DB;
use Request;
use Response;
use App\Http\Models\BankCashierTransfer;
use App\Http\Models\CashDeposit;
use App\Http\Models\CashierBankTransfer;
use App\Http\Models\CashierOpeningBalance;
use App\Http\Models\CashierTransfer;
use App\Http\Models\Expenses;
use App\Http\Models\Cashiers;
/* Decrise Cashier */
use App\Http\Models\CashPayments;
use App\Http\Models\CustomerRefund;
use App\Http\Models\CustomRefund;
use App\Http\Models\SupplierRefund;
use App\Http\Models\CustomePayment;
class DailyCashierController extends Controller {


	public function __construct() {
		/*increse*/

		$this->cashdeposit = new CashDeposit();
		$this->cashieropeningbalance = new CashierOpeningBalance();
		$this->supplierrefund = new SupplierRefund();
		$this->bankcashiertransfer = new BankCashierTransfer();
		$this->cashiertransfer = new CashierTransfer();
		$this->cashiertransfer2 = new CashierTransfer();
		$this->customrefund = new CustomRefund();
		$this->cashiers = new Cashiers();

		/*decrise*/
		$this->customerrefund = new CustomerRefund();
		$this->cashpayments = new CashPayments();
		$this->cashierbanktransfer = new CashierBankTransfer();
		$this->expenses = new Expenses();
		$this->customepayment = new CustomePayment();

	}


	public function index() {
		// $supplierbills = Suppliers::all();
		return view('dailycashier.dailycashier');
	}

	public function DailyCashier(){
// 
        $input = Request::all();
		$input = (array) $input;
			// dd($input);
		$CashierID = $input["CashierID"];
		$FromDate = $input["FromTransDate"];
		// $ToDate = $input["ToTransDate"];

		$FromDate = Carbon::createFromFormat('Y/m/d', $FromDate)->ToDateString();
		// $ToDate = Carbon::createFromFormat('Y/m/d', $ToDate)->ToDateString();

 // dd($FromDate,$ToDate);

 // $output1 = DB::select("Select TransDate, SUM(Mount) as inc , CashierID  from 
 //  tblcashieropeningbalance 
 //  WHERE CashierID = '$CashierID'
 //  and TransDate >=  '$FromDate'
 
 //  Group By TransDate
 //  order by TransDate asc
 //  ");





// $output= $this->cashiers
// ->leftjoin($this->cashdeposit->getTable(),$this->cashiers->getTable().'.CashierID','=', $this->cashdeposit->getTable().'.CashierID')
// ->leftjoin($this->cashieropeningbalance->getTable(),$this->cashiers->getTable().'.CashierID','=', $this->cashieropeningbalance->getTable().'.CashierID')
// ->leftjoin($this->supplierrefund->getTable(),$this->cashiers->getTable().'.CashierID','=', $this->supplierrefund->getTable().'.CashierID')
// ->leftjoin($this->bankcashiertransfer->getTable(),$this->cashiers->getTable().'.CashierID','=', $this->bankcashiertransfer->getTable().'.CashierID')
// ->leftjoin($this->cashiertransfer->getTable(),$this->cashiers->getTable().'.CashierID','=', $this->cashiertransfer->getTable().'.FromCashierID')
// ->leftjoin($this->cashiertransfer2->getTable(),$this->cashiers->getTable().'.CashierID','=', $this->cashiertransfer2->getTable().'.ToCashierID')
// ->leftjoin($this->customrefund->getTable(),$this->cashiers->getTable().'.CashierID','=', $this->customrefund->getTable().'.CashierID')
// ->leftjoin($this->customerrefund->getTable(),$this->cashiers->getTable().'.CashierID','=', $this->customerrefund->getTable().'.CashierID')
// ->leftjoin($this->cashpayments->getTable(),$this->cashiers->getTable().'.CashierID','=', $this->cashpayments->getTable().'.CashierID')
// ->leftjoin($this->cashierbanktransfer->getTable(),$this->cashiers->getTable().'.CashierID','=', $this->cashierbanktransfer->getTable().'.CashierID')
// ->leftjoin($this->expenses->getTable(),$this->cashiers->getTable().'.CashierID','=', $this->expenses->getTable().'.CashierID')
// ->leftjoin($this->customepayment->getTable(),$this->cashiers->getTable().'.CashierID','=', $this->customepayment->getTable().'.CashierID')


// 		            ->where($this->cashiers->getTable().".CashierID","=",$CashierID)
// 		            ->where($this->cashdeposit->getTable().".TransDate",">=",$FromDate)
// 		            ->where($this->cashdeposit->getTable().".TransDate","<=",$ToDate)
// 		            ->get();



		            // 	$output2= $this->cashdeposit
		            // ->where($this->cashdeposit->getTable().".CashierID","=",$CashierID)
		            // ->where($this->cashdeposit->getTable().".TransDate",">=",$FromDate)
		            // ->where($this->cashdeposit->getTable().".TransDate","<=",$ToDate)
		            // ->get();

  // $inc1 =0;
  // $inc2 =0;
  // $total =0;

  // $output2 = DB::select("select TransDate, SUM(Mount) as inc , CashierID  from 
  // tblcashdeposit  WHERE CashierID = '$CashierID'
  // and TransDate = '$FromDate'
  
  // Group BY TransDate
  // order by TransDate asc
  //  ");


  
  // $cashdeposit = 0; 

	 //  // foreach test to get somthing I don't know it :) 
  // foreach ($output2 as $key => $value) {
  // 	$cashdeposit += $value->inc;
  // }
  // dd($cashdeposit);

		            //  	$output3= $this->supplierrefund
		            // ->where($this->supplierrefund->getTable().".CashierID","=",$CashierID)
		            // ->where($this->supplierrefund->getTable().".RefundDate",">=",$FromDate)
		            // ->where($this->supplierrefund->getTable().".RefundDate","<=",$ToDate)
		
		            // ->get();


 // $output3 = DB::select("select RefundDate as TransDate, SUM(Refund) as inc, CashierID  from 
 //  tblsupplierrefund  
 //  WHERE CashierID = '$CashierID'
 //  and RefundDate = '$FromDate'
 
 //  Group By RefundDate
 //  order by RefundDate asc
 // "); 



	// $output4= $this->customrefund
	// 	            ->where($this->customrefund->getTable().".CashierID","=",$CashierID)
	// 	            ->where($this->customrefund->getTable().".RefundDate",">=",$FromDate)
	// 	            ->where($this->customrefund->getTable().".RefundDate","<=",$ToDate)
	// 	            ->get();

		//  $output4 = DB::select("select RefundDate as TransDate, SUM(Refund) as inc , CashierID  from 
  // tblcustomrefund  
  // WHERE tblcustomrefund.CashierID = $CashierID
  // and RefundDate = '$FromDate'

  // Group By RefundDate
  // order by RefundDate asc
  //  ");  



// $output5= $this->cashpayments
// 		            ->where($this->cashpayments->getTable().".CashierID","=",$CashierID)
// 		            ->where($this->cashpayments->getTable().".TransDate",">=",$FromDate)
// 		            ->where($this->cashpayments->getTable().".TransDate","<=",$ToDate)
// 		            ->get();

// $output5 = DB::select("select TransDate, SUM(IFNULL(Mount,0)) as decrise, CashierID  from 
//   tblcashpayments  WHERE tblcashpayments.CashierID = $CashierID
//   and TransDate = '$FromDate'

//   Group By TransDate
//   order by TransDate asc
//     "); 

 // $output6= $this->cashiertransfer
	// 	            ->where($this->cashiertransfer->getTable().".FromCashierID","=",$CashierID)
	// 	            ->where($this->cashiertransfer->getTable().".TransDate",">=",$FromDate)
	// 	            ->where($this->cashiertransfer->getTable().".TransDate","<=",$ToDate)
	// 	            ->get();
 
 // $output6 = DB::select("select TransDate, SUM(Mount) as inc, FromCashierID  from 
 //  tblcashiertransfer  WHERE tblcashiertransfer.FromCashierID = $CashierID
 //  and TransDate = '$FromDate'

 //  Group BY TransDate
 //  order by TransDate asc
 //   "); 

 // $output7= $this->cashiertransfer
	// 	            ->where($this->cashiertransfer->getTable().".ToCashierID","=",$CashierID)
	// 	            ->where($this->cashiertransfer->getTable().".TransDate",">=",$FromDate)
	// 	            ->where($this->cashiertransfer->getTable().".TransDate","<=",$ToDate)
	// 	            ->get();


  //  $output7 = DB::select("select TransDate, SUM(IFNULL(Mount , 0 )) as decrise , ToCashierID  from 
  // tblcashiertransfer  WHERE tblcashiertransfer.ToCashierID = $CashierID
  // and TransDate = '$FromDate'
 
  // Group BY TransDate
  // order by TransDate asc
  //  ");  




// $output8 = DB::select("select RefundDate as TransDate, SUM(Refund) as inc , CashierID  from 
//   tblcustomerrefund  WHERE tblcustomerrefund.CashierID = $CashierID
//   and RefundDate = '$FromDate'

//   Group BY RefundDate
//   order by TransDate asc
//    ");  


 // $output9= $this->cashierbanktransfer
	// 	            ->where($this->cashierbanktransfer->getTable().".CashierID","=",$CashierID)
	// 	            ->where($this->cashierbanktransfer->getTable().".TransDate",">=",$FromDate)
	// 	            ->where($this->cashierbanktransfer->getTable().".TransDate","<=",$ToDate)
	// 	            ->get();
  



 //  $output9 = DB::select("select TransDate, SUM(IFNULL(Mount,0)) as decrise, CashierID  from 
 //  tblcashierbanktransfer  WHERE tblcashierbanktransfer.CashierID = $CashierID
 //  and TransDate = '$FromDate'
  
 //  Group By TransDate
 //  order by TransDate asc
 // ");  


 // $output10= $this->expenses
	// 	            ->where($this->expenses->getTable().".CashierID","=",$CashierID)
	// 	            ->where($this->expenses->getTable().".TransDate",">=",$FromDate)
	// 	            ->where($this->expenses->getTable().".TransDate","<=",$ToDate)
	// 	            ->get();
  


  // $output10= DB::select("select TransDate, SUM(IFNULL(Mount, 0)) as decrise, CashierID  from 
  // tblexpenses  WHERE tblexpenses.CashierID = $CashierID
  // and TransDate = '$FromDate'
  
  // Group By TransDate
  // order by TransDate asc
  //  "); 


 // $output11= $this->customepayment
	// 	            ->where($this->customepayment->getTable().".CashierID","=",$CashierID)
	// 	            ->where($this->customepayment->getTable().".TransDate",">=",$FromDate)
	// 	            ->where($this->customepayment->getTable().".TransDate","<=",$ToDate)
	// 	            ->get();
  

//      $output11= DB::select("select TransDate, SUM(IFNULL(Mount,0)) as decrise , CashierID  from 
//   tblcustomespayment  WHERE tblcustomespayment.CashierID = $CashierID
//   and TransDate = '$FromDate'

//   Group By TransDate
//   order by TransDate asc
// ");  


 // $result = array_merge($output1,$output2,$output3,$output4,$output5,$output6,$output7,$output8,$output9,$output10,$output11);
					// dd($result);
					// dd($output);


			 $output1 = DB::select("Select TransDate, SUM(Mount) as inc , CashierID  from 
  tblcashieropeningbalance 
  WHERE CashierID = '$CashierID'
  and TransDate = '$FromDate'
  
  Group By TransDate
  order by TransDate asc
 ");
 $tblcashieropeningbalance = 0; 
  foreach ($output1 as $key => $value) {
  	$tblcashieropeningbalance += $value->inc;
  }
 


  $output2 = DB::select("select TransDate, SUM(Mount) as inc , CashierID  from 
  tblcashdeposit  WHERE CashierID = '$CashierID'
  and TransDate ='$FromDate'
  
  Group BY TransDate
  order by TransDate asc
   ");
  	  // foreach test to get somthing I don't know it :) 
 $cashdeposit = 0; 
  foreach ($output2 as $key => $value) {
  	$cashdeposit += $value->inc;
  }
 

 $output3 = DB::select("select RefundDate as TransDate, SUM(Refund) as inc, CashierID  from 
  tblsupplierrefund  
  WHERE CashierID = '$CashierID'
  and RefundDate = '$FromDate'

  Group By RefundDate
  order by RefundDate asc
 ");
 $tblsupplierrefund = 0; 
   foreach ($output3 as $key => $value) {
  	$tblsupplierrefund += $value->inc;
  } 




		 $output4 = DB::select("select RefundDate as TransDate, SUM(Refund) as inc , CashierID  from 
  tblcustomrefund  
  WHERE tblcustomrefund.CashierID = $CashierID
  and RefundDate = '$FromDate'
  
  Group By RefundDate
  order by RefundDate asc
   "); 
 $tblcustomrefund = 0; 
   foreach ($output4 as $key => $value) {
  	$tblcustomrefund += $value->inc;
  } 



$output5 = DB::select("select TransDate, SUM(IFNULL(Mount,0)) as decrise, CashierID  from 
  tblcashpayments  WHERE tblcashpayments.CashierID = $CashierID
  and TransDate = '$FromDate'
  
  Group By TransDate
  order by TransDate asc
    "); 

 $tblcashpayments = 0; 
   foreach ($output5 as $key => $value) {
  	$tblcashpayments += $value->decrise;
  } 



 $output6 = DB::select("select TransDate, SUM(Mount) as decrise , FromCashierID  from 
  tblcashiertransfer  WHERE tblcashiertransfer.FromCashierID = $CashierID
  and TransDate = '$FromDate'

  Group BY TransDate
  order by TransDate asc
   "); 
  $tblcashiertransfer = 0; 
   foreach ($output6 as $key => $value) {
  	$tblcashiertransfer += $value->decrise;
  } 



 $output7 = DB::select("select TransDate, SUM(IFNULL(Mount , 0 )) as inc , ToCashierID  from 
  tblcashiertransfer  WHERE tblcashiertransfer.ToCashierID = $CashierID
  and TransDate = '$FromDate'
 
  Group BY TransDate
  order by TransDate asc
   ");  
   $tblcashiertransfer2 = 0; 
   foreach ($output7 as $key => $value) {
  	$tblcashiertransfer2 += $value->inc;
  } 

$output8 = DB::select("select RefundDate as TransDate, SUM(Refund) as inc , CashierID  from 
  tblcustomerrefund  WHERE tblcustomerrefund.CashierID = $CashierID
  and RefundDate = '$FromDate'

  Group BY RefundDate
  order by TransDate asc
   "); 
      $tblcustomerrefund = 0; 
   foreach ($output8 as $key => $value) {
  	$tblcustomerrefund += $value->inc;
  } 

   
$output9 = DB::select("select TransDate, SUM(IFNULL(Mount,0)) as decrise, CashierID  from 
  tblcashierbanktransfer  WHERE tblcashierbanktransfer.CashierID = $CashierID
  and TransDate = '$FromDate'

  Group By TransDate
  order by TransDate asc
 "); 
       $tblcashierbanktransfer = 0; 
   foreach ($output9 as $key => $value) {
  	$tblcashierbanktransfer += $value->decrise;
  } 


  

 $output10= DB::select("select TransDate, SUM(IFNULL(Mount, 0)) as decrise, CashierID  from 
  tblexpenses  WHERE tblexpenses.CashierID = $CashierID
  and TransDate ='$FromDate'

  Group By TransDate
  order by TransDate asc
   "); 

 	       $tblexpenses = 0; 
   foreach ($output10 as $key => $value) {
  	$tblexpenses += $value->decrise;
  } 
  

   $output11= DB::select("select TransDate, SUM(IFNULL(Mount,0)) as decrise , CashierID  from 
  tblcustomespayment  WHERE tblcustomespayment.CashierID = $CashierID
  and TransDate = '$FromDate'

  Group By TransDate
  order by TransDate asc
");  

    	       $tblcustomespayment = 0; 
   foreach ($output11 as $key => $value) {
  	$tblcustomespayment += $value->decrise;
  }



     $output12= DB::select("select TransDate, SUM(IFNULL(Mount,0)) as inc , CashierID  from 
  tblbankcashiertransfer  WHERE tblbankcashiertransfer.CashierID = $CashierID
  and TransDate = '$FromDate'

  Group By TransDate
  order by TransDate asc
");  



             $tblbankcashiertransfer = 0; 
   foreach ($output12 as $key => $value) {
    $tblbankcashiertransfer += $value->inc;
  }  


$totalinc = $tblcashieropeningbalance+$cashdeposit+$tblsupplierrefund+$tblcustomrefund+$tblcashiertransfer2+$tblcustomerrefund+$tblbankcashiertransfer;


$finaldec = $tblcashpayments+$tblcashiertransfer+$tblcashierbanktransfer+$tblexpenses+$tblcustomespayment;

$ValueOfToday = $totalinc - $finaldec;
// dd($ValueOfToday);
// dd("VAlueofTOday  " .$ValueOfToday);
// just test 
// dd($ValueOfToday);


				 $output1 = DB::select("Select TransDate, SUM(Mount) as inc , CashierID  from 
  tblcashieropeningbalance 
  WHERE CashierID = '$CashierID'
  and TransDate < '$FromDate'
  
  Group By TransDate
  order by TransDate asc
 ");
 $tblcashieropeningbalance = 0; 
  foreach ($output1 as $key => $value) {
  	$tblcashieropeningbalance += $value->inc;
  }
// dd($tblcashieropeningbalance);


  $output2 = DB::select("select TransDate, SUM(Mount) as inc , CashierID  from 
  tblcashdeposit  WHERE CashierID = '$CashierID'
  and TransDate < '$FromDate'
  
  Group BY TransDate
  order by TransDate asc
   ");
  	  // foreach test to get somthing I don't know it :) 
 $cashdeposit = 0; 
  foreach ($output2 as $key => $value) {
  	$cashdeposit += $value->inc;
  }
  // dd($cashdeposit);

 $output3 = DB::select("select RefundDate as TransDate, SUM(Refund) as inc, CashierID  from 
  tblsupplierrefund  
  WHERE CashierID = '$CashierID'
  and RefundDate < '$FromDate'

  Group By RefundDate
  order by RefundDate asc
 ");
 $tblsupplierrefund = 0; 
   foreach ($output3 as $key => $value) {
  	$tblsupplierrefund += $value->inc;
  } 
// dd($tblsupplierrefund);
		 $output4 = DB::select("select RefundDate as TransDate, SUM(Refund) as inc , CashierID  from 
  tblcustomrefund  
  WHERE tblcustomrefund.CashierID = $CashierID
  and RefundDate < '$FromDate'
  
  Group By RefundDate
  order by RefundDate asc
   "); 
 $tblcustomrefund = 0; 
   foreach ($output4 as $key => $value) {
  	$tblcustomrefund += $value->inc;
  } 
// dd($tblcustomrefund);
$output5 = DB::select("select TransDate, SUM(IFNULL(Mount,0)) as decrise, CashierID  from 
  tblcashpayments  WHERE tblcashpayments.CashierID = $CashierID
  and TransDate < '$FromDate'
  
  Group By TransDate
  order by TransDate asc
    "); 

 $tblcashpayments = 0; 
   foreach ($output5 as $key => $value) {
  	$tblcashpayments += $value->decrise;
  } 
  // dd($tblcashpayments);


 $output6 = DB::select("select TransDate, SUM(Mount) as decrise , FromCashierID  from 
  tblcashiertransfer  WHERE tblcashiertransfer.FromCashierID = $CashierID
  and TransDate < '$FromDate'

  Group BY TransDate
  order by TransDate asc
   "); 
  $tblcashiertransfer2 = 0; 
   foreach ($output6 as $key => $value) {
  	$tblcashiertransfer2 += $value->decrise;
  } 
// dd($tblcashiertransfer2);

 $output7 = DB::select("select TransDate, SUM(IFNULL(Mount , 0 )) as  inc , ToCashierID  from 
  tblcashiertransfer  WHERE tblcashiertransfer.ToCashierID = $CashierID
  and TransDate < '$FromDate'
 
  Group BY TransDate
  order by TransDate asc
   ");  
   $tblcashiertransfer = 0; 
   foreach ($output7 as $key => $value) {
  	$tblcashiertransfer += $value->inc;
  } 
// dd($tblcashiertransfer);

$output8 = DB::select("select RefundDate as TransDate, SUM(Refund) as inc , CashierID  from 
  tblcustomerrefund  WHERE tblcustomerrefund.CashierID = $CashierID
  and RefundDate < '$FromDate'

  Group BY RefundDate
  order by TransDate asc
   "); 
      $tblcustomerrefund = 0; 
   foreach ($output8 as $key => $value) {
  	$tblcustomerrefund += $value->inc;
  } 
  
// dd($tblcustomerrefund);

$output9 = DB::select("select TransDate, SUM(IFNULL(Mount,0)) as decrise, CashierID  from 
  tblcashierbanktransfer  WHERE tblcashierbanktransfer.CashierID = $CashierID
  and TransDate < '$FromDate'

  Group By TransDate
  order by TransDate asc
 "); 
       $tblcashierbanktransfer = 0; 
   foreach ($output9 as $key => $value) {
  	$tblcashierbanktransfer += $value->decrise;
  } 
   
// dd($tblcashierbanktransfer);
 $output10= DB::select("select TransDate, SUM(IFNULL(Mount, 0)) as decrise, CashierID  from 
  tblexpenses  WHERE tblexpenses.CashierID = $CashierID
  and TransDate < '$FromDate'

  Group By TransDate
  order by TransDate asc
   "); 

 	       $tblexpenses = 0; 
   foreach ($output10 as $key => $value) {
  	$tblexpenses += $value->decrise;
  } 
   
   // dd($tblexpenses);

   $output11= DB::select("select TransDate, SUM(IFNULL(Mount,0)) as decrise , CashierID  from 
  tblcustomespayment  WHERE tblcustomespayment.CashierID = $CashierID
  and TransDate < '$FromDate'

  Group By TransDate
  order by TransDate asc
");  

    	       $tblcustomespayment = 0; 
   foreach ($output11 as $key => $value) {
  	$tblcustomespayment += $value->decrise;
  } 

// dd($tblcustomespayment);

       $output12= DB::select("select TransDate, SUM(IFNULL(Mount,0)) as inc , CashierID  from 
  tblbankcashiertransfer  WHERE tblbankcashiertransfer.CashierID = $CashierID
  and TransDate < '$FromDate'

  Group By TransDate
  order by TransDate asc
");  

             $tblbankcashiertransfer = 0; 
   foreach ($output12 as $key => $value) {
    $tblbankcashiertransfer += $value->inc;
  }  

  // dd($tblbankcashiertransfer);



$totalinc = $tblcashieropeningbalance+$cashdeposit+$tblsupplierrefund+$tblcustomrefund+$tblcashiertransfer+$tblcustomerrefund+$tblbankcashiertransfer;
$finaldec = $tblcashpayments+$tblcashiertransfer2+$tblcashierbanktransfer+$tblexpenses+$tblcustomespayment;

$finalbeforDay = $totalinc - $finaldec;
// dd($finalbeforDay);

$final = $finalbeforDay +  $ValueOfToday;

// dd("final   ".$final);







// dd($finalbeforDay);
return Response()->json($final);			


	
	}



// public function MountOFCashierNOw(){

// // 
//         $input = Request::all();
// 		$input = (array) $input;
// 			// dd($input);
// 		$CashierID = $input["CashierID"];
// 		$FromDate = $input["FromTransDate"];
// 		// $ToDate = $input["ToTransDate"];

// 		$FromDate = Carbon::createFromFormat('Y/m/d', $FromDate)->ToDateString();
// 		// $ToDate = Carbon::createFromFormat('Y/m/d', $ToDate)->ToDateString();

// 		$finalbeforDay = 0; 
// 		$totalinc = 0;
// 		$finaldec = 0;
// 		$final = 0;

// 				 $output1 = DB::select("Select TransDate, SUM(Mount) as inc , CashierID  from 
//   tblcashieropeningbalance 
//   WHERE CashierID = '$CashierID'
//   and TransDate < '$FromDate'
  
//   Group By TransDate
//   order by TransDate asc
//  ");
//  $tblcashieropeningbalance = 0; 
//   foreach ($output1 as $key => $value) {
//   	$tblcashieropeningbalance += $value->inc;
//   }



//   $output2 = DB::select("select TransDate, SUM(Mount) as inc , CashierID  from 
//   tblcashdeposit  WHERE CashierID = '$CashierID'
//   and TransDate < '$FromDate'
  
//   Group BY TransDate
//   order by TransDate asc
//    ");
//   	  // foreach test to get somthing I don't know it :) 
//  $cashdeposit = 0; 
//   foreach ($output2 as $key => $value) {
//   	$cashdeposit += $value->inc;
//   }
//   // dd($cashdeposit);

//  $output3 = DB::select("select RefundDate as TransDate, SUM(Refund) as inc, CashierID  from 
//   tblsupplierrefund  
//   WHERE CashierID = '$CashierID'
//   and RefundDate < '$FromDate'

//   Group By RefundDate
//   order by RefundDate asc
//  ");
//  $tblsupplierrefund = 0; 
//    foreach ($output3 as $key => $value) {
//   	$tblsupplierrefund += $value->inc;
//   } 

// 		 $output4 = DB::select("select RefundDate as TransDate, SUM(Refund) as inc , CashierID  from 
//   tblcustomrefund  
//   WHERE tblcustomrefund.CashierID = $CashierID
//   and RefundDate < '$FromDate'
  
//   Group By RefundDate
//   order by RefundDate asc
//    "); 
//  $tblcustomrefund = 0; 
//    foreach ($output4 as $key => $value) {
//   	$tblcustomrefund += $value->inc;
//   } 

// $output5 = DB::select("select TransDate, SUM(IFNULL(Mount,0)) as decrise, CashierID  from 
//   tblcashpayments  WHERE tblcashpayments.CashierID = $CashierID
//   and TransDate < '$FromDate'
  
//   Group By TransDate
//   order by TransDate asc
//     "); 

//  $tblcashpayments = 0; 
//    foreach ($output5 as $key => $value) {
//   	$tblcashpayments += $value->decrise;
//   } 


//  $output6 = DB::select("select TransDate, SUM(Mount) as inc, FromCashierID  from 
//   tblcashiertransfer  WHERE tblcashiertransfer.FromCashierID = $CashierID
//   and TransDate < '$FromDate'

//   Group BY TransDate
//   order by TransDate asc
//    "); 
//   $tblcashiertransfer = 0; 
//    foreach ($output6 as $key => $value) {
//   	$tblcashiertransfer += $value->inc;
//   } 


//  $output7 = DB::select("select TransDate, SUM(IFNULL(Mount , 0 )) as decrise , ToCashierID  from 
//   tblcashiertransfer  WHERE tblcashiertransfer.ToCashierID = $CashierID
//   and TransDate < '$FromDate'
 
//   Group BY TransDate
//   order by TransDate asc
//    ");  
//    $tblcashiertransfer2 = 0; 
//    foreach ($output7 as $key => $value) {
//   	$tblcashiertransfer2 += $value->decrise;
//   } 

// $output8 = DB::select("select RefundDate as TransDate, SUM(Refund) as inc , CashierID  from 
//   tblcustomerrefund  WHERE tblcustomerrefund.CashierID = $CashierID
//   and RefundDate < '$FromDate'

//   Group BY RefundDate
//   order by TransDate asc
//    "); 
//       $tblcustomerrefund = 0; 
//    foreach ($output8 as $key => $value) {
//   	$tblcustomerrefund += $value->inc;
//   } 
  

// $output9 = DB::select("select TransDate, SUM(IFNULL(Mount,0)) as decrise, CashierID  from 
//   tblcashierbanktransfer  WHERE tblcashierbanktransfer.CashierID = $CashierID
//   and TransDate < '$FromDate'

//   Group By TransDate
//   order by TransDate asc
//  "); 
//        $tblcashierbanktransfer = 0; 
//    foreach ($output9 as $key => $value) {
//   	$tblcashierbanktransfer += $value->decrise;
//   } 
   

//  $output10= DB::select("select TransDate, SUM(IFNULL(Mount, 0)) as decrise, CashierID  from 
//   tblexpenses  WHERE tblexpenses.CashierID = $CashierID
//   and TransDate < '$FromDate'

//   Group By TransDate
//   order by TransDate asc
//    "); 

//  	       $tblexpenses = 0; 
//    foreach ($output10 as $key => $value) {
//   	$tblexpenses += $value->decrise;
//   } 
   
//    $output11= DB::select("select TransDate, SUM(IFNULL(Mount,0)) as decrise , CashierID  from 
//   tblcustomespayment  WHERE tblcustomespayment.CashierID = $CashierID
//   and TransDate < '$FromDate'

//   Group By TransDate
//   order by TransDate asc
// ");  

//     	       $tblcustomespayment = 0; 
//    foreach ($output11 as $key => $value) {
//   	$tblcustomespayment += $value->decrise;
//   } 

// $totalinc = $tblcashieropeningbalance+$cashdeposit+$tblsupplierrefund+$tblcustomrefund+$tblcashiertransfer+$tblcustomerrefund;
// $finaldec = $tblcashpayments+$tblcashiertransfer2+$tblcashierbanktransfer+$tblexpenses+$tblcustomespayment;
// $finalbeforDay = $totalinc - $finaldec;
// // $final = $finalbeforDay +  $ValueOfToday;

// // dd($final);
// 		// return Response()->json($final);			




// }

} // end of class