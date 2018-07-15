    @extends('adminnoheader.noheader')
@section('content')
<!-- include js files -->

<script src={{asset("/dist/js/admin/onetotalexpenses.js")}} type="text/javascript"></script>
<!--        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->

<!--        <script src="/plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>-->

<!--<link rel="stylesheet" type="text/css" href="../../../public/dist/css/jquery.dataTables_onetotalex.css">-->
<style>

	
				.fontDesign{
							font-size: 18px;
							font-wight:bold;
							}


/*.FirsTPart{
max-height: 100px;

}
*/
/*.FirsTPart{

}*/
</style>

 <section class="content">
            <div class="row">
                <div class="col-md-12 show">
                    <div class="box box-success">
                        
                        <div class="box-header">
                            <h3 class="box-title">إجمالى مصروف واحد</h3>
                        </div>
                        <div class="box-body">
                            <div id="" class="row FirsTPart">
                                <div id="onetotalexpense-repo-form" style="width: 60%" class="container col-xs-5">
                                    <span class="fontDesign">من: </span>
                                    <input name="FromTransDate" id=""  class="form-control datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <span class="fontDesign">الى: </span>
                                    <input name="ToTransDate" id=""  class="form-control datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <br />
                                      <select name="ExpenseTypeID" 
                                            mh_width="width:100%" 
                                            mh_onkeyup="" tabindex="1" 
                                            data-placeholder="اسم نوع المصروف" 
                                            class="chosen-select-deselect chosen-rtl" 
                                            id="OneTotalExpenseTypeID" style="display:none" >
                                        <option data-comm="0" value="0" selected ></option>
                                     @foreach($onetotalexpenses as $onetotalexpenses)
                           <option value="{{$onetotalexpenses->ExpenseTypeID}}">{{$onetotalexpenses->ExpenseTypeName}}</option>
                                          @endforeach
                                        </select>
                                    <div style="visibility: hidden" id="ShowONPrint"></div>
                                        
                                          <br/>
                                    <button id="search-oneTotalExpense" class="btn btn-success btn-flat btn-block" type="button"> <b>بحث</b> </button>
                                    
                                </div>
                                <div style="width: 35%; height: inherit"  id='ExpenseTypeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
                
 
  <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كـــل أنواع المصروفات</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                        
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>         
                                             
                         <!--the data tables goes here... -->
                         <table id="tbl-OneTotalExpenses" class="table table-bordered table-striped .lasttable" dir="rtl"  cellspacing="0" width="100%" style="text-align:center" cellspacing="0" width="100%">
      <thead>

                                    <tr>
                                    <th class="">البيان</th>
                                    <th class=""> القيمة</th>
                                    <th class="">تاريخ العرض</th>
                                </tr>
                                </thead>
                  
                                 <tbody>
                                </tbody>
                             
                                            <tfoot>
                            <tr>
                              <th>البيان</th>
                              <th class="total">القيمة</th>
                              <th>تاريخ العرض</th
                           </tr>
                                </tfoot> 
                            </table>
                         
                        <!-- end of table  -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->                                          
        
@endsection          