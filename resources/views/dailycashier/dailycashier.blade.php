@extends('adminheader.header')


    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-5"></div>
                            <div  class="col-lg-2  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >   تــقرير  يوميه الخزن </h3>
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
        <script src={{asset("/dist/js/admin/dailycashier.js")}} type="text/javascript"></script>

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


                              <input type="hidden" id="beforDay" value="" />
                                <div id="settlementcashier-repo-form"  style="width: 60%" class="container col-xs-5">
                                            
                                    <div id="CashieropeningBalance"></div>
                                    <span class="fontDesign">التاريخ : </span>
                                    <input name="FromTransDate" id="fromdate1"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                  <!--   <span class="fontDesign">الى: </span>
                                    <input name="ToTransDate" id="todate1"  class="form-control show datepicker" type="text" placeholder="يوم/شهر/سنة" />
 -->
										<div class="hide" style="; margin:10px 0 0 0 ;" id="showCshierName"></div>
		                            <br />
									<!-- <br /> -->
									<div id="hideinprint">
                                    <select name="CashierID"
                                            style="width:100%"
                                            dir = "rtl"
                                            data-placeholder="اسم الخزنه"
                                            id="cboCashierID">
										</select>
                                        </div>
										<br />

                                                   <div id="hideinotherprinttable">
                                <!--     <input class="radio-inline " id="rbtnIsndividuale" onclick="individuale()" type="radio" name="rbtn" data-title="تفصيل" value="1" checked  />

                                    <label class="radio-inline fontDesign" id="inname"for="rbtnIndividuale">تفصيل</label> -->
<!--                                    <label class="radio-inline" for="rbtnCustomerType">تفصيل</label>-->

                                  <!--   <input class="radio-inline " id="rbtnComb" onclick="combine()"type="radio" name="rbtn" data-title="تجميع" value="2" />


                                    <label class="radio-inline fontDesign" id="comname"for="rbtnCombine">تجميع</label> -->
                                        </div>
                                        <!-- <br> <br> -->
                                    <button id="search-dailycashier" class="show btn btn-success btn-flat btn-block" type="button"><b>بـــــحــــث</b></button>
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
                            <h3 class="box-title"> مصروفات الخزن  </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
							 <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                            <table id="tbl-dailycashier" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>

                                <tr>

                                    <th > التاريخ  </th>
                                    <th > المبلغ  </th>
                                 <!--    <th class="hide"> المبلغ  </th> -->
                                 


                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
								<tfoot>
                               <tr>
                               <th > التاريخ  </th>
                                    <th > المبلغ  </th>
                                    <!-- <th class="hide"> المبلغ  </th> -->
                                 
                                </tr>
								</tfoot>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->

				<!--Report1 -->
</div>
</section>
    <script type="text/javascript">     
 $(document).ready(function(){
$("#link25").addClass("hoverlink");
});
</script>

    @endsection    