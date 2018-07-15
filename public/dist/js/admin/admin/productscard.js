
var productsCard = function () {};
 
$(function(){ _productsCard = new productsCard() });   


$(document).ready(function() {
 $('#search-ProuductsCard').click(function(){
        _productsCard.searchfortables();
       $("#search-ProuductsCard").prop("disabled",true);
    });                  
});



$(document).ready(function() {
  $( ".datepicker" ).datepicker({
   dateFormat: 'yy/mm/dd',
currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
     
}); 
    
 $(".datepicker").datepicker('setDate', new Date());
    
 });    



$(document).ready(function() {
	$("#ProductsCard").select2({
  placeholder: " ",
	  ajax: {
                url: 'productautocomplete',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                type : 'post',
                data: function (params) {
                    var queryParameters = {
                        ProductName: params.term
                    }
                    return queryParameters;
                },
                processResults: function (output) {
					console.log(output)
                    if (output.status){
                        return {
                            results: $.map(output.data, function (item) {
                                return {
                                    text: item.ProductName,
                                    id: item.ProductID,
                                    ProductType : item.ProductType
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

function getProductName(productID)
    {
        var cboproductID = $( "#ProductsCard" ).clone();
        $(cboproductID).val(productID);

        return $('option:selected',cboproductID).text() ; 
    }
	
productsCard.prototype.searchfortables = function(){
	
 var t = $('#tbl-Products').DataTable();
    
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
            url: "proudctsplade",
            type: "post",
            data: $('#productscard-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
 
          .done(function (output) {
//			console.log(output);
		   var obj = eval (output); 
//		  total = obj.Total;
		  	console.log(obj);
		  
		  	input=$('#productscard-repo-form :input');
//		    console.log(input);
	   			 
				 var x= input[2].value;
				 var text=getProductName(x);
//		         console.log(text);
		  
		$("#ShowProuduct").text("اسم المنتج: "+text);			   
        
//		     total = output.data.Total;        
//				console.log(total);



            var FC = 0;
            var FT = 0;
		 for (var i = 0; i < obj.length; i++) 
		 { 
			  total = obj[i].Total;
			  carrying =obj[i].Carrying;
			  TbC = Math.round(total + carrying);
			 
			    if(obj[i].WeightType==0 ) {
					text = '<tr><td>'+obj[i].SalesDate+'</td>'+
                        '<td >'+obj[i].ProductName+'</td>'+
					    '<td >الكيلو</td>'+
					    '<td >'+obj[i].Weight+'</td>'+
                        '<td >'+obj[i].Quantity+'</td>'+
                        '<td >'+obj[i].ProductPrice+'</td>'+
                        '<td class="sum2" >'+obj[i].Total+'</td>'+
                        '<td >'+obj[i].Carrying+'</td>'+
						'<td class="sum">'+TbC+'</td>'+'</tr>';
			 
				}else{
							text = '<tr><td>'+obj[i].SalesDate+'</td>'+
                        '<td >'+obj[i].ProductName+'</td>'+
					    '<td >الوزنه</td>'+
					    '<td >'+obj[i].Weight+'</td>'+
                        '<td >'+obj[i].Quantity+'</td>'+
                        '<td >'+obj[i].ProductPrice+'</td>'+
                       '<td class="sum2" >'+obj[i].Total+'</td>'+
                        '<td >'+obj[i].Carrying+'</td>'+
						'<td class="sum">'+TbC+'</td>'+'</tr>';
					
	
			 

				}
              
                    
				    t.row.add( $(text) ).draw(); 

                       FT +=TbC ;
                       // console.log(TbC);
                console.log(FT);
                FC+=obj[i].Total;
                // console.log(FC);
  
		 }
         $(".total2").text(FC)
         $(".total").text(FT)
  	 // _productsCard.CheckTotal();		
  	 // _productsCard.CheckTotal2();		
	
		 }).error(function (data) {
        showError('',data);
        }); 

}

//	=============================== sum function
// productsCard.prototype.CheckTotal = function(){
// //  alert("aaaaaaaaaaaaaa");
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-Products tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=parseInt( $(this).html());
// //					console.log("00000");
//                 });
//             });
//             $("#tbl-Products th.total").each(function(i){  
//                 $('.total').html("الاجمالى :"+totals[i]);
// //				console.log( totals[i]);
//             });

// }
// productsCard.prototype.CheckTotal2 = function(){
// //  alert("aaaaaaaaaaaaaa");
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-Products tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum2').each(function(i){        
//                     totals[i]+=parseInt( $(this).html());
// //					console.log("00000");
//                 });
//             });
//             $("#tbl-Products th.total2").each(function(i){  
//                 $('.total2').html("الاجمالى :"+totals[i]);
// //				console.log( totals[i]);
//             });

// }

//============================print==================================

$(document).ready(function() {
	
    var table =  $('#tbl-Products').DataTable({
        dom: 'T<"clear">lfrtip',
      
      "tableTools": {
            "sSwfPath": "/swf/copy_csv_xls_pdf.swf"
        },
/* just for test*/
//   $("#tbl-Products").tabs( {
//         "active": function(event, ui) {
//             var jqTable = $('table.display', ui.panel);
//             if ( jqTable.length > 0 ) {
//                 var oTableTools = TableTools.fnGetInstance( jqTable[0] );
//                 if ( oTableTools != null && oTableTools.fnResizeRequired() )
//                 {
//                     /* A resize of TableTools' buttons and DataTables' columns is only required on the
//                      * first visible draw of the table
//                      */
//                     jqTable.dataTable().fnAdjustColumnSizing();
//                     oTableTools.fnResizeButtons();
//                     }
//             }
//         }
// });


/**/
        
    } ); 
      
    $("#ToolTables_tbl-Products_4").on("click", function(){
               $("#search-ProuductsCard").addClass("hide");
   $("br").addClass("hide");
            $("#ShowProuduct").css("display","block"); 
			 $("#hideinprint").addClass('hide');
         
	 window.print();
	
	})    
});


    $(document).keyup(function(e) {
     if (e.keyCode == 27) {
       
            // $("#search-ProuductsCard").css("visibility","visible");
            $("#search-ProuductsCard").removeClass("hide");
            $("#ShowProuduct").css("display","none"); 
		 	     $("#hideinprint").removeClass('hide');
		 
            $("br").removeClass("hide");

         
    }
});

$(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#search-ProuductsCard").prop("disabled",false);
});
});


