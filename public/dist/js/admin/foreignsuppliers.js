var foreignSuppliers = function () {};

$(function(){ _foreignsuppliers = new foreignSuppliers(); });



$(document).ready(function() {
 $('#search-foreignSuppliers').click(function(){
$("#search-foreignSuppliers").prop("disabled",true);
       _foreignsuppliers.searchfortables();
  
    });

//$(document).ready(function() {
//	$("#ForeignSuppliersID").select2({
//  placeholder: " ",
//	  ajax: {
//                url: 'foreignsupplierautocomplete',
//                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
//                type : 'post',
//                data: function (params) {
//                    var queryParameters = {
//                        SupplierName: params.term
//                    }
//                    return queryParameters;
//                },
//                processResults: function (output) {
//                    if (output.status){
//                        return {
//                            results: $.map(output.data, function (item) {
//                                return {
//                                    text: item.SupplierName,
//                                    id: item.SupplierID,
//                                    comm : item.SupplierCommision ,
//                                    suptype : item.SupplierType
//                                }
//                            })
//                        };
//                    }else{
//                        return {
//                            results: $.map(output.data, function (item) {
//                                return {
//                                    text: item.message,
//                                    id: item.id
//                                }
//                            })
//                        };
//                    }
//
//                }
//            }
//});
//	
//
//}); 
  
});
checkRadio=1;
function individuale(){
checkRadio=1;
}


function combine(){
checkRadio=2;
}
function combineProduct(){
checkRadio=3;
}




 //------------------------------sarech for tables start---------------------- 
 Total=0;
 OtherEx=0;
 Nawlon=0;
 Commision=0;

foreignSuppliers.prototype.setTotal = function(data){
    Total=data;  
 }
foreignSuppliers.prototype.setOtherEx = function(data){
    OtherEx=data;  
 }
foreignSuppliers.prototype.setNawlon = function(data){
    Nawlon=data;  
 }
foreignSuppliers.prototype.setCommision = function(data){
    Commision=data;  
 }


// local intNum
var LocalIntNum=0;
function SetIntNum(data)
{
LocalIntNum=data;
console.log(LocalIntNum);    
}
 
function getSuppliersName(SupplierID)
    {
       
        var cboForeignSuppliersID = $( "#ForeignSuppliersID69" ).clone();
        $(cboForeignSuppliersID).val(SupplierID);

        return $('option:selected',cboForeignSuppliersID).text() ; 
    } 


function getContainerName(ContainerID)
    {
        
        var cboContainerID = $( "#cboContainerID" ).clone();
        $(cboContainerID).val(ContainerID);

        return $('option:selected',cboContainerID).text() ; 
    }

function getSerialContainerName(SerialContainerID)

    {
     
        var cboSerialContainerID = $( "#cboSerialContainerID" ).clone();
        $(cboSerialContainerID).val(SerialContainerID);

        return $('option:selected',cboSerialContainerID).text() ; 
    }


