<!--just screen no model  --> 
@extends('adminheader.header')


    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-5"></div> 
                            <div  class="col-lg-2  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >  شـــاشــه المـــوردين </h3>
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
<!--                            <h3 class="box-title">كل ما يتعلق بحسابات الموردين</h3>-->
                        </div>
                        <div class="box-body">
                        

                                <div class="row" style="margin:10px;">
                                    <div class="panel with-nav-tabs panel-primary" style="margin-bottom: 18px;direction: ltr;">
                                        <div class="panel-heading">
                                            <ul class="nav nav-tabs">
                                                
                                               <li class="active"><a id="tab1" href="#tab_opening" data-toggle="tab">رصيد بداية الحساب</a></li>
                                               <li class=""><a  id="tab2"  href="#tab_supplierDiscount" data-toggle="tab">الخصم المكتسب </a></li>
                                               <li class=""><a  id="tab3"  href="#tab_cashPayments" data-toggle="tab">المدفوعات النقديه</a></li>                                                             <li class=""><a id="tab4"   href="#tab_checkPayments" data-toggle="tab">المدفوعات شيكات</a></li>
                       
<li class=""><a  id="tab5"  href="#tab_supplierRefund" data-toggle="tab">مرتجع نقدى</a></li>
	<li class=""><a id="tab6" href="#tab_SettlementSuppliersAccount" data-toggle="tab">   تصفية حساب الموردين  </a></li>
												
                                               <li class=""><a id="tab7"   href="#tab_oneTotalSuppliers" data-toggle="tab">اجمالى مشتريات مورد واحد</a></li>
                                               <li class=""><a id="tab8"   href="#tab_TotalCustomers" data-toggle="tab">اجمالى مشتريات الموردين</a></li>
                                               <!-- <li class=""><a  id="tab9"  href="#tab_SupplierBills" data-toggle="tab">    كشف حساب الموردين المحليين </a></li> -->
												<li class=""><a id="tab10"   href="#tab_ForeignSuppliers" data-toggle="tab">الموردين الخارجيين </a></li>
												<!-- <li class=""><a id="tab11"   href="#tab_ForeignSuppliersstatment" data-toggle="tab"> كشف حساب الموردين الخارجيين  </a></li> -->

<!--                                                <li class=""><a href="#tab_accountstatement" data-toggle="tab">كشف حساب المورد </a></li>-->

                                                
                                            </ul>
                                        </div>
                                    <div class="panel-body">
                                        <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;direction:rtl;padding:10px;">
                                            
                                            <div class="tab-pane  active" id="tab_opening">
                                                <p>تحميل ...</p>
                                            </div>
                                            
                                            <div class="tab-pane" id="tab_supplierDiscount">
                                              <p>تحميل ...</p>
                                            </div>
                                            
                                            <div class="tab-pane " id="tab_cashPayments">
                                                <p>تحميل ...</p>
                                            </div>
                                            
                                            <div class="tab-pane  " id="tab_checkPayments">
                                                <p>تحميل ...</p>
                                            </div>
                                            
                                            <div class="tab-pane " id="tab_supplierRefund">
                                                <p>تحميل  ...</p>
                                            </div>
											
											<div class="tab-pane  " id="tab_SettlementSuppliersAccount">
                                                <p>تحميل...</p>
                                            </div>
                                            
                                            <div class="tab-pane" id="tab_oneTotalSuppliers">
                                                <p>تحميل  ...</p>
                                            </div>
                                            
                                            <div class="tab-pane " id="tab_TotalCustomers">
                                                <p>تحميل...</p>
                                            </div>
                                         <!--    <div class="tab-pane  " id="tab_SupplierBills">
                                                <p>تحميل...</p>
                                            </div> -->
											<div class="tab-pane  " id="tab_ForeignSuppliers">
                                                <p>تحميل...</p>
                                            </div>
                                        <!--     <div class="tab-pane  " id="tab_ForeignSuppliersstatment">
                                                <p>تحميل...</p>
                                            </div> -->

<!--
                                            <div class="tab-pane  " id="tab_accountstatement">
                                                <p>تحميل...</p>
                                            </div>
-->
											
                                            
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

<script src={{asset('plugins/datatables/jquery.dataTables.js')}} type="text/javascript"></script>
<!-- <script src={{asset("/plugins/datatables/dataTables.tableTools.js")}} type="text/javascript"></script> -->
<script src={{asset('/plugins/select2-4.0.0/dist/js/select2.full.min.js')}}></script>
<script src={{asset('plugins/datatables/dataTables.bootstrap.js')}} type="text/javascript"></script>
    <script src={{asset("//cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js")}} type="text/javascript"></script>
   <script src={{asset("//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf")}} type="text/javascript"></script>
