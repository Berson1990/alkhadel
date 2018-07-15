    @extends('adminheader.header')


    @section('header')

        <section class="content-header">
      
<!--
                <small> </small>
                قائمــة الأصنـــاف
            </h1>
-->
<!--
            <ol class="breadcrumb">
                <li><a href="{{ URL('/home') }}"><i class="fa fa-dashboard"></i> الصفحة الرئيسية</a></li>
                <li class="active"><i class="fa fa-tags"></i> الأأصنـــاف</li>
            </ol>
--> 
                <div class="row">

                            <div class="col-lg-5"></div> 
                            <div  class="col-lg-2  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >أضــافة  صــنف  جديـد</h3>
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
        <script src={{asset("/dist/js/admin/products.js")}} type="text/javascript"></script>
        <script src={{asset("/plugins/datatables/jquery.dataTables.js")}}  type="text/javascript"></script>
        <script type="text/javascript">
            config = <?php echo json_encode($js_config) ?>;
        </script>
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
<!--                            <h3 class="box-title fontDesign">اضافة صنف جديد</h3>-->
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="product-form" style="width: 60%" class="container col-xs-5">
                                    <input  type="text" name="ProductName" class="form-control" placeholder="اسم الصنف">
                                    <br />

                                    <input class="radio-inline fontDesign" id="rbtnProductType" type="radio" name="ProductType" data-title="محلى" value="0" checked />

                                    <label class="radio-inline fontDesign" for="rbtnProductType">محلى</label>


                                    <input class="radio-inline fontDesign" id="rbtnProductName" type="radio" name="ProductType" data-title="مستورد" value="1" />

                                    <label class="radio-inline fontDesign" for="rbtnProductName">مستورد</label>


                                    <br /><br />
                                    <button id="add-Product" class="btn btn-success btn-flat btn-block fontDesign" type="button"><b>اضــــــــــــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='Producterror' class="container col-xs-3 fontDesign"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title fontDesign">كـــل الأصناف </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-Products" dir="rtl" class="table table-bordered table-striped fontDesign" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>اســم الصــنف</th>
                                    <th>الفئـــة</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td></td>
                                    <td>{{$product->ProductName}}</td>
                                    <td data-val='{{$product->ProductType}}' >@if($product->ProductType)مستورد @else محلى @endif</td>
                                    <td>
                                        <button name="EditProduct_{{$product->ProductID}}" class="btn btn-flat btn-info btn-sm EditProduct">تعديل</button>
                                        <button name="DelProduct_{{$product->ProductID}}" class="btn btn-flat btn-danger btn-sm RmvProduct">حذف</button>
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
$("#link00").addClass("hoverlink");
});
</script>
    @endsection
