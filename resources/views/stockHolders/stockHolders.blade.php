    @extends('adminheader.header')


    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-5"></div> 
                            <div  class="col-lg-2  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >أضــافة  مـالك   جديـد</h3>
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
        <script src={{asset("/dist/js/admin/stockHolders.js")}} type="text/javascript"></script>
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
<!--                            <h3 class="box-title">اضافة مالك جديدة</h3>-->
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="stockHolder-form" style="width: 60%" class="container col-xs-5">
                                    <input type="text" name="StockHolderName" class="form-control" placeholder="اسم المالك">
                                    <br />

                                    <input type="text" name="StockHolderPercentage" class="form-control only_float" placeholder="النسبــة">


                                    <br /><br />
                                    <button id="add-StockHolder" class="btn btn-success btn-flat btn-block" type="button"><b>اضــــــــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='StockHoldererror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كـــل المــلاك </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-StockHolders" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>اســم المــالك</th>
                                    <th>النسبــة</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($stockHolders as $stockHolder)
                                <tr>
                                    <td></td>
                                    <td>{{$stockHolder->StockHolderName}}</td>
                                    <td>{{$stockHolder->StockHolderPercentage}}</td>
                                    <td>
                                        <button name="EditStockHolder_{{$stockHolder->StockHolderID}}" class="btn btn-flat btn-info btn-sm EditStockHolder">تعديل</button>
                                        <button name="DelStockHolder_{{$stockHolder->StockHolderID}}" class="btn btn-flat btn-danger btn-sm RmvStockHolder">حذف</button>
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
$("#link09").addClass("hoverlink");
});
</script>
    @endsection
