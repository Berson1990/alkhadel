    @extends('adminnoheader.noheader')
    @section('content')

        <style type="text/css">
            body
            {
                counter-reset: Serial;           /* Set the Serial counter to 0 */
            }

            #tbl-SupplierOpeningBalance tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }
        </style>
        


        <script src={{asset("/dist/js/admin/supplieropeningbalance.js")}} type="text/javascript"></script>
        <!--<script src={{asset("/plugins/datatables/jquery.dataTables.js")}} type="text/javascript"></script>-->
        <!-- <script src={{asset("/plugins/select2-4.0.0/dist/js/select2.full.min.js")}}></script>-->
        <!-- <script src={{asset ("/plugins/jQueryUI/jquery-ui-1.11.4.min.js")}}></script>-->
        <!-- <script src={{asset("/plugins/datatables/dataTables.tableTools.js")}} type="text/javascript"></script>-->
            <script src="{{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}"></script>
        <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
  <script type="text/javascript">
            config1 = <?php echo json_encode($js_config) ?>;
        </script>
<script>
	$(document).ready(function(){
		$(".datepicker").datepicker('setDate', new Date());
});


</script>

<!--select css-->

<!--seelct css-->
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">اضافة رصيد افتتاحى لمورد</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="supplieropeningbalance-form" style="width: 60%" class="container col-xs-5">
                                      <input name="TransDate" id=""  class="form-control datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <br />
                                    <input type="text" name="Mount" class="form-control only_float" placeholder="المبلغ">
                                    <br />
                                    <select name="SupplierID"
                                        style="width:100%"
                                       
                                         data-placeholder="اسم المورد"
                                        
                                          id="cboSupplierID" >
                                        
                                            </select>
                                    <br/>


                                      <input class="radio-inline dept fontDesign" id="Debit"  type="radio" name="Debt" data-title="مدين" value="1"  />

                                    <label class="radio-inline fontDesign" id="Debit_btn" >مدين</label> 

                                    <input class="radio-inline fontDesign" id="Creditor"  type="radio" name="Debt" data-title="مدين" value="0"  />

                                    <label class="radio-inline fontDesign" id="Creditor_btn" >دائن</label>

                                     <Br>  
                                    <input type="text" name="Notes" class="form-control" placeholder="البيان">

                                  <br />
                                    <button id="add-SupplierOpeningBalance" class="btn btn-success btn-flat btn-block" type="button"><b>اضــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='SupplierOpeningBalanceerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كل الارصدة الافتتاحية للموردين </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-SupplierOpeningBalance" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>تاريخ الحركة</th>
                                    <th>المبلغ</th>
                                    <th>اسم المورد</th>
                                    <th>البيان</th>
                                    <th>المديونية</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($opening as $opening)
                                <tr>
                                    <td></td>
                                    <td>{{date("Y/m/d",strtotime($opening->TransDate))}}</td>
                                    <td>{{$opening->Mount}}</td>
                                    <td data-val='{{$opening->Suppliers()->get()[0]->SupplierID}}'>{{$opening->Suppliers()->get()[0]->SupplierName}}</td>
                                    <td>{{$opening->Notes}}</td>
                                        @if ($opening->Debt ==1)
                                    <td>مدين</td>
                                        @elseif ($opening->Debt ==0)
                                    <td>دائن</td>
                                        @endif
                                    <td>
                                        <button name="EditSupplierOpeningBalance_{{$opening->TransID}}" class="btn btn-flat btn-info btn-sm EditSupplierOpeningBalance">تعديل</button>
                                        <button name="DelSupplierOpeningBalance_{{$opening->TransID}}" class="btn btn-flat btn-danger btn-sm RmvSupplierOpeningBalance">حذف</button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
             <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">مجموع الأرصدة الافتتاحية</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-totalval" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>الرصيد المدين</th>
                                    <th> الرصيد الدائن </th>
                                   
                                </tr>
                                </thead>
                                <tbody>
                           
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div>
        </section><!-- /.content -->
    @endsection
