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
        </style>

 <script src={{asset("/dist/js/admin/expensestypes.js")}} type="text/javascript"></script>
        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="/plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>
        <script src="/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <script type="text/javascript">
            config = <?php echo json_encode($js_config) ?>;
        </script>

 <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كـــل أنواع المصروفات </h3>
                        </div><!-- /.box-header -->

 <div class="box-body">
                            <table id="tbl-ExpensesTypes" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th class="printable">م</th>
                                    <th class="printable">اســم نوع المصروف</th>
                                    <th class="removable">العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($expensestypes as $expensetype)
                                <tr>
                                    
                                    <td class="printable"></td>
                                    <td class="printable">{{$expensetype->ExpenseTypeName}}</td>
                                    </div>
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