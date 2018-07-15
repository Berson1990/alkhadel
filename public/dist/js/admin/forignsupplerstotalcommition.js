

/**
 * Created by Alex4Prog on 27/12/2016.
 */

var totalcustomersdata = function () {};

$(function(){ _totalcustomersdata = new totalcustomersdata(); });

$("#rbtnIndividuale").click(function() {

    $("#tbl-finalData").css("display","inline-table");
});




$(document).ready(function() {

    $( ".datepicker" ).datepicker({
        dateFormat: 'yy/mm/dd',
        currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())

    });

    $(".datepicker").datepicker('setDate', new Date());
    $('#search-totallocalCustomer').click(function(){

        _totalcustomersdata.searchfortables();
    });


});


finaltotal0 =0;

function settotal0 (data)
{

    finaltotal0 =data;

}
finaltotal1 =0;

function settotal1 (data)
{

    finaltotal1=data;

}

finaltotal2 =0;

function settotal2 (data)
{

    finaltotal2 =data;

}




checkbox2=1;

function getCustomerName(CustomerID)
{

    var cboCustomerID = $("#TotalCustomersID").clone();

    $(cboCustomerID).val(CustomerID);

    return $('option:selected',cboCustomerID).text() ;
}


$('#check_enable2').change(function(){
    if(checkbox2%2==0)
    {
        $('#TotalCustomersID').prop('disabled', true).trigger("chosen:updated"); checkbox2++;
    }
    else
    {
        $('#TotalCustomersID').prop('disabled', false).trigger("chosen:updated"); checkbox2++;
    }
});


Nowlon=0; Discount=0; Type=0; Carrying=0; Custody=0;

function setNowlon(data){Nowlon=data;}
function setDiscount(data){Discount=data;}
function setType(data){Type=data;}
function setCarrying(data){Carrying=data;}
function setCustody(data){Custody=data;}




totalcustomersdata.prototype.searchfortables = function(){

    var Prouduct  = $("#ProuductID").clone();
    console.log(Prouduct);
    $("#ShowProuduct").text(Prouduct);
    var toalalocalCutomers = $('#tbl-toalalocalCutomers').DataTable();

    try
    {
        toalalocalCutomers
            .clear()
            .draw();
    }
    catch(ex)
    {
        alert("error");

    }

    $.ajax({
        url: "foriegnSupplers",
        type: "post",
        data: $('#totalcustomersdata-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
        dataType: "json"
    })

        .done(function (output) {
            var obj = output;
            var ToalaCommiton = 0;
            var finaltotal =0
            var totalbefor = 0
            var totalafter = 0
            for (var i = 0; i < obj.length; i++) {
                // finaltotal += Math.round(obj[i].Total) + obj[i].Carrying
                ToalaCommiton = obj[i].Commision/100 * obj[i].Total;
                ToalaCommiton= Math.round(ToalaCommiton);
                totalbefor += Math.round(obj[i].Total)
                totalafter += ToalaCommiton
                var text =  '<tr>'
                    +'<td>'+obj[i].SalesDate+'</td>'
                    +'<td>'+obj[i].SupplierName+'</td>'
                    +'<td>'+obj[i].Total+'</td>'
                    +'<td>'+obj[i].Commision+'</td>'
                    +'<td >'+ToalaCommiton+'</td>'
                    +'</tr>';
                toalalocalCutomers.row.add( $(text) ).draw();


                $("#total1").text(totalbefor);
                $("#total2").text(totalafter);
            } //end of for


        }).error(function (data) {


        showError('',data);
    });


}





$(document).ready(function() {
    var table =  $('#tbl-toalalocalCutomers').DataTable({
        dom: 'T<"clear">lfrtip',

    });

    $("#ToolTables_tbl-toalalocalCutomers_4").on("click", function(){
        $("table").css("width","100%");
        $("#search-totallocalCustomer").addClass("hide");
        $("#ProuductID").addClass("hide");
        $("#check_label2").addClass("hide");
        $("#check_Customers").addClass("hide");
        $("#check").addClass("hide");
        $("#check_Customers").addClass("hide");
        $("#ShowONPrint").css("display","block");
        $("#Showprouduct2").css("display","block");
        $("#hide").css("display","none");

        window.print();


    })


    $(document).keyup(function(e) {
        if (e.keyCode == 27) {

            $("table").css("width","100%");
            $("#search-totallocalCustomer").removeClass("hide");
            $("#check_enable2").removeClass("hide");
            $("#check_label2").removeClass("hide");
            $("#check_Customers").removeClass("hide");
            $("#check").removeClass("hide");
            $("#check_Customers").removeClass("hide");
            $("#ShowONPrint").css("display","none");
            $("#Showprouduct2").css("display","none");
            $("#hide").css("display","block");

        }
    });

} );



$(document).ready(function() {
    $(':input').change(function () {
//   alert("ayyy")
        $("#search-totalcustomersdata").prop("disabled",false);
    });
});