    @extends('adminnoheader.noheader')


    @section('content')

        <style type="text/css">
            body
            {
                counter-reset: Serial;           /* Set the Serial counter to 0 */
            }

            #tbl-SuppliersDiscount tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }
        </style>
        
        <script src={{asset("/dist/js/admin/suppliersdiscount.js")}} type="text/javascript"></script>
<!--        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
        <script type="text/javascript">
            config2 = <?php echo json_encode($js_config) ?>;
        </script>    
<!--	<script src="{{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}"></script>-->
<!--        <script src="/plugins/jQueryUI/jquery-ui-1.11.4.min.js"></script>-->


<!--select css-->
<!-- <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />-->
<!--seelct css-->
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">اضافة خصم مكتسب</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="supplierdiscount-form" style="width: 60%" class="container col-xs-5">
                                      <input name="TransDate" id=""  class="form-control datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <br />
                                    <input type="text" name="Mount" class="form-control only_float" placeholder="المبلغ">
                                    <br />
                                    <select name="SupplierID" 
                                            style="width:100%" 
                                        
                                            data-placeholder="اسم المورد" 
                                           
                                            id="cboSupplierID" >
                                    </select>
                                    <br><br>
                                    <input type="text" name="Notes" class="form-control" placeholder="البيان">

                                    <br /><br />
                                    <button id="add-SupplierDiscount" class="btn btn-success btn-flat btn-block" type="button"><b>اضــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='SupplierDiscounterror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كل الخصم المكتسب </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-SuppliersDiscount" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>تاريخ الحركة</th>
                                    <th>المبلغ</th>
                                    <th>اسم المورد (الفلاح)</th>
                                    <th>البيان</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($suppliersdiscount as $supplierdiscount)
                                <tr>
                                    <td></td>
                                    <td>{{date("Y/m/d",strtotime($supplierdiscount->TransDate))}}</td>
                                    <td>{{$supplierdiscount->Mount}}</td>
                                    <td data-val='{{$supplierdiscount->Suppliers()->get()[0]->SupplierID}}'>{{$supplierdiscount->Suppliers()->get()[0]->SupplierName}}</td>
                                    <td>{{$supplierdiscount->Notes}}</td>
                                    <td>
                                        <button name="EditSupplierDiscount_{{$supplierdiscount->TransID}}" class="btn btn-flat btn-info btn-sm EditSupplierDiscount">تعديل</button>
                                        <button name="DelSupplierDiscount_{{$supplierdiscount->TransID}}" class="btn btn-flat btn-danger btn-sm RmvSupplierDiscount">حذف</button>
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
