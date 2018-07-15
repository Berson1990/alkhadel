 @extends('adminnoheader.noheader')

    @section('content')

        <style type="text/css">
            body
            {
                counter-reset: Serial;           /* Set the Serial counter to 0 */
            }

            #tbl-CustomerRefund tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }
        </style>

        <script src={{asset("/dist/js/admin/customerrefund.js")}} type="text/javascript"></script>

<!--        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script> -->

         <link href={{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}} rel="stylesheet" type="text/css" />
    <script src={{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}></script>

        <script type="text/javascript">

    	    config5 = <?php echo json_encode($js_config) ?>;
	    </script>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title"> مرتجع نقدى </h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="customerrefund-form" style="width: 60%" class="container col-xs-5">
                                      <input name="RefundDate" id=""  class="form-control datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <br />
                                    <input type="text" name="Refund" class="form-control only_float" placeholder="المبلغ">
                                    <br />
                              			<select name="CustomerID"
                                                 style="width:100%"
                                                 data-placeholder="اسم العميل"
                                                 id="cboCustomerID" >
                                                  </select>
                                    <br><br>

                                    <select name="CashierID"
                                             style="width:100%"
                                           onchange="cashiervalidation2()"
                                            data-placeholder="اسم الخزنة"

                                            id="cboCashierID" >

                                    </select>
                                        <br /><br />

                                <div id="validation2"  class="col-md-12 btn btn-info"></div>
                                      <br /><br />

                                    <input type="text" name="Notes" class="form-control" placeholder="البيان">

                                    <br /><br />
                                    <button id="add-CustomerRefund" class="btn btn-success btn-flat btn-block" type="button"><b>اضــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='CustomerRefunderror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> المرتجعات النقدية للعملاء</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-CustomerRefund" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>تاريخ الحركة</th>
                                    <th>المبلغ</th>
                                    <th>اسم العميل</th>
                                    <th>الخزنة</th>
                                    <th>البيان</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($opening as $opening)
                                <tr>
                                    <td></td>
                                    <td>{{date("Y/m/d",strtotime($opening->RefundDate))}}</td>
                                    <td>{{$opening->Refund}}</td>
                                    <td data-val='{{$opening->Customers()->get()[0]->CustomerID}}'>{{$opening->Customers()->get()[0]->CustomerName}}</td>
                                    <td data-val='{{$opening->Cashiers()->get()[0]->CashierID}}'>{{$opening->Cashiers()->get()[0]->CashierName}}</td>
                                    <td>{{$opening->Notes}}</td>
                                    <td>
                                  <button name="EditCustomerRefund_{{$opening->RefundID}}" class="btn btn-flat btn-info btn-sm EditCustomerRefund">تعديل</button>
                                  <button name="DelCustomerRefund_{{$opening->RefundID}}" class="btn btn-flat btn-danger btn-sm RmvCustomerRefund">حذف</button>
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
