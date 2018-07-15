var onetotalexpensestypes  = function () {};

$(function(){ _onetotalexpensetype  = new onetotalexpensestypes (); });

$(document).ready(function() {
 $('#search-oneTotalExpense').click(function(){
      $(this).prop("disabled",true);
        _onetotalexpensetype.searchfortables();
    });
    

});

 function getCustomerName(CustomerID)
    {
        var cboCustomerID = $( "#onetotalexpense-repo-form OneTotalExpenseTypeID" ).clone();
        $(cboCustomerID).val(CustomerID);

        return $('option:selected',cboCustomerID).text() ; 
    }


onetotalexpensestypes.prototype.searchfortables = function(){

     
 var t = $('#tbl-OneTotalExpenses').DataTable(); 
     
    try
    {
    t
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }
    
        $.ajax({
            url: "loadOneData" ,
            type: "post",
            data: $('#onetotalexpense-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
        .done(function (output) {
//            alert(ok);
       // console.log($('#onetotalexpense-repo-form :input'));
            inbut =$('#onetotalexpense-repo-form :input');
//            

            var cboCustomerID = $( "#onetotalexpense-repo-form #OneTotalExpenseTypeID" ).clone();
        $(cboCustomerID).val(inbut[2].value);

        var text =$('option:selected',cboCustomerID).text() ; 
                        $("#ShowONPrint").text("");
            // var text=getCustomerName();
            console.log(inbut[2].value);
            $("#ShowONPrint").append("اسم نوع المصروف: "+text);
            var obj = eval (output);
            
            var finaltoal = 0 ;
             for (var i = 0; i < obj.length; i++) {
                 text = '<tr><td>'+obj[i].Notes+'</td>'+
                        '<td class="sum">'+obj[i].Mount+'</td>'+
                        '<td >'+obj[i].TransDate+'</td>'+ '</tr>'+
                        '<td class="total">'+'</tr>';
                t.row.add( $(text) ).draw();

                finaltoal +=obj[i].Mount;
            }


                    $(".total").text(finaltoal);
            
           
            
            
            
//            var column = t.column( 1 );
//                $( column.footer() ).html(
//                column.data().reduce( function (a,b) {
//                    a = parseInt(a);
//                    b = parseInt(b);
//                    return a+b+" اجمالى المصروفات ";
//                } )
//            );
            
            
        })
        .error(function (data) {
        showError('',data);
        }); 
}



$(document).ready(function() {
    var table = $('#tbl-OneTotalExpenses').DataTable({
        dom: 'T<"clear">lfrtip',
        "sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",
        
    } ); 
      
    $("#ToolTables_tbl-OneTotalExpenses_4").on("click", function(){

            $("#FirsTPart").addClass("FirsTPart");
            $("#search-oneTotalExpense").addClass("hide")
            $("#ShowONPrint").css("visibility","visible");
            $("#OneTotalExpenseTypeID_chosen").css("display","none");
       
	 window.print();
	
	} )    
	
 
	
	
	
} );


    $(document).keyup(function(e) {
     if (e.keyCode == 27) {
        $("#FirsTPart").removeClass("FirsTPart");
            $("#search-oneTotalExpense").removeClass("hide");
            $("#ShowONPrint").css("visibility","hidden");
            $("#OneTotalExpenseTypeID_chosen").css("display","block");
         
    }
});

onetotalexpensestypes.prototype.CheckTotal = function(){
    
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-OneTotalExpenses tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
                });
            });
            $("#tbl-OneTotalExpenses th.total").each(function(i){  
                $('.total').html("اجمالى المبلغ :"+totals[i]);
            });
 
}

$(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#search-oneTotalExpense").prop("disabled",false);
});
});


