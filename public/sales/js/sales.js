function autocompe() {
    this.supplier = function() {
        $("#SupplierID").select2({
            placeholder: "Search for an Supplier Name",
            ajax: {
                url: "supplierautocomplete",
                headers: {
                    "X-CSRF-Token": $("meta[name=_token]").attr("content")
                },
                type: "post",
                data: function(a) {
                    var b = {
                        SupplierName: a.term
                    };
                    return b
                },
                processResults: function(a) {
                    return a.status ? {
                            results: $.map(a.data, function(a) {
                                return {
                                    text: a.SupplierName,
                                    id: a.SupplierID,
                                    comm: a.SupplierCommision,
                                    suptype: a.SupplierType
                                }
                            })
                        } : {
                            results: $.map(a.data, function(a) {
                                return {
                                    text: a.message,
                                    id: a.id
                                }
                            })
                        }
                }
            }
        })
    }, this.Customer = function() {
        $("#CustomerID").select2({
            placeholder: "Search for an Customer Name",
            ajax: {
                url: "autocompleteCustomer",
                headers: {
                    "X-CSRF-Token": $("meta[name=_token]").attr("content")
                },
                type: "post",
                data: function(a) {
                    var b = {
                        CustomerName: a.term
                    };
                    return b
                },
                processResults: function(a) {
                    return a.status ? {
                            results: $.map(a.data, function(a) {
                                return {
                                    text: a.CustomerName,
                                    id: a.CustomerID,
                                    CustType: a.CustomerType
                                }
                            })
                        } : {
                            results: $.map(a.data, function(a) {
                                return {
                                    text: a.message,
                                    id: a.id
                                }
                            })
                        }
                }
            }
        })
    }, this.Product = function() {
        $("#ProductID ,[name=up_ProductID] ").select2({
            placeholder: "اسم المنتج ",
            ajax: {
                url: "productautocomplete",
                headers: {
                    "X-CSRF-Token": $("meta[name=_token]").attr("content")
                },
                type: "post",
                data: function(a) {
                    var b = {
                        ProductName: a.term
                    };
                    return b
                },
                processResults: function(a) {
                    return a.status ? {
                            results: $.map(a.data, function(a) {
                                return {
                                    text: a.ProductName,
                                    id: a.ProductID,
                                    type: a.ProductType,
                                    carrying: a.ProductType < 1 ? $("#ProductID").data("local") : $("#ProductID").data("imported")
                                }
                            })
                        } : {
                            results: $.map(a.data, function(a) {
                                return {
                                    text: a.message,
                                    id: a.id
                                }
                            })
                        }
                }
            }
        })
    }, this.Driver = function() {
        $("#DriverID").select2({
            placeholder: "Search for an Driver Name",
            ajax: {
                url: "driverautocomplete",
                headers: {
                    "X-CSRF-Token": $("meta[name=_token]").attr("content")
                },
                type: "post",
                data: function(a) {
                    var b = {
                        DriverName: a.term
                    };
                    return b
                },
                processResults: function(a) {
                    return a.status ? {
                            results: $.map(a.data, function(a) {
                                return {
                                    text: a.DriverName,
                                    id: a.DriverID
                                }
                            })
                        } : {
                            results: $.map(a.data, function(a) {
                                return {
                                    text: a.message,
                                    id: a.id
                                }
                            })
                        }
                }
            }
        })
    }
}

function getCustomerType(a) {
    var b = $("#CustomerID").clone();
    return console.log($(a).val(a)), $("option:selected", b).text()
}

function setNolon(a) {
    Nawlon2 = a
}

function setcustdy(a) {
    Custdy2 = a
}

function setcustomer(a) {
    customer = a
}

function setdiscount(a) {
    discount = a
}

function settoftotaldiscount(a) {
    toftotal = a
}

function setcarrying(a) {
    carry = a
}

function salseid(a) {
    salesid = a, console.log(salesid)
}

function setcarrying(a) {
    carrying = a, console.log(carrying)
}

