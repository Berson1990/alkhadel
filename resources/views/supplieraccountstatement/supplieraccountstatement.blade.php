@extends('adminnoheader.noheader')


    @section('content')

        <style type="text/css">
            @media print{
                #ptn6{display: none}
            }

            body
            {
                counter-reset: Serial;           /* Set the Serial counter to 0 */
            }

            #tbl-CashierOpeningBalance tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
                content: counter(Serial); /* Display the counter */
            }
			
			.fontDesign{
			font-size: 18px;
			font-wight:bold;
				}
        </style>
        
        <script src={{asset("/dist/js/admin/supplieraccountstatement.js")}} type="text/javascript"></script>
<!--
        <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="/plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>
-->

        <script src="{{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}"></script>
<!--        <script src="/plugins/jQueryUI/jquery-ui-1.11.4.min.js"></script>-->
      
        <!-- Main content -->
        <section class="content">
            <div class="row">
                    <div class="col-md-12 ">
                    <div class="box box-success">
                        <div class="box-header">
                            <h2 class="box-title fontDesign">كشف حساب مورد</h2>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="accountstatement-form" style="width: 60%" class="container col-xs-5">
                                      {{-- <input name="TransDate" id=""  class="form-control datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                    <br /> --}}
                                    <span class="fontDesign">من: </span>
                                    <input name="FromTransDate" id="fromdate2"  class="form-control datepicker" type="text" placeholder="يوم/شهر/سنة"/>
                                      <label style="display:none" class="showFrom"> </label>
                                    <span class="fontDesign">الى: </span>
                                    <input name="ToTransDate" id="todate2"  class="form-control datepicker" type="text" placeholder="يوم/شهر/سنة" />
                                      <label style="display:none" class="showTo"> </label>
                                    
                                        <br />
                                        <select name="SupplierIDas"
                                      mh_width="width:100%"
                                       mh_onkeyup="" tabindex="1"
                                       data-placeholder="اسم المورد"
                                       class="chosen-select-deselect chosen-rtl"
                                       id="SupplierIDas" >
                                      <option data-comm="0" value="0" selected ></option>
                                       @foreach($Suppliers as $suppliers)

                                        <option value="{{$suppliers->SupplierID}}">{{$suppliers->SupplierName}}</option>

                                       @endforeach
                                       </select>  
                                    
                                        
                                        <label  style="display:none" id="showsupplier"> </label>
                                      
                                   

                                    <br /><br />
                                    <button id="search-accountstatement" class="btn btn-success btn-flat btn-block" type="button">بحث</button>
                                </div>
                               
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">تقرير كشف حساب مورد</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-accountstatement" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    
                                    <th>عن</th>
                                    <th>مدين</th>
                                    <th>دائن</th>
                                    <th>بيان</th>
                                    <th>تاريخ</th>
                                   
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->

                <div  id="tohide4" class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <div id="cms_module_uptime_monitors_wrapper" class="dataTables_wrapper">
                                <!-- header div in the Print mode -->
                            </div>
                           <button  onkeyup="myFunction(event)" type="button" id="ptn6" onclick="PrintAS()" style="width: 100%;" center class="btn btn-success">طباعة  </button>
                            <!--the data tables goes here... -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->

            </div><!-- /.row -->
        </section><!-- /.content -->
    @endsection
