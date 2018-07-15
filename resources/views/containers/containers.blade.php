    @extends('adminheader.header')
    @section('content')


        <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <script src="{{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}"></script>
        <style type="text/css">
            body
            {
                counter-reset: Serial;           /* Set the Serial counter to 0 */
            }

            #tbl-Containers tr td:nth-child(1):before
            {
                counter-increment: Serial;      /* Increment the Serial counter */
                /*content: "Serial is: " counter(Serial); / Display the counter */
            content: counter(Serial); /* Display the counter */
            }
            table.dataTable tbody tr.selected {
                background-color: #B0BED9;
            }
            
            span {
             
            font-size:20px;
            }
            label {
            
            font-size:15px;
            }
            
            .table tr td label {
              font-size:18px;
/*            color:#f90;*/
            }   
            .table tr td span {
              font-size:18px;
/*            color:#f90;*/
            }      
            .table tr td input {
              font-size:18px;
/*            color:#f90;*/
            } 
            button {
              font-size:18px;
/*            color:#f90;*/
            }
            
            .btn{
             font-size:18px;
            
            }
            .btn-success{
        
                   font-size:15px;
            
            }
            .btn-danger{
                   font-size:15px;
            }
            
            #ui-datepicker-div{
             width:21%
            }
        </style>
        <script src={{asset("/plugins/datatables/jquery.dataTables.js")}} type="text/javascript"></script>
        <!-- Main content -->
<!--
<script>
	$(document).ready(function(){

	$(".datepicker").datepicker('setDate', new Date());
    });
    </script>
-->
        <!-- Modal -->
        <div class="modal fade"  id="addContainerCustom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 80%">
                <div class="modal-content">
                    <div dir="ltr" class="modal-header btn-primary">
                        <h4 class="modal-title"> أضف مستخلص جمركى </h4>
                    </div>
                    <div class="alert alert-danger" style="display: none" id="errorboxCCModal">
                        <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">اغلاق </span></button>
                        <p dir="ltr"></p>
                    </div>
                    <div class="modal-body">
                        <table id="tblc-custommodify" class="table" dir="rtl">
                            <tbody>
                            <tr>
                                <td>
                                    <label class="form-control btn-primary">  اسم المستخلص الجمركى </label>
                                    <input name="ContainerID" type="hidden"/>
                                </td>
                                <td>
                                    <select style="width: 100%" name="CustomID" id="CustomID" data-placeholder="Custom Name" class="reverseAddButton" ></select>
                                </td>
                                <td>
                                    <label class="form-control  btn-primary">  مصاريف المستخلص الجمركى </label>
                                </td>
                                <td>
                                    <input class="form-control reverseAddButton" type="text" name="CustomMount" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="form-control btn-primary">  مسلسل الحاويه </label>
                                </td>
                                <td>
                                    <span id="mcintnum" class="form-control">0</span>
                                </td>
                                <td>
                                    <label class="form-control btn-primary"> عدد الحاويات </label>
                                </td>
                                <td>
                                    <span id="mclocalnum" class="form-control">0</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-6">
                            <button type="button" class="form-control btn btn-primary" data-dismiss="modal">{{ trans('sales.home.close') }}</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" id="CustomModalKey" value="أضافة" class="form-control btn btn-success">إضافة</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade"  id="addContainer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 80%">
                <div class="modal-content">
                    <div dir="ltr" class="modal-header btn-primary">
                        <h4 class="modal-title"> اضف حاوية  </h4>
                    </div>
                    <div class="alert alert-danger" style="display: none" id="errorboxCModal">
                        <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <p dir="ltr">Error Here</p>
                    </div>
                    <div class="modal-body">
                        <table id="tblcontainermodify" class="table" dir="rtl">
                            <tbody>
                            <tr>
                                <td>
                                    <label class="form-control btn-primary">  اسم المورد الخارجى   </label>
                                </td>
                                <td>
                                    <select id="cboforignsupplers" mh_width="width:100%" class="chosen-select-deselect chosen-rtl" name="SupplierID" >
                                        <option value=""> اسم المورد الخارجى (الفلاح )</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{$supplier->SupplierID}}">{{$supplier->SupplierName}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <label class="form-control  btn-primary">تاريخ فتح الحاويه </label>
                                </td>
                                <td>
                                    <input id="darepicker" class="datepicker form-control" type="text" name="ContainerOpenDate" id="datepicker" readonly/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="form-control  btn-primary">  مسلسل الحاوية</label>
                                </td>
                                <td>
                                    <input class="form-control" name="ContainerIntNum" type="text" value="0"/>
                                </td>
                                <td>
                                    <label class="form-control btn-primary"> تاريخ غلق الحاوية </label>
                                </td>
                                <td>
                                    <input id="darepicker2" class="datepicker form-control" name="ContainerEndDate" type="text" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="form-control btn-primary"> عدد الحاويات</label> 
