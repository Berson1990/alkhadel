﻿var cuatomersbills = function () {
};
$(function () {
    _cuatomersbills = new cuatomersbills();
});

$(document).ready(function () {
    $('#search-CustomersBills').click(function () {

        srttotalbils(0);
        srttotaldeposit(0);
        srttotalrefund(0);
        srttotaldiscount(0);
        srtcustopenblance(0);
        srtcustbalcetype('');
        srttotalbils(0);

        // $(this).prop("disabled",true);
        _cuatomersbills.searchfortables();

        $("#OpenningDate").text('');
        $("#AccountBalance").text('');
    });
});


$(document).ready(function () {




    // $('#tbl-customeropeningbalance').DataTable();

    $("#CustomersBills").select2({
        placeholder: "Search for an Customer Name",
        ajax: {
            url: 'autocompleteCustomer',
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
            type: 'post',
            data: function (params) {
                var queryParameters = {
                    CustomerName: params.term
                }
                return queryParameters;
            },
            processResults: function (output) {
                if (output.status) {
                    return {
                        results: $.map(output.data, function (item) {
                            return {
                                text: item.CustomerName,
                                id: item.CustomerID,
                                CustType: item.CustomerType
                            }
                        })
                    };
                } else {
                    return {
                        results: $.map(output.data, function (item) {
                            return {
                                text: item.message,
                                id: item.id
                            }
                        })
                    };
                }

            }
        }
    });

});


$(document).ready(function () {
    $("#check_prodcut").click(function () {
        if ($(this).is(":checked")) {
            $(".type_pro_change").prop("disabled", false);
        } else {

            $(".type_pro_change").prop("disabled", true)
            $(".type_pro_change").css("background-color", "#ddd")

        }
        if ($(this).is(":checked")) {
            $(".type_pro_change").prop("disabled", false)
            $(".type_pro_change").css("background-color", "#fff")

        }

    });
});


totalSum = 0;
cuatomersbills.prototype.setSum = function (sum) {
    totalSum = sum;
}

checkRadio = 1;

function individuale() {
    checkRadio = 1;
}


function combine() {
    checkRadio = 2;
}


totaldepost = 0;

function srttotaldeposit(data) {
    totaldepost = data;
    // console.log("totaldepost");
    //  console.log(totaldepost);
}

totalrefund = 0;

function srttotalrefund(data) {
    totalrefund = data;
    //  console.log("totalrefund");
    //   console.log(totalrefund);
}

totaldiscount = 0;

function srttotaldiscount(data) {
    totaldiscount = data;
    //  console.log("totaldiscount");
//    console.log(totaldiscount);
}

CustOpenBalnce = 0;

function srtcustopenblance(data) {
    CustOpenBalnce = data;
    console.log("CustOpenBalnce");
    console.log(CustOpenBalnce);

}

accType = '';

function srtcustbalcetype(data) {
    accType = data;
    //   console.log("accType")
    // console.log(accType);
}

totalbills = 0;

function srttotalbils(data) {
    totalbills = data;
    // console.log("totalbills")
    // console.log(totalbills);
}


/*difne functio */


