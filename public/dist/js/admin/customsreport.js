

var cuastomereoprt = function () {};
 
$(function(){ _cuatomereoprt = new cuastomereoprt(); });

$(document).ready(function() {
 $('#search-CustomStatment').click(function(){
        _cuatomereoprt.searchfortables();

setTotalRefund(0);
setTotalCMont(0);
 SetTotal(0);
SetBalnce('');
SetOpeningBalnce(0);

//         $(this).prop("disabled",true);
    });                  
});




$("document").ready(function(){

//    $("#CustomsPRint2525").css("display","none");
    
    
    
    // $('#tbl-customeropeningbalance').DataTable();

    $("#CustomIdStatment").select2({       
        placeholder: "Search for an Custom Name",
        ajax: {
            url: 'autocomplete',
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type : 'post',
            data: function (params) {
                var queryParameters = {
                    CustomName: params.term
                }
                return queryParameters;
            },
            processResults: function (output) {
                if (output.status){
                    return {
                        results: $.map(output.data, function (item) {
                            return {
                                text: item.CustomName,
                                id: item.CustomID
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

/*set & get some Value */
//Function to get total payment
var TotalRefund=0;
function setTotalRefund(data){
TotalRefund = data ; 
// console.log("اجمالى المرتجعات :"+TotalRefund);
}
//function to fet all customs 

var TotalCMount = 0; 
function setTotalCMont(data){
TotalCMount = data; 
// console.log("اجمالى المقبوضات"+TotalCMount);

}


FinalPayment= 0;
function SetTotal(data)
{
   FinalPayment = data;  
   // console.log("اجمالى المدقوعات:" +FinalPayment); 
}

BalnceType='';
function SetBalnce(data)
{
    BalnceType = data;  
   // console.log(" نوع الجساب: " +BalnceType); 
}
OpeningBalance= 0;
function SetOpeningBalnce(data)
{
    OpeningBalance =data;  
   console.log("الرصيد الافتااج :"+OpeningBalance); 
}


    
cuastomereoprt.prototype.searchfortables = function(){


 var t = $('#tbl-CustomPaymentReport').DataTable();
    

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
    


    /*Custom Refund Table */
     var t3 = $('#tbl-CustomRefund').DataTable();
    
    try
    {
    t3
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    } 
    /*Custome Deposit Data*/ 
         var t4 = $('#tbl-CustomDeposit').DataTable();
    
    try
    {
    t4
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
    
    
      $.ajax({
            url: "loadCustompayment",
            type: "post",
            data: $('#customStatmentform-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
      
      var obj = eval(output)
      
      var input = $("#customStatmentform-repo-form :input");
       // console.log(input);
      
         var x= input[2].value;
        // console.log(input[2].value);
            var cboCustomerID = $( "#CustomIdStatment" ).clone();
            $(cboCustomerID).val(x);

             var text= $('option:selected',cboCustomerID).text() ;
           // console.log(text);    
          
//        document.getElementById('CustomsPRint2525').innerHTML="أسم المستخلص :"+text; 
          
        $("#CustomsPRint2525").text("اسم المستخلص: "+text);
//  console.log(C_Name);     
      for(var i =0 ; i < obj.length ; i++)
          {
              
              
              text = '<tr><td>'+obj[i].TransDate+'</td>'+
                     '<td>'+obj[i].CustomName+'</td>'+
                     '<td class="payment">'+obj[i].Mount+'</td>'+'</tr>';
                         
                t.row.add( $(text) ).draw();
              
          }
      _cuatomereoprt.CheckTotal();
       _cuatomereoprt.finalstatment();
 }).error(function (data) {
     _cuatomereoprt.finalstatment();
        showError('',data);
        }); 
   
    
    
         $.ajax({
            url: "customefinalstatment",
            type: "post",
            data: $('#customStatmentform-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
      
      
        var  obj = eval(output);  

          var Mount = 0;
        var balncetype ='';

SetBalnce(balncetype);
SetOpeningBalnce(Mount);    

      for(var i = 0 ; i< obj.length ; i++){
             
                 console.log(obj);
               if(obj[i].Mount > 0){ 

                    Mount =obj[i].Mount;

                    }else{

                          Mount = 0;    
                   }

                   if(obj[i].Debt !== ''){

                        balncetype = obj[i].Debt;
                   }else{

                        balncetype = 0;
                   }
 console.log("%%%%%%%"+Mount);

SetBalnce(balncetype);
SetOpeningBalnce(Mount);  
              
              if(obj[i].Debt == 0){
document.getElementById('OpenningDate11').innerHTML="تاريخ الافتتاح :"+obj[i].TransDate;
document.getElementById('AccountBalance11').innerHTML="الرصيد الافتتاحى :"+ obj[i].Mount + " دائن";
              }else{
document.getElementById('OpenningDate11').innerHTML="تاريخ الافتتاح :"+obj[i].TransDate;
document.getElementById('AccountBalance11').innerHTML="الرصيد الافتتاحى :"+ obj[i].Mount + " مدين ";
                  
              }
             }//end of for 
 





       _cuatomereoprt.finalstatment();
 }).error(function (data) {
     _cuatomereoprt.finalstatment();
        showError('',data);
        }); 
    
    
    
    
         $.ajax({
            url: "customcontinaer",
            type: "post",
            data: $('#customStatmentform-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {

                obj =eval (output);
                 var CustomeMount = 0 ;
                    for(var i =0 ; i<obj.length ; i++)
                    {
                            customDepost = '<tr><td>'+obj[i].ContainerOpenDate+'</td>'+
                                                '<td>'+obj[i].CustomName+'</td>'+
                                                '<td class="sumMount">'+obj[i].CustomMount+'</td>'+
                                                '<td>'+obj[i].ContainerIntNum+'</td>'+'</tr>';

                                      t4.row.add( $(customDepost) ).draw();


         
             var  obj2 = eval(output); 
             
               if( CustomeMount > 0 )
                   {
                        CustomeMount = obj2[0].CustomMount;
                       
                   }else if (CustomeMount == '')
                       {
                           CustomeMount=0;
                           
                       }

 _cuatomereoprt.CheckTotalMount();

                    }//end of for 
        
             
            
             
             
             
             
           _cuatomereoprt.finalstatment();   
 }).error(function (data) {
     _cuatomereoprt.finalstatment();
        showError('',data);
        }); 
    
    /*Load Customer Refund */

         $.ajax({
            url: "CustomrefundData",
            type: "post",
            data: $('#customStatmentform-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {

            obj = eval (output);
            console.log(obj);

                    for(var i = 0 ; i<obj.length ; i++ ){
                            customrefund = '<tr><td>'+obj[i].RefundDate+'</td>'+
                                     '<td>'+obj[i].CustomName+'</td>'+
                                     '<td class="sumRefund">'+obj[i].Refund+'</td>'+
                                     '<td>'+obj[i].Notes+'</td>'+'</tr>';


                 
                      t3.row.add( $(customrefund) ).draw();

                         _cuatomereoprt.CheckTotalRefund();

                    }//end of for 


    _cuatomereoprt.finalstatment();   
 }).error(function (data) {
    _cuatomereoprt.finalstatment();
        showError('',data);
        }); 
    /**/
    
}//end of serch of table 

/*final statment */
cuastomereoprt.prototype.finalstatment = function (){
    /*Custom Final Statment */
 var t2 = $('#tbl-FinalCustomStatment').DataTable();
    
    try
    {
    t2
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
console.log("Ayhaga");
console.log("BalnceType"+BalnceType);
console.log("OpeningBalance"+OpeningBalance);

 var deptcustom3 = 0; 
 var credetcustom3 = 0; 
 var  final3 = 0; 


  if ( BalnceType === ''){

     deptcuatom3 = FinalPayment +TotalRefund;
     deptcustom3 =TotalCMount;
     final3 = deptcuatom3 - deptcustom3;

// crdet 

}else if ( BalnceType == 0) {

 deptcustom3=FinalPayment +TotalRefund  +TotalCMount
credetcustom3=OpeningBalance + TotalCMount ;
final3=deptcustom3 - credetcustom3;
// dept
   }else if(BalnceType == 1){

  deptcustom3= OpeningBalance + FinalPayment + TotalRefund;
 credetcustom3 = TotalCMount;
 final3 =  deptcustom3 -credetcustom3 ;
}


tbl = '<tr><td>'+deptcustom3+'</td>'+
          '<td>'+credetcustom3+'</td>'+
          '<td>'+final3+'</td>'+'</tr>';

  t2.row.add( $(tbl) ).draw();







}// end of fn

/*end of fn*/


$(document).ready(function(){
    
    var FinalCustomStatment = $('#tbl-FinalCustomStatment').DataTable({ 
       dom: 'T<"clear">lfrtip',
    
    });

    var CustomRefund = $("#tbl-CustomRefund").DataTable({
              dom: 'T<"clear">lfrtip',
    });
        var CustomRefund = $("#tbl-CustomDeposit").DataTable({
              dom: 'T<"clear">lfrtip',
    });
    
    var table = $('#tbl-CustomPaymentReport').DataTable({
        dom: 'T<"clear">lfrtip',
//        "columnDefs": [
//            { "visible": false, "targets": 1 }
//        ],
        "order": [[ 2, 'asc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="3">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            });
            
    
     $('#tbl-CustomPaymentReport tbody').find('.group').each(function(i, v) {
                            var rowCount = $(this).nextUntil('.group').length;

                            // console.log("####");
                            var total_sum = 0;
                            $(this).nextUntil('.group').each(function() {
//                                console.log($(this));
//                                console.log($(this).find(".sum").text());
                                total_sum = total_sum + parseInt($(this).find(".payment").text());
                            });
//console.log(total_sum);
                            // console.log(total_sum);
                            // console.log("####");
                             if ($(this).nextUntil('.group').next())
                             {
                                 // console.log($(this).nextUntil('.group').last());
                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter"> <td colspan="2"></td><td colspan="1">'+"مجموع المصروفات: "+total_sum+'</td></tr>')
                             }
                        
                        });
                    
            
        }
    }); 
  
    
 

});

$(document).ready(function(){
    
    $("#ToolTables_tbl-CustomPaymentReport_4").click( function(){
         $("br").addClass("hide");
          $("table").css("width","100%");
        $("#search-CustomStatment").addClass("hide");
        $("#CustomsPRint2525").css("display","block")
         $("#hiddenPrint").css("display","none");
        
     	  window.print();
    });
    
    

    
    $("#ToolTables_tbl-FinalCustomStatment_4").click(function(){
         $("br").addClass("hide");
    $("table").css("width","100%");
    $("#search-CustomStatment").addClass("hide");
    $("#CustomsPRint2525").css("display","block");
    $("#hiddenPrint").css("display","none");
        
 	  window.print();
    })
    
    
        $("#ToolTables_tbl-CustomDeposit_4").click(function(){
         $("br").addClass("hide");
    $("table").css("width","100%");
    $("#search-CustomStatment").addClass("hide");
    $("#CustomsPRint2525").css("display","block");
    $("#hiddenPrint").css("display","none");
        
      window.print();
    })
    
        $("#ToolTables_tbl-CustomRefund_4").click(function(){
         $("br").addClass("hide");
    $("table").css("width","100%");
    $("#search-CustomStatment").addClass("hide");
    $("#CustomsPRint2525").css("display","block");
    $("#hiddenPrint").css("display","none");
        
      window.print();
    })
    
});

 $(document).keyup(function(e){
     
   if (e.keyCode == 27) {
     
              $("#search-CustomStatment").removeClass("hide");
            $("#CustomsPRint2525").css("display","none")
            $("#hiddenPrint").css("display","block");
   }
     
 })   
    
    
cuastomereoprt.prototype.CheckTotal = function(){
 
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-CustomPaymentReport tr");
 
            $dataRows.each(function() {
                $(this).find('.payment').each(function(i){        
                    totals[i]+=parseInt( $(this).html());

                    SetTotal(totals[i])
                });
            });
            $("#tbl-CustomPaymentReport th.total").each(function(i){  
                $('.total').html("اجمالى الدفعات:"+totals[i]);
            });
 
}



// print all tables 

 function Print77(){

     
    
  
     $("br").addClass("hide");

    // alert("aaa");
    $("#search-CustomStatment").addClass("hide");
    $(".DTTT").addClass("hide");
    $("#tbl-SupplierReport_filter").addClass("hide");
    $(".dataTables_length").addClass("hide");
    $(".dataTables_filter").addClass("hide");
    $(".pagination").addClass("hide");
    $(".panel-heading").addClass("hide");
    // $(".box-header").addClass("hide");
    $(".content-header").addClass("hide");
    $(".main-header").addClass("hide");
    $(".sidebar-menu").addClass("hide");
    
    $("#dataTables_filter").addClass("hide");
//    $("#print").css("display","none");
    $("#CustomsPRint2525").css("display","block")
        
   
//	 $("#ForeignSuppliersID_chosen").css("display","none");
//	 $("#cboContainerID_chosen").css("display","none");
//	 $("#cboSerialContainerID_chosen").css("display","none");
	  $("#hiddenPrint").css("display","none");
     
	 $("#ShowSuppliers").css("display","block");
//     $("#ShowContiner").css("display","block");   
//    $("#ShowSieralContiner").css("display","block");  
     
     // if(checkRadio == 1){
     //    $("#Combine").css("visibility","hidden");    
     //     $("#comb2").css("visibility","hidden");
     //  }
     //    else            
     //    {
     //        $("#Individuale").css("visibility","hidden"); 
     //        $("#indi2").css("visibility","hidden");
     //    }

     
   window.print();

}


     function myFunction77(e){

     if (e.keyCode == 27) {    
     $("br").removeClass("hide"); 
        $("#search-CustomStatment").removeClass("hide");
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
//        $("#ForeignSuppliersID_chosen").css("display","block");
//        $("#cboContainerID_chosen").css("display","block");
//        $("#cboSerialContainerID_chosen").css("display","block");
		 
		 $("#print").css("display","block");
		
		 $("#ShowSuppliers").css("display","none");
		 $("#hiddenPrint").css("display","block");
         $("#CustomsPRint2525").css("display","none")
//		 $("#ShowContiner").css("display","none"); 
         
//		 $("#ShowSieralContiner").css("display","none"); 
   
        $("#dataTables_filter").removeClass("hide");
      
  
        if(checkRadio == 1){
            $("#Combine").css("visibility","visible");
            $("#comb2").css("visibility","visible");  
        }
        else{
            $("#Individuale").css("visibility","visible");
            $("#indi2").css("visibility","visible");
        }
     
   

    }
}

//$(document).ready(function(){
//    
//    
//     $( ".datepicker" ).datepicker({
//            dateFormat: 'yy/mm/dd',
//            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
//
//        });
//	
//    
//})

/*get total mount*/

cuastomereoprt.prototype.CheckTotalMount= function(){
 
var Cmount=[0,0,0];
 
            var $dataRows=$("#tbl-CustomDeposit tr");
 
            $dataRows.each(function() {
                $(this).find('.sumMount').each(function(i){        
                    Cmount[i]+=parseInt( $(this).html());
                            setTotalCMont(Cmount[i]);
                });
            });
            $("#tbl-CustomDeposit th.TotalCustomMount").each(function(i){  
                $('.TotalCustomMount').html("اجمالى المبلغ :"+Cmount[i]);
            });
 
}
cuastomereoprt.prototype.CheckTotalRefund= function(){
 
var CRefund=[0,0,0];
 
            var $dataRows=$("#tbl-CustomRefund tr");
 
            $dataRows.each(function() {
                $(this).find('.sumRefund').each(function(i){        
                    CRefund[i]+=parseInt( $(this).html());
                 setTotalRefund(CRefund[i]);
                });
            });
            $("#tbl-CustomRefund th.TotalRefundMount").each(function(i){  
                $('.TotalRefundMount').html("اجمالى المبلغ :"+CRefund[i]);
            });
 
}









