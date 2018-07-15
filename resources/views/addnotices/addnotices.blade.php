    @extends('adminheader.header')


    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-4"></div> 
                            <div  class="col-lg-3 btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >أضــافة  اشــعار  أضــافة</h3>
                            </div>
                             <div class="col-lg-3"></div>
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
        <script src={{asset("/dist/js/admin/addnotices.js")}} type="text/javascript"></script>
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
<!--                            <h3 class="box-title">اضافة شعار اضافة</h3>-->
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="addnotice-form" style="width: 60%" class="container col-xs-5">
                                    <input type="text" name="CheckNo" class="form-control" placeholder="رقم الشيك">
                                    <br />

                                    <input type="text" name="NoticeNo" class="form-control" placeholder="رقم الإشعار">


                                    <br>
                                    <button id="add-AddNotice" class="btn btn-success btn-flat btn-block" type="button"><b>اضــــــــــــــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='addnoticeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كـــل إشعارات الإضافة </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-AddNotices" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>رقم الشيك</th>
                                    <th>رقم الإشعار</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($addnotices as $addnotice)
                                <tr>
                                    <td></td>
                                    <td>{{$addnotice->CheckNo}}</td>
                                    <td>{{$addnotice->NoticeNo}}</td>
                                    <td>
                                        <button name="EditAddNotice_{{$addnotice->TransID}}"  class="btn btn-flat btn-info btn-sm EditAddNotice">تعديل</button>
                                        <button name="DelAddNotice_{{$addnotice->TransID}}" class="btn btn-flat btn-danger btn-sm RmvAddNotice">حذف</button>
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
$("#link19").addClass("hoverlink");
});
</script>
    @endsection
