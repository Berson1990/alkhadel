<!--just screen no model  --> 
@extends('adminheader.header')


    @section('header')

  <section class="content-header">
        <div class="row">

                            <div class="col-lg-5"></div> 
                            <div  class="col-lg-2  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >  شـــاشه العمـــلاء  </h3>
                            </div>
                             <div class="col-lg-5"></div>
                    </div>
        </section>
        
    @endsection


    @section('content')

    <style type="text/css">

        </style>
        
       
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
<!--                            <h3 class="box-title">كل ما يتعلق بحسابات العملاء</h3>-->
                        </div>
                        <div class="box-body">
                        

                                <div class="row" style="margin:10px;">
                                    <div class="panel with-nav-tabs panel-primary" style="margin-bottom: 18px;direction: ltr;">
                                        <div class="panel-heading">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a id="tab01" href="#tab_opening" data-toggle="tab">رصيد بداية الحساب</a></li>
                                                <li class=""><a id="tab02"  href="#tab_customerDiscount" data-toggle="tab">الخصم المسموح به</a></li>
                                                <li class=""><a id="tab03"  href="#tab_cashDeposit" data-toggle="tab">المقبوضات النقدية</a></li>
                                                <li class=""><a id="tab04"  href="#tab_checkDeposit" data-toggle="tab">المقبوضات بالشيكات</a></li>
                                                <li class=""><a id="tab05"  href="#tab_customerRefund" data-toggle="tab">مرتجع نقدى</a></li>
																								
												<li class=""><a id="tab06"  href="#tab_BanckCashDeposit" data-toggle="tab"> مقبوضات نقدية عن طريق البنك</a></li>
                                                <li class=""><a id="tab07"  href="#tab_onecustomer" data-toggle="tab">إجمالى مشتريات عميل واحد</a></li>
                                                <li class=""><a id="tab08"  href="#tab_totalcustomersData" data-toggle="tab">إجمالى مشتريات العملاء</a></li>
                                                <li class=""><a id="tab09"  href="#tab_deferredBills" data-toggle="tab">  الفواتير المعلقة </a></li>
                             <li class=""><a id="tab10"  href="#tab_endDealBills" data-toggle="tab">  ارباح وخسائر الفواتير المعلقة    </a></li>

                                                <!-- <li class=""><a id="tab11"  href="#tab_CustomersBills" data-toggle="tab"> كشف حساب عميل</a></li> -->
												    
                                            </ul>
                                        </div>
                                    <div class="panel-body">
                                        <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;direction:rtl;padding:10px;">
                                            <div class="tab-pane active" id="tab_opening">
                                                <p>تحميل ...</p>
                                            </div>
                                            <div class="tab-pane  " id="tab_customerDiscount">
                                              <p>تحميل ...</p>
                                            </div>
                                            <div class="tab-pane  " id="tab_cashDeposit">
                                                <p>تحميل ...</p>
                                            </div>
                                            <div class="tab-pane " id="tab_checkDeposit">
                                                <p>تحميل ...</p>
                                            </div>
                                            <div class="tab-pane" id="tab_customerRefund">
                                                <p>تحميل  ...</p>
                                            </div>     
                                            <div class="tab-pane" id="tab_BanckCashDeposit">
                                                <p>تحميل  ...</p>
                                            </div>
                                            <div class="tab-pane " id="tab_onecustomer">
                                                <p>تحميل ...</p>
                                            </div>
                                            <div class="tab-pane  " id="tab_totalcustomersData">
                                                <p>تحميل ...</p>
                                            </div> 
                                            <div class="tab-pane " id="tab_deferredBills">
                                                <p>تحميل ...</p>
                                                 </div>
                                            <div class="tab-pane " id="tab_endDealBills">
                                                <p>تحميل ...</p>
                                                 </div>

                                            <div class="tab-pane " id="tab_CustomerAccountStatement">
                                                <p>تحميل ...</p>
												 </div>
											<!-- 	<div class="tab-pane " id="tab_CustomersBills">
                                                <p>تحميل ...</p>
												 </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    @endsection

    @section('footer_script')

 		<script src={{asset ("/plugins/datatables/jquery.dataTables.js")}} type="text/javascript"></script>
        <script src={{asset("/plugins/select2-4.0.0/dist/js/select2.full.min.js")}}></script>
       <script src={{asset("/plugins/jQueryUI/jquery-ui-1.11.4.min.js")}}></script>
       <!-- <script src={{asset("/plugins/datatables/dataTables.tableTools.js")}} type="text/javascript"></script> -->
          <script src={{asset("//cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js")}} type="text/javascript"></script>
    <script src={{asset('plugins/datatables/dataTables.bootstrap.js')}} type="text/javascript"></script>
    <script src={{asset("//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf")}} type="text/javascript"></script>

        
        <script type="text/javascript">
            // $("[data-widget='collapse']").click(function() {
            //     //Find the box parent        
            //     var box = $(this).parents(".box").first();
            //     //Find the body and the footer
            //     var bf = box.find(".box-body, .box-footer");
            //     if (!box.hasClass("collapsed-box")) {
            //         box.addClass("collapsed-box");
            //         bf.slideUp();
            //     } else {
            //         box.removeClass("collapsed-box");
            //         bf.slideDown();
            //     }
            // });


            $('#tab_opening').load("{{('customeropeningbalance')}}");
            $('#tab_customerDiscount').load("{{('customersdiscount')}}");
            $('#tab_cashDeposit').load("{{('cashdeposit')}}");
            $('#tab_checkDeposit').load("{{('checkdeposit')}}");
            $('#tab_customerRefund').load("{{('customerrefund')}}");
            $('#tab_onecustomer').load("{{('onecustomer')}}");
            $('#tab_totalcustomersData').load("{{('totalcustomersdata')}}");
            $('#tab_deferredBills').load("{{('deferredbills')}}");
            $('#tab_BanckCashDeposit').load("{{('bankcashdeposit')}}");
            $('#tab_endDealBills').load("{{('enddealbills')}}");
            // $('#tab_CustomersBills').load("{{('customersbills')}}");

