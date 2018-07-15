@extends('adminheader.header')
    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-4"></div> 
                            <div  class="col-lg-4  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >تقرير الموردين الخارجيين   </h3>
                            </div>
                             <div class="col-lg-4"></div>
                    </div>
        </section>
    @endsection

@section('content')

     
  <script src={{asset("/dist/js/admin/foreignsuppliersstatment.js")}} type="text/javascript"></script>
        
<!-- <script src={{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}></script> -->
<script src={{asset('plugins/datatables/jquery.dataTables.js')}} type="text/javascript"></script>
<script src={{asset("/plugins/datatables/dataTables.tableTools.js")}} type="text/javascript"></script>
<script src={{asset('plugins/datatables/dataTables.bootstrap.js')}} type="text/javascript"></script>

<!--select css-->
<!-- <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />-->

   
<!--seelct css-->
					<style type="text/css">

                        @media print{
                          #tohide2{
                            display:none;
                          } 
                            .tohide3{
                            display:none;
                          }
                            
                        }
						
						.fontDesign{
							font-size: 18px;
							font-wight:bold;
							}
                        
                        
                        </style>

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
        <section class="content">
            <div class="row">
                <div class="col-md-12 show" >
                    <div class="box box-success">
                        
                        <div class="box-header">
                            <h3 class="box-title">عرض فواتير مورد (فلاح خارجى ) </h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                
 <div id="foreignsuppliersstatment-repo-form" style="width: 60%" class="container col-xs-5">   
                                    
                      <div id="suppliers_opening_date101" class="box-title fontDesign"></div>
                    <div id="suppliers_openingBalnce_Mount102" class="box-title fontDesign"></div>
                              <br / >
                              <br / >
                                    
									
                                    
                                    
                                    <span class="fontDesign">من: </span>
                                    <input name="FromTransDate" id="fromdate13"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <span class="fontDesign">الى: </span>
                                    <input name="ToTransDate" id="todate13"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
  <br />
                
									
									<div style="display: none" id="ShowSuppliersStatment"></div>
<!--
                                       <div style="display: none; " id="ShowContiner"></div>
                                       <div style="display: none; " id="ShowSieralContiner"></div>
-->
										
														
                                    <select onclick=validate(); name="SupplierID" 
                                            mh_width="width:100%" 
                                            mh_onkeyup="" tabindex="1" 
                                            data-placeholder="اسم المورد (الفلاح)" 
                                            class="chosen-select-deselect chosen-rtl" 
                                            id="ForeignSuppliersStatmentID">
										
                                                   <option data-comm="0" value="0" selected ></option>
                                     @foreach($suppliers as $suppliers)
                           <option value="{{$suppliers->SupplierID}}">{{$suppliers->SupplierName}}</option>
                                          @endforeach
                                          
                                        </select>
							
								  <br>	
<!--
                                    
                                    Continer  
                                    
                                    <select name="ContainerID" 
                                             mh_width="width:100%" 
                                            mh_onkeyup="" tabindex="1" 
                                            data-placeholder="الحاوية" 
                                             class="chosen-select-deselect chosen-rtl" 
                                            id="cboContainerID"  >
                                        <option data-comm="0" value="0" selected ></option>
                                        </select>
                                  <br>	
						
                                                 <select name="SerialContainerID" 
                                             mh_width="width:100%" 
                                            mh_onkeyup="" tabindex="1" 
                                            data-placeholder="مسلسل الحاويات " 
                                             class="chosen-select-deselect chosen-rtl" 
                                            id="cboSerialContainerID"  >
                                            <option data-comm="0" value="0" selected ></option>
                                        </select>
                                        
                                  
                                    <br />    
-->
                                    <input class="radio-inline" id="Individuale2" onclick="individuale()" checked type="radio" name="rbtn" data-title="تفصيل" value="0"  />

                                    <label class="radio-inline fontDesign" id="indi22" for="rbtnIndividuale" >تفصيل</label>
