var crrying = function () {};
$(function(){ _crrying = new crrying() });

$(document).ready(function() {
 $('#search-crrying').click(function(){
     
     $(this).prop("disabled",true);
     _crrying.searchfortables();
    });                  
});

$(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#search-crrying").prop("disabled",false);
});
});
	


$(document).ready(function() {
$( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        }); 
	 $( ".datepicker" ).datepicker("setDate", new Date());
   
   });


$(document).ready(function(){

    // $('#tbl-customeropeningbalance').DataTable();

     $("#CustomersID").select2({
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

});

$(document).ready(function(){
$("#check_prodcut").click(function(){
   if($(this).is(":checked")) 
   {
   $("#ProductType").prop("disabled",false); 
   }else{
    
    $("#ProductType").prop("disabled",true)
  
   }
         if($(this).is(":checked")) 
   {
      $("#ProductType").prop("disabled",false) 
   }

});
});



crrying.prototype.searchfortables = function(){
    
 var t = $('#tbl-crrying').DataTable();
    
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
            url: "loadcrrying",
            type: "post",
            data: $('#crrying-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
           console.log(output);

            var input=$('#crrying-repo-form :input');
              console.log($('#crrying-repo-form :input'));
             var x= input[2].value;
//             var y= input[4].value;
             var p= input[4].value;
            console.log(p);    
//         
   
                
             var cboCustomerID = $( "#CustomersID" ).clone();
            $(cboCustomerID).val(x);
             var text= $('option:selected',cboCustomerID).text();

//             var cboSupplierID = $( "#TotalSupplierID" ).clone();
//             $(cboSupplierID).val(y);
//             var text2 =  $('option:selected',cboSupplierID).text() ;
            
            
               var productID = $( "#ProductType" ).clone();
             $(productID).val(p);
             var text3 =  $('option:selected',productID).text(); 
//            console.log(text3)
            
            
            
            

//             $("#ShowCustomerONPrint1").text("اسم التاجر:"+text);
////             $("#ShowSupplierONPrint1").text("اسم المورد:"+text2);
//             $("#ShowProuduct").text("نوع البضاعة :"+text3);
//            
            
//            console.log($('#onecustomer-repo-form :input'));
            var obj = eval (output);
            console.log(output);
var final = 0; 
            
            var obj = eval (output);
//             var old_Mark = 0;
            for (var i = 0; i < obj.length; i++) {
                
//			total=obj[i].Total;
//               
//			carry=obj[i].Carrying;
//                
//			custd=obj[i].Custody;
//                
//			nol=obj[i].Nowlon;
//                
//			dis=obj[i].Discount;
//                 console.log(dis);
			
//			first = total + carry +nol+custd;
//			console.log("-----");
//			console.log(carry);
//			console.log("-----");
//			finaltotal = first - dis;
//				
//var cls_sum_discount = ""
//var cls_sum_Nolown = ""
//var cls_sum_Custody = ""



//                  if (old_Mark != obj[i].RefNo)
//                {
//                    old_Mark = obj[i].RefNo ;
//                    tDiscount+=obj[i].Discount;
//                     tNowlon+=obj[i].Nowlon;
//                    tCustody+=obj[i].Custody;
//                     cls_sum_discount = "sum_discount";
//                     cls_sum_Nolown="sum_nowlon";
//                     cls_sum_Custody="sum_custody";
//                }
                
                
                  if ( obj[i].ProductType == 0)  {

                
                 text = '<tr><td class="Sdate" style="display:none">'+obj[i].SalesDate+'</td>'+
//					 	'<td class="hidecombine">'+obj[i].ProductName+'</td>'+
                     '<td class="type" style="display:none">'+obj[i].CustomerType+'</td>'+
					 	
//					 	'<td class="hidecombine Refno">'+obj[i].RefNo+'</td>'+
					 	'<td style="display:none" class="Cname">'+obj[i].CustomerName+'</td>'+
                      
//                        '<td class="hidecombine">'+obj[i].ProductPrice+'</td>'+
					 
                         '<td class="hidecombine protype" style="display:none">محـلي</td>'+
//                         '<td class="sum_Total sum hidecombine">'+obj[i].Total+'</td>'+
                     	'<td class="sum_carrying sum" style="display:none">'+obj[i].Carrying+'</td>'+'</tr>'; 
                      
							} else if ( obj[i].ProductType > 0 ){
                
                        text = '<tr><td class="Sdate" style="display:none">'+obj[i].SalesDate+'</td>'+
//					 	'<td class="hidecombine">'+obj[i].ProductName+'</td>'+
                     '<td class="type"style="display:none" >'+obj[i].CustomerType+'</td>'+
					 	
//					 	'<td class="hidecombine Refno">'+obj[i].RefNo+'</td>'+
					 	'<td style="display:none" class="Cname">'+obj[i].CustomerName+'</td>'+
                      
//                        '<td class="hidecombine">'+obj[i].ProductPrice+'</td>'+
					 
                         '<td class="hidecombine protype" style="display:none">مستورد</td>'+
//                         '<td class="sum_Total sum hidecombine">'+obj[i].Total+'</td>'+
                     	'<td class="sum_carrying sum" style="display:none">'+obj[i].Carrying+'</td>'+'</tr>'; 
                
                        }		

                    
                
                t.row.add( $(text) ).draw();
              
                
//                console.log(obj[i].Discount);
                   
//                       tNowlon=obj[i].Nowlon;
//                    tCustody=obj[i].Custody;
//                    tDiscount=obj[i].Discount;
//                    tcc+=obj[i].Carrying;
//                    type=obj[i].CustomerType;
//                    tTotal += obj[i].Total
//                    console.log(obj[i].CustomerType);
//                    final = tTotal + tCarrying + tNowlon + tCustody 
//                    totalfinal = final - tDiscount ;
//                    totalfinal =Math.round(totalfinal);
                final +=  obj[i].Carrying;
                final =Math.round(final);
            } //end for 
                      
//            console.log(final);
                  document.getElementById("totaltest").innerHTML =' اجمالى المشال : '+final;      

//       _crrying.CheckTotal2();
       
       }).error(function (data) {
        showError('',data);
        }); 
    
    
    
	}// end serach for tables 
    
    $(document).ready(function() {
//        var table = $('#tbl-onecustomer').DataTable({dom: 'T<"clear">lfrtip'});
	  var table = $('#tbl-crrying').DataTable({
//		          "columnDefs": [
//            { "visible": false, "targets": 2 },
//      
//        ],
        dom: 'T<"clear">lfrtip',
         buttons: [
        'copy', 'excel', 'pdf'
    ],
        //  "tableTools": {
            // "sSwfPath": "../swf/copy_csv_xls_pdf.swf",
            // "sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",
        // },
//         'oTableTools' : {
//     'aButtons': ['copy', 'csv', 'pdf', 'print']
// },
                "order": [[ 0, 'asc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {

                  $(rows).eq( i ).before(
                  '<tr  style="display:none" class="group"><td colspan="4">'+group+'</td></tr>'
                    );
 
                    last = group;
                }

			});	
            
         
     $('#tbl-crrying tbody').find('.group').each(function(i, v) {
                            var rowCount = $(this).nextUntil('.group').length;
//                            var Cname = ''; 
                            // console.log("####");
                            var total_sum = 0;
                            var date = '';
                            var prototype = '';
                            $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                total_sum = total_sum + parseFloat($(this).find(".sum").text());
                                
//                                  document.getElementById("totaltest").innerHTML =' اجمالى المشال : '+total_sum;      
//                                 T_carrying=T_carrying+parseFloat($(this).find(".sum_carrying").text());
                                total_sum =Math.round(total_sum)
                               
                                //date 
                                date = $(this).find(".Sdate").text();
                                prototype = $(this).find(".protype").text();
                                Cname = $(this).find(".Cname").text();
//                                console.log(Cname);
                            });
//console.log(total_sum);
                            // console.log(total_sum);
                            // console.log("####");
                             if ($(this).nextUntil('.group').next())
                             {
                                 // console.log($(this).nextUntil('.group').last());
                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter"> <td>التاريخ: '+date+'</td><td>اسم التاجر :'+Cname+'</td><td>نوع البضاعة :'+prototype+' </td><td colspan="">'+"مجموع المشال : "+total_sum+'</td></tr>')
                             }
        
        
         
        
        
        });
                                                       
        }
                                                       
                                                       
        });
        });

    // Order by the grouping
    $('#tbl-crrying tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
            table.order( [ 2, 'desc' ] ).draw();
        }
        else {
            table.order( [ 2, 'asc' ] ).draw();
        }
    } );
    






