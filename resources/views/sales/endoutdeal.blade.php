@extends('sales.app')

@section('content')
    <div class="container">
        @if (isset($errors) && count($errors))
            @include('errors.partial.errors')
        @endif
        
        <style>
            .navbar h4 a{
     color:#fff;
              
 }
    #save{
          font-weight: bold;
    }
          .form-control{
          font-weight: bold;
              font-size:18px;
/*                color:#f90;*/
    }

    
   
	
        </style>

        <div class="alert alert-danger page-alert hidden_a4p" id="errorbox">
            <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <p>error here</p>
        </div>
        <span class="col-md-2 "></span>
        <div class="container col-md-8">
            <table id="tbl-endoutdeal" class="table text-center" dir="rtl" style="width: 100%">
                <tr>
                    <td>
                        <label id='lbldate' class="form-control btn-primary">{{trans('sales.home.date')}}</label>
                    </td>
                    <td>
                        @if (isset($deal))
                            <label class="form-control alert-success">{{$deal->Sales->SalesDate}}</label>
                        @else
                            <input id="datepicker" name="SalesDate" class="form-control" type="text" placeholder="dd/mm/yyyy" />
                        @endif

                    </td>
                </tr>
                <tr>
                    <td>
                        <label id="lblcustomer" class="form-control btn-primary">{{trans('sales.home.customer.customer')}}</label>
                    </td>
                    <td>
                        @if (isset($deal))
                            <label class="form-control alert-success">{{$deal->Sales->Customer->CustomerName}}</label>
                        @else
                            <select name="CustomerID"   data-placeholder="اسم التاجر" class="form-control" >
                                <option data-comm="0" value="0" selected > اختار تاجر </option>
                                @foreach($customers as $customer)

                                    <option data-CustType="{{$customer->CustomerType}}" data-comm="{{$customer->CustomerCommission}}" value="{{$customer->CustomerID}}">{{$customer->CustomerName}}</option>

                                @endforeach
                            </select>
                        @endif

                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="form-control btn-primary">{{trans('sales.home.sign')}}</label>
                    </td>
                    <td>
                        @if (isset($deal))
                            <label class="form-control alert-success">{{$deal->Sales->RefNo}}</label>
                        @else
                            <select name="RefNo" mh_width="width:100%" class="form-control" >
                                <option value="0">اختر علامة  </option>
                            </select>
                        @endif

                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="form-control btn-primary">{{trans('sales.home.enddeal.valuesold')}}</label>
                    </td>
                    <td>
                        <input id="valuesold" class="form-control" onkeypress="return isNumberKey(event)" name="valuesold" type="text" value="@if (isset($deal)){{$deal->valuesold}}@else{{'0'}}@endif" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="form-control btn-primary">{{trans('sales.home.enddeal.billexpenses')}}</label>
                    </td>
                    <td>
                        <input id="billexpenses" class="form-control" onkeypress="return isNumberKey(event)" name="billexpenses" type="text" value="@if (isset($deal)){{$deal->billexpenses}}@else{{'0'}}@endif" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="form-control btn-primary">{{trans('sales.home.commision.commision')}}</label>
                    </td>
                    <td>
                        <input id="commision" class="form-control" onkeypress="return isNumberKey(event)" name="commision" type="text" value="@if (isset($deal)){{$deal->commision}}@else{{'0'}}@endif" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="form-control btn-primary">{{trans('sales.home.total')}}</label>
                    </td>
                    <td>
                        <label id='total1' Class="form-control ">@if (isset($deal)) {{$deal->Total_1}} @else {{'0'}} @endif</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="form-control btn-primary">{{trans('sales.home.enddeal.estimatedvalue')}}</label>
                    </td>
                    <td>
                        <input id="toftotal" class="form-control" name="estimatedvalue" onkeypress="return isNumberKey(event)" type="text" value="@if (isset($deal)){{$deal->estimatedvalue}}@else{{'0'}}@endif" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label id='lblsaleValue' class="form-control btn-primary">{{trans('sales.home.enddeal.internalbillexpenses')}}</label>
                    </td>
                    <td>
                        <input id="internalexpenses" class="form-control" name="internalexpenses" onkeypress="return isNumberKey(event)"  type="text" value="@if (isset($deal)){{$deal->internalexpenses}}@else{{'0'}}@endif" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label id='lblsaleValue' class="form-control btn-primary">{{trans('sales.home.total')}}</label>
                    </td>
                    <td>
                        <label id='total2' class="form-control ">@if (isset($deal)){{$deal->Total_2}}@else{{'0'}}@endif</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="form-control btn-primary">{{trans('sales.home.enddeal.netprofit-loss')}}</label>
                    </td>
                    <td>
                        <label id='netprofit-loss' class="form-control ">0</label>
                    </td>
                </tr>
            </table>
            <div>
                @if (isset($deal))
                    <input id="update" class="form-control btn btn-warning" type="button" value="حدث البيانات "/>
                @else
                    <input id="save" class="form-control btn btn-success" type="button" value="احفظ البيانات"/>
                @endif

            </div>
        </div>
        <span class="col-md-2"></span>
    </div>
    <div class="form-control btn-primary"></div>
@endsection

@section('jscript')
    <script src="{{asset('sales/js/sales_endoutdeal.js')}}" ></script>
@endsection
