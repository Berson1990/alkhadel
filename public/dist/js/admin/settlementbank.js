
var settlementbank = function () {};
 
$(function(){ _settlementbank = new settlementbank() }); 



checkRadio=1;
function individuale(){
checkRadio=1;
}

function combine(){
checkRadio=2;
}


// settlementbank.prototype.CheckTotalOfCashdeposit = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-settlementcheckDeposit tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=Math.round(parseFloat( $(this).html()));
//                 });
//             });
//             $("#tbl-settlementcheckDeposit th.total").each(function(i){  
//                 $('.total').html("اجمالى المصروف :"+totals[i]);
//                 setbankdeposit(totals[i]);
//             });
 
// }
// settlementbank.prototype.CheckTotalOfCash = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-settlementBankDeposit tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=Math.round(parseFloat( $(this).html()));
//                 });
//             });
//             $("#tbl-settlementBankDeposit th.total2").each(function(i){  
//                 $('.total2').html("اجمالى المصروف :"+totals[i]);
//                 setbankCsheDeposit(totals[i]);
//             });
 
// }
// settlementbank.prototype.CheckTotalOfCashpay = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-settlementSuppliersCheck tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=Math.round(parseFloat( $(this).html()));
//                 });
//             });
//             $("#tbl-settlementSuppliersCheck th.total3").each(function(i){  
//                 $('.total3').html("اجمالى المصروف :"+totals[i]);
//                 setcheckpayments(totals[i]);
//             });
 
// }
// settlementbank.prototype.CheckTotalOfCTB = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-settlementTTBank tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=Math.round(parseFloat( $(this).html()));
//                 });
//             });
//             $("#tbl-settlementTTBank th.total4").each(function(i){  
//                 $('.total4').html("اجمالى المصروف :"+totals[i]);
//                 setcobtrans(totals[i]);
//             });
 
// }

// settlementbank.prototype.CheckTotalOfBTC = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-settlementTTCashier tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=Math.round(parseFloat( $(this).html()));
//                 });
//             });
//             $("#tbl-settlementTTCashier th.total5").each(function(i){  
//                 $('.total5').html("اجمالى المصروف :"+totals[i]);
//                 setboctrans(totals[i])

//             });
 
// }

function getBankName(BankID)
    {
        var cboCashierID = $( "#cboBankID" ).clone();
        $(cboCashierID).val(BankID);

        return $('option:selected',cboCashierID).text() ; 
    }
