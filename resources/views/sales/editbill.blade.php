@extends('sales.app')

@section('content')
    <div class="alert alert-danger page-alert hidden_a4p" id="error-box">
        <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <p></p>
    </div>
    <div class="container">

        <style>
          
    .navbar h4 a{
     color:#fff;
    
    }
            
   .checkbox-inline+.checkbox-inline, .radio-inline+.radio-inline {
    margin-left: -5px;
            }
        </style>
        {{--<input id="confirmYES" type="button" data-flag="update" value="{{ trans('sales.home.yes') }}" class="form-control btn-success" />--}}

        <div id="confirmBox" class="alert hidden_a4p alert-success">
            <center>
                <button type="button" class="close closebox"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                </button>
                <table style="width: 30%">
                    <tr>
                        <td>
                            <label id="confirmmsg">اضغط على نعم لحفظ التعديلات او لا للتراجع </label>
                        </td>
                        <td>
                            <input id="confirmYES" type="button" data-val="true" value="{{ trans('sales.home.yes') }}" class="form-control btn-success closebox"/>
                        </td>
                        <td>
                            <input id="confirmNO" type="button" data-val="false" value="{{ trans('sales.home.no') }}" class="form-control btn-primary closebox"/>
                        </td>
                    </tr>

                </table>
            </center>
        </div>
        <div class="panel panel-primary" style="text-align: center">
            <h4 class="panel-heading"> رقم الفاتورة</h4>
            <table id="tblMaster" dir="rtl" class="table table-hover table-striped">
                <tr>
                    <td>
                        <label class="form-control btn-primary">{{ trans('sales.home.date') }}</label>
                    </td>
                    <td>
                        <input id="datepicker" class="form-control" name="SalesDate" type="text" value="{{$Sales->SalesDate}}" placeholder=""/>
                    </td>
                    <td>
                        <label class="form-control btn-primary">{{ trans('sales.home.customer.customer') }}</label>
                    </td>
                    <td>
                        <select id="CustomerID" name="CustomerID" data-placeholder="{{ trans('sales.home.customer.customer') }}" class="form-control">
                         <option title="{{$Sales->Customer->CustomerType}}" value="{{$Sales->CustomerID}}" selected="selected" >{{$Sales->Customer->CustomerName}}</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td id="tr_masterextra" class="">
                        <label class="form-control btn-primary ">{{ trans('sales.home.custody') }}</label>
                    </td>
                    <td id="tr_masterextra" class="">
                        <input id="custdylocal" class="form-control local custody custodyupper" type="text" name="Custody" value="{{$Sales->Custody}}" placeholder="{{$Sales->Custody}}"/>
                    </td>
                    <td>
                        <label class="form-control btn-primary">{{ trans('sales.home.discount') }}</label>
                    </td>
                    <td>
                        <input class="form-control" type="text" name="Discount" value="{{$Sales->Discount}}" placeholder="{{$Sales->Custody}}"/>
                    </td>
                </tr>
