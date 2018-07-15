@extends('sales.app')

@section('content')

<!---->

<style type="text/css">

#tbl-salesdetails thead tr td:nth-child(1), #tbl-salesdetails tbody tr td:nth-child(1) {
     background-color:#fff ;
}


.panel-primary>.panel-heading {
 background-color:#31b0d5;
    border-color:#31b0d5;
    color: #fff;
}

                        @media print{
 							/*hide navbar one on print*/
                       
                                     .fontinprintbills{
                                font-size:18px;
                            }

							.navbar{
                            display:none;
                             }


/*							hide section two on print*/
							#sec1{
                            display:none;
                          }
							#sec2{
                            display:none;
                          }
							/*hide button print on print */
						  #ptn2{
                            display:none;

                          }	
                          #ptn3{
                            display:none;

                          }
							#editbill{
							display:none;
							}
							.foot2{
							display:none;
							}		#error-box{
							display:none;
							}

                            .word{

                                font-size: 15px;
                            }
/*
							#suppliers{
							display:none;
							}

                            .suppliers-info{
							display:none;
							}
.

*/
							.upprint{
/*
							float:left;
								 margin:-20px 0 0 0;
*/

							}
/*
							.up33{
							width:150px;
							}
*/

                       
/*                      
							#up33{
          				width:170px;
							margin:0 0 0 25px ;
							}#up34{
							width:170px;
							}#up35{
							width:170px;
							}#up36{
							width:170px;
							}
*/
*/
						   .font{
                                  font-weight:bold;
                                 font-size:13px;
                                  width:50%;
                             }
                            .tdwidth{
                            width:10px;
                            }
                            /* modifay td contain two word*/
                            .tdwidth2word{
                            width:102px;
                            font-size: 12px;
                            }

/*
							#totalweight{
							width:100px;

							}
*/
                            .footer{
                            width: 100%;
                        /*    position: fixed;
                            bottom: 0;*/

                            }
                           .lasttable .form-control{
                                font-size: 15px;
                                font-weight: bold;
                                height:15px;
                                line-height: 0.428571;
                                /*width:100%;*/
                                 /*width: 80%*/

                            }
                            .lasttable {
                                font-size: 15px;
                                font-weight: bold;
                                height:15px;
                                line-height: 0.428571;
                                /*margin:0 0 0 -120px ;*/
                              /*  position: relative;
                                left: -100px;*/

                            }

                            .font2{
                        font-size:12px;
                        font-weight:bold;

                                }

                                 .font{
                         font-weight:bold;
                        font-size:10px;
                    }


                        }


/*	preamble section */
	#preamble{
	float:right;
    width:620px;
	position:relative;
    top:-20px;
	font-size:15px;
	}
/*
	#headprint{

	}
*/
/*
	#noteprint  {
    font-wight:bold;
    font-size:16px;
/*      height:350px;  */

	}*/

	.conection{
	margin:-90px 0 0 -60px;
	}
	.conection li{
	list-style:none;
	}


    .navbar h4 a{
     color:#fff;

    }

    .info{
    font-size:16px;
        font-weight:bold;
    }
   .font{
       font-weight:bold;
       font-size:13px;
       /*width:10%;*/
 }

    .OnPrint{
       font-weight:bold;
       font-size:13px;
       width:100%;
 }
    label.billnumber{
    height:45px;
/*        margin:-5px 0 0 0 ;*/
/*        width:2%;*/
    }

    .panel-heading {
    font-size: 18px;
   font-wight:bold;
}

    a {
    font-weight: bold;
}

    .editbills{
    margin:-12px 0 0 0;

    }

    .editsales{
    text-decoration: underline;

    }
   .font2{
     font-size:18px;
        font-weight:bold;
}
    #protype{
        height:30px;
        position: relative;
        left: 907px;
        width: 15%;
        font-weight: bold;
        font-size: 15px;
        color:black;

    }
    #closed{

        margin:0 157px 0 0
    }

.margin{

position:relative;
top:5px;
left:35%;
    /*margin:0 0 0 60px ;*/
}
      #ptn2{
                            width:25%;

                          } 

#ptn3{
    position: relative;
    width: 28%;
    left: -4px;
    top: 0px;
}
    /*.incwidth{

        width:100%;
    }*/
/*modifay td contain  one word table of bill */
.tdwidth{
width:10px;
}
/* modifay td contain two word*/
.tdwidth2word{
width:102px;
font-size: 15px;0
}

.from-control .wdthpro{
width:100px;

}


</style>

