@extends('adminnoheader.noheader')
@section('content')

        <script src={{asset("/dist/js/admin/foreignsuppliers.js")}} type="text/javascript"></script>
<!--
        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="/plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>
-->
<script src="{{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}"></script>
<!--        <script src="/plugins/jQueryUI/jquery-ui-1.11.4.min.js"></script>-->


<!--select css-->
 <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<!--seelct css-->
					<style type="text/css">
        
                        
                        @media print{
                          #tohide2{
                            display:none;
                          }
                          #fristpart3{ height: 20px

                          }
                          #search-foreignSuppliers{display: none;}
                        }
						
						.fontDesign{
							font-size: 18px;
							font-wight:bold;
							}


                        </style>
        <section class="content">
            <div class="row">
                <div class="col-md-12 show" >
                    <div class="box box-success">
                        
                        <div class="box-header">
                            <h3 class="box-title">عرض مشتريات الموردين(الخارجين) </h3>
                        </div>
                        <div class="box-body">
                            <div  id="fristpart3" class="row">
                                
                    <div id="foreignsuppliers-repo-form" style="width: 60%" class="container col-xs-5">   
                        
                                    <span class="fontDesign">من: </span>
                                    <input name="FromTransDate" id="fromdate1"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <span class="fontDesign">الى: </span>
                                    <input name="ToTransDate" id="todate1"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
  <br />
									
									
									<div style="display: none" id="ShowSuppliers"></div>
                                       <div style="display: none; " id="ShowContiner"></div>
                                       <div style="display: none; " id="ShowSieralContiner"></div>
										
														
                                    <select onclick=validate(); name="SupplierID" 
                                            mh_width="width:100%" 
                                            mh_onkeyup="" tabindex="1" 
                                            data-placeholder="اسم المورد (الفلاح)" 
                                            class="chosen-select-deselect chosen-rtl" 
                                            id="ForeignSuppliersID69" >
										
                                                   <option data-comm="0" value="0" selected ></option>
                                     @foreach($suppliers as $suppliers)
                           <option value="{{$suppliers->SupplierID}}">{{$suppliers->SupplierName}}</option>
                                          @endforeach
                                          
                                        </select>
							
								  <br>	
                                    
                                    <!--Continer  -->
                                    
                                    <select name="ContainerID" 
                                             mh_width="width:100%" 
                                            mh_onkeyup="" tabindex="1" 
                                            data-placeholder="الحاوية" 
                                             class="chosen-select-deselect chosen-rtl" 
                                            id="cboContainerID"  
                                             dir="rtl">
                                        <option data-comm="0" value="0" selected ></option>
                                        </select>
                                  <br>	
						
                                            <select name="SerialContainerID" 
                                             mh_width="width:100%" 
                                            mh_onkeyup="" tabindex="1" 
                                            data-placeholder="مسلسل الحاويات " 
                                             class="chosen-select-deselect chosen-rtl" 
                                            id="cboSerialContainerID"
                                             dir="rtl">
                                            <option data-comm="0" value="0" selected ></option>
                                        </select>
                                        
                                  
                                    <br />    
                                    <input class="radio-inline" id="Individuale" onclick="individuale()" checked type="radio" name="rbtn" data-title="تفصيل" value="0"  />

                                    <label class="radio-inline fontDesign" id="indi2" for="rbtnIndividuale" >تفصيل</label>
