    @extends('adminheader.header')


    @section('header')
        <section class="content-header">
        <div class="row">

                            <div class="col-lg-5"></div> 
                            <div  class="col-lg-2  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >أضــافة  تــاجـر  جديـد</h3>
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
        <script src={{asset("/dist/js/admin/customers.js")}} type="text/javascript"></script>
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
<!--                            <h3 class="box-title  fontDesign">اضافة تاجر جديد</h3>-->
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div id="customer-form" style="width: 60%" class="container col-xs-5">
                                    <input type="text" name="CustomerName" class="form-control fontDesign" placeholder="اسم التاجر">
                                    <br />

                                    <input class="radio-inline fontDesign" id="rbtnCustomerType" type="radio" name="CustomerType" data-title="محلى" value="0" checked />

                                    <label class="radio-inline fontDesign" for="rbtnCustomerType">محلى</label>


                                    <input class="radio-inline fontDesign" id="rbtnProuductName" type="radio" name="CustomerType" data-title="سفـــر" value="1" />

                                    <label class="radio-inline fontDesign" for="rbtnProuductName">سفـــر</label>

                                    <input class="radio-inline fontDesign" id="rbtnProuductName" type="radio" name="CustomerType" data-title="صعيــد" value="2" />

                                    <label class="radio-inline fontDesign" for="rbtnProuductName">صعيــد</label>

                                    <br /><br />
                                    <button id="add-Customer" class="btn btn-success btn-flat btn-block fontDesign" type="button"><b>اضــــــــــــــــــــــــــــافة</b></button>
                                </div>
                                <div style="width: 35%; height: inherit"  id='Customererror' class="container col-xs-3 fontDesign"></div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title fontDesign">كـــل التجــار </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tbl-Customers" dir="rtl" class="table table-bordered table-striped" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>اســم التــاجر</th>
                                    <th>نــوع التــاجر</th>
                                    <th>العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <td></td>
                                    <td>{{$customer->CustomerName}}</td>
                                    <td data-val='{{$customer->CustomerType}}' >@if($customer->CustomerType==0)محلى @elseif($customer->CustomerType==1) سفر @elseif($customer->CustomerType==2) صعيد @else  @endif</td>
                                    <td>
                                        <button name="EditCustomer_{{$customer->CustomerID}}" class="btn btn-flat btn-info btn-sm EditCustomer">تعديل</button>
                                        <button name="DelCustomer_{{$customer->CustomerID}}" class="btn btn-flat btn-danger btn-sm RmvCustomer">حذف</button>
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
$("#link01").addClass("hoverlink");
});
</script>
    @endsection
