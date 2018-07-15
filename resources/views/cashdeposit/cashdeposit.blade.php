@extends('adminnoheader.noheader')


    @section('content')

        <style type="text/css">
            body
            {
                counter-reset: Serial;           /* Set the Serial counter to 0 */
            }

            #tbl-CashDeposit tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }
        </style>

        <script src={{asset("/dist/js/admin/cashdeposit.js")}} type="text/javascript"></script>
<!--         <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
        <script type="text/javascript">
            config3 = <?php echo json_encode($js_config) ?>;


        </script>


    <script src={{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}></script>
<!--       <script src="/plugins/jQueryUI/jquery-ui-1.11.4.min.js"></script>-->

 <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">اضافة مقبوض نقدى</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="cashdeposit-form" style="width: 60%" class="container col-xs-5">
                                      <input name="TransDate" id="cashdepositdate"  class="form-control cashdepositdate datepicker" type="text" placeholder="تاريخ الحركة (يوم/شهر/سنة)" />
                                    <br />
												<select name="CustomerID"
                                                 style="width:100%"
                                                 data-placeholder="اسم العميل"
                                                 id="cboCustomerID" >
                                                  </select>

                                    <br> <br>

                                    <input type="text" name="Mount" class="form-control only_float" placeholder="المبلغ">
                                    <br />
                                    <select name="CashierID"
                                             style="width:100%"
                                             onchange="cashiervalidation()"
                                            data-placeholder="اسم الخزنة"

                                            id="cboCashierID" >

                                    </select>
                                    <br><br>

                                <div id="validation"  class="col-md-12 btn btn-info"></div>
                                      <br /><br />

                                    <input type="text" name="Notes" class="form-control" placeholder="البيان">

                                    <br /><br />
                                    <button id="add-CashDeposit" class="btn btn-success btn-flat btn-block" type="button"><b>اضـــــــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='CashDepositerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كل المقبوضات النقدية </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-CashDeposit" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>تاريخ الحركة (يوم/شهر/سنة)</th>
                                    <th>اسم العميل (التاجر)</th>
                                    <th>المبلغ</th>
                                    <th>اسم الخزنة</th>

                                    <th>البيان</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cashdeposit as $cashdeposit)
                                <tr>

                                     <td></td>
                                    <td>{{date("Y/m/d",strtotime($cashdeposit->TransDate))}}</td>
                                    <td data-val='{{$cashdeposit->Customers()->get()[0]->CustomerID}}'>{{$cashdeposit->Customers()->get()[0]->CustomerName}}</td>
                                    <td>{{$cashdeposit->Mount}}</td>
                                    <td data-val='{{$cashdeposit->Cashiers()->get()[0]->CashierID}}'>{{$cashdeposit->Cashiers()->get()[0]->CashierName}}</td>

                                    <td>{{$cashdeposit->Notes}}</td>
                                    <td>
                                        <button name="EditCashDeposit_{{$cashdeposit->TransID}}" class="btn btn-flat btn-info btn-sm EditCashDeposit">تعديل</button>
                                        <button name="DelCashDeposit_{{$cashdeposit->TransID}}" class="btn btn-flat btn-danger btn-sm RmvCashDeposit">حذف</button>
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
