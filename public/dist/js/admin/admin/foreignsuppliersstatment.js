var foreignSuppliersstatment = function () {};

$(function(){ _foreignSuppliersstatment = new foreignSuppliersstatment(); });



$(document).ready(function() {
 $('#search-foreignSuppliersstatment').click(function(){
            SetOpeningBalnceFS(0);
            SetBalanceTypeFS('');
            SetIntNum(0);
            setpayment(0);
            setdis(0);
            setfrefund(0);
            setfinaltotal(0);



// $("#search-foreignSuppliersstatment").prop("disabled",true);
       _foreignSuppliersstatment.searchfortables();
    });
    });
    

checkRadio=1;

function individuale(){
checkRadio=1;
}


function combine(){
checkRadio=2;
}    
    
Total=0;
 OtherEx=0;
 Nawlon=0;
 Commision=0;
   

foreignSuppliersstatment.prototype.setTotal = function(data){
    Total=data;  
    console.log("Total" + Total);
 }
foreignSuppliersstatment.prototype.setOtherEx = function(data){
    OtherEx=data;  
 }
foreignSuppliersstatment.prototype.setNawlon = function(data){
    Nawlon=data;  
 }
foreignSuppliersstatment.prototype.setCommision = function(data){
    Commision=data;  
 }

OpeningBalnceFS=0;
function SetOpeningBalnceFS(data)
{
OpeningBalnceFS=data;
//console.log("OpeningBalnceFS");
//console.log(OpeningBalnceFS);  
}

BalnceTypeFS='';
function SetBalanceTypeFS(data)
{
BalnceTypeFS=data;
//console.log("BalnceTypeFS"); 
//console.log(BalnceTypeFS); 
}
// local intNum
LocalIntNum=0;
function SetIntNum(data)
{
LocalIntNum=data;
//console.log("LocalIntNum");  
//console.log(LocalIntNum); 
  
}
fspayment = 0 ;

function setpayment(data)
{
fspayment= data;
//console.log("fspayment");
//console.log(fspayment);
}
fsdiscount = 0 ;
function setdis(data){
fsdiscount =data; 
//console.log("fsdiscount");
//console.log(fsdiscount);
}
fsrefund  = 0 ;
function setfrefund(data)
{
fsrefund = data
//console.log("fsrefund");
//console.log(fsrefund);

}
FSfinaltotal=0;
function setfinaltotal(data)
{
FSfinaltotal = data;
console.log("First: 1");
// console.log("FSfinaltotal");
console.log(FSfinaltotal);

} 
function getSuppliersName(SupplierID)
    {
        var cboForeignSuppliersID = $( "#ForeignSuppliersStatmentID" ).clone();
        $(cboForeignSuppliersID).val(SupplierID);

        return $('option:selected',cboForeignSuppliersID).text() ; 
    } 




foreignSuppliersstatment.prototype.searchfortables = function(){
   
 var t = $('#tbl-ForeignSuppliersstatment').DataTable();
 var table = $('#tbl-FinalDatastatment').DataTable();

 var custome =  $('#tbl-customestament').DataTable();
    
    try
    {
    t
    .clear()
    .draw();
    }
    catch(ex)
    {
//        alert("error");
        //console.log(ex);
    } 
	
	try
    {
    table	
    .clear()
    .draw();
    }
    catch(ex)
    {
//        alert("error");
//        //console.log(ex);
    }
    
    try
    {
    custome	
    .clear()
    .draw();
    }
    catch(ex)
    {
//        alert("error");
//        //console.log(ex);
    }
    var ref = $('#tbl-SupplierRefundsstatment').DataTable();
try
    {
    ref
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        //console.log(ex);
    }   
var disc = $('#tbl-SupplierDiscountssStatment').DataTable();
try
    {
    disc
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        //console.log(ex);
    }   
var pay = $('#tbl-SupplierPaymentstatment').DataTable();
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
        //console.log(ex);
        
    }

    
    
    
    
    
    
