@extends('adminheader.header')


    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-5"></div>
                            <div  class="col-lg-2  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >   تــقرير  تصفيه البنوك </h3>
                            </div>
                             <div class="col-lg-5"></div>
                    </div>
        </section>
    @endsection


    @section('content')
        <style type="text/css">

                        @media print{
                          #tohide2{
                            display:none;
                          }
							#hideinprint{
                            display:none;
                          }
                        }
			.fontDesign{
    font-size: 18px;
font-wight:bold;
}
#CashieropeningBalance{
font-weight: bold;;
font-size: 15px;

}

/*            .treeview .treeview-menu .hoverlink{color:#f90;}*/

                        </style>


<!-- products Card-->
        <script src={{asset("/dist/js/admin/settlementbank.js")}} type="text/javascript"></script>

        <script src={{asset("/plugins/datatables/jquery.dataTables.js")}} type="text/javascript"></script>
		<script src={{asset("/plugins/datatables/dataTables.tableTools.js")}} type="text/javascript"></script>
		<script src="{{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}"></script>
        <script src={{asset("/plugins/jQueryUI/jquery-ui-1.11.4.min.js")}}></script>


<!--select css-->
 <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<!--seelct css-->

		<!--Filter -->

     <!-- Main content -->
        <section class="content">
            <div class="row">
				       <div class="col-md-12 show" >
                    <div class="box box-success">

                        <div class="box-header">
<!--                            <h3 class="box-title">تقرير  تصفيه الخزن    </h3>-->
                        </div>
                        <div class="box-body">
                            <div class="row">



                                <div id="settlementbank-repo-form"  style="width: 60%" class="container col-xs-5">

                                    <div id="CashieropeningBalance"></div>
                                    <span class="fontDesign">من: </span>
                                    <input name="FromTransDate" id="fromdate1"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <span class="fontDesign">الى: </span>
                                    <input name="ToTransDate" id="todate1"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />

										<div style="display:none ; margin:10px 0 0 0 ;" id="showCshierName"></div>
		                            <br />
									<br />
									<div id="hideinprint">
                                    <select name="BankID"
                                            style="width:100%"
                                            dir = "rtl"
                                            data-placeholder="اسم البنك"
                                            id="cboBankID">
										</select>
                                        </div>
										<br />

                                                   <div id="hideinotherprinttable">
                                    <input class="radio-inline " id="rbtnIsndividuale" onclick="individuale()" type="radio" name="rbtn" data-title="تفصيل" value="1" checked  />

                                    <label class="radio-inline fontDesign" id="inname"for="rbtnIndividuale">تفصيل</label>
<!--                                    <label class="radio-inline" for="rbtnCustomerType">تفصيل</label>-->

                                    <input class="radio-inline " id="rbtnComb" onclick="combine()"type="radio" name="rbtn" data-title="تجميع" value="2" />


                                    <label class="radio-inline fontDesign" id="comname"for="rbtnCombine">تجميع</label>
                                        </div>
                                        <br> <br>
                                    <button id="search-settlementbank" class="show btn btn-success btn-flat btn-block" type="button"><b>بـــــحــــث</b></button>
                                </div>



                                <div style="width: 35%; height: inherit"  id='SuTypeerror' class="container col-xs-3"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
				<!--Filter -->
				<!-- Report-->
				    <div  class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> البنوك - عملاء - مقبوضات شيكات   </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
							 <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-settlementcheckDeposit" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>

                                    <th> التاريخ </th>
                                    <th  class="noraml"> أسم العميل</th>
                                    <th  class="noraml"> أسم البنك</th>
                                    <th  class="noraml"> رقم الشيك </th>
                                    <th  class="noraml">  البيان </th>
                                    <th>  القيمة </th>


                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
								<tfoot>

                                    <th > التاريخ </th>
                                    <th  class="noraml"> أسم العميل</th>
                                    <th class="noraml"> أسم البنك</th>
                                    <th class="noraml"> رقم الشيك </th>
                                    <th class="noraml">  البيان </th>
                                    <th class="total">  القيمة </th>

								</tfoot>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->

				<!--Report1 -->

    <div  class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">البنوك - العملاء- مقبوضات نقديه عن طريق البنك </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                             <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-settlementBankDeposit" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>

                                    <th class="">التاريخ  </th>
                                    <th   class="noraml"> اسم التاجر  </th>
                                    <th   class="noraml"> اسم البنك   </th>
                                    <th  class="noraml">البيان  </th>
                                    <th> المبلغ </th>


                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <th class="">التاريخ  </th>
                                    <th  class="noraml"> اسم التاجر  </th>
                                    <th  class="noraml"> اسم البنك   </th>
                                    <th  class="noraml">البيان  </th>
                                    <th class="total2"> المبلغ </th>

                                </tfoot>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->



<!-- Report2  -->


   <div  class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> البنوك - الموردين -مقبوضات شيكات  </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                             <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-settlementSuppliersCheck" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>

                                    <th class="">التاريخ  </th>
                                    <th class="noraml" > اسم المورد  </th>
                                    <th class="noraml"> اسم البنك  </th>
                                    <th class="noraml"> البيان </th>
                                    <th class="noraml"> الرقم الشيك  </th>
                                    <th>القيمة </th>


                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                             
                                    <th class="">التاريخ  </th>
                                    <th  class="noraml"> اسم   </th>
                                    <th class="noraml">اسم البنك  </th>
                                    <th class="noraml"> البيان </th>
                                    <th class="noraml"> الرقم الشيك  </th>
                                    <th class="total3">القيمة </th>
                                </tfoot>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->


<!-- مدفوات الموردين  -->
 <div  class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> تحويل من خزنه لبنك </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                             <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-settlementTTBank" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>

                                    <th class="">التاريخ  </th>
                                    <th   class="noraml"> اسم الخزنة المحول منها   </th>
                                    <th  class="noraml">البيان  </th>
                                    <th> المبلغ </th>


                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <th class="">التاريخ  </th>
                                    <th  class="noraml"> اسم الخزنة المحول منها   </th>
                                    <th class="noraml">البيان  </th>
                                    <th class="total4"> المبلغ </th>

                                </tfoot>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->

<!-- مرتجعات الموردين  -->
 <div  class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> تحويل من بنك لخزنة</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                             <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-settlementTTCashier" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>

                                    <th class="">التاريخ  </th>
                                    <th  class="noraml"> اسم الخزنة  المحول لها  </th>
                                    <th  class="noraml">البيان  </th>
                                    <th> المبلغ </th>


                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <th class="">التاريخ  </th>
                                    <th  class="noraml"> اسم الخزنة  المحول لها   </th>
                                    <th class="noraml">البيان  </th>
                                    <th class="total5"> المبلغ </th>

                                </tfoot>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->



 <div  class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">الموقف النهائى للبنك </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                             <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-finalsttmentBank" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>

                                    <th class="">  له</th>
                                    <th > علية   </th>
                                    <th> النهائى  </th>



                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <th class="">  </th>
                                    <th >  </th>
                                    <th>  </th>


                                </tfoot>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->



    </div><!-- /.row -->
    </section><!-- /.content -->

<script>
$(document).ready(function(){
$("#link25").addClass("hoverlink");
});
</script>

    @endsection