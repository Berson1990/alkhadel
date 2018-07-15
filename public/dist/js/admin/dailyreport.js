var dailyreport = function () {};
 
$(function(){ _dailyreport = new dailyreport() });   


$(document).ready(function() {
 $('#search-dailyreport').click(function(){
        _dailyreport.searchfortables();
       $("#search-dailyreport").prop("disabled",true);
    });                  
});


$(document).ready(function() {
$( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        }); 
	 $( ".datepicker" ).datepicker("setDate", new Date());
   
   });

dailyreport.prototype.searchfortables = function(){
	
 var abordcustomerout = $('#tbl-abordCuatomer-outstanding').DataTable();
    
    try
    {
    abordcustomerout
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    } 
	
	var forign = $('#tbl-forignproduct').DataTable();
    
	
    try
    {
    forign
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
	
	
  var tacc = $('#tbl-abbordCusmer-close').DataTable();
    
    try
    {
    tacc
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
	
  var closeforign = $('#tbl-close-forginprouduct').DataTable();
    
    try
    {
    closeforign
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
 
	
   var uc = $('#tbl-upperCustomer').DataTable();
	    try
    {
    uc
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
    var upperforiegn = $('#tbl-upperCustomer-forgin').DataTable();
	    try
    {
    upperforiegn
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
 
	
	
	
 var lc = $('#tbl-localCustomers').DataTable();
	
	 try
    {
    lc
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }
	
	var localcustomerforgin = $('#tbl-localCustomers_foriegn').DataTable();
	
	    try
    {
    localcustomerforgin
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
	
	var cd = $('#tbl-CashDeposit').DataTable();
	
	    try
    {
    cd
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
	
	
	var chd = $('#tbl-ChekDeposit').DataTable();
	
	    try
    {
    chd
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
	
	
	var bd = $('#tbl-BankDeposit').DataTable();
	
	    try
    {
    bd
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    } 
	
	
	var cp = $('#tbl-cashPayment').DataTable();
	
	    try
    {
    cp
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
	
	var chp = $('#tbl-checkPayment').DataTable();
	
	    try
    {
    chp
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
	
	
	var ex = $('#tbl-Expenses').DataTable();
	
	    try
    {
    ex
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }  
 
	
	

 
// 		console.log($('#dailyReport-repo-form: input'));
        $.ajax({
            url: "LoadDeferredBills",
            type: "post",
            data: $('#dailyReport-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
 
          .done(function (output) {
		
		     var obj = eval (output);
			setobj (obj);	
			obj2=obj
//            console.log(output);
 
		var input=$('#dailyReport-repo-form :input');
           

			
			   $.ajax({
            url: "getendoutdeal",
            type: "post",
            data: $('#dailyReport-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
				   

            
				   var obj = eval (output); 
				
				  var finaldefetotoal= 0 ;
            for (var i = 0; i < obj2.length; i++) {
			
				var oneDay = 24*60*60*1000; 
				 	 var d =new Date(); 
//				   console.log(d);
			      salestime=obj2[i].SalesDate;
				var parts = salestime.split('-');
				//alert(Date(parts[0], parts[1]-1, parts[2]));
				//alert(salestime);
				var salesDate = new Date(salestime); //new Date(parts[1],parts[2],parts[0]);
				 dtime =Math.round((d-salesDate)/(1000*60*60*24))+" يوم";
//				  console.log(salestime);


//				  dtime=  Math.abs(d-salestime); 
//				 	console.log(dtime);
				  
				var x=0;
				for (var j = 0; j < obj.length; j++) {
					if(obj2[i].SalesID == obj[j].SalesID){x=1; break;}
				}
                     if (x==1){continue;}
					
				else{
					   
				   text = '<tr><td>'+obj2[i].SalesDate+'</td>'+
                        '<td >'+obj2[i].CustomerName+'</td>'+
                        '<td >'+obj2[i].SupplierName+'</td>'+
                        '<td >'+obj2[i].RefNo+'</td>'+
                        '<td >'+obj2[i].Discount+'</td>'+
					   	'<td >'+obj2[i].Nowlon+'</td>'+
					    '<td >'+obj2[i].ProductName+'</td>'+
					    '<td >'+obj2[i].Quantity+'</td>'+
                        '<td >'+obj2[i].Carrying+'</td>'+
                        '<td >'+obj2[i].Weight+'</td>'+
                        '<td >'+obj2[i].ProductPrice+'</td>'+
                        '<td class="sum">'+obj2[i].Total+'</td>'+
                        '<td>'+dtime+'</td>'+'</tr>';
					   
			
                abordcustomerout.row.add( $(text) ).draw();   
				}
			    
            // _dailyreport.CheckTotal();

                    finaldefetotoal +=  Math.round(obj2[i].Total);
                    
                    $(".total").text(finaldefetotoal);
                     console.log("obj2[i].Total:" + obj2[i].Total)
			}
			  	   
	   
        console.log("finaldefetotoal :"+finaldefetotoal);     
				   
		
		 }).error(function (data) {
        showError('',data);
        }); 	
		 
		
	  }).error(function (data) {
        showError('',data);
        }); 
//=====================================abored customerv with forign prouduct=======================
	    $.ajax({
            url: "forignproduct",
            type: "post",
            data: $('#dailyReport-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
 
          .done(function (output) {
		
		     var obj = eval (output);
			
			setobj3 (obj);	
			obj3=obj
//            console.log(output);
 
		var input=$('#dailyReport-repo-form :input');
           

			
			   $.ajax({
            url: "getendoutdeal",
            type: "post",
            data: $('#dailyReport-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
				   

            
				   var obj = eval (output); 
				var TF = 0
				  
            for (var i = 0; i < obj3.length; i++) {
			
				var oneDay = 24*60*60*1000; 
				 	 var d =new Date(); 
//				   console.log(d);
			      salestime=obj3[i].SalesDate;
				var parts = salestime.split('-');
				//alert(Date(parts[0], parts[1]-1, parts[2]));
				//alert(salestime);
				var salesDate = new Date(salestime); //new Date(parts[1],parts[2],parts[0]);
				 dtime =Math.round((d-salesDate)/(1000*60*60*24))+" يوم";
//				  console.log(salestime);


//				  dtime=  Math.abs(d-salestime); 
//				 	console.log(dtime);
				  
				var x=0;
				for (var j = 0; j < obj.length; j++) {
					if(obj3[i].SalesID == obj[j].SalesID){x=1; break;}
				}
                     if (x==1){continue;}
					
				else{
					   
				   textforign = '<tr><td>'+obj3[i].SalesDate+'</td>'+
                        '<td >'+obj3[i].CustomerName+'</td>'+
                        '<td >'+obj3[i].SupplierName+'</td>'+
                        '<td >'+obj3[i].RefNo+'</td>'+
                        '<td >'+obj3[i].Discount+'</td>'+
					   	'<td >'+obj3[i].Nowlon+'</td>'+
					    '<td >'+obj3[i].ProductName+'</td>'+
					    '<td >'+obj3[i].Quantity+'</td>'+
                        '<td >'+obj3[i].Carrying+'</td>'+
                        '<td >'+obj3[i].Weight+'</td>'+
                        '<td >'+obj3[i].ProductPrice+'</td>'+
                        '<td class="sum">'+obj3[i].Total+'</td>'+
                        '<td>'+dtime+'</td>'+'</tr>';
					   
			
                forign.row.add( $(textforign) ).draw();   
				}
			
            TF += Math.round(obj3[i].Total)
			}

            $(".totalforgin").text(TF);
			  // _dailyreport.CheckTotalforgin();	   
				     
				   
		
		 }).error(function (data) {
        showError('',data);
        }); 	
		 
		
	  }).error(function (data) {
        showError('',data);
        }); 
	
	
	
//============================daily report  abord customer report ==================

    $.ajax({
            url: "LoadEndBillsDailyReport",
            type: "post",
            data: $('#dailyReport-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
 
          .done(function (output) {
//			console.log(output);
		   var obj = eval (output); 
           var FT2 = 0 ;
				
		 for (var i = 0; i < obj.length; i++) 
		 {
						   text2 = '<tr><td>'+obj[i].SalesDate+'</td>'+
                        '<td >'+obj[i].CustomerName+'</td>'+
                        '<td >'+obj[i].SupplierName+'</td>'+
                        '<td >'+obj[i].RefNo+'</td>'+
                        '<td >'+obj[i].Discount+'</td>'+
					   	'<td >'+obj[i].Nowlon+'</td>'+
					    '<td >'+obj[i].ProductName+'</td>'+
					    '<td >'+obj[i].Quantity+'</td>'+
                        '<td >'+obj[i].Weight+'</td>'+
                        '<td >'+obj[i].Carrying+'</td>'+       
                        '<td >'+obj[i].ProductPrice+'</td>'+
                        '<td class="sum">'+obj[i].Total+'</td>'+'</tr>';
			 
				    tacc.row.add( $(text2) ).draw(); 
                    FT2 +=Math.round(obj[i].Total);  
		 }

         $(".total2").text2(FT2);
  	 // _dailyreport.CheckTotal2();		
	
		 }).error(function (data) {
        showError('',data);
        }); 	
	
//===============================load end bills with forgin proudcut  ========================
	
	  $.ajax({
            url: "endbillswithforignproudct",
            type: "post",
            data: $('#dailyReport-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
 
          .done(function (output) {
//			console.log(output);
		   var obj = eval (output); 
				var FTC =0; 
		 for (var i = 0; i < obj.length; i++) 
		 {
						   endbillsforirgn = '<tr><td>'+obj[i].SalesDate+'</td>'+
                        '<td >'+obj[i].CustomerName+'</td>'+
                        '<td >'+obj[i].SupplierName+'</td>'+
                        '<td >'+obj[i].RefNo+'</td>'+
                        '<td >'+obj[i].Discount+'</td>'+
					   	'<td >'+obj[i].Nowlon+'</td>'+
					    '<td >'+obj[i].ProductName+'</td>'+
					    '<td >'+obj[i].Quantity+'</td>'+
                        '<td >'+obj[i].Carrying+'</td>'+
                        '<td >'+obj[i].Weight+'</td>'+
                        '<td >'+obj[i].ProductPrice+'</td>'+
                        '<td class="sum">'+obj[i].Total+'</td>'+'</tr>';
			 
				    closeforign.row.add( $(endbillsforirgn) ).draw(); 
  
                    FTC +=Math.round(obj[i].Total);
		 }

  	 // _dailyreport.CheckTotalcloseForign();		
	$(".totalcloseforign").text(FTC);
		 }).error(function (data) {
        showError('',data);
        }); 	
	

	
//================================Upper Cuatomer Reprt =============================
  $.ajax({
            url: "LoadUpperCustomer",
            type: "post",
            data: $('#dailyReport-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
 
          .done(function (output) {
//			console.log(output);
		   var obj = eval (output); 

           var FT3 = 0 ;
				
		 for (var i = 0; i < obj.length; i++) 
		 {
						   text3 = '<tr><td>'+obj[i].SalesDate+'</td>'+
                        '<td >'+obj[i].CustomerName+'</td>'+
                        '<td >'+obj[i].SupplierName+'</td>'+
                        '<td >'+obj[i].RefNo+'</td>'+
						 '<td >'+obj[i].Discount+'</td>'+
					    '<td >'+obj[i].ProductName+'</td>'+
					    '<td >'+obj[i].Quantity+'</td>'+
                        '<td >'+obj[i].Carrying+'</td>'+
                        '<td >'+obj[i].Weight+'</td>'+
                        '<td >'+obj[i].ProductPrice+'</td>'+
                        '<td class="sum">'+obj[i].Total+'</td>'+'</tr>';
			 
				    uc.row.add( $(text3) ).draw(); 
     FT3 += Math.round(obj[i].Total);
		 }
            $(".total3").text(FT3);
  	 // _dailyreport.CheckTotal3();		
	
		 }).error(function (data) {
        showError('',data);
        }); 	
	//================================Upper Cuatomer Reprt with forign prouduct =============================
  $.ajax({
            url: "upperforignprouduct",
            type: "post",
            data: $('#dailyReport-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
 
          .done(function (output) {
//			console.log(output);
		   var obj = eval (output); 

           var TFS = 0 ; 
				
		 for (var i = 0; i < obj.length; i++) 
		 {
						   textupperforign = '<tr><td>'+obj[i].SalesDate+'</td>'+
                        '<td >'+obj[i].CustomerName+'</td>'+
                        '<td >'+obj[i].SupplierName+'</td>'+
                        '<td >'+obj[i].RefNo+'</td>'+
						 '<td >'+obj[i].Discount+'</td>'+
					    '<td >'+obj[i].ProductName+'</td>'+
					    '<td >'+obj[i].Quantity+'</td>'+
                        '<td >'+obj[i].Carrying+'</td>'+
                        '<td >'+obj[i].Weight+'</td>'+
                        '<td >'+obj[i].ProductPrice+'</td>'+
                        '<td class="sum">'+obj[i].Total+'</td>'+'</tr>';
			 
				    upperforiegn.row.add( $(textupperforign) ).draw(); 
                TFS += Math.round(obj[i].Total);
		 }
  	 // _dailyreport.CheckTotalupperforign();		
	  $(".totalupperforign").text(TFS);
		 }).error(function (data) {
        showError('',data);
        }); 	
	
	
	//================================Local Cuatomer Reprt =============================
  $.ajax({
            url: "LoadLocalCustomer",
            type: "post",
            data: $('#dailyReport-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
 
          .done(function (output) {
//			console.log(output);
		   var obj = eval (output); 
				var  FT4 = 0 ; 
		 for (var i = 0; i < obj.length; i++) 
		 {
						   text4 = '<tr><td>'+obj[i].SalesDate+'</td>'+
                        '<td >'+obj[i].CustomerName+'</td>'+
                        '<td >'+obj[i].SupplierName+'</td>'+
                        '<td >'+obj[i].RefNo+'</td>'+
					    '<td >'+obj[i].Discount+'</td>'+
					    '<td >'+obj[i].ProductName+'</td>'+
					    '<td >'+obj[i].Quantity+'</td>'+
                        '<td >'+obj[i].Carrying+'</td>'+
                        '<td >'+obj[i].Weight+'</td>'+
                        '<td >'+obj[i].ProductPrice+'</td>'+
                        '<td class="sum">'+obj[i].Total+'</td>'+'</tr>';
			 
				    lc.row.add( $(text4) ).draw(); 
                FT4 += Math.round(obj[i].Total); 
		 }
                      $(".total4").text(FT4);
  	 // _dailyreport.CheckTotal4();		
	
		 }).error(function (data) {
        showError('',data);
        }); 	
//================================Local Cuatomer with forign suppliers =============================
  $.ajax({
            url: "locacustomerswithforignproudct",
            type: "post",
            data: $('#dailyReport-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
 
          .done(function (output) {
//			console.log(output);
		   var obj = eval (output); 
				var  TLF = 0 ;
		 for (var i = 0; i < obj.length; i++) 
		 {
						   textlocalforeign = '<tr><td>'+obj[i].SalesDate+'</td>'+
                        '<td >'+obj[i].CustomerName+'</td>'+
                        '<td >'+obj[i].SupplierName+'</td>'+
                        '<td >'+obj[i].RefNo+'</td>'+
					    '<td >'+obj[i].Discount+'</td>'+
					    '<td >'+obj[i].ProductName+'</td>'+
					    '<td >'+obj[i].Quantity+'</td>'+
                        '<td >'+obj[i].Carrying+'</td>'+
                        '<td >'+obj[i].Weight+'</td>'+
                        '<td >'+obj[i].ProductPrice+'</td>'+
                        '<td class="sum">'+obj[i].Total+'</td>'+'</tr>';
			 
				    localcustomerforgin.row.add( $(textlocalforeign) ).draw(); 
            TLF += Math.round(obj[i].Total);   
		 }
  	 // _dailyreport.CheckTotallocalforign();		
                 $(".totallocalforign").text(TLF);
	
		 }).error(function (data) {
        showError('',data);
        }); 	
	
	//===================================chsh Deposit ===================================
	
	
	 $.ajax({
            url: "CustomerCacheDeposit",
            type: "post",
            data: $('#dailyReport-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
	
	
	  .done(function (output) {
//			console.log(output);
		   var obj = eval (output); 
				var  TD = 0;
		 for (var i = 0; i < obj.length; i++) 
		 {
						   text5 = '<tr><td>'+obj[i].TransDate+'</td>'+
                        '<td >'+obj[i].CustomerName+'</td>'+
                        '<td class="sum">'+obj[i].Mount+'</td>'+'</tr>';
			 
				    cd.row.add( $(text5) ).draw(); 
            TD += Math.round(obj[i].Mount);
		 }
  	 // _dailyreport.CheckTotal5();		
	  $(".total5").text(TD);
		 }).error(function (data) {
        showError('',data);
        }); 	
	
//================================chashDeposit================================	
	
		 $.ajax({
            url: "CustomerCheckDeposit",
            type: "post",
            data: $('#dailyReport-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
	
	
	  .done(function (output) {
//			console.log(output);
		   var obj = eval (output); 
				var  TCD =0;
		 for (var i = 0; i < obj.length; i++) 
		 {
						   text6 = '<tr><td>'+obj[i].TransDate+'</td>'+
                        '<td >'+obj[i].CustomerName+'</td>'+
                        '<td >'+obj[i].BankName+'</td>'+
                        '<td class="sum">'+obj[i].Mount+'</td>'+'</tr>';
			 
				    chd.row.add( $(text6) ).draw(); 
                    TCD += Math.round(obj[i].Mount);
		 }
  	 // _dailyreport.CheckTotal6();
                $(".total6").text(TCD);
	
		 }).error(function (data) {
        showError('',data);
        }); 	
	
//============================================= BankDeposit UnderConstrction  ========================================	
	
		 $.ajax({
            url: "BankDeposit",
            type: "post",
            data: $('#dailyReport-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
	
	
	  .done(function (output) {
//			console.log(output);
		   var obj = eval (output); 
		var  TBD = 0 ;		    
		 for (var i = 0; i < obj.length; i++) 
		 {
						   text7 = '<tr><td>'+obj[i].TransDate+'</td>'+
                        '<td >'+obj[i].CustomerName+'</td>'+
                        '<td >'+obj[i].BankName+'</td>'+
                        '<td class="sum">'+obj[i].Mount+'</td>'+'</tr>';
			 
				    bd.row.add( $(text7) ).draw(); 
                    TBD +=  Math.round(obj[i].Mount);
		 }
           $(".total7").text(TBD);
  	 // _dailyreport.CheckTotal7();		
	
		 }).error(function (data) {
        showError('',data);
        }); 
//================================================chash Payment ======================	
	
		 $.ajax({
            url: "SupplierCashPayment",
            type: "post",
            data: $('#dailyReport-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
	
	
	  .done(function (output) {
//			console.log(output);
		   var obj = eval (output); 
				var  TSC = 0;
		 for (var i = 0; i < obj.length; i++) 
		 {
						   text8 = '<tr><td>'+obj[i].TransDate+'</td>'+
                        '<td >'+obj[i].SupplierName+'</td>'+
                        '<td class="sum">'+obj[i].Mount+'</td>'+'</tr>';
			 
				    cp.row.add( $(text8) ).draw(); 
                     TSC +=Math.round(obj[i].Mount) ; 
		 }
              $(".total8").text(TSC);  

  	 // _dailyreport.CheckTotal8();		
	
		 }).error(function (data) {
        showError('',data);
        }); 
	
//===========================   check paymet =============================================
		 $.ajax({
            url: "SuppliersCheckPayment",
            type: "post",
            data: $('#dailyReport-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
	
	
	  .done(function (output) {
//			console.log(output);
		   var obj = eval (output); 
				var  SCP =0 ;
		 for (var i = 0; i < obj.length; i++) 
		 {
						   text9 = '<tr><td>'+obj[i].TransDate+'</td>'+
                        '<td >'+obj[i].SupplierName+'</td>'+
                        '<td >'+obj[i].BankName+'</td>'+
                        '<td class="sum">'+obj[i].Mount+'</td>'+'</tr>';
			 
				    chp.row.add( $(text9) ).draw(); 
                       SCP += Math.round(obj[i].Mount);
		 }
         console.log(SCP);
            $(".total9").text(SCP);
  	 // _dailyreport.CheckTotal9();		
	
		 }).error(function (data) {
        showError('',data);
        }); 
		
	
//============================ expenses ===================================	
	
	
		 $.ajax({
            url: "Expenses",
            type: "post",
            data: $('#dailyReport-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
	
	
	  .done(function (output) {
//			console.log(output);
		   var obj = eval (output); 
				var TE= 0 
		 for (var i = 0; i < obj.length; i++) 
		 {
						   text10 = '<tr><td>'+obj[i].TransDate+'</td>'+
                        '<td >'+obj[i].ExpenseTypeName+'</td>'+
                        '<td >'+obj[i].CashierName+'</td>'+
                        '<td class="sum">'+obj[i].Mount+'</td>'+'</tr>';
			 
				    ex.row.add( $(text10) ).draw(); 
                    TE += Math.round(obj[i].Mount) ;
		 }
  	 // _dailyreport.CheckTotal10();		
	
                     $(".total10").text(TE);
		 }).error(function (data) {
        showError('',data);
        }); 
		
	
	
}//end of  search for tables

obj2=0;
function setobj (data)
{
obj2=data

}

obj3=0;
function setobj3 (data)
{
obj3=data

}








//=====================  Sum Total outstanding ================================
// dailyreport.prototype.CheckTotal = function(){
// //  alert("aaaaaaaaaaaaaa");
// var totals=[0,0,0];
 
//             var $dataRows=$("#tbl-abordCuatomer-outstanding tr");
 
//             $dataRows.each(function() {
//                 $(this).find('.sum').each(function(i){        
//                     totals[i]+=parseInt( $(this).html());
// //					console.log("00000");
//                 });
//             });
//             $("#tbl-abordCuatomer-outstanding th.total").each(function(i){  
//                 $('.total').html(""+totals[i]);
// //				console.log( totals[i]);
//             });

// }
dailyreport.prototype.CheckTotalforgin = function(){
//  alert("aaaaaaaaaaaaaa");
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-forignproduct tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
//					console.log("00000");
                });
            });
            $("#tbl-forignproduct th.totalforgin").each(function(i){  
                $('.totalforgin').html(""+totals[i]);
//				console.log( totals[i]);
            });

}

dailyreport.prototype.CheckTotal2 = function(){
//  alert("aaaaaaaaaaaaaa");
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-abbordCusmer-close tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
//					console.log("00000");
                });
            });
            $("#tbl-abbordCusmer-close th.total2").each(function(i){  
                $('.total2').html(""+totals[i]);
//				console.log( totals[i]);
            });

}

dailyreport.prototype.CheckTotalcloseForign = function(){
//  alert("aaaaaaaaaaaaaa");
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-close-forginprouduct tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
//					console.log("00000");
                });
            });
            $("#tbl-close-forginprouduct th.totalcloseforign").each(function(i){  
                $('.totalcloseforign').html(""+totals[i]);
//				console.log( totals[i]);
            });

}

dailyreport.prototype.CheckTotal3 = function(){
//  alert("aaaaaaaaaaaaaa");
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-upperCustomer tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
//					console.log("00000");
                });
            });
            $("#tbl-upperCustomer th.total3").each(function(i){  
                $('.total3').html(""+totals[i]);
//				console.log( totals[i]);
            });

}

dailyreport.prototype.CheckTotalupperforign= function(){
//  alert("aaaaaaaaaaaaaa");
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-upperCustomer-forgin tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
//					console.log("00000");
                });
            });
            $("#tbl-upperCustomer-forgin th.totalupperforign").each(function(i){  
                $('.totalupperforign').html(""+totals[i]);
//				console.log( totals[i]);
            });

}


dailyreport.prototype.CheckTotal4 = function(){
//  alert("aaaaaaaaaaaaaa");
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-localCustomers tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
//					console.log("00000");
                });
            });
            $("#tbl-localCustomers th.total4").each(function(i){  
                $('.total4').html(""+totals[i]);
//				console.log( totals[i]);
            });

}

dailyreport.prototype.CheckTotallocalforign = function(){
//  alert("aaaaaaaaaaaaaa");
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-localCustomers_foriegn tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
//					console.log("00000");
                });
            });
            $("#tbl-localCustomers_foriegn th.totallocalforign").each(function(i){  
                $('.totallocalforign').html(""+totals[i]);
//				console.log( totals[i]);
            });

}


dailyreport.prototype.CheckTotal5 = function(){
//  alert("aaaaaaaaaaaaaa");
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-CashDeposit tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
//					console.log("00000");
                });
            });
            $("#tbl-CashDeposit th.total5").each(function(i){  
                $('.total5').html(""+totals[i]);
//				console.log( totals[i]);
            });

}

dailyreport.prototype.CheckTotal6 = function(){
//  alert("aaaaaaaaaaaaaa");
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-ChekDeposit tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
//					console.log("00000");
                });
            });
            $("#tbl-ChekDeposit th.total6").each(function(i){  
                $('.total6').html(""+totals[i]);
//				console.log( totals[i]);
            });

}

dailyreport.prototype.CheckTotal7 = function(){
//  alert("aaaaaaaaaaaaaa");
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-BankDeposit tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
//					console.log("00000");
                });
            });
            $("#tbl-BankDeposit th.total7").each(function(i){  
                $('.total7').html(""+totals[i]);
//				console.log( totals[i]);
            });

}
dailyreport.prototype.CheckTotal8 = function(){
//  alert("aaaaaaaaaaaaaa");
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-cashPayment tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
//					console.log("00000");
                });
            });
            $("#tbl-cashPayment th.total8").each(function(i){  
                $('.total8').html(""+totals[i]);
//				console.log( totals[i]);
            });

}



dailyreport.prototype.CheckTotal9 = function(){
//  alert("aaaaaaaaaaaaaa");
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-checkPayment tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
//					console.log("00000");
                });
            });
            $("#tbl-checkPayment th.total9").each(function(i){  
                $('.total9').html(""+totals[i]);
//				console.log( totals[i]);
            });

}
dailyreport.prototype.CheckTotal10 = function(){
//  alert("aaaaaaaaaaaaaa");
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-Expenses tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
//					console.log("00000");
                });
            });
            $("#tbl-Expenses th.total10").each(function(i){  
                $('.total10').html(""+totals[i]);
//				console.log( totals[i]);
            });

}











//================================datepicker difintion ========================

// function strFormatDate (_Date){
//        var d = new Date(_Date);
//        var curr_date = d.getDate();
//        var curr_month = d.getMonth() + 1;
//        var curr_year = d.getFullYear(curr_year);
//        return curr_date + "/" + curr_month + "/" + curr_year;
//    };
//====================================print==============================
  function PrintEndBills(){
   
    $("#search-dailyreport").addClass("hide");
    $(".DTTT").addClass("hide");
//    $("#tbl-SupplierReport_filter").addClass("hide");
    $(".dataTables_length").addClass("hide");
    $(".dataTables_filter").addClass("hide");
    $(".pagination").addClass("hide");
    $(".panel-heading").addClass("hide");
    // $(".box-header").addClass("hide");
    $(".content-header").addClass("hide");
    $(".main-header").addClass("hide");
    $(".sidebar-menu").addClass("hide");
    $(".dataTables_info").addClass("hide");
    
    $("#dataTables_filter").addClass("hide");

   
//	 $("#ForeignSuppliersID_chosen").css("display","none");
//	 $("#hideinprint").css("display","none");
	  
	 
	   $("#ShowCustomerONPrint11").css("display","block");
        $("#ShowSupplierONPrint2").css("display","block");  
		
	   if($("#check_Customers").is(":checked")) 
   {
    	$("#ShowCustomerONPrint11").css("visibility","visible"); 
   }else{
    
     
    $("#ShowCustomerONPrint11").css("visibility","hidden");  
   }	 
	  
	  if($("#check_Supplirs").is(":checked")) 
   {
    	$("#ShowSupplierONPrint2").css("visibility","visible"); 
   }else{
    
     
    $("#ShowSupplierONPrint2").css("visibility","hidden");  
   }
	  
	 window.print();
  }
	


	 $(document).keyup(function(e) {

//alert("00");
      if (e.keyCode == 27) {
//		 alert("a7aaaa");
        $("#search-dailyreport").removeClass("hide");
		 
        $(".DTTT").removeClass("hide");
		 
//        $("#tbl-SupplierReport_filter").removeClass("hide");
		 
        $(".dataTables_length").removeClass("hide");
		 
        $(".dataTables_filter").removeClass("hide");
		 
        $(".pagination").removeClass("hide");
		 
        $(".panel-heading").removeClass("hide");
		 
        // $(".box-header").removeClass("hide");
		 
        $(".content-header").removeClass("hide");
		 
        $(".main-header").removeClass("hide");
		 
        $(".sidebar-menu").removeClass("hide");
		 
//        $("#hideinprint").css("display","block");
		 
        $(".dataTables_info").css("display","block");
		 
		 $("#print").css("display","block");
		 
		 $("#ShowCustomerONPrint11").css("display","none");
        $("#ShowSupplierONPrint2").css("display","none")  
   
        $("#dataTables_filter").removeClass("hide");
		  
	   if($("#check_Customers").is(":checked")) 
   {
    	$("#ShowCustomerONPrint11").css("visibility","visible"); 
   }else{
    
     
    $("#ShowCustomerONPrint11").css("visibility","hidden");  
   }
		  
		  	  if($("#check_Supplirs").is(":checked")) 
   {
    	$("#ShowSupplierONPrint2").css("visibility","visible"); 
   }else{
    
     
    $("#ShowSupplierONPrint2").css("visibility","hidden");  
   }

    
}


});


// print ervey table 
$(document).ready(function() {
	
 var tbl_1 = $('#tbl-abordCuatomer-outstanding').DataTable({dom: 'T<"clear">lfrtip',});

 var tbl_2 = $('#tbl-forignproduct').DataTable({dom: 'T<"clear">lfrtip',});

 var tbl_3 = $('#tbl-abbordCusmer-close').DataTable({dom: 'T<"clear">lfrtip',});

 var tbl_4 = $('#tbl-close-forginprouduct').DataTable({dom: 'T<"clear">lfrtip',});

 var tbl_5 = $('#tbl-upperCustomer').DataTable({dom: 'T<"clear">lfrtip',});

 var tbl_6 = $('#tbl-localCustomers').DataTable({dom: 'T<"clear">lfrtip',});

 var tbl_7 = $('#tbl-localCustomers_foriegn').DataTable({dom: 'T<"clear">lfrtip',});

 var tbl_8 = $('#tbl-CashDeposit').DataTable({dom: 'T<"clear">lfrtip',});

 var tbl_9 = $('#tbl-ChekDeposit').DataTable({dom: 'T<"clear">lfrtip',});

 var tbl_10 = $('#tbl-BankDeposit').DataTable({dom: 'T<"clear">lfrtip',});

 var tbl_11 = $('#tbl-cashPayment').DataTable({dom: 'T<"clear">lfrtip',});

 var tbl_12 = $('#tbl-checkPayment').DataTable({dom: 'T<"clear">lfrtip',});

 var tbl_13 = $('#tbl-upperCustomer-forgin').DataTable({dom: 'T<"clear">lfrtip',});

 var tbl_14 = $('#tbl-Expenses').DataTable({dom: 'T<"clear">lfrtip',});



  $("#ToolTables_tbl-abordCuatomer-outstanding_4").on("click", function(){

	  
	    $("#search-dailyreport").addClass("hide");
        $("br").addClass("hide");
	  
	   window.print();
	  
	  });
	//2
  $("#ToolTables_tbl-forignproduct_4").on("click", function(){

	  $("br").addClass("hide");
	    $("#search-dailyreport").addClass("hide");
	  
	   window.print();
	  
	  }); 
	
	//3
	$("#ToolTables_tbl-abbordCusmer-close_4").on("click", function(){

	  $("br").addClass("hide");
	    $("#search-dailyreport").addClass("hide");
	  
	   window.print();
	  
	  });
	//4
	$("#ToolTables_tbl-close-forginprouduct_4").on("click", function(){

	  $("br").addClass("hide");
	    $("#search-dailyreport").addClass("hide");
	  
	   window.print();
	  
	  });
	//5
	$("#ToolTables_tbl-upperCustomer_4").on("click", function(){
$("br").addClass("hide");
	  
	    $("#search-dailyreport").addClass("hide");
	  
	   window.print();
	  
	  });
	//6
	
	$("#ToolTables_tbl-upperCustomer-forgin_4").on("click", function(){
$("br").addClass("hide");
	  
	    $("#search-dailyreport").addClass("hide");
	  
	   window.print();
	  
	  });
	
	//7
	$("#ToolTables_tbl-localCustomers_4").on("click", function(){

	  $("br").addClass("hide");
	    $("#search-dailyreport").addClass("hide");
	  
	   window.print();
	  
	  });
	
	//8
	
	$("#ToolTables_tbl-localCustomers_foriegn_4").on("click", function(){

	  $("br").addClass("hide");
	    $("#search-dailyreport").addClass("hide");
	  
	   window.print();
	  
	  });
	
	//9
	
	$("#ToolTables_tbl-CashDeposit_4").on("click", function(){

	  $("br").addClass("hide");
	    $("#search-dailyreport").addClass("hide");
	  
	   window.print();
	  
	  });
	//10
	$("#ToolTables_tbl-ChekDeposit_4").on("click", function(){

	  $("br").addClass("hide");
	    $("#search-dailyreport").addClass("hide");
	  
	   window.print();
	  
	  });
	//11
		$("#ToolTables_tbl-BankDeposit_4").on("click", function(){
$("br").addClass("hide");
	  
	    $("#search-dailyreport").addClass("hide");
	  
	   window.print();
	  
	  });
	//12
			$("#ToolTables_tbl-cashPayment_4").on("click", function(){
$("br").addClass("hide");
	  
	    $("#search-dailyreport").addClass("hide");
	  
	   window.print();
	  
	  });
	//13
			$("#ToolTables_tbl-checkPayment_4").on("click", function(){
$("br").addClass("hide");
	  
	    $("#search-dailyreport").addClass("hide");
	  
	   window.print();
	  
	  });
	//14
			$("#ToolTables_tbl-Expenses_4").on("click", function(){
$("br").addClass("hide");
	  
	    $("#search-dailyreport").addClass("hide");
	  
	   window.print();
	  
	  });
	
	
	
	
	
});// end of doument of ready	


    $(document).keyup(function(e) {
     if (e.keyCode == 27) {
       $("#search-dailyreport").removeClass("hide");
       $("br").removeClass("hide");
          
    }
});

$(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#search-dailyreport").prop("disabled",false);
});
});
	


