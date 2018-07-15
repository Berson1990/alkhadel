@extends('adminheader.header')
    @section('header')
  <section class="content-header">
        <div class="row">
        <div class="container">

                            <div class="col-lg-4 col-xs-4"></div> 
                            <div  class="col-lg-4 col-xs-4 btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >تقرير الموردين المحليين    </h3>
                            </div>
                             <div class="col-lg-4 col-xs-4"></div>
                    </div>
                    </div>
        </section>
    @endsection

@section('content')
<style>
tr.group,
div.dataTables_paginate ul.pagination {
margin: -1px 0;
white-space: nowrap;
padding-top:11px;
}

tr.group:hover {
    background-color: #ddd !important;
}
    #check_customer{
    /*margin:10px 0 0 0;*/
    }    
	
						.fontDesign{
							font-size: 18px;
							font-wight:bold;
							}

                 @media print{
                          #tohide{
                            display:none;
                          }
                        }
</style>

<script src={{asset("/dist/js/admin/supplierbills.js")}} type="text/javascript"></script>
<script src={{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}></script>
<script src={{asset('plugins/datatables/jquery.dataTables.js')}} type="text/javascript"></script>
<script src={{asset("/plugins/datatables/dataTables.tableTools.js")}} type="text/javascript"></script>
<script src={{asset('plugins/datatables/dataTables.bootstrap.js')}} type="text/javascript"></script>

<script type="text/javascript">
  /*add date biacker */
  $(document).ready(function(){
  $( ".datepicker" ).datepicker({
   dateFormat: 'yy/mm/dd',
currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
     
}); 
    
 $(".datepicker").datepicker('setDate', new Date()); 
});


</script>
<!--select css-->
 <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<!--seelct css-->


        <section class="content">
            <div class="row">
                <div class="col-md-12 show" >
                    <div class="box box-success">
                        
                        <div class="box-header">
                            <h3 class="box-title">عرض فواتير مورد(فلاح) </h3>
                        </div>
                        <div class="box-body ">
                            <div class="row">
                                <div id="supplierbills-repo-form" style="width: 60%" class="container col-xs-5">
                                  <label id="suppliers_opening_date"></label>
                                  <br>
                                  <label id="suppliers_openingBalnce_Mount"></label>
                                  <br>
                                    <span class="fontDesign">من: </span>
                                    <input name="FromTransDate"   class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <span class="fontDesign">الى: </span>
                                    <input name="ToTransDate"   class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    
                                    <!--customers -->
                      <br />
                             
                           <!--suppliers -->        
                              <label  class="fontDesign" id="SName">اسم المورد</label>
                                 <div style="display: none; " id="ShowSONPrint"></div>
									
                           
                              <label id="SupName"></label>
									
									  <div id="hiddenPrint">  
                                     <select name="SupplierID" 
                                            style="width:100%" 
                                            data-placeholder="اسم المورد" 
                                            id="supplierbills">
                                        </select>
                                    </div> 
                                       <br />
                                   
                                    <input class="radio-inline " id="rbtnIsndividuale" onclick="individuale()" type="radio" name="rbtn" data-title="تفصيل" value="1" checked  />
										
                                    <label class="radio-inline fontDesign" id="inname"for="rbtnIndividuale">تفصيل</label>
<!--                                    <label class="radio-inline" for="rbtnCustomerType">تفصيل</label>-->

                                    <input class="radio-inline " id="rbtnComb" onclick="combine()"type="radio" name="rbtn" data-title="تجميع" value="2" />
                                   

                                    <label class="radio-inline fontDesign" id="comname"for="rbtnCombine">تجميع</label>
<!--                                    <label class="radio-inline" for="rbtnProuductName">تجميع</label>-->
                                       
                                        <!--<label>
                                          <input type="checkbox">عرض اسم التاجر 
                                        </label>-->
                                     
                                    <br /><br />
                                    <button id="search-supplierbills" onclick="" class="show btn btn-success btn-flat btn-block" type="button"><b>بحث</b></button> 
                                </div>
                                <div style="width: 35%; height: inherit"  id='SuTypeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
                
                
            <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header Tabletitla">
                            <h3 class="box-title">عرض فواتير المورد </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-SupplierReport" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
								                    <th class=""> التاريخ</th>		
								                    <th class="hidecombine3"> اسم التاجر </th>		
                                    <th class="hidecombine3">اسم الصنف</th>
                                    <th class="hidecombine3"> الوزن</th>
                                    <th class="hidecombine3">العدد</th>
                                    <th class="hidecombine3">السعر</th>
                                    <th class=""> الاجمالى</th>
                                </tr> 
                                </thead>
                                
                                 <tbody>
                                </tbody>
                                 
                                 <tfoot>
                            <tr>
                              <th >التاريخ </th>
                              <th  class="hidecombine3">اسم التاجر  </th>
                              <th class="hidecombine3">اسم الصنف</th>
                              <th class="hidecombine3"> الوزن</th>
                              <th class="hidecombine3">العدد</th>
                              <th class="hidecombine3">السعر</th>
                              <th id="fibaltotalbils"> الاجمالى </th>
                              
                           </tr>
                                </tfoot>
                                
                                
                            </table>
                        <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->


               
                <!--Supplier report -->
                
                <!--Bills  -->
                  <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header Tabletitla">
                            <h3 class="box-title">عرض اجمالى الفواتير</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-Bills" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                    <th class="">اجمالى الفواتير </th>
                                    <th class=""> العموله</th>
                                    <th class="">قلميه</th>
                                     <th class="">صافى الفواتير </th>
                                </tr>
                                </thead>
                                
                                 <tbody>
                                </tbody>
                                
                                 <tfoot>
                            <tr>
                              <th class="">اجمالى الفواتير </th>
                              <th class=""> العموله </th>
                              <th class=""> قلميه </th>
                              <th class=""> صافى الفواتير </th>
                         
                           </tr>
                                </tfoot>
                                
                                
                            </table>
                        <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
                <!--Bills end -->
                

                <!--Supplier Payment -->
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header Tabletitla">
                            <h3 class="box-title">عرض مدفوعات المورد </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-SupplierPayment" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                    <th class=""> التاريخ</th>
                                    <th class=""> المبلغ </th>
                                    <th class=""> طريقة الدفع</th>
                                    <th class=""> رقم الشيك</th>
                                     <th class=""> ملاحظات</th>
                                </tr>
                                </thead>
                        
                                
                                 <tbody>
                                </tbody>
                                
                                 <tfoot>
                            <tr>
                              <th class=""> </th>
                              <th class="total"> </th>
                              <th class=""> </th>
                              <th class=""> </th>
                              <th class=""></th>
                           </tr>
                                </tfoot>        
                                
                                
                                
                            </table>
                        <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
                
                  
                 <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header Tabletitla">
                            <h3 class="box-title">عرض مرتجعات المورد </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-SupplierRefunds" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                    <th class="">التاريخ</th>
                                    <th class=""> المبلغ</th>
                                    <th class="">البيان</th>
                                    
                                </tr> 
                                </thead>
                                
                                 <tbody>
                                </tbody>
                                 
                                 <tfoot>
                            <tr>
                              <th class=""></th>
                              <th class="total3"> </th>
                              <th class=""></th>
                              
                              
                           </tr>
                                </tfoot>
                                
                                
                            </table>
                        <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->

                 <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header Tabletitla">
                            <h3 class="box-title">عرض خصومات المورد </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-SupplierDiscountss" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                    <th class="">التاريخ</th>
                                    <th class=""> المبلغ</th>
                                    <th class="">البيان</th>
                                    
                                </tr> 
                                </thead>
                                
                                 <tbody>
                                </tbody>
                                 
                                 <tfoot>
                            <tr>
                              <th class=""></th>
                              <th class="total2"> </th>
                              <th class=""></th>
                              
                              
                           </tr>
                                </tfoot>
                                
                                
                            </table>
                        <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
<!--final statment of suppliers start-->
                
     <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title Tabletitla"> تصفيه حساب المورد   </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-finalstatment" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                    <th class="">عليه</th>
                                    <th class="">  له  </th>
                                    <th class="">البيان</th>
                                    
                                </tr> 
                                </thead>
                                
                                 <tbody>
<!--
                                     <td id=""></td>
                                     <td id=""></td>
                                     <td id="finalstatment"></td>
-->
                                     
                                </tbody>
                                 
                                 <tfoot>
                            <tr>
                              <th class=""></th>
                              <th class=""> </th>
                              <th ></th>
<!--                              -->
                              
                           </tr>
                                </tfoot>
                                
                                
                            </table>
                        <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
                
<!--final statment of suppliers end-->
                <style type="text/css">

                  
                        </style>

                {{-- printing buuton --}}
                <div id="tohide" class="col-xs-12">
                    <div class="box">
                       
                        <div class="box-body">
                        

                        <button  onkeyup="myFunction(event)" type="button" id="ptn" onclick="Print()" style="width: 100%;" center class="btn btn-success">طباعة كل الجداول</button>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
                

            </div><!-- /.row -->


        </section><!-- /.content -->
        
@endsection    