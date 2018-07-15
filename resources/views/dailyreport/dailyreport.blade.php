  
	@extends('adminheader.header')

    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-5"></div> 
                            <div  class="col-lg-2  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" > الـتقارير اليوميه     </h3>
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
                        }
			
				.fontDesign{
							font-size: 18px;
							font-wight:bold;
							}
                        </style>

        <script src={{asset("/dist/js/admin/dailyreport.js")}} type="text/javascript"></script>

        <script src={{asset("/plugins/datatables/jquery.dataTables.js")}} type="text/javascript"></script>
        <script src={{asset("/plugins/datatables/dataTables.tableTools.js")}} type="text/javascript"></script>
		 <link href="{{ asset('plugins/jQueryUI/jquery-ui.min.css') }}" rel="stylesheet">
       <section class="content">
            <div class="row">
				
                <div class="col-md-12 show" >
                    <div class="box box-success">
                        
                        <div class="box-header">
<!--                            <h3 class="box-title">  التقارير اليوميه </h3>-->
                        </div>
                        <div class="box-body ">
							
                            <div class="row">
                                <div id="dailyReport-repo-form" style="width: 60%" class="container col-xs-5">

                                
                                    <span class="fontDesign">التاريخ</span>
  <input name="FromTransDate" id="fromdate1"  class="form-control show datepicker" type="text" style="width:100%;" placeholder="يوم/شهر/سنة" />                    <br />                                     
           

                                    <button id="search-dailyreport" class="show btn btn-success btn-flat btn-block" type="button"><b>بـــحــــث</b></button> 
                                </div>
                                <div style="width: 35%; height: inherit"  id='SuTypeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
				
				
					<div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">  فواتير تجار سفر / معلقة/ اصناف محليه</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-abordCuatomer-outstanding" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                    <th > التاريخ</th>
                                    <th >    التاجر</th>
                                    <th > اسم المورد</th>
                                    <th > العلامة </th>
                                    <th > الخصم </th>
                                    <th >  النولون   </th>
									<th >   المنتج </th> 	
									<th >   العدد </th> 	
                                    <th >  الوزن  </th>    
									<th >المشال    </th>
									<th >السعر    </th>
                                    <th >الاجمالى </th>
										<!--Optional-->
                                    <th >فترة التعليق </th>
                                  
                                   
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                                 <tr>
									<th > التاريخ</th>
                                    <th >    التاجر</th>
                                    <th > اسم المورد</th>
                                    <th >   العلامة </th>
									  <th > الخصم </th>
                                    <th >   النولون </th>
								    <th >   المنتج </th> 
								    <th >   العدد </th> 
                                    <th >  الوزن  </th>    
									<th >المشال    </th>
									<th >السعر    </th>
                                    <th  class="total" > </th>
									 <!--Optional-->
                                    <th >فترة التعليق </th>
                                </tr>
                                </tfoot>
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
           
<!--		forign proudct		-->
				
			<div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> فواتير تجار سفر / معلقة/ اصناف مستوردة  </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-forignproduct" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                    <th > التاريخ</th>
                                    <th >    التاجر</th>
                                    <th > اسم المورد</th>
                                    <th > العلامة </th>
                                    <th > الخصم </th>
                                    <th >  النولون   </th>
									<th >   المنتج </th> 	
									<th >   العدد </th> 	
                                    <th >  الوزن  </th>    
									<th >المشال    </th>
									<th >السعر    </th>
                                    <th >الاجمالى </th>
										<!--Optional-->
                                    <th >فترة التعليق </th>
                                  
                                   
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                                 <tr>
									<th > التاريخ</th>
                                    <th >    التاجر</th>
                                    <th > اسم المورد</th>
                                    <th >   العلامة </th>
									  <th > الخصم </th>
                                    <th >   النولون </th>
								    <th >   المنتج </th> 
								    <th >   العدد </th> 
                                    <th >  الوزن  </th>    
									<th >المشال    </th>
									<th >السعر    </th>
                                    <th class="totalforgin" > </th>
									 <!--Optional-->
                                    <th >فترة التعليق </th>
                                </tr>
                                </tfoot>
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->				
				
				
				
<!--			forign prouduct end	-->
				
				
				
				
				
				
				
				
<!--!!! Bills end-->
				
				<!--end out deal -->
        <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> فواتير تجار سفر / مغلقة /اصناف محليه   </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-abbordCusmer-close" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                     <th > التاريخ</th>
                                    <th >    التاجر</th>
                                    <th > اسم المورد</th>
                                    <th > العلامة </th>
										  <th > الخصم </th>
                                    <th >  النولون   </th>
									<th >   المنتج </th> 	
									<th >   العدد </th> 	
                                    <th >  الوزن  </th>    
									<th >المشال    </th>
									<th >السعر    </th>
                                    <th >الاجمالى </th>
                                   
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                            <tr>
													<th > التاريخ</th>
                                    <th >    التاجر</th>
                                    <th > اسم المورد</th>
                                    <th >   العلامة </th>
								  <th > الخصم </th>
                                    <th >   النولون </th>
								    <th >   المنتج </th> 
								    <th >   العدد </th> 
                                    <th >  الوزن  </th>    
									<th >المشال    </th>
									<th >السعر    </th>
                                    <th class="total2" > </th>
                           </tr>
                                </tfoot>
                                
                                 
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->   
				 
