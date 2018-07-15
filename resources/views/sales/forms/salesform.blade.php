<form method="post" action="sales/store">
    <div style="text-align: center" class="panel panel-primary">
        <div class="panel-heading">{{trans('sales.home.salestitle')}}</div>
        <table class="table table-hover" dir="rtl" style="width: 100%">
            <tr>
                <td>
                    <label title="{{trans('sales.home.lblinfo.bill')}}" class="form-control" >{{ trans('sales.home.billnumber') }}</label>
                </td>
                <td>
                    <label class="form-control">0</label>
                </td>
                <td>
                    <label title="{{trans('sales.home.lblinfo.salesdate')}}" for="datepicker"   class="form-control btn-primary">{{ trans('sales.home.date') }}</label>
                </td>
                <td>
                    <input name="SalesDate" class="form-control" type="text" placeholder="dd/mm/yyyy" />
                </td>
                <td>
                    <label title="{{trans('sales.home.lblinfo.supplier')}}" for="cboSupplierID" class="form-control btn-primary">{{ trans('sales.home.supplier.supplier') }}</label>
                </td>
                <td>
                    <select name="SupplierID" mh_width="width:100%" mh_onkeyup="" class="chosen-select-deselect chosen-rtl" >
                        <option value="0" >{{ trans('sales.home.supplier.select') }}</option>
                        @foreach($suppliers as $supplier)

                            <option data-comm="{{$supplier->SupplierCommision}}" data-SupType="{{$supplier->SupplierType}}" value="{{$supplier->SupplierID}}">{{$supplier->SupplierName}}</option>

                        @endforeach
                    </select>
                </td>
                <td>
                    <label title="{{trans('sales.home.lblinfo.customer')}}" for="cboCustomerID" class="form-control btn-primary">{{ trans('sales.home.customer.customer') }}</label>
                </td>
                <td>
                    <select name="CustomerID" mh_width="width:100%" mh_onkeyup="" data-placeholder="{{ trans('sales.home.customer.customer') }}" class="chosen-select-deselect chosen-rtl" >
                        <option value="0" selected >{{ trans('sales.home.customer.select') }}</option>
                        @foreach($customers as $customer)

                            <option data-CustType="{{$customer->CustomerType}}" value="{{$customer->CustomerID}}">{{$customer->CustomerName}}</option>

                        @endforeach
                    </select>
                </td>

            </tr>
            <tr>
                <td>
                    <label title="{{trans('sales.home.lblinfo.commission')}}" for='Commission' class="form-control btn-primary">{{ trans('sales.home.commision.commision') }}</label>
                </td>
                <td>
                    <input name="Commision" class="form-control" onkeypress="return isNumberKey(event)" type="text" value="0" placeholder="{{ trans('sales.home.commision.inputcommision') }}" />
                </td>
                <td>
                    <label title="{{trans('sales.home.lblinfo.carrying')}}" class="form-control btn-primary">{{ trans('sales.home.mashal') }} <span></span> </label>
                </td>
                <td>
                    <div class="form-control-static">
                        <input name="Carrying" value="0" class="form-control" onkeypress="return isNumberKey(event)" type="text" placeholder="{{ trans('sales.home.mashal') }}"  />
                    </div>

                </td>
                <td>
                    <label title="{{trans('sales.home.lblinfo.discount')}}" class="form-control btn-primary">{{ trans('sales.home.discount') }}</label>
                </td>
                <td>
                    <input name="Discount" value="0" class="form-control" type="text" onkeypress="return isNumberKey(event)" placeholder="{{ trans('sales.home.discount') }}" />
                </td>
            </tr>

            <tr class="hidden_a4p"> <!-- style="display: none" -->
                <td class="agency">
                    <label title="{{trans('sales.home.lblinfo.nowlon')}}" class="form-control btn-primary">{{ trans('sales.home.nowlon') }}</label>
                </td>
                <td class="agency">
                    <input name="Nowlon" onkeypress="return isNumberKey(event)" class="form-control" type="text" placeholder="" />
                </td>
                <td class="agency">
                    <label title="{{trans('sales.home.lblinfo.driver')}}" class="form-control btn-primary">{{ trans('sales.home.driver') }}</label>
                </td>
                <td class="agency">
                    <select name="DriverID" mh_width="width:100%" mh_onkeyup="" data-placeholder="choose a driver" class="chosen-select-deselect chosen-rtl" >
                        <option value="0"><-- {{ trans('sales.home.driver') }} --></option>
                        @foreach($drivers as $driver)

                            <option value="{{$driver->DriverID}}">{{$driver->DrverName}}</option>

                        @endforeach
                    </select>
                </td>
                <td class="">
                    <label title="{{trans('sales.home.lblinfo.custody')}}"  class="form-control btn-primary">العهدة</label>
                </td>
                <td class="">
                    <input name="Custody" onkeypress="return isNumberKey(event)"  class="form-control" type="text" placeholder="" />
                </td>
                <td class="southegypt" >
                    <label title="{{trans('sales.home.lblinfo.signs')}}"  class="form-control btn-primary">علامة</label>
                </td>
                <td class="southegypt" >
                    <input name="Carnums" onkeypress="return isNumberKey(event)" class="form-control" type="text" placeholder="" />
                </td>
            </tr>

        </table>
    </div>
    <div style="text-align: center" class="panel panel-primary">
        <div class="panel-heading">{{trans('sales.home.salesdetailstitle')}}</div>
        <table dir="rtl" class="table table-hover table-striped">
            <tbody>
            <tr>
                <td style='width: 5%' class="hidden_a4p">م</td>
                <td> <label class="form-control btn-warning" > م </label> </td>
                <td>
                    <label title="{{trans('sales.home.lblinfo.product')}}" class="form-control btn-primary" >
                        {{ trans('sales.home.productname') }}
                    </label>
                </td>
                <td>
                    <label title="{{trans('sales.home.lblinfo.unit')}}" class="form-control btn-primary" >
                        {{ trans('sales.home.weightunit') }}
                    </label>
                </td>
                <td>
                    <label title="{{trans('sales.home.lblinfo.weight')}}"  class="form-control btn-primary" >
                        {{ trans('sales.home.weight') }}
                    </label>
                </td>
                <td>
                    <label title="{{trans('sales.home.lblinfo.quantity')}}" class="form-control btn-primary">
                        {{ trans('sales.home.quantity') }}
                    </label>
                </td>
                <td>
                    <label title="{{trans('sales.home.lblinfo.price')}}" class="form-control btn-primary" >
                        {{ trans('sales.home.price') }}
                    </label>
                </td>
                <td>
                    <label title="{{trans('sales.home.lblinfo.total')}}" class="form-control btn-primary" >
                        {{ trans('sales.home.total') }}
                    </label>
                </td>
            </tr>
            <tr>
                <td  style='width: 5%' class="hidden_a4p"> <label >0</label> </td>
                <td style='width: 5%' > <label></label> </td>
                <td style='width: 16%'>
                    <select name="ProductID" mh_width="width:100%" mh_onkeyup="" data-placeholder="choose a product" class="chosen-select-deselect chosen-rtl must" >
                        <option value="0">{{ trans('sales.home.productname') }}</option>
                        @foreach($products as $product)

                            <option data-type="{{$product->ProductType}}" data-carrying=@if($product->ProductType < 1) {{$Carrying->local}}@else{{$Carrying->imported}} @endif  value="{{$product->ProductID}}"> {{$product->ProductName}} </option>

                        @endforeach
                    </select>
                </td>
                <td style='width: 16%' >
                    <label class="radio-inline" for="weightQuantity" >{{ trans('sales.home.weightkilo') }}</label>
                    <input class="radio-inline" id="weightQuantity"  type="radio" name="WeightType" value="0" checked />
                    <label class="radio-inline" for="weightblock" >{{ trans('sales.home.weighttype') }}</label>
                    <input class="radio-inline" id="weightblock" type="radio" name="WeightType" value="1" />
                </td>
                <td style='width: 16%' ><input name="Weight" type="text" class="form-control only_float must" placeholder="{{ trans('sales.home.weight') }}"></td>
                <td style='width: 16%' ><input name="Quantity" type="text" class="form-control only_float  must"  placeholder="{{ trans('sales.home.quantity') }}"></td>
                <td style='width: 16%' ><input name="ProductPrice" type="text" class="form-control only_float must" placeholder="{{ trans('sales.home.price') }}"></td>
                <td style='width: 16%' ><label name="Total" >0</label></td>
            </tr>
            </tbody>
        </table>
    </div>
</form>