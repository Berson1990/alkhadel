var enddealbills = function () {};
 
$(function(){ _enddealbills = new enddealbills() });

$(document).ready(function(){

$("#endDealSupplierID").select2({
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
	        $("#endDealCustomersID1").select2({
            placeholder: "Search for an Customer Name",
              ajax: {
                url: 'autocompleteCustomer',
//				  customer/autocomplete/
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
   
	
});	

//function getCustomerName(CustomerID)
//    {
//    
//    }
//
//function getSupplierName(SupplierID)
//    {
//   
//    }


$(document).ready(function(){
$("#check_Customers").click(function(){
   if($(this).is(":checked")) 
   {
   $("#endDealCustomersID1").prop("disabled",false); 
   }else{
    
    $("#endDealCustomersID1").prop("disabled",true).trigger("chosen:updated");  
  
   }
         if($(this).is(":checked")) 
   {
      $("#endDealCustomersID1").prop("disabled",false).trigger("chosen:updated");   
   }

});



$("#check_Supplirs").click(function(){
   if($(this).is(":checked")) 
   {
   $("#endDealSupplierID").prop("disabled",false); 
   }else{
    
    $("#endDealSupplierID").prop("disabled",true).trigger("chosen:updated");  
  
   }
         if($(this).is(":checked")) 
   {
      $("#endDealSupplierID").prop("disabled",false).trigger("chosen:updated");   
   }

});

});

	$(document).ready(function() {
 $('#search-enddealbills').click(function(){
          $(this).prop("disabled",true);
        _enddealbills.searchfortables();
    });                  
});


enddealbills.prototype.searchfortables = function(){
 var t = $('#tbl-endDealBills').DataTable();
    
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
  var b = $('#tbl-BillsDetalis').DataTable();
    
    try
    {
    b
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
    
    
    var ecs = $('#tbl-EndofCustomersStatment').DataTable();
    
    try
    {
    ecs
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  

     var t = $('#tbl-endDealBills').DataTable();
	
      var b = $('#tbl-BillsDetalis').DataTable();

      
	
 		console.log($('#enddealbills-repo-form :input'));
        $.ajax({
            url: "loadendbills",
            type: "post",
            data: $('#enddealbills-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
 
          .done(function (output) {
			 var obj = eval (output); 
//			  var case = obj[i].Total_1;
//				   console.log(case);
            var finalAbordCustomersStatmend= 0;
            var gain = 0 ;
            var lose =0; 
            var finaltotal1 =0 ;
            var finaltotal2 = 0 ;
			 for (var i = 0; i < obj.length; i++) {
				  
//                  finaltotal= obj[i].Total_1 - obj[i].Total_2;
				  if (obj[i].Total_1 > obj[i].Total_2 )
                  {
                      
                       finaltotal1= obj[i].Total_1 - obj[i].Total_2;
                      
				 	   text = '<tr><td >'+obj[i].CustomerName+'</td>'+
				 	 	'<td>'+obj[i].SalesDate+'</td>'+
				 	 	'<td>'+obj[i].estimatedvalue+'</td>'+
                        '<td >'+obj[i].internalexpenses+'</td>'+
                        '<td >'+obj[i].RefNo+'</td>'+
                        '<td >'+obj[i].Total_2+'</td>'+
                        '<td >'+obj[i].valuesold+'</td>'+
                        '<td >'+obj[i].billexpenses+'</td>'+
                        '<td >'+obj[i].commision+'</td>'+
                        '<td >'+obj[i].Total_1+'</td>'+
                        '<td>'+"ربح"+'</td>'+
                        '<td>'+finaltotal1+'</td>'+'</tr>';
				  }	else  {
                       finaltotal2= obj[i].Total_1 - obj[i].Total_2;
                      
				 	   text = '<tr><td style="background:#FFFFD8">'+obj[i].CustomerName+'</td>'+
						'<td  style="background:#FFFFD8">'+obj[i].SalesDate+'</td>'+   
						'<td  style="background:#FFFFD8">'+obj[i].estimatedvalue+'</td>'+   
                        '<td  style="background:#FFFFD8">'+obj[i].internalexpenses+'</td>'+
                        '<td  style="background:#FFFFD8">'+obj[i].RefNo+'</td>'+
                        '<td  style="background:#FFFFD8">'+obj[i].Total_2+'</td>'+
                        '<td  style="background:#FFFFD8">'+obj[i].valuesold+'</td>'+
                        '<td  style="background:#FFFFD8">'+obj[i].billexpenses+'</td>'+
                        '<td  style="background:#FFFFD8">'+obj[i].commision+'</td>'+
                        '<td style="background:#FFFFD8">'+obj[i].Total_1+'</td>'+
                        '<td  style="background:#FFFFD8">'+"خسارة"+'</td>'+
                        '<td  style="background:#FFFFD8">'+finaltotal2+'</td>'+'</tr>';
                      
                   
				  }
				 
			
                t.row.add( $(text) ).draw();

			 }
            
            
 // ========================================= final statment of abord customers             
            for(var j= 0 ; j < obj.length ; j++)
            {
               
                
                 if (obj[j].Total_1 > obj[j].Total_2 )
                 {
                      gain+= obj[j].Total_1 - obj[j].Total_2;
                 }
                else if (obj[j].Total_1 < obj[j].Total_2 )
                 {
                  lose+= obj[j].Total_1 - obj[j].Total_2;
                 }
     
            }
            
                       
             finalAbordCustomersStatmend = gain + lose;
                
            finalstament= '<tr>'+'<td>'+gain+'</td>'+
                          '<td>'+lose+'</td>'+
                          '<td>'+finalAbordCustomersStatmend+'</td>'+'<tr>';

                ecs.row.add( $(finalstament) ).draw()

            
            
            
     // ========================================= final statment of abord customers   
//             finalAbordCustomersStatmend = finaltotal1 - finaltotal2;
//            
//            finalstament= '<tr>'+'<td>'+finaltotal1+'</td>'+
//                          '<td>'+finaltotal2+'</td>'+
//                          '<td>'+finalAbordCustomersStatmend+'</td>'+'<tr>';
//            
//			
//                ecs.row.add( $(finalstament) ).draw();
            
  // ========================================= final statment of abord customers         			
			
			   $.ajax({
            url: "loadBillsDetalis",
            type: "post",
            data: $('#enddealbills-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
				   
        }) .done(function (output) {
				   
				   
				          var input=$('#enddealbills-repo-form :input');
//              console.log(input);
             var x= input[3].value;
				  
             var y= input[5].value;
//		console.log(y);
				   
		 var cboCustomerID = $( "#endDealCustomersID1" ).clone();
				   
        $(cboCustomerID).val(x);

          var text= $('option:selected',cboCustomerID).text();
				   
				 console.log(text);
				   
     var cboSupplierID = $( "#endDealSupplierID" ).clone();
				   
        $(cboSupplierID).val(y);

         var text2= $('option:selected',cboSupplierID).text(); 
				   
				 console.log(text2);  
				   
				   
//           =getCustomerName(x);
//				   
//             var text2=getSupplierName(y);
//				   
				   
				   
             $("#ShowCustomerONPrint11").text("اسم التاجر: "+text);
//console.log($("#ShowCustomerONPrint1").text("اسم التاجر:"+text));  
             $("#ShowSupplierONPrint2").text("اسم المورد: "+text2);
						
				   	 var obj2 = eval (output); 
            
//               var old_Mark = 0;
            
            

				    for (var i = 0; i < obj2.length; i++) {
                        
//                                    
//             var cls_SalesDate = ""
//var cls_sum_CustomerName = ""
//var cls_sum_SupplierName = ""
//var cls_sum_ProductName = ""
//var cls_sum_Weight = ""
//var cls_sum_ProductPrice = ""
//var cls_sum_Total = ""
//
//
//
//                  if (old_Mark != obj2[i].SalesDate)
//                {
//                    old_Mark = obj2[i].SalesDate ;
////                    CustomerName+=obj2[i].CustomerName;
////                     SupplierName+=obj2[i].SupplierName;
////                    ProductName+=obj2[i].ProductName;
////                    Weight+=obj2[i].Weight;
////                    ProductPrice+=obj2[i].ProductPrice;
////                    Total+=obj2[i].Total;
//                    cls_SalesDate = "salesdate"
//                    cls_sum_CustomerName = "cname"
//                    cls_sum_SupplierName = "sname"
//                    cls_sum_ProductName = "proname"
//                    cls_sum_Weight = "wight"
//                    cls_sum_ProductPrice = "proprice"
//                    cls_sum_Total = "total"
//
//                }  

                text2 = '<tr><td >'+obj2[i].SalesDate+'</td>'+
                        '<td >'+obj2[i].CustomerName+'</td>'+
                        '<td >'+obj2[i].RefNo+'</td>'+
                        '<td>'+obj2[i].SupplierName+'</td>'+
                        '<td >'+obj2[i].ProductName+'</td>'+
                        '<td >'+obj2[i].Weight+'</td>'+
                        '<td >'+obj2[i].ProductPrice+'</td>'+
                        '<td class="sum">'+obj2[i].Total+'</td>'+'</tr>';
					   
						
					 b.row.add( $(text2) ).draw();
					}
				   
		 }).error(function (data) {
        showError('',data);
        }); 	
		 
			
			
				
		 }).error(function (data) {
        showError('',data);
        }); 	
    
   
    
    
    
		 
}


$(document).ready(function() {
    
    var tablefcs = $('#tbl-EndofCustomersStatment').DataTable({dom: 'T<"clear">lfrtip',});
    
    var table = $('#tbl-BillsDetalis').DataTable({
        dom: 'T<"clear">lfrtip',
         "sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",
                "order": [[ 0, 'asc' ]],
                "columnDefs": [
            { "visible": false, "targets": 0 },

        ],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                
    

                if ( last !== group ) {

                  $(rows).eq( i ).before(
                  '<tr class="group"><td colspan="7">'+group+'</td></tr>'
                    );
 
                    last = group;
 
                }

			});
			
            
                 api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                
        
                if ( last !== group ) {

                  $(rows).eq( i ).before(
                  '<tr  style="display:none" class="group"><td colspan="7">'+group+'</td></tr>'
                    );
 
                    last = group;
                }

			});
            
            // just for test ===========================================
            
                    api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                
        
                if ( last !== group ) {

                  $(rows).eq( i ).before(
                  '<tr  style="display:none" class="group"><td colspan="7">'+group+'</td></tr>'
                    );
 
                    last = group;
                }

			});
			 
           // end of just for tesr ============================================== 
            
            
            
				   
                    
                
     $('#tbl-BillsDetalis tbody').find('.group').each(function(i, v) {
         
                      
                            var rowCount = $(this).nextUntil('.group').length;
//
                            var total_sum = 0;
                            $(this).nextUntil('.group').each(function() {
//                             
                                total_sum = total_sum + parseInt($(this).find(".sum").text());
                            });
         
//                            console.log(total_sum);
//                            console.log("####");
                             if ($(this).nextUntil('.group').next())
                             {
                                 console.log($(this).nextUntil('.group').last());
                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td colspan="5"> </td><td style="background: #eff1f1;" colspan="1">'+"الاجمالى : "+total_sum+'</td> </tr>')
                             }


                        });
                    


            
        }
    });
});




///==============================================================
$(document).ready(function() {
    
    var table = $('#tbl-endDealBills').DataTable({
        dom: 'T<"clear">lfrtip',
         "sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",
//                  "columnDefs": [
//            { "visible": false, "targets": 0 },
//
//        ],
                "order": [[ 0, 'asc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
//            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
//                
//      
////        var Individuale = $('input[name=Individuale]:checked','#onetotalsuppliers-repo-form').val();
//              
//                
//           // console.log();
//       
//                if ( last !== group ) {
//
//                  $(rows).eq( i ).before(
//                  '<tr class="group"><td colspan="10">'+group+'</td></tr>'
//                    );
// 
//                    last = group;
//                }
//
//			});
//			
            
				   
                    
                
//     $('#tbl-BillsDetalis tbody').find('.group').each(function(i, v) {
//         
//                      
//                            var rowCount = $(this).nextUntil('.group').length;
////
//                            var total_sum = 0;
//                            $(this).nextUntil('.group').each(function() {
////                             
//                                total_sum = total_sum + parseInt($(this).find(".sum").text());
//                            });
//         
////                            console.log(total_sum);
////                            console.log("####");
//                             if ($(this).nextUntil('.group').next())
//                             {
//                                 console.log($(this).nextUntil('.group').last());
//                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td colspan="5"> </td><td style="background: #eff1f1;" colspan="1">'+"الاجمالى : "+total_sum+'</td> <td> </td></tr>')
//                             }
//
//
//                        });
//                    


            
        }
    });
});





$(document).ready(function(){ 

  $("#ToolTables_tbl-BillsDetalis_4").on("click", function(){
      
      $("table").css("width","100%");
            $("#search-enddealbills").addClass("hide");
		    //check chosen customer name
//            $("#check_enable").css("visibility","hidden"); 
//            $("#check_label").css("visibility","hidden");
		    $("#check_Customers").css("visibility","hidden");
		    //checkbox to view customer name 
		    $("#check").css("visibility","hidden");
		    $("#check_Customers").css("visibility","hidden");
		
            $
            $("#hideinprint").css("display","none");
        
       $("#ShowCustomerONPrint11").css("display","block");
        $("#ShowSupplierONPrint2").css("display","block");
      
      
   if($("#check_Customers").is(":checked")) 
   {
    	$("#ShowCustomerONPrint11").css("visibility","visible"); 
   }else{
    
     
    $("#ShowCustomerONPrint11").css("visibility","hidden");  
   }
		  
		  	  if($("#check_Supplirs").is(":checked")) 
   {
    	$("#ShowSupplierONPrint2").css("visibility","visible"); 
   }else{
    
     
    $("#ShowSupplierONPrint2").css("visibility","hidden");  
   }

      
 window.print();
		  

      
});
    
    
    
    
    $("#ToolTables_tbl-endDealBills_4").on("click", function(){

           $("table").css("width","100%");
            $("#search-enddealbills").addClass("hide");
		    //check chosen customer name
//            $("#check_enable").css("visibility","hidden"); 
//            $("#check_label").css("visibility","hidden");
		    $("#check_Customers").css("visibility","hidden");
		    //checkbox to view customer name 
		    $("#check").css("visibility","hidden");
		    $("#check_Customers").css("visibility","hidden");
		
            $
            $("#hideinprint").css("display","none");
        
       $("#ShowCustomerONPrint11").css("display","block");
        $("#ShowSupplierONPrint2").css("display","block");
      
      
   if($("#check_Customers").is(":checked")) 
   {
    	$("#ShowCustomerONPrint11").css("visibility","visible"); 
   }else{
    
     
    $("#ShowCustomerONPrint11").css("visibility","hidden");  
   }
		  
		  	  if($("#check_Supplirs").is(":checked")) 
   {
    	$("#ShowSupplierONPrint2").css("visibility","visible"); 
   }else{
    
     
    $("#ShowSupplierONPrint2").css("visibility","hidden");  
   }

      
 window.print();
		  
        
        
        
}); 
    
    $("#ToolTables_tbl-EndofCustomersStatment_4").on("click", function(){

        
           $("table").css("width","100%");
            $("#search-enddealbills").addClass("hide");
		    //check chosen customer name
//            $("#check_enable").css("visibility","hidden"); 
//            $("#check_label").css("visibility","hidden");
		    $("#check_Customers").css("visibility","hidden");
		    //checkbox to view customer name 
		    $("#check").css("visibility","hidden");
		    $("#check_Customers").css("visibility","hidden");
		
            $
            $("#hideinprint").css("display","none");
        
       $("#ShowCustomerONPrint11").css("display","block");
        $("#ShowSupplierONPrint2").css("display","block");
      
      
   if($("#check_Customers").is(":checked")) 
   {
    	$("#ShowCustomerONPrint11").css("visibility","visible"); 
   }else{
    
     
    $("#ShowCustomerONPrint11").css("visibility","hidden");  
   }
		  
		  	  if($("#check_Supplirs").is(":checked")) 
   {
    	$("#ShowSupplierONPrint2").css("visibility","visible"); 
   }else{
    
     
    $("#ShowSupplierONPrint2").css("visibility","hidden");  
   }

      
 window.print();
		  
        
        
        
});
    
    
     
    
});










  function PrintEndBills(){
   
    $("#search-enddealbills").addClass("hide");
    $(".DTTT").addClass("hide");
//    $("#tbl-SupplierReport_filter").addClass("hide");
    $(".dataTables_length").addClass("hide");
    $(".dataTables_filter").addClass("hide");
    $(".pagination").addClass("hide");
    $(".panel-heading").addClass("hide");
    $(".box-header").addClass("hide");
    $(".content-header").addClass("hide");
    $(".main-header").addClass("hide");
    $(".sidebar-menu").addClass("hide");
    $(".dataTables_info").addClass("hide");
    
    $("#dataTables_filter").addClass("hide");

   
//	 $("#ForeignSuppliersID_chosen").css("display","none");
//	 $("#hideinprint").css("display","none");
	  
	 
	   $("#ShowCustomerONPrint11").css("display","block");
        $("#ShowSupplierONPrint2").css("display","block");  
		
	   if($("#check_Customers").is(":checked")) 
   {
    	$("#ShowCustomerONPrint11").css("visibility","visible"); 
   }else{
    
     
    $("#ShowCustomerONPrint11").css("visibility","hidden");  
   }	 
	  
	  if($("#check_Supplirs").is(":checked")) 
   {
    	$("#ShowSupplierONPrint2").css("visibility","visible"); 
   }else{
    
     
    $("#ShowSupplierONPrint2").css("visibility","hidden");  
   }
	  
	 window.print();
  }
	


	 $(document).keyup(function(e) {

//alert("00");
      if (e.keyCode == 27) {
//		 alert("a7aaaa");
        $("#search-enddealbills").removeClass("hide");
		 
        $(".DTTT").removeClass("hide");
		 
//        $("#tbl-SupplierReport_filter").removeClass("hide");
		 
        $(".dataTables_length").removeClass("hide");
		 
        $(".dataTables_filter").removeClass("hide");
		 
        $(".pagination").removeClass("hide");
		 
        $(".panel-heading").removeClass("hide");
		 
        $(".box-header").removeClass("hide");
		 
        $(".content-header").removeClass("hide");
		 
        $(".main-header").removeClass("hide");
		 
        $(".sidebar-menu").removeClass("hide");
		 
//        $("#hideinprint").css("display","block");
		 
        $(".dataTables_info").css("display","block");
		 
		 $("#print").css("display","block");
		 
		 $("#ShowCustomerONPrint11").css("display","none");
        $("#ShowSupplierONPrint2").css("display","none")  
   
        $("#dataTables_filter").removeClass("hide");
		  
	   if($("#check_Customers").is(":checked")) 
   {
    	$("#ShowCustomerONPrint11").css("visibility","visible"); 
   }else{
    
     
    $("#ShowCustomerONPrint11").css("visibility","hidden");  
   }
		  
		  	  if($("#check_Supplirs").is(":checked")) 
   {
    	$("#ShowSupplierONPrint2").css("visibility","visible"); 
   }else{
    
     
    $("#ShowSupplierONPrint2").css("visibility","hidden");  
   }

    
}


});


$(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#search-enddealbills").prop("disabled",false);
});
});
	







