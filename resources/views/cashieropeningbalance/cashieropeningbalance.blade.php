   <!-- call template-->
    @extends('adminheader.header')

    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-4"></div>
                            <div  class="col-lg-4  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" > أضـــافـــه رصـيد افتــتاحى للخزنـــه </h3>
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

            #tbl-CashierOpeningBalance tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }
        </style>

        <script src={{asset("/dist/js/admin/cashieropeningbalance.js")}} type="text/javascript"></script>
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
<!--                            <h3 class="box-title">اضافة رصيد افتتاحى لخزنة</h3>-->
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="cashieropeningbalance-form" style="width: 60%" class="container col-xs-5">
                                      <input name="TransDate" id=""  class="form-control datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <br />
                                    <input type="text" name="Mount" class="form-control only_float" placeholder="المبلغ">
                                    <br />
                                      <select name="CashierID"
                                      mh_width="width:100%"
                                       mh_onkeyup="" tabindex="1"
                                       data-placeholder="اسم الخزنة"
                                       class="chosen-select-deselect chosen-rtl"
                                       onchange="cashiervalidation()"
                                       id="cboCashierID" >
                                      <option data-comm="0" value="0" selected ></option>
                                       @foreach($cashiers as $cashiers)

                                        <option value="{{$cashiers->CashierID}}">{{$cashiers->CashierName}}</option>

                                       @endforeach
                                       </select>
                                    <br><br>
                                      <div id="validation"  class="col-md-12 btn btn-info"></div>
                                    <br><br>
                                    <input type="text" name="Notes" class="form-control" placeholder="البيان">

                                    <br /><br />
                                    <button id="add-CashierOpeningBalance" class="btn btn-success btn-flat btn-block" type="button"><b>اضـــــــــــــــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='CashierOpeningBalanceerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كل الارصدة الافتتاحية للخزن </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-CashierOpeningBalance" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>تاريخ الحركة</th>
                                    <th>المبلغ</th>
                                    <th>اسم الخزنة</th>
                                    <th>البيان</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($opening as $opening)
                                <tr>
                                    <td></td>
                                    <td>{{date("Y/m/d",strtotime($opening->TransDate))}}</td>
                                    <td>{{$opening->Mount}}</td>
                                    <td data-val='{{$opening->Cashiers()->get()[0]->CashierID}}'>{{$opening->Cashiers()->get()[0]->CashierName}}</td>
                                    <td>{{$opening->Notes}}</td>
                                    <td>
                                        <button name="EditCashierOpeningBalance_{{$opening->TransID}}" class="btn btn-flat btn-info btn-sm EditCashierOpeningBalance">تعديل</button>
                                        <button name="DelCashierOpeningBalance_{{$opening->TransID}}" class="btn btn-flat btn-danger btn-sm RmvCashierOpeningBalance">حذف</button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->

                            <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">كشف حساب خزنة</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="accountstatement-form" style="width: 60%" class="container col-xs-5">
                                      {{-- <input name="TransDate" id=""  class="form-control datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <br /> --}}
                                    <span>من: </span>
                                    <input name="FromTransDate" id="fromdate"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <span>الى: </span>
                                    <input name="ToTransDate" id="todate"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <br />

                                      <select name="CashierID2"
                                      mh_width="width:100%"
                                       mh_onkeyup="" tabindex="1"
                                       data-placeholder="اسم الخزنة"
                                       class="chosen-select-deselect chosen-rtl"
                                       id="cboCashierID2" >
                                      <option data-comm="0" value="0" selected ></option>
                                       @foreach($cash as $cash)

                                        <option value="{{$cash->CashierID}}">{{$cash->CashierName}}</option>

                                       @endforeach
                                       </select>


                                    <br /><br />
                                    <button id="search-accountstatement" class="btn btn-success btn-flat btn-block" type="button"><b/>بحث</b/></button>
                                </div>

                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">تقرير كشف حساب الخزنة</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-accountstatement" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>

                                    <th>عن</th>
                                    <th>مدين</th>
                                    <th>دائن</th>
                                    <th>بيان</th>
                                    <th>تاريخ</th>

                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->


            </div><!-- /.row -->
        </section><!-- /.content -->


<script>
$(document).ready(function(){
$("#link14").addClass("hoverlink");
});
</script>
    @endsection
