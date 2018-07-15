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
        </style>

        <script src={{asset("/dist/js/admin/expensestypes.js")}} type="text/javascript"></script>
        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script type="text/javascript">
            config = <?php echo json_encode($js_config) ?>;
        </script>
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">طـــــباعة </h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="expensetype-form" style="width: 60%" class="container col-xs-5">
                                <!--    <input type="text" name="ExpenseTypeName" class="form-control" placeholder="اسم نوع المصروف">
                                    
                                    <br /><br />-->
                                   <button id="add-ExpenseType" class="btn btn-success btn-flat btn-block" type="button"><b>طباعة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='ExpenseTypeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                           <!-- <h3 class="box-title">كـــل أنواع المصروفات </h3>-->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-ExpensesTypes" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>اســم نوع المصروف</th>
                                   <!-- <th>العملية</th>-->
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($expensestypes as $expensetype)
                                <tr>
                                    <td></td>
                                    <td>{{$expensetype->ExpenseTypeName}}</td>
                                 <!--   <td>
                                        <button name="EditExpenseType_{{$expensetype->ExpenseTypeID}}" class="btn btn-flat btn-info btn-sm EditExpenseType">تعديل</button>
                                        <button name="DelExpenseType_{{$expensetype->ExpenseTypeID}}" class="btn btn-flat btn-danger btn-sm RmvExpenseType">حذف</button>
                                    </td>-->
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