<!--                <tr >-->
                <tr >
                    <td id="tr_masterextra" class="">
                        <label class="form-control btn-primary">{{ trans('sales.home.nowlon') }}</label>
                    </td>
                    <td id="tr_masterextra" class="">
                        <input class="form-control local upper" type="text" name="Nowlon" value="{{$Sales->Nowlon}}" placeholder="{{$Sales->Nowlon}}"/>
                    </td>
                    <td id="tr_masterextra" class="">
                        <label class="form-control btn-primary">{{ trans('sales.home.driver') }}</label>
                    </td>

                    <td id="tr_masterextra" class="">
                        <select id="DriverID"  name="DriverID" data-placeholder="choose a driver" class="form-control">
                            @if($Sales->Driver)
                             <option value="{{$Sales->DriverID}}"  class="upper local"selected="selected">{{$Sales->Driver->DriverName}}</option>
                            @endif
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="form-control btn-primary">{{ trans('sales.home.sign') }}</label>
                    </td>
                    <td>
                        <input class="form-control" type="text" name="RefNo" value="{{$Sales->RefNo}}"
                               placeholder="{{$Sales->RefNo}}"/>
                    </td>
                    <td>
                        <label class="form-control btn-primary">{{ trans('sales.home.allcarrying') }}</label>
                    </td>
                    <td>
                        <input class="form-control" type="text" name="TotalCarrying" value="{{$Sales->TotalCarrying}}"
                               placeholder="{{$Sales->TotalCarrying}}"/>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="panel panel-primary" style="text-align: center">
        <h4 class="panel-heading"> انت لديك ({{count($SalesDetails)}})  صنف </h4>
        <table dir="rtl" class="table table-hover table-striped">
            <thead>
            <tr>
                <td><label class="form-control btn-primary"> {{ trans('sales.home.serial') }} </label></td>
                <td><label class="form-control btn-primary"> {{ trans('sales.home.productname') }} </label></td>
                <td><label style="height:2%;" class="form-control btn-primary"> Container ID </label></td>
                <td><label class="form-control btn-primary"> {{ trans('sales.home.weightunit') }} </label></td>
                <td><label class="form-control btn-primary"> {{ trans('sales.home.weight') }} </label></td>
                <td><label class="form-control btn-primary"> {{ trans('sales.home.quantity') }} </label></td>
                <td><label class="form-control btn-primary"> {{ trans('sales.home.price') }} </label></td>
                <td><label class="form-control btn-primary"> {{ trans('sales.home.total') }} </label></td>
                <td><label class="form-control btn-primary"> {{ trans('sales.home.carrying') }} </label></td>
                <td><label  class="form-control btn-primary"> {{ trans('sales.home.supplier.supplier') }} </label></td>
                <td>
                <label class="form-control btn-primary"> {{ trans('sales.home.commision.commision') }} </label>
                </td>
                <td class="btn-primary">
                    <label>Check</label>
                    <input id="moveall" type="checkbox"/>
                </td>
            </tr>
            </thead>

            <tbody id="tblDetails">
            <?php
            $alltotal = 0;$allweight = 0;$allqnt = 0;$allcarrying = 0;$allcommision = 0;
            ?>
            @foreach($SalesDetails as $key => $deal)
                <?php
                
                $alltotal += $deal->Total;
                $allweight += $deal->Weight;
                $allqnt += $deal->Quantity;
                $allcarrying += $deal->Carrying;
                $allcommision += $deal->Commision;
               
                ?>
                <tr id="tr_{{$deal->Serial}}" data-text="{{$deal->Serial}}">
                    <td>
                        <label class="form-control btn-warning editsales">{{$key + 1}}</label>
                    </td>
                    <td>
                        <select name="ProductID_{{$deal->Serial}}" data-local="{{$Carrying->local}}" data-imported="{{$Carrying->imported}}"
                                data-placeholder="choose a product" class="form-control">
                                <option value="{{$deal->ProductID}}" selected="selected" >{{$deal->product->ProductName}}</option>
                        </select>
                    </td>
                    <td>
                        <select name="ContainerID_{{$deal->Serial}}">
                            <option value="0"  @if(is_null($deal->ContainerID)) selected="selected" @endif >No
                                Selection
                            </option>
                            @if(!is_null($deal->ContainerID))
                                <option value="{{$deal->ContainerID}}"
                                        selected="selected">{{$deal->Container->ContainerLocalNum}}</option>
                            @endif
                        </select>
                    </td>
                    <td style="width: 9%">

                      
                        <input class="radio-inline" id="weightQuantity_{{$deal->Serial}}" type="radio"
                               name="WeightType_{{$deal->Serial}}" value="0"
                               @if($deal->WeightType == 0)checked @endif />
                        
                          <label class="radio-inline"
                               for="weightQuantity_{{$deal->Serial}}">{{ trans('sales.home.weightkilo') }}</label>

                        <input class="radio-inline" id="weightblock_{{$deal->Serial}}" type="radio"
                               name="WeightType_{{$deal->Serial}}" value="1" @if($deal->WeightType > 0)checked @endif />                        
                        <label class="radio-inline"
                               for="weightblock_{{$deal->Serial}}">{{ trans('sales.home.weighttype') }}</label>
                        


                    </td>
                    <td>
                        <input class="form-control @if($deal->WeightType > 0)hidden @endif"
                               name="Weight_{{$deal->Serial}}" type="text" placeholder="{{$deal->Weight}}"
                               value="{{$deal->Weight}}">
                    </td>
                    <td>
                        <input class="form-control" name="Quantity_{{$deal->Serial}}" type="text"
                               placeholder="{{$deal->Quantity}}" value="{{$deal->Quantity}}">
                    </td>
                    <td>
                        <input class="form-control" name="ProductPrice_{{$deal->Serial}}" type="text"
                               placeholder="{{$deal->ProductPrice}}" value="{{$deal->ProductPrice}}">
                    </td>
                    <td>
                        <label class="form-control" name="Total_{{$deal->Serial}}">{{$deal->Total}}</label>
                    </td>
                    <td style="width:5%;">
                        <input class="form-control" name="Carrying_{{$deal->Serial}}" type="text"
                               value="{{$deal->Carrying}}" placeholder="{{$deal->Carrying}}">
                    </td>
                    <td style="width:3%;">