<!--	!! end out deal 
-->
				

				
				
<!--lad forgin prouduct with end bills -->
	  <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> فواتير تجار سفر / مغلقة / اصناف مستوردة  </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-close-forginprouduct" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                     <th > التاريخ</th>
                                    <th >    التاجر</th>
                                    <th > اسم المورد</th>
                                    <th > العلامة </th>
										  <th > الخصم </th>
                                    <th >  النولون   </th>
									<th >   المنتج </th> 	
									<th >   العدد </th> 	
                                    <th >  الوزن  </th>    
									<th >المشال    </th>
									<th >السعر    </th>
                                    <th >الاجمالى </th>
                                   
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                            <tr>
													<th > التاريخ</th>
                                    <th >    التاجر</th>
                                    <th > اسم المورد</th>
                                    <th >   العلامة </th>
								  <th > الخصم </th>
                                    <th >   النولون </th>
								    <th >   المنتج </th> 
								    <th >   العدد </th> 
                                    <th >  الوزن  </th>    
									<th >المشال    </th>
									<th >السعر    </th>
                                    <th class="totalcloseforign" > </th>
                           </tr>
                                </tfoot>
                                
                                 
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->   			
				
				
<!--	!load forgin bills with end bills 			-->
					<!--end out deal -->
        <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">   فواتير تجار صعيد / اصناف محليه    </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-upperCustomer" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                   <th > التاريخ</th>
                                    <th >    التاجر</th>
                                    <th > اسم المورد</th>
                                    <th > العلامة </th>
                                     <th > الخصم </th>
									<th >   المنتج </th> 	
									<th >   العدد </th> 	
                                    <th >  الوزن  </th>    
									<th >المشال    </th>
									<th >السعر    </th>
                                    <th >الاجمالى </th>
                                   
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                            <tr>
												<th > التاريخ</th>
                                    <th >    التاجر</th>
                                    <th > اسم المورد</th>
                                    <th >   العلامة </th>
                                    <th > الخصم </th>
								    <th >   المنتج </th> 
								    <th >   العدد </th> 
                                    <th >  الوزن  </th>    
									<th >المشال    </th>
									<th >السعر    </th>
                                    <th class="total3" > </th>
                           </tr>
                                </tfoot>
                                
                                 
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->   
				 
			<!--	upper customer with forgin proudct			-->
				   <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> فواتير تجار صعيد /اصناف مستوردة   </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-upperCustomer-forgin" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                   <th > التاريخ</th>
                                    <th >    التاجر</th>
                                    <th > اسم المورد</th>
                                    <th > العلامة </th>
                                     <th > الخصم </th>
									<th >   المنتج </th> 	
									<th >   العدد </th> 	
                                    <th >  الوزن  </th>    
									<th >المشال    </th>
									<th >السعر    </th>
                                    <th >الاجمالى </th>
                                   
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                            <tr>
												<th > التاريخ</th>
                                    <th >    التاجر</th>
                                    <th > اسم المورد</th>
                                    <th >   العلامة </th>
                                    <th > الخصم </th>
								    <th >   المنتج </th> 
								    <th >   العدد </th> 
                                    <th >  الوزن  </th>    
									<th >المشال    </th>
									<th >السعر    </th>
                                    <th class="totalupperforign" > </th>
                           </tr>
                                </tfoot>
                                
                                 
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->   
				
				
<!--	upper customer with forgin proudct			-->
					
				
				
				
<!--	!! end out deal 		-->
				
					<!--end out deal -->
        <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">  فواتيير تجار محليين / اصناف محليه   </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-localCustomers" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                         <tr>
                                   <th > التاريخ</th>
                                    <th >    التاجر</th>
                                    <th > اسم المورد</th>
                                    <th > العلامة </th>
                                    <th > الخصم </th>
                                    
									<th >   المنتج </th> 	
									<th >   العدد </th> 	
                                    <th >  الوزن  </th>    
									<th >المشال    </th>
									<th >السعر    </th>
                                    <th >الاجمالى </th>
                                   
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                            <tr>
									<th > التاريخ</th>
                                    <th >    التاجر</th>
                                    <th > اسم المورد</th>
                                    <th >   العلامة </th>
                                     <th > الخصم </th>
								    <th >   المنتج </th> 
								    <th >   العدد </th> 
                                    <th >  الوزن  </th>    
									<th >المشال    </th>
									<th >السعر    </th>
                                    <th class="total4" > </th>
                           </tr>
                                </tfoot>
                                
                                 
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->   
<!--	local customer with forign proudct			 -->
				        <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> فواتير تجار محليين / اصناف مستوردة   </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-localCustomers_foriegn" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                         <tr>
                                   <th > التاريخ</th>
                                    <th >    التاجر</th>
                                    <th > اسم المورد</th>
                                    <th > العلامة </th>
                                    <th > الخصم </th>
                                    
									<th >   المنتج </th> 	
									<th >   العدد </th> 	
                                    <th >  الوزن  </th>    
									<th >المشال    </th>
									<th >السعر    </th>
                                    <th >الاجمالى </th>
                                   
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                            <tr>
									<th > التاريخ</th>
                                    <th >    التاجر</th>
                                    <th > اسم المورد</th>
                                    <th >   العلامة </th>
                                     <th > الخصم </th>
								    <th >   المنتج </th> 
								    <th >   العدد </th> 
                                    <th >  الوزن  </th>    
									<th >المشال    </th>
									<th >السعر    </th>
                                    <th class="totallocalforign" > </th>
                           </tr>
                                </tfoot>
                                
                                 
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->  
<!--		load customer with forgin prouduct		 -->
<!--	!! end out deal 		-->
				
				<!--CustomerDeposit-->
				   <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">   تحصيل العملاء / مقبوضات نقدية    </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-CashDeposit" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                         <tr>
                                   <th > التاريخ</th>
                                    <th >    اسم التاجر </th>
                                    <th > المبلغ </th>
                            
                                   
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                            <tr>
									<th > التاريخ</th>
                                    <th >    اسم التاجر</th>
                                    <th class="total5" > </th>
                           </tr>
                                </tfoot>
                                
                                 
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->   
				<!--Customer Deposit-->
				
				 <!--CheckDeposit -->
							   <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">   تحصيل العملاء / مقبوضات شيكات   </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-ChekDeposit" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                         <tr>
                                   <th > التاريخ</th>
                                    <th > اسم التاجر</th>
                                    <th >  اسم البنك </th>
                                    <th > المبلغ </th>
                            
                                   
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                            <tr>
									<th > التاريخ</th>
                                    <th >    اسم التاجر</th>
								 <th >  اسم البنك </th>
                                    <th class="total6" > </th>
                           </tr>
                                </tfoot>
                                
                                 
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->   
				
				
				<!--CheckDeposit -->
				
				<!-- Bank Deposit -->
				
							   <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">  تحصيل العملاء / مقبوضات بنكيه   </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-BankDeposit" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                         <tr>
                                   <th > التاريخ</th>
                                    <th >    اسم التاجر </th>
                                    <th >    اسم البنك  </th>
                                    <th > المبلغ </th>
                            
                                   
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                            <tr>
									<th > التاريخ</th>
                                    <th >    اسم التاجر</th>
 									<th >    اسم البنك  </th>
                         
                                    <th class="total7" > </th>
                           </tr>
                                </tfoot>
                                
                                 
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->   
				
				<!--Bank Deposit -->
				
				<!--Supplier chaspayment -->
								   <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">  مدفوعات الموردين / مدفوعات النقديه   </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-cashPayment" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                         <tr>
                                   <th > التاريخ</th>
                                    <th >    اسم المورد </th>
                                    <th > المبلغ </th>
                            
                                   
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                            <tr>
									<th > التاريخ</th>
                                    <th >   اسم المورد</th>

                         
                                    <th class="total8" > </th>
                           </tr>
                                </tfoot>
                                
                                 
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->   
	
				<!--Supplier  chaspayment-->
				
				<!--expenses  Report -->
				
										   <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">  مدفوعات الموردين / مدفوعات شيكات    </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-checkPayment" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                         <tr>
                                   <th > التاريخ</th>
                                    <th >    اسم المورد </th>
                                    <th >    اسم البنك </th>
                                    <th > المبلغ </th>
                            
                                   
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                            <tr>
									<th > التاريخ</th>
                                    <th >   اسم المورد</th>
   									<th >    اسم البنك </th>
                         
                                    <th class="total9" > </th>
                           </tr>
                                </tfoot>
                                
                                 
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->   
				<!-- expenses Report-->
				
				<!-- check Payment -->
										   <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">   المصـــروفات  </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-Expenses" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                         <tr>
                                   <th > التاريخ</th>
                                    <th >   اسم المصروف </th>
                                    <th >   اسم الخزنة </th>
                                    <th > المبلغ </th>
                            
                                   
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                            <tr>
									<th > التاريخ</th>
                                    <th >   اسم المصروف</th>

                         			<th >   اسم الخزنة </th>
                                    <th class="total10" > </th>
                           </tr>
                                </tfoot>
                                
                                 
                            </table>
                          
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->   
				<!-- check Payment -->
				
				<div  id="tohide2" class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                           <button   type="button"  onkeyup="myFunction1(event)" onclick="PrintEndBills()" style="width: 100%;" center class="btn btn-success">طباعة  </button>
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->

        </section><!-- /.content -->
           <script> 
$(document).ready(function(){    
$("#link22").addClass("hoverlink");
});
</script>
        
@endsection    