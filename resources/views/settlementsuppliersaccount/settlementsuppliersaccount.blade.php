    @extends('adminnoheader.noheader')
    @section('content')

        <style type="text/css">
            body
            {
                counter-reset: Serial;           /* Set the Serial counter to 0 */
            }

            #tbl-SettlementSuppliersAccount tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }

			  }

							.fontDesign{
							font-size: 16px;
							font-wight:bold;
							}
        </style>

        <script src={{asset("/dist/js/admin/settlementsuppliersaccount.js")}} type="text/javascript"></script>

<!--          <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->

            <script src="{{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}"></script>

  <script type="text/javascript">
            config7 = <?php echo json_encode($js_config) ?>;
        </script>
<!--select css-->
 <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<!--seelct css-->
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title"> تصفيه حساب الموردين   </h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="settlementsuppliersaccount-form" style="width: 60%" class="container col-xs-5">
                                      <input name="TransDate" id=""  class="form-control datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <br />
                                    <input type="text" name="Mount" class="form-control only_float" placeholder="المبلغ">
                                    <br />
                                    <select name="SupplierID"
                                        style="width:100%"

                                         data-placeholder="اسم المورد"

                                          id="cboSupplierID" >

                                            </select>
                                    <br />   <br />
											<select name="CashierID"
                                             style="width:100%"
                                             onchange="cashiervalidation4()"
                                            data-placeholder="اسم الخزنة"

                                            id="cboCashierID" >

                                    </select>
                                    <br><br>
                                    <div id="validation4"  class="col-md-12 btn btn-info"></div>
                                    <br><br>

                                      <input class="radio-inline dept" id="Debit"  type="radio" name="Dept" data-title="له" value="1"  />

                                    <label class="radio-inline fontDesign" id="Debit_btn" >له</label>

                                    <input class="radio-inline" id="Creditor"  type="radio" name="Dept" data-title="دائن" value="0"  />

                                    <label class="radio-inline fontDesign" id="Creditor_btn" >عليه </label>


                                    <br/>
                                    <br/>
                                    <input type="text" name="Notes" class="form-control" placeholder="البيان">

                                    <br />
                                    <button id="add-settlementsuppliersaccount" class="btn btn-success btn-flat btn-block" type="button"><b>اضــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='SupplierOpeningBalanceerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">تصفيه حساب موردين </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-SettlementSuppliersAccount" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>تاريخ الحركة</th>
                                    <th>المبلغ</th>
                                    <th>اسم المورد</th>
                                    <th>اسم الخزنه </th>
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
									<td data-val='{{$opening->Cashiers()->get()[0]->CashierID}}'>{{$opening->Cashiers()->get()[0]->CashierName}}</td>
                                    <td>{{$opening->Notes}}</td>
                                        @if ($opening->Dept == 1)
                                    <td>له</td>
                                        @elseif ($opening->Dept == 0)
                                    <td>عليه</td>
                                        @endif
                                    <td>
                                        <button name="EditSupplierِAccount_{{$opening->TransID}}" class="btn btn-flat btn-info btn-sm EditSupplierِAccount">تعديل</button>
                                        <button name="DelSupplierِAccount_{{$opening->TransID}}" class="btn btn-flat btn-danger btn-sm RmvSupplierِAccount">حذف</button>
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
