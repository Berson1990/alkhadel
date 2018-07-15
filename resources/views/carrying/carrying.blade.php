    @extends('adminheader.header')


    @section('header')
<!--
        <section class="content-header">
            <h1>
                <small> </small>
                قائمــة المشال
            </h1>
            <ol class="breadcrumb">
                <li><a href="/dashboard"><i class="fa fa-dashboard"></i> الصفحة الرئيسية</a></li>
                <li class="active"><i class="fa fa-tags"></i> المشال</li>
            </ol>
        </section>
-->
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
            
            .fontDesign{
							font-size: 18px;
							font-wight:bold;
							}
        </style>

 
        <script src={{asset("/dist/js/admin/carrying.js")}} type="text/javascript"></script>
        <script src={{asset("plugins/datatables/jquery.dataTables.js")}} type="text/javascript"></script>
        <script type="text/javascript">
            config = <?php echo json_encode($js_config) ?>;
        </script>

<link href={{asset('dist/css/skins/hover.css')}} rel="stylesheet" type="text/css" />
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title fontDesign">المشـــال </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-Carring" dir="rtl" class="table table-bordered table-striped fontDesign" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>مشال المنتجات المحلية</th>
                                    <th>مشال المنتجات المستوردة</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($carrying as $carrying)
                                <tr>
                                    <td></td>
                                    <td>{{$carrying->local}}</td>
                                    <td>{{$carrying->imported}}</td>
                                    <td>
                                        <button name="EditCarrying_{{$carrying->CarryingID}}" class="btn btn-flat btn-info btn-sm EditCarrying">تعديل</button>
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