//	//console.log($('#foreignsuppliersstatment-repo-form :input'));
//	//console.log($("================================="));
           
        $.ajax({
            url: "loadforeignsupppliersstatment",
            type: "post",
            data: $('#foreignsuppliersstatment-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
       
          .done(function (output) {
		    	
  
            var obj = eval (output);
           // //console.log(obj);
   //         for ( var t = 0 ; t<obj.length ; t++)
   //         {

			// }
			var TotalSum=0;

          
			   for (var i = 0; i < obj.length; i++) {
			   TotalSum+=obj[i].Total;


            _foreignSuppliersstatment.setCommision(obj[i].Commision);
            _foreignSuppliersstatment.setNawlon(obj[i].Nowlon);
            _foreignSuppliersstatment.setOtherEx(obj[i].OtherExpenses);
			   }
			

			_foreignSuppliersstatment.setTotal(TotalSum);
            
			input=$('#foreignsuppliersstatment-repo-form :input');
		 // //console.log(input);
//				 //console.log(input[2]);
//				 //console.log(input[3]);    			 
				 var x= input[2].value;
            // //console.log(x);
//                  var y= input[4].value;
//                  var z= input[6].value;
//				//console.log(y);
				 var text=getSuppliersName(x);
//            console.
//				 var text2=getContainerName(y);
//				 var text3=getSerialContainerName(z);
			
			
		
				$("#ShowSuppliersStatment").text("اسم المورد: "+text);			   
//				 $("#ShowContiner").text("اسم الحاويه:"+text2); 
//				 $("#ShowSieralContiner").text("مسلسل الحاويه:"+text3); 
		        
//     			 //console.log(text);
//				 //console.log(text2);    			 
		            var T_Total=0;
                    var T_Crrying=0;
                    var T_totalFinal=0;
                    var finaltotal=0;
               for (var i = 0; i < obj.length; i++) {
				 var  firstotal =  obj[i].Total
                var   carrying  =  obj[i].Carrying
                 var IntNum=     obj[i].ContainerIntNum
                   finaltotal=firstotal + carrying;
                   
                      if(obj[i].WeightType==0 ) {
                     text = '<tr><td class="date hidecombiner">'+obj[i].SalesDate+'</td>'+
                            '<td >'+obj[i].ContainerIntNum+'</td>'+
                            '<td class="hidecombiner">'+obj[i].CustomerName+'</td>'+
                            '<td class="Pname hidecombiner">'+obj[i].ProductName+'</td>'+
                            '<td class="hidecombiner">الكيلو</td>'+
                            '<td class="sum_weight hidecombiner"  >'+obj[i].Weight+'</td>'+
                            '<td class="sum_quantity hidecombiner" >'+obj[i].Quantity+'</td>'+
                            '<td class="sum_productprice hidecombiner" >'+obj[i].ProductPrice+'</td>'+
                            '<td class="sum sum_Total hidecombiner" >'+obj[i].Total+'</td>'+
                            '<td class="crrying sumcrr hidecombiner" >'+obj[i].Carrying+'</td>'+
                            '<td class="finaltotal  sumfinal hidecombiner">'+finaltotal+'</td>';
                           
                             }else  { 
                                 text = '<tr><td class="date">'+obj[i].SalesDate+'</td>'+
                                 '<td >'+obj[i].ContainerIntNum+'</td>'+
                            '<td class="hidecombiner">'+obj[i].CustomerName+'</td>'+
                            '<td class="Pname"  >'+obj[i].ProductName+'</td>'+
                            '<td class="sum_weight hidecombiner"  >'+obj[i].Weight+'</td>'+
                            '<td class="hidecombiner">الوزنة</td>'+
                            '<td class="sum_quantity hidecombiner" >'+obj[i].Quantity+'</td>'+
                            '<td class="sum_productprice hidecombiner" >'+obj[i].ProductPrice+'</td>'+
                            '<td class="sum sum_Total" >'+obj[i].Total+'</td>'+
                            '<td class="crrying sumcrr hidecombiner" >'+obj[i].Carrying+'</td>'+
                            '<td class="finaltotal sumfinal" >'+finaltotal+'</td>';
									}
                   
                    t.row.add( $(text) ).draw();
                   
                    SetIntNum(IntNum);
                }
            
            

        _foreignSuppliersstatment.CheckTotal1();
        _foreignSuppliersstatment.CheckTotalcrrying();
        _foreignSuppliersstatment.CheckTotalAfterCrrying();
            

		//console.log("#######final####LoadData###");             
//console.log(finaltotal);


			$.ajax({
				url: "GetCustomMountstatment",
				type: "post",
				data: $('#foreignsuppliersstatment-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
				dataType: "json"
			}).done(function (output) {
				var obj = eval(output);
				var sum=0;
                var final = 0;
                var finaltotalFS = 0; 
				for (var i = 0; i < obj.length; i++) {
					sum+=obj[i].CustomMount;
					sum2=obj[i].CustomMount;
					CustomName=obj[i].CustomName;
//					//console.log(obj[i].CustomMount);
                    text4= '<tr><td>'+obj[i].CustomName+'</td>'+
                           '<td>'+obj[i].CustomMount+'</td>'+
                           '<td>'+LocalIntNum+'</td><tr>';
                     
                    custome.row.add( $(text4) ).draw();

                    
				}
          // setfinaltotal(finaltotal);

				 var b=sum+OtherEx+Nawlon
				var final=Total-b;
				
				finalcom=Math.round((Commision/100)*Total);
//				finalcom=Math.round((Commision/100)*final);
				finaltotalFS=final-finalcom;

        setfinaltotal(finaltotalFS);

				 text = '<tr><td>'+LocalIntNum+'</td>'+
                        '<td>'+Total+'</td>'+
					 	'<td>'+OtherEx+'</td>'+
					     '<td>'+sum+'</td>'+
					     '<td>'+Nawlon+'</td>'+
					     '<td>'+final+'</td>'+
              '<td>'+finalcom+'</td>'+
              // '<td>'+finaltotal+'</td>';
              '<td>'+finaltotalFS+'</td>';

  		

                    table.row.add( $(text) ).draw();

				//console.log("#######final#####GetCustom#######");             
       //console.log(FSfinaltotal);
				  _foreignSuppliersstatment.finalstatment();
			}).error(function (data) {
          _foreignSuppliersstatment.finalstatment();
					showError('',data);
				}); 
				   
            _foreignSuppliersstatment.finalstatment();
       }).error(function (data) {
          _foreignSuppliersstatment.finalstatment();
        showError('',data);
        }); 
//====================================== ======================================
//      
    /*Date Open end*/
    
    
    /// final of loadpayment
    foreignSuppliersstatment.prototype.CheckTotal = function(){

var FSpayment=[0,0,0];
       
            var $dataRows=$("#tbl-SupplierPaymentstatment tr");

            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    FSpayment[i]+=parseInt( $(this).html());
                });
            });
            $("#tbl-SupplierPaymentstatment th.total").each(function(i){  
                $('.total').html("اجمالى المبلغ :"+FSpayment[i]);
                
                   setpayment(FSpayment[i])
            });
              
        
        
        
             ////console.log($dataRows)
             // alert("1");
}
    
    
//loadfinal supplierDiscounts
foreignSuppliersstatment.prototype.CheckTotal2 = function(){
 
var fsDiscount=[0,0,0];
 
            var $dataRows=$("#tbl-SupplierDiscountssStatment tr");
 



            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
                   
                });
            });
            $("#tbl-SupplierDiscountssStatment th.total2").each(function(i){  
                $('.total2').html("اجمالى المبلغ :"+fsDiscount[i]);
                setdis(fsDiscount[i])
            });




             ////console.log($dataRows)
