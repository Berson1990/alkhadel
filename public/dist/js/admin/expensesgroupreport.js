var expensesGroupReport = function () {};

$(function(){ _ExpenseTypeReportID = new expensesGroupReport(); });



$(document).ready(function() {
 $('#search-ExpensesGroupReport').click(function(){
 $(this).prop("disabled",true);
 // alert("df;gjdfkh;jdfk;hjdf;khjf;khjfk;hj");
       _ExpenseTypeReportID.searchfortables();
    });
    
    
//                reloadcbo();
    
});


	
	function getExpensesGroupName(ExpenseGroupID)
    {
        var cboExpensesGroupID = $( "#ExpenseGroupReportID" ).clone();
        $(cboExpensesGroupID).val(ExpenseGroupID);

        return $('option:selected',cboExpensesGroupID).text(); 
    } 


function getExpensesTypeName(ExpenseTypeID)
    {
        var cboExpensesTypeID = $( "#ExpenseTypeReportID" ).clone();
        $(cboExpensesTypeID).val(ExpenseTypeID);

        return $('option:selected',cboExpensesTypeID).text(); 
    }
	
expensesGroupReport.prototype.searchfortables = function(){
   
 var t = $('#tbl-ExpensesGroupReport').DataTable();
 
    
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
            url: "loadExpensesGroup",
            type: "post",
            data: $('#expensesgroupreport-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
       
          .done(function (output) {
		    	
  
            var obj = eval (output);
 
		
			
			
			input=$('#expensesgroupreport-repo-form :input');
		      console.log(input);
//				 console.log(input[2]);
//				 console.log(input[3]);    			 
				 var x= input[2].value;
               var y= input[4].value;
//				console.log(y);
				 var text2=getExpensesGroupName(x);
				console.log(text2);
			
			
                 // var cboExpensesTypeID = $( "#expensesgroupreport-repo-form  #ExpenseTypeReportID" ).clone();
                // $(cboExpensesTypeID).val(y);
               // var text2= $('option:selected',cboExpensesTypeID).text(); 



				 // var text2=getExpensesTypeName(y);
				console.log(text2);
//		
				 $("#ShowONPrintExpensesGroup").text(" اسم مجموعات المصروفات: "+text2);	

//				 $("#ShowONPrintExpensestype").text(" نوع المصروف: "+text2); 
//		        
//     			 console.log(text);
//				 console.log(text2);    			 
			var Finaltgroup= 0;
               for (var i = 0; i < obj.length; i++){
 
						
                     text = '<tr><td class="Pname " >'+obj[i].ExpensesGroupName+'</td>'+
                            '<td class="sum_weight "  >'+obj[i].ExpenseTypeName+'</td>'+
                            '<td class="sum_mount" >'+obj[i].Mount+'</td>'+
                            '<td class="sum_productprice " >'+obj[i].TransDate+'</td>'+'</tr>';
//                          
//	
                    t.row.add( $(text) ).draw();
				   Finaltgroup += obj[i].Mount;
                }
                
                $(".total").text(Finaltgroup);
        //  _ExpenseTypeReportID.CheckTotal3()


          
       }).error(function (data) {
        showError('',data);
        }); 
	
}


// =================get expenses  ======================

$("#ExpenseGroupReportID").change(function(){
	
//  alert($(this).val());
//    
	x=$(this).val();
//	console.log(x);
	  $.ajax({
            url: "loadexpensestyps",
            type: "post",
            data: $(this).val($(this).val()),
            dataType: "json"
        }).done(function (output) {
//		  console.log(output);
		  
		  var obj = eval (output);
//          console.log(obj);
		  	$('#ExpenseTypeReportID').empty();
		  for (var i = 0; i < obj.length; i++){
		  	var newOption = $('<option >'+ obj[i].ExpenseTypeName+'</option>');
//			  console.log(newOption);
		  	$('#ExpenseTypeReportID').append(newOption);
		  	$('#ExpenseTypeReportID').trigger("chosen:updated");
		  }
            
       }).error(function(data) {
        showError('',data);
        }); 
	
});

//============================print==================================

$(document).ready(function() {


    var table2 = $('#tbl-ExpensesGroupReport').DataTable({
        dom: 'T<"clear">lfrtip',
       "sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",
        "columnDefs": [
            { "visible": false, "targets": 0 }
        ],
        "order": [[ 2, 'asc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="hide group"><td colspan="4">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });
            
    
//     $('#tbl-ExpensesGroupReport tbody').find('.group').each(function(i, v) {
//                            var rowCount = $(this).nextUntil('.group').length;
//
//                            // console.log("####");
//                            var total_sum = 0;
//                            $(this).nextUntil('.group').each(function() {
////                                console.log($(this));
////                                console.log($(this).find(".sum").text());
//                                total_sum = total_sum + parseInt($(this).find(".sum").text());
//                            });
//console.log(total_sum);
//                            // console.log(total_sum);
//                            // console.log("####");
//                             if ($(this).nextUntil('.group').next())
//                             {
//                                 // console.log($(this).nextUntil('.group').last());
//                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td colspan="5">'+"مجموع المصروفات: "+total_sum+'</td></tr>')
//                             }
//                        
//                        });
//                    
            
        }
    });  
    
    
    
    
    
//    var table = $('#tbl-ExpensesGroupReport').DataTable({
////        dom: 'T<"clear">lfrtip',
//        
//    } ); 
      
    $("#ToolTables_tbl-ExpensesGroupReport_4").on("click", function(){
            
            $("#search-ExpensesGroupReport").addClass("hide");
            $("#ShowONPrintExpensesGroup").css("visibility","visible"); 
            $("#ShowONPrintExpensestype").css("visibility","visible"); 
            $("#ExpenseGroupReportID_chosen").css("display","none");
            $("#ExpenseTypeReportID_chosen").css("display","none");
       
	 window.print();
	
	})    
});


    $(document).keyup(function(e) {
     if (e.keyCode == 27) {
       
            $("#search-ExpensesGroupReport").removeClass("hide");
            $("#ShowONPrintExpensesGroup").css("visibility","hidden"); 
            $("#ShowONPrintExpensestype").css("visibility","hidden"); 
            $("#ExpenseGroupReportID_chosen").css("display","block");
            $("#ExpenseTypeReportID_chosen").css("display","block");
         
    }
});

// ============================ sum all mount 

 expensesGroupReport.prototype.CheckTotal3 = function(){
 
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-ExpensesGroupReport tr");
 
            $dataRows.each(function() {
                $(this).find('.sum_mount').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
                });
            });
            $("#tbl-ExpensesGroupReport th.total").each(function(i){  
                $('.total').html("اجمالى المبلغ :"+totals[i]);
                
//                srttotalrefund(totals[i]);
                
            });
             //console.log($dataRows)
// alert("3");
}
 
  
 $(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#search-ExpensesGroupReport").prop("disabled",false);
});
});