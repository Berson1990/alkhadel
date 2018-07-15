var deferredbills = function () {};
 
$(function(){ _deferredbills = new deferredbills() });


 $(document).ready(function() {
$("#SuppliersID").select2({
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
        $("#abordCustomersID").select2({
            placeholder: "Search for an Customer Name",
              ajax: {
                url: 'autocompleteCustomer',
//				  autocompleteCustomer
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

//============combine and indvudial start
function individuale(){
checkRadio=1;
}


function combine(){
checkRadio=2;
}
//============combine and indvudial end 

$(document).ready(function() {
 $('#search-deferredbills').click(function(){
      $(this).prop("disabled",true);
        _deferredbills.searchfortables();
    });                  
});
function getCustomerName(CustomersID)
    {   
        var cboCustomerID = $( "#abordCustomersID" ).clone();
        $(cboCustomerID).val(CustomersID);

        return $('option:selected',cboCustomerID).text() ; 
    }

function getSupplierName(SupplierID)
    {
        var cboSupplierID = $( "#SuppliersID" ).clone();
        $(cboSupplierID).val(SupplierID);
         
        return $('option:selected',cboSupplierID).text() ; 
//		console.log($('option:selected',cboSupplierID).text());
    }

//function to enble and disaple combobox end 

$(document).ready(function(){
$("#check_chose_Supplisrs").click(function(){
   if($(this).is(":checked")) 
   {
   $("#SuppliersID").prop("disabled",false); 
   }else{
    
    $("#SuppliersID").prop("disabled",true).trigger("chosen:updated");  
  
   }
         if($(this).is(":checked")) 
   {
      $("#SuppliersID").prop("disabled",false).trigger("chosen:updated");   
   }

});
});


deferredbills.prototype.searchfortables = function(){
 var t = $('#tbl-deferredbills').DataTable();
    
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
 
	


//     var t = $('#tbl-deferredbills').DataTable();
 
 		console.log($('#deferredbills-repo-form :input'));
        $.ajax({
            url: "dBills",
            type: "post",
            data: $('#deferredbills-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
 
          .done(function (output) {
		
		     var obj = eval (output);
			setobj (obj);	
			obj2=obj
//            console.log(output);
 
		var input=$('#deferredbills-repo-form :input');
           
		console.log($('#deferredbills-repo-form :input'));

   

			
             var x= input[2].value;
             var y= input[4].value;

            

               console.log(y);            
               console.log(x);      
     var cboCustomerID = $("#abordCustomersID").clone();
      var cboSupplierID = $("#SuppliersID").clone();
      
        $(cboCustomerID).val(x);
         $(cboSupplierID).val(y);

//             var cboCustomerID = $( "#abordCustomersID" ).clone();
//                 $(cboCustomerID).val(x);   
//             var text=getCustomerName(x);       
//         console.log(text);
//		     var text= $('option:selected',cboCustomerID).text() ;
		     // var text=getCustomerName(x);
       //  var text2=getSupplierName(y);
       var text = $('option:selected',cboCustomerID).text() ; 
       var text2 = $('option:selected',cboSupplierID).text() ; 
        console.log(text);
			  console.log(text2);   

          // var text = $('option:selected',cboCustomerID).text() ; 
          // var text2 = $('option:selected',cboCustomerID).text() ; 

             $("#ShowCustomersONPrint101").text("اسم التاجر:"+text);
             $("#ShowSuppliersONPrint102").text("اسم المورد:"+text2);

			
			   $.ajax({
            url: "endoutdeal",
            type: "post",
            data: $('#deferredbills-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
				   

            
				    var obj = eval (output); 
//    		 console.log(obj2[);
				   	 
//				var endtime=obj.data.created_at;
//				var salestime=obj2.SalesDate;
//            var obj = eval (output);			   
				        
			
				
				  
            for (var i = 0; i < obj2.length; i++) {
			
				var oneDay = 24*60*60*1000; 
				 	 var d =new Date(); 
//				   console.log(d);
			      salestime=obj2[i].SalesDate;
				var parts = salestime.split('-');
				//alert(Date(parts[0], parts[1]-1, parts[2]));
				//alert(salestime);
				var salesDate = new Date(salestime); //new Date(parts[1],parts[2],parts[0]);
				 dtime =Math.round((d-salesDate)/(1000*60*60*24))+" يوم";
//				  console.log(salestime);


//				  dtime=  Math.abs(d-salestime); 
//				 	console.log(dtime);
				  
				var x=0;
				for (var j = 0; j < obj.length; j++) {
					if(obj2[i].SalesID == obj[j].SalesID){x=1; break;}
				}
                     if (x==1){continue;}
					
				else{
					
                           
//          $(".whendcombine").addClass("hide");

                        
				   text = '<tr><td>'+obj2[i].SalesDate+'</td>'+
                        '<td >'+obj2[i].RefNo+'</td>'+
                        '<td class="whendcombine">'+obj2[i].ProductName+'</td>'+
                        '<td >'+obj2[i].CustomerName+'</td>'+
                        '<td >'+obj2[i].SupplierName+'</td>'+
                        '<td class="sum">'+obj2[i].Total+'</td>'+
                        '<td>'+dtime+'</td>'+'</tr>';
					   
			
                t.row.add( $(text) ).draw();
						  
						  
				}//end if of deferedbills 
			    _deferredbills.CheckTotal();
			}
				   
				   
				   
		
		 }).error(function (data) {
        showError('',data);
        }); 	
		 
		
	  }).error(function (data) {
        showError('',data);
        }); 
}

obj2=0;
function setobj (data)
{
obj2=data

}

$(document).ready(function() {
    
    var table = $('#tbl-deferredbills').DataTable({
        dom: 'T<"clear">lfrtip',
        "sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",
        "columnDefs": [
        { "visible": false, "targets": 0 },
          
        ],
        "order": [[ 0, 'asc' ]],
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
			
                        //========================just for test========================
            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                
      

       
                if ( last !== group ) {

                  $(rows).eq( i ).before(
                  '<tr  style="display:none;" class="group"><td colspan="7">'+group+'</td></tr>'
                    );
 
                    last = group;
                }

			});
              $('#tbl-deferredbills tbody').find('.group').each(function(i, v) {
         
                      
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
//                                 console.log($(this).nextUntil('.group').last());
//                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td colspan="4"> </td><td style="background: #eff1f1;" colspan="1">'+"الاجمالى : "+total_sum+'</td> <td> </td> </tr>')
                                 
                                 
                                 
                             }


                        });  
                             //========================just for test========================

            
				   
                    
                
     $('#tbl-deferredbills tbody').find('.group').each(function(i, v) {
         
                      
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
                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td colspan="4"> </td><td style="background: #eff1f1;" colspan="1">'+"الاجمالى : "+total_sum+'</td> <td> </td> </tr>')
                                 
                                 
                                 
                             }


                        });
            
            //========================just for test========================
//            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
//                
//      
//
//       
//                if ( last !== group ) {
//
//                  $(rows).eq( i ).before(
//                  '<tr class="group"><td colspan="7">'+group+'</td></tr>'
//                    );
// 
//                    last = group;
//                }
//
//			});
//              $('#tbl-deferredbills tbody').find('.group').each(function(i, v) {
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
////                                 console.log($(this).nextUntil('.group').last());
////                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td colspan="4"> </td><td style="background: #eff1f1;" colspan="1">'+"الاجمالى : "+total_sum+'</td> <td> </td> </tr>')
//                                 
//                                 
//                                 
//                             }
//
//
//                        });  
                             //========================just for test========================


            
        }
    });
});















//
	$(document).ready(function() {
//        var table = $('#tbl-deferredbills').DataTable({dom: 'T<"clear">lfrtip'})
		
    $("br").addClass('hide');
    $("#ToolTables_tbl-deferredbills_4").click(function(){
        $("#tbl-deferredbills").css("width","100%");
        $("#search-deferredbills").addClass("hide");
		
        $("#check_chose_Supplisrs").addClass("hide");
		$("#chosen_SuppliersName").addClass("hide");   
       
//		$("#abordCustomersID_chosen").css("display","none");
	$('#print').css("display","none");
	

        $("#ShowCustomersONPrint101").css("display","block"); 
         $("#ShowSuppliersONPrint102").css("display","block");    
		
   if($("#check_chose_Supplisrs").is(":checked")) 
   {
    	$("#ShowCustomersONPrint101").css("visibility","visible"); 
         $("#ShowSuppliersONPrint102").css("visibility","visible"); 
   }else{
    
      $("#ShowCustomersONPrint101").css("visibility","visible"); 
      $("#ShowSuppliersONPrint102").css("visibility","hidden"); 
   }
	
		 window.print();
	});   


    
      $(document).keyup(function(e) {
        if (e.keyCode == 27) {
           $("br").removeClass('hide');
            
        $("#tbl-deferredbills").css("width","100%");        
        // $("#search-deferredbills").css("visibility","visible");
			  $("#search-deferredbills").removeClass("hide");
	    $("#check_chose_Supplisrs").removeClass("hide");
		$("#chosen_SuppliersName").removeClass("hide");  		
			
        
//        $("#abordCustomersID_chosen").css("display","block");
//        $("#SuppliersID_chosen").css("display","block"); 
          	$('#print').css("display","block");
	
        $("#ShowCustomersONPrint101").css("display","none");
         $("#ShowCustomersONPrint102").css("display","none");

        
       if($("#check_chose_Supplisrs").is(":checked")) 
       {
            $("#ShowCustomersONPrint101").css("visibility","hidden"); 
             $("#ShowSuppliersONPrint102").css("visibility","hidden"); 
       }else{
        
      $("#ShowCustomersONPrint101").css("visibility","hidden"); 
      $("#ShowSuppliersONPrint102").css("visibility","hidden"); 
	   }
    }
});
    
 }); 
 




	
deferredbills.prototype.CheckTotal = function(){
//  alert("aaaaaaaaaaaaaa");
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-deferredbills tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
//					console.log("00000");
                });
            });
            $("#tbl-deferredbills th.totaldefebill").each(function(i){  
                $('.totaldefebill').html("اجمالى المبلغ :"+totals[i]);
//				console.log( totals[i]);
            });

}

 $(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#search-deferredbills").prop("disabled",false);
});
});
	
