var totalsuppliers = function () {};

$(function(){ _totalsuppliers = new totalsuppliers(); });



$(document).ready(function() {
 $('#search-TotalCustomers').click(function(){
$("#search-TotalCustomers").prop("disabled",true);
        _totalsuppliers.searchfortables();
    });
});

$(document).ready(function(){
     $("#TotalCustomerID").select2({
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
	


function getCustomerName(CustomerID)
    {
        var cboCustomerID = $( "#totalcustomers-repo-form #TotalCustomerID" ).clone();
        $(cboCustomerID).val(CustomerID);

        return $('option:selected',cboCustomerID).text() ; 
    }
 
checkRadio=1;
checkbox=0;
checkbox2=1;

function individuale(){
checkRadio=1;
}


function combine(){
checkRadio=2;
}
function combinePro(){
checkRadio=3;
}


function checking(){
checkbox=1;
}

/*set and get */
var pTotal=0;
function setTotalInProduct(ProTotal){
pTotal = ProTotal ;
console.log(pTotal);
}

$('#check_enable').change(function(){

if($(this).is(":checked")){
    $('#TotalCustomerID').prop('disabled', false).trigger("chosen:updated");
}
else{$('#TotalCustomerID').prop('disabled', true).trigger("chosen:updated"); 
    }
});

$('#Check_Supplier').change(function(){

if($(this).is(":checked")){
$('#SupplierType').prop('disabled', false).trigger("chosen:updated");
 $('#SupplierType').css("background","#fff");      
}
else{
$('#SupplierType').prop('disabled', true).trigger("chosen:updated");
 $('#SupplierType').css("background","#EEE");  
}
});






totalsuppliers.prototype.searchfortables = function(){
   
 var t = $('#tbl-TotalCustomers').DataTable();
    
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


    var tabs = $('#tbl-abstractSupplers').DataTable();
    
    try
    {
    tabs
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }
    
           
        $.ajax({
            url: "loadCustomersData",
            type: "post",
            data: $('#totalcustomers-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
         
           
        var input=$('#totalcustomers-repo-form :input');
//            console.log(input);
           // console.log(input[2].value);
            var x= input[3].value;
            
            
            var text=getCustomerName(x);
       
            
            $("#ShowONPrint").text("اسم التاجر:  "+text);
         
            var obj = eval (output);
               // console.log(obj);
             var splitfinal = 0 ; 
             var final = 0;
             // var Suppid = 0;
             var supplierid= 0 ;
             var totalofsupp = 0; 
               for (var i = 0; i < obj.length; i++) {
   
                     text = '<tr><td class="hidecombine2 c_pro c_pro2">'+obj[i].RefNo+'</td>'+
                            '<td class="hidecomb S_Name c_pro c_pro2">'+obj[i].SupplierName+'</td>'+
                            '<td class="Pname hidecombine2 c_pro c_pro2"  >'+obj[i].ProductName+'</td>'+
                            '<td class="sum_weight hidecombine2 c_pro c_pro2"  >'+obj[i].Weight+'</td>'+
                            '<td class="sum_quantity hidecombine2 c_pro c_pro2" >'+obj[i].Quantity+'</td>'+
                            '<td class="sum_productprice hidecombine2 c_pro c_pro2" >'+obj[i].ProductPrice+'</td>'+
                            '<td class="sum_Total sum c_pro c_pro2" >'+obj[i].Total+'</td>'+
                            '<td style="display:none;" class="c_pro c_pro2" >'+obj[i].SupplierID+'</td>'+
                            '<td class="Cname hidecombine2 c_pro c_pro2">'+obj[i].CustomerName+'</td>'+ '</tr>';
 totalofsupp=obj[i].SalesID;
 supplierid=obj[i].SupplierID;

                      

                        final+=Math.round(obj[i].Total);

                       t.row.add( $(text) ).draw();


                }//end of for 

                    // if(totalofsupp == supplierid)
                    //         {
                                

                    //                 // alert("77777");
                    //                   splitfinal+=final;
                                     
                    //                     // setsupptotal(splitfinal);
                    //         }else{
                    //               splitfinal+=final;

                    //             // alert("error012");
                    //         }


                // document.getElementById("firsttotal").innerHTML ='جمالى الفواتير :'+tTotal;   
                // document.getElementById('total').innerHTML='الاجمالى :'+final;

                $("#total").text(final);

                // _totalsuppliers.CheckTotal();



                // Crazy Test To Get Some Result in Conbaine by Prouducts
                // if(checkRadio == 3 ){

           //        var groups = {};
           //      var proTOtal= 0 ; 
           //      var totalpro = 0 ;

           //  for(var j = 0; j < obj.length; j++) {
           //       var item = obj[j];

           //    if(!groups[item.SalesID]) {
           //        groups[item.SalesID] = [];
           //      }

           //      groups[item.SalesID].push({
           //        total : item.Total,
           //        SalesID: item.SalesID
                   
           //    });

           //      }//end of first loop
                       
           // // console.log(groups);

           //    var result = [];

           //       for(var x in groups) {

           //          // console.log(x);

           //          var old_Key = "";
           //           TotalSalesID = 0;

           //          for(var y in groups[x])
           //          {
           //            if (groups[x][y]["SalesID"] == old_Key)
           //            {
           //              TotalSalesID = TotalSalesID + groups[x][y]["total"] ;
           //              old_Key = groups[x][y]["SalesID"];
           //            }
           //            else
           //            {
           //              console.log("SalesID: " + old_Key + " / " + TotalSalesID);
           //              TotalSalesID = groups[x][y]["total"] ;
           //              old_Key = groups[x][y]["SalesID"];
           //            }
           //            // setTotalInProduct(TotalSalesID);
           //          }// end of for 

           //              // console.log("SalesID: " + old_Key + " / " + TotalSalesID);

                
           //          }// end of socend loop

  
           //    }//end of combaine by products

                         /*End OF Test */


           }).error(function (data) {
        showError('',data);
        }); 

  /*  Abstract of  Suplers */    
                    $.ajax({
                  url: "getsupplersvalue",
                  type: "post",
                  data: $('#totalcustomers-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
                  dataType: "json"
                       
                        }).done(function (output) { 

                          obj = eval(output);
                            SupplierName  = '';
                            value = 0;
                          console.log(obj);

                            for (var i = 0; i < obj.length; i++) {
                              SupplierName =  obj[i].SupplierName
                              value = obj[i].Total;

                          text2 = '<tr><td>'+obj[i].SupplierName+'</td>'+
                                   '<td>'+Math.round(obj[i].Weight) +'</td>'+
                                   '<td>'+Math.round(obj[i].Quantity) +'</td>'+
                                    '<td>'+Math.round(obj[i].Total) +'</td></tr>';

                                tabs.row.add( $(text2) ).draw();
                              

                 }
                            

                         }).error(function (data) {
                            showError('',data);
                         }); 
        
        
}



//-----------------------------------------------------------------------------

   $(document).ready(function() {

       
    
    var table = $('#tbl-TotalCustomers').DataTable({



        dom: 'T<"clear">lfrtip',
         "sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",
        "order": [[ 0, 'asc' ]],
//        
//                     "columnDefs": [
//            { "visible": false, "targets": 2},
//
//        ],
       "displayLength": 50,

        "drawCallback": function ( settings ) {

            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            
            



       if(checkRadio==2){
            
                           
                             // $(".hidecomb").css("display","none");
                             $(".hidecombine2").css("display","none");
           
            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                  '<tr class="group hide"><td colspan="8">'+group+'</td></tr>'
                    );
                    last = group;
                }
			});
           
           }
           


                                    

                    
              if(checkRadio==1){
    $(".hidecomb").css( "display","table-cell");
    $(".hidecombine2").css( "display","table-cell");
                api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                  '<tr class="group"><td colspan="7">'+group+'</td></tr>'
                    );
                    last = group;
                }
			});
                 
                   
                  
                       $('#tbl-TotalCustomers tbody').find('.group').each(function(i, v) {
                            var T_Weight =0;
                            var T_Quantity=0;
                            var T_ProductPrice=0;
                            var T_Total=0;
                            var ProductName;
                            var CustomerName;
                
         
                            var rowCount = $(this).nextUntil('.group').length;

                            var total_sum = 0;
                        
                            $(this).nextUntil('.group').each(function() {
                              
                                ProductName=$(this).find(".Pname").text();
                                CustomerName=$(this).find(".Cname").text();

                T_Weight = T_Weight + parseInt($(this).find(".sum_weight").text());
                T_Quantity = T_Quantity + parseInt($(this).find(".sum_quantity").text());
                T_ProductPrice = T_ProductPrice +parseInt($(this).find(".sum_productprice").text());
                T_Total = T_Total + parseFloat($(this).find(".sum_Total").text());
//                T_Total = (T_Total).toFixed(0);   
                                
                            });
                             if ($(this).nextUntil('.group').next() )
                             { 
                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter" style="background:#EDE5CA;"><td> المجموع</td><td colspan="6"></td><td>'+T_Total+'</td><td></td> </tr>')
                                
                             }

                        });   

                  
                   }
            
              if(checkRadio==2){

                  
                   $(".c_pro2").addClass("hide"); 
                   
//       $(".hidecomb").css( "display","none");
//    $(".hidecombine2").css( "display","table-cell");
                 
//                 $(".hidecomb").css("display","none");
                 
                  
                // $(".Pname").addClass("hide");
                // $(".sum_weight").addClass("hide");
                // $(".sum_quantity").addClass("hide");
                // $(".sum_productprice").addClass("hide");
                // $(".sum_Total").addClass("hide");
                // $(".Cname").addClass("hide");
                $('#tbl-TotalCustomers tbody').find('.group').each(function(i, v) {
                            var T_Weight =0;
                            var T_Quantity=0;
                            var T_ProductPrice=0;
                            var T_Total=0;
                            var ProductName;
                            var CustomerName;
                            var ST_Date; 
                            
                            var rowCount = $(this).nextUntil('.group').length;

                            var total_sum = 0;
                        
                            $(this).nextUntil('.group').each(function() {
                              
                                ProductName=$(this).find(".Pname").text();
                                CustomerName=$(this).find(".Cname").text();

                T_Weight = T_Weight + parseInt($(this).find(".sum_weight").text());
                T_Quantity = T_Quantity + parseInt($(this).find(".sum_quantity").text());
                T_ProductPrice = T_ProductPrice +parseInt($(this).find(".sum_productprice").text());
                T_Total = T_Total + parseInt($(this).find(".sum_Total").text());
                                ST_Date  =$(this).find(".salesdate").text();
                                S_Name = $(this).find(".S_Name").text();
                            });
                             if ($(this).nextUntil('.group').next() )
                             { 
                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter" style="background:#EDE5CA;"><td>'+S_Name+'</td><td >'+T_Total+'</td> </tr>')
                                         // setsupptotal(T_Total);
                             }
                           
                             

            
                        });
             }
            

              if(checkRadio==3){


                  
                      $(".hidecomb").css( "display","table-cell");
                  
                     $(".hidecombine2").css( "display","table-cell");
                     $(".c_pro").css("display","none");
                  // console.log("0");
                  
                  // var T_Total=0;
                    /* run function*/



                api.column(1, {page:'current'} ).data().each( function ( group, i ) {



                  // console.log("group" + group);
                if ( last !== group )
                  
                  {
                    $(rows).eq( i ).before(
                  

                  '<tr style="" class="group"><td colspan="5">'+group+'</td></tr>'
                    );

                    last = group;
                  
                }


                  

                // console.log("1");
			});      




                  
                 
                  
                  
                    api.column(2, {page:'current'} ).data().each( function ( group, i ) {

                if ( last !== group ) {

                    $(rows).eq( i ).before(
                  '<tr style="display:none" class="group"><td colspan="9">'+group+'</td></tr>'
                    );
                    last = group;
                    
                   
                }
                   // console.log("2");  
			});

             // api.column(8, {page:'current'} ).data().each( function ( group, i ) {

             //    if ( last !== group ) {

             //        $(rows).eq( i ).before(
             //      '<tr style="display:none" class="group"><td colspan="9">'+group+'</td></tr>'
             //        );
             //        last = group;
                    
                   
             //    }
                   // console.log("2");  
      // });
                 
                 

 // $(".totalSupplierMount").text(Supptotal);
                 
                $('#tbl-TotalCustomers tbody').find('.group').each(function(i, v) {
                            var T_Weight =0;
                            var T_Quantity=0;
                            var T_ProductPrice=0;
                            var T_Total=0;
                            var ProductName;
                            var CustomerName;
                            var S_date = 0 ; 
         
                            var rowCount = $(this).nextUntil('.group').length;

                            var total_sum = 0;
                        

                            // console.log("3");

                            $(this).nextUntil('.group').each(function() {
// console.log("2");                              
                                ProductName=$(this).find(".Pname").text();
                                CustomerName=$(this).find(".Cname").text();

                T_Weight = T_Weight + parseInt($(this).find(".sum_weight").text());
                T_Quantity = T_Quantity + parseInt($(this).find(".sum_quantity").text());
                T_ProductPrice = T_ProductPrice +parseFloat($(this).find(".sum_productprice").text());
                T_ProductPrice = Math.round(T_ProductPrice);
                T_Total = T_Total + parseInt($(this).find(".sum_Total").text());
                     // setTotalInProduct(T_Total);
                S_date = $(this).find(".salesdate").text();      
                ProductName=$(this).find(".Pname").text();               
                                
                                
                            });
                             if ($(this).nextUntil('.group').next() )
                             { 
                                // console.log("4");
 $(this).nextUntil('.group').last().after('<tr class="groupfooter" style="background:#EDE5CA;"><td>'+ProductName+'</td><td>'+T_Weight+'</td><td>'+T_Quantity+'</td><td >'+T_Total+'</td></tr>')
    // console.log(T_Total);
                                 // setsupptotal(T_Total);
                             }
                       // setsupptotal(T_Total);                 
                        }); 
    
            // setsupptotal(T_Total);
      

                  
                  
//==========================end anther test===============================================================                  
              }//end of combine by prouduct 

        }
        
    }); 

    

    // Order by the grouping