//               
//      $("#tab01").click(function(){
////           alert("open");
//        
//   $('#tab_opening').load("{{('customeropeningbalance')}}");
//});  
//            
//    $("#tab02").click(function(){
////           alert("open");
//          $('#tab_customerDiscount').load("{{('customersdiscount')}}");
//
//        
//});
//            
//      $("#tab03").click(function(){
////           alert("open");
//          $('#tab_cashDeposit').load("{{('cashdeposit')}}");
//
//        
//});       
//            
//      $("#tab04").click(function(){
////           alert("open");
//        
//  $('#tab_checkDeposit').load("{{('checkdeposit')}}");
//        
//});
//                  $("#tab05").click(function(){
////           alert("open");
//         $('#tab_customerRefund').load("{{('customerrefund')}}");
//
//        
//});
//            
//      $("#tab06").click(function(){
////           alert("open");
//        
//          
//  $('#tab_BanckCashDeposit').load("{{('bankcashdeposit')}}");
//
//        
//});            
//        
//      $("#tab07").click(function(){
////           alert("open");
//        $('#tab_onecustomer').load("{{('onecustomer')}}");
//
//        
//});
// $("#tab08").click(function(){
////           alert("open");
//        
//$('#tab_totalcustomersData').load("{{('totalcustomersdata')}}");
//        
//});
//
//            
//      $("#tab09").click(function(){
////           alert("open");
//        
// $('#tab_deferredBills').load("{{('deferredbills')}}");
//        
//}); 
//            
//            
//      $("#tab10").click(function(){
////           alert("open");
//        
//  $('#tab_endDealBills').load("{{('enddealbills')}}");
//        
//});       
//            $("#tab11").click(function(){
////         alert("open");
//          $('#tab_CustomersBills').load("{{('customersbills')}}");
//
//        
//});             
        </script>
 
        </script>
<script> 
$(document).ready(function(){    
    $("br").removeClass("hide");
$("#link12").addClass("hoverlink");
});
</script>


    @endsection