<!---->




    <link href="{{asset('plugins/select2-4.0.0/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{('dist/css/skins/hover.css')}}" rel="stylesheet" type="text/css" />
    <div class="alert alert-danger page-alert hidden_a4p" id="error-box">
        <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <p>error here</p>
    </div>
    <br />
    <div class="container">

        <form id="frmsales" method="post" action="sales/store">
            <div style="text-align: center" id="sec1" class="panel panel-primary">
                <div class="panel-heading">{{trans('sales.home.salestitle')}}

				</div>
                <table id="tbl_master" class="table table-hover" dir="rtl">
                    <tr>
                        <td>
                            <label title="{{trans('sales.home.lblinfo.bill')}}" class="form-control alert-info billnumber" >{{ trans('sales.home.billnumber') }}</label>
                        </td>
                        <td>
                            <label id="billnumber"  value="0" class="form-control">0</label>
                        </td>
                        <td>
                            <label title="{{trans('sales.home.lblinfo.salesdate')}}" for="datepicker" id='lbldate'  class="form-control show datepicker hasDatepicker">{{ trans('sales.home.date') }}</label>
<!--				form-control btn-info			form-control show datepicker hasDatepicker-->
                        </td>
                        <td>
                            <input name="SalesDate" id="datepicker"  class="form-control refresh" type="text" placeholder="dd/mm/yyyy" />
                        </td>
                        <td>
                            <label title="{{trans('sales.home.lblinfo.supplier')}}" for="cboSupplierID" id="" class="form-control btn-info">{{ trans('sales.home.supplier.supplier') }}</label>
                        </td>
                        <td>
                            <select style="width: 100%" name="SupplierID"  id="SupplierID" data-placeholder=" اسم المورد" ></select>

                        </td>
                        <td>
                            <label title="{{trans('sales.home.lblinfo.customer')}}" for="cboCustomerID" id="" class="form-control btn-info">{{ trans('sales.home.customer.customer') }}</label>
                        </td>
                        <td>
                            <select style="width: 100%" name="CustomerID" id="CustomerID" data-placeholder=" اسم التاجر "  class="refresh"></select>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label title="{{trans('sales.home.lblinfo.commission')}}" for='Commission' id='' class="form-control btn-info">{{ trans('sales.home.commision.commision') }}</label>
                        </td>
                        <td>
                            <input   name="Commision" id='Commission' class="form-control" onkeypress="return isNumberKey(event)" type="text" value="0" placeholder="{{ trans('sales.home.commision.inputcommision') }}" />
                        </td>
                        <td>
                            <label title="{{trans('sales.home.lblinfo.carrying')}}" id="" class="form-control btn-info ">{{ trans('sales.home.carrying') }} <!--<span></span>--> </label>
                        </td>
                        <td>
                            <div class="form-control-static">
                                <input id="carr" name="Carrying"  value="0" class="form-control" onkeypress="return isNumberKey(event)" type="text" placeholder="{{ trans('sales.home.carrying') }}"  />
                            </div>

                        </td>
                        <td>
                            <label title="{{trans('sales.home.lblinfo.discount')}}" class="form-control btn-info">{{ trans('sales.home.discount') }}</label>
                        </td>
                        <td>
                            <input name="Discount" value="0" class="form-control claerinput change" type="text" {{--onkeypress="return isNumberKey(event)"--}} placeholder="{{ trans('sales.home.discount') }}" />
                        </td>
                        <td>
                            <label title="{{trans('sales.home.lblinfo.signs')}}"  class="form-control btn-info">{{ trans('sales.home.sign') }}</label>
                        </td>
                        <td>
                            <input id="RefernceNo"  name="RefNo" onkeypress="return isNumberKey(event)" class="form-control refresh" type="text" value="1" />
                        </td>
                    </tr>

                    <tr id='tr_masterextra' class="hidden_a4p"> <!-- style="display: none" -->
                        <td class="agency">
                            <label title="{{trans('sales.home.lblinfo.nowlon')}}" class="form-control btn-info">{{trans('sales.home.nowlon')}}</label>
                        </td>
                        <td class="agency">
                            <input   name="Nowlon" onkeypress="return isNumberKey(event)" class="form-control claerinput change" type="text" placeholder="" />
                        </td>
                        <td class="agency">
                            <label title="{{trans('sales.home.lblinfo.driver')}}" class="form-control btn-info">{{trans('sales.home.driver')}}</label>
                        </td>
                        <td class="agency">
                            <select class="claerinput" style="width: 100%" name="DriverID" id="DriverID" data-placeholder="choose a driver" >
                                <option value="0">{{ trans('sales.home.driver') }}</option>
                            </select>
                        </td>
                        <td class="">
                            <label title="{{trans('sales.home.lblinfo.custody')}}"  class="form-control btn-info">{{ trans('sales.home.custody') }}</label>
                        </td>
                        <td class="">
                            <input name="Custody" onkeypress="return isNumberKey(event)"  class="form-control claerinput change" type="text" placeholder="" />
                        </td>
                    </tr>
                </table>
                
                <input type="button" style="width: 15%" id="UpdateMSales" class="form-control btn btn-success font" value="{{trans('sales.home.update.updatemaster')}}"/>
            </div>
            <div style="text-align: center" id="sec2" class="panel panel-primary">
                <div class="panel-heading">{{trans('sales.home.salesdetailstitle')}}</div>
                <table id="tbl_view" dir="rtl" class="table table-hover table-striped">
                    <tbody>
                    <tr>
                        <td style='width: 5%' class="hidden_a4p">م</td>
                        <td> <label class="form-control btn-info" > م </label> </td>
                        <td>
                            <label title="{{trans('sales.home.lblinfo.product')}}" class="form-control btn-info" id="">
                                {{ trans('sales.home.productname') }}
                            </label>
                        </td>
                        <td class="Containertd hide">
                            <label title="{{trans('sales.home.lblinfo.product')}}" class="form-control btn-info" id="lblpruodctname">
                                Select_Container
                            </label>
                        </td>
                        <td>
                            <label title="{{trans('sales.home.lblinfo.unit')}}" class="form-control btn-info" id="lblweightunit">
                                {{ trans('sales.home.weightunit') }}
                            </label>
                        </td>
                        <td>
                            <label title="{{trans('sales.home.lblinfo.weight')}}"  class="form-control btn-info" id="lblweight">
                                {{ trans('sales.home.weight') }}
                            </label>
                        </td>
                        <td>
                            <label title="{{trans('sales.home.lblinfo.quantity')}}" class="form-control btn-info" id="">
                                {{ trans('sales.home.quantity') }}
                            </label>
                        </td>
                        <td>
                            <label title="{{trans('sales.home.lblinfo.price')}}" class="form-control btn-info" id="lblproductprice">
                                {{ trans('sales.home.price') }}
                            </label>
                        </td>
                        <td>
                            <label title="{{trans('sales.home.lblinfo.total')}}" class="form-control btn-info" id="lbltotal">
                                {{ trans('sales.home.total') }}
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td  style='width: 5%' class="hidden_a4p"> <label id="lblheader1">0</label> </td>
                        <td style='width: 5%' > <label id="lblheader2"></label> </td>
                        <td style='width: 16%'>
                            <select data-local="{{$Carrying->local}}" data-imported="{{$Carrying->imported}}" style="width: 100%"  name="ProductID" id="ProductID" data-placeholder="{{ trans('sales.home.productname') }}" >
                                <option value="0" data-carrying="0" >{{ trans('sales.home.productname') }}</option>
                            </select>
                        </td>
                        <td class="Containertd hide">
                            <select style="width: 100%"  name="ContainerID">
                                <option value="0">No Selection</option>
                            </select>
                        </td>
                        <td style='width: 16%' >
                                                        <input class="radio-inline" id="weightQuantity"  type="radio" name="WeightType" value="0" checked />

                            <label class="radio-inline" for="weightQuantity" >{{ trans('sales.home.weightkilo') }}</label>

                            <input class="radio-inline" id="weightblock" type="radio" name="WeightType" value="1" />
                                                        <label class="radio-inline" for="weightblock" >{{ trans('sales.home.weighttype') }}</label>
                        </td>
                        <td style='width: 16%' ><input name="Weight" type="text" class="form-control only_float must " id="txt_Weight" placeholder="{{ trans('sales.home.weight') }}"></td>
                        <td style='width: 16%' ><input name="Quantity" type="text" class="form-control only_float  must " id="txt_Quantity" placeholder="{{ trans('sales.home.quantity') }}"></td>
                        <td style='width: 16%' ><input name="ProductPrice" type="text" class="form-control only_float must " id="txt_Price" placeholder="{{ trans('sales.home.price') }}"></td>
                        <td style='width: 16%' ><label id="total" name="Total" >0</label></td>
                    </tr>
                    </tbody>
                </table>
                <div id="alertchange">
                    <label id="protype" class="btn btn-warning col-md-1">  </label>
