    @extends('adminheader.header')


    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-5"></div> 
                            <div  class="col-lg-2  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >أضــافة  موظــف  جديـد</h3>
                            </div>
                             <div class="col-lg-5"></div>
                    </div>
        </section>
    @endsection


    @section('content')
        <style type="text/css">
            body
            {
                counter-reset: Serial;           /* Set the Serial counter to 0 */
            }

            tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
            content: counter(Serial); /* Display the counter */
            }
        </style>
        <script src={{asset("/dist/js/admin/employees.js")}} type="text/javascript"></script>
        <script src={{asset("/plugins/datatables/jquery.dataTables.js")}} type="text/javascript"></script>
        <script type="text/javascript">
            config = <?php echo json_encode($js_config) ?>;
        </script>
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
<!--                            <h3 class="box-title fontDesign">اضافة موظف جديد</h3>-->
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="employee-form" style="width: 60%" class="container col-xs-5 fontDesign">
                                    <input type="text" name="EmployeeName" class="form-control" placeholder="اسم الموظف">
                                    
                                    <br /><br />
                                    <button id="add-Employee" class="btn btn-success btn-flat btn-block fontDesign" type="button"><b>اضــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='Employeeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title fontDesign">كـــل الموظفين </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-Employees" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>اســم الموظف</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                <tr>
                                    <td></td>
                                    <td>{{$employee->EmployeeName}}</td>
                                    <td>
                                        <button name="EditEmployee_{{$employee->EmployeeID}}" class="btn btn-flat btn-info btn-sm EditEmployee">تعديل</button>
                                        <button name="DelEmployee_{{$employee->EmployeeID}}" class="btn btn-flat btn-danger btn-sm RmvEmployee">حذف</button>
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
<script> 
$(document).ready(function(){    
$("#link03").addClass("hoverlink");
});
</script>
    @endsection
