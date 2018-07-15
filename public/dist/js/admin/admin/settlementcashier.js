var settlementcashier = function () {};
 
$(function(){ _settlementcashier = new settlementcashier() }); 



checkRadio=1;
function individuale(){
checkRadio=1;
}


function combine(){
checkRadio=2;
}


$(document).ready(function() {

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


/**
sum total of expenses frist table 
**/
// settlementcashier.prototype.CheckTotalOfExpenses = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-settlementcashier tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=Math.round(parseFloat( $(this).html()));
//                 });
//             });
//             $("#tbl-settlementcashier th.total").each(function(i){  
//                 $('.total').html("اجمالى المصروف :"+totals[i]);
//             });
 
// }
// settlementcashier.prototype.CheckTotalOfDeposite = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-settlementCustomerDeposit tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=Math.round(parseFloat( $(this).html()));
//                 });
//             });
//             $("#tbl-settlementCustomerDeposit th.total2").each(function(i){  
//                 $('.total2').html("اجمالى المصروف :"+totals[i]);
//             });
 
// }
// settlementcashier.prototype.CheckTotalOfRefund = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-settlementCustomerRefund tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=Math.round(parseFloat( $(this).html()));
//                 });
//             });
//             $("#tbl-settlementCustomerRefund th.total3").each(function(i){  
//                 $('.total3').html("اجمالى المصروف :"+totals[i]);
//             });
 
// }


// settlementcashier.prototype.CheckTotalOfSuppPayment = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-settlementSuppliersPayment tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=Math.round(parseFloat( $(this).html()));
//                 });
//             });
//             $("#tbl-settlementSuppliersPayment th.total4").each(function(i){  
//                 $('.total4').html("اجمالى المصروف :"+totals[i]);
//             });
 
// }
// settlementcashier.prototype.CheckTotalOfSuppRefund = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-settlementSuppliersRefund tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=Math.round(parseFloat( $(this).html()));
//                 });
//             });
//             $("#tbl-settlementSuppliersRefund th.total5").each(function(i){  
//                 $('.total5').html("اجمالى المصروف :"+totals[i]);
//             });
 
// }
// settlementcashier.prototype.CheckTotalOfSuppFinal = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-settlementSuppliersfinalsett tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=Math.round(parseFloat( $(this).html()));
//                 });
//             });
//             $("#tbl-settlementSuppliersfinalsett th.total6").each(function(i){  
//                 $('.total6').html("اجمالى المصروف :"+totals[i]);
//             });
 
// }
// settlementcashier.prototype.CheckTotalOfCustomPayment = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-settlementCustomPayment tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=Math.round(parseFloat( $(this).html()));
//                 });
//             });
//             $("#tbl-settlementCustomPayment th.total7").each(function(i){  
//                 $('.total7').html("اجمالى المصروف :"+totals[i]);
//             });
 
// }
// settlementcashier.prototype.CheckTotalOfCustomRefund = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-settlementCustomRefund tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=Math.round(parseFloat( $(this).html()));
//                 });
//             });
//             $("#tbl-settlementCustomRefund th.total8").each(function(i){  
//                 $('.total8').html("اجمالى المصروف :"+totals[i]);
//             });
 
// }
// settlementcashier.prototype.CheckTotalOfCshierTCashier = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-TransfromCashirtoCashir tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=Math.round(parseFloat( $(this).html()));
//                 });
//             });
//             $("#tbl-TransfromCashirtoCashir th.total9").each(function(i){  
//                 $('.total9').html("اجمالى المصروف :"+totals[i]);
//             });
 
// }
// settlementcashier.prototype.CheckTotalOfCshierTBank = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-TransfairCashiertoBank tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=Math.round(parseFloat( $(this).html()));
//                 });
//             });
//             $("#tbl-TransfairCashiertoBank th.total10").each(function(i){  
//                 $('.total10').html("اجمالى المصروف :"+totals[i]);
//             });
 
// }
// settlementcashier.prototype.CheckTotalOfBankCashier = function(){
 
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-TransfaierBankCashir tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=Math.round(parseFloat( $(this).html()));
//                 });
//             });
//             $("#tbl-TransfaierBankCashir th.total11").each(function(i){  
//                 $('.total11').html("اجمالى المصروف :"+totals[i]);
//             });
 
// }



function getCashierName(CashierID)
    {
        var cboCashierID = $( "#cboCashierID" ).clone();
        $(cboCashierID).val(CashierID);

        return $('option:selected',cboCashierID).text() ; 
    }
settlementcashier.prototype.searchfortables = function(){
	
	
 var t = $('#tbl-settlementcashier').DataTable();
    
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
         var TSS = $('#tbl-settlementCustomerDeposit').DataTable();
    
    try
    {
    TSS
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
                 var settlementCustomerRefund = $('#tbl-settlementCustomerRefund').DataTable();
    
    try
    {
    settlementCustomerRefund
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
                 var settlementSuppliersPayment = $('#tbl-settlementSuppliersPayment').DataTable();
    
    try
    {
    settlementSuppliersPayment
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
                 var settlementSuppliersRefund = $('#tbl-settlementSuppliersRefund').DataTable();
    
    try
    {
    settlementSuppliersRefund
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
                 var settlementSuppliersfinalsett = $('#tbl-settlementSuppliersfinalsett').DataTable();
    
    try
    {
    settlementSuppliersfinalsett
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
                 var TransfromCashirtoCashir = $('#tbl-TransfromCashirtoCashir').DataTable();
    
    try
    {
    TransfromCashirtoCashir
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
                 var TransfairCashiertoBank = $('#tbl-TransfairCashiertoBank').DataTable();
    
    try
    {
    TransfairCashiertoBank
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
                 var TransfaierBankCashir = $('#tbl-TransfaierBankCashir').DataTable();
    
    try
    {
    TransfaierBankCashir
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
    
                 var finalsttmentCashier = $('#tbl-finalsttmentCashier').DataTable();
    
    try
    {
    finalsttmentCashier
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
		
	 
	 
	 /*المصروفات*/
	  $.ajax({
            url: "settlementcashierreport",
            type: "post",
            data: $('#settlementcashier-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
		  console.log(output);
		    var obj = eval (output); 
		  	 	input=$('#settlementcashier-repo-form :input');

			     var x= input[2].value;
			 	 var text=getCashierName(x);

		  
		$("#showCshierName").text("اسم الخزنه: "+text);	
		  
var FT1 = 0;
		   for (var i = 0; i < obj.length; i++) 
		 { 
			 

			 console.log(obj[i].Mount);
             var COB = obj[i].Mount;
             // $("CashieropeningBalance").append("الرصيد الافتتاحى للخزنة").val(COB);
              document.getElementById("CashieropeningBalance").innerHTML ="الرصيد الافتتاحى للخزن :"+COB +"جــ";

                    text ='<tr><td class="hide">'+obj[i].CashierName+'</td>'+
				         '<td class="hide trans noraml">'+obj[i].TransDate+'</td>'+
                          '<td class="ename noraml">'+obj[i].ExpenseTypeName+'</td>'+
					      '<td class="sum noraml">'+obj[i].mountex+'</td>'+'</tr>';

			 	t.row.add( $(text) ).draw(); 
FT1 += obj[i].mountex;
		 }//end of for
         console.log 

       $(".total").text(FT1);
      
        // _settlementcashier.CheckTotalOfExpenses();
		  
		  		 }).error(function (data) {
        showError('',data);
        }); 

/* مقبوضات العملاء*/
          $.ajax({
            url: "loadcasherCustomer",
            type: "post",
            data: $('#settlementcashier-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
          console.log(output);
            var obj = eval (output); 
        //         input=$('#settlementcashier-repo-form :input');

        //          var x= input[2].value;
        //          var text=getCashierName(x);

          
        // $("#showCshierName").text("اسم الخزنه: "+text); 
          
var FT2= 0 ;
           for (var i = 0; i < obj.length; i++) 
         { 
             

             console.log(obj[i].Mount);
             var COB = obj[i].Mount;
             // $("CashieropeningBalance").append("الرصيد الافتتاحى للخزنة").val(COB);
              // document.getElementById("CashieropeningBalance").innerHTML ="الرصيد الافتتاحى للخزن :"+COB +"جــ";

                    text ='<tr><td class="transdate noraml">'+obj[i].TransDate+'</td>'+
                         '<td class="customername noraml">'+obj[i].CustomerName+'</td>'+
                          '<td class="notes noraml">'+obj[i].Notes+'</td>'+
                          '<td class="sum noraml">'+obj[i].Mount+'</td>'+'</tr>';

                TSS.row.add( $(text) ).draw(); 
FT2 += obj[i].Mount;
         }//end of for 
        // _settlementcashier.CheckTotalOfDeposite();
            $(".total2").text(FT2);
    
                 }).error(function (data) {
        showError('',data);
        });     
        

/*مرتجهات المعلاء */
         $.ajax({
            url: "loadcasherCustomerRefund",
            type: "post",
            data: $('#settlementcashier-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
              console.log(output);
            var obj = eval (output); 
        //         input=$('#settlementcashier-repo-form :input');

        //          var x= input[2].value;
        //          var text=getCashierName(x);

          
        // $("#showCshierName").text("اسم الخزنه: "+text); 
          
var FT3= 0;
           for (var i = 0; i < obj.length; i++) 
         { 
             

             console.log(obj[i].Mount);
             var COB = obj[i].Mount;
             // $("CashieropeningBalance").append("الرصيد الافتتاحى للخزنة").val(COB);
              // document.getElementById("CashieropeningBalance").innerHTML ="الرصيد الافتتاحى للخزن :"+COB +"جــ";

                    text ='<tr><td class="transdate noraml">'+obj[i].RefundDate+'</td>'+
                         '<td class="customername noraml">'+obj[i].CustomerName+'</td>'+
                          '<td class="ename noraml">'+obj[i].Notes+'</td>'+
                          '<td class="sum noraml">'+obj[i].Refund+'</td>'+'</tr>';

               settlementCustomerRefund.row.add( $(text) ).draw(); 
FT3 +=obj[i].Refund;
         }//end of for 
        // _settlementcashier.CheckTotalOfRefund();
           $(".total3").text(FT3);
      
          
                 }).error(function (data) {
        showError('',data);
        });     

/*مدفوعلت المودرين */
        $.ajax({
            url: "CashierSuppPayment",
            type: "post",
            data: $('#settlementcashier-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
              console.log(output);
            var obj = eval (output); 
        //         input=$('#settlementcashier-repo-form :input');

        //          var x= input[2].value;
        //          var text=getCashierName(x);

          
        // $("#showCshierName").text("اسم الخزنه: "+text); 
          
           var FT4 = 0;
           for (var i = 0; i < obj.length; i++) 
         { 
             

             console.log(obj[i].Mount);
             var COB = obj[i].Mount;
             // $("CashieropeningBalance").append("الرصيد الافتتاحى للخزنة").val(COB);
              // document.getElementById("CashieropeningBalance").innerHTML ="الرصيد الافتتاحى للخزن :"+COB +"جــ";


                    text ='<tr><td class="transdate noraml">'+obj[i].TransDate+'</td>'+
                         '<td class="customername noraml">'+obj[i].SupplierName+'</td>'+
                          '<td class="ename noraml">'+obj[i].Notes+'</td>'+
                          '<td class="sum noraml">'+obj[i].Mount+'</td>'+'</tr>';
    FT4 += obj[i].Mount;
                settlementSuppliersPayment.row.add( $(text) ).draw(); 

         }//end of for 
        // _settlementcashier.CheckTotalOfSuppPayment();
          $(".total4").text(FT4);
     
          
                 }).error(function (data) {
        showError('',data);
        });       
   

/*مرتجعات المودرين */
        $.ajax({
            url: "CashierSuppRefund",
            type: "post",
            data: $('#settlementcashier-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
              console.log(output);
            var obj = eval (output); 
        //         input=$('#settlementcashier-repo-form :input');

        //          var x= input[2].value;
        //          var text=getCashierName(x);

          
        // $("#showCshierName").text("اسم الخزنه: "+text); 
          
var FT5 =0 ; 
           for (var i = 0; i < obj.length; i++) 
         { 
             

             console.log(obj[i].Mount);
             var COB = obj[i].Mount;
             // $("CashieropeningBalance").append("الرصيد الافتتاحى للخزنة").val(COB);
              // document.getElementById("CashieropeningBalance").innerHTML ="الرصيد الافتتاحى للخزن :"+COB +"جــ";

                    text ='<tr><td class="noraml transdate">'+obj[i].RefundDate+'</td>'+
                         '<td class="customername noraml">'+obj[i].SupplierName+'</td>'+
                          '<td class="noraml">'+obj[i].Notes+'</td>'+
                          '<td class="sum noraml">'+obj[i].Refund+'</td>'+'</tr>';

                settlementSuppliersRefund.row.add( $(text) ).draw(); 
                    FT5 += obj[i].Refund;
         }//end of for 
        // _settlementcashier.CheckTotalOfSuppRefund();
          $(".total5").text(FT5);
       
          
                 }).error(function (data) {
        showError('',data);
        });       
   
/*تصفيه الموردين */
        $.ajax({
            url: "CashierFinal",
            type: "post",
            data: $('#settlementcashier-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
              console.log(output);
            var obj = eval (output); 
        //         input=$('#settlementcashier-repo-form :input');

        //          var x= input[2].value;
        //          var text=getCashierName(x);

          
        // $("#showCshierName").text("اسم الخزنه: "+text); 
          
var FT6 = 0;
           for (var i = 0; i < obj.length; i++) 
         { 
             

             // console.log(obj[i].Mount);
             // var COB = obj[i].Mount;
             // $("CashieropeningBalance").append("الرصيد الافتتاحى للخزنة").val(COB);
              // document.getElementById("CashieropeningBalance").innerHTML ="الرصيد الافتتاحى للخزن :"+COB +"جــ";

                    text ='<tr><td class="transdate noraml">'+obj[i].TransDate+'</td>'+
                         '<td class="customername noraml">'+obj[i].SupplierName+'</td>'+
                          '<td class="ename noraml">'+obj[i].Notes+'</td>'+
                          '<td class="sum noraml">'+obj[i].Mount+'</td>'+'</tr>';

                settlementSuppliersfinalsett.row.add( $(text) ).draw(); 
FT6 +=obj[i].Mount
         }//end of for 

          $(".total6").text(FT6);
    
        // _settlementcashier.CheckTotalOfSuppFinal();
          
                 }).error(function (data) {
        showError('',data);
        });       
   
   /* مدفوعات المستخلصين */
        $.ajax({
            url: "CustomPay",
            type: "post",
            data: $('#settlementcashier-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
              console.log(output);
            var obj = eval (output); 
        //         input=$('#settlementcashier-repo-form :input');

        //          var x= input[2].value;
        //          var text=getCashierName(x);

          
        // $("#showCshierName").text("اسم الخزنه: "+text); 
        var FT7 = 0 ; 

           for (var i = 0; i < obj.length; i++) 
         { 
             

             console.log(obj[i].Mount);
             var COB = obj[i].Mount;
             // $("CashieropeningBalance").append("الرصيد الافتتاحى للخزنة").val(COB);
              // document.getElementById("CashieropeningBalance").innerHTML ="الرصيد الافتتاحى للخزن :"+COB +"جــ";

                    text ='<tr><td class="transdate noraml">'+obj[i].TransDate+'</td>'+
                         '<td class="customername noraml">'+obj[i].CustomName+'</td>'+
                          '<td class="ename noraml">'+obj[i].Notes+'</td>'+
                          '<td class="sum noraml">'+obj[i].Mount+'</td>'+'</tr>';

                settlementCustomPayment.row.add( $(text) ).draw(); 
                    FT7 += obj[i].Mount;
         }//end of for 
        // _settlementcashier.CheckTotalOfCustomPayment();
            $(".total7").text(FT7);
     
          
                 }).error(function (data) {
        showError('',data);
        });       
   
   /* مرتجعات المستخلصين */
        $.ajax({
            url: "CustomRefund",
            type: "post",
            data: $('#settlementcashier-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
              console.log(output);
            var obj = eval (output); 
        //         input=$('#settlementcashier-repo-form :input');

        //          var x= input[2].value;
        //          var text=getCashierName(x);

          
        // $("#showCshierName").text("اسم الخزنه: "+text); 
          
var FT8 = 0 ;
           for (var i = 0; i < obj.length; i++) 
         { 
             

             console.log(obj[i].Mount);
             var COB = obj[i].Mount;
             // $("CashieropeningBalance").append("الرصيد الافتتاحى للخزنة").val(COB);
              // document.getElementById("CashieropeningBalance").innerHTML ="الرصيد الافتتاحى للخزن :"+COB +"جــ";

                    text ='<tr><td class="transdate noraml">'+obj[i].RefundDate+'</td>'+
                         '<td class="customername noraml">'+obj[i].CustomName+'</td>'+
                          '<td class="ename noraml">'+obj[i].Notes+'</td>'+
                          '<td class="sum noraml">'+obj[i].Refund+'</td>'+'</tr>';

                settlementCustomRefund.row.add( $(text) ).draw(); 
              FT8 += obj[i].Refund;

         }//end of for 
        // _settlementcashier.CheckTotalOfCustomRefund();
          $(".total8").text(FT8);
      
          
                 }).error(function (data) {
        showError('',data);
        });       
   
   /* تحويل من خزنة لخزنة*/
        $.ajax({
            url: "cashierTocashier",
            type: "post",
            data: $('#settlementcashier-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
              console.log(output);
            var obj = eval (output); 
        //         input=$('#settlementcashier-repo-form :input');

        //          var x= input[2].value;
        //          var text=getCashierName(x);

          
        // $("#showCshierName").text("اسم الخزنه: "+text); 
          
var FT9 = 0 ;
           for (var i = 0; i < obj.length; i++) 
         { 
             

             console.log(obj[i].Mount);
             var COB = obj[i].Mount;

             // $("CashieropeningBalance").append("الرصيد الافتتاحى للخزنة").val(COB);
              // document.getElementById("CashieropeningBalance").innerHTML ="الرصيد الافتتاحى للخزن :"+COB +"جــ";

                    text ='<tr><td class="transdate noraml">'+obj[i].TransDate+'</td>'+
                         '<td class="name noraml">'+obj[i].CashierName+'</td>'+
                          '<td class="ename noraml">'+obj[i].Notes+'</td>'+
                          '<td class="sum noraml">'+obj[i].Mount+'</td>'+'</tr>';

                TransfromCashirtoCashir.row.add( $(text) ).draw(); 
FT9 += obj[i].Mount;
         }//end of for 
        // _settlementcashier.CheckTotalOfCshierTCashier();
          $(".total9").text(FT9);
       
                 }).error(function (data) {
        showError('',data);
        });       
   
  /*تحويل من خزنه لبنك*/
        $.ajax({
            url: "cashierToBank",
            type: "post",
            data: $('#settlementcashier-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
              console.log(output);
            var obj = eval (output); 
        //         input=$('#settlementcashier-repo-form :input');

        //          var x= input[2].value;
        //          var text=getCashierName(x);

          
        // $("#showCshierName").text("اسم الخزنه: "+text); 
          
var FT10 = 0; 
           for (var i = 0; i < obj.length; i++) 
         { 
             

             console.log(obj[i].Mount);
             var COB = obj[i].Mount;
             
             // $("CashieropeningBalance").append("الرصيد الافتتاحى للخزنة").val(COB);
              // document.getElementById("CashieropeningBalance").innerHTML ="الرصيد الافتتاحى للخزن :"+COB +"جــ";

                    text ='<tr><td class="transdate noraml">'+obj[i].TransDate+'</td>'+
                         '<td class="name noraml">'+obj[i].BankName+'</td>'+
                          '<td class="name noraml">'+obj[i].Notes+'</td>'+
                          '<td class="sum noraml">'+obj[i].Mount+'</td>'+'</tr>';

                TransfairCashiertoBank.row.add( $(text) ).draw(); 
                        FT10 += obj[i].Mount; 
         }//end of for 
        // _settlementcashier.CheckTotalOfCshierTBank();
         $(".total10").text(FT10);
      
          
          
                 }).error(function (data) {
        showError('',data);
        });       
   

     /* تحويل من خزنة لبنك*/
        $.ajax({
            url: "cshiertoBank",
            type: "post",
            data: $('#settlementcashier-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
              console.log(output);
            var obj = eval (output); 
        //         input=$('#settlementcashier-repo-form :input');

        //          var x= input[2].value;
        //          var text=getCashierName(x);

          
        // $("#showCshierName").text("اسم الخزنه: "+text); 
            var FT11 = 0 

           for (var i = 0; i < obj.length; i++) 
         { 
             

             console.log(obj[i].Mount);
             var COB = obj[i].Mount;
           
             // $("CashieropeningBalance").append("الرصيد الافتتاحى للخزنة").val(COB);
              // document.getElementById("CashieropeningBalance").innerHTML ="الرصيد الافتتاحى للخزن :"+COB +"جــ";

                    text ='<tr><td class="transdate noraml">'+obj[i].TransDate+'</td>'+
                         '<td class="name noraml">'+obj[i].BankName+'</td>'+
                          '<td class="ename noraml">'+obj[i].Notes+'</td>'+
                          '<td class="sum noraml">'+obj[i].Mount+'</td>'+'</tr>';

                TransfaierBankCashir.row.add( $(text) ).draw(); 
                        FT11 += obj[i].Mount
         }//end of for 
        // _settlementcashier.CheckTotalOfBankCashier();
         $(".total11").text(FT11);
          
                 }).error(function (data) {
        showError('',data);
        });       
   ////final statment

$.ajax({
            url: "cvalidation",
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data:  $('[name=CashierID]').serialize(), 
            dataType: "json"
        }).done(function (output) {
            
             console.log(output);
          var  obj = eval(output);

            /*
1-COB => Cashier opening balance
2-CD  => CashDeposit
3-BCT => Bank Cashier Tranfaier
4-SPR => Supplier  Refund
5-CUR =>  Custom refund
6-CP  => Cashpayment
7-CR  => Cutomer Refund
8-CBT =>Cashier Bank Transfair
9-CT  => Cashier Transfair
9-CT2  => Cashier Transfair
9-Ex  => Expenses
9-CUP  => Cuatompayment
 */
    var CashierName = '';
          var CashDeposit = 0 ;
          var CashierOpeningBalance = 0 ;
          var SupplierRefund = 0 ;
          var BankCashierTransfer = 0 ;
          var cashiertransfer = 0 ;
          var CustomRefund = 0 ;
          var CustomerRefund = 0 ;
          var cashierbanktransfer = 0 ;
          var cashiertransfer2 = 0 ;
          var expenses = 0 ;
          var custompayment = 0 ;
          var total= 0;
          var inc =0;
          var dec = 0;

       for( var i= 0 ; i < obj.length; i++){

                 var CashierName = obj[i].CashierName;

                        /* increse*/

                 CashDeposit = obj[i].CD; 
                 CashierOpeningBalance = obj[i].COB;
                 SupplierRefund = obj[i].SPR;  
                 CustomRefund = obj[i].CUR;    
                 BankCashierTransfer = obj[i].BCT; 
                 cashiertransfer = obj[i].CT;  
                  CustomerRefund = obj[i].CR;    
               /*decrise*/

                  
                 cashierbanktransfer = obj[i].CBT;  
                 cashiertransfer2 = obj[i].CT2;  
                 CashPayments = obj[i].CP;  
                 expenses = obj[i].EX; 
                 custompayment = obj[i].CUSP;  

     inc = +CustomerRefund + +CashDeposit + +CashierOpeningBalance + +SupplierRefund + +CustomRefund + +BankCashierTransfer + +cashiertransfer;
     // console.log("زيادة  :"+inc);
     dec =  +cashierbanktransfer + +cashiertransfer2 + +CashPayments + +expenses + +custompayment;
     // console.log("نقصان  :"+dec);
    total = inc - dec;
      // console.log("Total"+total);
               // document.getElementById("validation").innerHTML="قيمة "+CashierName+" :"+total +" جـــ";
                 // $("#validation").append(obj[i].CashDeposit);
   
                      text ='<tr><td class="">'+inc+'</td>'+
                         '<td class="">'+dec+'</td>'+
                          '<td class="">'+total+'</td>'+'</tr>';

                finalsttmentCashier.row.add( $(text) ).draw(); 

       }



        }).error(function (data){
        showError('',data);
        }); 



 //        $.ajax({
 //            url: "dailyclosedCashier",
 //            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
 //            type: "post",
 //            data:  $('#settlementcashier-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "="), 
 //            dataType: "json"
 //        }).done(function (output) {





 // }).error(function (data){
 //        showError('',data);
 //        }); 


}// end function serach for table 

$(document).ready(function() {

$(".noraml").addClass("hide");
/*fist Table*/
   var table2 = $('#tbl-settlementcashier').DataTable({
        dom: 'T<"clear">lfrtip',
        // "columnDefs": [
        //     { "visible": false, "targets": 1 }
        // ],
        "order": [[ 2, 'asc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
              if(checkRadio == 1){

            $(".noraml").removeClass("hide");

            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr  class="group"><td colspan="4">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });

        }else if(checkRadio == 2){

            $(".noraml").addClass("hide");
           
                    // alert("combine");
                            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr style="display:none;" class="group"><td colspan="4">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });

            
    
    $('#tbl-settlementcashier tbody').find('.group').each(function(i, v) {
                           var rowCount = $(this).nextUntil('.group').length;

                           // console.log("####");
                           var total_sum = 0;
                           var trans = '';
                           var exname='';
                           $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                trans= $(this).find(".trans").text();
                                exname=$(this).find(".ename").text();
                               total_sum = total_sum + parseInt($(this).find(".sum").text());
                           });
console.log(total_sum);
                           // console.log(total_sum);
                           // console.log("####");
                            if ($(this).nextUntil('.group').next())
                            {
                                // console.log($(this).nextUntil('.group').last());
                                $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>تاريخ المصروف :'+trans+'</td><td>اسم المصروف :'+exname+'</td><td colspan="">'+"مجموع المصروفات :"+total_sum+'</td></tr>')
                            }
                       
                       });
        


            }//end of combine           
            
        }
    });  
    
/*socend table */
   var settlementCustomerDeposit = $('#tbl-settlementCustomerDeposit').DataTable({
                dom: 'T<"clear">lfrtip',
 "columnDefs": [
            { "visible": false, "targets":2 }
        ],
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

            
    
    $('#tbl-settlementCustomerDeposit tbody').find('.group').each(function(i, v) {
                           var rowCount = $(this).nextUntil('.group').length;

                           // console.log("####");
                           var total_sum = 0;
                           var trans = '';
                           var exname='';
                           $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                trans= $(this).find(".transdate").text();
                                exname=$(this).find(".customername").text();
                               total_sum = total_sum + parseInt($(this).find(".sum").text());
                           });
console.log(total_sum);
                           // console.log(total_sum);
                           // console.log("####");
                            if ($(this).nextUntil('.group').next())
                            {
                                // console.log($(this).nextUntil('.group').last());
                                $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>تاريخ المصروف :'+trans+'</td><td>اسم العميل :'+exname+'</td><td colspan="">'+"الاجمالى :"+total_sum+'</td></tr>')
                            }
                       
                       });
        


            }//end of combine           
            
        }

});

   var settlementCustomerRefund = $('#tbl-settlementCustomerRefund').DataTable({
                           dom: 'T<"clear">lfrtip',
 "columnDefs": [
            { "visible": false, "targets":2 }
        ],
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

            
    
    $('#tbl-settlementCustomerRefund tbody').find('.group').each(function(i, v) {
                           var rowCount = $(this).nextUntil('.group').length;

                           // console.log("####");
                           var total_sum = 0;
                           var trans = '';
                           var exname='';
                           $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                trans= $(this).find(".transdate").text();
                                exname=$(this).find(".customername").text();
                               total_sum = total_sum + parseInt($(this).find(".sum").text());
                           });
console.log(total_sum);
                           // console.log(total_sum);
                           // console.log("####");
                            if ($(this).nextUntil('.group').next())
                            {
                                // console.log($(this).nextUntil('.group').last());
                                $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>تاريخ المصروف :'+trans+'</td><td>اسم العميل :'+exname+'</td><td colspan="">'+"الاجمالى :"+total_sum+'</td></tr>')
                            }
                       
                       });
        


            }//end of combine           
            
        }

});

   var settlementSuppliersPayment = $('#tbl-settlementSuppliersPayment').DataTable({
                dom: 'T<"clear">lfrtip',
 dom: 'T<"clear">lfrtip',
 "columnDefs": [
            { "visible": false, "targets":2 }
        ],
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

            
    
    $('#tbl-settlementSuppliersPayment tbody').find('.group').each(function(i, v) {
                           var rowCount = $(this).nextUntil('.group').length;

                           // console.log("####");
                           var total_sum = 0;
                           var trans = '';
                           var exname='';
                           $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                trans= $(this).find(".transdate").text();
                                exname=$(this).find(".customername").text();
                               total_sum = total_sum + parseInt($(this).find(".sum").text());
                           });
console.log(total_sum);
                           // console.log(total_sum);
                           // console.log("####");
                            if ($(this).nextUntil('.group').next())
                            {
                                // console.log($(this).nextUntil('.group').last());
                                $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>تاريخ المصروف :'+trans+'</td><td>اسم المورد :'+exname+'</td><td colspan="">'+"الاجمالى :"+total_sum+'</td></tr>')
                            }
                       
                       });
        


            }//end of combine           
            
        }



});

   var settlementSuppliersRefund = $('#tbl-settlementSuppliersRefund').DataTable({
                  dom: 'T<"clear">lfrtip',
 "columnDefs": [
            { "visible": false, "targets":2 }
        ],
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

            
    
    $('#tbl-settlementSuppliersRefund tbody').find('.group').each(function(i, v) {
                           var rowCount = $(this).nextUntil('.group').length;

                           // console.log("####");
                           var total_sum = 0;
                           var trans = '';
                           var exname='';
                           $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                trans= $(this).find(".transdate").text();
                                exname=$(this).find(".customername").text();
                               total_sum = total_sum + parseInt($(this).find(".sum").text());
                           });
console.log(total_sum);
                           // console.log(total_sum);
                           // console.log("####");
                            if ($(this).nextUntil('.group').next())
                            {
                                // console.log($(this).nextUntil('.group').last());
                                $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>تاريخ المصروف :'+trans+'</td><td>اسم المورد :'+exname+'</td><td colspan="">'+"الاجمالى :"+total_sum+'</td></tr>')
                            }
                       
                       });
        


            }//end of combine           
            
        }
});

   var settlementSuppliersfinalsett = $('#tbl-settlementSuppliersfinalsett').DataTable({
       dom: 'T<"clear">lfrtip',
                "columnDefs": [
            { "visible": false, "targets":2 }
        ],
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

            
    
    $('#tbl-settlementSuppliersfinalsett tbody').find('.group').each(function(i, v) {
                           var rowCount = $(this).nextUntil('.group').length;

                           // console.log("####");
                           var total_sum = 0;
                           var trans = '';
                           var exname='';
                           $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                trans= $(this).find(".transdate").text();
                                exname=$(this).find(".customername").text();
                               total_sum = total_sum + parseInt($(this).find(".sum").text());
                           });
console.log(total_sum);
                           // console.log(total_sum);
                           // console.log("####");
                            if ($(this).nextUntil('.group').next())
                            {
                                // console.log($(this).nextUntil('.group').last());
                                $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>تاريخ المصروف :'+trans+'</td><td>اسم المورد :'+exname+'</td><td colspan="">'+"الاجمالى :"+total_sum+'</td></tr>')
                            }
                       
                       });
        


            }//end of combine           
            
        }
});

   var settlementCustomPayment = $('#tbl-settlementCustomPayment').DataTable({
                dom: 'T<"clear">lfrtip',
                         "columnDefs": [
            { "visible": false, "targets":2 }
        ],
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

            
    
    $('#tbl-settlementCustomPayment tbody').find('.group').each(function(i, v) {
                           var rowCount = $(this).nextUntil('.group').length;

                           // console.log("####");
                           var total_sum = 0;
                           var trans = '';
                           var exname='';
                           $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                trans= $(this).find(".transdate").text();
                                exname=$(this).find(".customername").text();
                               total_sum = total_sum + parseInt($(this).find(".sum").text());
                           });
console.log(total_sum);
                           // console.log(total_sum);
                           // console.log("####");
                            if ($(this).nextUntil('.group').next())
                            {
                                // console.log($(this).nextUntil('.group').last());
                                $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>تاريخ المصروف :'+trans+'</td><td>اسم المستخلص :'+exname+'</td><td colspan="">'+"الاجمالى :"+total_sum+'</td></tr>')
                            }
                       
                       });
        


            }//end of combine           
            
        }
});

   var settlementCustomRefund = $('#tbl-settlementCustomRefund').DataTable({
                dom: 'T<"clear">lfrtip',
                      
                         "columnDefs": [
            { "visible": false, "targets":2 }
        ],
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

            
    
    $('#tbl-settlementCustomRefund tbody').find('.group').each(function(i, v) {
                           var rowCount = $(this).nextUntil('.group').length;

                           // console.log("####");
                           var total_sum = 0;
                           var trans = '';
                           var exname='';
                           $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                trans= $(this).find(".transdate").text();
                                exname=$(this).find(".customername").text();
                               total_sum = total_sum + parseInt($(this).find(".sum").text());
                           });
console.log(total_sum);
                           // console.log(total_sum);
                           // console.log("####");
                            if ($(this).nextUntil('.group').next())
                            {
                                // console.log($(this).nextUntil('.group').last());
                                $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>تاريخ المستخلص :'+trans+'</td><td>اسم المستخلص :'+exname+'</td><td colspan="">'+"الاجمالى :"+total_sum+'</td></tr>')
                            }
                       
                       });
        


            }//end of combine           
            
        }
});

   var TransfromCashirtoCashir = $('#tbl-TransfromCashirtoCashir').DataTable({
                dom: 'T<"clear">lfrtip',

                         "columnDefs": [
            { "visible": false, "targets":2 }
        ],
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

            
    
    $('#tbl-TransfromCashirtoCashir tbody').find('.group').each(function(i, v) {
                           var rowCount = $(this).nextUntil('.group').length;

                           // console.log("####");
                           var total_sum = 0;
                           var trans = '';
                           var exname='';
                           $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                trans= $(this).find(".transdate").text();
                                exname=$(this).find(".name").text();
                               total_sum = total_sum + parseInt($(this).find(".sum").text());
                           });
console.log(total_sum);
                           // console.log(total_sum);
                           // console.log("####");
                            if ($(this).nextUntil('.group').next())
                            {
                                // console.log($(this).nextUntil('.group').last());
                                $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>تاريخ المستخلص :'+trans+'</td><td>اسم لخزنة :'+exname+'</td><td colspan="">'+"الاجمالى :"+total_sum+'</td></tr>')
                            }
                       
                       });
        


            }//end of combine           
            
        }
});


   var TransfairCashiertoBank = $('#tbl-TransfairCashiertoBank').DataTable({
                dom: 'T<"clear">lfrtip',

                         "columnDefs": [
            { "visible": false, "targets":2 }
        ],
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

            
    
    $('#tbl-TransfairCashiertoBank tbody').find('.group').each(function(i, v) {
                           var rowCount = $(this).nextUntil('.group').length;

                           // console.log("####");
                           var total_sum = 0;
                           var trans = '';
                           var exname='';
                           $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                trans= $(this).find(".transdate").text();
                                exname=$(this).find(".name").text();
                               total_sum = total_sum + parseInt($(this).find(".sum").text());
                           });
console.log(total_sum);
                           // console.log(total_sum);
                           // console.log("####");
                            if ($(this).nextUntil('.group').next())
                            {
                                // console.log($(this).nextUntil('.group').last());
                                $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>تاريخ المستخلص :'+trans+'</td><td>اسم البنك :'+exname+'</td><td colspan="">'+"الاجمالى :"+total_sum+'</td></tr>')
                            }
                       
                       });
        


            }//end of combine           
            
        }

});


   var TransfaierBankCashir = $('#tbl-TransfaierBankCashir').DataTable({
                dom: 'T<"clear">lfrtip',

                         "columnDefs": [
            { "visible": false, "targets":2 }
        ],
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

            
    
    $('#tbl-TransfaierBankCashir tbody').find('.group').each(function(i, v) {
                           var rowCount = $(this).nextUntil('.group').length;

                           // console.log("####");
                           var total_sum = 0;
                           var trans = '';
                           var exname='';
                           $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                trans= $(this).find(".transdate").text();
                                exname=$(this).find(".name").text();
                               total_sum = total_sum + parseInt($(this).find(".sum").text());
                           });
console.log(total_sum);
                           // console.log(total_sum);
                           // console.log("####");
                            if ($(this).nextUntil('.group').next())
                            {
                                // console.log($(this).nextUntil('.group').last());
                                $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>تاريخ المستخلص :'+trans+'</td><td>اسم البنك :'+exname+'</td><td colspan="">'+"الاجمالى :"+total_sum+'</td></tr>')
                            }
                       
                       });
        


            }//end of combine           
            
        }
});



   var finalsttmentCashier = $('#tbl-finalsttmentCashier').DataTable({
                dom: 'T<"clear">lfrtip',
});