<!--        <script src={{asset("/plugins/jQueryUI/jquery-ui-1.11.4.min.js")}}></script>-->
<!--    <script src={{asset('plugins/jQuery/jQuery-2.1.3.min.js')}}></script>-->
<!--    <link href={{asset('plugins/datatables/dataTables.bootstrap.css') }} rel="stylesheet" type="text/css" />-->
<!-- <link href={{asset('plugins/jQueryUI/jquery-ui.min.css')}} rel="stylesheet">-->
        <script type="text/javascript">
          


            $('#tab_opening').load("{{('supplieropeningbalance')}}");
            $('#tab_supplierDiscount').load("{{'suppliersdiscount'}}");
            $('#tab_cashPayments').load("{{('cashpayment')}}");
            $('#tab_checkPayments').load("{{('checkpayment')}}");
			$('#tab_supplierRefund').load("{{('supplierrefund')}}");
			$('#tab_SettlementSuppliersAccount').load("{{('settlementsuppliersaccount')}}");
            $('#tab_oneTotalSuppliers').load("{{('onetotalsuppliers')}}",function(){console.log('loaDD');});
            $('#tab_TotalCustomers').load("{{('totalcustomers')}}",function(){console.log('loadeddddd');});
             // $('#tab_SupplierBills').load("{{('supplierbills')}}",function(){console.log('loadeddddd');});  
            $('#tab_ForeignSuppliers').load("{{('foreignsuppliers')}}" ,function(){reloadcbo();});
   //          $('#tab_ForeignSuppliersstatment').load("{{('foreignsuppliersstatment')}}" );
			// $('#tab_accountstatement').load('/supplieraccountstatement',function(){console.log('accountstatement');});
         

//   
//      $("#tab1").click(function(){
////           alert("open");
//        
//
//          $("#tab_opening").load("{{('supplieropeningbalance')}}");     
//});
//            
//            
//      $("#tab2").click(function(){
////           alert("open");
//        
//
//             $('#tab_supplierDiscount').load("{{'suppliersdiscount'}}");
//});
//                  
//            
//      $("#tab3").click(function(){
////           alert("open");
//        
//
//           $('#tab_cashPayments').load("{{('cashpayment')}}");
//});
//                  
//      $("#tab4").click(function(){
////           alert("open");
//        
//
//            $('#tab_checkPayments').load("{{('checkpayment')}}");
//});
//            
//      $("#tab5").click(function(){
////           alert("open");
//        
//
//       $('#tab_supplierRefund').load("{{('supplierrefund')}}");
//          
//      });
//         
//      $("#tab6").click(function(){
////           alert("open");
//        
//
//       $('#tab_SettlementSuppliersAccount').load("{{('settlementsuppliersaccount')}}");
//});
//      
//      $("#tab7").click(function(){
////           alert("open");
//        
//
//          $('#tab_oneTotalSuppliers').load("{{('onetotalsuppliers')}}",function(){console.log('loaDD');});
//});
//                  
//      
//      $("#tab8").click(function(){
////           alert("open");
//        
//  $('#tab_TotalCustomers').load("{{('totalcustomers')}}",function(){console.log('loadeddddd');});  
//});
//     
//            
//      $("#tab9").click(function(){
////           alert("open");
//        
//
//          $('#tab_SupplierBills').load("{{('supplierbills')}}",function(){console.log('loadeddddd');});  
//});
//                  
//      $("#tab10").click(function(){
////           alert("open");
//        
//
//        $('#tab_ForeignSuppliers').load("{{('foreignsuppliers')}}" ,function(){reloadcbo();}); 
//});
//          
//          
//      $("#tab11").click(function(){
////           alert("open");
//        
//
//      $('#tab_ForeignSuppliersstatment').load("{{('foreignsuppliersstatment')}}" );
//});
          
                    
                  
            //2
//            setTimeout(function(){
//                 $('#tab_supplierDiscount').load("{{'suppliersdiscount'}}");            
//                        },
//                      2000);  
//            //3
//            setTimeout(function(){ 
//                  $('#tab_cashPayments').load("{{('cashpayment')}}");         
//                        },
//                       3000);
//          
//            //4   
//                 setTimeout(function(){
//                   $('#tab_checkPayments').load("{{('checkpayment')}}");
//                        },
//                       3000);
//                
//           //5
//            
//                     setTimeout(function(){ 
//                   ('#tab_supplierRefund').load("{{('supplierrefund')}}");
//                        },
//                       3000);
//        //6
//            
//               setTimeout(function(){
//               $('#tab_SettlementSuppliersAccount').load("{{('settlementsuppliersaccount')}}");
//                        },
//                       300);
//            
//            //7
//            
//            
//               setTimeout(function(){ 
//             $('#tab_oneTotalSuppliers').load("{{('onetotalsuppliers')}}",function(){console.log('loaDD');});
//                        },
//                       6000);
//         
//            
//            //8
//            
//               setTimeout(function(){ 
//              $('#tab_TotalCustomers').load("{{('totalcustomers')}}",function(){console.log('loadeddddd');});
//                        },
//                       7000);
//            
//            
//            //9
//            setTimeout(function(){ 
//            $('#tab_SupplierBills').load("{{('supplierbills')}}",function(){console.log('loadeddddd');})
//                        },
//                       8000);
//            
//            
//            //10
//            
//                   setTimeout(function(){
//              $('#tab_ForeignSuppliers').load("{{('foreignsuppliers')}}" ,function(){reloadcbo();});
//                        },
//                       9000);
//
//            //11
//            
//                     setTimeout(function(){ 
//                 $('#tab_ForeignSuppliersstatment').load("{{('foreignsuppliersstatment')}}" );
//                        },
//                       10000);
        </script>

<script> 
$(document).ready(function(){    
$("#link13").addClass("hoverlink");
});
</script>

    @endsection