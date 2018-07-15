    @extends('adminheader.header')

    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-5"></div>
                            <div  class="col-lg-2  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >  تحويل من خزنه لخزنه   </h3>
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

            #tbl-CashierTransfer tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }
        </style>

        <script src={{asset("/dist/js/admin/cashiertransfer.js")}} type="text/javascript"></script>
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
<!--                            <h3 class="box-title">اضافة تحويل من خزنة لخزنة</h3>-->
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="cashiertransfer-form" style="width: 60%" class="container col-xs-5">
                                      <input name="TransDate" id=""  class="form-control datepicker" type="text" placeholder="تاريخ الحركة (يوم/شهر/سنة)" />
                                    <br />

                                    <select name="FromCashierID"
                                            mh_width="width:100%"
                                            mh_onkeyup="" tabindex="1"
                                            data-placeholder="من خزنة"
                                            class="chosen-select-deselect chosen-rtl"
                                                 onchange="cashiervalidationFROM()"
                                            id="cboFromCashierID" >

                                        <option data-comm="0" value="0" selected ></option>
                                        @foreach($cashiers as $cashier)

                                            <option value="{{$cashier->CashierID}}">{{$cashier->CashierName}}</option>

                                        @endforeach
                                    </select>
                                     <div id="validation"  class="col-md-12 btn btn-info"></div>
                                      <br /><br />
                                    <br><br>

                                    <select name="ToCashierID"
                                            mh_width="width:100%"
                                            mh_onkeyup="" tabindex="1"
                                            data-placeholder="الى خزنة"
                                            class="chosen-select-deselect chosen-rtl"
                                            onchange="cashiervalidationTO()"
                                            id="cboToCashierID" >
                                        <option data-comm="0" value="0" selected ></option>
                                        @foreach($cashiers as $cashier)

                                            <option value="{{$cashier->CashierID}}">{{$cashier->CashierName}}</option>

                                        @endforeach
                                    </select>
                                    <br><br>
                                     <div id="validation2"  class="col-md-12 btn btn-info"></div>
                                      <br /><br />

                                    <input type="text" name="Mount" class="form-control only_float" placeholder="القيمة">
                                    <br />
                                    <input type="text" name="Notes" class="form-control" placeholder="البيان">

                                    <br /><br />
                                    <button id="add-CashierTransfer" class="btn btn-success btn-flat btn-block" type="button"><b>اضـــــــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='CashierTransfererror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كل التحويلات من خزن الى خزن </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-CashierTransfer" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>تاريخ الحركة (يوم/شهر/سنة)</th>
                                    <th>من خزنة</th>
                                    <th>الى خزنة</th>
                                    <th>المبلغ</th>
                                    <th>البيان</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cashiertransfer as $cashiertransfer)
                                <tr>
                                    <td></td>
                                    <td>{{date("Y/m/d",strtotime($cashiertransfer->TransDate))}}</td>
                                    <td data-val='{{$cashiertransfer->FromCashiers()->get()[0]->CashierID}}'>{{$cashiertransfer->FromCashiers()->get()[0]->CashierName}}</td>
                                    <td data-val='{{$cashiertransfer->ToCashiers()->get()[0]->CashierID}}'>{{$cashiertransfer->ToCashiers()->get()[0]->CashierName}}</td>
                                    <td>{{$cashiertransfer->Mount}}</td>
                                    <td>{{$cashiertransfer->Notes}}</td>
                                    <td>
                                        <button name="EditCashierTransfer_{{$cashiertransfer->TransID}}" class="btn btn-flat btn-info btn-sm EditCashierTransfer">تعديل</button>
                                        <button name="DelCashierTransfer_{{$cashiertransfer->TransID}}" class="btn btn-flat btn-danger btn-sm RmvCashierTransfer">حذف</button>
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
$("#link15").addClass("hoverlink");
});
</script>
    @endsection
