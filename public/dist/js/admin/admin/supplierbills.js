var supplierbills = function () {};
$(function(){ _supplierbills = new supplierbills(); });

$(document).ready(function() {
 $('#search-supplierbills').click(function(){
    
                          SetOpeningBalnce(0);
                          SetBalanceType('');
                          totalvalue(0);
                          totalpayment(0);
                          finaldiscount(0);
                          totalrefund(0);  
 

      // $("#search-supplierbills").prop("disabled",true);
        _supplierbills.searchfortables();
    });                  
});


$(document).ready(function() {
	$("#supplierbills").select2({
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
                                    suptype : item.SupplierType ,
                                }
                                 // alert(results); 
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
//============================= set and get value


OpeningBalnce=0;
function SetOpeningBalnce(data)
{
OpeningBalnce=data;
console.log(OpeningBalnce);    
console.log("OpeningBalnce");    
}

BalnceType=0;
function SetBalanceType(data)
{
BalnceType=data;
console.log(BalnceType);    
console.log("BalnceType");    
}



// set and get total 
finaltotal=0;
function totalvalue(data)
{
finaltotal=data;
console.log(finaltotal);    
console.log("finaltotal");    
}

//set and get payment 
payment=0;
function totalpayment(data)
{
payment=data;
console.log(payment);    
console.log("payment");    
}

//set and get discount 
discount=0;
function finaldiscount(data)
{
discount=data;
console.log(discount);    
console.log("discount");    
}

//set and get refund
refund=0;
function totalrefund(data)
{
refund=data;
console.log(refund);    
console.log("refund");    
}
//---------------------------------------------------------	
//---------------------------------------------------------

function getSupplierName(SupplierID)
    {
        var cboSupplierID = $( "#supplierbills" ).clone();
        // console.log($(SupplierID).val(SupplierID));
        $(cboSupplierID).val(SupplierID);
        return $('option:selected',cboSupplierID).text() ; 
    }

 totalSum =0;
supplierbills.prototype.setSum = function(sum){
    totalSum=sum;  
 }
checkRadio=1;

function individuale(){
checkRadio=1;
}


function combine(){
checkRadio=2;
}



supplierbills.prototype.searchfortables = function(){
    
     var sum;

var ref = $('#tbl-SupplierRefunds').DataTable();
try
    {
    ref
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }   
var disc = $('#tbl-SupplierDiscountss').DataTable();
try
    {
    disc
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }   

var t = $('#tbl-SupplierReport').DataTable();
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
	
var bills = $('#tbl-Bills').DataTable();
	  try
    {
    bills
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    } 
	
var pay = $('#tbl-SupplierPayment').DataTable();
     try
    {
        // alert("testing");
    pay
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
        
    }
    
  



        $.ajax({
            url: "LoadData",
            type: "post",
            data: $('#supplierbills-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
 
          .done(function (output) {

            var input=$('#supplierbills-repo-form :input');
             //console.log(input);
            // console.log(input[2].value);
			  
            var x= input[2].value;
			 console.log(x);
//            var text=getSupplierName(x);
			  var cboSupplierID = $( "#supplierbills" ).clone();
			  $(cboSupplierID).val(x);
          
			var text=$('option:selected',cboSupplierID).text();
             console.log(text);
            $("#ShowSONPrint").text("اسم المورد: "+text);
            
            var obj = eval (output);

                        // finaltotal = 0 ;


            for (var i = 0; i < obj.length; i++) {
 
                text = '<tr><td id="date" class="history hidecombine3">'+obj[i].SalesDate+'</td>'+
                        '<td class="Pname hidecombine3">'+obj[i].CustomerName+'</td>'+
                        '<td class="Pname hidecombine3">'+obj[i].ProductName+'</td>'+
                        '<td class="sum_weight hidecombine3">'+obj[i].Weight+'</td>'+
                        '<td class="sum_quantity hidecombine3">'+obj[i].Quantity+'</td>'+
                        '<td class="sum_productprice hidecombine3">'+obj[i].ProductPrice+'</td>'+
                        '<td class="sum_Total hidecombine3">'+obj[i].Total+'</td>';
    
                t.row.add( $(text) ).draw();

                finaltotal +=Math.round(obj[i].Total);

                // totalvalue(finaltotal);
            }
            document.getElementById("fibaltotalbils").innerHTML="الاجمالى :"+finaltotal;


//            console.log(obj);
            var sum= 0;
            var kalmia=obj[0].Kalamia;// neb2a nes2al
            var s_comission=0;
            var final=0;
            var total_commission=0;



//console.log(obj[0].Kalamia);
//   _supplierbills.CheckTotal4();
               
//            supplierbills.prototype.CheckTotal4 = function(){
//
//var totals=[0,0,0];
//       
//            var $dataRows=$("#tbl-SupplierReport tr");
//
//            $dataRows.each(function() {
//                $(this).find('.sum_Total').each(function(i){        
//                    totals[i]+=parseInt( $(this).html());
//                });
//            });
//            $("#tbl-SupplierReport th.fibaltotalbils").each(function(i){  
//                $('.fibaltotalbils').html("اجمالى المبلغ :"+totals[i]);
//                
////                   totalpayment(totals[i])
//            });
              
        
        
        
             //console.log($dataRows)
             // alert("1");
//}

            
            for (var i = 0; i < obj.length; i++) {
                sum+=obj[i].Total;
                // kalmia+=obj[i].Kalamia;
                s_comission+=obj[i].SupplierCommision;
                
            }

             _supplierbills.setSum(0);

             for (var i = 0; i < obj.length; i++) {
                var commision= obj[i].Commision;
                total_commission+=commision/100*obj[i].Total;

            }
            // console.log(total_commission);
                //---------------
                _supplierbills.setSum(sum);
                //-----------------  
            kalmia= Math.round(kalmia/100*sum);
            console.log(kalmia);
            final=sum-kalmia; 
            console.log(final);
            final=final-total_commission; 
            console.log(final);
            final=Math.round(final);
              
             tbl = '<tr><td>'+sum+'</td>'+
                        '<td >'+total_commission+'</td>'+
                        '<td >'+kalmia+'</td>'+
                        '<td >'+final+'</td>';
 bills.row.add( $(tbl) ).draw();
                totalvalue(final);       

           
  _supplierbills.finalstatmrnt(); 
       }).error(function (data) {
 _supplierbills.finalstatmrnt(); 
        showError('',data);
        });
    

    
    
    /// final of loadpayment
    supplierbills.prototype.CheckTotal = function(){

var Spayment=[0,0,0];
       
            var $dataRows=$("#tbl-SupplierPayment tr");

            $dataRows.each(function() {
                $(this).find('.sumMount').each(function(i){        
                    Spayment[i]+=parseInt( $(this).html());
                });
            });
            $("#tbl-SupplierPayment th.total").each(function(i){  
                $('.total').html("اجمالى المبلغ :"+Spayment[i]);
                
                   // totalpayment(Spayment[i]);
            });
              
}
    
    
//loadfinal supplierDiscounts
supplierbills.prototype.CheckTotal2 = function(){
 
var Sdiscount=[0,0,0];
 
            var $dataRows=$("#tbl-SupplierDiscountss tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    Sdiscount[i]+=parseInt( $(this).html());
                  
                });
            });
            $("#tbl-SupplierDiscountss th.total2").each(function(i){  
                $('.total2').html("اجمالى المبلغ :"+Sdiscount[i]);
                  // finaldiscount(Sdiscount[i])
            });
             //console.log($dataRows)
// alert("2");
}   
 
//supplier refund
 supplierbills.prototype.CheckTotal3 = function(){
 
var SRefund=[0,0,0];
 
            var $dataRows=$("#tbl-SupplierRefunds tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    SRefund[i]+=parseInt( $(this).html());
                });
            });
            $("#tbl-SupplierRefunds th.total3").each(function(i){  
                $('.total3').html("اجمالى المبلغ :"+SRefund[i]);
                
                // totalrefund(SRefund[i])
            });
             //console.log($dataRows)
// alert("3");
}



        //LoadPayments
     $.ajax({
            url: "LoadPayments",
            type: "post",
            data: $('#supplierbills-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
       .done(function (results) {

       var input=$('#supplierbills-repo-form :input');
         var obj = eval (results);
         
         var finalpayment = 0
           for (var i = 0; i < obj.length; i++) {
 
                 sup_pay = '<tr><td>'+obj[i].TransDate+'</td>'+
                        '<td class="sumMount">'+ obj[i].Mount+'</td>'+
                        '<td >'+obj[i].PaymentType+'</td>'+
                        '<td >'+obj[i].CheckNo+'</td>'+
                        '<td >'+obj[i].Notes+'</td>';

                pay.row.add( $(sup_pay) ).draw();

              finalpayment +=obj[i].Mount;
              $(".total").text(finalpayment);
            }

            totalpayment(finalpayment);
         
          // _supplierbills.CheckTotal();



           _supplierbills.finalstatmrnt(); 
       }).error(function (data) {
         _supplierbills.finalstatmrnt(); 
        showError('',data);
        });


        $.ajax({
            url: "LoadRefund",
            type: "post",
            data: $('#supplierbills-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
       .done(function (output) {
       var input=$('#supplierbills-repo-form :input');
         var obj = eval (output);
         // console.log(output);
         var finalrefund = 0 ; 
           for (var i = 0; i < obj.length; i++) {
                 textt = '<tr><td>'+obj[i].RefundDate+'</td>'+
                        '<td class="sum">'+ obj[i].Refund+'</td>'+
                        '<td >'+obj[i].Notes+'</td>';

                ref.row.add( $(textt) ).draw();
                finalrefund +=obj[i].Refund;
                $(".total3").text(finalrefund);
            }
            // _supplierbills.CheckTotal3();
             totalrefund(finalrefund);


         
         _supplierbills.finalstatmrnt(); 
       }).error(function (data) {
       _supplierbills.finalstatmrnt(); 
        showError('',data);
        });


             $.ajax({
                    url: "LoadDiscount",
                    type: "post",
                    data: $('#supplierbills-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
                    dataType: "json"
                })
               .done(function (output) {
               var input=$('#supplierbills-repo-form :input');
                 var obj = eval (output);
                 var totaldiscount = 0 ;
                   for (var i = 0; i < obj.length; i++) {
         
                         text = '<tr><td>'+obj[i].TransDate+'</td>'+
                                '<td class="sum">'+ obj[i].Mount+'</td>'+
                                '<td >'+obj[i].Notes+'</td>';

                        disc.row.add( $(text) ).draw();
                        totaldiscount += obj[i].Mount;

                    }
                      $(".total2").text(totaldiscount);
                    // _supplierbills.CheckTotal2();
finaldiscount(totaldiscount);


            _supplierbills.finalstatmrnt(); 
               }).error(function (data) {
                _supplierbills.finalstatmrnt(); 
                showError('',data);
                });

//load suppliers openingbaknce 
         $.ajax({
            url: "SuppliersOpeningBalanceStatment",
            type: "post",
            data: $('#supplierbills-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
       .done(function (output) {
         var obj = eval (output);  

          // var deptType= '';  
          // var OBalnce = 0;  
          var balancetype = 0
          var openbalnce = '';

         var balancetype =0;
         var openbalnce = 0;


              
SetOpeningBalnce(openbalnce);
 SetBalanceType(balancetype);

            for( var i = 0 ; i < obj.length ; i++) 
                {

        // var balancetype = obj[i].Debt;
        //  var openbalnce = obj[i].Mount; 

          if (obj[i].Debt !== '' )
          {
              balancetype = obj[i].Debt;  
          }else{
               balancetype = '' ; 
          }

          if (obj[i].Mount > 0 ){
            openbalnce = obj[i].Mount; 
          }else{
            openbalnce = 0 ;
          }


               
SetOpeningBalnce(openbalnce);
console.log("#######################");
 SetBalanceType(balancetype);
 console.log(balancetype);

             if(obj[i].Debt == 0 )
             {
document.getElementById('suppliers_opening_date').innerHTML="تاريخ الافتتاح :"+obj[i].TransDate;
document.getElementById('suppliers_openingBalnce_Mount').innerHTML="الرصيد الافتتاحى :"+obj[i].Mount +"دائــن";                 

             }else{
document.getElementById('suppliers_opening_date').innerHTML="تاريخ الافتتاح :"+obj[i].TransDate;
document.getElementById('suppliers_openingBalnce_Mount').innerHTML="الرصيد الافتتاحى :"+obj[i].Mount +"مديــن";  
     }
                 }//end of for 
             
  
            
          //end of final statment of suppliers 
 _supplierbills.finalstatmrnt(); 
         }).error(function (data) {
           _supplierbills.finalstatmrnt(); 
        showError('',data);
        });

          
   

    
}// end of function serch of tables 


supplierbills.prototype.finalstatmrnt = function(){

  var openingbalnceStatment = $('#tbl-finalstatment').DataTable();
     try
    {
        // alert("testing");
    openingbalnceStatment
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }
console.log("ayhaga ");
console.log(BalnceType);
console.log(OpeningBalnce);
console.log("###########");
console.log("finlaltotal");
console.log(finaltotal);


            var dept3 = 0 ;
            var cridet3 = 0 ;
            var final3 = 0 ;


      if (BalnceType === '' )
             {
                  console.log("لامدين ولا دائن ")
                dept3 = payment; 
            cridet3 =finaltotal+ refund  + discount ; 
            final3 =  dept3 - cridet3;
                               
                          
         }else  if (BalnceType == 1 ){
                    console.log("مدين ");
            dept3 =   OpeningBalnce + payment ;
             cridet3 = finaltotal + refund  + discount ; 
             final3 =  dept3 - cridet3;


         }else if(BalnceType == 0){
                //oening balnce credit
                console.log("دائن ");
            dept3 =   payment ; 
            cridet3 = finaltotal + OpeningBalnce +refund + discount ;
            final3 =  dept3 - cridet3;                          
             }

console.log("#########################");
console.log(final3);
                          tblfinalstat = '<tr><td>'+dept3+'</td>'+
                                         '<td>'+cridet3+'</td>'+
                                          '<td>'+final3+'</td>'+'</tr>';
                openingbalnceStatment.row.add( $(tblfinalstat) ).draw();
         
}// end of fn 





/*combaine @ indvudal*/

$(document).ready(function() {
    
    var tbl_pay = $('#tbl-SupplierPayment').DataTable({dom: 'T<"clear">lfrtip',});

    var tbl_ref = $('#tbl-SupplierRefunds').DataTable({dom: 'T<"clear">lfrtip',});
    
    var tbl_disc = $('#tbl-SupplierDiscountss').DataTable({dom: 'T<"clear">lfrtip',});

    var tbl_bills = $('#tbl-Bills').DataTable({dom: 'T<"clear">lfrtip',});
    
    var tbl_bills = $('#tbl-finalstatment').DataTable({dom: 'T<"clear">lfrtip',});

    var table = $('#tbl-SupplierReport').DataTable ( {
//  	                     "columnDefs": [
//            { "visible": false, "targets": 0},
//
//        ],
     dom: 'T<"clear">lfrtip',
       
        "order": [[ 0, 'asc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            
              if(checkRadio == 1){
                    $(".hidecombine3").css( "display","table-cell");
//                   $(".history").text($(this).find(".date"));
//                $(".history").css('visibility','show');   
              }
 
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                
          if(checkRadio == 2)
              { 
               $(".hidecombine3").css("display","none");
//                  $(".history").text('');
                
             
                if ( last !== group ) {

                    $(rows).eq( i ).before(
                        '<tr style="display:none;" class="group"><td colspan="6">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
                
            }
                
            } );
            
              if(checkRadio == 2){
                // $(".Pname").addClass("hide");
                // $(".sum_weight").addClass("hide");
                // $(".sum_quantity").addClass("hide");
                // $(".sum_productprice").addClass("hide");
                // $(".sum_Total").addClass("hide");
                $('#tbl-SupplierReport tbody').find('.group').each(function(i, v) {
                            var T_Weight =0;
                            var T_Quantity=0;
                            var T_ProductPrice=0;
                            var T_Total=0;
                            var T_Time='';
                            var ProductName;
                            var rowCount = $(this).nextUntil('.group').length;

                            var total_sum = 0;
                            $(this).nextUntil('.group').each(function() {
                            
                 ProductName=$(this).find(".Pname").text();
                   T_Weight = T_Weight + parseInt($(this).find(".sum_weight").text());
                   T_Quantity = T_Quantity + parseInt($(this).find(".sum_quantity").text());
                    T_ProductPrice = T_ProductPrice + parseInt($(this).find(".sum_productprice").text());
                                T_Total = T_Total + parseInt($(this).find(".sum_Total").text());
                                T_Time = $(this).find("#date").text();
                                console.log(T_Time);
                            });
         
                             if ($(this).nextUntil('.group').next())
                             {
                                 
                                    $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>'+T_Time+'</td><td >'+T_Total+'</td>  </tr>')
                                    // class="optional">'+CustomerName+'
                             }

                        });
            }
        }

    }); 

     // Order by the grouping
    $('#tbl-SupplierReport tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
            table.order( [ 2, 'desc' ] ).draw();
        }
        else {
            table.order( [ 2, 'asc' ] ).draw();
        }
    } );
} );
 




 function Print(){
    // alert("aaa");
    $("br").addClass("hide");
    $("#search-supplierbills").addClass("hide");
    // $("#search-supplierbills").addClass("hide");
    $(".DTTT").addClass("hide");
    $("#tbl-SupplierReport_filter").addClass("hide");
    $(".dataTables_length").addClass("hide");
    $(".dataTables_filter").addClass("hide");
    $(".pagination").addClass("hide");
    $(".panel-heading").addClass("hide");
    // $(".box-header").addClass("hide");
    $(".content-header").addClass("hide");
    $(".main-header").addClass("hide");

  $(".Tabletitla").css("display","block");

  // $(".panel-heading").addClass("hide");
    $(".sidebar-menu").addClass("hide");
    $("#dataTables_filter").addClass("hide");
	 
    // $("#hiddenPrint").css("display","none");
    $("#hiddenPrint").addClass("hide");
	 
    $("#SName").addClass("hide");
    $("#ShowSONPrint").css("display","block");
$("h3").css("display","block");                       
if(checkRadio==1){$("#rbtnComb").css("display","none");$("#comname").css("display","none");
    }else{
        $("#rbtnIsndividuale").css("display","none");$("#inname").css("display","none");
    }
 window.print();
}


     function myFunction(e){

     if (e.keyCode == 27) {     
        $("#search-supplierbills").removeClass("hide");
        $(".DTTT").removeClass("hide");
        $("#tbl-SupplierReport_filter").removeClass("hide");
        $(".dataTables_length").removeClass("hide");
        $(".dataTables_filter").removeClass("hide");
        $(".pagination").removeClass("hide");
        $(".panel-heading").removeClass("hide");
        // $(".box-header").removeClass("hide");
        $(".content-header").removeClass("hide");
        $(".main-header").removeClass("hide");
        $(".sidebar-menu").removeClass("hide");

        // $("#ptn").css("visibility","visible");
        // $("#ptn").removeClass("hide");
        // $("#ptn").css("display","inline");
    
        // $("#ptn").show();
        $("#dataTables_filter").removeClass("hide");
		 
        $("#hiddenPrint").css("display","block");
		 
        $("#SName").css("display","blcok");
        $("#ShowSONPrint").css("display","none");
                                        
    if(checkRadio==1){$("#rbtnComb").css("display","inline");$("#comname").css("display","inline");
        }else{
            $("#rbtnIsndividuale").css("display","inline");$("#inname").css("display","inline");
        }

    }
}

$(document).ready(function(){
    
    
$("#ToolTables_tbl-SupplierReport_4").on("click" ,function(){
    
   $("#search-supplierbills").addClass("hide");
  
 $("#hiddenPrint").css("display","none");
    $("#SName").css("display","none");
   $("#ShowSONPrint").css("display","block");
                                    
if(checkRadio==1){$("#rbtnComb").css("display","none");$("#comname").css("display","none");
    }else{
        $("#rbtnIsndividuale").css("display","none");$("#inname").css("display","none");
    }
 window.print();

});  
$("#ToolTables_tbl-Bills_4").on("click" ,function(){
    
   $("#search-supplierbills").addClass("hide");
  
 $("#hiddenPrint").css("display","none");
    $("#SName").css("display","none");
   $("#ShowSONPrint").css("display","block");
                                    
if(checkRadio==1){$("#rbtnComb").css("display","none");$("#comname").css("display","none");
    }else{
        $("#rbtnIsndividuale").css("display","none");$("#inname").css("display","none");
    }
 window.print();

}); 
    
$("#ToolTables_tbl-SupplierPayment_4").on("click" ,function(){
    
   $("#search-supplierbills").addClass("hide");
  
 $("#hiddenPrint").css("display","none");
    $("#SName").css("display","none");
   $("#ShowSONPrint").css("display","block");
                                    
if(checkRadio==1){$("#rbtnComb").css("display","none");$("#comname").css("display","none");
    }else{
        $("#rbtnIsndividuale").css("display","none");$("#inname").css("display","none");
    }
 window.print();

}); 
$("#ToolTables_tbl-SupplierRefunds_4").on("click" ,function(){
    
   $("#search-supplierbills").addClass("hide");
  
 $("#hiddenPrint").css("display","none");
    $("#SName").css("display","none");
   $("#ShowSONPrint").css("display","block");
                                    
if(checkRadio==1){$("#rbtnComb").css("display","none");$("#comname").css("display","none");
    }else{
        $("#rbtnIsndividuale").css("display","none");$("#inname").css("display","none");
    }
 window.print();

});  
    $("#ToolTables_tbl-SupplierDiscountss_4").on("click" ,function(){
    
   $("#search-supplierbills").addClass("hide");
  
 $("#hiddenPrint").css("display","none");
    $("#SName").css("display","none");
   $("#ShowSONPrint").css("display","block");
                                    
if(checkRadio==1){$("#rbtnComb").css("display","none");$("#comname").css("display","none");
    }else{
        $("#rbtnIsndividuale").css("display","none");$("#inname").css("display","none");
    }
 window.print();

});  
        $("#ToolTables_tbl-finalstatment_4").on("click" ,function(){
    
   $("#search-supplierbills").addClass("hide");
  
 $("#hiddenPrint").css("display","none");
    $("#SName").css("display","none");
   $("#ShowSONPrint").css("display","block");
                                    
if(checkRadio==1){$("#rbtnComb").css("display","none");$("#comname").css("display","none");
    }else{
        $("#rbtnIsndividuale").css("display","none");$("#inname").css("display","none");
    }
 window.print();

});  
    
    
    
    
});


  $(document).keyup(function(e) {
     if (e.keyCode == 27) {
           $("#search-supplierbills").removeClass("hide");
   $("#dataTables_filter").removeClass("hide");
		 
        $("#hiddenPrint").css("display","block");
		 
        $("#SName").css("display","blcok");
        $("#ShowSONPrint").css("display","none");
                                        
    if(checkRadio==1){$("#rbtnComb").css("display","inline");$("#comname").css("display","inline");
        }else{
            $("#rbtnIsndividuale").css("display","inline");$("#inname").css("display","inline");
        } 
         
         
    }
});
    


 $(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#search-supplierbills").prop("disabled",false);
});
});