<!--                                    <label class="radio-inline" for="rbtnCustomerType">تفصيل</label>-->


                                    <input class="radio-inline" id="Combine2" onclick="combine()" type="radio" name="rbtn" data-title="تجميع" value="1" />
                                   

                                    <label class="radio-inline fontDesign" id="comb22" for="rbtnCombine">تجميع</label>
                       
                                    <br /><br />
                                    <button id="search-foreignSuppliersstatment" class="show btn btn-success btn-flat btn-block" type="button"><b>بحث</b></button> 
                                </div>
                                
                                
                                
                                <div style="width: 35%; height: inherit"  id='SuTypeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
        <div class="col-xs-12 hideOnPrint">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">الحاويات</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-ForeignSuppliersstatment" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                            
                                <thead>
                                    <tr>
                                        <th>التاريخ </th>
                                        <th>مسلسل الحاويه  </th>
                                        <th class="hidecombiner">اسم التاجر  </th>
                                        <th class="hidecombiner">الصنف </th>
                                        <th class="hidecombiner">الوحدة </th>
                                        <th class="hidecombiner">الوزن </th>
                                        <th class="hidecombiner">كميه</th>
                                        <th class="hidecombiner">سعر</th>
										<th>اجمالى </th>
										<th class="hidecombiner">المشال </th>
										<th>الاجمالى بعد المشال </th>
                                     
                                        
                                    </tr>
                                </thead>
                                 <tbody></tbody>
                                <tfoot>
                                    <tr>
										<th>التاريخ  </th>
										<th>مسلسل الحاويه   </th>
                                        <th class="hidecombiner">اسم التاجر  </th>
										<th class="hidecombiner">الصنف </th>
										 <th class="hidecombiner">الوحدة </th>
                                        <th class="hidecombiner">الوزن </th>
                                        <th class="hidecombiner">كميه</th>
                                        <th class="hidecombiner">سعر</th>
										<th id="firstTotal">اجمالى </th>
                                     	<th class="crryingTotal hidecombiner">المشال </th>
										<th id="finaltotala2">الاجمالى بعد المشال </th>
                                    </tr>
                                </tfoot >
                            </table>
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
				<div class="col-xs-12 ">
                    <div class="box">
                        <div class="box-body">
                            
<!--
                            <div id="CustomeName"></div>
                            <div id="CustomeMonut"></div>
                        
-->
                              <h3 class="box-title">بيانات المستخلصين </h3>
                            <!-- test start-->
<!--                            <table id="tbl-customeStatmentSuppliers" style="">-->
 <table id="tbl-customestament" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
     <thead> <tr>  <th>اسم المستخلص  </th> <th> قيمة التخليص</th></td><td>مسلسل الحاويه</td></tr></thead>
      <tbody></tbody>
     <tfoot><tr> <th>  اسم المستخلص </th> <th> قيمة التخليص</th><td>مسلسل الحاويه </td></tr></tfoot>
                             
                            </table>
                            
                    <br /> 
                    <br />
                      <h3 class="box-title">بيانات الحاويات  </h3>
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-FinalDatastatment" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                            
                                <thead>
                                    <tr>  
									<th> مسلسل الحاويه </th>
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
										
									<th> الاجمالى </th>
									<th id="Total">   </th>        
                   <th id="OtherExpenses" > </th>
								    <th id="CustomeMonut"> </th>
										<th id="Nowlan">  </th>
										<th id="final">  </th>
                    <th id="finalCommision">   </th>
										<th id="finalTotalFS">   </th>
                                     
                                        
                                     
                                    </tr>
                                </tfoot >
                            </table>
                            <!--the data tables goes here... -->
<!--                        </table>  test end  -->
                        </div><!-- /.box-body -->
<!--                <div class="col-md-4"></div>-->
<!--                <div class="col-md-4 ">-->
                         <button  onkeyup="myFunction(event)" type="button" id="ptn3" onclick="Print2()" style="width: 100%;" center class="btn btn-success fontDesign tohide3">  طباعة بيانات الحاويات والمستخلصين  </button>
<!--                    </div>-->
<!--                <div class="col-md-4"></div>-->
                    </div><!-- /.box -->
                </div><!-- /.col -->
      <!--Supplier Payment -->
                <div class="col-xs-12 hideOnPrint">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> عرض مدفوعات المورد الخارجى  </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-SupplierPaymentstatment" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

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
                
                  
                 <div class="col-xs-12 hideOnPrint">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">عرض مرتجعات المورد الخارجى </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-SupplierRefundsstatment" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

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

                 <div class="col-xs-12 hideOnPrint">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">عرض خصومات المورد لخارجى </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-SupplierDiscountssStatment" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

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
<!--final statment of suppliers start-->
                
     <div class="col-xs-12 hideOnPrint">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> تصفيه حساب المورد الخارجى   </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-finalForiegnSuppliersstatment" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                    <th class=""> عليه </th>
                                    <th class=""> له </th>
                                    <th class="">البيان</th>
                                    
                                </tr> 
                                </thead>
                                
                                 <tbody>
<!--
                                     <td id=""></td>
                                     <td id=""></td>
                                     <td id="finalstatment"></td>
-->
                                     
                                </tbody>
                                 
                                 <tfoot>
                            <tr>
                              <th class=""></th>
                              <th class=""> </th>
                              <th ></th>
<!--                              -->
                              
                           </tr>
                                </tfoot>
                                
                                
                            </table>
                        <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->





				<div  id="tohide2" class="col-xs-12 hideOnPrint">
                    <div class="box">
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                           <button  onkeyup="myFunction(event)" type="button" id="ptn2" onclick="Print()" style="width: 100%;" center class="btn btn-success fontDesign">طباعة كشف حساب كاكل   </button>
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
				
        </section><!-- /.content -->
        
@endsection    