<!--                                        <span id="maxyear"></span></label>-->
                                </td>
                                <td>
                                    <label class="form-control" id="maxcontnum">0</label>
                                </td>
                                <td>
                                    <label class="form-control btn-primary">مصاريف اخرى </label>
                                </td>
                                <td>
                                    <input class="form-control" name="OtherExpenses" type="text" value="0"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="form-control btn-primary">عمولة </label>
                                </td>
                                <td>
                                    <input class="form-control" name="Commision" type="text" value="0"/>
                                </td>
                                <td>
                                    <label class="form-control btn-primary">نوع </label>
                                </td>
                                <td>
    <input class="radio-inline" name="ContainerType" id="statusbrad" value="1" type="radio" checked="checked" />                                      <label class="radio-inline"  for="statusShip">براد </label>
                                    
                <input class="radio-inline" name="ContainerType" id="statusShip" value="0" type="radio" />                     
                                <label class="radio-inline"  for="statusbrad">حاوية </label>
  
               
                                </td>
                            </tr>
                            <tr class="tr_containertype">
                                <td>
                                    <label class="form-control btn-primary"> رقم السيارة  </label>
                                </td>
                                <td>
                                    <input class="form-control" name="CarNumber" type="text" value="0"/>
                                </td>
                                <td>
                                    <label class="form-control btn-primary">النولون </label>
                                </td>
                                <td>
                                    <input class="form-control" name="Nowlon" type="text" value="0"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="tr_containertype">
                                    <label class="form-control btn-primary">اسم السائق </label>
                                </td>
                                <td class="tr_containertype">
                                    <select style="width: 100%" name="DriverID" id="DriverID" data-placeholder="Driver Name" ></select>
                                </td>
                                <td>
                                    <label class="form-control btn-primary">حاله الحاويه </label>
                                </td>
                                <td>
                                    
                                    
