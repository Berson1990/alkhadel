@extends('adminheader.header')
    @section('header')
  <section class="content-header">
        <div class="row">
         <div class="container" >  
                            <div class="col-lg-4 col-xs-4"></div> 
                            <div  class="col-lg-4 col-xs-4 btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" > كشف حساب مستخلصين </h3>
                            </div>
                             <div class="col-lg-4 col-xs-4"></div>
</div>
                    </div>
        </section>
    @endsection
@section('content')

<style>
/*
tr.group,
div.dataTables_paginate ul.pagination {
margin: -1px 0;
white-space: nowrap;
padding-top:11px;
}
*/

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
</style>

        <script src={{asset("/dist/js/admin/customsreport.js")}} type="text/javascript"></script>

<script src={{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}></script>
<script src={{asset('plugins/datatables/jquery.dataTables.js')}} type="text/javascript"></script>
<script src={{asset("/plugins/datatables/dataTables.tableTools.js")}} type="text/javascript"></script>
<script src={{asset('plugins/datatables/dataTables.bootstrap.js')}} type="text/javascript"></script>

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

<!--select css-->
 <link href={{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}} rel="stylesheet" type="text/css" />
<!--seelct css-->


        <section class="content">
            <div class="row">
                <div class="col-md-12 show" >
                    <div class="box box-success">
                        
                        <div class="box-header">
                            <h3 class="box-title fontDesign"> عرض كشف حساب مستخلص   </h3>
                        </div>
                        <div class="box-body ">
                            <div class="row">
                                <div id="customStatmentform-repo-form" style="width: 60%" class="container col-xs-5">
                                  <label id="OpenningDate11"></label>
                                <br/>
                                  <label id="AccountBalance11"></label>
                                 
                                    <span class="fontDesign">من: </span>
                                    <input name="FromTransDate"   class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <span class="fontDesign">الى: </span>
                                    <input name="ToTransDate"   class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    
                                    <!--customers -->
                      <br />
                             
                           <!--suppliers -->        
                                    
<!--                              <label  class="fontDesign" id="SName">اسم المستخلص </label>-->
                                    
                                 <div style="display:none" id="CustomsPRint2525"> مستخلص خارجى</div>
<!--                                 <div style="display: none;" id="productshow"></div>-->
									
                           
                              <label style="display:none;"id="SupName"></label>
									
									  <div id="hiddenPrint">  
                                     <select name="CustomID" 
                                            style="width:100%" 
                                            data-placeholder="اسم المستخلص" 
                                            id="CustomIdStatment"
                                              dir="rtl" 
                                             >
                                        </select>
                                            </div>
<!--
                                          
                                     	<br />
                                          	<br />
<input name="checkProuduct" type="checkbox" value="1"  id="check_prodcut"  checked /> 
<label class="fontDesign" id="check_prouduct"> اختيار نوع البضاعة </label>
-->
<!--
                                                     
                                        <select name="ProuductID" 
											 style="width:100%"
                                              data-placeholder="نوع البضاعة" 
                                              id="ProductType"
                                                dir="rtl"
                                                class="type_pro_change">
                                       
                                        <option value="0"> محلى  </option>
                                        <option value="1"> مستورد  </option>
                                   
                                        </select>
                                        
                                  
                                     	<br />
                                          
-->
                                          
                                          
                                          
                                          
                                  
                                       <br />
                                    <div id="hideinotherprinttable">
<!--
                                    <input class="radio-inline " id="rbtnIsndividuale" onclick="individuale()" type="radio" name="rbtn" data-title="تفصيل" value="1" checked  />
										
                                    <label class="radio-inline fontDesign" id="inname"for="rbtnIndividuale">تفصيل</label>
                                    <label class="radio-inline" for="rbtnCustomerType">تفصيل</label>

                                    <input class="radio-inline " id="rbtnComb" onclick="combine()"type="radio" name="rbtn" data-title="تجميع" value="2" />
                                   

                                    <label class="radio-inline fontDesign" id="comname"for="rbtnCombine">تجميع</label>
-->
                                        </div>
<!--                                    <label class="radio-inline" for="rbtnProuductName">تجميع</label>-->
                                       
                                        <!--<label>
                                          <input type="checkbox">عرض اسم التاجر 
                                        </label>-->
                                     
                                    <br />
                                    <button id="search-CustomStatment" onclick="" class="show btn btn-success btn-flat btn-block" type="button"><b>بحث</b></button> 
                                </div>
                                <div style="width: 35%; height: inherit"  id='SuTypeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
                


<!-- Custom Deposit From Contanier Start-->
    <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title fontDesign">   المستحق للمستخلص  </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-CustomDeposit" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                    <th class="">  التاريخ  </th>
                                    <th class=""> اسم المستخلص  </th>
                                    <th class="">  المبلغ </th> 
                                    <th class="">  سيريال الحاويه  </th>
                                    
                                </tr> 
                                </thead>
                                
                                 <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        
                                    <th class="">  التاريخ  </th>
                                    <th class=""> اسم المستخلص  </th>
                                    <th class="TotalCustomMount">  لاجمالى  </th> 
                                    <th class="">  سيريال الحاويه  </th>
                                    
                                
                                    </tr>
                                </tfoot>
                            </table>
                        <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->



<!-- Custom Deposit From Contanier End  -->

                
            <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title fontDesign">عرض دفعات المستخلص </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-CustomPaymentReport" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
									  <th class=""> التاريخ</th>	
									  <th class=""> اسم المستخلص </th>		
                                    <th class=""> الدفعات</th>
                                   
                                </tr> 
                                </thead>
                                
                                 <tbody>
                                </tbody>
                                 
                                 <tfoot>
                            <tr>
                                    <th class=""> التاريخ</th>	
									  <th class=""> اسم المستخلص </th>		
                                    <th class="total"> الدفعات</th>
                              
                           </tr>
                                </tfoot>
                                
                                
                            </table>
                        <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->

        <!-- Custom Refund Table Start -->

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title fontDesign">   مرتجعات المستخلص </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-CustomRefund" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                    <th class="">  التاريخ  </th>
                                    <th class=""> اسم المستخلص  </th>
                                    <th class="">  المبلغ </th> 
                                    <th class="">  البيـــان  </th>
                                    
                                </tr> 
                                </thead>
                                
                                 <tbody>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="">  التاريخ  </th>
                                    <th class=""> اسم المستخلص  </th>
                                    <th class="TotalRefundMount">  المبلغ </th> 
                                    <th class="">  البيـــان  </th>
                                    
                                </tr>
                                </tfoot>
                            </table>
                        <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->

        <!-- Custom Refund Table End  -->


               
                <!--Fnial Custom Statment  -->

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title fontDesign">  الموقف النهائى للمستخلص  </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <!-- supplier table report -->
                            <table id="tbl-FinalCustomStatment" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                    <th class="">  عليه </th>
                                    <th class="">  له </th>
                                    <th class=""> الصافي </th>
                                    
                                </tr> 
                                </thead>
                                
                                 <tbody>
                                </tbody>
                                 
          
                                
                            </table>
                        <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->


                <style type="text/css">

                        @media print{
                          #tohide{
                            display:none;
                          }
                        }
                        </style>

                {{-- printing buuton --}}
                <div id="tohide" class="col-xs-12">
                    <div class="box">
                       
                        <div class="box-body">
                        

                        <button  onkeyup="myFunction77(event)" type="button" id="ptn" onclick="Print77()" style="width: 100%;" center class="btn btn-success">طباعة كل الجداول</button>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
                

            </div><!-- /.row -->


        </section><!-- /.content -->
        
@endsection    