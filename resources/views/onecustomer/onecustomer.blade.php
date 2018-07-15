@extends('adminnoheader.noheader')
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

@media print {
       .FirsTPart3 { height: 10px; }
          #search-onecustomer{display:none;}
}
</style>

        <script src={{asset("/dist/js/admin/onecustomer.js")}} type="text/javascript"></script>

<!--        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
<!--        <script src="/plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>-->

 		<script src={{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}></script>
<!--select css-->
 <link	 href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<!-- <link	 href="public/dist/css/fontdesign.css" rel="stylesheet" type="text/css" />-->
<!--seelct css-->

        <section class="content">
            <div class="row">
                <div class="col-md-12 show" >
                    <div class="box box-success">
                        
                        <div class="box-header">
                            <h3 class="box-title">عرض مشتريات عميل واحد</h3>
                        </div>
                        <div class="box-body ">
                            <div class="row FirsTPart3">
                                <div id="onecustomer-repo-form" style="width: 60%" class="container col-xs-5">

                                
                                    <span class="fontDesign">من: </span> 
                                    <input name="FromTransDate" id="datepicker"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <span class="fontDesign">الى: </span>
                                    <input name="ToTransDate"   class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                     
										<br />
                                  
									<div style="display: none" id="ShowCustomerONPrint1"></div>
                                       <div style="display: none; " id="ShowSupplierONPrint1"></div>
                                       <div style="display: none; " id="Showprouduct"></div>
                                    
                                    <!--customers -->
                                    <!--checkcustomers  onclick="checking(this)"-->
                                    
                                        
                                    <div id="hideinprint">
                                    <select name="CustomersID" 
                                            style="width: 100%"
                                          
                                            data-placeholder="اسم التاجر" 
                                           dir="rtl"
                                            id="TotalCustomersID1">
                                      
                                        </select>
                           <!--suppliers --> 
										<br />
                                          <input name="checkCustomers" type="checkbox" value="1"  id="check_customers"  checked /> 
                                           <label class="fontDesign" id="check_customer">إختيار المورد </label>
                                        <!--  -->
									
                                  
                                     <select name="SupplierID" 
											 style="width:100%"
                                              data-placeholder="اسم المورد" 
                                            dir="rtl"
                                            id="TotalSupplierID">
                                   
                                        </select>    
                                        
                                        <br />
                                        <br />
                                        
                                        <select name="ProuductID" 
											 style="width:100%"
                                              data-placeholder="نوع البضاعة" 
                                            id="ProductType"
                                                dir="rtl">
                                        <option > اختار نوع البضاعة  </option>
                                        <option value="0"> محلى  </option>
                                        <option value="1"> مستورد  </option>
                                   
                                        </select>
                                        
                                    </div>
                                     	<br />
                                   
                                   
                                    <input class="radio-inline" id="Individuale" onclick="individuale()"  type="radio" name="rbtn" data-title="تفصيل" value="0" checked="checked" />

                                    <label class="radio-inline fontDesign" id="indi2" for="rbtnIndividuale" >تفصيل</label>
<!--                                    <label class="radio-inline" for="rbtnCustomerType">تفصيل</label>-->


                                    <input class="radio-inline" id="Combine" onclick="combine()" type="radio" name="rbtn" data-title="تجميع" value="1" />
                                   

                                    <label class="radio-inline fontDesign" id="comb2" for="rbtnCombine">تجميع</label>
                       
                                    <br /><br />
										
                                    <button id="search-onecustomer" class="show btn btn-success btn-flat btn-block" type="button"><b>بحث</b></button> 
                                </div>
                                <div style="width: 35%; height: inherit"  id='SuTypeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
        <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">عرض مشتريات عميل معين </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-onecustomer" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                    <th >التاريخ  </th>
                                    <th class="">الصنف</th>
                                    <th >النوع  </th>
                                    <th > العلامة </th>
                                    <th style="display:none" > اسم التاجر </th>
                                    <th class=""> الوزن</th>
                                    <th class="">العدد</th>
                                    <th class="">السعر</th>
                                    <th > الصافي </th>
								    <th  style="display:none;"> المشال  </th>
                                    <th style="display:none;" > النولون  </th>
								    <th style="display:none;"> العهدة  </th>		
                                    <th style="display:none;" > الخصم  </th>
                                    <th class=""> المورد  </th>
                                    <th style="display:none"> نوع    </th>
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                            <tr>
								<th >التاريخ  </th>
                              <th class="">الصنف</th>
								<th>النوع </th>
							  <th > العلامة </th>
                                 <th style="display:none" >  التاجر </th>
                                <th class="" > الوزن</th>
                               <th class="">العدد</th>
                               <th class="">السعر</th>
                                <th id="totaltest" >   الصافي </th>
							    <th style="display:none;"> المشال  </th>
                                <th style="display:none;"> النولون  </th>
							    <th style="display:none;"> العهدة  </th>		
                                <th style="display:none;"> الخصم  </th>
                                <th class="" > المورد </th>
                                <th style="display:none"> نوع  </th>
                           </tr>
                                </tfoot>
                               
                                 
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->


        </section><!-- /.content -->
        
@endsection    