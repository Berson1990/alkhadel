@extends('adminnoheader.noheader')


    @section('content')

        <style type="text/css">
            body
            {
                counter-reset: Serial;           /* Set the Serial counter to 0 */
            }

            #tbl-BankCashDeposit tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }
            EditbankCashDeposit{
                border-radius: 0;
    border-width: 1px;
    box-shadow: none;
    moz-box-shadow: none;
    webkit-box-shadow: none;
    height: 30px;
    width: 30px;
    font-size: 18px;
    font-weight: bold;
            
            
            }
        </style>
        
        <script src={{asset("/dist/js/admin/bankcashdeposit.js")}} type="text/javascript"></script>

<!--         <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
                <script src={{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}></script>
 <link   href={{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}} rel="stylesheet" type="text/css" />

        <script type="text/javascript">
            config6 = <?php echo json_encode($js_config) ?>;
        </script>        
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">اضافة مقبوض نقدى (بنك) </h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="bankcashdeposit-form" style="width: 60%" class="container col-xs-5">
                                      <input name="TransDate" id=""  class="form-control datepicker" type="text" placeholder="تاريخ الحركة (يوم/شهر/سنة)" />
                                    <br />
												<select name="CustomerID"
                                                 style="width:100%"
                                                 data-placeholder="اسم العميل"
                                                 id="cboCustomerID4" >
                                                  </select>

                                    <br> <br>

                                    <input type="text" name="Mount" class="form-control only_float" placeholder="المبلغ">
                                    <br />

                                    <select name="BankID" 
                                             style="width:100%"
                                            
                                            data-placeholder="اسم البنك" 
                                           
                                            id="cboBankID4">
                                    
                                    </select>
                                    <br><br>
                                    <input type="text" name="Notes" class="form-control" placeholder="البيان">

                                    <br /><br />
                                    <button id="add-BankCashDeposit" class="btn btn-success btn-flat btn-block" type="button">اضـــافة</button>
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
                            <table id="tbl-BankCashDeposit" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>تاريخ الحركة (يوم/شهر/سنة)</th>
                                    <th>اسم العميل (التاجر)</th>
                                    <th>المبلغ</th>
                                    <th>اسم البنك</th>
                                    <th>البيان</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bankcashdeposit as $bankcashdeposit)
                                <tr>
                           
                                     <td></td>
                                    <td>{{date("Y/m/d",strtotime($bankcashdeposit->TransDate))}}</td>
                                    <td data-val='{{$bankcashdeposit->Customers()->get()[0]->CustomerID}}'>{{$bankcashdeposit->Customers()->get()[0]->CustomerName}}</td>
                                    <td>{{$bankcashdeposit->Mount}}</td>
                    
                                    <td data-val='{{$bankcashdeposit->Banks()->get()[0]->BankID}}'>{{$bankcashdeposit->Banks()->get()[0]->BankName}}</td>
                                    <td>{{$bankcashdeposit->Notes}}</td>
                                    <td>
                                        <button name="EditbankCashDeposit_{{$bankcashdeposit->TransID}}" class="btn btn-flat btn-info btn-sm EditbankCashDeposit">تعديل</button>
                                        <button name="DelbCashDeposit_{{$bankcashdeposit->TransID}}" class="btn btn-flat btn-danger btn-sm RmvbCashDeposit">حذف</button>
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