foreignSuppliers.prototype.searchfortables = function(){
   
 var t = $('#tbl-ForeignSuppliers').DataTable();
 var table = $('#tbl-FinalData').DataTable();
 var custome =  $('#tbl-custome').DataTable();
    
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
	
	try
    {
    table	
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
//        console.log(ex);
    }
    
    try
    {
     custome	
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
//        console.log(ex);
    }
    
	// console.log($('#foreignsuppliers-repo-form :input'));
//	console.log($("================================="));
           
        $.ajax({
            url: "loadforeignsupppliers",
            type: "post",
            data: $('#foreignsuppliers-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
       
          .done(function (output) {
		  console.log (output);    	
  
            var obj = eval (output);
      
			_foreignsuppliers.setCommision(obj[0].Commision);
			_foreignsuppliers.setNawlon(obj[0].Nowlon);
			_foreignsuppliers.setOtherEx(obj[0].OtherExpenses);
			
			var TotalSum=0;
			   for (var i = 0; i < obj.length; i++) {
			   TotalSum+=obj[i].Total;
			   console.log("FinalToall   "+TotalSum);
			   }

			
			_foreignsuppliers.setTotal(TotalSum);
			input=$('#foreignsuppliers-repo-form :input');
		 console.log(input);
			 
				 var x= input[2].value;
                 // console.log(input[2].value);
                  var y= input[4].value;
                  var z= input[6].value;
				console.log(x);
				console.log(y);
				console.log(z);


				 var text=getSuppliersName(x);
				 var text2=getContainerName(y);
				 var text3=getSerialContainerName(z);
			
                console.log(text);
                console.log(text2);
                console.log(text3);
			
		
				$("#ShowSuppliers").text("اسم المورد: "+text);			   
				 $("#ShowContiner").text("اسم الحاويه: "+text2); 
				 $("#ShowSieralContiner").text("مسلسل الحاويه: "+text3); 
		        
     			 console.log(text);
				 console.log(text2); 		
                 console.log(text3);    	
            
		            var T_Total=0;
                    var T_Crrying=0;
                    var T_totalFinal=0;
            
               for (var i = 0; i < obj.length; i++) {
				 var  firstotal =  obj[i].Total
                var   carrying  =  obj[i].Carrying
                var    IntNum = obj[i].ContainerIntNum;   
                   finaltotal=firstotal + carrying;
                   
                      if(obj[i].WeightType==0 ) {
        text = '<tr><td class="Date productcomp hidecombiner">'+obj[i].SalesDate+'</td>'+
               '<td class="productcomp">'+obj[i].ContainerIntNum+'</td>'+
               '<td class="productcomp C_Name hidecombiner">'+obj[i].CustomerName+'</td>'+
               '<td class="Pname hidecombiner  productcomp">'+obj[i].ProductName+'</td>'+
               '<td class="hidecombiner productcomp">الكيلو</td>'+
               '<td class="sum_weight hidecombiner  productcomp"  >'+obj[i].Weight+'</td>'+
               '<td class="sum_quantity hidecombiner  productcomp" >'+obj[i].Quantity+'</td>'+
               '<td class="sum_productprice hidecombiner  productcomp" >'+obj[i].ProductPrice+'</td>'+
               '<td class="sum sum_Total productcomp hidecombiner" >'+obj[i].Total+'</td>'+
               '<td class="crrying sumcrr hidecombiner productcomp" >'+obj[i].Carrying+'</td>'+
               '<td style="display:none" class="productcomp" >'+obj[i].RefNo+'</td>'+
               '<td style="display:none">'+obj[i].SupplierName+'</td>'+
               '<td class="finaltotal sumfinal productcomp hidecombiner">'+finaltotal+'</td>';
                           
                             }else{ 
         text = '<tr><td class="Date productcomp">'+obj[i].SalesDate+'</td>'+
                '<td class="productcomp">'+obj[i].ContainerIntNum+'</td>'+
                '<td class="productcomp C_Name">'+obj[i].CustomerName+'</td>'+
                '<td class="Pname hidecombiner  productcomp">'+obj[i].ProductName+'</td>'+
                '<td class="hidecombiner productcomp">الوزنة</td>'+
                '<td class="sum_weight hidecombiner  productcomp">'+obj[i].Weight+'</td>'+
                '<td class="sum_quantity hidecombiner  productcomp" >'+obj[i].Quantity+'</td>'+
                '<td class="sum_productprice hidecombiner  productcomp" >'+obj[i].ProductPrice+'</td>'+
                '<td class="sum sum_Total productcomp" >'+obj[i].Total+'</td>'+
                '<td class="crrying sumcrr hidecombiner productcomp" >'+obj[i].Carrying+'</td>'+
                '<td style="display:none" class="productcomp" >'+obj[i].RefNo+'</td>'+
                '<td style="display:none"  >'+obj[i].SupplierName+'</td>'+
                '<td class="finaltotal sumfinal productcomp" >'+finaltotal+'</td>';
									}
                      SetIntNum(IntNum)
                    t.row.add( $(text) ).draw();

                }
            
            

        _foreignsuppliers.CheckTotal1();
        _foreignsuppliers.CheckTotal2();
        _foreignsuppliers.CheckTotal3();
            

			$.ajax({
				url: "GetCustomMount",
				type: "post",
				data: $('#foreignsuppliers-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
				dataType: "json"
			})
				.done(function (output) {
				var obj = eval(output);
				var sum=0;

				for (var i = 0; i < obj.length; i++) {
					sum+=obj[i].CustomMount;
					sum2=obj[i].CustomMount;
					CustomName=obj[i].CustomName;
//					console.log(obj[i].CustomMount);
                    text4= '<tr><td>'+obj[i].CustomName+'</td>'+
                           '<td>'+obj[i].CustomMount+'</td>'+
                       '<td>'+LocalIntNum+'</td><tr>';
                    custome.row.add( $(text4) ).draw();

                    
				}
				 var b=sum+OtherEx+Nawlon
				var final=Total-b;
				
// 				console.log("..............................");
// 				console.log(sum);
// 				console.log(Total);
// 				console.log(OtherEx);
// 				console.log(Nawlon);
// 				console.log(Commision);
// 				console.log(final);
				finalcom=Math.round((Commision/100)*Total);
//				finalcom=Math.round((Commision/100)*final);
				finaltotal=final-finalcom;
				 text = '<tr><td>'+LocalIntNum+'</td>'+
                       '<td>'+Total+'</td>'+
					 	'<td>'+OtherEx+'</td>'+
					     '<td>'+sum+'</td>'+
					     '<td>'+Nawlon+'</td>'+
					     '<td>'+final+'</td>'+
                         '<td>'+finalcom+'</td>'+
                         '<td>'+finaltotal+'</td>';
  			
                    table.row.add( $(text) ).draw();

				
				
			}).error(function (data) {
					showError('',data);
				}); 
				   
          
       }).error(function (data) {
        showError('',data);
        }); 
	
}
	
//------------------------------sarech for tables end----------------------

function getContainerName(ContainerID)
    {
        var cboCustomerID = $( "#cboContainerID" ).clone();
        $(cboContainerID).val(ContainerID);
		
        return $('option:selected',cboContainerID).text(); 
    }


$(document).ready(function(){
$("#ForeignSuppliersID69").change(function(){
	
//	alert("مش وقتة ");
//    alert($(this).val());
//    
	x=$(this).val();
	console.log(x);
	  $.ajax({
            url: "loadforeignContainers",
            type: "post",
            data: $(this).val($(this).val()),
            dataType: "json"
        }).done(function (output) {
		  
		  
		  var obj = eval (output);
//            console.log(obj);
//		  	$('#cboContainerID').empty();
		  for (var i = 0; i < obj.length; i++){
              
//            var newOption = $('<option >''</option>');  
		  	var newOption = $('<option >'+ obj[i].ContainerIntNum +'</option>');
		  	$('#cboContainerID').append(newOption);
		  	$('#cboContainerID').trigger("chosen:updated");
		  }
//            $('#cboContainerID').empty();
       }).error(function (data) {
        showError('',data);
        }); 
	
});
$("#ForeignSuppliersID69").change(function(){
	
//	alert("مش وقتة ");
//    alert($(this).val());
//    
	x=$(this).val();
	console.log(x);
	  $.ajax({
            url: "loadserialContainers",
            type: "post",
            data: $(this).val($(this).val()),
            dataType: "json"
        }).done(function (output) {
		  
		  
		  var obj = eval (output);
//            console.log(obj);
//		  	$('#cboSerialContainerID').empty();
		  for (var i = 0; i < obj.length; i++){
		  	var newOption = $('<option>'+ obj[i].ContainerLocalNum +'</option>');
		  	$('#cboSerialContainerID').append(newOption);
		  	$('#cboSerialContainerID').trigger("chosen:updated");
		  }
//            	$('#cboSerialContainerID').empty();
       }).error(function (data) {
        showError('',data);
        }); 
	
});

});

//=============================Grouping====================================================
$(document).ready(function() {
    
    var table = $('#tbl-ForeignSuppliers').DataTable({
//        dom: 'T<"clear">lfrtip',
                  "columnDefs": [
            { "visible": false, "targets": 1 },
      
        ],
        "order": [[ 0, 'asc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            
            
             
              api.column(1, {page:'current'} ).data().each( function ( group, i ) {
          if(checkRadio==1){ 
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="11">مسلسل الحاوية : '+group+'</td></tr>'
                    );
 
                    last = group;
                }
              }
            });
            

    
            
            
              if(checkRadio==1){ 


              api.column(2, {page:'current'} ).data().each( function ( group, i ) {
          if(checkRadio==1){ 
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                       // '<tr class="group"><td colspan="11">: '+group+'</td></tr>'
                    );
 
                    last = group;
                }
              }
            });




                 $(".hidecombiner").css("display","table-cell");
                 $(".productcomp").css("display","table-cell");
                  
                  $('#tbl-ForeignSuppliers tbody').find('.group').each(function(i, v) {
                            var T_Weight =0;
                            var T_Quantity=0;
                            var T_ProductPrice=0;
                            var T_Total=0;
                            var ProductName;
					        var T_WeightType =0;
                            var T_Crrying=0;
                            var T_totalFinal=0;
                            //var CustomerName;
                
         
                            var rowCount = $(this).nextUntil('.group').length;

                            var total_sum = 0;
                        
                            $(this).nextUntil('.group').each(function() {
                              
                                ProductName=$(this).find(".Pname").text();
                                CustomerName=$(this).find(".Cname").text();

                    T_Weight = T_Weight + parseInt($(this).find(".sum_weight").text());
                            T_Weight  = Math.round(T_Weight);    
                    T_Quantity = T_Quantity + parseInt($(this).find(".sum_quantity").text());
                      T_Quantity = Math.round(T_Quantity);          
                    T_ProductPrice = T_ProductPrice + parseInt($(this).find(".sum_productprice").text());
                    T_ProductPrice = Math.round(T_ProductPrice);
                     T_Total = T_Total + parseInt($(this).find(".sum_Total").text());
                     T_Total = Math.round(T_Total);
                                
                     T_Crrying = T_Crrying + parseInt($(this).find(".crrying").text());
                     T_Crrying = Math.round(T_Crrying);
                                
                     T_totalFinal = T_Total +T_Crrying;
                     T_totalFinal = Math.round(T_totalFinal);
                               
                                

                            });
                             if ($(this).nextUntil('.group').next() )
                             { 
							
								 
                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter" style="background:#f90"><td>المجموع</td><td class="hidecombiner"></td><td class="hidecombiner"></td><td class="hidecombiner"></td><td class="hidecombiner">'+T_Weight+'</td><td class="hidecombiner">'+T_Quantity+'</td><td class="hidecombiner">'+T_ProductPrice+'</td><td >'+T_Total+'</td><td>'+T_Crrying+'</td><td></td><td>'+T_totalFinal+'</td> </tr>')
								 
							
                                
                             }
               
            
                        });
              
              
              }
            
            
            // combine 
            
             if(checkRadio==2){
                 
            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
   
                    $(".hidecombiner").css("display","none")
//                     $(".productcomp").css("display","none")
//                    $(".productcomp").css("display","table-cell");
                
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="11">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
                             });
                    
                    
                  api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr style="display:none" class="group"><td colspan="11">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
              
            });  

                    
                }

            
             if(checkRadio==2){

                $('#tbl-ForeignSuppliers tbody').find('.group').each(function(i, v) {
                            var T_Weight =0;
                            var T_Quantity=0;
                            var T_ProductPrice=0;
                            var T_Total=0;
                            var ProductName;
					        var T_WeightType =0;
                            var T_Crrying=0;
                            var T_totalFinal=0;
                            var Date ="";
                            var CName="";
                            //var CustomerName;
                
         
                            var rowCount = $(this).nextUntil('.group').length;

                            var total_sum = 0;
                        
                            $(this).nextUntil('.group').each(function() {
                              
                                ProductName=$(this).find(".Pname").text();
                                CustomerName=$(this).find(".Cname").text();

                    T_Weight = T_Weight + parseInt($(this).find(".sum_weight").text());
                            T_Weight  = Math.round(T_Weight);    
                    T_Quantity = T_Quantity + parseInt($(this).find(".sum_quantity").text());
                      T_Quantity = Math.round(T_Quantity);          
                    T_ProductPrice = T_ProductPrice + parseInt($(this).find(".sum_productprice").text());
                    T_ProductPrice = Math.round(T_ProductPrice);
                     T_Total = T_Total + parseInt($(this).find(".sum_Total").text());
                     T_Total = Math.round(T_Total);
                                
                               T_Crrying = T_Crrying + parseInt($(this).find(".crrying").text());
                     T_Crrying = Math.round(T_Crrying);
                                
                                   T_totalFinal = T_Total +T_Crrying;
                     T_totalFinal = Math.round(T_totalFinal);
                                
                                 Date=$(this).find(".Date").text();
                                 CName=$(this).find(".C_Name").text();

                            });
                             if ($(this).nextUntil('.group').next() )
                             { 
							
								 
                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter" style="background:#f90"><td>'+Date+'</td><td>'+CName+'</td><td>'+T_Total+'</td><td>'+T_totalFinal+'</td> </tr>')
								 
							
                                
                             }
               
            
                        });
             }
            
            
            
            
            if(checkRadio == 3){
//                  $(".hidecombiner").css("display","table-cell");
//                  $(".hidecombiner").css("display","none")
                    $(".productcomp").css("display","none")
//                  $(".combine3").css("display","none")
//                    $(".combine3").css("display","table-cell")
                  
                 api.column(3, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr style="display:none" class="group"><td colspan="11">'+group+'</td></tr>'
                    );
                    last = group;
                }           
            });      
                
               api.column(7, {page:'current'}).data().each( function ( group, i ) {
               if ( last !== group ) {
                   $(rows).eq( i ).before(
                       '<tr style="display:none" class="group"><td colspan="11">'+group+'</td></tr>'
                   );
                   last = group;
               } 
           });  
                
            }
            if(checkRadio == 3){
                
              $('#tbl-ForeignSuppliers tbody').find('.group').each(function(i, v) {
                            var T_Weight =0;
                            var T_Quantity=0;
                            var T_ProductPrice=0;
                            var T_Total=0;
                            var ProductName;
					        var T_WeightType =0;
                            var T_Crrying=0;
                            var T_totalFinal=0;
                            var average= 0;
                            var Date="";
                            //var CustomerName;
                
         
                            var rowCount = $(this).nextUntil('.group').length;

                            var total_sum = 0;
                        
                            $(this).nextUntil('.group').each(function() {
                              
                                ProductName=$(this).find(".Pname").text();
                                CustomerName=$(this).find(".Cname").text();

                    T_Weight = T_Weight + parseInt($(this).find(".sum_weight").text());
                    T_Weight  = Math.round(T_Weight);    
                    T_Quantity = T_Quantity + parseInt($(this).find(".sum_quantity").text());
                     T_Quantity = Math.round(T_Quantity);          
                    T_ProductPrice = T_ProductPrice + parseInt($(this).find(".sum_productprice").text());
                    T_ProductPrice = Math.round(T_ProductPrice);
                     T_Total = T_Total + parseInt($(this).find(".sum_Total").text());
                     T_Total = Math.round(T_Total);
                                
                     T_Crrying = T_Total + parseInt($(this).find(".crrying").text());
                     T_Crrying = Math.round(T_Crrying);
                                
                    T_totalFinal = T_Total + parseInt($(this).find(".finaltotal").text());
                     T_totalFinal = Math.round(T_totalFinal);
                                //  Date=$(this).find(".Date").text();
                                // average =Math.round(T_Total/T_Weight); 

                            });
                             if ($(this).nextUntil('.group').next() )
                             { 
															 
 $(this).nextUntil('.group').last().after('<tr class="groupfooter" style="background:#f90"><td>'+Date+'</td><td>'+ProductName+'</td><td>'+T_Weight+'</td><td>'+T_Quantity+'</td><td>'+T_ProductPrice+'</td><td>'+T_Total+'</td></tr>')
          
                             }
               
            
                        });   

            }//end of combine with prouduct
    
            
        }
    } ); 

