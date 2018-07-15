    @extends('adminnoheader.noheader')
    @section('content')

        <style type="text/css">
            body
            {
                counter-reset: Serial;           /* Set the Serial counter to 0 */
            }

            #tbl-CustomOpeningBalance tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }
			
				.fontDesign{
							font-size: 16px;
							font-wight:bold;
							}
           .dataTables_filter{
font-size: 18px;
font-weight: bold; 
}
        </style>
        

        <script src={{asset("/dist/js/admin/customeopeningbalance.js")}} type="text/javascript"></script>
<!--<script src={{asset("/plugins/datatables/jquery.dataTables.js")}} type="text/javascript"></script>-->
<!-- <script src={{asset("/plugins/select2-4.0.0/dist/js/select2.full.min.js")}}></script>-->
<!-- <script src={{asset ("/plugins/jQueryUI/jquery-ui-1.11.4.min.js")}}></script>-->
<!-- <script src={{asset("/plugins/datatables/dataTables.tableTools.js")}} type="text/javascript"></script>-->
 <link href={{asset("/plugins/select2-4.0.0/dist/css/select2.min.css")}} rel="stylesheet" type="text/css" /> 
         <script type="text/javascript">
            config2 = <?php echo json_encode($js_config2) ?>;
        </script>     
	
<script>
	
	//show date of day in input when reloaded the page
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
                            <h3 class="box-title">اضافة رصيد  لمستخلص </h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="customopeningbalance-form" style="width: 60%" class="container col-xs-5">
                                      <input name="TransDate" id=""  class="form-control datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <br />
                                    <input type="text" name="Mount" class="form-control only_float" placeholder="المبلغ">
                                    <br />
                                    <select name="CustomID"
                                        style="width:100%"
                                      
                                         data-placeholder="اسم المستخلص "
                                        
                                          id="cboCustomID" >
                                     
                                            </select>
                                                                       <br /><br />

          

                                      <input class="radio-inline dept" id="Debit"  type="radio" name="Debt" data-title="مدين" value="1"   />

                                    <label class="radio-inline fontDesign" id="Debit_btn" >مدين</label> 

                                    <input class="radio-inline" id="Creditor"  type="radio" name="Debt" data-title="دائن " value="0"   />
                          <label class="radio-inline fontDesign" id="Creditor_btn" >دائن</label>
                                    <br />
<br />
          
                                    <input type="text" name="Notes" class="form-control" placeholder="البيان">

                                   <br />
                                    <button id="add-CustomOpeningBalance" class="btn btn-success btn-flat btn-block" type="button"><b>اضـــــــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='CustomOpeningBalanceerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">كل الارصدة الافتتاحية للمستخلصين  </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-CustomOpeningBalance" dir="rtl" class="table table-bordered table-striped fontDesign" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>تاريخ الحركة</th>
                                    <th>المبلغ</th>
                                    <th>اسم المستخلص</th>
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
                                    <td data-val='{{$opening->Customs()->get()[0]->CustomID}}'>{{$opening->Customs()->get()[0]->CustomName}}</td>
                                    <td>{{$opening->Notes}}</td>
                                       @if ($opening->Debt ==1)
                                    <td>مدين</td>
                                        @elseif ($opening->Debt ==0)
                                    <td>دائن</td>
                                        @endif
                                    <td>
                                        <button name="EditCustomerOpeningBalance_{{$opening->TransID}}" class="btn btn-flat btn-info btn-sm EditCustomerOpeningBalance">تعديل</button>
                                        <button name="DelCustomerOpeningBalance_{{$opening->TransID}}" class="btn btn-flat btn-danger btn-sm RmvCustomerOpeningBalance">حذف</button>
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
