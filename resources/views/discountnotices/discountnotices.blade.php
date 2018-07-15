    @extends('adminheader.header')


    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-4"></div> 
                            <div  class="col-lg-3  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >   أضـــافه أشــعــار الخــصم </h3>
                            </div>
                             <div class="col-lg-4"></div>
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
        <script src={{asset("/dist/js/admin/discountnotices.js")}} type="text/javascript"></script>
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
<!--                            <h3 class="box-title">اضافة شعار الخصم</h3>-->
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="discountnotice-form" style="width: 60%" class="container col-xs-5">
                                    <input type="text" name="CheckNo" class="form-control" placeholder="رقم الشيك">
                                    <br />

                                    <input type="text" name="NoticeNo" class="form-control" placeholder="رقم الإشعار">


                                  <br />
                                    <button id="add-DiscountNotice" class="btn btn-success btn-flat btn-block" type="button"><b>اضــــــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='discountnoticeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كـــل إشعارات الخصم </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-DiscountNotices" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>رقم الشيك</th>
                                    <th>رقم الإشعار</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($discountnotices as $discountnotice)
                                <tr>
                                    <td></td>
                                    <td>{{$discountnotice->CheckNo}}</td>
                                    <td>{{$discountnotice->NoticeNo}}</td>
                                    <td>
                                        <button name="EditDiscountNotice_{{$discountnotice->TransID}}"  class="btn btn-flat btn-info btn-sm EditDiscountNotice">تعديل</button>
                                        <button name="DelDiscountNotice_{{$discountnotice->TransID}}" class="btn btn-flat btn-danger btn-sm RmvDiscountNotice">حذف</button>
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
$("#link20").addClass("hoverlink");
});
</script>
    @endsection