//    if(checkRadio == 3){
//        $('#tbl-TotalCustomers tbody').on( 'click', 'tr.group', function () {
//        var currentOrder = table.order()[3];
//        if ( currentOrder[3] === 3 && currentOrder[3] === 'asc' ) {
//            table.order( [ 3, 'desc' ] ).draw();
//        }
//        else {
//            table.order( [ 3, 'asc' ] ).draw();
//        }
//    } );
//
//
//}
    
    

    // Order by the grouping
    $('#tbl-TotalCustomers tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
            table.order( [ 2, 'desc' ] ).draw();
        }
        else {
            table.order( [ 2, 'asc' ] ).draw();
        }
    } );
} );

//=====================================Grouping end===========================================



 function Print66(){

    $("br").addClass("hide")
    // alert("aaa");
    // $("#fristpart3").css("height","30px");
    $("#ptnforignSuppliers").addClass("hide");
    $("#search-foreignSuppliers").addClass("hide");
    $(".dataTables_info").addClass("hide");
    $(".DTTT").addClass("hide");
    $("#tbl-SupplierReport_filter").addClass("hide");
    $(".dataTables_length").addClass("hide");
    $(".dataTables_filter").addClass("hide");
    $(".pagination").addClass("hide");
    $(".panel-heading").addClass("hide");
    $(".box-header").addClass("hide");
    $(".content-header").addClass("hide");
    $(".main-header").addClass("hide");
    $(".sidebar-menu").addClass("hide");
    
    $("#dataTables_filter").addClass("hide");
//    $("#print").css("display","none");
   
   
	 // $("#ForeignSuppliersID_chosen").css("display","none");
  //    $("#ForeignSuppliersID69_chosen").css("display","none");
  //    $("#cboContainerID_chosen").css("display","none");
  //    $("#cboSerialContainerID_chosen").css("display","none");
     
     $("#cboSerialContainerID_chosen").addClass("hide");
      $("#ForeignSuppliersID69_chosen").addClass("hide");
	 $("#cboContainerID_chosen").addClass("hide");
	 $("#cboSerialContainerID_chosen").addClass("hide");

	 $("#ShowSuppliers").css("display","block");
     $("#ShowContiner").css("display","block");   
    $("#ShowSieralContiner").css("display","block");  
     
     if(checkRadio == 1){
        $("#Combine").css("visibility","hidden");    
         $("#comb2").css("visibility","hidden");
         
    $("#comb3").css("visibility","hidden");
     $("#CombineProuduct").css("visibility","hidden"); 
      }else if (checkRadio == 3 ){
              $("#Combine").css("visibility","hidden");    
         $("#comb2").css("visibility","hidden");
          
   $("#Individuale").css("visibility","hidden"); 
            $("#indi2").css("visibility","hidden");
          
          
     
      }else{
            $("#Individuale").css("visibility","hidden"); 
            $("#indi2").css("visibility","hidden");
          
              $("#comb3").css("visibility","hidden");
     $("#CombineProuduct").css("visibility","hidden"); 
        }

     
     window.print();

}


     function myFunction66(e){


     if (e.keyCode == 27) {     
 
         $("br").removeClass("hide");
        $("#search-foreignSuppliers").removeClass("hide");
        $(".DTTT").removeClass("hide");
        $("#tbl-SupplierReport_filter").removeClass("hide");
        $(".dataTables_length").removeClass("hide");
        $(".dataTables_filter").removeClass("hide");
        $(".pagination").removeClass("hide");
        $(".panel-heading").removeClass("hide");
        $(".box-header").removeClass("hide");
        $(".content-header").removeClass("hide");
        $(".main-header").removeClass("hide");
        $(".sidebar-menu").removeClass("hide");
        $("#ForeignSuppliersID_chosen").removeClass("hide");
        $("#ForeignSuppliersID69_chosen").removeClass("hide");
        $("#cboContainerID_chosen").removeClass("hide");
        $("#cboSerialContainerID_chosen").removeClass("hide"); 
        //  $("#ForeignSuppliersID_chosen").css("display","block");
        // $("#ForeignSuppliersID69_chosen").css("display","block");
        // $("#cboContainerID_chosen").css("display","block");
        // $("#cboSerialContainerID_chosen").css("display","block");
		 
		 $("#print").css("display","block");
		
		 $("#ShowSuppliers").css("display","none");
        
		 $("#ShowContiner").css("display","none"); 
         
		 $("#ShowSieralContiner").css("display","none"); 
   
        $("#dataTables_filter").removeClass("hide");
          $(".dataTables_info").removeClass("hide");
  
        if(checkRadio == 1){
            $("#Combine").css("visibility","visible");
            $("#comb2").css("visibility","visible");  
            
     $("#comb3").css("visibility","visible");
     $("#CombineProuduct").css("visibility","visible"); 
            $("#ptnforignSuppliers").removeClass("hide");
        }else if(checkRadio == 3 ){
            
              $("#Combine").css("visibility","visible");
            $("#comb2").css("visibility","visible");  
   
            $("#Individuale").css("visibility","visible");
            $("#indi2").css("visibility","visible");         

            
        }
        else{
            
                      $("#comb3").css("visibility","visible");
     $("#CombineProuduct").css("visibility","visible"); 
            
            $("#Individuale").css("visibility","visible");
            $("#indi2").css("visibility","visible");
        }
     
   

    }
}
 $(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#search-foreignSuppliers").prop("disabled",false);
});
});



