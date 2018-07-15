  @extends('adminnoheader.noheader')

    @section('content')

        <style type="text/css">
            body
            {
                counter-reset: Serial;           /* Set the Serial counter to 0 */
            }

            #tbl-CheckPayments tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }
        </style>
        
        <script src={{asset("/dist/js/admin/checkpayments.js")}} type="text/javascript"></script>
<!--        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
        <script type="text/javascript">
            config4 = <?php echo json_encode($js_config) ?>;
        </script>    
		<script src="{{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}"></script>
<!--        <script src="/plugins/jQueryUI/jquery-ui-1.11.4.min.js"></script>-->


<!--select css-->
 <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<!--seelct css-->
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">اضافة مدفوع شيك</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="checkpayment-form" style="width: 60%" class="container col-xs-5">
                                      <input name="TransDate" id=""  class="form-control datepicker" type="text" placeholder="تاريخ الحركة (يوم/شهر/سنة)" />
                                    <br />

                                    <select name="SupplierID" 
                                           style="width:100%" 
                                            
                                            data-placeholder="اسم المورد" 
                                          
                                            id="cboSupplierID" >
                       
                                    </select>

                                    <br> <br>
                                    <select name="BankID" 
                                            style="width:100%" 
                                           
                                            data-placeholder="اسم البنك" 
                                          
                                            id="cboBankID" >
										
                                  
                                    </select>
                                    <br><br>
                                    <input type="text" name="Mount" class="form-control only_float" placeholder="القيمة">
                                    <br />
                                    <input type="text" name="CheckNo" class="form-control" placeholder="رقم الشيك">
                                    <br />
                                    <input name="CheckDate" id=""  class="form-control datepicker" type="text" placeholder="تاريخ الاستحقاق (يوم/شهر/سنة)" />
                                    <br>
                                    <input type="text" name="Notes" class="form-control" placeholder="البيان">

                                    <br /><br />
                                    <button id="add-CheckPayment" class="btn btn-success btn-flat btn-block" type="button"><b>اضــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='CheckPaymenterror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كل المدفوعات بالشيكات </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table  id="tbl-CheckPayments" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>تاريخ الحركة (يوم/شهر/سنة)</th>
                                    <th>اسم المورد (الفلاح)</th>
                                    <th>المبلغ</th>
                                    <th>اسم البنك</th>
                                    <th>رقم الشيك</th>
                                    <th>تاريخ الاستحقاق (يوم/شهر/سنة)</th>
                                    <th>البيان</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($checkpayments as $checkpayment)
                                <tr>
                                    <td></td>
                                    <td>{{date("Y/m/d",strtotime($checkpayment->TransDate))}}</td>
                                    <td data-val='{{$checkpayment->Suppliers()->get()[0]->SupplierID}}'>{{$checkpayment->Suppliers()->get()[0]->SupplierName}}</td>
                                     <td>{{$checkpayment->Mount}}</td>
                                  
                                    <td data-val='{{$checkpayment->Banks()->get()[0]->BankID}}'>{{$checkpayment->Banks()->get()[0]->BankName}}</td>
                                    <td>{{$checkpayment->CheckNo}}</td>
                                    <td>{{date("Y/m/d",strtotime($checkpayment->CheckDate))}}</td>
                                    <td>{{$checkpayment->Notes}}</td>
                                    <td>
                                        <button name="EditCheckPayment_{{$checkpayment->TransID}}" class="btn btn-flat btn-info btn-sm EditCheckPayment">تعديل</button>
                                        <button name="DelCheckPayment_{{$checkpayment->TransID}}" class="btn btn-flat btn-danger btn-sm RmvCheckPayment">حذف</button>
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
