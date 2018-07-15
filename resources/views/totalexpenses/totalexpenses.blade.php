@extends('adminnoheader.noheader')
@section('content')

<style>tr.group,
            div.dataTables_paginate ul.pagination {
	margin: -1px 0;
	white-space: nowrap;
	padding-top:11px;
}

tr.group:hover {
    background-color: #ddd !important;
}</style>

<style>
#tbl-TotalExpenses_length{display: none;}    

				.fontDesign{
							font-size: 18px;
							font-wight:bold;
							}
</style>
        <script src={{asset("/dist/js/admin/totalexpenses.js")}} type="text/javascript"></script>
<!--        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
<!--        <script src="/plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>-->

        <section class="content">
            <div class="row">
                <div class="col-md-12 show" >
                    <div class="box box-success">
                        
                        <div class="box-header">
                            <h3 class="box-title">إجمالى المصروفات</h3>
                        </div>
                        <div class="box-body">
                            <div class="FirsTPart2 row">
                                <div id="expensetype-repo-form" style="width: 60%" class="container col-xs-5">
                                    <span class="fontDesign">من: </span>
                                    <input name="FromTransDate" id="fromdate"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <span class="fontDesign">الى: </span>
                                    <input name="ToTransDate" id="todate"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                  <br />
                                    <button id="search-TotalExpense" class="show btn btn-success btn-flat btn-block" type="button"><b>بحث</b></button> 
                                </div>
                                <div style="width: 35%; height: inherit"  id='ExpenseTypeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
                    

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كـــل أنواع المصروفات </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                             <table id="tbl-TotalExpenses" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                 <thead>
                                    <tr>
                                        <th>البيان</th>
                                        <th>اسم مجموعه المصروف</th>
                                        <th>اسم الخزنه</th>
                                        <th >القيمة</th>
                                        <th>نوع المصروف</th>
                                        <th>التاريخ</th>
                                        
                                    </tr>
                                </thead>
                                 <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>البيان</th>
                                          <th>اسم مجموعه المصروف</th>
                                        <th>اسم الخزنة </th>
                                        <th class="totalexpnses">القيمة</th>
                                        <th>نوع المصروف</th>
                                        <th>التاريخ</th>
                                    </tr>
                                </tfoot >
                            </table>
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->

                
            </div><!-- /.row -->


        </section><!-- /.content -->
        
@endsection    