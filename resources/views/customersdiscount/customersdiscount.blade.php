    @extends('adminnoheader.noheader')

    @section('content')


        <style type="text/css">
            body
            {
                counter-reset: Serial;           /* Set the Serial counter to 0 */
            }

            #tbl-CustomersDiscount tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }
        </style>
        
        <script src={{asset("/dist/js/admin/customersdiscount.js")}} type="text/javascript"></script>

<!-- <script src={{asset("/plugins/jQueryUI/jquery-ui-1.11.4.min.js")}}></script>-->
      <script src={{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}></script>

 <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" /> 

<script>

 $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())

        });
	</script>



<!--seelct css-->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">اضافة خصم مسموح به</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="customerdiscount-form" style="width: 60%" class="container col-xs-5">
                                      <input name="TransDate" id=""  class="form-control datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <br />
                                    <input type="text" name="Mount" class="form-control only_float" placeholder="المبلغ">
                                    <br />
                                         <select name="CustomerID"
                                                 style="width:100%"
                                                 data-placeholder="اسم العميل"
                                                 id="cboCustomerID" >
                                                  </select>
                                    <br><br>
                                    <input type="text" name="Notes" class="form-control" placeholder="البيان">

                                    <br /><br />
                                    <button id="add-CustomerDiscount" class="btn btn-success btn-flat btn-block" type="button"><b>اضـــــــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='CustomerDiscounterror' class="container col-xs-3"></div>
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
                            <table id="tbl-CustomersDiscount" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>تاريخ الحركة</th>
                                    <th>المبلغ</th>
                                    <th>اسم العميل (التاجر)</th>
                                    <th>البيان</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customersdiscount as $customerdiscount)
                                <tr>
                                    <td></td>
                                    <td>{{date("Y/m/d",strtotime($customerdiscount->TransDate))}}</td>
                                    <td>{{$customerdiscount->Mount}}</td>
                                    <td data-val='{{$customerdiscount->Customers()->get()[0]->CustomerID}}'>{{$customerdiscount->Customers()->get()[0]->CustomerName}}</td>
                                    <td>{{$customerdiscount->Notes}}</td>
                                    <td>
                                        <button name="EditCustomerDiscount_{{$customerdiscount->TransID}}" class="btn btn-flat btn-info btn-sm EditCustomerDiscount">تعديل</button>
                                        <button name="DelCustomerDiscount_{{$customerdiscount->TransID}}" class="btn btn-flat btn-danger btn-sm RmvCustomerDiscount">حذف</button>
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
