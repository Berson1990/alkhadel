    @extends('adminheader.header')

    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-5"></div> 
                            <div  class="col-lg-2  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >أضــافة  بنـــك  جديـد</h3>
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

            tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }
        </style>
        
        <script src={{asset("/dist/js/admin/banks.js")}} type="text/javascript"></script>
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
<!--                            <h3 class="box-title fontDesign">اضافة بنك جديد</h3>-->
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="bank-form" style="width: 60%" class="container col-xs-5">
                                    <input type="text" name="BankName" class="form-control" placeholder="اســم الينــك">
                                    <br />
                                    <input type="text" name="AccountNumber" class="form-control" placeholder="رقــم الحساب">
                                    <br />
                                    <select name="CurrencyID" 
                                            mh_width="width:100%" 
                                            mh_onkeyup="" tabindex="1" 
                                            data-placeholder="العملة" 
                                            class="chosen-select-deselect chosen-rtl fontDesign" 
                                            id="cboCurrencyID" >
                                        <option data-comm="0" value="0" selected ></option>
                                        @foreach($currencies as $currency)

        <option value="{{$currency->CurrencyID}}">{{$currency->CurrencyName}}</option>

                                        @endforeach
                                    </select>


                                    <br /><br />
                                    <button id="add-Bank" class="btn btn-success btn-flat btn-block" type="button"><b>اضـــــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='Bankerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كل البنــوك </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-Banks" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>اســم البنك</th>
                                    <th>رقم الحســاب</th>
                                    <th>العمـــلة</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banks as $bank)
                                <tr>
                                    <td></td>
                                    <td>{{$bank->BankName}}</td>
                                    <td>{{$bank->AccountNumber}}</td>
                                    <td data-val='{{$bank->Currencies()->get()[0]->CurrencyID}}'>{{$bank->Currencies()->get()[0]->CurrencyName}}</td>
                                    <td>
                                        <button name="EditBank_{{$bank->BankID}}" class="btn btn-flat btn-info btn-sm EditBank">تعديل</button>
                                        <button name="DelBank_{{$bank->BankID}}" class="btn btn-flat btn-danger btn-sm RmvBank">حذف</button>
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
$("#link06").addClass("hoverlink");
});
</script>
    @endsection
