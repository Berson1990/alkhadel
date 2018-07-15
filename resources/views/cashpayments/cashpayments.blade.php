@extends('adminnoheader.noheader')

@section('content')

    <style type="text/css">
        body {
            counter-reset: Serial; /* Set the Serial counter to 0 */
        }

        #tbl-CashPayments tr td:nth-child(1):before {
            counter-increment: Serial; /* Increment the Serial counter */
            /*content: "Serial is: " counter(Serial); / Display the counter */
            content: counter(Serial); /* Display the counter */
        }
    </style>

    <script src={{asset("/dist/js/admin/cashpayments.js")}} type="text/javascript"></script>
    <!--<script src={{asset("/plugins/datatables/jquery.dataTables.js")}} type="text/javascript"></script>-->
    <!-- <script src={{asset ("/plugins/jQueryUI/jquery-ui-1.11.4.min.js")}}></script>-->
    <!-- <script src={{asset("/plugins/datatables/dataTables.tableTools.js")}} type="text/javascript"></script>-->

    <script type="text/javascript">
       var config3 = <?php echo json_encode($js_config) ?>;
    </script>
    <script src="{{asset('/plugins/select2-4.0.0/dist/js/select2.full.min.js')}}"></script>
    <!--select css-->
    <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <!--seelct css-->
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">اضافة دفع نقدى</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div id="cashpayment-form" style="width: 60%" class="container col-xs-5">
                                <input name="TransDate" id="" class="form-control datepicker" type="text"
                                       placeholder="تاريخ الحركة (يوم/شهر/سنة)"/>
                                <br/>

                                <select name="SupplierID"
                                        style="width:100%"

                                        data-placeholder="اسم المورد (الفلاح)"

                                        id="cboSupplierID">

                                </select>

                                <br> <br>

                                <input type="text" name="Mount" class="form-control only_float" placeholder="القيمة">
                                <br/>
                                <select name="CashierID"
                                        style="width:100%"
                                        data-placeholder="اسم الخزنة"
                                        onchange="cashiervalidation()"
                                        id="cboCashierID">

                                </select>
                                <br><br>
                                <div id="validation" class="col-md-12 btn btn-info"></div>
                                <br><br>
                                {{--   <select name="BankID"
                                          style="width:100%"

                                          data-placeholder="اسم البنك"

                                          id="cboBankID" >

                                  </select> --}}
                                {{-- <br><br> --}}
                                <input type="text" name="Notes" class="form-control" placeholder="البيان">

                                <br/><br/>
                                <button id="add-CashPayment"
                                        class="btn btn-success btn-flat btn-block" type="button"><b>اضــــــــــــــــــافة</b>
                                </button>
                            </div>
                            <div style="width: 35%; height: inherit" id='CashPaymentserror'
                                 class="container col-xs-3"></div>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

                <script type="text/javascript">

                    //   $("#tbl-CashPayments").DataTable();
                </script>

                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">كل المدفوعات النقدية </h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <table id="tbl-CashPayments" dir="rtl" class="table table-bordered table-striped"
                                       style="text-align:center">
                                    <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>تاريخ الحركة</th>
                                        <th>اسم المورد (الفلاح)</th>
                                        <th>المبلغ</th>
                                        <th>اسم الخزنة</th>
                                        <th>البيان</th>
                                        <th>العملية</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @foreach($cashpayments as $cashpayment)

                                        <tr>
                                            <td></td>
                                            <td>{{date("Y/m/d",strtotime($cashpayment->TransDate))}}</td>
                                            <td data-val='{{$cashpayment->Suppliers()->get()[0]->SupplierID}}'>{{$cashpayment->Suppliers()->get()[0]->SupplierName}}</td>

                                            <td class="sum sum1 ">{{$cashpayment->Mount}}</td>

                                            @if($cashpayment["CashierID"]== 0)
                                                <td data-val=''></td>
                                            @else
                                                <td data-val='{{$cashpayment->Cashiers()->get()[0]->CashierID}}'>{{$cashpayment->Cashiers()->get()[0]->CashierName}}</td>
                                            @endif


                                            <td>{{$cashpayment->Notes}}</td>
                                            <td>
                                                <button name="EditCashPayment_{{$cashpayment->TransID}}"
                                                        class="EditCashPayment btn btn-flat btn-info btn-sm">تعديل
                                                </button>
                                                <button name="DelCashPayment_{{$cashpayment->TransID}}"
                                                        class="btn btn-flat btn-danger btn-sm RmvCashPayment">حذف
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach


                                    </tbody>

                                    <tfoot>
                                    <tr>

                                        <th colspan="3" style="text-align:right"></th>
                                        <th class="total">
                                        <th colspan="3" style="text-align:right"></th>


                                    </tr>
                                    </tfoot>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
        </div>
    </section><!-- /.content -->
    <script>


    </script>
@endsection

