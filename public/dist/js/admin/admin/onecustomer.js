var onecustomer = function () {};
 
$(function(){ _onecustomer = new onecustomer(); });
 
$(document).ready(function() {
      $("#TotalSupplierID").select2({
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
 
     $("#TotalCustomersID1").select2({
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

$(document).ready(function() {
 $('#search-onecustomer').click(function(){
        _onecustomer.searchfortables();
         $(this).prop("disabled",true);
    });                  
});
 
function getCustomerName(CustomerID)
    {   
        var cboCustomerID = $( "#TotalCustomersID1" ).clone();
        $(cboCustomerID).val(CustomerID);

        return $('option:selected',cboCustomerID).text() ; 
    }

function getSupplierName(SupplierID)
    {
        var cboSupplierID = $( "#TotalSupplierID" ).clone();
        $(cboSupplierID).val(SupplierID);

        return $('option:selected',cboSupplierID).text() ; 
    }


//onecustomer.prototype.CheckTotal2 = function(){
// 
//var totals=[0,0,0];
// 
//            var $dataRows=$("#tbl-onecustomer tr");
// 
//            $dataRows.each(function() {
//                $(this).find('#sumfinal').each(function(i){        
//                    totals+=parseInt( $(this).html());
//                    console.log(totals);
//                    console.log("AAAAAAAAAAAAAA");
//                });
//            });
//            $("#tbl-onecustomer th.total").each(function(i){  
//                $('.total').html("اجمالى المبلغ :"+totals[i]);
//            });
// 
//}



//function to enble and disaple combobox end 

$(document).ready(function(){
$("#check_customers").click(function(){
   if($(this).is(":checked")) 
   {
   $("#TotalSupplierID").prop("disabled",false); 
   }else{
    
    $("#TotalSupplierID").prop("disabled",true).trigger("chosen:updated");  
  
   }
         if($(this).is(":checked")) 
   {
      $("#TotalSupplierID").prop("disabled",false).trigger("chosen:updated");   
   }

});
});


// difination radio button 
checkRadio=1;
function individuale(){
checkRadio=1;
}


function combine(){
checkRadio=2;
}



onecustomer.prototype.searchfortables = function(){
 var t = $('#tbl-onecustomer').DataTable();
    
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
 
// var t = $('#tbl-onecustomer').DataTable();
  //=========new=====================
//            final=0;
            var tTotal = 0 
            var tNowlon=0;
            var tCustody=0;
            var tDiscount=0;
            var tCarrying=0;
            var type=null;
//==================================  
    
    
// 		console.log($('#onecustomer-repo-form :input'));
    
        $.ajax({
            url: "loadOneCustomerData",
            type: "post",
            data: $('#onecustomer-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
 
		
		
		
		
          .done(function (output) {
           console.log(output);
             var obj2 = eval(output)
//             console.log(output[0]);
//             for(var j = 0 ; j < obj2.length; j ++ )
//               {
//                 discount=obj2[j].Discount;
//                console.log(discount);       
//             }
          
//            var p = '' ;
            var input=$('#onecustomer-repo-form :input');
//              console.log($('#onecustomer-repo-form :input'));
             var x= input[2].value;
             var y= input[4].value;
             var p= input[5].value;
//            console.log(p);    
//                 
                
             var cboCustomerID = $( "#TotalCustomersID1" ).clone();
            $(cboCustomerID).val(x);
             var text= $('option:selected',cboCustomerID).text() ;

             var cboSupplierID = $( "#TotalSupplierID" ).clone();
             $(cboSupplierID).val(y);
             var text2 =  $('option:selected',cboSupplierID).text() ;
            
            
               var productID = $( "#ProductType2" ).clone();
             $(productID).val(p);
             var text3 =  $('option:selected',productID).text() ; 
//            console.log(text3)
            
            
            
            

             $("#ShowCustomerONPrint1").text("اسم التاجر:"+text);
             $("#ShowSupplierONPrint1").text("اسم المورد:"+text2);
             $("#Showprouduct").text("نوع البضاعة :"+text3);
            
            
//            console.log($('#onecustomer-repo-form :input'));
            var obj = eval (output);
//            console.log(output);

            
            var obj = eval (output);
             var old_Mark = 0;
            for (var i = 0; i < obj.length; i++) {
                
			total=obj[i].Total;
               
			carry=obj[i].Carrying;
                
			custd=obj[i].Custody;
                
			nol=obj[i].Nowlon;
                
			dis=obj[i].Discount;
//                 console.log(dis);
			
//			first = total + carry +nol+custd;
//			console.log("-----");
//			console.log(carry);
//			console.log("-----");
//			finaltotal = first - dis;
				
var cls_sum_discount = ""
var cls_sum_Nolown = ""
var cls_sum_Custody = ""



                  if (old_Mark != obj[i].RefNo)
                {
                    old_Mark = obj[i].RefNo ;
                    tDiscount+=obj[i].Discount;
                     tNowlon+=obj[i].Nowlon;
                    tCustody+=obj[i].Custody;
                     cls_sum_discount = "sum_discount";
                     cls_sum_Nolown="sum_nowlon";
                     cls_sum_Custody="sum_custody";
                }
                
                
                  if ( obj[i].ProductType == 0)  {

                
                 text = '<tr><td>'+obj[i].SalesDate+'</td>'+
					 	'<td class="hidecombine">'+obj[i].ProductName+'</td>'+
					 	'<td class="hidecombine protype">محـلي</td>'+
					 	'<td class="hidecombine Refno">'+obj[i].RefNo+'</td>'+
					 	'<td style="display:none">'+obj[i].CustomerName+'</td>'+
                        '<td class="hidecombine">'+obj[i].Weight+'</td>'+
                        '<td class="hidecombine">'+obj[i].Quantity+'</td>'+
                        '<td class="hidecombine">'+obj[i].ProductPrice+'</td>'+
                        '<td class="sum_Total sum hidecombine">'+obj[i].Total+'</td>'+
					 	'<td class="sum_carrying" style="display:none">'+obj[i].Carrying+'</td>'+
					 	'<td class="'+ cls_sum_Nolown +'" style="display:none">'+obj[i].Nowlon+'</td>'+	
					 	'<td class="'+ cls_sum_Custody +'" style="display:none">'+obj[i].Custody+'</td>'+
					 	'<td class="'+ cls_sum_discount  +'" style="display:none">'+obj[i].Discount+'</td>'+	
                        '<td class="hidecombine">'+obj[i].SupplierName+'</td>'+ 
                        '<td class="type" style="display:none">'+obj[i].CustomerType+'</td>'+'</tr>'; 
                      
							} else if ( obj[i].ProductType > 0 ){
                
                     text = '<tr><td>'+obj[i].SalesDate+'</td>'+
					 	'<td class="hidecombine protype">'+obj[i].ProductName+'</td>'+
					 	'<td class="hidecombine">مســتورد</td>'+
					 	'<td class="hidecombine Refno">'+obj[i].RefNo+'</td>'+
                        '<td style="display:none">'+obj[i].CustomerName+'</td>'+
                        '<td class="hidecombine">'+obj[i].Weight+'</td>'+
                        '<td class="hidecombine">'+obj[i].Quantity+'</td>'+
                        '<td class="hidecombine">'+obj[i].ProductPrice+'</td>'+
                        '<td class="sum_Total sum hidecombine">'+obj[i].Total+'</td>'+
					 	'<td class="sum_carrying" style="display:none">'+obj[i].Carrying+'</td>'+
					 	'<td class="'+ cls_sum_Nolown +'" style="display:none">'+obj[i].Nowlon+'</td>'+	
					 	'<td class="'+ cls_sum_Custody +'" style="display:none">'+obj[i].Custody+'</td>'+
					 	'<td class="' + cls_sum_discount +'" style="display:none">'+obj[i].Discount+'</td>'+	
                        '<td class="hidecombine">'+obj[i].SupplierName+'</td>'+ 
                        '<td class="type"  style="display:none">'+obj[i].CustomerType+'</td>'+'</tr>';
                
                        }		

                    
                
                t.row.add( $(text) ).draw();
              
                
//                console.log(obj[i].Discount);
                   
                    
                    tCarrying+=obj[i].Carrying;
                    type=obj[i].CustomerType;
                    tTotal += obj[i].Total
//                    console.log(obj[i].CustomerType);
                    final = tTotal + tCarrying + tNowlon + tCustody 
                    totalfinal = Math.round(final - tDiscount);
                    //.toFixed(0);
                    // totalfinal =Math.round(totalfinal);
                
            } //end for 
                      
//            console.log(final);
                  document.getElementById("totaltest").innerHTML ='الصافى : '+ totalfinal;      
//        _onecustomer.CheckTotal();
//        _onecustomer.CheckTotal2();
       }).error(function (data) {
        showError('',data);
        }); 
	}// end serach for tables 

//================= setar values ==============

Nowlon=0; Discount=0; Type=0; Carrying=0; Custody=0;

function setNowlon(data){Nowlon=data;}
function setDiscount(data){Discount=data;}
function setType(data){Type=data;}
function setCarrying(data){Carrying=data;}
function setCustody(data){Custody=data;}

//==============sertar vaules =================


//grouping 

$(document).ready(function() {
//        var table = $('#tbl-onecustomer').DataTable({dom: 'T<"clear">lfrtip'});
	  var table = $('#tbl-onecustomer').DataTable({
		          "columnDefs": [
            { "visible": false, "targets": 0 },
      
        ],

        dom: 'T<"clear">lfrtip',
         "sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",
                "order": [[ 0, 'asc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                
      

       
                if ( last !== group ) {

                  $(rows).eq( i ).before(
                  '<tr style="background:yellow" class="group"><td colspan="8">'+group+'</td></tr>'
                    );
 
                    last = group;
                }

			});
            
            
            // combin by customer 
                   api.column(4, {page:'current'} ).data().each( function ( group, i ) {
                
      

       
                if ( last !== group ) {

                  $(rows).eq( i ).before(
                  '<tr  style="display:none" class="group"><td colspan="8">'+group+'</td></tr>'
                    );
 
                    last = group;
                }

			});
            
        //==================================Combine==============================    
			
                        if(checkRadio == 2)
                        {
                         $(".hidecombine").css("display","none");
                  
                            
  //==============================just creazy  test start   ========================                         
               api.column(3, {page:'current'} ).data().each( function ( group, i ) {
      
       
                if ( last !== group ) {

                  $(rows).eq( i ).before(
                  '<tr class="group" style="display:none"><td>'+group+'</td></tr>'
                    );
 
                    last = group;
                }

			});
                            
             $('#tbl-onecustomer tbody').find('.group').each(function(i, v) {
                            
                //====difnition somr valiable mebay not used 
                            var T_Weight =0;
                            var T_Quantity=0;
                            var T_ProductPrice=0;
                            var T_Total=0;
                            var refNo = 0;
                            var protype= ' ';
         
                                //definiton some variables here 
                           var T_nowlon=0; var T_discount=0; var T_carrying=0; var T_custody=0;
                           var type=$(this).find(".type").text();
         
                            var rowCount = $(this).nextUntil('.group').length;
//
                             localsum= 0;
                            var total_sum = 0;
                            var total_sum2 = 0;
                            $(this).nextUntil('.group').each(function() {
//                             
                                 // T_Total = T_Total + parseInt($(this).find(".sum_Total").text());
                                  T_Total = T_Total + parseFloat($(this).find(".sum_Total").text());
                                if ($(this).find(".sum_nowlon").text() != "")
                                {
                                // T_nowlon=T_nowlon+parseInt($(this).find(".sum_nowlon").text());
                                T_nowlon=T_nowlon+parseFloat($(this).find(".sum_nowlon").text());
                                }
                                
                                if ($(this).find(".sum_discount").text() != "")
                                {
                                // T_discount=T_discount+parseInt($(this).find(".sum_discount").text());
                                T_discount=T_discount+parseFloat($(this).find(".sum_discount").text());
                                }
                                
                               
//                                 T_carrying=T_carrying+parseInt($(this).find(".sum_carrying").text());
                                T_carrying=T_carrying+parseFloat($(this).find(".sum_carrying").text());
                                // T_carrying = Math.round(T_carrying);
                                 if ($(this).find(".sum_custody").text() != "")
                                 {
                                // T_custody=T_custody+parseInt($(this).find(".sum_custody").text());
                                T_custody=T_custody+parseFloat($(this).find(".sum_custody").text());
                                 }
                                
                                type=parseInt($(this).find(".type").text())
                                
                                var final0=0; var final1=0; var final2=0;
                                
                                
                                // total_sum = total_sum + parseInt($(this).find(".sum").text());
                                 total_sum = total_sum + parseInt($(this).find(".sum").text());
                                total_sum = Math.round(total_sum);
                                 refNo= $(this).find(".Refno").text()
                                 protype= $(this).find(".protype").text()
//                              total_sum2 = total_sum2 + parseInt($(this).find(".sumfinal").text());
                            });
         

                             if ($(this).nextUntil('.group').next())
                             {
//                                 console.log($(this).nextUntil('.group2').last());
                                 $(this).nextUntil('.group').last().after('<tr style="display:none"><td style="" id="test" >'+"الاجمالى: "+total_sum+'</td> <td>  العلامة: '+refNo+'</td><td>نوع البضاعة: '+protype+'</td> </tr>')
                                 
                          if(type==0){
                              
                         var final0=T_Total+T_carrying;
                         var final0=(final0-T_discount).toFixed(0);
                              
//                                console.log(final0)      
                              $(this).nextUntil('.group').last().after('<tr  class="groupfooter" ><td>  العلامة: '+refNo+'</td><td colspan="2">النوع: '+protype+'</td><td style="" id="test" colspan="2" >'+"الاجمالى: "+total_sum+'</td> <td colspan="0" class="Discount"> خصم:'+T_discount+'</td><td colspan="0" class="Carrying"> مشال'+T_carrying+'</td><td class="sumfinal" colspan="2">اجمالى الفاتورة :'+final0+'</td></tr>')}  
                                 
       else if(type==1){
           final1= T_Total+T_nowlon+T_custody+T_carrying; final1=(final1-T_discount).toFixed(0);         $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td>العلامة: '+refNo+'</td><td>نوع : '+protype+'</td><td style="" id="test" >'+"الاجمالى: "+total_sum+'</td> <td  class="Nowlon"> نولون:'+T_nowlon+'</td><td  class="Carrying">مشال'+T_carrying+'</td><td class="Custody"> عهدة:'+ T_custody+'</td><td  class="Discount"> خصم:'+T_discount+'</td> <td >أ.الفاتورة :'+final1+'</td> </tr>')}
           
        
                        else if(type==2){
                              final2=T_Total+T_carrying+T_custody; final2=(final2-T_discount).toFixed(0);     $(this).nextUntil('.group').last().after('<tr style="background-color:#EDEDED; "class="groupfooter"> <td>العلامة: '+refNo+'</td><td>نوع البضاعة: '+protype+'</td><td style="" colspan="2" >'+"الاجمالى: "+total_sum+'</td><td class="Custody"  >عهدة:'+ T_custody+'</td><td class="Carrying"   > مشال :'+T_carrying+'</td><td class="Discount"> خصم:'+T_discount+'</td><td >اجمالى الفاتورة :'+final2+'</td></tr>')}            
                                 
                                 
           
//                                 else if(type==2){final2=T_Total+T_carrying+T_custody; final2=final2-T_discount;     $(this).nextUntil('.group').last().after('<tr style="background-color:#F90; "class="groupfooter"><td> الإجمالى</td><td class="Discount"> خصم:'+T_discount+'</td><td class="Carrying" colspan="0"> مشال'+T_carrying+'</td></tr> <tr style="background-color:#FFCFDF;> <td class="" colspan="1"> عهدة:'+ T_custody+'</td><td id="sumfinal" colspan="1">صافى البيع:'+final2+'</td></tr>')}
                                 
  

                             }
                 
   
                        });       
                       
 //==============================end ..!!!====================================================  
                            
                     
                    //====================== found total every history=========  
//         api.column(0, {page:'current'} ).data().each( function ( group, i ) {
//      
//       
//                if ( last !== group ) {
//
//                  $(rows).eq( i ).before(
//                  '<tr style="display:none;" class="groupTotal"><td colspan="3">'+group+'</td></tr>'
//                    );
// 
//                    last = group;
//                }
//
//			});
//                            
//                      $('#tbl-onecustomer tbody').find('.groupTotal').each(function(i, v) {
//                             
//                //====difnition somr valiable mebay not used 
//                            var T_Weight =0;
//                            var T_Quantity=0;
//                            var T_ProductPrice=0;
//                            var T_Total=0;
//
//         
//                                //definiton some variables here 
//                           var T_nowlon=0; var T_discount=0; var T_carrying=0; var T_custody=0;
//                           var type=$(this).find(".type").text();
//         
//                            var rowCount = $(this).nextUntil('.groupTotal').length;
////
//                            var total_sum = 0;
//                            var total_sum2 = 0;
//                            $(this).nextUntil('.groupTotal').each(function() {
////                             
//                                T_Total = T_Total + parseInt($(this).find(".sum_Total").text());
//                                T_nowlon=T_nowlon+parseInt($(this).find(".sum_nowlon").text());
//                                T_discount=T_discount+parseInt($(this).find(".sum_discount").text());
//                                T_carrying=T_carrying+parseInt($(this).find(".sum_carrying").text());
//                                T_custody=T_custody+parseInt($(this).find(".sum_custody").text());
//                                type=parseInt($(this).find(".type").text())
//                                
//                                var final0=0; var final1=0; var final2=0;
//                                
//                                
//                                total_sum = total_sum + parseInt($(this).find(".sum").text());
//                                console.log(parseInt($(this).find(".sum").text()));
////                              total_sum2 = total_sum2 + parseInt($(this).find(".sumfinal").text());
//                            });
//         
////                            console.log(total_sum);
////                            console.log("####");
//                             if ($(this).nextUntil('.groupTotal').next())
//                             {
////                                 console.log($(this).nextUntil('.groupTotal').last());
//                                 $(this).nextUntil('.groupTotal').last().after('<tr class="groupfooter"><td style="background: #eff1f1;" colspan="3">'+"الاجمالى: "+total_sum+'</td> </tr>')
//                                 
//                          if(type==0){ final0=T_Total+T_carrying; final0=final0-T_discount; $(this).nextUntil('.group').last().after('<tr  style="background-color:#FFFFAA;" class="groupfooter" ><td colspan="0" class="Discount"> خصم:'+T_discount+'</td><td colspan="0" class="Carrying"> مشال'+T_carrying+'</td><td colspan="2">صافى البيع:'+final0+'</td></tr>')}  
//                                 
//       else if(type==1){
//           final1= T_Total+T_nowlon+T_custody+T_carrying; final1=final1-T_discount;         $(this).nextUntil('.group').last().after('<tr style="background-color:#FFFFAA; " class="groupfooter"><td  class="Nowlon"> نولولن:'+T_nowlon+'</td><td colspan="0" class="Carrying"> مشال'+T_carrying+'</td><td class="Custody"> عهدة:'+ T_custody+'</td> </tr> <tr  style="background-color:#FFFFAA; "> <td  class="Discount"> خصم:'+T_discount+'</td><td  style="background-color:#FFCFDF;" colspan="2">صافى البيع:'+final1+'</td> </tr>')
//                     }
//								 
//                          else if(type==2){final2=T_Total+T_carrying+T_custody; final2=final2-T_discount;     $(this).nextUntil('.group').last().after('<tr style="background-color:#FFFFAA; "class="groupfooter"><td> الإجمالى</td><td class="Discount"> خصم:'+T_discount+'</td><td class="Carrying" colspan="0"> مشال'+T_carrying+'</td></tr> <tr style="background-color:#FFCFDF;> <td class="Custody" colspan="0"> عهدة:'+ T_custody+'</td><td colspan="3">صافى البيع:'+final2+'</td></tr>')}
//                                 
//                             }
//
//
//                        });       
        


                       } // end of combine
//===================== end of combine=============================================    				   
            

            
                      if(checkRadio==1 ){
                 $(".hidecombine").css("display","table-cell");
                          
                   //==============================just creazy  test start   ========================                         
               api.column(3, {page:'current'} ).data().each( function ( group, i ) {
      
       
                if ( last !== group ) {

                  $(rows).eq( i ).before(
                  '<tr style="background:yellow ; display:none" class="group" style="display:none;"><td>'+group+'</td></tr>'
                    );
 
                    last = group;
                }

			});
                            
             $('#tbl-onecustomer tbody').find('.group').each(function(i, v) {
                             
                //====difnition somr valiable mebay not used 
                            var T_Weight =0;
                            var T_Quantity=0;
                            var T_ProductPrice=0;
                            var T_Total=0;

                                //definiton some variables here 
                           var T_nowlon=0; var T_discount=0; var T_carrying=0; var T_custody=0;
                           var type=$(this).find(".type").text();
         
                            var rowCount = $(this).nextUntil('.group').length;
//
                            var total_sum = 0;
                            var total_sum2 = 0;
                            $(this).nextUntil('.group').each(function() {
//                             
//         console.log($(this).find(".sum_discount").text());
                                
//                                T_Total = T_Total + parseInt($(this).find(".sum_Total").text());
                                T_Total = T_Total + parseFloat($(this).find(".sum_Total").text());
                                
                                if ($(this).find(".sum_nowlon").text() != "")
                                {
//                                T_nowlon=T_nowlon+parseInt($(this).find(".sum_nowlon").text());
                                T_nowlon=T_nowlon+parseFloat($(this).find(".sum_nowlon").text());
                                }
                                
                                if ($(this).find(".sum_discount").text() != "")
                                {
//                                T_discount=T_discount+parseInt($(this).find(".sum_discount").text());
                                T_discount=T_discount+parseFloat($(this).find(".sum_discount").text());
                                }
                                
                               
                                T_carrying=T_carrying+parseFloat($(this).find(".sum_carrying").text());
                                // T_carrying = Math.round(T_carrying);
//                                T_carrying=T_carrying+parseFloat($(this).find(".sum_carrying").text());
//                                T_carrying = Math.round(T_carrying).toFixed(0);
                                 if ($(this).find(".sum_custody").text() != "")
                                 {
//                                T_custody=T_custody+parseInt($(this).find(".sum_custody").text());
                                T_custody=T_custody+parseFloat($(this).find(".sum_custody").text());
                                 }
                                
                                type=parseInt($(this).find(".type").text())
                                
                                var final0=0; var final1=0; var final2=0;
                                
                                
                                total_sum = total_sum + parseFloat($(this).find(".sum").text());
                                total_sum =Math.round (total_sum);
//                              total_sum2 = total_sum2 + parseInt($(this).find(".sumfinal").text());
                            });
         
//                            console.log(total_sum);
//                            console.log("####");
                           if ($(this).nextUntil('.group').next())
//                             {
//                                 console.log($(this).nextUntil('.group').last());
                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td colspan="6"> </td><td style="background: #eff1f1;" colspan="0">'+"الاجمالى: "+total_sum+'</td> <td colspan="0"></td></tr>')
                                 
                          if(type==0){ final0=T_Total+T_carrying; final0=(final0-T_discount).toFixed(0); $(this).nextUntil('.group').last().after('<tr  style="background-color:#FFFFAA;" class="groupfooter" ><td colspan="2"> الإجمالى</td><td colspan="2" class="Discount"> خصم:'+T_discount+'</td><td colspan="2" class="Carrying"> مشال'+T_carrying+'</td><td colspan="2">صافى البيع:'+final0+'</td></tr>')}  
                                 
       else if(type==1){final1= T_Total+T_nowlon+T_custody+T_carrying; final1=(final1-T_discount).toFixed(0);         $(this).nextUntil('.group').last().after('<tr style="background-color:#FFFFAA; " class="groupfooter"><td> الإجمالى</td><td  class="Nowlon"> نولولن:'+T_nowlon+'</td><td colspan="2" class="Carrying"> مشال'+T_carrying+'</td><td class="Custody"> عهدة:'+ T_custody+'</td><td  class="Discount"> خصم:'+T_discount+'</td><td colspan="2" class="optional">صافى البيع:'+final1+'</td> </tr>')}
								 
                          else if(type==2){final2=T_Total+T_carrying+T_custody; final2=(final2-T_discount).toFixed(0);     $(this).nextUntil('.group').last().after('<tr  style="background-color:#FFFFAA; "class="groupfooter"><td> الإجمالى</td><td class="Discount"> خصم:'+T_discount+'</td><td class="Carrying" colspan="2"> مشال'+T_carrying+'</td><td class="Custody" colspan="2"> عهدة:'+ T_custody+'</td><td colspan="2">صافى البيع:'+final2+'</td></tr>')}
                                 
//                             }


                        });       
                       
 //==============================end ..!!!====================================================           
                          
                          
                          
                          
//     $('#tbl-onecustomer tbody').find('.group').each(function(i, v) {
//                             
//                //====difnition somr valiable mebay not used 
//                            var T_Weight =0;
//                            var T_Quantity=0;
//                            var T_ProductPrice=0;
//                            var T_Total=0;
//
//         
//                                //definiton some variables here 
//                           var T_nowlon=0; var T_discount=0; var T_carrying=0; var T_custody=0;
//                           var type=$(this).find(".type").text();
//         
//                            var rowCount = $(this).nextUntil('.group').length;
////
//                            var total_sum = 0;
//                            var total_sum2 = 0;
//                            $(this).nextUntil('.group').each(function() {
////                             
//                                T_Total = T_Total + parseInt($(this).find(".sum_Total").text());
//                                T_nowlon=T_nowlon+parseInt($(this).find(".sum_nowlon").text());
//                                T_discount=T_discount+parseInt($(this).find(".sum_discount").text());
//                                T_carrying=T_carrying+parseInt($(this).find(".sum_carrying").text());
//                                T_custody=T_custody+parseInt($(this).find(".sum_custody").text());
//                                type=parseInt($(this).find(".type").text())
//                                
//                                var final0=0; var final1=0; var final2=0;
//                                
//                                
//                                total_sum = total_sum + parseInt($(this).find(".sum").text());
////                              total_sum2 = total_sum2 + parseInt($(this).find(".sumfinal").text());
//                            });
//         
////                            console.log(total_sum);
////                            console.log("####");
//                             if ($(this).nextUntil('.group').next())
//                             {
//                                 console.log($(this).nextUntil('.group').last());
//                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter"><td colspan="6"> </td><td style="background: #eff1f1;" colspan="0">'+"الاجمالى: "+total_sum+'</td> <td colspan="0"></td></tr>')
//                                 
//                          if(type==0){ final0=T_Total+T_carrying; final0=final0-T_discount; $(this).nextUntil('.group').last().after('<tr  style="background-color:#FFFFAA;" class="groupfooter" ><td colspan="2"> الإجمالى</td><td colspan="2" class="Discount"> خصم:'+T_discount+'</td><td colspan="2" class="Carrying"> مشال'+T_carrying+'</td><td colspan="2">صافى البيع:'+final0+'</td></tr>')}  
//                                 
//       else if(type==1){final1= T_Total+T_nowlon+T_custody+T_carrying; final1=final1-T_discount;         $(this).nextUntil('.group').last().after('<tr style="background-color:#FFFFAA; " class="groupfooter"><td> الإجمالى</td><td  class="Nowlon"> نولولن:'+T_nowlon+'</td><td colspan="2" class="Carrying"> مشال'+T_carrying+'</td><td class="Custody"> عهدة:'+ T_custody+'</td><td  class="Discount"> خصم:'+T_discount+'</td><td colspan="2" class="optional">صافى البيع:'+final1+'</td> </tr>')}
//								 
//                          else if(type==2){final2=T_Total+T_carrying+T_custody; final2=final2-T_discount;     $(this).nextUntil('.group').last().after('<tr  style="background-color:#FFFFAA; "class="groupfooter"><td> الإجمالى</td><td class="Discount"> خصم:'+T_discount+'</td><td class="Carrying" colspan="2"> مشال'+T_carrying+'</td><td class="Custody" colspan="2"> عهدة:'+ T_custody+'</td><td colspan="2">صافى البيع:'+final2+'</td></tr>')}
//                                 
//                             }
//
//
//                        });
                          
                     }


            
        }
    });

    $("#ToolTables_tbl-onecustomer_4").click(function(){
      
        $("table").css("width","100%");
        // $("#search-onecustomer").css("visibility","hidden");
        $("#search-onecustomer").addClass("hide");
		
        // $("#check_customer").css("display","none");
        $("#check_customer").addClass('hide');

        // $("#check_customers").css("display","none"); 
		    $("#check_customers").addClass('hide');

       
    // $('#hideinprint').css("display","none");
		$('#hideinprint').addClass('hide')
		
        $("#ShowCustomerONPrint1").css("display","block"); 
         $("#ShowSupplierONPrint1").css("display","block"); 
         $("#Showprouduct").css("display","block"); 

		
   if($("#check_customers").is(":checked")) 
   {
    	$("#ShowCustomerONPrint1").css("visibility","visible"); 
         $("#ShowSupplierONPrint1").css("visibility","visible"); 
   }else{
    
      $("#ShowCustomerONPrint1").css("visibility","visible"); 
      $("#ShowSupplierONPrint1").css("visibility","hidden"); 
   }
	
             if(checkRadio == 1){
        $("#Combine").css("visibility","hidden");    
         $("#comb2").css("visibility","hidden");
      }
        else            
        {
            $("#Individuale").css("visibility","hidden"); 
            $("#indi2").css("visibility","hidden");
        }
     
        
        
        
		  window.print();
        })    
    
    
      $(document).keyup(function(e) {
        if (e.keyCode == 27) {
          $("#search-onecustomer").removeClass("hide");   
        $("table").css("width","100%");        
        // $("#search-onecustomer").css("visibility","visible");
        // $("#search-onecustomer").removeClass('hide')
      // $("#check_customer").css("display","block");
	    $("#check_customer").removeClass('hide');
    // $("#check_customers").css("display","block");     
		$("#check_customers").removeClass('hide'); 		
			
      // $('#hideinprint').css("display","block");
			$('#hideinprint').removeClass("hide");
        
//        $("#TotalCustomersID1_chosen").css("display","block");
//        $("#TotalSupplierID_chosen").css("display","block"); 
//          
	
        $("#ShowCustomerONPrint1").css("display","none"); 
         $("#ShowSupplierONPrint1").css("display","none"); 
         $("#Showprouduct").css("display","none"); 

        
       if($("#check_customers").is(":checked")) 
       {
            $("#ShowCustomerONPrint1").css("visibility","hidden"); 
             $("#ShowSupplierONPrint1").css("visibility","hidden"); 
       }else{
        
      $("#ShowCustomerONPrint1").css("visibility","hidden"); 
      $("#ShowSupplierONPrint1").css("visibility","hidden"); 
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


onecustomer.prototype.CheckTotal = function(){
 
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-onecustomer tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
                });
            });
            $("#tbl-onecustomer th.total").each(function(i){  
                $('.total').html("اجمالى المبلغ :"+totals[i]);
            });
 
}
onecustomer.prototype.CheckTotal2 = function(){
 
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-onecustomer tr");
 
            $dataRows.each(function() {
                $(this).find('#sumfinal').each(function(i){        
                    totals+=parseInt( $(this).html());
                    console.log(totals);
                    console.log("AAAAAAAAAAAAAA");
                });
            });
            $("#tbl-onecustomer th.total").each(function(i){  
                $('.total').html("اجمالى المبلغ :"+totals[i]);
            });
 
}



 $(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#search-onecustomer").prop("disabled",false);
});
});
