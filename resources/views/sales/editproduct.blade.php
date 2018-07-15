<!-- Modal -->
<div class="modal fade"  id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 90%" >
        <div class="modal-content">
            <div class="modal-header btn-primary">
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                <h4 class="modal-title" id="myModalLabel">{{ trans('sales.home.update.updatesupplier') }}</h4>
            </div>
            <div class="alert page-alert hidden_a4p" id="uperror-box">
                <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <p></p>
            </div>
            <div id="upconfirmBox" class="alert alert-warning hidden_a4p">
                <center>
                    <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <table style="width: 30%" >
                        <tr>
                            <td>
                                <label>{{ trans('sales.home.confirmbox') }}</label>
                            </td>
                            <td>
                                <input type="button" data-val="true" value="{{ trans('sales.home.yes') }}" class="form-control btn-success closebox" />
                            </td>
                            <td>
                                <input type="button" data-val="false" value="{{ trans('sales.home.no') }}" class="form-control btn-default closebox" />
                            </td>
                        </tr>

                    </table>
                </center>
            </div>
            <div class="modal-body">
                <form id="frmsales-update" method="post" action="sales/update">
                    <table id="tbl_master" class="table" style="width: 100%">
                        <tr>
                            <td>
                                <label style="white-space: nowrap;"  class="form-control alert-primary">{{ trans('sales.home.billnumber') }}</label>
                            </td>
                            <td>
                                <label id="up_billnumber" class="form-control">1</label>
                            </td>
                            <td>
                                <label class="form-control btn-primary">{{ trans('sales.home.commision.commision') }}</label>
                            </td>
                            <td>
                                <label id="up_commision" class="form-control" ></label>
                            </td>
                            <td>
                                <label class="form-control btn-primary">{{ trans('sales.home.discount') }}</label>
                            </td>
                            <td>
                                <label id="up_discount" class="form-control" ></label>
                            </td>
                            <td>
                                <label class="form-control btn-primary">{{ trans('sales.home.driver') }}</label>
                            </td>
                            <td>
                                <label id="up_driver" class="form-control" ></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="form-control btn-primary">{{ trans('sales.home.nowlon') }}</label>
                            </td>
                            <td>
                                <label id="up_nowlon" class="form-control" ></label>
                            </td>
                            <td>
                                <label class="form-control btn-primary">{{ trans('sales.home.custody') }}</label>
                            </td>
                            <td>
                                <label id="up_custody" class="form-control" ></label>
                            </td>
                            <td>
                                <label class="form-control btn-primary">{{ trans('sales.home.sign') }}</label>
                            </td>
                            <td colspan="2">
                                <input type="text" id="up_refno"  name="up_refno" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label  style="display:none;" for="datepicker" id='lbldate' style="display:none;" class="form-control btn-primary">{{ trans('sales.home.date') }}</label>
                            </td>
                            <td>
                                <input  style="dispaly:none;" name="up_SalesDate" id="editsales" class="form-control" type="text" placeholder="dd/mm/yyyy"  >
                            </td>
                            <td>
                                <label style="display:none;"for="cboCustomerID" id="lblcustomer" class="form-control btn-primary">{{ trans('sales.home.customer.customer') }}</label>
                            </td>
                            <td>
                                <select style="visibility:hidden;" name="up_CustomerID" class="form-control" tabindex="2" data-placeholder="{{ trans('sales.home.customer.select') }}" ></select>
                            </td>
                            <td>
                                <label style="display:none;" class="form-control btn-primary">{{ trans('sales.home.supplier.supplier') }}</label>
                            </td>
                            <td>
                                <select style="display:none;" name="up_SupplierID" tabindex="1" class="form-control" data-placeholder="Select Supplier Name" style="display:none;" ></select>
                            </td>
                            <td>
                                <label class="form-control btn-primary">{{ trans('sales.home.carrying') }} <span></span></label>
                            </td>
                            <td>
                                <input class="form-control" name="up_Carrying" data-imported="{{$Carrying->imported }}" data-local="{{$Carrying->local }}" value="0" class="form-control" type="text" />
                            </td>
                        </tr>
                    </table>
                    <table dir="rtl" class="table">
                        <tbody>
                        <tr>
                            <td>
                                <label class="form-control btn-primary" >
                                    {{ trans('sales.home.productname') }}
                                </label>
                            </td>
                            <td>
                                <label class="form-control btn-primary" >
                                    ContainerID
                                </label>
                            </td>
                            <td>
                                <label class="form-control btn-primary" >
                                    {{ trans('sales.home.weightunit') }}
                                </label>
                            </td>
                            <td>
                                <label class="form-control btn-primary" >
                                    {{ trans('sales.home.weight') }}
                                </label>
                            </td>
                            <td>
                                <label class="form-control btn-primary" >
                                    {{ trans('sales.home.quantity') }}
                                </label>
                            </td>
                            <td>
                                <label class="form-control btn-primary" >
                                    {{ trans('sales.home.price') }}
                                </label>
                            </td>
                            <td>
                                <label class="form-control btn-primary" >
                                    {{ trans('sales.home.total') }}
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td style='width: 16%' >
                                <select data-local="{{$Carrying->local}}" data-imported="{{$Carrying->imported}}" name="up_ProductID" tabindex="3" data-placeholder="choose a product" class="form-control" ></select>
                            </td>
                            <td>
                                <select name="up_ContainerID" style="width: 100%" >
                                    <option value="0">No Selection</option>
                                </select>
                            </td>
                            <td style='width: 16%' >
                                <label class="radio-inline" for="wqnt" >{{ trans('sales.home.weightkilo') }}</label>
                                <input class="radio-inline" id="wqnt"  type="radio" name="up_WeightType" value="0" checked />

                                <label class="radio-inline" for="wblk" >{{ trans('sales.home.weighttype') }}</label>
                                <input class="radio-inline" id="wblk" type="radio" name="up_WeightType" value="1" />
                            </td>
                            <td style='width: 16%' ><input name="up_Weight" tabindex="5" type="text" class="form-control only_float must" placeholder="{{ trans('sales.home.weight') }}"></td>
                            <td style='width: 16%' ><input name="up_Quantity" tabindex="6" type="text" class="form-control only_float  must" placeholder="{{ trans('sales.home.quantity') }}"></td>
                            <td style='width: 16%' ><input name="up_ProductPrice" type="text" class="form-control only_float must" placeholder="{{ trans('sales.home.price') }}"></td>
                            <td style='width: 16%' ><label name="up_Total" >0</label></td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <table class="table">
                    <tr>
                        <td>
                            <button type="button" class="form-control btn btn-primary" data-dismiss="modal">{{ trans('sales.home.close') }}</button>
                        </td>
                        <td>
                            <button type="button" id="UpdateSales" value="" class="form-control btn btn-success">{{ trans('sales.home.update.update') }}</button>
                        </td>
                        <td>
                            <button type="button" id="delsalesdetails" value="" class="form-control  btn btn-danger">{{ trans('sales.home.update.deletedeal') }}</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>