foreignSuppliers.prototype.CheckTotal1 = function(){
 
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-ForeignSuppliers tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+= parseInt($(this).html());
                 console.log(totals);

                });
            });
            $("#tbl-ForeignSuppliers th.firstTotal").each(function(i){  
                $('.firstTotal').html("اجمالى المبلغ :"+totals[i]);
            });
 
}
foreignSuppliers.prototype.CheckTotal2 = function(){
 
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-ForeignSuppliers tr");
 
            $dataRows.each(function() {
                $(this).find('.sumcrr').each(function(i){        
                     totals[i]+= parseInt($(this).html());
                
                    console.log(totals);
//                    console.log("AAAAAAAAAAAAAA");
                });
            });
            $("#tbl-ForeignSuppliers th.crryingTotal").each(function(i){  
                $('.crryingTotal').html("اجمالى المبلغ :"+totals[i]);
            });
 
}
foreignSuppliers.prototype.CheckTotal3 = function(){
 
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-ForeignSuppliers tr");
 
            $dataRows.each(function() {
                $(this).find('.sumfinal').each(function(i){        
                       totals[i]+= parseInt($(this).html());
                    console.log(totals);
//                    console.log("AAAAAAAAAAAAAA");
                });
            });
            $("#tbl-ForeignSuppliers th.finaltotala2").each(function(i){  
                $('.finaltotala2').html("اجمالى المبلغ :"+totals[i]);
            });
 
}





