@extends('adminheader.header')

    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-5"></div> 
                            <div  class="col-lg-2  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >تقرير كــارته الصـنف  </h3>
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

                          #search-ProuductsCard{
                            display:none;
                          }
                          #FirsTPart{
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
        <script src={{asset("/dist/js/admin/productscard.js")}} type="text/javascript"></script>
          
        <script src={{asset("/plugins/datatables/jquery.dataTables.js")}} type="text/javascript"></script>
		<script src={{asset("/plugins/datatables/dataTables.tableTools.js")}} type="text/javascript"></script>
		<script src={{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}></script>
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
                            <div id="FirsTPart" class=" row">
                                
                                <div id="productscard-repo-form"  style="width: 60%" class="container col-xs-5">   
                                    <span >من: </span>
                                    <input name="FromTransDate" id="fromdate1"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <span>الى: </span>
                                    <input name="ToTransDate" id="todate1"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                            <br> 
										<div style="display:none ; margin:10px 0 0 0 ;" id="ShowProuduct"></div>
									
									<div id="hideinprint">
                                    <select name="ProdcutID" 
                                            style="width:100%" 
                                          
                                            data-placeholder="المنتجات" 
                                            id="ProductsCard">
										</select>
                                        </div>
                                        <br> 
                                    <button id="search-ProuductsCard" class="show btn btn-success btn-flat btn-block" type="button"><b>بـــحــــث</b></button> 
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
                            <h3 class="box-title"> كارته الصنف </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
							 <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-Products" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>التاريخ </th>
                                    <th> الصــنف</th>
                                    <th>الوحدة </th>
                                    <th>الوزن</th>
                                    <th>العدد</th>
                                    <th>السعر</th>
                                    <th>الاجمالى قبل المشال</th>
                                    <th>المشال</th>
                                    <th>الاجمالى بعد المشال</th>
                                </tr>
                                </thead>
                                <tbody>
               
                                </tbody>
								<tfoot>
							     <th>التاريخ </th>
                                    <th> الصــنف</th>
                                    <th>الوحدة </th>
                                    <th>الوزن</th>
                                    <th>العدد</th>
									<th>السعر</th>
                                    <th class="total2"></th>
                                    <th>المشال</th>
                                    <th class="total"></th>
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
$("#link23").addClass("hoverlink");
});
</script>
    @endsection