$(document).ready(function(){

 $("#ToolTables_tbl-crrying_4").click(function(){
$("br").addClass("hide");
        $("table").css("width","100%");
        $("#search-crrying").addClass("hide");
		
        $("#check_customer").css("display","none");
		$("#check_customers").css("display","none");    
       
		$('#hideinprint').css("display","none");
		
        $("#ShowCustomerONPrint1").css("display","block"); 
//         $("#ShowSupplierONPrint1").css("display","block"); 
         $("#ShowProuduct").css("display","block"); 

		
       if($("#check_customers").is(":checked")) 
   {
//              $("#ShowProuduct").css("visibility","visible");
//             $("#ShowProuduct").css("visibility","hidden"); 
      $("#ShowCustomerONPrint1").css("visibility","visible"); 
    	
   }else{
       
       $("#ShowProuduct").css("visibility","hidden"); 
//       $("#ShowProuduct").css("visibility","visible"); 
         $("#ShowCustomerONPrint1").css("visibility","visible"); 

   }
	
     
		  window.print();


        })    
    
    
      $(document).keyup(function(e) {
        if (e.keyCode == 27) {
            $("br").removeClass("hide");
        $("table").css("width","100%");        
        $("#search-crrying").removeClass("hide");
	    $("#check_customer").css("display","block");
		$("#check_customers").css("display","block");  		
			
			$('#hideinprint').css("display","block");
        
//        $("#TotalCustomersID1_chosen").css("display","block");
//        $("#TotalSupplierID_chosen").css("display","block"); 
//          
	
        $("#ShowCustomerONPrint1").css("display","none"); 
         $("#ShowSupplierONPrint1").css("display","none"); 
         $("#ShowProuduct").css("display","none"); 

        
    if($("#check_customers").is(":checked")) 
   {
              $("#ShowProuduct").css("visibility","visible");
//             $("#ShowProuduct").css("visibility","hidden"); 
      $("#ShowCustomerONPrint1").css("visibility","visible"); 
    	
   }else{
       
       $("#ShowProuduct").css("visibility","hidden"); 
//       $("#ShowProuduct").css("visibility","visible"); 
         $("#ShowCustomerONPrint1").css("visibility","visible"); 

   }
	
    
             if(checkRadio == 1){
            $("#Combine").css("visibility","visible");
            $("#comb2").css("visibility","visible");  
        }
        else{
            $("#Individuale").css("visibility","visible");
            $("#indi2").css("visibility","visible");
        }
         

	          
        }
     });
    



} );


crrying.prototype.CheckTotal2 = function(){
 
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-crrying tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals+=parseFloat( $(this).html());
//                    console.log(totals);
//                    console.log("AAAAAAAAAAAAAA");
                });
            });
            $("#tbl-crrying th.sumcr").each(function(i){  
                $('.sumcr').html("اجمالى المشال :"+totals[i]);
                console.log(  $('.sumcr').html("اجمالى المشال :"+totals[i]));
            });
 
}









