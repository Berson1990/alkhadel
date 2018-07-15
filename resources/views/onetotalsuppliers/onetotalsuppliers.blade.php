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

                            @media print{

                                #firstTpart1{

                                    height: 20px;
                                }
                                #search-OneTotalSuppliers{
                                    display:none;
                                }
                            }

</style>

        <script src={{asset("/dist/js/admin/onetotalsuppliers.js")}} type="text/javascript"></script>
<!--
        <script src={{asset("/plugins/datatables/jquery.dataTables.js")}} type="text/javascript"></script>
        <script src={{asset("/plugins/datatables/dataTables.tableTools.js")}} type="text/javascript"></script>
-->
	<script src={{asset('/plugins/select2-4.0.0/dist/js/select2.full.min.js')}}></script>
<!--        <script src={{asset("/plugins/jQueryUI/jquery-ui-1.11.4.min.js")}}></script>-->


<!--select css-->
 <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<!--seelct css-->
        <section class="content">
            <div class="row">
                <div class="col-md-12 show" >
                    <div class="box box-success">
                        
                        <div class="box-header">
                            <h3 class="box-title">عرض مشتريات مورد(فلاح) واحد</h3>
                        </div>
                        <div class="box-body ">
                            <div id="firstTpart1" class="row">
                                <div id="onetotalsuppliers-repo-form" style="width: 60%" class="container col-xs-5">

                                
                                    <span class="fontDesign">من: </span>
                                    <input name="FromTransDate"   class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <span class="fontDesign">الى: </span>
                                    <input name="ToTransDate"   class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
									<br/> 
                                      <div style="display: none" id="ShowCustomerONPrint"></div>
                                       <div style="display: none; " id="ShowSupplierONPrint"></div>
                                    
                                    <!--customers -->
                                    <!--checkcustomers  onclick="checking(this)"-->
                                    
                                          <input name="checkCustomers" type="checkbox" value="1" checked id="check_customers" /> 
                                           <label class="fontDesign" id="check_customer">إختيار التاجر </label>
                                        <!--  -->
									                                                                   	<br/>
									                                                                   	

                                    <div id="hiddenOnPrint">
                                    <select name="CustomersID" 
                                            style="width:100%" 
                                         
                                            data-placeholder="اسم التاجر" 
                                         
                                            id="TotalCustomersID">
                                     
                                        </select>
                           <!--suppliers -->        
                                                                   	<br />
                                                                   	<br />

                                     <select name="SupplierID" 
                                            style="width:100%" 
                                          
                                            data-placeholder="اسم المورد" 
                                          
                                            id="TotalSupplierID">
                              
                                        </select>
                                    
                                     </div>
                                   	<br/>
                                    <input class="radio-inline" id="rbtnIsndividualeone" onclick="individuale()" type="radio" name="Individuale" data-title="تفصيل" value="1" checked  />

                                    <label class="radio-inline fontDesign" id="iname"for="rbtnIndividualeone">تفصيل</label>
<!--                                    <label class="radio-inline" for="rbtnCustomerType">تفصيل</label>-->

                                    <input class="radio-inline " id="rbtnCombineone" onclick="combine()"type="radio" name="Individuale" data-title="تجميع" value="2" />
                                   

                                    <label class="radio-inline fontDesign" id="cname"for="rbtnCombineone">تجميع</label>
<!--                                    <label class="radio-inline" for="rbtnProuductName">تجميع</label>-->
                                       
                                        <!--<label>
                                          <input type="checkbox">عرض اسم التاجر 
                                        </label>-->
                                     
                                    <br /><br />
                                    <button id="search-OneTotalSuppliers" class="show btn btn-success btn-flat btn-block" type="button"><b>بحث</b></button> 
                                </div>
                                <div style="width: 35%; height: inherit"  id='SuTypeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
        <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">عرض مشتريات مورد معين </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-OneTotalSuppliers" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                    <th class="hideincomine">التاريخ </th>
                                    <th class="hidecombine2">اسم التاجر  </th>
                                    <th class="hidecombine2">اسم الصنف</th>
                                    <th class="hidecombine2">العلامة </th>
                                    <th class="hidecombine2" > الوزن</th>
                                    <th class="hidecombine2">العدد</th>
                                    <th class="hidecombine2">السعر</th>
                                    <th > الاجمالى </th>
                                   
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                            <tr>
							  <th class="hideincomine">التاريخ </th>
                              <th class="hidecombine2">اسم  التاجر  </th>
                              <th class="hidecombine2">اسم الصنف</th>
                              <th class="hidecombine2">العلامة </th>
                              <th class="hidecombine2"> الوزن</th>
                              <th class="hidecombine2">العدد</th>
                              <th class="hidecombine2">السعر</th>
                              <th class="total"> الاجمالى </th>
                              
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