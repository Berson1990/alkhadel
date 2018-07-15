
@extends('adminheader.header')


    @section('header')
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-4"></div> 
                            <div  class="col-lg-3  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >أضــافة  مـــورد(فــلاح)  جديـد</h3>
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
        <script src={{asset("/dist/js/admin/suppliers.js")}} type="text/javascript"></script>
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
<!--                            <h3 class="box-title fontDesign">اضافة مورد (فلاح) جديد</h3>-->
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="supplier-form" style="width: 60%" class="container col-xs-5 fontDesign">
                                    <input type="text" name="SupplierName" class="form-control" placeholder="اسم المورد">
                                    

                                    <!-- ------------------- -->

                                    <input class="radio-inline fontDesign" onclick="localsuppliers()" id="rbtnSupplierTypeIn" type="radio" name="SupplierType" data-title="محلى" value="0" checked />

  &nbsp; <label class="radio-inline fontDesign" for="rbtnSupplierTypeIn">محلى</label>


                                    <input class="radio-inline fontDesign" id="rbtnSupplierTypeOut" onclick="forignSuppliers()" type="radio" name="SupplierType" data-title="خارجى" value="1" />

<label class="radio-inline fontDesign" for="rbtnSupplierTypeOut">خارجى</label>

                                    <br />
                                    <!-- --------------------------- -->


                                    <input class="radio-inline fontDesign" id="rbtnCollectType" type="radio" name="CollectType" data-title="بيصفى" value="0" checked />

                                    <label class="radio-inline fontDesign" for="rbtnCollectType">بيصفى</label>


                                    <input class="radio-inlin fontDesigne" id="rbtnCollectType" type="radio" name="CollectType" data-title="يقيد" value="1" />

                                    <label class="radio-inline fontDesign" for="rbtnCollectType">يقيد</label>

                                    <br />
                                    <!-- --------------------------- -->

                                    <input type="text" id="SuppliersComm" name="SupplierCommision" class="form-control only_float fontDesign" placeholder="العموله (نسبه مئويه )">
                                    <br />

                                    <input type="text"  id="kalamia" name="Kalamia" class="form-control only_float fontDesign" placeholder="القلميه (نسبه مئويه )">

                                    <br /><br />
                                    <button id="add-Supplier" class="btn btn-success btn-flat btn-block fontDesign" type="button"><b>اضـــــــــــــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='Suppliererror' class="container col-xs-3 fontDesign"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                {{--<div class="col-xs-12">--}}
                    {{--<div class="box">--}}
                        {{--<div class="box-header">--}}
                            {{--<h3 class="box-title fontDesign">كـــل الموردين (الفلاحين) </h3>--}}
                        {{--</div><!-- /.box-header -->--}}
                        {{--<div class="box-body">--}}
                            {{--<table id="tbl-Suppliers" dir="rtl" class="table table-bordered table-striped" style="text-align:center">--}}
                                {{--<thead>--}}
                                {{--<tr>--}}
                                    {{--<th>م</th>--}}
                                    {{--<th>اســم المورد (الفلاح)</th>--}}
                                    {{--<th>نوع المورد</th>--}}
                                    {{--<th>نوع التحصيل</th>--}}
                                    {{--<th>العمولة</th>--}}
                                    {{--<th>القلمية</th>--}}
                                    {{--<th>العملية</th>--}}
                                {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tbody>--}}
                                {{--@foreach($suppliers as $supplier)--}}
                                {{--<tr>--}}
                                    {{--<td></td>--}}
                                    {{--<td>{{$supplier->SupplierName}}</td>--}}
                                    {{--<td data-val='{{$supplier->SupplierType}}' >@if($supplier->SupplierType==0)محلى @elseif($supplier->SupplierType==1) خارجى @else  @endif</td>--}}
                                    {{--<td data-val='{{$supplier->CollectType}}' >@if($supplier->CollectType==0)بيصفى @elseif($supplier->CollectType==1) يقيد @else  @endif</td>--}}
                                    {{--<td>{{$supplier->SupplierCommision}}</td>--}}
                                    {{--<td>{{$supplier->Kalamia}}</td>--}}
                                    {{--<td>--}}
                                        {{--<button name="EditSupplier_{{$supplier->SupplierID}}" class="btn btn-flat btn-info btn-sm EditSupplier">تعديل</button>--}}
                                        {{--<button name="DelSupplier_{{$supplier->SupplierID}}" class="btn btn-flat btn-danger btn-sm RmvSupplier">حذف</button>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--@endforeach--}}
                                {{--</tbody>--}}
                            {{--</table>--}}
                        {{--</div><!-- /.box-body -->--}}
                    {{--</div><!-- /.box -->--}}
                {{--</div><!-- /.col -->--}}

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title fontDesign">كـــل الموردين (الفلاحين) </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-Suppliers" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>اســم المورد (الفلاح)</th>
                                    <th>نوع المورد</th>
                                    <th>نوع التحصيل</th>
                                    <th>العمولة</th>
                                    <th>القلمية</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->



            </div><!-- /.row -->
        </section><!-- /.content -->
<script> 
$(document).ready(function(){    
$("#link02").addClass("hoverlink");
$("#link02").addClass("hoverlink");
});
</script>
    @endsection
