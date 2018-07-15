    @extends('adminheader.header')

    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-5"></div>
                            <div  class="col-lg-2  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" > تحويل من بنك لخزنه </h3>
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

            #tbl-BankCashierTransfer tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }
        </style>

        <script src={{asset("/dist/js/admin/bankcashiertransfer.js")}} type="text/javascript"></script>
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
<!--                            <h3 class="box-title">اضافة تحويل من بنك لخزنة</h3>-->
                        </div>
                        <div class="box-body">
                            <div class="row">

                                <div id="bankcashiertransfer-form" style="width: 60%" class="container col-xs-5">

                                      <input name="TransDate" id=""  class="form-control datepicker" type="text" placeholder="تاريخ الحركة (يوم/شهر/سنة)" />
                                    <br />

                                    <select name="BankID"
                                            mh_width="width:100%"
                                            mh_onkeyup="" tabindex="1"
                                            data-placeholder="اسم البنك"
                                            class="chosen-select-deselect chosen-rtl"
                                            id="cboBankID" >
                                        <option data-comm="0" value="0" selected ></option>
                                        @foreach($banks as $bank)

                                            <option value="{{$bank->BankID}}">{{$bank->BankName}}</option>

                                        @endforeach
                                    </select>

                                    <br><br>

                                    <select name="CashierID"
                                            mh_width="width:100%"
                                            mh_onkeyup="" tabindex="1"
                                            data-placeholder="اسم الخزنة"
                                            class="chosen-select-deselect chosen-rtl"
                                            onchange="cashiervalidation()"
                                            id="cboCashierID" >
                                        <option data-comm="0" value="0" selected ></option>
                                        @foreach($cashiers as $cashier)

                                            <option value="{{$cashier->CashierID}}">{{$cashier->CashierName}}</option>

                                        @endforeach
                                    </select>

                                    <br /><br />

                                <div id="validation"  class="col-md-12 btn btn-info"></div>
                                      <br /><br />
                                    <input type="text" name="Mount" class="form-control only_float" placeholder="المبلغ">
                                    <br />

                                    <input type="text" name="Notes" class="form-control" placeholder="البيان">

                                    <br /><br />
                                    <button id="add-BankCashierTransfer" class="btn btn-success btn-flat btn-block" type="button"><b>اضـــــــــــــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='BankCashierTransfererror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كل التحويلات من البنوك للخزن </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-BankCashierTransfer" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>تاريخ الحركة (يوم/شهر/سنة)</th>
                                    <th>الى البنك</th>
                                    <th>اسم خزنة</th>
                                    <th>المبلغ</th>
                                    <th>البيان</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bankcashiertransfer as $bankcashiertransfer)
                                <tr>
                                    <td></td>
                                    <td>{{date("Y/m/d",strtotime($bankcashiertransfer->TransDate))}}</td>
                                    <td data-val='{{$bankcashiertransfer->Banks()->get()[0]->BankID}}'>{{$bankcashiertransfer->Banks()->get()[0]->BankName}}</td>
                                    <td data-val='{{$bankcashiertransfer->Cashiers()->get()[0]->CashierID}}'>{{$bankcashiertransfer->Cashiers()->get()[0]->CashierName}}</td>
                                    <td>{{$bankcashiertransfer->Mount}}</td>
                                    <td>{{$bankcashiertransfer->Notes}}</td>
                                    <td>
                                        <button name="EditBankCashierTransfer_{{$bankcashiertransfer->TransID}}" class="btn btn-flat btn-info btn-sm EditBankCashierTransfer">تعديل</button>
                                        <button name="DelBankCashierTransfer_{{$bankcashiertransfer->TransID}}" class="btn btn-flat btn-danger btn-sm RmvBankCashierTransfer">حذف</button>
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
$("#link18").addClass("hoverlink");
});
</script>
    @endsection
