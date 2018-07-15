var onetotalsuppliers = function () {};
 
$(function(){ _onetotalsuppliers = new onetotalsuppliers(); });
 

$(document).ready(function(){
     $("#TotalCustomersID").select2({
            placeholder: "Search for an Customer Name",
            ajax: {
                url: 'autocompleteCustomer',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                type : 'post',
                data: function (params) {
                    var queryParameters = {
                        CustomerName: params.term
                    }
                    return queryParameters;
                },
                processResults: function (output) {
                    if (output.status){
                        return {
                            results: $.map(output.data, function (item) {
                                return {
                                    text: item.CustomerName,
                                    id: item.CustomerID,
                                    CustType : item.CustomerType
                                }
                            })
                        };
                    }else{
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
	
	$("#TotalSupplierID").select2({
  placeholder: " ",
	  ajax: {
                url: 'supplierautocomplete',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                type : 'post',
                data: function (params) {
                    var queryParameters = {
                        SupplierName: params.term
                    }
                    return queryParameters;
                },
                processResults: function (output) {
                    if (output.status){
                        return {
                            results: $.map(output.data, function (item) {
                                return {
                                    text: item.SupplierName,
                                    id: item.SupplierID,
                                    comm : item.SupplierCommision ,
                                    suptype : item.SupplierType
                                }
                            })
                        };
                    }else{
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
	

 checkRadio=1;


function individuale(){
checkRadio=1;
}


function combine(){
checkRadio=2;
}

$(document).ready(function() {
 $('#search-OneTotalSuppliers').click(function(){
        _onetotalsuppliers.searchfortables();
       $("#search-OneTotalSuppliers").prop("disabled",true);
    });                  
});
 
function getCustomerName(CustomerID)
    {
        var cboCustomerID = $( "#TotalCustomersID" ).clone();
        $(cboCustomerID).val(CustomerID);

        return $('option:selected',cboCustomerID).text() ; 
    }

function getSupplierName(SupplierID)
    {
        var cboSupplierID = $( "#TotalSupplierID" ).clone();
        $(cboSupplierID).val(SupplierID);

        return $('option:selected',cboSupplierID).text() ; 
    }


//function to enble and disaple combobox end 

$(document).ready(function(){
$("#check_customers").click(function(){
   if($(this).is(":checked")) 
   {
   $("#TotalCustomersID").prop("disabled",false); 
   }else{
    
    $("#TotalCustomersID").prop("disabled",true).trigger("chosen:updated");  
  
   }
         if($(this).is(":checked")) 
   {
      $("#TotalCustomersID").prop("disabled",false).trigger("chosen:updated");   
   }

});
});


onetotalsuppliers.prototype.searchfortables = function(){
 var t = $('#tbl-OneTotalSuppliers').DataTable();
    
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
 
 var t = $('#tbl-OneTotalSuppliers').DataTable();
 
 		console.log($('#onetotalsuppliers-repo-form :input'));
        $.ajax({
            url: "loadOneSupplierData",
            type: "post",
            data: $('#onetotalsuppliers-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
 
          .done(function (output) {
            var input=$('#onetotalsuppliers-repo-form :input');
              console.log(input);
             var x= input[3].value;
             var y= input[4].value;
			console.log(y);
             // var text=getCustomerName(x);
             // var text2=getSupplierName(y);
             
               
                var cboCustomer = $("#TotalCustomersID").clone();
                var cboSupplier = $("#TotalSupplierID").clone();

                 var text =  $('option:selected',cboCustomer).text();
                  var text2 =  $('option:selected',cboSupplier).text();
console.log(text);
console.log(text2);
             $("#ShowCustomerONPrint").text("اسم التاجر:"+text);
             $("#ShowSupplierONPrint").text("اسم المورد:"+text2);
            
            
            console.log($('#onetotalsuppliers-repo-form :input'));
            var obj = eval (output);
            console.log(output);
    var ontotalsupplersFinal = 0
            var obj = eval (output);
            for (var i = 0; i < obj.length; i++) {
 
                 text = '<tr><td class="date hidecombine2">'+obj[i].SalesDate+'</td>'+
                        '<td class="Cname hidecombine2">'+obj[i].CustomerName+'</td>'+
                        '<td class="hidecombine2">'+obj[i].ProductName+'</td>'+
                        '<td class="hidecombine2">'+obj[i].RefNo+'</td>'+
                        '<td class="hidecombine2">'+obj[i].Weight+'</td>'+
                        '<td class="hidecombine2">'+obj[i].Quantity+'</td>'+
                        '<td class="hidecombine2">'+obj[i].ProductPrice+'</td>'+
                        '<td class="sum hidecombine2">'+obj[i].Total+'</td>'+
                        '</tr>';
 
                t.row.add( $(text) ).draw();
                    ontotalsupplersFinal  += Math.round(obj[i].Total)
            }
            $(".total").text(ontotalsupplersFinal);
        // _onetotalsuppliers.CheckTotal();
       }).error(function (data) {
        showError('',data);
        }); 
	}


	//}

   

//grouping 

$(document).ready(function() {
    
    var table = $('#tbl-OneTotalSuppliers').DataTable({
        
//            	          "columnDefs": [
//            { "visible": false, "targets": 0 },   
//                              
//                             
//       ],
            dom: 'T<"clear">lfrtip',
             "sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",
         "order": [[ 0, 'asc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                
      
        var Individuale = $('input[name=Individuale]:checked','#onetotalsuppliers-repo-form').val();
                
                  if(Individuale == 1){
                
//               $(".hideincomine3").css( "display","table-cell");
               $(".hidecombine2").css( "display","table-cell");
                 
            }
                 
               
           // console.log();
          if(Individuale == 2)
                
            {  
                  $(".hideincomine303").text('');
//                ("visibility","hidden");
                  $(".hidecombine2").css("display","none");
                
    
                if ( last !== group ) {

                  $(rows).eq( i ).before(
                  '<tr  style="display:none;" class="group"><td colspan="7">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
				
    				
    				 // if (document.getElementById("check_customers").checked==true)
         //                        {
         //                            $(".optional").removeClass("hide");
         //                            $(".optional").addClass("show");
         //                            // $(".Cname").addClass("show");
                                    
         //                        }else
         //                        {
         //                            $(".optional").removeClass("show");
         //                            $(".optional").addClass("hide");
    					// 			// $(".Cname").addClass("hide");
         //                        }

           } 
            
			});
			
            
				   
                    
                
     $('#tbl-OneTotalSuppliers tbody').find('.group').each(function(i, v) {
         
                      
                            var rowCount = $(this).nextUntil('.group').length;
//
                            var total_sum = 0;
                            $(this).nextUntil('.group').each(function() {
//                             
                                total_sum = total_sum + parseInt($(this).find(".sum").text());
                                date = $(this).find(".date").text();
                                console.log(date);
                            });
         
                            console.log(total_sum);
                            console.log("####");
                             if ($(this).nextUntil('.group').next())
                             {
                                 console.log($(this).nextUntil('.group').last());
                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td style="background: #eff1f1;">'+date+'</td><td style="background: #eff1f1;" colspan="7">'+"الاجمالى : "+total_sum+'</td></tr>')
                             }


                        });
                    
    
    //######################
    
         //   });   
				 // if (document.getElementById("check_customers").checked==false)
     //                        {
     //                            $(".optional").removeClass("show");
     //                            $(".optional").addClass("hide");
     //                            $(".Cname").addClass("hide");
                                
     //                        }else
     //                        {
     //                            $(".optional").removeClass("hide");
     //                            $(".optional").addClass("show");
					// 			$(".Cname").addClass("show");
     //                        }

            
        }
    } ); 

    
    $("#ToolTables_tbl-OneTotalSuppliers_4").click(function(){
        $("table").css("width","100%");
        $("#search-OneTotalSuppliers").addClass("hide");
		
        // $("#check_customer").css("visibility","hidden");
        // $("#check_customers").css("visibility","hidden");  
          $("#check_customer").addClass("hide");
		$("#check_customers").addClass("hide");
       
		$("#hiddenOnPrint").addClass("hide");
//        $("#").css("display","none");
		
  $("br").addClass("hide");
        $("#ShowCustomerONPrint").css("display","block");
        $("#ShowSupplierONPrint").css("display","block");   
		
        
        if(checkRadio==1){
        
             $("#rbtnIsndividualeone").css("visibility","visible");$("#iname").css("visibility","visible");
             $("#rbtnCombineone").css("visibility","hidden");  $("#cname").css("visibility","hidden");
       
        }else{
         $("#rbtnIsndividualeone").css("visibility","hidden");  $("#iname").css("visibility","hidden");
        $("#rbtnCombineone").css("visibility","visible"); $("#cname").css("visibility","visible");

        }
//		  if($('#check_customers') == true) {
//			
//			$("#ShowCustomerONPrint").css("visibility","hidden");  
//			  
//		  }
//		else 
//		{
//			
//			$("#ShowCustomerONPrint").css("visibility","visible");  
//			
//		}
		
   if($("#check_customers").is(":checked")) 
   {
    	$("#ShowCustomerONPrint").css("visibility","visible"); 
   }else{
    
     
    $("#ShowCustomerONPrint").css("visibility","hidden");  
   }
	
		 window.print();
        })    
    
    //$("#ToolTables_tbl-OneTotalSuppliers_4").keyCode(function(){
    
      $(document).keyup(function(e) {
        if (e.keyCode == 27) {
            
            $("br").removeClass("hide");
        $("table").css("width","100%");        
         $("#search-OneTotalSuppliers").removeClass("hide");
        
	    $("#check_customer").removeClass("hide");
		$("#check_customers").removeClass("hide"); 		
			
        
        $("#hiddenOnPrint").removeClass("hide");
//        $("#").css("display","block"); 
        $("#ShowCustomerONPrint").css("display","none");
        $("#ShowSupplierONPrint").css("display","none");    
        
            if(checkRadio==1){
        
         $("#rbtnIsndividualeone").css("visibility","visible");$("#iname").css("visibility","visible");
        $("#rbtnCombineone").css("visibility","visible");$("#cname").css("visibility","visible");
       
        }else{
        
         $("#rbtnIsndividualeone").css("visibility","visible");   $("#iname").css("visibility","visible");
        $("#rbtnCombineone").css("visibility","visible");$("#cname").css("visibility","visible");
       
        }
	
  if($("#check_customers").is(":checked")) 
   {
    	$("#ShowCustomerONPrint").css("visibility","visible"); 
   }else{
    
     
    $("#ShowCustomerONPrint").css("visibility","hidden");  
   }

			
//			  if($('#check_customers') == true) {
//			
//			$("#ShowCustomerONPrint").css("visibility","hidden");  
//			  
//		  }
//		else 
//		{
//			
//			$("#ShowCustomerONPrint").css("visibility","visible");  
//			
//		}	
//            
        }
     });
    

    // Order by the grouping
    $('#tbl-OneTotalSuppliers tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
            table.order( [ 2, 'desc' ] ).draw();
        }
        else {
            table.order( [ 2, 'asc' ] ).draw();
        }
    } );
} );


// onetotalsuppliers.prototype.CheckTotal = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-OneTotalSuppliers tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=parseInt( $(this).html());
//                 });
//             });
//             $("#tbl-OneTotalSuppliers th.total").each(function(i){  
//                 $('.total').html("اجمالى المبلغ :"+totals[i]);
//             });
 
// }
//groupnig

 $(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#search-OneTotalSuppliers").prop("disabled",false);
});
});