// alert("2");
}   
 
//supplier refund
 foreignSuppliersstatment.prototype.CheckTotal3 = function(){
 
var FSRefunnd=[0,0,0];
 
            var $dataRows=$("#tbl-SupplierRefundsstatment tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    FSRefunnd[i]+=parseInt( $(this).html());
                });
            });
            $("#tbl-SupplierRefundsstatment th.total3").each(function(i){  
                $('.total3').html("اجمالى المبلغ :"+FSRefunnd[i]);
                
                setfrefund(FSRefunnd[i]);
            });
             ////console.log($dataRows)
// alert("3");
}



        //LoadPayments
     $.ajax({
            url: "LoadPayments",
            type: "post",
            data: $('#foreignsuppliersstatment-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
       .done(function (results) {
       var input=$('#foreignsuppliersstatment-repo-form :input');
         var obj = eval (results);
         
           for (var i = 0; i < obj.length; i++) {
 
                 sup_pay = '<tr><td>'+obj[i].TransDate+'</td>'+
                        '<td class="sum">'+ obj[i].Mount+'</td>'+
                        '<td >'+obj[i].PaymentType+'</td>'+
                        '<td >'+obj[i].CheckNo+'</td>'+
                        '<td >'+obj[i].Notes+'</td>';

                pay.row.add( $(sup_pay) ).draw();

            }
         


          _foreignSuppliersstatment.CheckTotal();


          _foreignSuppliersstatment.finalstatment();
       }).error(function (data) {
        _foreignSuppliersstatment.finalstatment();
        showError('',data);
        });

        $.ajax({
            url: "LoadRefund",
            type: "post",
            data: $('#foreignsuppliersstatment-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
       .done(function (output) {
       var input=$('#foreignsuppliersstatment-repo-form :input');
         var obj = eval (output);
         // //console.log(output);
           for (var i = 0; i < obj.length; i++) {
                 textt = '<tr><td>'+obj[i].RefundDate+'</td>'+
                        '<td class="sum">'+ obj[i].Refund+'</td>'+
                        '<td >'+obj[i].Notes+'</td>';

                ref.row.add( $(textt) ).draw();



//console.log("#######final###Refund######");             
//console.log(FSfinaltotal);
            }
            _foreignSuppliersstatment.CheckTotal3();

       _foreignSuppliersstatment.finalstatment();
       }).error(function (data) {
        _foreignSuppliersstatment.finalstatment();
        showError('',data);
        });


         $.ajax({
             url: "LoadDiscount",
            type: "post",
             data: $('#foreignsuppliersstatment-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
                    dataType: "json"
                }).done(function (output) {
               var input=$('#foreignsuppliersstatment-repo-form :input');
                 var obj = eval (output);
                 
                   for (var i = 0; i < obj.length; i++) {
         
                         text = '<tr><td>'+obj[i].TransDate+'</td>'+
                                '<td class="sum">'+ obj[i].Mount+'</td>'+
                                '<td >'+obj[i].Notes+'</td>';

                        disc.row.add( $(text) ).draw();

                    }
                    _foreignSuppliersstatment.CheckTotal2();
                 /**/
//console.log("#######final####Discount########");             
//console.log(FSfinaltotal);
                
                 /**/
                 _foreignSuppliersstatment.finalstatment();
                  }).error(function (data) {
                    _foreignSuppliersstatment.finalstatment();
         showError('',data);
         });         
           
//=========================================== 
                 
                 
              

//load suppliers openingbaknce 
         $.ajax({
            url: "SuppliersOpeningBalanceStatment",
            type: "post",
            data: $('#foreignsuppliersstatment-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {
         var obj = eval (output);
            //console.log(obj);
          debtstatment = '' ;        
          Mount = 0 ;   
      
SetOpeningBalnceFS(Mount);
SetBalanceTypeFS(debtstatment);


             for( var i = 0 ; i < obj.length ; i ++ ){


                           // //console.log(debtstatment);
                           // //console.log(Mount);
                           // //console.log("0000000000000");
/*check of dept Exitst*/
                        if (obj[i].Debt !== '')
                        {
                        debtstatment =obj[i].Debt ;
                             
                        }else{

                            debtstatment = '' ;
                            
                        } 
//check of opening balance is exist 

                        if(obj[i].Mount > 0 )
                        { 
                        Mount= obj[i].Mount;
                      

                        }else{
                            Mount = 0 ;
                        }
                    
SetOpeningBalnceFS(Mount);
//console.log("#####################");

SetBalanceTypeFS(debtstatment);
//console.log(debtstatment);

             if(debtstatment == 0 )
             {
document.getElementById('suppliers_opening_date101').innerHTML="تاريخ الافتتاح :"+obj[i].TransDate;
document.getElementById('suppliers_openingBalnce_Mount102').innerHTML="الرصيد الافتتاحى :"+obj[i].Mount+" دائن ";
             }else{
document.getElementById('suppliers_opening_date101').innerHTML="تاريخ الافتتاح :"+obj[i].TransDate;
document.getElementById('suppliers_openingBalnce_Mount102').innerHTML="الرصيد الافتتاحى :"+obj[i].Mount+" مدين";
             }
             }//end of for     


//console.log("#######final####openingbalnce###");             
//console.log(FSfinaltotal);

       _foreignSuppliersstatment.finalstatment();
    }).error(function (data){
      _foreignSuppliersstatment.finalstatment();
        showError('',data);
    });
      


    
}//end of serch of tables 
    
    
    
    

//------------------------------sarech for tables end----------------------
$(document).ready(function(){
//console.log("#######final#### Before Function###");             
//console.log(FSfinaltotal);
});
/*function to run last tanle start*/
foreignSuppliersstatment.prototype.finalstatment= function (){


 var openingbalnceStatment = $('#tbl-finalForiegnSuppliersstatment').DataTable();
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
        //console.log(ex);
    }
console.log("Socend: 2");          
console.log(FSfinaltotal);

//console.log("ayhaga");
//console.log(BalnceTypeFS);
//console.log(OpeningBalnceFS);
//console.log("###########################");


             var dept3 = 0;
             var cridet3 = 0;
             var final3 = 0;

                 if (BalnceTypeFS  === '' ){
                        //Not cridt of dept
                    dept3 =   fspayment;
                  cridet3 = FSfinaltotal + fsrefund + fsdiscount; 
                   final3 =  dept3 - cridet3;
                      
                 }else  if (BalnceTypeFS  == 1 ){

                   //opening balnce dept

                dept3 = OpeningBalnceFS +  fspayment;   
                cridet3 =  FSfinaltotal+ fsrefund + fsdiscount; 
                final3 =   dept3 - cridet3;


                  }else if (BalnceTypeFS == 0 ){

              //oening balnce credit
                   dept3 =    fspayment ;
                   cridet3 = OpeningBalnceFS + FSfinaltotal + fsrefund + fsdiscount; 
                    final3 =  dept3 - cridet3;
             
                   }


                    //console.log(final3);

                     tblfinalstat = '<tr><td>'+dept3+'</td>'+
                                    '<td>'+cridet3+'</td>'+
                                    '<td>'+final3+'</td>'+'</tr>';  
                    
      openingbalnceStatment.row.add( $(tblfinalstat) ).draw();


}// end of fn

$(document).ready(function(){
//console.log("#######final####AfterFunction###");             
//console.log(FSfinaltotal);
});
/**/


//=============================Grouping====================================================
$(document).ready(function() {
    
var table2 = $('#tbl-FinalDatastatment').DataTable();

var table3 = $('#tbl-SupplierRefundsstatment').DataTable({dom: 'T<"clear">lfrtip',});
var table4 = $('#tbl-SupplierDiscountssStatment').DataTable({dom: 'T<"clear">lfrtip',});
var table5 = $('#tbl-SupplierPaymentstatment').DataTable({dom: 'T<"clear">lfrtip',});
 var table6 = $('#tbl-customestament').DataTable()

    
   var table7= $('#tbl-customeStatmentSuppliers').DataTable( );
    
   var table8= $('#tbl-finalForiegnSuppliersstatment').DataTable({dom: 'T<"clear">lfrtip',} );

    
    var table = $('#tbl-ForeignSuppliersstatment').DataTable({
        dom: 'T<"clear">lfrtip',
         tableTools: {
            "sSwfPath": "/swf/copy_csv_xls_pdf.swf"
        },
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
                        '<tr class="group"><td colspan="11">مسلسل الحاوية: '+group+'</td></tr>'
                    );
 
                    last = group;
                }
              }
            });
            
            
              if(checkRadio==1){ 

                  $(".hidecombiner").css("display","table-cell");
                  $('#tbl-ForeignSuppliersstatment tbody').find('.group').each(function(i, v) {
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
                                
                      // T_totalFinal = T_Total + parseInt($(this).find(".finaltotal").text());
                     // T_totalFinal = Math.round(T_totalFinal);
                            
                                   T_totalFinal = T_Total + T_Crrying ;
                     T_totalFinal = Math.round(T_totalFinal) ;

                            });
                             if ($(this).nextUntil('.group').next() )
                             { 
							
								 
                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter" style="background:#f90"><td> المجموع</td><td class="hidecombiner"></td><td class="hidecombiner"></td><td class="hidecombiner"></td><td class="hidecombiner">'+T_Weight+'</td><td class="hidecombiner">'+T_Quantity+'</td><td class="hidecombiner">'+T_ProductPrice+'</td><td >'+T_Total+'</td><td>'+T_Crrying+'</td><td>'+T_totalFinal+'</td> </tr>')
								 
							
                                
                             }
               
            
                        });
              
              
              }
            
            
            // combine 
            
            
            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                
                
                
                if(checkRadio==2){
                    
                    $(".hidecombiner").css("display","none")
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="3">مسلسل الحاوية: '+group+'</td></tr>'
                    );
 
                    last = group;
                }
                }
                
                
                
            } );
                    
            
             if(checkRadio==2){

                $('#tbl-ForeignSuppliersstatment tbody').find('.group').each(function(i, v) {
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
                                
                                   // T_totalFinal = T_Total + parseInt($(this).find(".finaltotal").text());
                                      T_totalFinal = T_Total + T_Crrying ;
                     T_totalFinal = Math.round(T_totalFinal) ;
                                
                                    T_date=$(this).find(".date").text();

                            });
                             if ($(this).nextUntil('.group').next() )
                             { 
							
								 
                                 $(this).nextUntil('.group').last().after('<tr class="groupfooter"style="background:#f90"><td>'+T_date+'</td><td>'+T_Total+'</td><td>'+T_totalFinal+'</td> </tr>')
								 
							
                                
                             }
               
            
                        });
             }
                    
            
        }
    }); 

    

    // Order by the grouping
    $('#tbl-ForeignSuppliersstatment tbody').on( 'click', 'tr.group', function () {
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




$(document).ready(function(){
    $("#ToolTables_tbl-ForeignSuppliersstatment_4").on("click" , function(){
        
         $("#search-foreignSuppliersstatment").addClass("hide");
    $("br").addClass("hide");
	 $("#ForeignSuppliersStatmentID_chosen").css("display","none");
 $("#ShowSuppliersStatment").css("display","block");
 if(checkRadio == 1){
        $("#Combine2").css("visibility","hidden");    
         $("#comb22").css("visibility","hidden");
      }
        else            
        {
            $("#Individuale2").css("visibility","hidden"); 
            $("#indi22").css("visibility","hidden");
        }

           window.print();
    });
    
    $("#ToolTables_tbl-SupplierPaymentstatment_4").on("click" , function(){
            $("br").addClass("hide");
         $("#search-foreignSuppliersstatment").addClass("hide");

	 $("#ForeignSuppliersStatmentID_chosen").css("display","none");
 $("#ShowSuppliersStatment").css("display","block");
 if(checkRadio == 1){
        $("#Combine2").css("visibility","hidden");    
         $("#comb22").css("visibility","hidden");
      }
        else            
        {
            $("#Individuale2").css("visibility","hidden"); 
            $("#indi22").css("visibility","hidden");
        }

           window.print();
    }); 
    
    $("#ToolTables_tbl-SupplierRefundsstatment_4").on("click" , function(){
            $("br").addClass("hide");
         $("#search-foreignSuppliersstatment").addClass("hide");

	 $("#ForeignSuppliersStatmentID_chosen").css("display","none");
 $("#ShowSuppliersStatment").css("display","block");
 if(checkRadio == 1){
        $("#Combine2").css("visibility","hidden");    
         $("#comb22").css("visibility","hidden");
      }
        else            
        {
            $("#Individuale2").css("visibility","hidden"); 
            $("#indi22").css("visibility","hidden");
        }

           window.print();
    });
        $("#ToolTables_tbl-SupplierDiscountssStatment_4").on("click" , function(){
            $("br").addClass("hide");
         $("#search-foreignSuppliersstatment").addClass("hide");

	 $("#ForeignSuppliersStatmentID_chosen").css("display","none");
 $("#ShowSuppliersStatment").css("display","block");
 if(checkRadio == 1){
        $("#Combine2").css("visibility","hidden");    
         $("#comb22").css("visibility","hidden");
      }
        else            
        {
            $("#Individuale2").css("visibility","hidden"); 
            $("#indi22").css("visibility","hidden");
        }

           window.print();
    });
    
    
          $("#ToolTables_tbl-finalForiegnSuppliersstatment_4").on("click" , function(){
            $("br").addClass("hide");
         $("#search-foreignSuppliersstatment").addClass("hide");

	 $("#ForeignSuppliersStatmentID_chosen").css("display","none");
 $("#ShowSuppliersStatment").css("display","block");
 if(checkRadio == 1){
        $("#Combine2").css("visibility","hidden");    
         $("#comb22").css("visibility","hidden");
      }
        else            
        {
            $("#Individuale2").css("visibility","hidden"); 
            $("#indi22").css("visibility","hidden");
        }

           window.print();
    });
    


});




  $(document).keyup(function(e) {
     if (e.keyCode == 27) {
//       $("#search-dailyreport").css("visibility","visible");
              $("br").removeClass("hide");
                 $("#search-foreignSuppliersstatment").removeClass("hide");
  $("#ForeignSuppliersID_chosen").css("display","block");
        $("#ForeignSuppliersStatmentID_chosen").css("display","block");


		 $("#ShowSuppliersStatment").css("display","none");


    if(checkRadio == 1){
        $("#Combine2").css("visibility","Visible");    
         $("#comb22").css("visibility","Visible");
      }
        else            
        {
            $("#Individuale2").css("visibility","Visible"); 
            $("#indi22").css("visibility","Visible");
        }

    }
});





 function Print(){
      $("br").addClass("hide");
    // alert("aaa");
    $("#search-foreignSuppliersstatment").addClass("hide");
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
   
   
	 $("#ForeignSuppliersStatmentID_chosen").css("display","none");
//	 $("#cboContainerID_chosen").css("display","none");
//	 $("#cboSerialContainerID_chosen").css("display","none");
	 
	 $("#ShowSuppliersStatment").css("display","block");
//     $("#ShowContiner").css("display","block");   
//    $("#ShowSieralContiner").css("display","block");  
     
     if(checkRadio == 1){
        $("#Combine2").css("visibility","hidden");    
         $("#comb22").css("visibility","hidden");
      }
        else            
        {
            $("#Individuale2").css("visibility","hidden"); 
            $("#indi22").css("visibility","hidden");
        }

     window.print();

}


 function Print2(){
    // alert("aaa");
    $("br").addClass("hide");
    $("#search-foreignSuppliersstatment").addClass("hide");
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
    $(".hideOnPrint").addClass("hide");
    $("#dataTables_filter").addClass("hide");
//    $("#print").css("display","none");
   
//   $(".ptn3").addClass("hide")
	 $("#ForeignSuppliersStatmentID_chosen").css("display","none");
	 $("#cboContainerID_chosen").css("display","none");
	 $("#cboSerialContainerID_chosen").css("display","none");
	 
	 $("#ShowSuppliersStatment").css("display","block");
//     $("#ShowContiner").css("display","block");   
    $("#ShowSieralContiner").css("display","block");  
     
       if(checkRadio == 1){
        $("#Combine2").css("visibility","hidden");    
         $("#comb22").css("visibility","hidden");
      }
        else            
        {
            $("#Individuale2").css("visibility","hidden"); 
            $("#indi22").css("visibility","hidden");
        }
     
     
     window.print();

}



     function myFunction(e){

     if (e.keyCode == 27) {     

        $("#search-foreignSuppliersstatment").removeClass("hide");
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
        $("#ForeignSuppliersID_chosen").css("display","block");
        $("#ForeignSuppliersStatmentID_chosen").css("display","block");
//        $("#cboSerialContainerID_chosen").css("display","block");
		  $(".hideOnPrint").removeClass("hide");
		 $("#print").css("display","block");
		
		 $("#ShowSuppliersStatment").css("display","none");
        
//		 $("#ShowContiner").css("display","none"); 
         
//		 $("#ShowSieralContiner").css("display","none"); 
   
        $("#dataTables_filter").removeClass("hide");
      
     $(".ptn3").removeClass("hide")
     
     
      if(checkRadio == 1){
        $("#Combine2").css("visibility","Visible");    
         $("#comb22").css("visibility","Visible");
      }
        else            
        {
            $("#Individuale2").css("visibility","Visible"); 
            $("#indi22").css("visibility","Visible");
        }
     
   

    }
}

//});


 $(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#search-foreignSuppliersstatment").prop("disabled",false);
});
     
     
     
    $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        });
        $( ".datepicker" ).datepicker("setDate", new Date());
    

     
     
});