//    $('#tbl-TotalCustomers tbody').on( 'click', 'tr.group', function () {
//        var currentOrder = table.order()[0];
//        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
//            table.order( [ 2, 'desc' ] ).draw();
//        }
//        else {
//            table.order( [ 2, 'asc' ] ).draw();
//        }
//    } );
});


// Supptotal = 0 
// function setsupptotal(data){
// Supptotal =data;
// console.log(Supptotal);
// }
//-------------------------------------------------------------------------

    var tabs222 = $('#tbl-abstractSupplers').DataTable({

        dom: 'T<"clear">lfrtip',
         "sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",


         });

$(document).ready(function() {

  
   


    $("#ToolTables_tbl-TotalCustomers_4").on("click", function(){
      $("br").addClass("hide");
            $("table").css("width","100%");
            // $("#search-TotalCustomers").css("visibility","hidden");
            $("#search-TotalCustomers").addClass("hide");
		    //check chosen customer name
        //     $("#check_enable").css("visibility","hidden"); 
        //     $("#check_label").css("visibility","hidden");
        // $("#check_Customers").css("visibility","hidden");
        $("#check_enable").addClass("hide");
            $("#check_label").addClass("hide");
		    $("#check_Customers").addClass("hide");
		    //checkbox to view customer name 
		    $("#check").addClass("hide");
		    $("#check_Customers").addClass("hide");
		
            $("#ShowONPrint").css("display","block");
            $("#hideOnPrint").addClass("hide");
        
        if(checkRadio==1){

            $("#rbtnCombine").css("visibility","hidden");     
            $("#comb").css("visibility","hidden");
            $("#rbtnCombineProduct").css("visibility","hidden");
            $("#combPRo").css("visibility","hidden");

        }else if(checkRadio==3){
            
             $("#rbtnCombine").css("visibility","hidden");     
            $("#comb").css("visibility","hidden");
            
             $("#rbtnIndividuale").css("visibility","hidden");
            $("#indi").css("visibility","hidden");
            
        }else{
            
        $("#rbtnIndividuale").css("visibility","hidden");
            $("#indi").css("visibility","hidden");
               $("#rbtnCombineProduct").css("visibility","hidden");
            $("#combPRo").css("visibility","hidden");
        }
		
        if($("#check_enable").is(":checked")) 
        {
            $("#ShowONPrint").css("visibility","visible"); 
        }else{
            $("#ShowONPrint").css("visibility","hidden");  
        }
        window.print();
        
        
    });


     $("#ToolTables_tbl-abstractSupplers_4").click(function(){
      
     
            $("br").addClass("hide");
            $("table").css("width","100%");
    
            $("#search-TotalCustomers").addClass("hide");
        
        $("#check_enable").addClass("hide");
            $("#check_label").addClass("hide");
        $("#check_Customers").addClass("hide");
        //checkbox to view customer name 
        $("#check").addClass("hide");
        $("#check_Customers").addClass("hide");
    
            $("#ShowONPrint").css("display","block");
            $("#hideOnPrint").addClass("hide");
        
        if(checkRadio==1){
            $("#rbtnCombine").css("visibility","hidden");     
            $("#comb").css("visibility","hidden");
            $("#rbtnCombineProduct").css("visibility","hidden");
            $("#combPRo").css("visibility","hidden");

        }else if(checkRadio == 3){

             $("#rbtnCombine").css("visibility","hidden");     
            $("#comb").css("visibility","hidden");
            
             $("#rbtnIndividuale").css("visibility","hidden");
            $("#indi").css("visibility","hidden");
            
        }else{
            
        $("#rbtnIndividuale").css("visibility","hidden");
            $("#indi").css("visibility","hidden");
               $("#rbtnCombineProduct").css("visibility","hidden");
            $("#combPRo").css("visibility","hidden");
        }
    
        if($("#check_enable").is(":checked")) 
        {
            $("#ShowONPrint").css("visibility","visible"); 
        }else{
            $("#ShowONPrint").css("visibility","hidden");  
        }
           window.print();
        

       });  
      
    });
    $(document).keyup(function(e) {
     if (e.keyCode == 27) {
      $("br").removeClass("hide");
          $("#search-TotalCustomers").removeClass("hide");
          $("table").css("width","100%");
            $("#search-TotalCustomers").removeClass("hide");
		     //check chosen customer name
            $("#check_enable").removeClass("hide"); 
            $("#check_label").removeClass("hide"); 
		    $("#check_Customers").removeClass("hide");  
		     // checkbox to view customer name 
		    $("#check").removeClass("hide");
		    $("#check_Customers").removeClass("hide");
		 
            $("#ShowONPrint").css("display","none");
            $("#hideOnPrint").removeClass("hide");


             $("#rbtnCombine").css("visibility","visible");     
            $("#comb").css("visibility","visible");
            $("#rbtnCombineProduct").css("visibility","visible");
            $("#combPRo").css("visibility","visible");

            $("#rbtnIndividuale").css("visibility","visible");
            $("#indi").css("visibility","visible");
        
        // if(checkRadio==1){
        //   $("#rbtnCombine").css("visibility","visible"); 
        //   $("#comb").css("visibility","visible"); 

        //    }else if(checkRadio==3){

        //      $("#rbtnCombine").css("visibility","visible");     
        //     $("#comb").css("visibility","visible");
            
        //      $("#rbtnIndividuale").css("visibility","visible");
        //     $("#indi").css("visibility","visible");

        //    }else{

        //   $("#rbtnIndividuale").css("visibility","visible");
        //   $("#indi").css("visibility","visible");
        // }
        
		 	
		 if($("#check_enable").is(":checked")) 
   {
    	$("#ShowONPrint").css("visibility","visible"); 
   }else{
    
     
    $("#ShowONPrint").css("visibility","hidden");  
   }
         
    }
});
    


totalsuppliers.prototype.CheckTotal = function(){
 
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-TotalCustomers tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=Math.round(parseFloat( $(this).html()));
                });
            });
            $("#tbl-TotalCustomers th.total").each(function(i){  
                $('.total').html("اجمالى المبلغ :"+totals[i]);
            });
 
}


 $(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#search-TotalCustomers").prop("disabled",false);
});
});