
var dailycashier = function () {};
 
$(function(){ _dailycashier = new dailycashier() }); 




$(document).ready(function(){

 $('#search-dailycashier').click(function(){

 	// alert("sfgadf;khjdafk;hj;dfkhj;ldfkhj");
         _dailycashier.searchfortables();
       // $("#search-settlementcashier").prop("disabled",true);
    });



// date Picker 
      $( ".datepicker" ).datepicker({
  dateFormat: 'yy/mm/dd',
   currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
 });

$(".datepicker").datepicker('setDate', new Date());
	

$("#cboCashierID").select2({
            placeholder: "Search for an cashier Name",
            ajax: {
                url:'cachierautocomplete',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                type : 'post',
                data: function (params) {
                    var queryParameters = {
                        CashierName: params.term
                    }
                    return queryParameters;
                },
                processResults: function (output) {
                    if (output.status){
                        return {
                            results: $.map(output.data, function (item) {
                                return {
                                    text: item.CashierName,
                                    id: item.CashierID,
                                    cachierAccount : item.CashierAccountID
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

function getCashierName(CashierID)
    {
        var cboCashierID = $( "#cboCashierID" ).clone();
        $(cboCashierID).val(CashierID);

        return $('option:selected',cboCashierID).text() ; 
    }

dailycashier.prototype.searchfortables =function(){
	

		input=$('#settlementcashier-repo-form :input');

console.log(input);
			     var x= input[1].value;
			     console.log(x);
			 	 var text=getCashierName(x);

		  console.log(text);
		$("#showCshierName").text("اسم الخزنه: "+text);	
 	
 var dailycashier = $('#tbl-dailycashier').DataTable();
    
    try
    {
    dailycashier
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
   var TransDate= '';
    var TodayMount = 0;
        $.ajax({
            url: "dailyCashierclosed",
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data:  $('#settlementcashier-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "="), 
            dataType: "json"
        }).done(function (output) {

        	               // obj =output;
        		// console.log("قيمة الخزنة الحاليه  "+ obj);
						// Ftotal = +obj + +paymentbefore;
						console.log("نهائى اليوم فى الخزنة " +output); 

						  
						TransDate = $("#fromdate1").val();
						TodayMount = output;
						console.log(TransDate)

        	     	            text ='<tr><td class="">'+TransDate+'</td>'+
				             '<td class="">'+TodayMount+'</td>'+'</tr>';


 				dailycashier.row.add( $(text) ).draw(); 


        					   // for (var i = 0; i < obj.length; i++) 
		 // { 			

		  
		 // 						if(obj[i].inc){
   //      			   text ='<tr><td class="Date ">'+obj[i].TransDate+'</td>'+
   //                           '<td class="inc ">'+obj[i].inc+'</td>'+
			// 	             '<td class="decrise hide">0</td>'+'</tr>';
				             
				             
			// 	                // console.log("inc "+obj[i].inc);
			// 	             	}else{
			// 	             	 text ='<tr><td class="Date ">'+obj[i].TransDate+'</td>'+
   //                           '<td class="inc ">0</td>'+
			// 	             '<td class="decrise ">'+obj[i].decrise+'</td>'+'</tr>';
				            
				                 
	// }


	        
        // }



 }).error(function (data){
        showError('',data);
        }); 



//  	$.ajax({
//             url: "cashiermountNow",
//             headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
//             type: "post",
//             data:  $('#settlementcashier-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "="), 
//             dataType: "json"
//         }).done(function (output) {

//         	// console.log(output);

//        Mount = eval(output);
//        before(Mount);
        
//        $("#beforDay").val(Mount);
     



// }).error(function (data){
//         showError('','من فضلك اختار الخزنة');
//         }); 




} // end of function 


$(document).ready(function() {

$(".noraml").addClass("hide");
/*fist Table*/
   var table3 = $('#tbl-dailycashier').DataTable({
        dom: 'T<"clear">lfrtip',
        // "columnDefs": [
        //     { "visible": false, "targets": 1 }
        // ],
        "order": [[ 0, 'asc' ]],
        // "displayLength": 200,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
 

            $(".noraml").addClass("hide");
           
            //         // alert("combine");
            //     api.column(0, {page:'current'} ).data().each( function ( group, i ) {
            //     if ( last !== group ) {
            //         $(rows).eq( i ).before(
            //             '<tr  class="hide group"><td colspan="4">'+group+'</td></tr>'
            //         );
 
            //         last = group;
            //     }
            // });

            //     	                api.column(1, {page:'current'} ).data().each( function ( group, i ) {
            //     if ( last !== group ) {
            //         $(rows).eq( i ).before(
            //             '<tr  class="hide group"><td colspan="4">'+group+'</td></tr>'
            //         );
 
            //         last = group;
            //     }
            // });
            //                 api.column(2, {page:'current'} ).data().each( function ( group, i ) {
            //     if ( last !== group ) {
            //         $(rows).eq( i ).before(
            //             '<tr  class="hide group"><td colspan="4">'+group+'</td></tr>'
            //         );
 
            //         last = group;
            //     }
            // });


            
//      finaltotal = 0;
//     $('#tbl-dailycashier tbody').find('.group').each(function(i, v) {
//                            var rowCount = $(this).nextUntil('.group').length;
// 						var befor = 0 ;
// 						var finaltotal2 = 0 ;
//                            // console.log("####");
//                            var incsum = 0;
//                            var dec = 0 ;
//                            var DateDay = '';
//                            // var exname='';
//                            $(this).nextUntil('.group').each(function() {
// //                                console.log($(this));
// //                                console.log($(this).find(".sum").text());
//                                 DateDay= $(this).find(".Date").text();
//                                 // exname=$(this).find(".ename").text();

                                        							
//    									 incsum = incsum + parseFloat($(this).find(".inc").text());
//                                         // console.log(incsum);
//           					       dec = dec + parseFloat($(this).find(".decrise").text());
//           					       console.log(dec);
                      
//                       				// befor = $("#beforDay").val();
//                       				// console.log(befor);


//                                  finaltotal =  incsum - dec ; 
//                                  finaltotal2 = finaltotal + paymentbefore;
//                                  console.log(finaltotal2);

                                

//                            });


//                             if ($(this).nextUntil('.group').next())
//                             {
//                                 // console.log($(this).nextUntil('.group').last());
//                                 $(this).nextUntil('.group').last().after('<tr class="m2h22"><td> التاريخ :'+DateDay+'</td><td class="">'+" نهائى اليوم :"+finaltotal2+'</td></tr>')
                              
//                                 // sum(row,cloumn)																									
//                             }

//                             		//   $('#tbl-dailycashier tbody').find('.group').each(function(){
//                               // var rowobj =$('<tr class="m2h22"><td> التاريخ :'+DateDay+'</td><td class="before">'+" نهائى اليوم :"+finaltotal+'</td></tr>')
//                               //   var colobj = $(rowobj).children()[1];

//                               //   // console.log(colobj);
//                               //      });
//                        });
        


           
            
        }
    });  

   });  


 function sum(row,cloumn){
    $("#tbl-dailycashier").

    $( "#tbl-dailycashier tr:nth-child($(row)) td:nth-child($(cloumn))" ).text();

    }
// 	paymentbefore=0;
// 	function before(data){
     
// paymentbefore = data;
// console.log("قيمة الخزنة سابقا وحتى اليوم " + paymentbefore);
// 	}

  $(document).ready(function(){

$("#ToolTables_tbl-dailycashier_4").click(function(){
$("br").addClass("hide");
            
            $("#search-dailycashier").addClass("hide");
            $("#showCshierName").removeClass("hide"); 
             $("#hideinprint").addClass("hide");;

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").addClass("hide");
           $("#check_customers").addClass("hide");   
       
           // $('#hideinprint').addClass("hide");
        
            $("#ShowCustomerONPrint1").css("display","block"); 
             $("#ShowSupplierONPrint1").css("display","block"); 
            $("#Showprouduct").css("display","block"); 

    
     
     window.print();
    

  })

});


     $(document).keyup(function(e) {
        if (e.keyCode == 27) {
              $("br").removeClass("hide");
          $("#search-dailycashier").removeClass("hide");   
        $("table").css("width","100%");        
        $("#search-onecustomer").css("visibility","visible");
        $("#check_customer").css("display","block");
        $("#check_customers").css("display","block");       
            
            $('#hideinprint').removeClass("hide")
     
       $("#showCshierName").addClass("hide"); 
        $("#ShowCustomerONPrint1").css("display","none"); 
         $("#ShowSupplierONPrint1").css("display","none"); 
         $("#Showprouduct").css("display","none"); 

       
    
      

              
        }
     });

   