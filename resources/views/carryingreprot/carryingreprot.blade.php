@extends('adminheader.header')

    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-5"></div> 
                            <div  class="col-lg-2  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >  تقرير المشال </h3>
                            </div>
                             <div class="col-lg-5"></div>
                    </div>
        </section>
    @endsection


    @section('content')
        <style type="text/css">
         
                        @media print{
                          #tohide2{
                            display:none;
                          }  
							#hideinprint{
                            display:none;
                          }
                          #FristPArt{
                            height: 30px;
                          }
                        }
/*
            #tbl-Products{
            height:100%;
        background:#000;
            }
*/
                        </style>


<!-- products Card-->
        <script src={{asset("/dist/js/admin/carryingreprot.js")}} type="text/javascript"></script>

        <script src={{asset("/plugins/datatables/jquery.dataTables.js")}} type="text/javascript"></script>
		<script src={{asset("/plugins/datatables/dataTables.tableTools.js")}} type="text/javascript"></script>
		<script src="{{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}"></script>
        <script src={{asset("/plugins/jQueryUI/jquery-ui-1.11.4.min.js")}}></script>


<!--select css-->
 <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<!--seelct css-->

		<!--Filter -->

     <!-- Main content -->
        <section class="content">
            <div class="row">
				       <div class="col-md-12 show" >
                    <div class="box box-success">
                        
                        <div class="box-header">
<!--                            <h3 class="box-title">تقرير كارته الاصناف   </h3>-->
                        </div>
                        <div class="box-body">
                            <div id="FristPArt"class="row">
                                
                                <div id="crrying-repo-form"  style="width: 60%" class="container col-xs-5">   
                                    <span >من: </span>
                                    <input name="FromTransDate" id="fromdate1"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <span>الى: </span>
                                    <input name="ToTransDate" id="todate1"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                            <br> 
	<div style="display:none ; margin:10px 0 0 0 ;" id="ShowCustomerONPrint1"></div>
	<div style="display:none ; margin:10px 0 0 0 ;" id="ShowSupplierONPrint1"></div>
	<div style="display:none ; margin:10px 0 0 0 ;" id="ShowProuduct"></div>
									
									<div id="hideinprint">
<!--
                                    <select name="CustomerID" 
                                            style="width:100%" 
                                          
                                           data-placeholder="اسم العميل (التاجر )" 
                                            id="CustomersID"
                                              dir="rtl">
										</select>
                                        
-->
                                        <br />
                                        
                                        <input name="checkProuduct" type="checkbox" value="1"  id="check_prodcut"  checked /> 
<label class="fontDesign" id="check_prouduct"> اختيار نوع البضاعة </label>
                                        <br />
                                        
                                             <select name="ProuductID" 
											 style="width:100%"
                                              data-placeholder="نوع البضاعة" 
                                            id="ProductType"
                                            class="ProductType_change"
                                                dir="rtl">
                                       
                                        <option value="0"> محلى  </option>
                                        <option value="1"> مستورد  </option>
                                   
                                        </select>
                                        
                                        <br> 
                                        
                                        </div>
                                        <br> 
                                    <button id="search-crrying" class="show btn btn-success btn-flat btn-block" type="button"><b>بـــحــــث</b></button> 
                                </div>
                                
                                
                                
                                <div style="width: 35%; height: inherit"  id='SuTypeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
				<!--Filter -->
				<!-- Report-->
				    <div  class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> تقرير المشال  </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
							 <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-crrying" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                            
                                <thead>
                                <tr>
                                    <th>التاريخ </th>
                                    <th style="display:none">نوع العميل </th>
                                    <th> اسم العميل</th>
                                    <th>نوع البضاعة  </th>
                                    <th>المبلغ </th>
                                    
<!--
                                    <th>العدد</th>
                                    <th>السعر</th>
                                    <th>الاجمالى قبل المشال</th>
                                    <th>المشال</th>
                                    <th>الاجمالى بعد المشال</th>
-->
                                </tr>
                                </thead>
                                <tbody>
               
                                </tbody>
								<tfoot>
							        <th>التاريخ </th>
                                     <th style="display:none">نوع العميل </th>  
                                    <th> اسم العميل</th>
                                    <th>نوع البضاعة  </th>
                                    <th  id="totaltest" class="sumcr">المبلغ </th>
                                   
<!--                              
                                    <th>العدد</th>
									<th>السعر</th>
                                    <th class="total2"></th>
                                    <th>المشال</th>
                                    <th class="total"></th>
-->
								</tfoot>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
				
				<!--Report -->
    </div><!-- /.row -->
    </section><!-- /.content -->
<script> 
$(document).ready(function(){    
$("#link25").addClass("hoverlink");
});
</script>
    @endsection