<!--                                    <label class="radio-inline" for="rbtnCustomerType">تفصيل</label>-->


                                    <input class="radio-inline" id="Combine" onclick="combine()" type="radio" name="rbtn" data-title="تجميع" value="1" />
                                   

                                    <label class="radio-inline fontDesign" id="comb2" for="rbtnCombine">تجميع</label>
                                    
                                    
                                            <input class="radio-inline" id="CombineProuduct" onclick="combineProduct()" type="radio" name="rbtn" data-title="تجميع" value="2" />
                                   

 <label class="radio-inline fontDesign" id="comb3" for="rbtnCombine">تجميع بالبضاعة</label>
                                                  
                                    <br /><br />
                                    <button id="search-foreignSuppliers" class="show btn btn-success btn-flat btn-block" type="button"><b>بحث</b></button> 
                        
                        
                                </div>
                                
                                
                                
                                <div style="width: 35%; height: inherit"  id='SuTypeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
        <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">الحاويات</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-ForeignSuppliers" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                            
                                <thead>
                                    <tr>
                                        <th>التاريخ </th>
                                        <th class="productcomp">مسلسل الحاويه  </th>
                                        <th class="productcomp"> التاجر  </th>
                                        <th class="hidecombiner combine3">الصنف </th>
                                        <th class="hidecombiner productcomp">الوحدة </th>
                                        <th class="hidecombiner combine3">الوزن </th>
                                        <th class="hidecombiner combine3">كميه</th>
                                        <th class="hidecombiner">سعر</th>
										<th>اجمالى </th>
										<th class="hidecombiner productcomp">المشال </th>
										<th style="display:none" class="productcomp hidecombiner">العلامة  </th>
                                        <th style="display:none">اسم المورد</th>
										<th class="productcomp">الصافي</th>
                                     
                                        
                                    </tr>
                                </thead>
                                 <tbody></tbody>
                                <tfoot>
                                    <tr>
										<th class="">التاريخ  </th>
										<th class="productcomp">مسلسل الحاويه   </th>
                                        <th class="productcomp"> التاجر  </th>
										<th class="hidecombiner combine3">الصنف </th>
								        <th class="hidecombiner productcomp">الوحدة </th>
                                        <th class="hidecombiner combine3">الوزن </th>
                                        <th class="hidecombiner combine3">كميه</th>
                                        <th class="hidecombiner">سعر</th>
										<th class="firstTotal">اجمالى </th>
                                     	<th class="crryingTotal hidecombiner productcomp">المشال </th>
                                        <th style="display:none" class="productcomp hidecombiner">العلامة</th>
                                        <th style="display:none">اسم المورد</th>
										<th class="finaltotala2 productcomp"> الصافي</th>
                                    </tr>
                                </tfoot >
                            </table>
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
				<div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            
<!--
                            <div id="CustomeName"></div>
                            <div id="CustomeMonut"></div>
                        
-->
                              <h3 class="box-title">بيانات المستخلصين </h3>
 <table id="tbl-custome" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
     <thead> <tr>  <th>اسم المستخلص  </th> <th> قيمة التخليص</th></th><th>مسلسل الحاويه </td></tr></thead>
      <tbody></tbody>
     <tfoot><tr> <th>  اسم المستخلص </th> <th> قيمة التخليص</th><th>مسلسل الحاويه </th></tr></tfoot>
                             
                            </table>
                            
                    <br /> 
                    <br />
                      <h3 class="box-title">بيانات الحاويات  </h3>
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-FinalData" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                            
                                <thead>
                                    <tr>  
									 <th> مسلسل الحاويه</th>
										<th>الاجمالى </th>
										 <th>مصروفات اخرى</th>
                                       
                                        <th > التخليص الجمركى </th>
								        <th>نولون </th>
										<th>صافى البيع </th>
										<th> العموله </th>
										<th> اجمالى الصافي </th>
                                     
                                        
                                    </tr>
                                </thead>
                                 <tbody></tbody>
                                <tfoot>
                                    <tr>
										
									 <th> مسلسل الحاويه</th>
									  <th>الاجمالى </th>
										 <th>مصروفات اخرى</th>
                                        
                                        <th > التخليص الجمركى </th>
								        <th>نولون </th>
										<th>صافى البيع </th>
										<th> العموله  </th>
										<th>  اجمالى الصافي </th>
                                     
                                        
                                     
                                    </tr>
                                </tfoot >
                            </table>
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
				<div  id="tohide2" class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                           <button  onkeyup="myFunction66(event)" type="button" id="ptnforignSuppliers" onclick="Print66()" style="width: 100%;" center class="btn btn-success">طباعة  </button>
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
				
        </section><!-- /.content -->
        
@endsection    