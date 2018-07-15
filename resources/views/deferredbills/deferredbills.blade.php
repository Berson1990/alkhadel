@extends('adminnoheader.noheader')
@section('content')


        <script src={{asset("/dist/js/admin/deferredbills.js")}} type="text/javascript"></script>
<!--        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
<!--        <script src="/plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>-->
        <script src={{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}></script>
<!--        <script src="/plugins/jQueryUI/jquery-ui-1.11.4.min.js"></script>-->

<style>

.fontDesign{
    font-size: 18px;
font-wight:bold;
}
</style>
<!--select css-->
 <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<!--seelct css-->
        <section class="content">
            <div class="row">
                <div class="col-md-12 show" >
                    <div class="box box-success">
                        
                        <div class="box-header">
                            <h3 class="box-title">  عرض فواتير المعلقة </h3>
                        </div>
                        <div class="box-body">
                            <div class="FirsTPart5 row">
                                <div id="deferredbills-repo-form" style="width: 60%" class="container col-xs-5">

                                
                                    <span class="fontDesign">من: </span>
                                    <input name="FromTransDate"   class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <span class="fontDesign">الى: </span>
                                    <input name="ToTransDate"   class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
									
                                      <div style="display: none" id="ShowCustomersONPrint101"></div>
                                       <div style="display: none" id="ShowSuppliersONPrint102"></div>
                                    
                                    <!--customers -->
                                    <!--checkcustomers  onclick="checking(this)"-->
									<br />
<!--
                                    
                             <input name="checkSuppliers" type="checkbox" value="1" checked  id="check_chose_Supplisrs" /> 
                                           <label  class="fontDesign" id="chosen_SuppliersName"> إختيارالمورد  </label>
-->
                                        <!--  -->
                              <div id="print">     
                      <select name="CustomersID"  style="width: 100%"  data-placeholder="اسم التاجر"  id="abordCustomersID"> </select>
									<br>

																<br>
                                    
                             <input name="checkSuppliers" type="checkbox" value="1" checked  id="check_chose_Supplisrs" /> 
                                           <label  class="fontDesign" id="chosen_SuppliersName"> إختيارالمورد  </label>
                                        
                           <!--suppliers -->        
                                  
                                     <select name="SupplierID" style="width: 100%" data-placeholder="اسم المورد" id="SuppliersID">   </select>
                                     </div> 
                                           
	<br />
									
<!--
 <input class="radio-inline" id="rbtnIndividuale" onclick="individuale()" checked type="radio" name="rbtn" data-title="تفصيل" value="0"  />

<label class="radio-inline fontDesign" id="indi" for="rbtnIndividuale" >تفصيل</label>

<input class="radio-inline" id="rbtnCombine" onclick="combine()" type="radio" name="rbtn" data-title="تجميع" value="1" />                                 
<label class="radio-inline fontDesign" id="comb" for="rbtnCombine">تجميع</label>
                                     
-->
<!--
                                         <select name="SupplierID" 
                                            mh_width="width:100%" 
                                            mh_onkeyup="" tabindex="1" 
                                            data-placeholder="اسم المورد" 
                                            class="chosen-select-deselect chosen-rtl" 
                                            id="SuppliersID">
                                        <option data-comm="0" value="0" selected ></option>
                                    @foreach($totalsuppliers as $totalsupplier)
                           <option value="{{$totalsupplier->SupplierID}}">{{$totalsupplier->SupplierName}}</option>
                                          @endforeach
                                        </select>
                                    
-->
<!--
        	<br />                             
        	<br />                             
-->
            
									
                                    <button id="search-deferredbills" class="show btn btn-success btn-flat btn-block" type="button"><b>بحث</b></button> 
                                </div>
                                <div style="width: 35%; height: inherit"  id='SuTypeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
        <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> عرض الفواتير المعلقة</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
<!--
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                 header div in the Print mode 
                            </div>
-->
                            <table id="tbl-deferredbills" dir="rtl" class="table table-bordered table-striped" style="text-align:center">

                                <thead>                            
                                    <tr>
                                    <th >  التاريخ </th>
                                    <th >  العلامة </th>
                                    <th class="whendcombine" > الصنف </th>
                                    <th > اسم التاجر </th>
                                    <th >   اسم المورد</th>
                                         <th >  الاجمالى </th>
                                    <th >  مدة التعليق </th>
                                </tr>
                                </thead>
								
								
								<tbody>
                                </tbody>
								
                                 <tfoot>
                            <tr>
                                    <th >  التاريخ </th>
                                    <th >  العلامة </th>
                                    <th class="whendcombine" > الصنف </th>
                                    <th > اسم التاجر </th>
                                    <th >   اسم المورد</th>
								   <th class="totaldefebill" >  </th>
                               
                                    <th >  مدة التعليق </th>
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

@section('jscript')
  
<!--
<script type="text/javascript">
	$(document).ready(function() {
  $('#SuppliersID').select2();
		
	$("#SuppliersID").select2({
  placeholder: "أسم العميل "

});	
		
		
		});
</script>
-->
@endsection