<!--                    href="javascript:void(0)"-->
    <a  style="width: 15%" name="Save" id="closed"  class="form-control btn btn-success font"  onclick="zero()">اضف صنف الى الفاتورة</a>
 <button  id="shhowalert" style="display:none; width: 15%; margin-left:490px" class="form-control btn btn-danger font">احفظ التعديلات الى قمت بها</button>
                    </div>
            </div>
        </form>

        <br />

        <div id="bills" class="panel panel-primary">

    <div id="billpic" class="hide" > <img  style="width:100% ; height:50px; "  src="../public/dist/img/up.png"> </div>
            <div id="headprint" class="form-control panel-heading"  >
	
                <span style="text-align: right" class="col-xs-3 left_note">

                    <a id="editbill" href="/sales/bill/edit/" target="_blank" class="form-control btn btn-success font editbills" >{{trans('sales.home.updatefullbill')}} </a>
                </span>

                <div id="noteprint" class="lasttable  fontinprintbills col-xs-9 right_note"></div>
                <!-- <div class="col-xs-3"></div> -->
            </div>
            <table id="tbl-salesdetails" class="table table-hover table-striped" dir="rtl" style="max-width: 100%">
          <thead>
                <tr>
<!-- {{ trans('sales.home.serial') }}-->
                    <td > <label id="billsNumberinPRint" class="form-control btn-primary" >  رقم الفاتورة</label></td>
                    <td id="inc-sup"> <label class="form-control btn-primary" > الصنف </label></td>
                    <td> <label class="form-control btn-primary" > وزن الوحدة  </label></td>
                    <td> <label class="form-control btn-primary" >العدد </label></td>
                    <td> <label class="form-control btn-primary" >الوزن </label></td>
                    <td > <label class="form-control btn-primary" > {{ trans('sales.home.price') }} </label></td>
                    <td id="sieral"> <label class="form-control btn-primary" > {{ trans('sales.home.total') }} </label></td>
                    <td id="decr-sup" > <label id="suppliers" class="form-control btn-primary" > {{ trans('sales.home.supplier.supplier') }} </label></center> </td>
                </tr>
                </thead>
                <tbody>



               </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td class="form-control-static" ><!--button print here start-->
    <button  onkeyup="myFunction(event)" type="button" id="ptn2"  style="width: 50%;" center class="btn btn-success closed font">طباعة  </button>

   
    <!--    <button  onkeyup="myFunction(event)" type="button" id="ptn3"  style="width: 50%;" center class="btn btn-success closed font"> طباعة خاص</button> -->