<input class="radio-inline" name="ContainerStatus" id="statusyes" value="1" type="radio" checked="checked" />

                                    <label class="radio-inline"  for="statusyes">فتح </label>
                                    
             <input class="radio-inline" name="ContainerStatus" id="statusno" value="0" type="radio"/>

                                  
                                    <label class="radio-inline"  for="statusno"> اغلاق  </label>
                                    
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-6">
                            <button type="button" class="form-control btn btn-primary" data-dismiss="modal">{{ trans('sales.home.close')}} </button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" id="ContainerModalKey" value="" class="ContainerModalKey form-control btn btn-success">{{ trans('sales.home.add')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <input  id="newcontiner" type="button" value="أضف حاويه جديدة " class="form-control col-md-3 btn-success" data-toggle="modal" data-target="#addContainer" />
                    
                    
                </div>
                <div class="col-md-4">
                    <input type="button" id="showContainerCustomModal" value="أضف مستخلص جمركى" class="form-control col-md-3 btn-danger" data-toggle="modal"  />
                </div>
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
<!--                            <h3 class="box-title">  قائمة الحاويات </h3>-->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="alert alert-danger" style="display: none" id="errorboxPrimary">
                                <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                <p dir="ltr"></p>
                            </div>
							
	
                            <table id="tbl-Containers" dir="rtl" class="table table-hover table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>المسلسل </th>
                                    <th>  اسم المورد (الفلاح )</th>
                                    <th> النوع </th>
                                    <th>مسلسل الحاويات </th>
                                    <th>رقم الحاوية  </th>
                                    <th>العموله </th>
                                    <th>تاريخ الفتح </th>
                                    <th>تاريخ الغلق </th>
                                    <th> مصاريف اخرى </th>
                                    <th>رقم السيارة </th>
                                    <th>نولون </th>
                                    <th>الحاله </th>
                                    <th> العمليه </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($containers as $container)
                                    <tr class="ContainerProducts">
                                        <td></td>
                                        <td>{{$container->Supplier()->first()->SupplierName}}</td>
                                        <td>{{$container->ContainerType ? 'Brad' : 'Ship' }}</td>
                                        <td>{{$container->ContainerIntNum}}</td>
                                        <td>{{$container->ContainerLocalNum}}</td>
                                        <td>{{$container->Commision}}</td>
                                        <td>{{$container->ContainerOpenDate}}</td>
                                        <td>{{$container->ContainerEndDate}}</td>
                                        <td>{{$container->OtherExpenses}}</td>
                                        <td>{{$container->CarNumber ?: 'Empty'}}</td>
                                        <td>{{$container->Nowlon}}</td>
                                        <td>
                                            <input class="ContainerStatus" value="{{$container->ContainerID}}" type="checkbox" @if($container->ContainerStatus) checked @endif />
                                        </td>
                                        <td>
                                            <button value="{{$container->ContainerID}}"  class="btn btn-flat btn-info btn-sm EditContainer">تعديل</button>
                                            <button value="{{$container->ContainerID}}"  class="btn btn-flat btn-danger btn-sm RmvContainer">حذف</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
                <div class="col-md-12">
                    <div class="box box-primary direct-chat direct-chat-primary collapsed-box">
                        <div class="box-header with-border">
                            <h3 style="margin-right:2%;" class="box-title">  قائمة بضائع الحاوية </h3>
                            <div  class="box-tools pull-right">
                                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-plus"></i></button>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-ContainersProducts" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>المسلسل </th>
                                    <th> اسم التاجر </th>
                                    <th> اسم المنتج </th>
                                    <th>الوزن  </th>
                                    <th>العدد </th>
                                    <th>السعر </th>
                                    <th>الاجمالى </th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4"></th>
                                        <th colspan="1" class="alert-success">  (<span>0</span>)  <label>Total</label>   </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="box-footer"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-primary direct-chat direct-chat-primary">
                        <div class="box-header with-border">
                            <h3 style="margin-right:2%;" class="box-title">  قائمة المستخلصين لكل حاوية </h3>
                            <div class="box-tools pull-right">
                                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-ContainersCustoms" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>المسلسل</th>
                                    <th> اسم المستخلص </th>
                                    <th>  القيمة </th>
                                    <th>العملية </th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="box-footer"></div>
                    </div>
                </div>
            </div><!-- /.row -->
        </section><!-- /.content -->
    @endsection

    @section('footer_script')
    <script src={{asset("/dist/js/admin/container.js")}} type="text/javascript"></script>
        <script type="text/javascript">
            $( "#darepicker" ).datepicker({
                dateFormat: 'dd/mm/yy',
                currentText: "Today:" + $.datepicker.formatDate('dd/mm/yy', new Date()),
//                 currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
//                $(".datepicker").datepicker('setDate', new Date());

            });        
            
            $( "#darepicker2" ).datepicker({
                dateFormat: 'dd/mm/yy',
                currentText: "Today:" + $.datepicker.formatDate('dd/mm/yy', new Date()),
//                 currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
//                $(".datepicker").datepicker('setDate', new Date());

            });
            
            
            $( "#darepicker" ).datepicker("setDate", new Date());
//            $(".datepicker").datepicker('setDate', new Date());

            $(function () {
                $('#tbl-Containers').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": true
                });
            });

        </script>
<script> 
$(document).ready(function(){    
$("#link10").addClass("hoverlink");
});
</script>
    @endsection
