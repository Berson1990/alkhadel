
@extends('adminheader.header')

    @section('header')
  <section class="content-header">
        <div class="row">
              <div class="container">
                            <div class="col-lg-4  col-xs-4"></div> 
                            <div  class="col-lg-4 col-xs-4 btn  btn-warning box-title-heder">
                            <h3 class="box-title  title">تقرير تاجر السفر   </h3>
                            </div>
                             <div class="col-lg-4 col-xs-4"></div>
                    </div>
                    </div>
        </section>
    @endsection



@section('content')
<style>
/*
tr.group,
div.dataTables_paginate ul.pagination {
margin: -1px 0;
white-space: nowrap;
padding-top:11px;
}
*/

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
</style>

<script src={{asset("/dist/js/admin/abordcustomerbills.js")}} type="text/javascript"></script>
<script src={{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}></script>
<script src={{asset('plugins/datatables/jquery.dataTables.js')}} type="text/javascript"></script>
<script src={{asset("/plugins/datatables/dataTables.tableTools.js")}} type="text/javascript"></script>
<script src={{asset('plugins/datatables/dataTables.bootstrap.js')}} type="text/javascript"></script>
<!--        <script src="/plugins/jQueryUI/jquery-ui-1.11.4.min.js"></script>-->


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
                            <h3 class="box-title"> عرض كشف حساب عميل  </h3>
                        </div>
                        <div class="box-body ">
                            <div class="row">
                                <div id="customersbills-repo-form" style="width: 60%" class="container col-xs-5">
                                  <label id="OpenningDate"></label>
                                  <br>
                                  <label id="AccountBalance"></label>
                                  <br>
                                    <span class="fontDesign">من: </span>
                                    <input name="FromTransDate"   class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <span class="fontDesign">الى: </span>
                                    <input name="ToTransDate"   class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    
                                    <!--customers -->
                      <br />
                             
                           <!--suppliers -->        
                                    
                              <label  class="fontDesign" id="SName">اسم العميل </label>
                                    
                                 <div style="display: none; " id="ShowSONPrint"></div>
                                 <div style="display: none; " id="productshow"></div>
									
                           
                              <label id="SupName"></label>
									
									  <div id="hiddenPrint">  
                                     <select name="CustomerID" 
                                            style="width:100%" 
                                            data-placeholder="اسم العميل" 
                                            id="CustomersBills"
                                              dir="rtl" 
                                             >
                                        </select>
                                          
                                     	<br />
                                          	<br />
<input name="checkProuduct" type="checkbox" value="1"  id="check_prodcut"  checked /> 
<label class="fontDesign" id="check_prouduct"> اختيار نوع البضاعة </label>
                                                     
                                        <select name="ProuductID" 
											 style="width:100%"
                                              data-placeholder="نوع البضاعة" 
                                              id="ProductType"
                                                dir="rtl"
                                                class="type_pro_change">
                                       
                                        <option value="0"> محلى  </option>
                                        <option value="1"> مستورد  </option>
                                   
                                        </select>
                                        
                                    </div>
                                     	<br />
                                          
                                          
                                          
                                          
                                          
                                  
                                       <br />
                                    <div id="hideinotherprinttable">
                                    <input class="radio-inline " id="rbtnIsndividuale" onclick="individuale()" type="radio" name="rbtn" data-title="تفصيل" value="1" checked  />
										
                                    <label class="radio-inline fontDesign" id="inname"for="rbtnIndividuale">تفصيل</label>
<!--                                    <label class="radio-inline" for="rbtnCustomerType">تفصيل</label>-->

                                    <input class="radio-inline " id="rbtnComb" onclick="combine()"type="radio" name="rbtn" data-title="تجميع" value="2" />
                                   

                                    <label class="radio-inline fontDesign" id="comname"for="rbtnCombine">تجميع</label>
                                        </div>
<!--                                    <label class="radio-inline" for="rbtnProuductName">تجميع</label>-->
                                       
                                        <!--<label>
                                          <input type="checkbox">عرض اسم التاجر 
                                        </label>-->
                                     
                                    <br /><br />
                                    <button id="search-CustomersBills" onclick="" class="show btn btn-success btn-flat btn-block" type="button"><b>بحث</b></button> 
                                </div>
                                <div style="width: 35%; height: inherit"  id='SuTypeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
                
                
            <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">عرض فواتير العميل </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-CustomersReport" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
									  <th class=""> التاريخ</th>		
									  <th class=""> النوع </th>		
									  <th class=""> العلامة </th>		
									  <th class="">  التاجر  </th>		
                                    <th class=""> الصنف</th>
                                    <th class=""> الوزن</th>
                                    <th class="">العدد</th>
                                    <th class="hidecombine">السعر</th>
                                    <th class=""> الاجمالى</th>
                                    <th class="hidecombine"> المورد  </th>    
                                    <th  style="display:none;"> المشال  </th>
                                    <th style="display:none;" > النولون  </th>
								    <th style="display:none;"> العهدة  </th>		
                                    <th style="display:none;" > الخصم  </th>
                                    <th style="display:none">  نوع   </th>
                                </tr> 
                                </thead>
                                
                                 <tbody>
                                </tbody>
                                 
                                 <tfoot>
                            <tr>
                              <th class="">التاريخ </th>
                             <th class="">  النوع</th>	
                             <th class=""> العلامة  </th>	
                             <th class=""> التاجر  </th>	
                              <th class="">الصنف</th>
                              <th class=""> الوزن</th>
                              <th class="">العدد</th>
                              <th class="hidecombine">السعر</th>
                              <th  id="totalcustomerbills"> اجمالى الصافى   </th>
                              <th class="hidecombine">المورد  </th>    
                                <th  style="display:none;"> المشال  </th>
                                <th style="display:none;" > النولون  </th>
							                 	<th style="display:none;"> العهدة  </th>		
                                 <th style="display:none;" > الخصم  </th>
                                 <th style="display:none"> نوع    </th>
                              
                           </tr>
                                </tfoot>
                                
                                
                            </table>
                        <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->

<!--Customer bills  lase and win  -->

     <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">  عرض فواتير الارباح والخسائر</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-endDealBills" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                    <th >اسم التاجر </th>
                                    <th >التــاريخ </th>
                                    <th >القيمة التقديريه</th>
                                    <th > م. الفاتوره الداخليه</th>
                                    <th > العلامة</th>
                                    <th > ج.الفاتوره الخارجيه  </th> <!-- 1+2-->
                                    <th > القيمة المباعة </th>
                                    <th > م. الفاتوره الخارجيه </th>    
                                    <th > العمولة</th>
                                    <th >الاجمالى </th>
                                    <th >الحاله</th>
                                    <th >صافى الربح او الخسارة </th>
                           
                                   
                                </tr>
                                </thead>
                
                
                <tbody>
                                </tbody>
                
                                 <tfoot>
                            <tr>
                                    <th >اسم التاجر  </th>
                                    <th >التــاريخ </th>
                  <th >القيمة التقديريه</th>
                                    <th > م. الفاتوره الداخليه</th>
                                    <th > العلامة</th>
                                    <th > ج.الفاتوره الخارجيه </th> <!-- 1+2-->
                                    <th > القيمة المباعة </th>
                                    <th > م. الفاتوره الخارجيه </th>   
                                     <th > العمولة</th>
                  <th >الاجمالى </th>
                                    <th >الحاله</th>
                                    <th  class="endtotal">صافى الربح او الخسارة </th>
                               
                           </tr>
                                </tfoot>
                                
                                 
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->   
                

               <!-- Customer Bills end   -->
                <!--Supplier report -->
 

                <!--Supplier Payment -->
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> عرض مقبوضات العميل   </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-CustomersDeposit" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

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
                        <div class="box-header">
                            <h3 class="box-title">عرض مرتجعات العميل </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-CustomersRefund" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

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
                        <div class="box-header">
                            <h3 class="box-title">عرض خصومات العميل </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-CustomersDiscountss" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

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
                
                
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">  الموقف النهائى للعميل </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-FinalCustomers" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                    <th class="">  عليه </th>
                                    <th class="">  له </th>
                                    <th class=""> الصافي </th>
                                    
                                </tr> 
                                </thead>
                                
                                 <tbody>
                                </tbody>
                                 
          
                                
                            </table>
                        <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->


                <style type="text/css">

                        @media print{
                          #tohide{
                            display:none;
                          }
                        }
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