<!--button print here  end--></td>
                    <td>
                        <div  id="totalweight" class="form-control btn-info" >
                            <label class="font"> </label>
                            <span  class="font" id="totalweight" > 0</span>

                            
                        </div>
                    </td>

                    <td>
                        <div class="form-control btn-info" >
                            <!-- <label class="font">{{ trans('sales.home.totalquantity') }}</label> -->
                            <span id="totalqnt" ></span>
                        </div>
                    </td>

                        <td style="text-align: center">
                        <div class="form-control btn-info" >
                            <!-- <label class="font"></label> -->
                            <span id="totalwight" ></span>
                        </div>
                    </td>
                            

                 
                                      <td  id="design_print"></td>
                                      <td  id="design_print"></td>
                    <td> <label  id="totalprice" class="form-control btn-info" >0</label> </td>

                   
                </tr>
                    <tr>
                        <td class="foot2"> </td>
                        
                       <td  class="colfot2"  style="text-align:right">
                        <div id="" class="form-control btn-info " >
                            <label class="font">{{ trans('sales.home.totaldiscount') }}</label>
                            <span class="font upprint claerinput" id="Discount"></span>
                           </div>
                    </td>

                      <td id="" colspan="2" class="colfot2">
                            <div class="form-control btn-info " >
                            <label class="font">{{ trans('sales.home.totalAfterNolown') }}</label>
                            <span class="font upprint claerinput" id="Nowlon"></span>
                           </div> 
                        </td>
                               
                        <td class="foot2"> </td>

                               
                        
                             <td class="colfot2" style="width:15%" colspan="2">   
                            
                                 <div class="form-control btn-info"  style="widows: 100%">
                                 <label class="font">{{ trans('sales.home.Discountshow') }}</label>
                                  <span  class="font upprint claerinput" id="discountShow"></span> 
                                  </div>
                             </td>

                        <!-- <td class="foot2"> </td> -->

                         <!-- <td> </td> -->

                    </tr>
                    
                    
                    <tr>
                        <!-- <td class="foot2"> </td> -->
                         <td class="foot2"> </td>

                                <td  class="colfot2"> 
                            <div class="form-control btn-info" >
                            <label class="font">{{ trans('sales.home.totalAfterCustdy') }}</label>
                            <span  class="font upprint claerinput" id="custody"></span>
                           </div> 

                            </td>
                       
                        <td  class="colfot2"> 
                        <div class="form-control btn-info" >
                            <label class="font">{{ trans('sales.home.Drivers') }}</label>
                             <span  class="font upprint" id="drivers"></span>

                           </div>
                        </td>
                        
                           <td colspan="2">
                        <div class="form-control btn-info" style"width:100%" >
                            <label class=""> المشال الكلى 
                            <span id="totalcarrying" ></span>
                            </label>
                        </div>
                    </td>
                        <!-- <td class="foot2"> </td> -->
                        <!-- <td class="foot2"> </td> -->



                    </tr>
