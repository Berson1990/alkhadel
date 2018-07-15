    @extends('adminheader.header')

    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-4"></div> 
                            <div  class="col-lg-4  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >  أضـــافه رصيد افتــتاحى لبنــك </h3>
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

            #tbl-BankOpeningBalance tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }
        </style>
        
        <script src={{asset("/dist/js/admin/bankopeningbalance.js")}} type="text/javascript"></script>
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
                            <h3 class="box-title">اضافة رصيد افتتاحى لبنك جديد</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="bankopeningbalance-form" style="width: 60%" class="container col-xs-5">
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
                                    <input type="text" name="AccountNumber" class="form-control" placeholder="رقم الحساب">
                                    <br />
                                    <input type="text" name="Mount" class="form-control only_float" placeholder="المبلغ">
                                    <br />
                                    <select name="CurrencyID" 
                                            mh_width="width:100%" 
                                            mh_onkeyup="" tabindex="1" 
                                            data-placeholder="اسم العملة" 
                                            class="chosen-select-deselect chosen-rtl" 
                                            id="cboCurrenyID" >
                                        <option data-comm="0" value="0" selected ></option>
                                        @foreach($currencies as $currency)

                                            <option value="{{$currency->CurrencyID}}">{{$currency->CurrencyName}}</option>

                                        @endforeach
                                    </select>
                                    <br><br>
                                    <input type="text" name="Notes" class="form-control" placeholder="البيان">

                                    <br /><br />
                                    <button id="add-BankOpeningBalance" class="btn btn-success btn-flat btn-block" type="button"><b>اضـــــــــــــــــــــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='BankOpeningBalanceerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كل المصروفات </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-BankOpeningBalance" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>تاريخ الحركة (يوم/شهر/سنة)</th>
                                    <th>اسم البنك</th>
                                    <th>رقم الحساب</th>
                                    <th>المبلغ</th>
                                    <th>العملة</th>
                                    <th>البيان</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bankopeningbalance as $bankopeningbalance)
                                <tr>
                                    <td></td>
                                    <td>{{date("Y/m/d",strtotime($bankopeningbalance->TransDate))}}</td>
                                    <td data-val='{{$bankopeningbalance->Banks()->get()[0]->BankID}}'>{{$bankopeningbalance->Banks()->get()[0]->BankName}}</td>
                                    <td>{{$bankopeningbalance->AccountNumber}}</td>
                                    <td>{{$bankopeningbalance->Mount}}</td>
                                    <td data-val='{{$bankopeningbalance->Currencies()->get()[0]->CurrencyID}}'>{{$bankopeningbalance->Currencies()->get()[0]->CurrencyName}}</td>
                                    <td>{{$bankopeningbalance->Notes}}</td>
                                    <td>
                                        <button name="EditBankOpeningBalance_{{$bankopeningbalance->TransID}}" class="btn btn-flat btn-info btn-sm EditBankOpeningBalance">تعديل</button>
                                        <button name="DelBankOpeningBalance_{{$bankopeningbalance->TransID}}" class="btn btn-flat btn-danger btn-sm RmvBankOpeningBalance">حذف</button>
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
$("#link17").addClass("hoverlink");
});
</script>
    @endsection
