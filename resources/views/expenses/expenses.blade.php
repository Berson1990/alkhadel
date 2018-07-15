    @extends('adminnoheader.noheader')

    @section('content')

        <style type="text/css">
            body
            {
                counter-reset: Serial;           /* Set the Serial counter to 0 */
            }

            #tbl-Expenses tr td:nth-child(1):before
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


        <script src={{asset("/dist/js/admin/expenses.js")}} type="text/javascript"></script>
<!--        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
        <script type="text/javascript">
            config = <?php echo json_encode($js_config) ?>;


        </script>
<script>
	$(document).ready(function(){
		$(".datepicker").datepicker('setDate', new Date());

});

</script>

        <!-- Main content -->
        <section class="content">
            <div  class="row">

                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">اضافة مصروف جديد</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="expense-form" style="width: 60%" class="container col-xs-5">
                                      <input name="TransDate" id=""  class="form-control datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <br />
                                    <input type="text" name="Mount" class="form-control only_float" placeholder="المبلغ">
									      <br />
                                    <select name="ExpensesGroupID"
                                            mh_width="width:100%"
                                            mh_onkeyup="" tabindex="1"
                                            data-placeholder="مجموعات المصروفات"
                                            class="chosen-select-deselect chosen-rtl"
                                            id="cboExpenseGroupID" >
                                        <option data-comm="0" value="0" selected ></option>
                                        @foreach($group as $expensesgroups)

                                   <option value="{{$expensesgroups->ExpensesGroupID}}">{{$expensesgroups->ExpensesGroupName}}</option>
                                        @endforeach
                                    </select>

                                    <br />    <br />
                                    <select name="ExpenseTypeID"
                                            mh_width="width:100%"
                                            mh_onkeyup="" tabindex="1"
                                            data-placeholder="اسم نوع المصروف"
                                            class="chosen-select-deselect chosen-rtl"
                                            id="cboExpenseTypeID" >
<!--
                                        <option data-comm="0" value="0" selected ></option>
                                        @foreach($expensestypes as $expensetype)

                                            <option value="{{$expensetype->ExpenseTypeID}}">{{$expensetype->ExpenseTypeName}}</option>
                                        @endforeach
-->
                                    </select>

                                    <br><br>
									     <select name="CashierID"
                                            mh_width="width:100%"
                                            mh_onkeyup="" tabindex="1"
                                            data-placeholder=" الخزنه"
                                            class="chosen-select-deselect chosen-rtl"
                                            onchange="cashiervalidation()"
                                            id="cboCashierID" >
                                        <option data-comm="0" value="0" selected ></option>
                                        @foreach($cashiers as $cashiers)

                                   <option value="{{$cashiers->CashierID}}">{{$cashiers->CashierName}}</option>
                                        @endforeach
                                    </select>
									<br /><br />


                                <div id="validation"  class="col-md-12 btn btn-info"></div>
                                      <br /><br />
                                    <input type="text" name="Notes" class="form-control" placeholder="البيان">

                                    <br />
                                    <button id="add-Expense" class="btn btn-success btn-flat btn-block" type="button"><b>اضــــــــــــــــــــــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='Expenseserror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كل المصروفات </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                         <table id="tbl-Expenses" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>تاريخ الحركة</th>
                                    <th>المبلغ</th>
                                    <th>اسم مجموعات المصروفات</th>
                                    <th>اسم نوع المصروف</th>
                                    <th> الخزنه   </th>
                                    <th>البيان</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody
									   <?php
//												echo"<pre>";
//											var_dump($expenses[0]['ExpensesGroup']);
//									   			echo"</pre>";
//											die();
?>


                                @foreach($expenses as $expense)
                                <tr>
                                    <td></td>
                                    <td>{{date("Y/m/d",strtotime($expense->TransDate))}}</td>
                                    <td>{{$expense->Mount}}</td>
                                    <td data-val='{{ count($expense->ExpensesGroup()->get()) > 0 ?   $expense->ExpensesGroup()->get()[0]->ExpensesGroupID : 0}}'>{{ count($expense->ExpensesGroup()->get()) > 0 ? $expense->ExpensesGroup()->get()[0]->ExpensesGroupName : '' }}</td>
                                    <td data-val='{{ count($expense->ExpensesTypes()->get()) > 0 ?   $expense->ExpensesTypes()->get()[0]->ExpenseTypeID : 0}}'>{{ count($expense->ExpensesTypes()->get()) > 0 ? $expense->ExpensesTypes()->get()[0]->ExpenseTypeName : '' }}</td>
                                    <td data-val='{{ count($expense->Cashiers()->get()) > 0 ?   $expense->Cashiers()->get()[0]->CashierID : 0}}'>{{ count($expense->Cashiers()->get()) > 0 ? $expense->Cashiers()->get()[0]->CashierName : '' }}</td>
                                    <td>{{$expense->Notes}}</td>
                                    <td>
                                        <button name="EditExpense_{{$expense->TransID}}" class="btn btn-flat btn-info btn-sm EditExpense">تعديل</button>
                                        <button name="DelExpense_{{$expense->TransID}}" class="btn btn-flat btn-danger btn-sm RmvExpense">حذف</button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    @endsection