// serch for tables
cuatomersbills.prototype.searchfortables = function () {

    var sum;
    var t = $('#tbl-CustomersReport').DataTable();
    try {
        t
            .clear()
            .draw();
    }
    catch (ex) {
        // alert("error");
        //console.log(ex);
    }

    var pay = $('#tbl-CustomersDeposit').DataTable();
    try {
        // alert("testing");
        pay
            .clear()
            .draw();
    }
    catch (ex) {
        // alert("error");
        // console.log(ex);
    }

    var ref = $('#tbl-CustomersRefund').DataTable();
    try {
        ref
            .clear()
            .draw();
    }
    catch (ex) {
        // alert("error");
        // console.log(ex);
    }

    var disc = $('#tbl-CustomersDiscountss').DataTable();
    try {
        disc
            .clear()
            .draw();
    }
    catch (ex) {
        // alert("error");
        //   console.log(ex);
    }

    var bills = $('#tbl-FinalCustomers').DataTable();
    try {
        bills
            .clear()
            .draw();
    }
    catch (ex) {
        // alert("error");
        // console.log(ex);
    }

    /* end of difne of function */

    $.ajax({
        url: "CustomersBillsLoadData",
        type: "post",
        data: $('#customersbills-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "="),
        dataType: "json"
    })

        .done(function (output) {

            var input = $('#customersbills-repo-form :input');
            //  console.log(input);
            // console.log(input[2].value);

            var x = input[2].value;
            var p = input[3].value;
            // console.log(p);
            // console.log(x);
//            var text=getSupplierName(x);
            var cboSupplierID = $("#CustomersBills").clone();
            $(cboSupplierID).val(x);

            var text = $('option:selected', cboSupplierID).text();
//             console.log(text);


            var productID = $("#ProductType").clone();
            $(productID).val(p);
            var text3 = $('option:selected', productID).text();
//            console.log(text3)


            $("#productshow").text("نوع البضاعة :" + text3);
//            console.log( $("#Showprouduct").text("نوع البضاعة :"+text3));
            $("#ShowSONPrint").text("اسم التاجر: " + text);

            var obj = eval(output);
            //=========new=====================
            var final = 0;
            var totalfinal = 0;
            var tTotal = 0
            var tNowlon = 0;
            var tCustody = 0;
            var tDiscount = 0;
            var tCarrying = 0;
            var type = null;
//==================================            
            var old_Mark = 0;


            for (var i = 0; i < obj.length; i++) {

                var cls_sum_discount = "";
                var cls_sum_Nolown = "";
                var cls_sum_Custody = "";


                if (old_Mark !== obj[i].RefNo) {
                    old_Mark = obj[i].RefNo;
                    tDiscount += obj[i].Discount;
                    tNowlon += obj[i].Nowlon;
                    tCustody += obj[i].Custody;
                    console.log(tCustody);
                    cls_sum_discount = "sum_discount";
                    cls_sum_Nolown = "sum_nowlon";
                    cls_sum_Custody = "sum_custody";
                }

                if (obj[i].ProductType == 0) {
                    text = '<tr><td class="">' + obj[i].SalesDate + '</td>' +
                        '<td class="protype hidecombine">محلى</td>' +
                        '<td class="Refno hidecombine">' + obj[i].RefNo + '</td>' +
                        '<td style="display:none" class="hidecombine">' + obj[i].CustomerName + '</td>' +
                        '<td class="hidecombine">' + obj[i].ProductName + '</td>' +
                        '<td class="hidecombine">' + obj[i].Weight + '</td>' +
                        '<td class="hidecombine">' + obj[i].Quantity + '</td>' +
                        '<td class="hidecombine">' + obj[i].ProductPrice + '</td>' +
                        '<td class="sum sum_Total hidecombine">' + obj[i].Total + '</td>' +
                        '<td class="hidecombine">' + obj[i].SupplierName + '</td>' +
                        '<td class="sum_carrying" style="display:none">' + obj[i].Carrying + '</td>' +
                        '<td class="' + cls_sum_Nolown + '" style="display:none">' + obj[i].Nowlon + '</td>' +
                        '<td class="sum_custody" style="display:none">' + obj[i].Custody + '</td>' +
                        '<td class="' + cls_sum_discount + '" style="display:none">' + obj[i].Discount + '</td>' +
                        '<td class="type" style="display:none">' + obj[i].CustomerType + '</td>' + '</tr>';

                } else {

                    text = '<tr><td class="">' + obj[i].SalesDate + '</td>' +
                        '<td class="protype hidecombine">مستورد</td>' +
                        '<td class="Refno hidecombine">' + obj[i].RefNo + '</td>' +
                        '<td class="hidecombine">' + obj[i].CustomerName + '</td>' +
                        '<td class="hidecombine">' + obj[i].ProductName + '</td>' +
                        '<td class="hidecombine">' + obj[i].Weight + '</td>' +
                        '<td class="hidecombine">' + obj[i].Quantity + '</td>' +
                        '<td class="hidecombine">' + obj[i].ProductPrice + '</td>' +
                        '<td class="sum sum_Total hidecombine">' + obj[i].Total + '</td>' +
                        '<td class="hidecombine">' + obj[i].SupplierName + '</td>' +
                        '<td class="sum_carrying" style="display:none">' + obj[i].Carrying + '</td>' +
                        '<td class="' + cls_sum_Nolown + '" style="display:none">' + obj[i].Nowlon + '</td>' +
                        '<td class="sum_custody" style="display:none">' + obj[i].Custody + '</td>' +
                        '<td class="' + cls_sum_discount + '" style="display:none">' + obj[i].Discount + '</td>' +
                        '<td class="type" style="display:none">' + obj[i].CustomerType + '</td>' + '</tr>';

                }

                t.row.add($(text)).draw();

//                     tNowlon+=obj[i].Nowlon;
//                    tCustody+=obj[i].Custody;
//                    tDiscount+=obj[i].Discount;

                tNowlon = obj[i].Nowlon;
                tCustody = obj[i].Custody;
                console.log(tCustody)
                tDiscount = obj[i].Discount;
                tCarrying += obj[i].Carrying;
                type = obj[i].CustomerType;
                tTotal += obj[i].Total

                // console.log("tCarrying" +tCarrying );
                // console.log("===========" );
                // console.log("tTotal" +tTotal );
//                    console.log(obj[i].CustomerType);
                final = tTotal + tCarrying + tNowlon + tCustody
                totalfinal = (final - tDiscount).toFixed(0);
                srttotalbils(totalfinal)

//                 totalfinal =(totalfinal);
//                    console.log(totalfinal);
//                    srttotalbils(totalfinal)
//                    srttotalbils(totalfinal)

            }//end of for 

            document.getElementById("totalcustomerbills").innerHTML = 'اجمالى الفواتير : ' + totalfinal;

            //  console.log("CustomersBillsLoadData##");
            _cuatomersbills.finalstatment();
        }).error(function (data) {
        _cuatomersbills.finalstatment();
        showError('', data);
    });


    //===================================load customer deposit ===========================
    $.ajax({
        url: "Customerdeposit",
        type: "post",
        data: $('#customersbills-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "="),
        dataType: "json"
    }).done(function (output) {
        var input = $('#customersbills-repo-form :input');

        var obj = eval(output);
        var totaldepoist = 0;
        for (var i = 0; i < obj.length; i++) {

            sup_pay = '<tr><td>' + obj[i].TransDate + '</td>' +
                '<td class="sum">' + obj[i].Mount + '</td>' +
                '<td >' + obj[i].PaymentType + '</td>' +
                '<td >' + obj[i].CheckNo + '</td>' +
                '<td >' + obj[i].Notes + '</td>';

            pay.row.add($(sup_pay)).draw();
            totaldepoist += obj[i].Mount;
        }
        // console.log("Customerdeposit##");
        srttotaldeposit(totaldepoist);
        $(".total").text(totaldepoist);
        // _cuatomersbills.CheckTotal();


        _cuatomersbills.finalstatment();
    }).error(function (data) {

        _cuatomersbills.finalstatment();

        showError('', data);
    });

    //========================================load cutomer redund ================
    $.ajax({
        url: "LoadCustomerRefund",
        type: "post",
        data: $('#customersbills-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "="),
        dataType: "json"
    })
        .done(function (output) {
            var input = $('#customersbills-repo-form :input');
            var obj = eval(output);
            // console.log(output);
            var finalrefund = 0;
            for (var i = 0; i < obj.length; i++) {
                textt = '<tr><td>' + obj[i].RefundDate + '</td>' +
                    '<td class="sum">' + obj[i].Refund + '</td>' +
                    '<td >' + obj[i].Notes + '</td>';

                ref.row.add($(textt)).draw();
                finalrefund += obj[i].Refund;
            }
            // console.log("LoadCustomerRefund##");

            $(".total3").text(finalrefund);
            srttotalrefund(finalrefund);
            // _cuatomersbills.CheckTotal3();

            _cuatomersbills.finalstatment();
        }).error(function (data) {
        _cuatomersbills.finalstatment();
        showError('', data);

    });

//=====================customer Discount ==============================    
    $.ajax({
        url: "LoadCustomerDiscount",
        type: "post",
        data: $('#customersbills-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "="),
        dataType: "json"
    })
        .done(function (output) {
            var input = $('#customersbills-repo-form :input');
            var obj = eval(output);
            var totaldiscount = 0;


            for (var i = 0; i < obj.length; i++) {

                text = '<tr><td>' + obj[i].TransDate + '</td>' +
                    '<td class="sum">' + obj[i].Mount + '</td>' +
                    '<td >' + obj[i].Notes + '</td>';

                disc.row.add($(text)).draw();

                totaldiscount += obj[i].Mount;

            }
            srttotaldiscount(totaldiscount);
            // _cuatomersbills.CheckTotal2();

            $(".total2").text(totaldiscount);
            // console.log("LoadCustomerDiscount##");
            _cuatomersbills.finalstatment();

        }).error(function (data) {
        _cuatomersbills.finalstatment();
        showError('', data);
    });


    //====================== opeinig date==============================================
    $.ajax({
        url: "getCustomerOpeningBalnce2",
        type: "post",
        data: $('#customersbills-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "="),
        dataType: "json"
    }).done(function (output) {
        // alert("output");
        // console.log("output");
        //  console.log(output);
        var obj = eval(output);
        // console.log(obj);

        // var Mount =  obj[0].Mount;


        // var balncetype = obj[0].Debt

        var OpeningDept = '';
        var OpeningBalance = 0;

        srtcustbalcetype(OpeningDept);
        srtcustopenblance(OpeningBalance);

        for (var i = 0; i < obj.length; i++) {

//difne OpeningBalance

            //  console.log("Mount");
            // console.log(obj[i].Mount);
            //  console.log("Debt");
            // console.log(obj[i].Debt);

            if (obj[i].Mount > 0) {

                OpeningBalance = obj[i].Mount;
            } else {
                OpeningBalance = 0;
            }
// Difne TypeBalnce 


            if (obj[i].Debt !== '') {

                OpeningDept = obj[i].Debt;

            } else {

                OpeningDept = '';
            }
            //  console.log("###################");
            srtcustbalcetype(OpeningDept)
            //  console.log(OpeningDept);
            srtcustopenblance(OpeningBalance)

            // OpeningDept=  obj[i].Debt ;


            if (obj[i].Debt == 1) {
                document.getElementById('OpenningDate').innerHTML = "تاريخ الافتتاح :" + obj[i].TransDate;
                document.getElementById('AccountBalance').innerHTML = "الرصيد الافتتاحى :" + obj[i].Mount + " مـديـن";
            } else if (obj[i].Debt == 0) {
                document.getElementById('OpenningDate').innerHTML = "تاريخ الافتتاح :" + obj[i].TransDate;
                document.getElementById('AccountBalance').innerHTML = "الرصيد الافتتاحى :" + obj[i].Mount + " دائــن ";

            }


        }// end of for


        // console.log("getCustomerOpeningBalnce2##");

        _cuatomersbills.finalstatment();
    }).error(function (data) {
        _cuatomersbills.finalstatment();
        showError('', data);
    });


}// serch for tables end 

cuatomersbills.prototype.finalstatment = function () {

    var bills = $('#tbl-FinalCustomers').DataTable();
    try {
        bills
            .clear()
            .draw();
    }
    catch (ex) {
        // alert("error");
        // console.log(ex);
    }
    var dept3 = 0;
    var crdet3 = 0;
    var final103 = 0;
    //   console.log("ayhaga");
    // console.log(accType);
    // console.log(CustOpenBalnce);

    if (accType === '') {
        // console.log("لامدين ولا دائن ");
        // console.log("لامدين ولا دائن ")
        dept3 = totalbills;


        crdet3 = +totaldepost + +totaldiscount + +totalrefund;

// console.log(crdet3);   
        final103 = dept3 - crdet3;
// dept
    } else if (accType == 1) {
        console.log("مدين")
// crdet3 = totalbills;  
        dept3 = +CustOpenBalnce + +totalbills;
        console.log(dept3);
        crdet3 = +totaldepost + +totaldiscount + +totalrefund;
// console.log(crdet);
        final103 = dept3 - crdet3;
// console.log(final101)    
// crdet
    } else if (accType == 0) {
        console.log("دائن ")
        dept3 = totalbills;
// console.log(dept2);                       
        crdet3 = +CustOpenBalnce + +totaldepost + +totaldiscount + +totalrefund;
// console.log(CustOpenBalnce);                     
        final103 = dept3 - crdet3;
// console.log(final102)                       
// maden

    }
    // console.log("##############33");
    // console.log(final103);
    tbl = '<tr><td>' + dept3 + '</td>' +
        '<td>' + crdet3 + '</td>' +
        '<td>' + final103 + '</td>' + '</tr>';
    bills.row.add($(tbl)).draw();

}
//================= setar values ==============

Nowlon = 0;
Discount = 0;
Type = 0;
Carrying = 0;
Custody = 0;

function setNowlon(data) {
    Nowlon = data;
}

function setDiscount(data) {
    Discount = data;
}

function setType(data) {
    Type = data;
}

function setCarrying(data) {
    Carrying = data;
}

function setCustody(data) {
    Custody = data;
}

//==============setar vaules =================R
//=======================================combine  and  induvidal==================================
$(document).ready(function () {
//        var table = $('#tbl-onecustomer').DataTable({dom: 'T<"clear">lfrtip'});
    var table = $('#tbl-CustomersReport').DataTable({
        "columnDefs": [
            {"visible": false, "targets": 0},

        ],
        dom: 'T<"clear">lfrtip',
        "order": [[0, 'asc']],
        "displayLength": 10,
        "drawCallback": function (settings) {
            var api = this.api();
            var rows = api.rows({page: 'current'}).nodes();
            var last = null;

            api.column(0, {page: 'current'}).data().each(function (group, i) {


                if (last !== group) {

                    $(rows).eq(i).before(
                        '<tr class="group"><td colspan="9">' + group + '</td></tr>'
                    );

                    last = group;
                }

            });


            api.column(3, {page: 'current'}).data().each(function (group, i) {

                if (last !== group) {

                    $(rows).eq(i).before(
                        '<tr  style="display:none;" class="group"><td colspan="8">' + group + '</td></tr>'
                    );

                    last = group;
                }

            });


            //==================================Combine==============================

            if (checkRadio == 2) {
                $(".hidecombine").css("display", "none");


                //==============================just creazy  test start   ========================
                api.column(2, {page: 'current'}).data().each(function (group, i) {


                    if (last !== group) {

                        $(rows).eq(i).before(
                            '<tr class="group" style="display:none;"><td>' + group + '</td></tr>'
                        );

                        last = group;
                    }

                });

                $('#tbl-CustomersReport tbody').find('.group').each(function (i, v) {

                    //====difnition somr valiable mebay not used
                    var T_Weight = 0;
                    var T_Quantity = 0;
                    var T_ProductPrice = 0;
                    var T_Total = 0;
                    var refNo = 0;
                    var protype = ' ';


                    //definiton some variables here
                    var T_nowlon = 0;
                    var T_discount = 0;
                    var T_carrying = 0;
                    var T_custody = 0;
                    var type = $(this).find(".type").text();

                    var rowCount = $(this).nextUntil('.group').length;
//
                    localsum = 0;
                    var total_sum = 0;
                    var total_sum2 = 0;
                    $(this).nextUntil('.group').each(function () {
//                             
                        T_ProductPrice = T_ProductPrice + parseFloat($(this).find(".sum_productprice").text());
//          T_ProductPrice =Math.round(T_ProductPrice)                          
                        T_Total = T_Total + parseFloat($(this).find(".sum_Total").text());
//T_Total = T_Total + parseInt($(this).find(".sum_Total").text());
//    T_Total =Math.round(T_Total)

                        if ($(this).find(".sum_nowlon").text() != "") {
                            T_nowlon = Math.round(T_nowlon + parseFloat($(this).find(".sum_nowlon").text()));
                            // T_nowlon=T_nowlon+parseInt($(this).find(".sum_nowlon").text());

                        }


                        if ($(this).find(".sum_discount").text() != "") {
//                               T_discount=T_discount+parseInt($(this).find(".sum_discount").text());
                            T_discount = T_discount + parseFloat($(this).find(".sum_discount").text());
                            T_discount = Math.round(T_discount)
                        }

                        T_carrying = T_carrying + parseFloat($(this).find(".sum_carrying").text());
                        T_carrying = Math.round(T_carrying)
                        // T_carrying=T_carrying+parseFloat($(this).find(".sum_carrying").text());

                        if ($(this).find(".sum_custody").text() != 0) {
//                                T_custody=T_custody+parseInt($(this).find(".sum_custody").text());
                            T_custody = parseFloat($(this).find(".sum_custody").text());
                            T_custody = Math.round(T_custody)
                            console.log(T_custody)
                        }
                        type = parseInt($(this).find(".type").text())

                        refNo = $(this).find(".Refno").text()
                        protype = $(this).find(".protype").text()

                        var final0 = 0;
                        var final1 = 0;
                        var final2 = 0;


                        total_sum = total_sum + parseFloat($(this).find(".sum_Total").text());
                        total_sum = Math.round(total_sum)
//                              total_sum2 = total_sum2 + parseInt($(this).find(".sumfinal").text());

                    });

//                            console.log(total_sum);
//                            console.log("####");
                    if ($(this).nextUntil('.group').next()) {
//                                 console.log($(this).nextUntil('.group2').last());
                        $(this).nextUntil('.group').last().after('<tr ><td style="display:none; background: #eff1f1;" id="test" colspan="3">' + "الاجمالى: " + total_sum + '</td> </tr>')

                        if (type == 0) {

                            var final0 = (T_Total + T_carrying).toFixed(0);
                            var final0 = (final0 - T_discount).toFixed(0);
//                                    var final0=(final0).toFixed(0);

//                                console.log(final0)      
                            $(this).nextUntil('.group').last().after('<tr  class="groupfooter" ><td>  العلامة: ' + refNo + '</td><td colspan="2">نوع البضاعة: ' + protype + '</td><td style="" id="test" colspan="2" >' + "الاجمالى: " + total_sum + '</td> <td colspan="0" class="Discount"> خصم:' + T_discount + '</td><td colspan="0" class="Carrying"> مشال' + T_carrying + '</td><td class="sumfinal" colspan="2">اجمالى الفاتورة :' + final0 + '</td></tr>')
                        }

                        else if (type == 1) {
                            final1 = T_Total + T_nowlon + T_custody + T_carrying;
                            final1 = (final1 - T_discount).toFixed(0);
//            var final1=(final1).toFixed(0);

                            $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>  العلامة: ' + refNo + '</td><td>نوع البضاعة: ' + protype + '</td><td style="" id="test" >' + "الاجمالى: " + total_sum + '</td> <td  class="Nowlon"> نولولن:' + T_nowlon + '</td><td  class="Carrying"> مشال' + T_carrying + '</td><td class="Custody"> عهدة:' + T_custody + '</td><td  class="Discount"> خصم:' + T_discount + '</td> <td colspan="2">اجمالى الفاتورة :' + final1 + '</td> </tr>')
                        }


                        else if (type == 2) {
                            final2 = T_Total + T_carrying + T_custody;
                            final2 = (final2 - T_discount).toFixed(0);
//                              var final2=(final2).toFixed(0);
                            $(this).nextUntil('.group').last().after('<tr style="background-color:#EDEDED; "class="groupfooter"> <td>  العلامة: ' + refNo + '</td><td>نوع البضاعة: ' + protype + '</td><td style="" colspan="2" >' + "الاجمالى: " + total_sum + '</td><td class="Custody"  > عهدة:' + T_custody + '</td><td class="Carrying"   > مشال :' + T_carrying + '</td><td class="Discount"> خصم:' + T_discount + '</td><td colspan="2">اجمالى الفاتورة :' + final2 + '</td></tr>')
                        }


                    }


                });


            } // end of combine
//===================== end of combine=====================================================    

            if (checkRadio == 1) {
                $(".hidecombine").css("display", "table-cell");

                //==============================just creazy  test start   ========================
                api.column(2, {page: 'current'}).data().each(function (group, i) {


                    if (last !== group) {

                        $(rows).eq(i).before(
                            '<tr class="group" style="display:none;"><td>' + group + '</td></tr>'
                        );

                        last = group;
                    }

                });

                $('#tbl-CustomersReport tbody').find('.group').each(function (i, v) {

                    //====difnition somr valiable mebay not used
                    var T_Weight = 0;
                    var T_Quantity = 0;
                    var T_ProductPrice = 0;
                    var T_Total = 0;


                    //definiton some variables here
                    var T_nowlon = 0;
                    var T_discount = 0;
                    var T_carrying = 0;
                    var T_custody = 0;
                    var type = $(this).find(".type").text();

                    var rowCount = $(this).nextUntil('.group').length;
//
                    var total_sum = 0;
                    var total_sum2 = 0;
                    $(this).nextUntil('.group').each(function () {
//                             
                        T_ProductPrice = T_ProductPrice + parseFloat($(this).find(".sum_productprice").text());
//          T_ProductPrice =Math.round(T_ProductPrice)                          
                        T_Total = T_Total + parseFloat($(this).find(".sum_Total").text());
// T_Total = T_Total + parseInt($(this).find(".sum_Total").text());
//    T_Total =Math.round(T_Total)

                        if ($(this).find(".sum_nowlon").text() != "") {
                            T_nowlon = T_nowlon + parseFloat($(this).find(".sum_nowlon").text());
//                                T_nowlon=T_nowlon+parseInt($(this).find(".sum_nowlon").text());
                        }


                        if ($(this).find(".sum_discount").text() != "") {
//                                T_discount=T_discount+parseInt($(this).find(".sum_discount").text());
                            T_discount = T_discount + parseFloat($(this).find(".sum_discount").text());
//                                     T_discount =Math.round(T_discount)
                        }


                        T_carrying += parseFloat($(this).find(".sum_carrying").text());
                        T_carrying = Math.round(T_carrying)
                        if ($(this).find(".sum_custody").text() !== 0) {
//                                 T_custody=T_custody+parseInt($(this).find(".sum_custody").text());
//                             T_custody = T_custody + parseFloat($(this).find(".sum_custody").text());
                            T_custody = parseFloat($(this).find(".sum_custody").text());
                            T_custody = Math.round(T_custody)
                            console.log(T_custody)

                        }

                        type = parseInt($(this).find(".type").text())

                        var final0 = 0;
                        var final1 = 0;
                        var final2 = 0;


                        total_sum = total_sum + parseFloat($(this).find(".sum_Total").text());
                        total_sum = Math.round(total_sum);
//                              total_sum2 = total_sum2 + parseInt($(this).find(".sumfinal").text());
                    });

//                            console.log(total_sum);
//                            console.log("####");
                    if ($(this).nextUntil('.group').next())
//                             {
//                                 console.log($(this).nextUntil('.group').last());
                        $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td colspan="6"> </td><td style="background: #eff1f1;" colspan="2">' + "الاجمالى: " + total_sum + '</td> <td colspan="0"></td></tr>')

                    if (type == 0) {
                        final0 = T_Total + T_carrying;
                        final0 = (final0 - T_discount).toFixed(0);

//                                            var final0=Math.round(final0)


                        $(this).nextUntil('.group').last().after('<tr  style="background-color:#FFFFAA;" class="groupfooter" ><td colspan="2"> الإجمالى</td><td colspan="2" class="Discount"> خصم:' + T_discount + '</td><td colspan="2" class="Carrying"> مشال' + T_carrying + '</td><td colspan="3">صافى البيع:' + final0 + '</td></tr>')
                    }

                    else if (type == 1) {
                        final1 = T_Total + T_nowlon + T_custody + T_carrying;
                        final1 = (final1 - T_discount).toFixed(0);
//                            var final1=Math.round(final1)
                        $(this).nextUntil('.group').last().after('<tr style="background-color:#FFFFAA; " class="groupfooter"><td> الإجمالى</td><td  class="Nowlon"> نولولن:' + T_nowlon + '</td><td colspan="2" class="Carrying"> مشال' + T_carrying + '</td><td class="Custody"> عهدة:' + T_custody + '</td><td  class="Discount"> خصم:' + T_discount + '</td><td colspan="3" class="optional">صافى البيع:' + final1 + '</td> </tr>')
                    }

                    else if (type == 2) {
                        final2 = T_Total + T_carrying + T_custody;
                        final2 = (final2 - T_discount).toFixed(0);
//                                            var final2=Math.round(final2)
                        $(this).nextUntil('.group').last().after('<tr  style="background-color:#FFFFAA; "class="groupfooter"><td> الإجمالى</td><td class="Discount"> خصم:' + T_discount + '</td><td class="Carrying" colspan="2"> مشال' + T_carrying + '</td><td class="Custody" colspan="3"> عهدة:' + T_custody + '</td><td colspan="2">صافى البيع:' + final2 + '</td></tr>')
                    }


                });

            }

        }
    });


    var tabl1 = $('#tbl-CustomersDeposit').DataTable({dom: 'T<"clear">lfrtip',});

    var tabl2 = $('#tbl-SupplierRefunds').DataTable({dom: 'T<"clear">lfrtip',});

    var tabl3 = $('#tbl-CustomersRefund').DataTable({dom: 'T<"clear">lfrtip',});

    var tabl4 = $('#tbl-CustomersDiscountss').DataTable({dom: 'T<"clear">lfrtip',});

    var tabl5 = $('#tbl-FinalCustomers').DataTable({dom: 'T<"clear">lfrtip',});


    $("#ToolTables_tbl-CustomersReport_4").on("click", function () {
        $("br").addClass("hide");


        $("#search-CustomersBills").addClass("hide");
        // $("#hiddenPrint").css("display","none");
        $("#ShowSONPrint").css("display", "block");
        $("#productshow").css("display", "block");
        $("#hiddenPrint").addClass("hide");

        // $("#SName").css("display","none");
        if (checkRadio == 1) {
            $("#rbtnComb").css("display", "none");
            $("#comname").css("display", "none");
        } else {
            $("#rbtnIsndividuale").css("display", "none");
            $("#inname").css("display", "none");
        }


        window.print();

    });
    $("#ToolTables_tbl-CustomersDeposit_4").on("click", function () {

        $("br").addClass("hide");
        $("#search-CustomersBills").addClass("hide");
        $("#hiddenPrint").css("display", "none");
        $("#ShowSONPrint").css("display", "block");
        $("#productshow").css("display", "block");
        $("#SName").css("display", "none");
        $("#hiddenPrint").addClass("hide");

//        if(checkRadio==1){$("#rbtnComb").css("display","none");$("#comname").css("display","none");
//         }else{
//        $("#rbtnIsndividuale").css("display","none");$("#inname").css("display","none");
//         }


        window.print();

    });
    $("#ToolTables_tbl-CustomersRefund_4").on("click", function () {
        $("br").addClass("hide");

        $("#search-CustomersBills").addClass("hide");
        $("#hiddenPrint").css("display", "none");
        $("#ShowSONPrint").css("display", "block");
        $("#productshow").css("display", "block");
        $("#SName").css("display", "none");
        $("#hiddenPrint").addClass("hide");
//        if(checkRadio==1){$("#rbtnComb").css("display","none");$("#comname").css("display","none");
//         }else{
//        $("#rbtnIsndividuale").css("display","none");$("#inname").css("display","none");
//         }
//                  


        window.print();

    });
    $("#ToolTables_tbl-CustomersDiscountss_4").on("click", function () {
        $("br").addClass("hide");

        $("#search-CustomersBills").addClass("hide");
        $("#hiddenPrint").css("display", "none");
        $("#ShowSONPrint").css("display", "block");
        $("#productshow").css("display", "block");
        $("#SName").css("display", "none");
        $("#hiddenPrint").addClass("hide");
//        if(checkRadio==1){$("#rbtnComb").css("display","none");$("#comname").css("display","none");
//         }else{
//        $("#rbtnIsndividuale").css("display","none");$("#inname").css("display","none");
//         }
//                  

        window.print();

    });

    $("#ToolTables_tbl-FinalCustomers_4").on("click", function () {

        $("br").addClass("hide");
        $("#search-CustomersBills").addClass("hide");
        $("#hiddenPrint").css("display", "none");
        $("#ShowSONPrint").css("display", "block");
        $("#productshow").css("display", "block");
        $("#SName").css("display", "none");
        $("#hiddenPrint").addClass("hide");
        // $("#hiddenPrint").addClass("hide");

//        if(checkRadio==1){$("#rbtnComb").css("display","none");$("#comname").css("display","none");
//         }else{
//        $("#rbtnIsndividuale").css("display","none");$("#inname").css("display","none");
//         }


        window.print();

    });


});

//===========printing================
//$(document).ready(function(){

//    $("ToolTables_tbl-CustomersReport_4").on("click",function(){
//        
//      window.Print();  
//    });
//    
//
//      $("#ToolTables_tbl-CustomersReport_4").on("click", function(){
//
//    
//      $("#search-CustomersBills").css("visibility","hidden");
//    
//     window.print();
//    
//    });


//}):


function Print() {
    $("br").addClass("hide");
    // alert("aaa");
    $("#search-CustomersBills").addClass("hide");
    $(".DTTT").addClass("hide");
//    $("#tbl-SupplierReport_filter").addClass("hide");
    $(".dataTables_length").addClass("hide");
    $(".dataTables_filter").addClass("hide");
    $(".pagination").addClass("hide");
    $(".panel-heading").addClass("hide");
    // $(".box-header").addClass("hide");
    $(".content-header").addClass("hide");
    $(".main-header").addClass("hide");
    $(".sidebar-menu").addClass("hide");
    $("#dataTables_filter").addClass("hide");
    $("#SName").css("display", "blcok");
    $("#hiddenPrint").addClass("hide");

//    $("#SName").css("display","none");

    $("#ShowSONPrint").css("display", "block");
    $("#productshow").css("display", "block");

    if (checkRadio == 1) {
        $("#rbtnComb").css("display", "none");
        $("#comname").css("display", "none");
    } else {
        $("#rbtnIsndividuale").css("display", "none");
        $("#inname").css("display", "none");
    }
    window.print();
}


$(document).keyup(function (e) {
    if (e.keyCode == 27) {
        $("br").removeClass("hide");
        $("#search-CustomersBills").css("visibility", "visible");
        $("#search-CustomersBills").removeClass("hide");
        $(".DTTT").removeClass("hide");
//        $("#tbl-SupplierReport_filter").removeClass("hide");
        $(".dataTables_length").removeClass("hide");
        $(".dataTables_filter").removeClass("hide");
        $(".pagination").removeClass("hide");
        $(".panel-heading").removeClass("hide");
        // $(".box-header").removeClass("hide");
        $(".content-header").removeClass("hide");
        $(".main-header").removeClass("hide");
        $(".sidebar-menu").removeClass("hide");
        $("#hideinotherprinttable").removeClass("hide");
        $("#dataTables_filter").removeClass("hide");
        $("#hiddenPrint").css("display", "block");
        $("#ShowSONPrint").css("display", "none");
        $("#productshow").css("display", "none");

        if (checkRadio == 1) {
            $("#rbtnComb").css("display", "inline");
            $("#comname").css("display", "inline");
        } else {
            $("#rbtnIsndividuale").css("display", "inline");
            $("#inname").css("display", "inline");
        }


    }
});

/* function to get totatls of Tables */


cuatomersbills.prototype.CheckTotal = function () {

    var Deposit = [0, 0, 0];

    var $dataRows = $("#tbl-CustomersDeposit tr");

    $dataRows.each(function () {
        $(this).find('.sum').each(function (i) {
            Deposit[i] += parseInt($(this).html());
        });
    });
    console.log("Deposit Total");
    console.log(Deposit);
    $("#tbl-CustomersDeposit th.total").each(function (i) {
        $('.total').html("اجمالى المبلغ :" + Deposit[i]);


    });
    //console.log($dataRows)
    // alert("1");
}


//supplier refund
cuatomersbills.prototype.CheckTotal3 = function () {

    var Crefund = [0, 0, 0];

    var $dataRows = $("#tbl-CustomersRefund tr");

    $dataRows.each(function () {
        $(this).find('.sum').each(function (i) {
            Crefund[i] += parseInt($(this).html());
        });
    });
    console.log("Crefund Total");
    console.log(Crefund);
    $("#tbl-CustomersRefund th.total3").each(function (i) {
        $('.total3').html("اجمالى المبلغ :" + Crefund[i]);


    });
    //console.log($dataRows)
// alert("3");
}

cuatomersbills.prototype.CheckTotal2 = function () {

    var Cdiscount = [0, 0, 0];

    var $dataRows = $("#tbl-CustomersDiscountss tr");

    $dataRows.each(function () {
        $(this).find('.sum').each(function (i) {
            Cdiscount[i] += parseInt($(this).html());
        });
    });
    console.log("Cdiscount Total");
    console.log(Cdiscount);
    $("#tbl-CustomersDiscountss th.total2").each(function (i) {
        $('.total2').html("اجمالى المبلغ :" + Cdiscount[i]);


    });
    //console.log($dataRows)
// alert("2");
}


/* Some Eggs*/

$(document).ready(function () {
    $(':input').change(function () {
//   alert("ayyy")
        $("#search-CustomersBills").prop("disabled", false);
    });
});
    




