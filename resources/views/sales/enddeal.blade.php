@extends('sales.app')

@section('xcontent')



<link href="{{('dist/css/skins/hover.css')}}" rel="stylesheet" type="text/css" />
    <div class="container">
        <table id="tbl_master" class="table" dir="rtl" style="width: 100%">
            <tr>
                <td>
                    <center>
                        <label id='lbldate' class="form-control btn-primary">التاريخ</label>
                    </center>
                </td>
                <td>
                    <input id="datepicker" class="form-control" type="date" placeholder="dd/mm/yyyy" />
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <label id="lblcustomer" class="form-control btn-primary">التجار</label>
                    </center>
                </td>
                <td>
                    <select name="CustomerID" mh_width="width:100%" mh_onkeyup="" data-placeholder="أسم التاجر" class="chosen-select-deselect chosen-rtl" id="cboCustomerID">
                        <option data-comm="0" value="0" selected ></option>
                        @foreach($customers as $customer)

                            <option data-CustType="{{$customer->CustomerType}}" data-comm="{{$customer->CustomerCommission}}" value="{{$customer->CustomerID}}">{{$customer->CustomerName}}</option>

                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <label id='lblsaleValue' class="form-control btn-primary">القيمة المباعة</label>
                    </center>
                </td>
                <td>
                    <input class="form-control" onkeypress="return isNumberKey(event)" name="saleValue" type="number" value="0" placeholder="ادخل القيمة المباعة" />
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <label id='lblsaleValue' class="form-control btn-primary">مصاريف الفاتورة</label>
                    </center>
                </td>
                <td>
                    <input class="form-control" onkeypress="return isNumberKey(event)" name="saleValue" type="number" value="0" placeholder="ادخل القيمة المباعة" />
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <label id='lblsaleValue' class="form-control btn-primary">الاجمالي</label>
                    </center>
                </td>
                <td>
                    <input class="form-control" onkeypress="return isNumberKey(event)" name="saleValue" type="number" value="0" placeholder="" />
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <label class="form-control btn-primary">القيمة التقديرية</label>
                    </center>
                </td>
                <td>
                    <input name="txtmshal" class="form-control" onkeypress="return isNumberKey(event)" type="text" placeholder="ادخل القيمة التقديرية"  />
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <label id='lblsaleValue' class="form-control btn-primary"> (عهدة + نولون )مصاريف الفاتورة الداخلية</label>
                    </center>
                </td>
                <td>
                    <input class="form-control" onkeypress="return isNumberKey(event)" name="saleValue" type="number" value="0" placeholder="ادخل القيمة المباعة" />
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <label id='lblsaleValue' class="form-control btn-primary">الاجمالي</label>
                    </center>
                </td>
                <td>
                    <input class="form-control" onkeypress="return isNumberKey(event)" name="saleValue" type="number" value="0" placeholder="" />
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <label class="form-control btn-primary">صافي ربح / خسارة</label>
                    </center>
                </td>
                <td>
                    <input class="form-control" type="text" onkeypress="return isNumberKey(event)" placeholder="" />
                </td>
            </tr>


        </table>

        <table id="tbl_view" dir="rtl" class="table">
            <tbody>
            <tr>
                <td style='width: 5%' class="hidden_a4p">ã</td>
                <td style='width: 5%'>م</td>
                <td style='width: 16%'>الفلاح</td>
                <td style='width: 16%'>اسم الصنف</td>
                <td style='width: 16%'>سعر البيع</td>
            </tr>
            <tr>
                <td  style='width: 5%' class="hidden_a4p"> <label id="lblheader1">0</label> </td>
                <td style='width: 5%' > <label id="lblheader2"></label> </td>
                <td style='width: 30%' >
                    <label class="form-control btn-primary"> اسم الفلاح</label>
                </td>
                <td style='width: 30%' >
                    <label class="form-control btn-primary">اسم الصنف</label>
                </td>
                <td style='width: 30%' >
                    <input type="text" class="form-control only_float must" id="txt_Weight" placeholder="ادخل سعر البيع">
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