function myFunction(a) {
    27 == a.keyCode && ($("#ft").removeAttr("colspan"), $(".onprint").removeClass("OnPrint"), $("#noteprint").removeClass("margin"), $("#editbill").removeClass("hide"), $("#billpic").addClass("hide"), $(".footer").addClass("hide"), $("#suppliers").removeClass("hide"), $(".suppliers-info").removeClass("hide"), $("#decr-sup").removeClass("hide"), $(".rmv_sup").removeClass("hide"), $(".foot2").removeClass("hide"), $("#sieral").attr("colspan", 1), $(".tdserial2").attr("colspan", 1), $(".colfot2").attr("colspan", 1), $(".colfot3").attr("colspan", 2), $(".font").css({
        "font-size": "13px",
        "font-weihgt": "bold"
    }), $(".font2").css({
        "font-size": "18px",
        "font-weihgt": "bold"
    }), $("#preamble").hide(), $("#headprint").css("height", "35px"), $(".colfot2").css({
        width: "",
        "white-space": ""
    }), $("#design_print").addClass("hide"))
}

function myFunction2(a) {
    27 == a.keyCode && ($("#ft").removeAttr("colspan"), $(".onprint").removeClass("OnPrint"), $("#noteprint").removeClass("margin"), $("#editbill").removeClass("hide"), $("#billpic").addClass("hide"), $(".footer").addClass("hide"), $("#decr-sup").removeClass("hide"), $(".rmv_sup").removeClass("hide"), $(".foot2").removeClass("hide"), $("#sieral").attr("colspan", 1), $(".tdserial2").attr("colspan", 1), $(".colfot2").attr("colspan", 1), $(".colfot3").attr("colspan", 2), $(".font").css({
        "font-size": "13px",
        "font-weihgt": "bold"
    }), $(".font2").css({
        "font-size": "18px",
        "font-weihgt": "bold"
    }), $("#preamble").hide(), $("#headprint").css("height", "35px"), $(".colfot2").css({
        width: "",
        "white-space": ""
    }), $("#design_print").addClass("hide"))
}
_globalvars = {
    Customer: {
        checkcustomerexist: function() {
            return $("[name=CustomerID]").find("option:selected").length
        },
        GetCustomerType: function() {
            var a = $("[name=CustomerID] :selected");
            return !(a.length < 1) && a.data("data").CustType
        }
    },
    Supplier: {
        GetSupplierID: function() {
            return $("[name=SupplierID] :selected").val()
        },
        GetSupplierType: function() {
            return $("[name=SupplierID] :selected").data("data").suptype
        }
    }
}, _prototype = {
    type: {
        protype: function() {
            return $("[name=ProductID]").find("option:selected").length
        },
        Getprouducttype: function() {
            var a = $("[name=ProductID] :selected");
            return !(a.length < 1) && a.data("data").type
        }
    }
};
var sales = function() {
    var a = new autocompe;
    a.supplier(), a.Customer(), a.Product(), a.Driver()
};
sales.prototype.IntializeContainerAutocomplete = function() {
    function a(a) {

        if (a.loading) return "No Result";
        var b = '<div class="clearfix"><div class="col-md-6"><label class="form-control btn-info">LN : ' + a.lnum + '</label></div><div class="col-md-6"><label class="form-control btn-primary">IN : ' + a.intnum + "</label></div></div>";
        return b
    }

    function b(a) {
        return a.lnum || a.text
    }
    $("[name=ContainerID]").select2({
        dropdownCssClass: "widedrop",
        ajax: {
            url: "suppliercontainer",
            headers: {
                "X-CSRF-Token": $("meta[name=_token]").attr("content")
            },
            type: "post",
            dataType: "json",
            delay: 250,
            data: function(a) {
                var b = {
                    SupplierID: $("[name=SupplierID]").val(),
                    LocalNum: a.term
                };
                return b
            },
            processResults: function(a, b) {
                return $("[name=ContainerID] option").not("[value=0]").remove(), $("[name=ContainerID]").val(0).trigger("change"), a.status ? {
                        results: $.map(a.data, function(a) {
                            return {
                                lnum: a.ContainerLocalNum,
                                intnum: a.ContainerIntNum,
                                id: a.ContainerID
                            }
                        })
                    } : {
                        results: {
                            lnum: "No Data",
                            intnum: "No Data",
                            id: "0"
                        }
                    }
            },
            cache: !0
        },
        escapeMarkup: function(a) {
            return a
        },
        templateResult: a,
        templateSelection: b
    })
}, sales.prototype.GetComission = function() {
    $("[name=Commision]").val($("[name=SupplierID] :selected").data("data").comm)
}, sales.prototype.SetSuccess = function(a, b) {
    b ? $("#" + a).attr("class", "form-control btn-success") : $("#" + a).attr("class", "form-control btn-danger")
}, sales.prototype.ShowNotfication = function(a, b) {
    var c = $("#error-box");
    $("#error-box").is(":visible") && c.slideUp(), b ? (c.removeClass("alert-danger"), c.addClass("alert-success")) : (c.removeClass("alert-success"), c.addClass("alert-danger")), c.find("p").html(a), c.slideDown(), timeOut = window.setTimeout(function() {
        c.slideUp()
    }, 1e4)
}, sales.prototype.GetTotal = function() {
    var b = ($("[name=WeightType]:checked").val(), $("[name=Weight]").val()),
        c = $("[name=ProductPrice]").val(),
        d = $("[name=Quantity]").val(),
        f = null;
    total1 = b * d, f = total1 * c, console.log(f), $("[name=Total]").text(f.toFixed())
}, sales.prototype.ChangeCustomerStatus = function(a) {
    _globalvars.Customer.GetCustomerType() < 1 ? $("#tr_masterextra").attr("class", "hidden_a4p") : _globalvars.Customer.GetCustomerType() < 2 ? (console.log(_globalvars.Customer.GetCustomerType()), $(".southegypt").hide(), $(".agency").show(), $("#tr_masterextra").removeAttr("class")) : ($(".southegypt").show(), $(".agency").hide(), $("#tr_masterextra").removeAttr("class"))
}, sales.prototype.SubmitSales = function() {
    $.ajax({
        url: $("#frmsales").attr("action"),
        headers: {
            "X-CSRF-Token": $("meta[name=_token]").attr("content")
        },
        type: "post",
        data: $("#frmsales").serialize() + "&CType=" + $("[name=CustomerID] :selected").data("data").CustType,
        dataType: "json"
    }).done(function(a) {
        if (a.status) _sales.ShowNotfication(a.message, !0), _sales.GetBills();
        else {
            var b = "";
            $.each(a.message, function(a, c) {
                b += "* " + c + "</b><br />"
            }), _sales.ShowNotfication(b, !1)
        }
    }).error(function(a) {
        alert("Connection Error")
    })
}, sales.prototype.validateform = function(a) {
    var b = $("[name=SupplierID]").val(),
        c = $("[name=CustomerID]").val(),
        d = $("[name=ProductID]").val(),
        f = ($("[name=Weight]").val(), $("[name=ProductPrice]").val()),
        i = ($("[name=RefNo]").val(), _prototype.type.Getprouducttype(), []);
    switch (b < 1 ? (this.SetSuccess("lblsupplier", !1), i.push("من فضلك اختار فلاح (مورد )")) : this.SetSuccess("lblsupplier", !0), c < 1 ? (this.SetSuccess("lblcustomer", !1), i.push("من فضلك اختار منتج ")) : this.SetSuccess("lblcustomer", !0), d < 1 ? (this.SetSuccess("lblpruodctname", !1), i.push("من فضلك اختار منتج")) : this.SetSuccess("lblpruodctname", !0), a) {
        case "0":
            "undefined" == typeof f ? (this.SetSuccess("lblproductprice", !1), i.push("Product Price Must Numeric")) : this.SetSuccess("lblproductprice", !0)
    }
    return i
}, sales.prototype.GetSalesDetails = function(CustID, SDate) {
    var RefNo = $("[name=RefNo]").val(),
        supplier = $("[name=SupplierID]").val();
    $.ajax({
        url: "salesdetailscustomer",
        headers: {
            "X-CSRF-Token": $("meta[name=_token]").attr("content")
        },
        type: "post",
        dataType: "json",
        cache: !0,
        data: "CustomerID=" + CustID + "&SalesDate=" + SDate + "&RefNo=" + RefNo
    }).done(function(output) {
        if (console.log(output), output.status) {
            $("#tbl-salesdetails").find("tbody").html("");
            var toftotal = 0,
                toweight = 0,
                toqnt = 0,
                carrying = 0,
                discount = 0,
                Nowlon = 0,
                Custody = 0,
                DriverName = 0,
                salesid = 0,
                finaltotalWight = 0,
                TotalWight = 0;
            $.each(output.data.SalesDetails, function(a) {
                salesid = parseInt(output.data.SalesDetails[a].SalesID), toftotal += output.data.SalesDetails[a].Total, toftotal = Math.round(toftotal), toqnt += parseFloat(output.data.SalesDetails[a].Quantity), carrying += Math.round(parseFloat(output.data.SalesDetails[a].Carrying)), toweight += parseFloat(output.data.SalesDetails[a].Weight), "0" == output.data.SalesDetails[a].ProductPrice ? zeroproduct = "alert-danger" : zeroproduct = "", "0" == output.data.SalesDetails[a].ProductPrice ? zeroweight = "alert-danger" : zeroweight = "", TotalWight = parseFloat(output.data.SalesDetails[a].Weight) * parseFloat(output.data.SalesDetails[a].Quantity), finaltotalWight += TotalWight, console.log(finaltotalWight), $("#tbl-salesdetails").find("tbody").last().append('<tr><td class="tdwidth2word"><label data-val="' + output.data.SalesDetails[a].Serial + '" class="form-control btn-info editsales" >' + (parseInt(a) + 1) + '</label></td><td ><label class="form-control" > ' + output.data.SalesDetails[a].product.ProductName + ' </label></td><td class=""><label class="form-control ' + zeroweight + '" > ' + output.data.SalesDetails[a].Weight + ' </label></td><td class="tdwidth"><label class="form-control " > ' + output.data.SalesDetails[a].Quantity + ' </label></td><td class="tdwidth2word"><label  class="tfw form-control " > ' + TotalWight + ' </label></td><td class="tdwidth2word"><label class="form-control ' + zeroproduct + '" > ' + output.data.SalesDetails[a].ProductPrice + ' </label></td><td class="tdserial2"><label class="form-control" > ' + Math.round(output.data.SalesDetails[a].Total) + ' </label></td><td class="rmv_sup"><label class="form-control suppliers-info" > ' + output.data.SalesDetails[a].supplier.SupplierName + " </label></td></tr>")
            }), discountShow = output.data.Discount, setdiscount(discountShow), totalcarrying = output.data.Carrying, totalacarrying = toftotal + carrying, totalacarrying = Math.round(totalacarrying), Custdy = output.data.Custody, setcustdy(Custdy), sumcustdy = Custdy, Nowlon = output.data.Nowlon, setNolon(Nowlon), sumnolon = Nowlon, settoftotaldiscount(toftotal), sumtotal = toftotal, setcarrying(carrying), sumcary = carrying, $.ajax({
                url: "Customer",
                headers: {
                    "X-CSRF-Token": $("meta[name=_token]").attr("content")
                },
                type: "post",
                dataType: "json",
                cache: !0,
                data: "CustomerID=" + CustID + "&SalesDate=" + SDate + "&RefNo=" + RefNo
            }).done(function(output) {
                var obj = eval(output);
                setNolon(Nowlon), setcustdy(Custdy), setdiscount(discountShow);
                var CustomerType = obj[0].CustomerType;
                setcustomer(CustomerType), cusotmer = CustomerType, 1 == CustomerType ? $("#custody").text("(" + Custdy + ")") : 2 == CustomerType ? $("#custody").text("(" + Custdy + ")") : 0 == CustomerType && $("#custody").text(""), 1 == CustomerType ? $("#Nowlon").text("(" + Nowlon + ")") : 2 == CustomerType ? $("#Nowlon").text("") : 0 == CustomerType && $("#Nowlon").text(""), finaltotal = sumtotal + sumnolon + sumcustdy + sumcary, final = finaltotal - discountShow, final = Math.round(final), 0 == CustomerType ? $("#finaltotal").text("(" + final + ")") : 1 == CustomerType ? $("#finaltotal").text("(" + final + ")") : 2 == CustomerType && $("#finaltotal").text("(" + final + ")")
            }).error(function(a) {
                showError("", a)
            }), $.ajax({
                url: "getDrivers",
                headers: {
                    "X-CSRF-Token": $("meta[name=_token]").attr("content")
                },
                type: "post",
                dataType: "json",
                cache: !0,
                data: "CustomerID=" + CustID + "&SalesDate=" + SDate + "&RefNo=" + RefNo
            }).done(function(output) {
                var obj = eval(output),
                    driver = obj[0].DriverName;
                1 == cusotmer ? $("#drivers").text("(" + driver + ")") : $("#drivers").text("")
            }).error(function(a) {
                showError("", a)
            }), $("#totalprice").text(toftotal), $("#totalcarrying").text("(" + carrying + ")"), $("#totalweight").text("(" + toweight + ")"), $("#totalqnt").text("(" + toqnt + ")"), $("#Discount").text("(" + totalacarrying + ")"), $("#discountShow").text("(" + discountShow + ")"), $("#billnumber").text("(" + salesid + ")"), salseid(salesid), $("#billsNumberinPRint").text("(" + salesid + ")"), $("#editbill").attr("href", "sales/bill/edit/" + output.data.SalesID), $("[name=Discount]").val(output.data.Discount), $("[name=RefNo]").val(output.data.RefNo), $("[name=Custody]").val(output.data.Custody), $("[name=Nowlon]").val(output.data.Nowlon), $("[name=DriverID]").val(output.data.DriverID).trigger("chosen:updated"), $("#UpdateMSales").attr("data-val", output.data.SalesID), $("#totalwight").text(finaltotalWight)
        } else $("#tbl-salesdetails").find("tbody").html(""), $("#totalprice").text("0"), $("#totalcarrying").text(""), $("#totalweight").text(""), $("#totalqnt").text(""), $("#Discount").text(""), $("#Nowlon").text(""), $("#custody").text(""), $("#drivers").text(""), $("#editbill").attr("href", "javascript:void(0)"), $("#UpdateMSales").removeAttr("data-val"), salseid(""), $("#totalwight").text("0"), $("#billsNumberinPRint").text("0")
    }).error(function(a) {
        showError("", a)
    })
}, Nawlon2 = 0, Custdy2 = 0, customer = 0, discount = 0, toftotal = 0, carry = 0, salesid = 0, carrying = 0, sales.prototype.GetBills = function() {
    var a = $("[name=CustomerID]").val(),
        b = $("[name=SalesDate]").val();
    if (a > 0 && 10 == b.length) {
        _sales.GetSalesDetails(a, b);
        var c = $("option:selected", "[name=CustomerID]").text(),
            d = $("[name=SalesDate]").val();
        $("#tbl-salesdetails").prev().find(".right_note").text("الفاتورة الخاصة بالتاجر : " + c + " في يوم :  " + d)
    } else $("#tbl-salesdetails").find("tbody").html(""), $("#totalprice").text("0"), $("#totalcarrying").text(""), $("#totalweight").text(""), $("#totalqnt").text(""), $("#editbill").attr("href", "javascript:void(0)"), $("#UpdateMSales").removeAttr("data-val"), $("#tbl-salesdetails").prev().find(".right_note").text("لا يوجد فواتير لهذا التاجر"), $("#carr").text("")
}, sales.prototype.ClearFields = function() {
    $("#frmsales").find("input").not("[name=WeightType] ,[name=RefNo] ,[name=Discount] , #UpdateMSales").val(""), $("#frmsales").find("select").val("0").trigger("chosenhe:updated"), $("[name=Total]").text("0")
}, sales.prototype.UpdateMaster = function(a) {
    $.ajax({
        url: "sales/master/" + a + "/edit",
        type: "post",
        headers: {
            "X-CSRF-Token": $("meta[name=_token]").attr("content")
        },
        data: $("#tbl_master").find("select , input").serialize(),
        dataType: "json"
    }).done(function(a) {
        if (a.status) console.log(a.status), _sales.GetBills(), _sales.ShowNotfication(a.message, !0);
        else {
            var b = "";
            $.each(a.message, function(a, c) {
                b += "* " + c + "</b><br />"
            }), _sales.ShowNotfication(b, !1)
        }
    }).error(function() {
        _sales.ShowNotfication("Error Respone From Server, Try To reload Page", !1)
    })
}, $(function() {
    _sales = new sales;
    var a = $("[name=WeightType]:checked").val();
    a > 0 && ($("[name=Weight]").val("1").addClass("hidden"), _sales.SetSuccess("lblweight", !0)), $("[name=CustomerID]").val("0").trigger("chosen:updated"), _sales.ClearFields(), _sales.GetBills(), _sales.IntializeContainerAutocomplete()
}), $(document).ready(function() {
    $("#noteprint").removeClass("margin"), $(".onprint").removeClass("OnPrint"), $("[name=CustomerID]").on("change", function() {
        $("[name=CustomerID]").val() > 0 ? _sales.SetSuccess("lblcustomer", !0) : _sales.SetSuccess("lblcustomer", !1), _sales.ChangeCustomerStatus($(this))

    }), $("[name=SupplierID]").on("change", function() {
        $("[name=ContainerID]").val(0).trigger("change"),
            1 == parseInt($("option:selected", $(this)).data("data").suptype) ? $(".Containertd").removeClass("hide") : $(".Containertd").hasClass("hide") || $(".Containertd").addClass("hide"),

            _sales.GetComission(), $(this).val() > 0 ? _sales.SetSuccess("lblsupplier", !0) : _sales.SetSuccess("lblsupplier", !1)

    }), $("#datepicker").change(function() {
        10 == $("#datepicker").val().length ? _sales.SetSuccess("lbldate", !0) : _sales.SetSuccess("lbldate", !1)
    }), $("[name=Commision]").on("change focusout", function() {
        $(this).length > 1 || $(this).val() > 0 ? _sales.SetSuccess("lblcommission", !0) : _sales.SetSuccess("lblcommission", !1)
    }), $("[name=ProductID]").on("change", function() {
        $(this).val() > 0 ? _sales.SetSuccess("lblpruodctname", !0) : _sales.SetSuccess("lblpruodctname", !1);
        var a = $("option:selected", $(this)).data("data").carrying;
        console.log("carrying " + a), "undefined" == typeof a ? $("[name=Carrying]").closest("td").prev().find("span").text("") : ($("[name=Carrying]").closest("td").prev().find("span").text("(" + a + ")"), $("[name=Carrying]").val((a * $("[name=Quantity]").val()).toFixed(2)))
    }), $("[name=Save]").on("click", function() {


        var a = $("#carr").val();
        setcarrying(a)
    }), $("[name=Weight] , [name=ProductPrice] , [name=Quantity] ").keyup(function() {
        var a;
        switch ($(this).attr("name")) {
            case "Quantity":
                if (a = "lblqnt", $(this).val() > 0) {
                    var b = $("[name=ProductID] option:selected").data("data").carrying;
                    $("[name=Carrying]").val((b * $("[name=Quantity]").val()).toFixed(2))
                }
        }
        $(this).val() > 0 ? _sales.SetSuccess(a, !0) : _sales.SetSuccess(a, !1), _sales.GetTotal()
    }), $("[name=save]").click(function() {
        alert("Here1")
        $(".must").each(function() {
            var a = $(this).closest("td").children()[0];
            if ($(a).hasClass("only_float") || $(a).hasClass("only_num")) {
                var b = _globalvars.Customer.GetCustomerType(),
                    c = $(this).attr("name");
                if (0 != $(a).val() && $(a).val()) switch (c) {
                    case "Weight":
                        _sales.SetSuccess("lblweight", !0);
                        break;
                    case "Quantity":
                        break;
                    case "ProductPrice":
                        _sales.SetSuccess("lblproductprice", !0)
                } else switch (c) {
                    case "Weight":
                        _sales.SetSuccess("lblweight", !1);
                        break;
                    case "Quantity":
                        break;
                    case "ProductPrice":
                        0 == b || "" == $(a).val() ? _sales.SetSuccess("lblproductprice", !1) : _sales.SetSuccess("lblproductprice", !0)
                }
            } else if ($(a).attr("id").indexOf("cbo") > -1) {
                var d = $(this).closest("td").index(),
                    e = $(this).closest("tr").prev(),
                    f = $("td:eq( " + d + ")", e).children().attr("id");
                0 != $(a).val() && $(a).val() ? _sales.SetSuccess(f, !0) : _sales.SetSuccess(f, !1)
            } else {
                var d = $(this).closest("td").index(),
                    e = $(this).closest("tr").prev(),
                    a = $("td:eq( " + d + ")", e).children().attr("id");
                0 != $(a).val().length && $(a).val() ? _sales.SetSuccess(a, !0) : _sales.SetSuccess(a, !1)
            }
        })
    }), $("[name=save]").click(function() {
        alert("Here2")
        $(".must").each(function() {
            var a = $(this).closest("td").children()[0];
            if ($(a).hasClass("only_float") || $(a).hasClass("only_num")) {
                var b = _globalvars.Customer.GetCustomerType(),
                    c = $(this).attr("name");
                if (0 != $(a).val() && $(a).val()) switch (c) {
                    case "Weight":
                        _sales.SetSuccess("lblweight", !0);
                        break;
                    case "Quantity":
                        break;
                    case "ProductPrice":
                        _sales.SetSuccess("lblproductprice", !0)
                } else switch (c) {
                    case "Weight":
                        _sales.SetSuccess("lblweight", !1);
                        break;
                    case "Quantity":
                        break;
                    case "ProductPrice":
                        0 == b || "" == $(a).val() ? _sales.SetSuccess("lblproductprice", !1) : _sales.SetSuccess("lblproductprice", !0)
                }
            } else if ($(a).attr("id").indexOf("cbo") > -1) {
                var d = $(this).closest("td").index(),
                    e = $(this).closest("tr").prev(),
                    f = $("td:eq( " + d + ")", e).children().attr("id");
                0 != $(a).val() && $(a).val() ? _sales.SetSuccess(f, !0) : _sales.SetSuccess(f, !1)
            } else {
                var d = $(this).closest("td").index(),
                    e = $(this).closest("tr").prev(),
                    a = $("td:eq( " + d + ")", e).children().attr("id");
                0 != $(a).val().length && $(a).val() ? _sales.SetSuccess(a, !0) : _sales.SetSuccess(a, !1)
            }
        })
    }), $("[name=Weight],[name=Quantity],[name=ProductPrice] ,[name=Save],[name=Commision] ,[name=Carrying] ,[name=RefNo] ,[name=Discount],[name=SalesDate").keypress(function(a) {
        13 == a.keyCode && a.preventDefault()
    }), $("[name=Save]").click(function() {

        var container = $(".Containertd").is(":visible");
        console.log(container);
        if(container == true){
            var ContainerValue = $('[name=ContainerID]').val();
            console.log(ContainerValue);
            if(ContainerValue == 0 ){
                alert("من فضلك اختار حاويه ");
                return ;
            }else{}
        }
        // else if(container ==  flase){
        //
        //
        // }


        if (errors = [], _globalvars.Customer.checkcustomerexist() ? errors = _sales.validateform($("[name=CustomerID] :selected").data("data").CustType) : errors.push("من فضلك اختار تاجر "), errors.length > 0) {
            var a = "";
            $.each(errors, function(b) {
                a += errors[b] + "\n"
            }), alert(a)


        } else {
            _sales.SubmitSales();
            document.getElementById("txt_Weight").value = "", document.getElementById("txt_Quantity").value = "", document.getElementById("txt_Price").value = "", document.getElementById("total").innerHTML = "";
            $("#ProductID").select2("val", ""), $("[name=Discount]").text(""), $("#billnumber").val(""), $("[name=Carrying]").val("0"), $("[name=Carrying]").text("0")
        }
    }), $("[name=CustomerID],[name=SalesDate]").change(function() {
        _sales.GetBills()
    }), $("[name=WeightType]").change(function() {
        $(this).val() > 0 ? ($("[name=Weight]").val("1").addClass("hidden"), _sales.SetSuccess("lblweight", !0)) : $("[name=Weight]").removeClass("hidden"), _sales.GetTotal()
    }), $("#UpdateMSales").click(function() {
        _sales.UpdateMaster($(this).attr("data-val"))
    }), $("[name=RefNo]").keyup(function() {
        _sales.GetBills()
    })
}), $("#preamble").hide(), $("#design_print").addClass("hide"), $("#ptn2").click(function() {
    $(".onprint").addClass("OnPrint"), $("#editbill").addClass("hide"), $("#billpic").removeClass("hide"), $(".footer").removeClass("hide"), $("#suppliers").addClass("hide"), $(".suppliers-info").addClass("hide"), $("#decr-sup").addClass("hide"), $(".rmv_sup").addClass("hide"), $(".foot2").addClass("hide"), $("#sieral").attr("colspan", 2), $(".tdserial2").attr("colspan", 2), $(".colfot2").attr("colspan", 2), $(".colfot3").attr("colspan", 4), $("#preamble").show(), $(".font").css({
        "font-size": "12px",
        "font-weihgt": "bold"
    }), $(".font2").css({
        "font-size": "12px",
        "font-weihgt": "bold"
    }), $("#noteprint").addClass("margin"), window.print()
}), $("#ptn3").click(function() {
    $(".onprint").addClass("OnPrint"), $("#editbill").addClass("hide"), $("#billpic").removeClass("hide"), $(".footer").removeClass("hide"), $("#ft").attr("colspan", 2), $(".foot2").addClass("hide"), $("#sieral").attr("colspan", 2), $(".tdserial2").attr("colspan", 2), $(".colfot2").attr("colspan", 2), $(".colfot3").attr("colspan", 4), $("#preamble").show(), $(".font").css({
        "font-size": "12px",
        "font-weihgt": "bold"
    }), $(".font2").css({
        "font-size": "12px",
        "font-weihgt": "bold"
    }), $("#noteprint").addClass("margin"), window.print()
}), $("#ProductID").change(function() {
    document.getElementById("txt_Weight").value = "", document.getElementById("txt_Quantity").value = "", document.getElementById("txt_Price").value = "", document.getElementById("total").innerHTML = ""
}), $("#RefernceNo").keypress(function() {
    document.getElementById("billnumber").innerHTML = ""
}), $("#CustomerID").change(function() {
    document.getElementById("billnumber").innerHTML = "";
    $("#RefernceNo").val("1")
}), $("#datepicker").change(function() {
    document.getElementById("billnumber").innerHTML = ""
}), $(".refresh").change(function() {
    $(".claerinput").val(""), $("#discountShow").text(""), $("#finaltotal").text(""), $("#carrying").val(""), $("#ProductID").val("");
    document.getElementById("txt_Weight").value = "", document.getElementById("txt_Quantity").value = "", document.getElementById("txt_Price").value = "", document.getElementById("total").innerHTML = ""
}), $(".refresh").on("keypress", function() {
    $(".claerinput").val(""), $("#discountShow").text(""), $("#finaltotal").text(""), $("#carrying").val(""), $("#ProductID").val("");
    document.getElementById("txt_Weight").value = "", document.getElementById("txt_Quantity").value = "", document.getElementById("txt_Price").value = "", document.getElementById("total").innerHTML = "", document.getElementById("ProductID").value = ""
}), $(".change").keyup(function() {
    console.log(salesid), "" != salesid ? ($(".closed").prop("disabled", !0), $("#closed").addClass("hide"), $("#shhowalert").css("display", "block"), $("#shhowalert").prop("disabled", "true")) : 0 == salesid && ($(".closed").prop("disabled", !1), $("#closed").removeClass("hide"), $("#shhowalert").css("display", "none"))
}), $("#UpdateMSales").click(function() {
    $(".closed").prop("disabled", !1), $("#closed").removeClass("hide"), $("#shhowalert").css("display", "none")
}), $("#RefernceNo").keyup(function() {
    $(".closed").prop("disabled", !1), $("#closed").removeClass("hide"), $("#shhowalert").css("display", "none")
}), $("#CustomerID").change(function() {
    $(".closed").prop("disabled", !1), $("#closed").removeClass("hide"), $("#shhowalert").css("display", "none")
}), $("#datepicker").change(function() {
    $(".closed").prop("disabled", !1), $("#closed").removeClass("hide"), $("#shhowalert").css("display", "none")
}),
    $(document).ready(function() {
    $("#ProductID").change(function() {
        var a = _prototype.type.Getprouducttype();
        0 == a ? $("#protype").text("صـنف محـلى") : $("#protype").text("صـنف مستـورد")
    })
});