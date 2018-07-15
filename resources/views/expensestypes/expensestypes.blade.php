  
@extends('adminnoheader.noheader')

    @section('content')
    
        <style type="text/css">
            body
            {
                counter-reset: Serial;           /* Set the Serial counter to 0 */
            }

            #tbl-ExpensesTypes tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
            content: counter(Serial); /* Display the counter */
				
            }
			
				.fontDesign{
							font-size: 16px;
							font-wight:bold;
							}
        </style>
    
        <style type="text/css">
         /*
            @media print{
                .panel-heading{display:none;}
                .box-title{display:none;}
                .box-header{display:none;}
                .input-sm{display:none;}
                .col-xs-6{display:none;}
                .removable{display:none;}
                .box{border-top:0px;}
                #expensetype-form{display:none;}
                #tbl-ExpensesTypes_filter{display:none;}
                #print{display:none;}
            }
      */
            #tbl-ExpensesTypes_paginate #tbl-ExpensesTypes_info {margin:10px;}
            .DTTT{
                margin:10px;
            }
            
            div.dataTables_paginate ul.pagination {
	margin: -1px 0;
	white-space: nowrap;
	padding-top:11px;
}
           
        </style>

        <script src={{asset("/dist/js/admin/expensestypes.js")}} type="text/javascript"></script>
<!--        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
<!--
        <script src="/plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>
        <script src="/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
-->


        <script type="text/javascript">
            config = <?php echo json_encode($js_config) ?>;
        </script>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        
                        <div class="box-header">
                            <h3 class="box-title">اضافة نوع مصروف جديد</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="expensetype-form" style="width: 60%" class="container col-xs-5">
                                    <input type="text" name="ExpenseTypeName" class="form-control" placeholder="اسم نوع المصروف">
									<br />
									        <select name="ExpensesGroupID" 
                                            mh_width="width:100%" 
                                            mh_onkeyup="" tabindex="1" 
                                            data-placeholder="مجموعات المصروفات" 
                                            class="chosen-select-deselect chosen-rtl" 
                                            id="cboExpenseGroupID" >
                                        <option data-comm="0" value="0" selected ></option>
                                        @foreach($expensesgroup as $expensesgroups)
                                                  
                                   <option value="{{$expensesgroups->ExpensesGroupID}}">{{$expensesgroups->ExpensesGroupName}}</option>
                                        @endforeach
                                    </select>
                                    
                                    <br /><br />
                                    <button id="add-ExpenseType" class="btn btn-success btn-flat btn-block" type="button"><b>اضــــــــــــــــــــــــــــــــــافة</b></button>
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

                            <table id="tbl-ExpensesTypes" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                
                                <thead>

                                    <tr>
                                    <th class="printable">م</th>
                                    <th class="printable">اســم نوع المصروف</th>
                                    <th class="printable">اســم مجموعات المصروفات</th>
                                    <th class="removable">العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($expensestypes as $expensetype)
                                <tr>
                                    
                                    <td class="printable"></td>
                                    <td  class="printable">{{$expensetype->ExpenseTypeName}}</td>
                                      <td data-val='{{ count($expensetype->ExpensesGroup()->get()) > 0 ?   $expensetype->ExpensesGroup()->get()[0]->ExpensesGroupID : 0}}'>{{ count($expensetype->ExpensesGroup()->get()) > 0 ? $expensetype->ExpensesGroup()->get()[0]->ExpensesGroupName : '' }}</td>
                                    <td class="removable">
                                        <button name="EditExpenseType_{{$expensetype->ExpenseTypeID}}" class="btn btn-flat btn-info btn-sm EditExpenseType">تعديل</button>
                                        <button name="DelExpenseType_{{$expensetype->ExpenseTypeID}}" class="btn btn-flat btn-danger btn-sm RmvExpenseType">حذف</button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
<!--            <button type="button" onclick="printing()" id="print" class="btn btn-primary btn-flat btn-block"><b>تعديل للطباعة</b></button>-->


        </section><!-- /.content -->
        
    @endsection
