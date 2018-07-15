@extends('adminnoheader.noheader')
@section('content')

        <script src={{asset("/dist/js/admin/totalcustomersdata.js")}} type="text/javascript"></script>
<!--        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
<!--        <script src="/plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>-->

		<script src="{{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}"></script>
<!--        <script src="/plugins/jQueryUI/jquery-ui-1.11.4.min.js"></script>-->
<style>
.fontDesign{
    font-size: 18px;
font-wight:bold;
}
@media print{
.FirsTPart4 { height: 100px; }
   #search-totalcustomersdata{display:none;}
}
</style>

<!--select css-->
 <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<!--seelct css-->
        <section class="content">
            <div class="row">
                <div class="col-md-12 show" >
                    <div class="box box-success">
                        
                        <div class="box-header fontDesign">
                            <h3 class="box-title">عرض مشتريات العملاء </h3>
                        </div>
                        <div class="box-body">
                            <div class="row FirsTPart4">
                                
                                <div id="totalcustomersdata-repo-form" style="width: 60%" class="container col-xs-5">   
                                    <span class="fontDesign">من: </span>
                                    <input name="FromTransDate"  id="" class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <span class="fontDesign">الى: </span>
                                    <input name="ToTransDate" id=""  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
																		
<br />
                                    <label  class="fontDesign" id="check_label2">
                                          <input type="checkbox"  name="isCustomer" id="check_enable2">اختيار المورد 
                                    </label>
 <div id="hide">
                   <select  name="SupplierID"  style="width:100%" data-placeholder="اسم المورد"  id="TotalCustomersID"  dir="rtl" disabled >
                                        </select>
     
     
                 <br />
                                        <br />
                                        
                                        <select name="ProuductID" 
											 style="width:100%"
                                              data-placeholder="نوع البضاعة" 
                                            id="ProductType2"
                                                dir="rtl">
                                        <option > اختار نوع البضاعة  </option>
                                        <option value="0"> محلى  </option>
                                        <option value="1"> مستورد  </option>
                                   
                                        </select>
                                        
                                
                                     	<br />
     
                </div>                    
                                    
                                    <div style="display: none" id="ShowONPrint"></div>
                                    <div style="display: none" id="Showprouduct2"></div>
                                    
                                  
                                       
                                      
                                 <br />
                                    <button id="search-totalcustomersdata" class="show btn btn-success btn-flat btn-block" type="button"><b>بحث</b></button> 

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
                            <table  id="tbl-totalcustomersdata" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                            
                                <thead>
                                    <tr>
                                        <th>التاجر </th>
                                        <th >العلامة </th>
                                        <th >النوع </th>
                                        <th >التاريخ </th>
                                        <th>  </th>
                                        
                                        <th ></th>
                                        <th ></th>
                                        <th ></th>
                                        <th ></th>
                                       
                                       
                                        
                                    </tr>
                                </thead>
                                 <tbody></tbody>
                                <tfoot>
                                    <tr style="background:#f90">
                                        <th>التاجر </th>
                                        <th >العلامة </th>
                                       
                                        <th>  </th>
                                         <th  id="firsttotal">  </th>
                                        
                                        <th ></th>
                                        <th ></th>
                                        <th ></th>
                                        <th ></th>
                                        <th  id="finaltotal"> </th>
                                      
                                    </tr>
                                </tfoot >
                            </table>
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->

               

               
        </section><!-- /.content -->
        
@endsection    