<!---->
    <tr>
                        <td class="foot2"> </td>
                                    <td class="colfot3"  > 
                        
                        <div  class="form-control btn-info" >
                            <label class="font2">{{ trans('sales.home.finaltotal') }}</label>
                             <span  class="font2 upprint" id="finaltotal"></span>
                        
                            </divfinaltotal                        </td>

                                <td  class="foot2"> 
<!--
                            <div class="form-control btn-info" >
                            <label class="font">{{ trans('sales.home.totalAfterCustdy') }}</label>
                            <span  class="font upprint claerinput" id="custody"></span>
                           </div> 
-->

                            </td>
                        <!-- <td class="foot2"> </td> -->
                        <!-- <td  class="foot2">  -->
<!--
                         
-->
                        </td>
                        
                    
                        <td class="foot2"></td>
                        <td class="foot2"> </td>

                    

                    </tr>




<!---->
                </tfoot>

            </table>

<br>
<!-- <div class="row">
<div class="col-xs-1" style="background:blue"> </div>
<div class="col-xs-1"  >
<button  onkeyup="myFunction(event)" type="button" id="ptn2"   class="btn  btn-success closed font">طباعة  </button></div>
<div class="col-xs-1" > 
<button  onkeyup="myFunction2(event)" type="button" id="ptn3"    class="btn  btn-primary closed font">طباعة بالفلاح </button></div>

</div> -->
 <!-- <<table id="tbl-salesdetails" class="table table-hover table-striped" dir="rtl" style="max-width: 100%">

 <thead></thead>
 <style type="text/css">
.firsttd{
width:107px;

}

.tdlast{
width:151px;    
}
.tdwidth2{
width:10px;
}
.printdesign{
    width:25%
}
.carryingfot{

    width:13%;
}
 </style>
 <tfoot class="lasttable">
         <tr>
                 <td class="firsttd"></td>
                    <td class="firsttd" ><!button print here start-->
   
<!--button print here  end-->
<!-- <tfoot></tfoot> -->



        </div>


<!-- fotter of print
some fuckin Internal CSS HERE ..!!!! this ont BootSTrap ..This is BullShit  -->
<!-- <div class="container col-md-12" style=""> -->
<div class="footer hide" style="background:#fff;">
 <img  style="width:100% ; height:50px; "  src="../public/dist/img/down.png"> 
   <!--      <div  style="height:100px; border:dashed 3px ; width:35%; text-align:center ;float:left; font-size:10px ; font-weight:bold">
        <br>
            <p>Site  : www.elkhedal.com</p>
            <p>Email : info.elkhedal@gmail.com </p>
        </div>
          <! <div style="width:2%; background:black"> </div> -->
    <!--     <div  style="background:; height:100px; border:dashed 3px ; width:40%; text-align:center; float:left; margin:0 0px 0 0px; font-size:10px ;font-weight:bold">

          <br/>
 <p>  العنوان : البحيرة ـــ رشيد ـــ أمام الادارة الزراعية والموقف الجديد </p>
<p>تليفون المكتب : 0452291365 ـــ تليفون الوكالة :0463924164 </p>
        </div>
        <div style="width:2%; background:black"> </div>
        <div dir="rtl"  style="background:; height:100px; border:dashed 3px; width:25%; text-align:center ;float:left ; font-size:10px ; font-weight:bold">
           <p></p>
           <p> ح/ أحمد الخدل :0112039696</p>
           <p>  عمرو الخدل :01061526624</p>
           <p> محمود الخدل :01005145006</p>
        </div> -->

        </div>
        <!-- </div> -->
<!-- end of   -->
    </div>
    @include('sales.editproduct')
@endsection

@section('jscript')
    <script src="{{asset('sales/js/sales.js')}}" ></script>
    <script src="{{asset('sales/js/sales_update.js')}}" ></script>
    <script src="{{asset('plugins/select2-4.0.0/dist/js/select2.full.min.js')}}"></script>
@endsection