/***
other steps doing when page startup :) 
***/

/*Print*/

// serch Button 
 $('#search-settlementcashier').click(function(){
         _settlementcashier.searchfortables();
       // $("#search-settlementcashier").prop("disabled",true);
    });       

// date Picker 
      $( ".datepicker" ).datepicker({
  dateFormat: 'yy/mm/dd',
   currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
 });

$(".datepicker").datepicker('setDate', new Date());
	

      /*1*/
          $("#ToolTables_tbl-settlementcashier_4").click(function(){
      $("br").addClass("hide");
            
            $("#search-settlementcashier").addClass("hide");
            $("#showCshierName").addClass("hide"); 
             $("#hideinprint").addClass("hide");;

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").addClass("hide");
           $("#check_customers").addClass("hide");   
       
           $('#hideinprint').addClass("hide");
        
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
      
          $("#ToolTables_tbl-settlementCustomerDeposit_4").click(function(){
       $("br").addClass("hide");
           
             $("#search-settlementcashier").addClass("hide");
            $("#showCshierName").addClass("hide");
             $("#hideinprint").addClass("hide");

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").addClass("hide");addClass("hide");addClass("hide");
           $("#check_customers").addClass("hide");addClass("hide");addClass("hide");    
       
           $('#hideinprint').addClass("hide");
         
        
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
      
          $("#ToolTables_tbl-settlementCustomerRefund_4").click(function(){
       $("br").addClass("hide");
            
            $("#search-settlementcashier").addClass("hide");
            $("#showCshierName").addClass("hide");addClass("hide");
             $("#hideinprint").addClass("hide");addClass("hide");

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").addClass("hide");addClass("hide");
           $("#check_customers").addClass("hide");addClass("hide");    
       
           $('#hideinprint').addClass("hide");addClass("hide");
        
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
      
          $("#ToolTables_tbl-settlementSuppliersPayment_4").click(function(){
      
             $("br").addClass("hide");
            $("#search-settlementcashier").addClass("hide");
            $("#showCshierName").addClass("hide");
             $("#hideinprint").addClass("hide");

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").addClass("hide");
           $("#check_customers").addClass("hide");   
       
           $('#hideinprint').addClass("hide");
        
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
      
          $("#ToolTables_tbl-settlementSuppliersRefund_4").click(function(){
      
             $("br").addClass("hide");
            $("#search-settlementcashier").addClass("hide");
            $("#showCshierName").css("display","block"); 
             $("#hideinprint").addClass("hide");

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").addClass("hide");
           $("#check_customers").addClass("hide");   
       
           $('#hideinprint').addClass("hide");
        
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
      
          $("#ToolTables_tbl-settlementSuppliersfinalsett_4").click(function(){
       $("br").addClass("hide");
            
            $("#search-settlementcashier").addClass("hide");
            $("#showCshierName").css("display","block"); 
             $("#hideinprint").addClass("hide");

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").addClass("hide");
           $("#check_customers").addClass("hide");   
       
           $('#hideinprint').addClass("hide");
        
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
      
          $("#ToolTables_tbl-settlementCustomPayment_4").click(function(){
      
       $("br").addClass("hide");      
            $("#search-settlementcashier").addClass("hide");
            $("#showCshierName").css("display","block"); 
             $("#hideinprint").addClass("hide");addClass("hide");addClass("hide");

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").addClass("hide");addClass("hide");addClass("hide");
           $("#check_customers").addClass("hide");addClass("hide");addClass("hide");    
       
           $('#hideinprint').addClass("hide");addClass("hide");addClass("hide");
        
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
      
          $("#ToolTables_tbl-settlementCustomRefund_4").click(function(){
       $("br").addClass("hide");
            
            $("#search-settlementcashier").addClass("hide");
            $("#showCshierName").css("display","block"); 
             $("#hideinprint").addClass("hide");addClass("hide");

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").addClass("hide");addClass("hide");
           $("#check_customers").addClass("hide");addClass("hide");    
       
           $('#hideinprint').addClass("hide");addClass("hide");
        
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
      
          $("#ToolTables_tbl-TransfromCashirtoCashir_4").click(function(){
      
             $("br").addClass("hide");
            $("#search-settlementcashier").addClass("hide");
            $("#showCshierName").css("display","block"); 
             $("#hideinprint").addClass("hide");

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").addClass("hide");
           $("#check_customers").addClass("hide");    
       
           $('#hideinprint').addClass("hide");
        
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
      
          $("#ToolTables_tbl-TransfairCashiertoBank_4").click(function(){
      
             $("br").addClass("hide");
            $("#search-settlementcashier").addClass("hide");
            $("#showCshierName").css("display","block"); 
             $("#hideinprint").addClass("hide");

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").addClass("hide");
           $("#check_customers").addClass("hide");    
       
           $('#hideinprint').addClass("hide");
        
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
      
          $("#ToolTables_tbl-TransfaierBankCashir_4").click(function(){
       $("br").addClass("hide");
            
            $("#search-settlementcashier").addClass("hide");
            $("#showCshierName").css("display","block"); 
             $("#hideinprint").addClass("hide");

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").addClass("hide");
           $("#check_customers").addClass("hide");    
       
           $('#hideinprint').addClass("hide");
        
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
      
          $("#ToolTables_tbl-finalsttmentCashier_4").click(function(){
       $("br").addClass("hide");
            
            $("#search-settlementcashier").addClass("hide");
            $("#showCshierName").css("display","block"); 
			 $("#hideinprint").addClass("hide");

           
           $("table").css("width","100%");
            // $("#search-onecustomer").css("visibility","hidden");
            $("#search-onecustomer").addClass("hide");
        
            $("#check_customer").addClass("hide");
           $("#check_customers").addClass("hide");    
       
           $('#hideinprint').addClass("hide");
        
            $("#ShowCustomerONPrint1").css("display","block"); 
             $("#ShowSupplierONPrint1").css("display","block"); 
            $("#Showprouduct").addClass("hide"); 

    
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
          $("#search-settlementcashier").removeClass("hide");   
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
    










$(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#search-settlementcashier").prop("disabled",false);
});
});