<!--                        <select style="width:100%;" name="SupplierID_{{$deal->Serial}}" >-->
                        <select style="width:100%;" name="SupplierID_{{$deal->Serial}}" >
                            <option value="{{$deal->Supplier->SupplierID}}" selected="selected" >{{$deal->Supplier->SupplierName}}</option>
                        </select>
                    </td>
                    <td>
                        <input class="form-control" type="text" name="Commision_{{$deal->Serial}}"
                               value="{{$deal->Commision}}" placeholder="{{$deal->Commision}}"/>
                    </td>
                    <td>
                        <input  id="move_{{$deal->Serial}}" value="move_{{$deal->Serial}}"  onclick="flagChecked(this)"  type="checkbox" name="move_{{$deal->Serial}}"/>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <label style="height: 66px" class="form-control btn-success">{{ trans('sales.home.totalweight') }}
                        <span>({{$allweight}})</span>
                    </label>
                </td>
                <td>
                    <label style="height: 66px" class="form-control btn-success">{{ trans('sales.home.totalquantity') }}
                        <span>({{$allqnt}})</span>
                    </label>
                </td>
                <td></td>
                <td>
                    <label style="height: 66px" class="form-control btn-success">{{ trans('sales.home.totaloftotal') }}
                        <span>({{$alltotal}})</span>
                    </label>
                </td>
                <td>
                    <label style="height: 66px" class="form-control btn-success">{{ trans('sales.home.allcarrying') }}
                        <span>({{$allcarrying}})</span>
                    </label>
                </td>
                <td></td>
                <td>
                    <label style="height: 66px"
                           class="form-control btn-success">{{ trans('sales.home.totalcommision') }}
                        <span>({{$allcommision}})</span>
                    </label>
                </td>
                <td></td>

            </tr>
            </tfoot>
        </table>
    </div>
    <div class="container">
        <table class="table">
            <tr>
             <td>
                    <input id="DeteteMasterSales" data-flag="delete" type="button" class="form-control btn-danger"
                           value="حذف الفتوره كاكل "/>
                </td>
                <td>
                    <input id="deletesales" data-flag="delete" type="button" class="form-control btn-danger"
                           value="{{ trans('sales.home.update.deletedeal') }}"/>
                </td>
                <td>
                    <input id="updatesales" data-flag="update" type="button" class="form-control btn-success"
                           value="{{ trans('sales.home.update.update') }}"/>
                </td> 
                  <!-- <td>
                    <input id="Transfer" data-flag="Transfer" type="button" class="form-control btn-success"
                           value="نقل المنتج "/>
                </td> -->
                <td>
                    <input id="clossalespage" data-flag="close" type="button" class="form-control btn-primary"
                           value="{{ trans('sales.home.close') }}"/>
                </td>
            </tr>
        </table>
    </div>
@endsection

@section('jscript')
    <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('sales/js/editbill.js')}}"></script>
@endsection