foreignSuppliersstatment.prototype.CheckTotal1 = function(){
 
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-ForeignSuppliersstatment tr");
 
            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+= parseInt($(this).html());
                 //console.log(totals);

                });
            });
            $("#tbl-ForeignSuppliersstatment th.firstTotal").each(function(i){  
                $('.firstTotal').html("اجمالى المبلغ :"+totals[i]);
            });
 
}
foreignSuppliersstatment.prototype.CheckTotalcrrying = function(){
 
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-ForeignSuppliersstatment tr");
 
            $dataRows.each(function() {
                $(this).find('.sumcrr').each(function(i){        
                     totals[i]+= parseInt($(this).html());
                
                    //console.log(totals);
//                    //console.log("AAAAAAAAAAAAAA");
                });
            });
            $("#tbl-ForeignSuppliersstatment th.crryingTotal").each(function(i){  
                $('.crryingTotal').html("اجمالى المبلغ :"+totals[i]);
            });
 
}
foreignSuppliersstatment.prototype.CheckTotalAfterCrrying = function(){
 
var totals=[0,0,0];
 
            var $dataRows=$("#tbl-ForeignSuppliersstatment tr");
 
            $dataRows.each(function() {
                $(this).find('.sumfinal').each(function(i){        
                       totals[i]+= parseInt($(this).html());
                    //console.log(totals);
//                    //console.log("AAAAAAAAAAAAAA");
                });
            });
            $("#tbl-ForeignSuppliersstatment th.finaltotala2").each(function(i){  
                $('.finaltotala2').html("اجمالى المبلغ :"+totals[i]);
            });
 
}






