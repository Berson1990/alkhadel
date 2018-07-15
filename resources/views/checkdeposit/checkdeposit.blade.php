@extends('adminnoheader.noheader')

  

    @section('content')

        <style type="text/css">
            body
            {
                counter-reset: Serial;           /* Set the Serial counter to 0 */
            }

            #tbl-CheckDeposit tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }
        </style>
        
        <script src={{asset("/dist/js/admin/checkdeposit.js")}} type="text/javascript"></script>
<!--        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->

    <script src={{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}></script>
<!--        <script src="/plugins/jQueryUI/jquery-ui-1.11.4.min.js"></script>-->


<!--select css-->
 <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<!--seelct css-->

        <script type="text/javascript">
            config4 = <?php echo json_encode($js_config) ?>;
        </script>        
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">اضافة مقبوض شيك</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="checkdeposit-form" style="width: 60%" class="container col-xs-5">
                                      <input name="TransDate" id=""  class="form-control datepicker" type="text" placeholder="تاريخ الحركة (يوم/شهر/سنة)" />
                                    <br />

                                   	<select name="CustomerID"
                                                 style="width:100%"
                                                 data-placeholder="اسم العميل"
                                                 id="cboCustomerID" >
                                                  </select>

                                    <br> <br>
                                    <select name="BankID" 
                                           style="width:100%" 
                                           
                                            data-placeholder="اسم البنك" 
                                         
                                            id="cboBankID" >
                                    
                                    </select>
                                    <br><br>

                                    <input type="text" name="CheckNo" class="form-control" placeholder="رقم الشيك">
                                    <br />
                                    <input type="text" name="Mount" class="form-control only_float" placeholder="القيمة">
                                    <br />
                                    <input name="CheckDate" id=""  class="form-control datepicker" type="text" placeholder="تاريخ استحقاق الشيك (يوم/شهر/سنة)" />
                                    <br>
                                    <input type="text" name="Notes" class="form-control" placeholder="البيان">

                                    <br /><br />
                                    <button id="add-CheckDeposit" class="btn btn-success btn-flat btn-block" type="button"><b>اضــــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='CheckDepositerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كل المقبوضات الشيكات </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-CheckDeposit" dir="rtl" class="table table-bordered table-striped col-md-12" style="text-align:center">
                                <thead>
                                <tr>
                                    <th class="">م</th>
                                    <th>تاريخ الحركة</th>
                                    <th> التاجر </th>
                                    <th>المبلغ</th>
                                    <th>اسم البنك</th>
                                    <th>رقم الشيك</th>
                                    <th>تاريخ استحقاق الشيك</th>
                                    <th>البيان</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($checkdeposit as $checkdeposit)
                                <tr>
                                    <td></td>
                                    <td>{{date("Y/m/d",strtotime($checkdeposit->TransDate))}}</td>
                                    <td data-val='{{$checkdeposit->Customers()->get()[0]->CustomerID}}'>{{$checkdeposit->Customers()->get()[0]->CustomerName}}</td>
                                    <td>{{$checkdeposit->Mount}}</td>
                                    <td data-val='{{$checkdeposit->Banks()->get()[0]->BankID}}'>{{$checkdeposit->Banks()->get()[0]->BankName}}</td>
                                    <td>{{$checkdeposit->CheckNo}}</td>
                                    <td>{{date("Y/m/d",strtotime($checkdeposit->CheckDate))}}</td>
                                    <td >{{$checkdeposit->Notes}}</td>
                                    <td>
                                        <button  name="EditCheckDeposit_{{$checkdeposit->TransID}}" class="btn btn-flat btn-info btn-sm EditCheckDeposit">تعديل</button>
                                        <button name="DelCheckDeposit_{{$checkdeposit->TransID}}" class="btn btn-flat btn-danger btn-sm RmvCheckDeposit">حذف</button>
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
