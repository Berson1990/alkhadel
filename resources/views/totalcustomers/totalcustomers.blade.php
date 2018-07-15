@extends('adminnoheader.noheader')
@section('content')

        <script src={{asset("/dist/js/admin/totalcustomers.js")}} type="text/javascript"></script>
<!--
        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="/plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>
-->
		<script src="{{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}"></script>
<!--        <script src="/plugins/jQueryUI/jquery-ui-1.11.4.min.js"></script>-->


<!--select css-->
 <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<!--seelct css-->
<style>
							.fontDesign{
							font-size: 18px;
							font-wight:bold;
                            
							}
@media print{
    #firstPart2{
        height: 20px;
    }

    #search-TotalCustomers{
        display: none;
    }
}
    
    
</style>
        <section class="content">
            <div class="row">
                <div class="col-md-12 show" >
                    <div class="box box-success">
                        
                        <div class="box-header">
                            <h3 class="box-title">عرض مشتريات الموردين(فلاحين) </h3>
                        </div>
                        <div class="box-body">
                            <div id="firstPart2" class="row">
                                
                                <div id="totalcustomers-repo-form" style="width: 60%" class="container col-xs-5">   
                                    <span class="fontDesign">من: </span>
                                    <input name="FromTransDate" id="fromdate"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <span class="fontDesign">الى: </span>
                                    <input name="ToTransDate" id="todate"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
									<br />
                                    
                                    <label  class="fontDesign" id="check_label">
                                          <input type="checkbox" value="1" name="isCustomer" id="check_enable" checked>اختيار التاجر 
                                    </label>
    								<div id="hideOnPrint"> 
                                    <select   name="CustomerID" 
                                            style="width:100%" 
                                            data-placeholder="اسم التاجر" 
                                            id="TotalCustomerID"
                                             
                                              dir='rtl'>
                                  
                                        </select>
                                        <br />
                                      

        <input type="checkbox" value="1"  name="SuppliersTypes" id="Check_Supplier" checked>
       <label  class="fontDesign" id="check_label">  اختيار نوع المورد  </label>                                  
                                        
                                        
                                        <br />  
                                        <select name="SupplierTypeID"
                                                style="width:100%"
                                                data-palceholder = "نوع المورد"
                                                id="SupplierType" 
                                                
                                                dir='rtl'>
                                        <option value="0"> محلى </option>
                                        <option value="1"> خارجى </option>
                                        
                                        </select>
                                        
                                    </div>
									<br />
                                    
                                    <div style="display: none" id="ShowONPrint"></div>
                                    
                                    <input class="radio-inline" id="rbtnIndividuale" onclick="individuale()" checked type="radio" name="rbtn" data-title="تفصيل" value="0"  />

                                    <label class="radio-inline fontDesign" id="indi" for="rbtnIndividuale" >تفصيل</label>
<!--                                    <label class="radio-inline" for="rbtnCustomerType">تفصيل</label>-->


                                    <input class="radio-inline" id="rbtnCombine" onclick="combine()" type="radio" name="rbtn" data-title="تجميع" value="1" />
                                   

                                    <label class="radio-inline fontDesign" id="comb" for="rbtnCombine">تجميع</label>
                                    
                                    
            <input class="radio-inline" id="rbtnCombineProduct" onclick="combinePro()" type="radio" name="rbtn" data-title="تجميع" value="2" />
                                   

                                    <label class="radio-inline fontDesign" id="combPRo" for="rbtnCombine">  تجميع بالمنتجات </label>                                    
<!--                                    <label class="radio-inline" for="rbtnProuductName">تجميع</label>-->
                                      {{--  
                                        <label id="check_Customers">
                                          <input type="checkbox" value="showCustomers" onclick="checking()" id="check">عرض اسم التاجر 
                                        </label>
                                      --}}
                                    <br /><br />
                                    <button id="search-TotalCustomers" class="show btn btn-success btn-flat btn-block" type="button"><b>بحث</b></button> 
                                </div>
                                
                                
                                
                                <div style="width: 35%; height: inherit"  id='SuTypeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
        <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">المشتريات</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-TotalCustomers" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                            
                                <thead>
                                    <tr>
										
                                       
                                        <th class="hidecombine2 c_pro">العلامة </th>
                                        <th class="hidecomb c_pro"> اسم المورد</th>
                                        <th class="hidecombine2 ">الصنف</th>
                                        <th class="hidecombine2"> الوزن</th>
                                        <th class="hidecombine2">العدد</th>
                                        <th class="hidecombine2 c_pro">السعر</th>
                                        <th >الاجمالى</th>
                                        <th style="display:none;" class="c_pro">Supplier ID</th>
                                        <th class="hidecombine2 c_pro">التاجر</th>
                                        
                                    </tr>
                                </thead>
                                 <tbody></tbody>
                                <tfoot>
                                    <tr>
									
                                        <th class="hidecombine2 c_pro">العلامة </th>
                                        <th class="hidecomb c_pro"> اسم المورد</th>
                                        <th class="hidecombine2 ">الصنف</th>
                                        <th class="hidecombine2 "> الوزن</th>
                                        <th class="hidecombine2 ">العدد</th>
                                        <th class="hidecombine2 c_pro">السعر</th>
                                        <th id="total">الاجمالى</th>
                                        <th style="display:none;" class="c_pro" >SupplierID</th>
                                        <th class="hidecombine2 c_pro">التاجر</th>
                                    </tr>
                                </tfoot >
                            </table>
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
                 <!-- abstract -->

                 <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> اجماليات مبيعات الفلاحين </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table  id="tbl-abstractSupplers" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                            
                                <thead>
                                    <tr>
                                        <th>اسم المورد  </th>
                                        <th> اجمالى الوزن   </th>
                                        <th>اجمالى العدد   </th>
                                        <th >اجمالى مبيعاتة  </th>
                                
                                    </tr>
                                </thead>
                                 <tbody></tbody>
                                <tfoot>
                                    <tr >
                                        <th>التاجر </th>
                                         <th> اجمالى الوزن </th>
                                        <th>اجمالى العدد </th>
                                        <th >اجمالى مبيعاتة </th>
                                    
                                    
                                    </tr>
                                </tfoot >
                            </table>
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
                <!--  -->
            </div><!-- /.row -->


        </section><!-- /.content -->
        
@endsection    