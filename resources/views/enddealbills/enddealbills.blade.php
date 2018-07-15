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
</style>

<style type="text/css">

                        @media print{
                          #tohide2{
                            display:none;
                          }  
							#hideinprint{
                            display:none;
                          }
                          #print{
                            display: none
                          }
                        }
	
	
	.fontDesign{
    font-size: 18px;
font-wight:bold;
}
                        </style>

        <script src={{asset("/dist/js/admin/enddealbills.js")}} type="text/javascript"></script>

<!--        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
<!--        <script src="/plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>-->

 		<script src={{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}></script>
<!--select css-->
 <link	 href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<!--seelct css-->
        <section class="content">
            <div class="row">
                <div class="col-md-12 show" >
                    <div class="box box-success">
                        
                        <div class="box-header">
                            <h3 class="box-title">   ارباح وخسائر فواتير السفر</h3>
                        </div>
                        <div class="box-body ">
                            <div class="row FirsTPart6">
                                <div id="enddealbills-repo-form" style="width: 60%" class="container col-xs-5">

                                
                                    <span class="fontDesign">من: </span>
												 
                                    <input name="FromTransDate"   class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <span class="fontDesign">الى: </span>
                                    <input name="ToTransDate"   class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
									                             <br />

                                      <div style="display:none" id="ShowCustomerONPrint11"></div>
                                       <div style="display:none" id="ShowSupplierONPrint2"></div>
                                    
                                    <!--customers -->
                                    <!--checkcustomers  onclick="checking(this)"-->
                                     <div id="hideinprint">
                                          <input name="checkCustomers" type="checkbox" value="1" checked id="check_Customers" /> 
										 
                                           <label class="fontDesign" id="check_customer">إختيار التاجر </label>
									  <br>
									
                                        <!--  -->
                                   
                                    <select name="CustomersID" 
                                            style="width: 100%"
                                          
                                            data-placeholder="اسم التاجر" 
                                          
                                            id="endDealCustomersID1">
                                      
                                        </select>
                           <!--suppliers -->        
                                 	      <input name="checkSuppliers" type="checkbox" value="1" checked id="check_Supplirs" /> 
										 
                                           <label class="fontDesign"  id="check_suppliers">إختيار المورد </label> 
										 
                                     <select name="SupplierID" 
											 style="width:100%"
                                              data-placeholder="اسم المورد" 
                                           
                                            id="endDealSupplierID">
                                   
                                        </select>
                                    </div>
                                     
                             <br />
                                    <button id="search-enddealbills" class="show btn btn-success btn-flat btn-block" type="button"><b>بحث</b></button> 
                                </div>
                                <div style="width: 35%; height: inherit"  id='SuTypeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
				
				
					<div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">  تفاصيل الفاتوره  </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-BillsDetalis" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                    <th > التاريخ</th>
                                    <th >   اسم التاجر</th>
                                    <th >   العلامة  </th>
                                    <th > اسم المورد</th>
                                    <th >   المنتج </th> 
                                    
                                    <th >  الوزن  </th>    
									<th >السعر </th>
                                    <th >الاجمالى </th>
                                  
                                   
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                            <tr>
							  <th > التاريخ</th>
                                    <th >   اسم التاجر</th>
                                    <th >  العلامة </th>
                                    <th > اسم المورد</th>
                                    <th >   المنتج </th> 
                                 
                                    <th >  الوزن  </th>    
									<th >السعر </th>
                                    <th >الاجمالى </th>
                                  
                           </tr>
                                </tfoot>
                                
                                 
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
           
				
				
<!--	!!! Bills end			-->
				
				<!--end out deal -->
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
                                    <th>صافى الربح او الخسارة </th>
                               
                           </tr>
                                </tfoot>
                                
                                 
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->   
                
<!--        final statment of customers  start       -->
                
                 <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">    الحاله النهائيه لتاجر السفر(ربح أو خساره )</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-EndofCustomersStatment" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                         <th >  الربح  </th>
                                    <th >الخسارة </th>
									<th >الفرق  </th>
                             
                           
                                   
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                            <tr>
                                    <th >  الربح  </th>
                                    <th >الخسارة </th>
									<th >الفرق  </th>
                             
                               
                           </tr>
                                </tfoot>
                                
                                 
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->   
                
                
                
                
                
                
                
                
                
                
                
                
<!--           final statment ofv customers end     -->
				 
<!--	!! end out deal 		-->
				<div  id="tohide2" class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                           <button  id="print"  type="button"  onkeyup="myFunction1(event)" onclick="PrintEndBills()" style="width: 100%;" center class="btn btn-success">طباعة  </button>
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->

        </section><!-- /.content -->
        
@endsection    