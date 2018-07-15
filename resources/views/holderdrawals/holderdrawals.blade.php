    @extends('adminheader.header')

    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-4"></div> 
                            <div  class="col-lg-3  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >  تســجيل مسحوبات المــلاك </h3>
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

            #tbl-HolderDrawals tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }
        </style>
        
<!--
<script> 
	$(document).ready(function(){

		$(".datepicker").datepicker('setDate', new Date());

});


</script>
-->
        <script src={{asset("/dist/js/admin/holderdrawals.js")}} type="text/javascript"></script>
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
<!--                            <h3 class="box-title">اضافة خصم مسموح به</h3>-->
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="holderdrawal-form" style="width: 60%" class="container col-xs-5">
                                      <input name="TransDate" id=""  class="form-control datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <br />
                                    <input type="text" name="Mount" class="form-control only_float" placeholder="المبلغ">
                                    <br />
                                    <select name="StockHolderID" 
                                            mh_width="width:100%" 
                                            mh_onkeyup="" tabindex="1" 
                                            data-placeholder="اسم المالك" 
                                            class="chosen-select-deselect chosen-rtl" 
                                            id="cboStockHolderID" >
                                        <option data-comm="0" value="0" selected ></option>
                                        @foreach($stockholders as $stockholder)

                                            <option value="{{$stockholder->StockHolderID}}">{{$stockholder->StockHolderName}}</option>

                                        @endforeach
                                    </select>
                                    <br><br>
                                    <input type="text" name="Notes" class="form-control" placeholder="البيان">

                                    <br /><br />
                                    <button id="add-HolderDrawal" class="btn btn-success btn-flat btn-block" type="button"><b>اضـــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='HolderDrawalserror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كل الخصم المسموح به </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-HolderDrawals" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>تاريخ الحركة</th>
                                    <th>المبلغ</th>
                                    <th>اسم المالك</th>
                                    <th>البيان</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($holderdrawals as $holderdrawal)
                                <tr>
                                    <td></td>
                                    <td>{{date("Y/m/d",strtotime($holderdrawal->TransDate))}}</td>
                                    <td>{{$holderdrawal->Mount}}</td>
                                    <td data-val='{{$holderdrawal->StockHolders()->get()[0]->StockHolderID}}'>{{$holderdrawal->StockHolders()->get()[0]->StockHolderName}}</td>
                                    <td>{{$holderdrawal->Notes}}</td>
                                    <td>
                                        <button name="EditHolderDrawal_{{$holderdrawal->TransID}}" class="btn btn-flat btn-info btn-sm EditHolderDrawal">تعديل</button>
                                        <button name="DelHolderDrawal_{{$holderdrawal->TransID}}" class="btn btn-flat btn-danger btn-sm RmvHolderDrawal">حذف</button>
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
$("#link21").addClass("hoverlink");
});
</script>
    @endsection