settlementbank.prototype.searchfortables = function(){
  
  var settlementcheckDeposit = $('#tbl-settlementcheckDeposit').DataTable();
    
    try
    {
    settlementcheckDeposit
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
         var settlementBankDeposit = $('#tbl-settlementBankDeposit').DataTable();
    
    try
    {
    settlementBankDeposit
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
                 var settlementSuppliersCheck = $('#tbl-settlementSuppliersCheck').DataTable();
    
    try
    {
    settlementSuppliersCheck
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
                 var settlementTTBank = $('#tbl-settlementTTBank').DataTable();
    
    try
    {
    settlementTTBank
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
                 var settlementTTCashier = $('#tbl-settlementTTCashier').DataTable();
    
    try
    {
    settlementTTCashier
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
                 var finalsttmentBank = $('#tbl-finalsttmentBank').DataTable();
    
    try
    {
    finalsttmentBank
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
                 var settlementCustomPayment = $('#tbl-settlementCustomPayment').DataTable();
    
    try
    {
    settlementCustomPayment
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
                 var settlementCustomRefund = $('#tbl-settlementCustomRefund').DataTable();
    
    try
    {
    settlementCustomRefund
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  




/*settlementcheckDeposit*/
  $.ajax({
            url: "settlementCashdeposit",
            type: "post",
            data: $('#settlementbank-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
      console.log(output);
        var obj = eval (output); 
          input=$('#settlementbank-repo-form :input');

           var x= input[2].value;
         var text=getBankName(x);

      
    $("#showCshierName").text("اسم الخزنه: "+text); 
      var FT1 = 0 ;  

 
       for (var i = 0; i < obj.length; i++) 
     { 
       
       console.log(obj[i].Mount);


                    text ='<tr><td class="transdate noraml">'+obj[i].TransDate+'</td>'+
                          '<td class="noraml">'+obj[i].CustomerName+'</td>'+
                          '<td class="bankname noraml">'+obj[i].BankName+'</td>'+
                          '<td class="noraml">'+obj[i].CheckNo+'</td>'+
                          '<td class="noraml">'+obj[i].Notes+'</td>'+
                          '<td class="sum noraml">'+obj[i].Mount+'</td>'+'</tr>';

       settlementcheckDeposit.row.add( $(text) ).draw(); 

       FT1 += obj[i].Mount

     }//end of for 
     $(".total").text(FT1);
   
        // _settlementbank.CheckTotalOfCashdeposit();

        _settlementbank.finalstatment();

           }).error(function (data) {

              _settlementbank.finalstatment();
        showError('',data);
        }); 


 $.ajax({
            url: "settlementCashd",
            type: "post",
            data: $('#settlementbank-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
      console.log(output);
        var obj = eval (output); 
          input=$('#settlementbank-repo-form :input');

    var FT2 =0;
   
       for (var i = 0; i < obj.length; i++) 
     { 
       

       console.log(obj[i].Mount);


                    text ='<tr><td class="transdate noraml">'+obj[i].TransDate+'</td>'+
                          '<td class="noraml">'+obj[i].CustomerName+'</td>'+
                          '<td class="bankname noraml">'+obj[i].BankName+'</td>'+
                          '<td class="noraml">'+obj[i].Notes+'</td>'+
                          '<td class="sum noraml">'+obj[i].Mount+'</td>'+'</tr>';

       settlementBankDeposit.row.add( $(text) ).draw(); 
        FT2 += obj[i].Mount
     }//end of for 
      $(".total2").text(FT2);
  
        // _settlementbank.CheckTotalOfCash();

        _settlementbank.finalstatment();
           }).error(function (data) {
              _settlementbank.finalstatment();
        showError('',data);
        }); 
/*cashpayment*/

 $.ajax({
            url: "settlementCashpayment",
            type: "post",
            data: $('#settlementbank-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
      console.log("tbl-settlementSuppliersCheck"+output);
        var obj = eval (output); 
          input=$('#settlementbank-repo-form :input');
  var FT3 =0;
   

       for (var i = 0; i < obj.length; i++) 
     { 
       

       console.log(obj[i].Mount);
     

                          text ='<tr><td class="transdate noraml">'+obj[i].TransDate+'</td>'+
                          '<td class="noraml">'+obj[i].SupplierName+'</td>'+
                          '<td class="bankname noraml">'+obj[i].BankName+'</td>'+
                          '<td class="noraml">'+obj[i].Notes+'</td>'+
                          '<td class="noraml">'+obj[i].CheckNo+'</td>'+
                          '<td class="sum noraml">'+obj[i].Mount+'</td>'+'</tr>';
 FT3 += obj[i].Mount
       settlementSuppliersCheck.row.add( $(text) ).draw(); 

     }//end of for 
        // _settlementbank.CheckTotalOfCashpay();
          $(".total3").text(FT3);
   
        _settlementbank.finalstatment();
           }).error(function (data) {
              _settlementbank.finalstatment();
        showError('',data);
        }); 
/*ctb*/

 $.ajax({
            url: "settlementctb",
            type: "post",
            data: $('#settlementbank-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
      console.log(output);
        var obj = eval (output); 
          input=$('#settlementbank-repo-form :input');

              var FT4 =0;



       for (var i = 0; i < obj.length; i++) 
     { 
       

       console.log(obj[i].Mount);
     

                          text ='<tr><td class="transdate noraml">'+obj[i].TransDate+'</td>'+
                          '<td class="bankname noraml">'+obj[i].CashierName+'</td>'+
                          '<td class="noraml">'+obj[i].Notes+'</td>'+
                          '<td class="sum noraml">'+obj[i].Mount+'</td>'+'</tr>';
 FT4 += obj[i].Mount
       settlementTTBank.row.add( $(text) ).draw(); 

     }//end of for 
        // _settlementbank.CheckTotalOfCTB();
 $(".total4").text(FT4);
 
        _settlementbank.finalstatment();
           }).error(function (data) {
              _settlementbank.finalstatment();
        showError('',data);
        }); 

$.ajax({
            url: "settlementbtc",
            type: "post",
            data: $('#settlementbank-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
      console.log(output);
        var obj = eval (output); 
          input=$('#settlementbank-repo-form :input');
                var FT5 =  0; 

       for (var i = 0; i < obj.length; i++) 
     { 
       

       console.log(obj[i].Mount);
     

                          text ='<tr><td class="transdate noraml">'+obj[i].TransDate+'</td>'+
                          '<td class="bankname noraml">'+obj[i].CashierName+'</td>'+
                          '<td class="noraml">'+obj[i].Notes+'</td>'+
                          '<td class="sum noraml">'+obj[i].Mount+'</td>'+'</tr>';

       settlementTTCashier.row.add( $(text) ).draw(); 
 FT5 += obj[i].Mount
     }//end of for 
        // _settlementbank.CheckTotalOfBTC();
           $(".total5").text(FT5);

        _settlementbank.finalstatment();
           }).error(function (data) {
              _settlementbank.finalstatment();
        showError('',data);
        }); 

    /*final statment and  get bnank opening balncee*/       
$.ajax({
            url: "settlementbankopeningbalance",
            type: "post",
            data: $('#settlementbank-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
      console.log(output);
        var obj = eval (output); 
          input=$('#settlementbank-repo-form :input');


       for (var i = 0; i < obj.length; i++) 
     { 
       BOB = obj[i].Mount;
        bankopen(BOB)
        document.getElementById("CashieropeningBalance").innerHTML ="الرصيد الافتتاحى للبنك :"+BOB +"جــ";

    

       // finalsttmentBank.row.add( $(text) ).draw(); 

     }//end of for 
         _settlementbank.finalstatment();
           }).error(function (data) {
            _settlementbank.finalstatment();
        showError('',data);
        }); 

}//end of serachtables function

settlementbank.prototype.finalstatment =function (){

    var finalsttmentBank = $('#tbl-finalsttmentBank').DataTable();
    
    try
    {
    finalsttmentBank
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  




var inc = 0 ;
var dec = 0 ;
var final = 0 ;


  

console.log("دائن ")
inc= +Bankopningbalance + +cobtrans + +bankCsheDeposit + +bankdeposit; 
// console.log(dept2);                       
dec= +checkpayments + +boctrans  ;
// console.log(CustOpenBalnce);                     
final  = inc-dec;
// console.log(final102)                       
// maden


// console.log("##############33");
// console.log(final103);
 tbl = '<tr><td>'+inc+'</td>'+
        '<td>'+dec+'</td>'+
'<td>'+final+'</td>'+'</tr>';
 finalsttmentBank.row.add( $(tbl) ).draw();

}


bankdeposit = 0;
function setbankdeposit(data)
{
bankdeposit = data
console.log(bankdeposit);
}

bankCsheDeposit= 0 
function setbankCsheDeposit(data){

bankCsheDeposit= data;
console.log(bankCsheDeposit);

}
checkpayments = 0 
function setcheckpayments(data){
checkpayments = data;
console.log(checkpayments);

}

cobtrans=0
function setcobtrans(data){

  cobtrans=data;
  console.log(cobtrans);
}

boctrans= 0 
function setboctrans(data){
boctrans = data;
console.log(boctrans)

} 

Bankopningbalance =0
function bankopen(data){

Bankopningbalance =data;
console.log(Bankopningbalance)
}





$(document).ready(function(){

/*Combine and Print*/
 var settlementcheckDeposit = $('#tbl-settlementcheckDeposit').DataTable({
                dom: 'T<"clear">lfrtip',

// "columnDefs": [
//             { "visible": false, "targets":1,2,3,4,
//              }
//         ],

        "order": [[ 2, 'asc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
              if(checkRadio == 1){

            $(".noraml").removeClass("hide");

            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr style="display:none" class="group"><td colspan="4">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });

        }else if(checkRadio == 2){


            $(".noraml").addClass("hide");
           
                    // alert("combine");
                api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr  style="display:none"  class="group"><td colspan="4">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });

            
    
    $('#tbl-settlementcheckDeposit tbody').find('.group').each(function(i, v) {
                           var rowCount = $(this).nextUntil('.group').length;

                           // console.log("####");
                           var total_sum = 0;
                           var trans = '';
                           var exname='';
                           $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                trans= $(this).find(".transdate").text();
                                exname=$(this).find(".bankname").text();
                               total_sum = total_sum + parseInt($(this).find(".sum").text());
                           });
console.log(total_sum);
                           // console.log(total_sum);
                           // console.log("####");
                            if ($(this).nextUntil('.group').next())
                            {
                                // console.log($(this).nextUntil('.group').last());
                                $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>تاريخ  :'+trans+'</td>\<td colspan="">'+"الاجمالى :"+total_sum+'</td></tr>')
                            }
                       
                       });
        


            }//end of combine           
            
        }


});
 var settlementBankDeposit = $('#tbl-settlementBankDeposit').DataTable({
                        dom: 'T<"clear">lfrtip',

// "columnDefs": [
//             { "visible": false, "targets":1,2,3,4,
//              }
//         ],

        "order": [[ 2, 'asc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
              if(checkRadio == 1){

            $(".noraml").removeClass("hide");

            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr style="display:none" class="group"><td colspan="4">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });

        }else if(checkRadio == 2){


            $(".noraml").addClass("hide");
           
                    // alert("combine");
                api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr  style="display:none"  class="group"><td colspan="4">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });

            
    
    $('#tbl-settlementBankDeposit tbody').find('.group').each(function(i, v) {
                           var rowCount = $(this).nextUntil('.group').length;

                           // console.log("####");
                           var total_sum = 0;
                           var trans = '';
                           var exname='';
                           $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                trans= $(this).find(".transdate").text();
                                exname=$(this).find(".bankname").text();
                               total_sum = total_sum + parseInt($(this).find(".sum").text());
                           });
console.log(total_sum);
                           // console.log(total_sum);
                           // console.log("####");
                            if ($(this).nextUntil('.group').next())
                            {
                                // console.log($(this).nextUntil('.group').last());
                                $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>تاريخ  :'+trans+'</td>\<td colspan="">'+"الاجمالى :"+total_sum+'</td></tr>')
                            }
                       
                       });
        


            }//end of combine           
            
        }

});
 var settlementSuppliersCheck = $('#tbl-settlementSuppliersCheck').DataTable({
                       dom: 'T<"clear">lfrtip',

// "columnDefs": [
//             { "visible": false, "targets":1,2,3,4,
//              }
//         ],

        "order": [[ 2, 'asc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
              if(checkRadio == 1){

            $(".noraml").removeClass("hide");

            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr style="display:none" class="group"><td colspan="4">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });

        }else if(checkRadio == 2){


            $(".noraml").addClass("hide");
           
                    // alert("combine");
                api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr  style="display:none"  class="group"><td colspan="4">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });

            
    
    $('#tbl-settlementSuppliersCheck tbody').find('.group').each(function(i, v) {
                           var rowCount = $(this).nextUntil('.group').length;

                           // console.log("####");
                           var total_sum = 0;
                           var trans = '';
                           var exname='';
                           $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                trans= $(this).find(".transdate").text();
                                exname=$(this).find(".bankname").text();
                               total_sum = total_sum + parseInt($(this).find(".sum").text());
                           });
console.log(total_sum);
                           // console.log(total_sum);
                           // console.log("####");
                            if ($(this).nextUntil('.group').next())
                            {
                                // console.log($(this).nextUntil('.group').last());
                                $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>تاريخ  :'+trans+'</td>\<td colspan="">'+"الاجمالى :"+total_sum+'</td></tr>')
                            }
                       
                       });
        


            }//end of combine           
            
        }

});
 var settlementTTBank = $('#tbl-settlementTTBank').DataTable({
                        dom: 'T<"clear">lfrtip',

// "columnDefs": [
//             { "visible": false, "targets":1,2,3,4,
//              }
//         ],

        "order": [[ 2, 'asc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
              if(checkRadio == 1){

            $(".noraml").removeClass("hide");

            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr style="display:none" class="group"><td colspan="4">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });

        }else if(checkRadio == 2){


            $(".noraml").addClass("hide");
           
                    // alert("combine");
                api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr  style="display:none"  class="group"><td colspan="4">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });

            
    
    $('#tbl-settlementTTBank tbody').find('.group').each(function(i, v) {
                           var rowCount = $(this).nextUntil('.group').length;

                           // console.log("####");
                           var total_sum = 0;
                           var trans = '';
                           var exname='';
                           $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                trans= $(this).find(".transdate").text();
                                exname=$(this).find(".bankname").text();
                               total_sum = total_sum + parseInt($(this).find(".sum").text());
                           });
console.log(total_sum);
                           // console.log(total_sum);
                           // console.log("####");
                            if ($(this).nextUntil('.group').next())
                            {
                                // console.log($(this).nextUntil('.group').last());
                                $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>تاريخ  :'+trans+'</td>\<td colspan="">'+"الاجمالى :"+total_sum+'</td></tr>')
                            }
                       
                       });
        


            }//end of combine           
            
        }

});
 var settlementTTCashier = $('#tbl-settlementTTCashier').DataTable({
                     dom: 'T<"clear">lfrtip',

// "columnDefs": [
//             { "visible": false, "targets":1,2,3,4,
//              }
//         ],

        "order": [[ 2, 'asc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
              if(checkRadio == 1){

            $(".noraml").removeClass("hide");

            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr style="display:none" class="group"><td colspan="4">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });

        }else if(checkRadio == 2){


            $(".noraml").addClass("hide");
           
                    // alert("combine");
                api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr  style="display:none"  class="group"><td colspan="4">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });

            
    
    $('#tbl-settlementTTCashier tbody').find('.group').each(function(i, v) {
                           var rowCount = $(this).nextUntil('.group').length;

                           // console.log("####");
                           var total_sum = 0;
                           var trans = '';
                           var exname='';
                           $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                trans= $(this).find(".transdate").text();
                                exname=$(this).find(".bankname").text();
                               total_sum = total_sum + parseInt($(this).find(".sum").text());
                           });
console.log(total_sum);
                           // console.log(total_sum);
                           // console.log("####");
                            if ($(this).nextUntil('.group').next())
                            {
                                // console.log($(this).nextUntil('.group').last());
                                $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>تاريخ  :'+trans+'</td>\<td colspan="">'+"الاجمالى :"+total_sum+'</td></tr>')
                            }
                       
                       });
        


            }//end of combine           
            
        }

});
 var finalsttmentBank = $('#tbl-finalsttmentBank').DataTable({
                         dom: 'T<"clear">lfrtip',

});



