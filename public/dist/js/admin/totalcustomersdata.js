var totalcustomersdata = function () {};

$(function(){ _totalcustomersdata = new totalcustomersdata(); });

$("#rbtnIndividuale").click(function() {

    $("#tbl-finalData").css("display","inline-table");
});

$(document).ready(function() {
 $('#search-totalcustomersdata').click(function(){
 $(this).prop("disabled",true);
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

$(document).ready(function() {
      $("#TotalCustomersID").select2({
            placeholder: "Search for an Supplier Name",
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

checkbox2=1;

function getCustomerName(CustomerID)
    {

        var cboCustomerID = $("#TotalCustomersID").clone();
		 
        $(cboCustomerID).val(CustomerID);

        return $('option:selected',cboCustomerID).text() ; 
    }
 

$('#check_enable2').change(function(){

//    document.getElementById("check_enable2").setAttribute("name", "");
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
   
 var t = $('#tbl-totalcustomersdata').DataTable();
    
    try
    {
    t
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");

    }
           
        $.ajax({
            url: "loadTotalCustomersData",
            type: "post",
            data: $('#totalcustomersdata-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
       
          .done(function (output) {
            
           
        var input=$('#totalcustomersdata-repo-form :input');

            var x= input[3].value;
            var p= input[4].value;

             
			
			 var cboCustomerID = $("#TotalCustomersID").clone();
		 
        $(cboCustomerID).val(x);

        var text = $('option:selected',cboCustomerID).text() ; 

            
            var cboCustomerID = $("#TotalCustomersID").clone();
		 
        $(cboCustomerID).val(x);

        var text = $('option:selected',cboCustomerID).text() ; 

            
            
                  var productID = $( "#ProductType" ).clone();
             $(productID).val(p);
             var text3 =  $('option:selected',productID).text() ; 

            
            
   $("#Showprouduct2").text("نوع البضاعة :"+text3);
			
     
            
            $("#ShowONPrint").text("اسم المورد:  "+text);
            var tTotal = 0 
            var obj = eval (output);

            var tNowlon=0;
            var tCustody=0;
            var tDiscount=0;
            var tCarrying=0;
            var type=null;
            var first_total=0;
            var old_Mark = 0;
            var final = 0; 
            var totalfinal = 0; 
            
               for (var i = 0; i < obj.length; i++) {
                  
                   
var cls_sum_discount = ""
var cls_sum_Nolown = ""
var cls_sum_Custody = ""
//    var T_Total=0;
//   var T_nowlon=0; var T_discount=0; var T_carrying=0; var T_custody=0;


                  if (old_Mark != obj[i].RefNo)
                {
                     old_Mark = obj[i].RefNo ;
                     tDiscount+=obj[i].Discount;
                     tNowlon+=obj[i].Nowlon;
                     tCustody+=obj[i].Custody;
                     cls_sum_discount = "sum_discount";
                     cls_sum_Nolown="sum_nowlon";
                     cls_sum_Custody2="sum_custody2";
                }
                
                  
                        if (obj[i].ProductType == 0) {
                text = '<tr><td class="salesDate hide">'+obj[i].CustomerName+'</td>'+
                   	    '<td  class="protype" style="display:none">محلى</td>'+
                        '<td style="display:none" class="sum_Total sumfirst">'+obj[i].Total+'</td>'+
                        '<td class="Refno" style="display:none">'+obj[i].RefNo+'</td>'+
                        '<td  style="display:none">'+obj[i].SalesDate+'</td>'+
                        '<td class="sum_carrying"style="display:none">'+obj[i].Carrying+'</td>'+
                        '<td class="'+ cls_sum_Nolown +'" style="display:none">'+obj[i].Nowlon+'</td>'+	
				        '<td class="'+ cls_sum_Custody2 +'" style="display:none">'+obj[i].Custody+'</td>'+
					 	'<td class="'+ cls_sum_discount  +'" style="display:none">'+obj[i].Discount+'</td>'+	
                        '<td class="type" style="display:none">'+obj[i].CustomerType+'</td>'+ '</tr>';
                
                        }else{
                    text = '<tr><td class="salesDate hide">'+obj[i].CustomerName+'</td>'+
                   			'<td class="protype" style="display:none" >مستورد</td>'+
                            '<td style="display:none" class="sum_Total">'+obj[i].Total+'</td>'+
                            '<td class="Refno" style="display:none">'+obj[i].RefNo+'</td>'+
                            '<td  style="display:none">'+obj[i].SalesDate+'</td>'+
                            '<td class="sum_carrying"style="display:none">'+obj[i].Carrying+'</td>'+
                            '<td class="'+ cls_sum_Nolown +'" style="display:none">'+obj[i].Nowlon+'</td>'+	
				            '<td class="'+ cls_sum_Custody2 +'" style="display:none">'+obj[i].Custody+'</td>'+
					 	    '<td class="'+ cls_sum_discount  +'" style="display:none">'+obj[i].Discount+'</td>'+
                            '<td class="type" style="display:none">'+obj[i].CustomerType+'</td>'+ '</tr>';  
                                 
                        }
                   

                   
       
                                
                   t.row.add( $(text) ).draw();

                    // tNowlon=obj[i].Nowlon;
                    // tCustody=obj[i].Custody;
                    // tDiscount=obj[i].Discount;
                    tCarrying+=obj[i].Carrying;
                    tTotal+= obj[i].Total;
                    type=obj[i].CustomerType;
                    // first_total+= obj[i].Total;
               
      
                    // final = tTotal + tCarrying + tNowlon + tCustody 
                    // totalfinal = final - tDiscount ;

//                                     
                  // totalfinal = Math.round(totalfinal);

                                       
// document.getElementById("finaltotal").innerHTML =' اجمالى الفواتيرالنهائى :'+totalfinal;   
                   
                   
             
//document.getElementById("finaltotal").innerHTML ='اجمالى الفواتير: '+ totalfinal; 
                setCarrying(tCarrying);
                setType(type);
                setNowlon(tNowlon);
                setDiscount(tDiscount);
                setCustody(tCustody);
                 
   } //end of for
         final = tTotal + tCarrying + tNowlon + tCustody 
                    totalfinal = final - tDiscount ;
                   
     totalfinal = Math.round(totalfinal);
     tTotal = Math.round(tTotal);
document.getElementById("finaltotal").innerHTML=+totalfinal;   
document.getElementById("firsttotal").innerHTML=+tTotal;   

                // _totalcustomersdata.CheckTotal();

           }).error(function (data) {


        showError('',data);
        }); 
        
        
}
//-----------------------------------------------------------------------------

   $(document).ready(function() {


    var table = $('#tbl-totalcustomersdata').DataTable({
        // "columnDefs": [
        //     { "visible": false, "targets": 0 }

        // ],
        dom: 'T<"clear">lfrtip',
        "sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",
        "order": [[ 1, 'asc' ]],
       "displayLength": 10,
        "drawCallback": function ( settings ) {
    
            var api = this.api();
            var rows = api.rows( {page:'current' } ).nodes();
                                
                                 
            var last=null;
            
            api.column(0, {page:'current'}  ).data().each( function ( group, i ) {
                
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr style="background-color:#FDFEC1;"class="group hide" ><td colspan="9">'+group+'</td></tr>'
                    );
 
                    last = group;
                } 
                         
            });
                
                api.column(3, {page:'current'} ).data().each( function ( group, i ) {
                
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr style="background-color:#FDFEC1 ;display:none;"class="group" ><td colspan="2">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
                
                
            });  
            
            api.column(4, {page:'current'} ).data().each( function ( group, i ) {
                
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr style="background-color:#FDFEC1; display:none; "class="group" ><td colspan="2">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
                
                
            });
            var rowfotter = 0 ; 
            var rowfotter =  $(".input-sm").val();
            
//                rowfotter = group;

                $('#tbl-totalcustomersdata tbody').find('.group').each(function(i, v) {
                    
                   
                            var T_Weight =0;
                            var T_Quantity=0;
                            var T_ProductPrice=0;
                            var T_Total=0;

                            var T_nowlon=0; var T_discount=0; var T_carrying=0; var T_custody=0;
                            
                            var type=$(this).find(".type").text();
         
                            var rowCount = $(this).nextUntil('.group').length;

                            var total_sum = 0;
                            var refNo =0;
                            var protype =0;
                            var salesdate =0;

                            $(this).nextUntil('.group').each(function() {
                              

 T_Weight = T_Weight + parseInt($(this).find(".sum_weight").text());
                                
 T_Quantity = T_Quantity + parseInt($(this).find(".sum_quantity").text());
                                
// T_ProductPrice = T_ProductPrice + parseInt($(this).find(".sum_productprice").text());
 T_ProductPrice = T_ProductPrice + parseFloat($(this).find(".sum_productprice").text());
          T_ProductPrice =Math.round(T_ProductPrice)                          
 T_Total = T_Total + parseFloat($(this).find(".sum_Total").text());
// T_Total = T_Total + parseInt($(this).find(".sum_Total").text());
    T_Total =Math.round(T_Total)

                                      if ($(this).find(".sum_nowlon").text() != "")
                                {
                                T_nowlon=T_nowlon+parseFloat($(this).find(".sum_nowlon").text());
//                                T_nowlon=parseInt($(this).find(".sum_nowlon").text());
                                }
                                
                                
                                if ($(this).find(".sum_discount").text() != "")
                                {
//                                T_discount=T_discount+parseInt($(this).find(".sum_discount").text());
                                T_discount=parseFloat($(this).find(".sum_discount").text());
                                     T_discount =Math.round(T_discount)
                                }
                                
                                
                                T_carrying=T_carrying+parseFloat($(this).find(".sum_carrying").text());
                                T_carrying =Math.round(T_carrying)
                                if ($(this).find(".sum_custody2").text() != "")
                                 {
//                                 T_custody=T_custody+parseInt($(this).find(".sum_custody2").text());
                                 T_custody=parseFloat($(this).find(".sum_custody2").text());
                                      T_custody =Math.round(T_custody)
                                 }
                                
                                type=parseInt($(this).find(".type").text());
                                 refNo= $(this).find(".Refno").text();
                                 protype= $(this).find(".protype").text();
                                 salesdate= $(this).find(".salesDate").text();
                              
                             
                                var final0=0; var final1=0; var final2=0;
                                        var totalfinal =0 ;
                                

                                
                            });
                 
                    
                    
                             if ($(this).nextUntil('.group').next() )

                             { 
                                 

$(this).nextUntil('.group').last().after('<tr  style="display:none; background-color:#FFFFD8;" class="groupfooter"><td   > المجموع:'+T_Total+'</td></tr>')


                        if(type==0){
                              
                         var final0=T_Total+T_carrying;
                         var final0=final0-T_discount;
//                         var final0=Math.round(final0)
               
 $(this).nextUntil('.group').last().after('<tr  class="groupfooter" ><td>'+salesdate+'</td> <td>'+refNo+'</td><td >'+protype+'</td><td style="" id="test"  >'+"الاجمالى: "+T_Total+'</td> <td  class="Discount"> خصم:'+T_discount+'</td><td  class="Carrying"> مشال'+T_carrying+'</td><td class="sum1"  >الصافى  :'+final0+'</td></tr>')
     
        settotal0 (final0);
                         
        
                        }  
                           
       else if(type==1){
        var final1= T_Total+T_nowlon+T_custody+T_carrying; var final1=final1-T_discount;  
//             var final1=Math.round(final1)
           $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>'+salesdate+'</td><td>'+refNo+'</td><td>'+protype+'</td><td style="" id="test" >'+"الاجمالى: "+T_Total+'</td> <td  class="Nowlon"> نولون:'+T_nowlon+'</td><td class="Custody"> عهدة:'+ T_custody+'</td><td  class="Discount"> خصم:'+T_discount+'</td><td  class="Carrying"> مشال'+T_carrying+'</td> <td class="sum2">الصافى  :'+final1+'</td> </tr>')
  
        settotal1 (final1);
       }
                                 
      
        
                        else if(type==2){
                               var final2 = T_Total+T_carrying+T_custody; var final2=final2-T_discount;  
//                              var final2=Math.round(final2)
                            $(this).nextUntil('.group').last().after('<tr style="background-color:#EDEDED; "class="groupfooter"> <td>'+salesdate+'</td><td>'+refNo+'</td><td>'+protype+'</td><td style="" >'+"الاجمالى: "+T_Total+'</td><td class="Custody"  > عهدة:'+ T_custody+'</td><td class="Discount"> خصم:'+T_discount+'</td><td class="Carrying"> مشال :'+T_carrying+'</td><td class="sum3"  >الصافى  :'+final2+'</td></tr>')}     

settotal2 (final2);


                             }
 

                        });

        }

    }); 
         

    

    // Order by the grouping
    $('#tbl-totalcustomersdata tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
            table.order( [ 2, 'desc' ] ).draw();
        }
        else {
            table.order( [ 2, 'asc' ] ).draw();
        }
    } );


} );




$(document).ready(function() {
    $("#ToolTables_tbl-totalcustomersdata_4").on("click", function(){
            $("table").css("width","100%");
            // $("#search-totalcustomersdata").css("visibility","hidden");
            $("#search-totalcustomersdata").addClass("hide");
		    //check chosen customer name
            $("#check_enable2").addClass("hide"); 
            // $("#check_enable2").css("visibility","hidden"); 
            $("#check_label2").addClass("hide");
            // $("#check_label2").css("visibility","hidden");
            // $("#check_Customers").css("visibility","hidden");
		    $("#check_Customers").addClass("hide");
		    //checkbox to view customer name 
            // $("#check").css("visibility","hidden");
		    $("#check").addClass("hide");

            // $("#check_Customers").css("visibility","hidden");
		    $("#check_Customers").addClass("hide");
		
            $("#ShowONPrint").css("display","block");
            $("#Showprouduct2").css("display","block");
            $("#hide").css("display","none");
        
        
		 if($("#check_enable2").is(":checked")) 
   {
    	$("#ShowONPrint").css("visibility","visible"); 
   }else{
    
     
    $("#ShowONPrint").css("visibility","hidden");  
   }
 window.print();
		
  
    })    
      
    
    $(document).keyup(function(e) {
     if (e.keyCode == 27) {
         
          $("table").css("width","100%");
            // $("#search-totalcustomersdata").css("visibility","visible");
            $("#search-totalcustomersdata").removeClass("hide");
		     //check chosen customer name
            // $("#check_enable2").css("visibility","visible"); 
            $("#check_enable2").removeClass("hide"); 
            // $("#check_label2").css("visibility","visible");  
            $("#check_label2").removeClass("hide"); 
            // $("#check_Customers").css("visibility","visible");  
		    $("#check_Customers").removeClass("hide"); 
		     // checkbox to view customer name 
            // $("#check").css("visibility","visible"); 
		    $("#check").removeClass("hide");

            // $("#check_Customers").css("visibility","visible");
		    $("#check_Customers").removeClass("hide");
		 
            $("#ShowONPrint").css("display","none");
            $("#Showprouduct2").css("display","none");
            $("#hide").css("display","block");
    
		 if($("#check_enable2").is(":checked")) 
   {
    	$("#ShowONPrint").css("visibility","visible"); 
   }else{
    
     
    $("#ShowONPrint").css("visibility","hidden");  
   }
         
    }
});
    
} );

// totalcustomersdata.prototype.CheckTotal = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-totalcustomersdata tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sumfirst').each(function(i){        
//                     totals[i]+=Math.round(parseFloat($(this).html()));

//                 });
//             });
//             $("#tbl-totalcustomersdata th.firsttotal").each(function(i){  
//                 $('.firsttotal').html("اجمالى الفواتير :"+totals[i]);
//             });
 
// }

 $(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#search-totalcustomersdata").prop("disabled",false);
});
});