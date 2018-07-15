var totalexpensestypes = function () {};

$(function(){ _totalexpensetype = new totalexpensestypes(); });

$(document).ready(function() {
 $('#search-TotalExpense').click(function(){
        _totalexpensetype.searchfortables();
      $(this).prop("disabled",true);
    });
    

});

totalexpensestypes.prototype.searchfortables = function(){
  
 var t = $('#tbl-TotalExpenses').DataTable();
    
     
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
            url: "loadData" ,
            type: "post",
            data: $('#expensetype-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
        .done(function (output) {
    
            var obj = eval (output);
                
            console.log(obj);
            var totalexpense = 0 ;
            for (var i = 0; i < obj.length; i++) {

                 text = '<tr><td>'+obj[i].Notes+'</td>'+
                        '<td>'+obj[i].ExpensesGroupName+'</td>'+
                        '<td>'+obj[i].CashierName+'</td>'+
                        '<td class="sum">'+obj[i].Mount+'</td>'+
                        '<td >'+obj[i].ExpenseTypeName+'</td>'+
                        '<td >'+obj[i].TransDate+'</td>'+ '</tr>'
//                        '<td class="total">'+'</tr>';

                t.row.add( $(text) ).draw();
                
                totalexpense +=obj[i].Mount ;

            }
            $(".totalexpnses").text(totalexpense);
            // _totalexpensetype.CheckTotal3();
            
            
            
            
//            var column = t.column( 2 );
//                $( column.footer() ).html(
//                column.data().reduce( function (a,b) {
//                    a = parseInt(a);
////					console.log(a);
//                    b = parseInt(b);
//					console.log(b);
//                    return a+b+ ": اجمالى المصروفات ";
//                } )
//            );
            
            
        })
        .error(function (data) {
        showError('',data);
        }); 

        }



$(document).ready(function() {
    var table = $('#tbl-TotalExpenses').DataTable({
        dom: 'T<"clear">lfrtip',
         "sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",
        "columnDefs": [
            { "visible": false, "targets": 1 }
        ],
        "order": [[ 2, 'asc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });
            
    
     $('#tbl-TotalExpenses tbody').find('.group').each(function(i, v) {
                            var rowCount = $(this).nextUntil('.group').length;

                            // console.log("####");
                            var total_sum = 0;
                            $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                total_sum = total_sum + parseInt($(this).find(".sum").text());
                            });
console.log(total_sum);
                            // console.log(total_sum);
                            // console.log("####");
                             if ($(this).nextUntil('.group').next())
                             {
                                 // console.log($(this).nextUntil('.group').last());
                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td colspan="5">'+"مجموع المصروفات: "+total_sum+'</td></tr>')
                             }
                        
                        });
                    
            
        }
    }); 

    
    
    
    
    $("#ToolTables_tbl-TotalExpenses_4").on("click", function(){
  

  
        $("table").css("width","100%");
        $("#search-TotalExpense").addClass("hide")
            window.print();
        })    

    // Order by the grouping
    $('#tbl-TotalExpenses tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
            table.order( [ 2, 'desc' ] ).draw();
        }
        else {
            table.order( [ 2, 'asc' ] ).draw();
        }
    });
    
}
                 );

    $(document).keyup(function(e) {
     if (e.keyCode == 27) {
       $("#search-TotalExpense").removeClass("hide");
          
    }
});


//  totalexpensestypes.prototype.CheckTotal3 = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-TotalExpenses tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=parseInt( $(this).html());
//                 });
//             });
//             $("#tbl-TotalExpenses th.totalexpnses").each(function(i){  
//             $('.totalexpnses').html("اجمالى المبلغ :"+totals[i]);
                
// //                srttotalrefund(totals[i]);
                
//             });
 
// }
 
 $(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#search-TotalExpense").prop("disabled",false);
});
});


