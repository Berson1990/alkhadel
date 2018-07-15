
 @extends('adminnoheader.noheader')

    @section('header')
<!--
        <section class="content-header">
            <h1>
                <small> </small>
            مجموعات المصروفات
            </h1>
            <ol class="breadcrumb">
                <li><a href="/dashboard"><i class="fa fa-dashboard"></i> الصفحة الرئيسية</a></li>
                <li class="active"><i class="fa fa-tags"></i> مجموعات المصروفات</li>
            </ol>
        </section>
-->
    @endsection

    @section('content')

        <style type="text/css">
            body
            {
                counter-reset: Serial;           /* Set the Serial counter to 0 */
            }

           #tbl-ExpensesGroup tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }
			
			
				.fontDesign{
							font-size: 18px;
							font-wight:bold;
							}
        </style>
        
        <script src={{asset("/dist/js/admin/expensesgroup.js")}} type="text/javascript"></script>
<!--        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
        <script type="text/javascript">
            config = <?php echo json_encode($js_config) ?>;
        </script>        
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">اضافة مجموعة  مصروفات جديدة</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="expensesgroup-form" style="width: 60%" class="container col-xs-5">
                                    <input type="text" name="ExpensesGroupName" class="form-control" placeholder="اســــم المــجموعة">
                                    <br />
                                                  
                            

                                
                                    <button id="add-ExpensesGroup" class="btn btn-success btn-flat btn-block" type="button"><b>اضــــــــــــــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='ExpensesGrouperror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">  </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-ExpensesGroup" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>اسم المجموعة </th>
                                         <th>العملية</th>
                                   
                                </tr>
                                </thead>
                                <tbody>
                           @foreach($expensesgroup as $expensesgroup)
                                <tr>
                                    <td></td>
                                    <td>{{$expensesgroup->ExpensesGroupName}}</td>
                                  
                                    <td>
                                        <button name="EditExpenses_{{$expensesgroup->ExpensesGroupID}}" class="btn btn-flat btn-info btn-sm EditExpenses">تعديل</button>
                                        <button name="DelExpenses_{{$expensesgroup->ExpensesGroupID}}" class="btn btn-flat btn-danger btn-sm RmvExpenses">حذف</button>
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