settlementTTCashier
settlementTTBank

	$("#cboBankID").select2({
            placeholder: "Search for an cashier Name",
            ajax: {
                url: 'bankautocomplete',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                type : 'post',
                data: function (params) {
                    var queryParameters = {
                        BankName: params.term
                    }
                    return queryParameters;
                },
                processResults: function (output) {
                    if (output.status){
                        return {
                            results: $.map(output.data, function (item) {
                                return {
                                    text: item.BankName,
                                    id: item.BankID,
                                   bankAccount : item.AccountNumber
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

/*طباعة وخلافة */
// serch Button 
 $('#search-settlementbank').click(function(){
  // alert("اشتغل ياروحمك")
         _settlementbank.searchfortables();
       // $("#search-settlementcashier").prop("disabled",true);
    });       

// date Picker 
      $( ".datepicker" ).datepicker({
  dateFormat: 'yy/mm/dd',
   currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
 });

$(".datepicker").datepicker('setDate', new Date());
	

      /*1*/
          $("#ToolTables_tbl-settlementcheckDeposit_4").click(function(){
      
              $("br").addClass("hide");
            $("#search-settlementbank").addClass("hide");
            $("#showCshierName").css("display","block"); 
             $("#hideinprint").css("display","none");

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").css("display","none");
           $("#check_customers").css("display","none");    
       
           $('#hideinprint').css("display","none");
        
            $("#ShowCustomerONPrint1").css("display","block"); 
             $("#ShowSupplierONPrint1").css("display","block"); 
            $("#Showprouduct").css("display","block"); 

    
             if(checkRadio == 1){
        $("#rbtnComb").addClass("hide");    
         $("#comname").addClass("hide");
      }
        else            
        {
            $("#rbtnIsndividuale").addClass("hide"); 
            $("#inname").addClass("hide");
        }
     
     window.print();
    
    });   
      
          $("#ToolTables_tbl-settlementBankDeposit_4").click(function(){
        $("br").addClass("hide");
            
           $("#search-settlementbank").addClass("hide");
            $("#showCshierName").css("display","block"); 
             $("#hideinprint").css("display","none");

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").css("display","none");
           $("#check_customers").css("display","none");    
       
           $('#hideinprint').css("display","none");
        
            $("#ShowCustomerONPrint1").css("display","block"); 
             $("#ShowSupplierONPrint1").css("display","block"); 
            $("#Showprouduct").css("display","block"); 

    
             if(checkRadio == 1){
        $("#rbtnComb").addClass("hide");    
         $("#comname").addClass("hide");
      }
        else            
        {
            $("#rbtnIsndividuale").addClass("hide"); 
            $("#inname").addClass("hide");
        }
     
     window.print();
    
    });   
      
          $("#ToolTables_tbl-settlementSuppliersCheck_4").click(function(){
      
              $("br").addClass("hide");
          $("#search-settlementbank").addClass("hide");
            $("#showCshierName").css("display","block"); 
             $("#hideinprint").css("display","none");

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").css("display","none");
           $("#check_customers").css("display","none");    
       
           $('#hideinprint').css("display","none");
        
            $("#ShowCustomerONPrint1").css("display","block"); 
             $("#ShowSupplierONPrint1").css("display","block"); 
            $("#Showprouduct").css("display","block"); 

    
             if(checkRadio == 1){
        $("#rbtnComb").addClass("hide");    
         $("#comname").addClass("hide");
      }
        else            
        {
            $("#rbtnIsndividuale").addClass("hide"); 
            $("#inname").addClass("hide");
        }
     
     window.print();
    
    });   
      
          $("#ToolTables_tbl-settlementTTBank_4").click(function(){
      
              $("br").addClass("hide");
           $("#search-settlementbank").addClass("hide");
            $("#showCshierName").css("display","block"); 
             $("#hideinprint").css("display","none");

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").css("display","none");
           $("#check_customers").css("display","none");    
       
           $('#hideinprint').css("display","none");
        
            $("#ShowCustomerONPrint1").css("display","block"); 
             $("#ShowSupplierONPrint1").css("display","block"); 
            $("#Showprouduct").css("display","block"); 

    
             if(checkRadio == 1){
        $("#rbtnComb").addClass("hide");    
         $("#comname").addClass("hide");
      }
        else            
        {
            $("#rbtnIsndividuale").addClass("hide"); 
            $("#inname").addClass("hide");
        }
     
     window.print();
    
    });   
      
          $("#ToolTables_tbl-settlementTTCashier_4").click(function(){
        $("br").addClass("hide");
            
          $("#search-settlementbank").addClass("hide");
            $("#showCshierName").css("display","block"); 
             $("#hideinprint").css("display","none");

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").css("display","none");
           $("#check_customers").css("display","none");    
       
           $('#hideinprint').css("display","none");
        
            $("#ShowCustomerONPrint1").css("display","block"); 
             $("#ShowSupplierONPrint1").css("display","block"); 
            $("#Showprouduct").css("display","block"); 

    
             if(checkRadio == 1){
        $("#rbtnComb").addClass("hide");    
         $("#comname").addClass("hide");
      }
        else            
        {
            $("#rbtnIsndividuale").addClass("hide"); 
            $("#inname").addClass("hide");
        }
     
     window.print();
    
    });   
      
          $("#ToolTables_tbl-finalsttmentBank_4").click(function(){
        $("br").addClass("hide");
            
           $("#search-settlementbank").addClass("hide");
            $("#showCshierName").css("display","block"); 
             $("#hideinprint").css("display","none");

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").css("display","none");
           $("#check_customers").css("display","none");    
       
           $('#hideinprint').css("display","none");
        
            $("#ShowCustomerONPrint1").css("display","block"); 
             $("#ShowSupplierONPrint1").css("display","block"); 
            $("#Showprouduct").css("display","block"); 

    
             if(checkRadio == 1){
        $("#rbtnComb").addClass("hide");    
         $("#comname").addClass("hide");
      }
        else            
        {
            $("#rbtnIsndividuale").addClass("hide"); 
            $("#inname").addClass("hide");
        }
     
     window.print();
    
    });   
      



});//end of document ready



 
    
    
      $(document).keyup(function(e) {
        if (e.keyCode == 27) {
            $("br").removeClass("hide");
          $("#search-settlementbank").removeClass("hide");   
        $("table").css("width","100%");        
        $("#search-onecustomer").css("visibility","visible");
        $("#check_customer").css("display","block");
        $("#check_customers").css("display","block");       
            
            $('#hideinprint').css("display","block");
     
       $("#showCshierName").css("display","none"); 
        $("#ShowCustomerONPrint1").css("display","none"); 
         $("#ShowSupplierONPrint1").css("display","none"); 
         $("#Showprouduct").css("display","none"); 

       
    
                  if(checkRadio == 1){
        $("#rbtnComb").removeClass("hide");    
         $("#comname").removeClass("hide");
      }
        else            
        {
            $("#rbtnIsndividuale").removeClass("hide"); 
            $("#inname").removeClass("hide");
        }

              
        }
     });
    