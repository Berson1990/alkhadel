<!--just screen no model  --> 
@extends('adminheader.header')


    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-5"></div> 
                            <div  class="col-lg-2  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >  شـــاشــه المستخلصين </h3>
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
                                                
                    <li class="active"><a href="#tab_opening" data-toggle="tab">رصيد بداية الحساب</a></li>
                    <li class=""><a href="#tab_Customepayment" data-toggle="tab">دفعات المستخلصين </a></li>
                    <li class=""><a href="#tab_CustomRefund" data-toggle="tab"> مرتجعات المستخلصين  </a></li>                                                            
<!--
                                                <li class=""><a href="#tab_checkPayments" data-toggle="tab">المدفوعات شيكات</a></li>
                       
<li class=""><a href="#tab_supplierRefund" data-toggle="tab">مرتجع نقدى</a></li>
	<li class=""><a href="#tab_SettlementSuppliersAccount" data-toggle="tab">   تصفية حساب الموردين  </a></li>
												
                                               <li class=""><a href="#tab_oneTotalSuppliers" data-toggle="tab">اجمالى مشتريات مورد واحد</a></li>
                                               <li class=""><a href="#tab_TotalCustomers" data-toggle="tab">اجمالى مشتريات الموردين</a></li>
                                               <li class=""><a href="#tab_SupplierBills" data-toggle="tab">    كشف حساب الموردين المحليين </a></li>
												<li class=""><a href="#tab_ForeignSuppliers" data-toggle="tab">الموردين الخارجيين </a></li>
												<li class=""><a href="#tab_ForeignSuppliersstatment" data-toggle="tab"> كشف حساب الموردين الخارجيين  </a></li>
-->

<!--                                                <li class=""><a href="#tab_accountstatement" data-toggle="tab">كشف حساب المورد </a></li>-->

                                                
                                            </ul>
                                        </div>
                                    <div class="panel-body">
                                        <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;direction:rtl;padding:10px;">
                                            
                                            <div class="tab-pane  active" id="tab_opening">
                                                <p>تحميل ...</p>
                                            </div>
                                            
                                           <div class="tab-pane" id="tab_Customepayment">
                                              <p>تحميل ...</p>
                                            </div>
                                            
                                            <div class="tab-pane " id="tab_CustomRefund">
                                                <p>تحميل ...</p>
                                            </div>
                                            
<!--
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
                                            <div class="tab-pane  " id="tab_SupplierBills">
                                                <p>تحميل...</p>
                                            </div>
											<div class="tab-pane  " id="tab_ForeignSuppliers">
                                                <p>تحميل...</p>
                                            </div>
                                            <div class="tab-pane  " id="tab_ForeignSuppliersstatment">
                                                <p>تحميل...</p>
                                            </div>
-->

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
<script src={{asset ('plugins/jQueryUI/jquery-ui-1.11.4.min.js')}}></script>
<script src={{asset("/plugins/datatables/dataTables.tableTools.js")}} type="text/javascript"></script>
<script src={{asset("/plugins/select2-4.0.0/dist/js/select2.full.min.js")}}></script>
<script src={{asset('plugins/datatables/dataTables.bootstrap.js')}} type="text/javascript"></script>
<!-- <script src={{asset ("/plugins/jQueryUI/jquery-ui-1.11.4.min.js")}}></script>-->


        <script type="text/javascript">
           $('#tab_opening').load("{{('customopeningbalance')}}");
            $('#tab_Customepayment').load("{{'customepayment'}}");
            $('#tab_CustomRefund').load("{{'customrefund'}}");
            // $('#tab_CustomeReport').load("{{('customsreport')}}");

         
            

    
    
//    $(document).ready(function(){
//    
//    
//     $( ".datepicker" ).datepicker({
//            dateFormat: 'yy/mm/dd',
//            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
//
//        });
//	
//    
//})


        </script>

<script> 
$(document).ready(function(){    
$("#link26").addClass("hoverlink");
});
</script>

    @endsection