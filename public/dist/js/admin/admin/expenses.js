//Define Banks Class
var expenses = function () {};

optionName="";
/*
* Validate after Add new Bank
* check Bank Name is required
* check Bank Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
expenses.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);
//		console.log(data.ExpensesGrpupID);
    });

    var errors = [];
    if (! data.TransDate ) {

        errors.push(config.required_transdate);

    }
    if (! data.Mount ) {

        errors.push(config.required_mount);

    }
	
	
		
	if (! data.ExpensesGroupID ) {
//	alert("00");
        errors.push(config.required_expensegroupid);
    }
    else if (data.ExpensesGroupID == 0)
    {
        errors.push(config.required_expensegroupid);
    }

	
//    if (! data.ExpenseTypeID ) {
//        errors.push(config.required_expensetypeid);
//    }
//    else if (data.ExpenseTypeID == 0)
//    {
//        errors.push(config.required_expensetypeid);
//    }
	
    if (! data.CashierID ) {
        errors.push(config.required_cashierid);
    }
    else if (data.CashierID == 0)
    {
        errors.push(config.required_cashierid);
    }



//
//    if (! data.Notes ) {
//
//        errors.push(config.required_notes);
//
//    }
	
    return errors;
};

function cashiervalidation(){



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

     inc = +CustomerRefund + +CashDeposit + +CashierOpeningBalance + +SupplierRefund + +CustomRefund + +BankCashierTransfer + +cashiertransfer2;
     console.log("زيادة  :"+inc);
     dec =  +cashierbanktransfer + +cashiertransfer + +CashPayments + +expenses + +custompayment;
     console.log("نقصان  :"+dec);
    total = inc - dec;
      console.log("Total"+total);
        
               document.getElementById("validation").innerHTML="قيمة "+CashierName+" :"+total +" جـــ";
                 // $("#validation").append(obj[i].CashDeposit);
   
       }



        }).error(function (data){
        showError('',data);
        }); 
}
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

//function getExpensesTypeName(ExpenseTypeID)
//    {
//        var cboExpensesTypeID = $( "#cboExpenseTypeID" ).clone();
//        $(cboExpensesTypeID).val(ExpenseTypeID);
//
//        return $('option:selected',cboExpensesTypeID).text(); 
//    }
	
$(document).ready(function(){
$("#expense-form #cboExpenseGroupID").change(function(){
	

//    
	x=$(this).val();
//	console.log(x);
	  $.ajax({
            url: "loadExpensesTypeScreen",
            type: "post",
            data: $(this).val($(this).val()),
            dataType: "json"
        }).done(function (output) {

		  
		  var obj = eval (output);
//          console.log(obj);
		  	$('#expense-form #cboExpenseTypeID').empty();
		  for (var i = 0; i < obj.length; i++){
		  	var newOption = $('<option value='+obj[i].ExpenseTypeID+'>'+ obj[i].ExpenseTypeName+'</option>');
//			  console.log(newOption);
		  	$('#expense-form #cboExpenseTypeID').append(newOption);
		  	$('#expense-form #cboExpenseTypeID').trigger("chosen:updated");
		  }
            
       }).error(function(data) {
        showError('',data);
        }); 
	
});
});
	
//
//					$("#expense-form #cboExpenseGroupID_28_chosen").change(function(){
//  
//								
//				
//						//    
//							x=$(this).val();
//						//	console.log(x);
//							  $.ajax({
//									url: "loadExpensesTypeScreen",
//									type: "post",
//									data: $(this).val($(this).val()),
//									dataType: "json"
//								}).done(function (output) {
//						
//								  var obj = eval (output);
//						        console.log(obj);
//								 
////
//								  
//									$('#cboExpenseTypeID_28_chosen').empty();
//								  for (var i = 0; i < obj.length; i++){
////									  
//	       var newOption = $('<option value='+obj[i].ExpenseTypeID+'>'+obj[i].ExpenseTypeName+'</option>');
//						//			  console.log(newOption);
//									$('#cboExpenseTypeID_28_chosen').append(newOption);
//									$('#cboExpenseTypeID_28_chosen').trigger("chosen:updated");
//								  }
//								   
//
//							   }).error(function(data) {
//								showError('',data);
//								}); 
//
//						});
//						});

expenses.prototype.postexpense = function(){


    var errors = this.Validate($('#expense-form :input').serializeArray());

    msg_text = '';
    if (errors.length > 0 ){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "expenses" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#expense-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
			 
//			 console.log(output);
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    expenses.prototype.addnewrow(output.id);
					 $('#expense-form [name=TransDate]', $('.box-success')).val('').focus();
                    $('#expense-form [name=Mount]', $('.box-success')).val('').focus();
					 $('#expense-form #cboExpenseGroupID', $('.box-success')).val(0);
                    $('#expense-form #cboExpenseGroupID', $('.box-success')).trigger("chosen:updated");
                    $('#expense-form #cboExpenseTypeID', $('.box-success')).val(0);
                    $('#expense-form #cboExpenseTypeID', $('.box-success')).trigger("chosen:updated");
					$('#expense-form #cboCashierID', $('.box-success')).val(0);
                    $('#expense-form #cboCashierID', $('.box-success')).trigger("chosen:updated");
                    $('#expense-form [name=Notes]', $('.box-success')).val('').focus();
					$(".datepicker").datepicker('setDate', new Date());
                  
                }
            })
            .error(function (data) {
//			console.log(data);
                showError('',config.con_error);
            });
    }
}
/*expense-form
*  Add New row in datatable
* @param id is Bank Id to assign in delete and Update (edit)
* */
expenses.prototype.addnewrow = function(id){
	

    var t = $('#tbl-Expenses').DataTable();

    text = '<tr><td></td>' +
                '<td>' + $('[name=TransDate]').val() +  '</td>' + 
                '<td>' + $('[name=Mount]').val() +  '</td>' + 
                '<td data-val="' + $('#cboExpenseGroupID').val() + '"> ' + getExpensesGroup($('#expense-form #cboExpenseGroupID').val()) +  '</td>' +  				
		'<td data-val="' + $('#cboExpenseTypeID').val() + '"> '+getExpenseTypeName($('#expense-form #cboExpenseTypeID').val()) +  '</td>' + 	'<td data-val="' + $('#cboCashierID').val() + '"> '+getCashirName($('#expense-form #cboCashierID').val()) +  '</td>' + 
		
                '<td>' + $('[name=Notes]').val() +  '</td>' + 
                '<td>'
                    +'<button name="EditExpense_' + id + '" class="btn btn-flat btn-info btn-sm EditExpense">تعديل</button>'
                    + ' '
                    +'<button name="DelExpense_' + id + '" class="btn btn-flat btn-danger btn-sm RmvExpense">حذف</button>'+
                '</td>' +
            '</tr>'

    var index =  t.row.add( $(text) ).draw();

}
/*
* Delete Bank ID By Bank Id
* @param Bank ID gets from Spliting On click
* */
expenses.prototype.DeleteExpense = function(TransID){
    $.ajax({
        url: "expenses/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            expenses.prototype.deleterow(TransID,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
expenses.prototype.EditExpense = function(row ,TransID ){

	 function laodTransID(cboExpensesGroupID , td)
					{
						
//						optionName="";

					 
//	 console.log(td);
	td = $(td).next('td') ; 
// 	var cboExpenseTypeID = $(td).next('td')[0]);
	var cboExpenseTypeID = $( "#cboExpenseTypeID" ).clone();
				  $(cboExpenseTypeID).attr('id', 'cboExpenseTypeID_' + TransID);
//					console.log($( "#cboExpenseTypeID .chosen-select").val());
					   
	x=$(cboExpensesGroupID).val();
//	console.log(x);
	  $.ajax({
            url: "loadExpensesTypeScreen",
            type: "post",
            data: $(cboExpensesGroupID).val($(cboExpensesGroupID).val()),
            dataType: "json"
        }).done(function (output) {
//		  var expensesName =$(cboExpensesGroupID).val($(cboExpensesGroupID).val());
//		  console.log(output);
		   
		  var obj = eval (output);
//          console.log(obj);
		 
		  	$(cboExpenseTypeID).empty();
		  
		  for (var i = 0; i < obj.length; i++){
			  
			   eName =obj[i].ExpenseTypeName;
			  
//			  var cboExpenseTypeID = $( "#cboExpenseTypeID" ).clone();
//			  console.log(cboExpenseTypeID);
//			     $(cboExpenseTypeID).val(eName);
//			  console.log($(cboExpenseTypeID).val(eName));
//			   var text= $('option:selected',cboExpenseTypeID).text();
//			  	console.log(text);
//		    console.log(eName);
			  
		  	var newOption = $('<option value='+obj[i].ExpenseTypeID+'>'+ obj[i].ExpenseTypeName+'</option>');
//			  console.log(newOption);
		  	$(cboExpenseTypeID).append(newOption);
		  	$(cboExpenseTypeID).trigger("chosen:updated");
		  }
		  
		  $(td).html('');
		  $(cboExpenseTypeID).appendTo(td);
		  
		  $(cboExpenseTypeID).chosen().change( function(){
											 
		  });
		  
            
       }).error(function(data) {
        showError('',data);
        }); 
					 
}
					 
					 
					

            row.find('td').each (function(key) {

            var cntl = $(this).closest('tr').find('td').eq(key);

            switch (key){
                case 1 :

                    cntl.html('<input name="TransDate" id="" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control datepicker" />');

                     $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        });

                    break;
                case 2 :

                	cntl.html('<input name="Mount" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control only_float" />');

                    break;
                case 3 :
                    // console.log(cntl.attr('data-val'));
                    // console.log(cntl);
					
					
                    var cboExpensesGroupID = $( "#cboExpenseGroupID" ).clone();
					


                    $(cboExpensesGroupID).attr('id', 'cboExpenseGroupID_' + TransID);
					 $(cboExpensesGroupID).change(function(){
//						 alert("aaaaaaaaa");
					  laodTransID($(this) , $(this).parent());
						 
					

					 
					 });
				    $(cboExpensesGroupID).val(cntl.attr('data-val'));
				     cntl.html('');
                    $(cboExpensesGroupID).appendTo(cntl);

					
					laodTransID($(cboExpensesGroupID) , cntl[0]);
				
                    break; 

				case 5 :
                    // console.log(cntl.attr('data-val'));
                    // console.log(cntl);
                    var cboCashierID = $( "#cboCashierID" ).clone();

                    $(cboCashierID).attr('id', 'cboCashierID_' + TransID);
                    $(cboCashierID).val(cntl.attr('data-val'));
                    cntl.html('');
                    $(cboCashierID).appendTo(cntl);

                    break;
                case 6 :

                    cntl.html('<input name="Notes" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');


                    break;
                case 7 :

                    cntl.html(
                         '<button name="UpdateExpense_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdateExpense">حفظ</button>'
                        + ' '
                        +'<button name="CancelEdit_' + TransID + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }


    });

    reloadcbo();


}
/*
* Updateing Bank
* */
expenses.prototype.UpdateExpense = function(TransID ,data){
   

    $.ajax({
        url: "expenses/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
//		console.log(output)
            var temp = null ;
            if (output.status){
				
//				     $(document).ready(function(){
//					 		
						 	var x=$( "#cboExpenseTypeID_"+TransID +".chosen-single .cbo_events").text();
                          
				
//					var ID=cboExpenseTypeID.trigger("chosen:seleceted").val();
////						id="cboExpenseTypeID_30"
						      console.log(x);  
//				
				
//								$(cboExpenseTypeID).val(ID);

								var data= $('option:selected',cboExpenseTypeID).text() ; 
							// alert(data);
				
                crow['row'].html(
                '<td></td>' +
                '<td> ' + output.data.TransDate +  ' </td>' + 
                '<td> ' + output.data.Mount +  ' </td>' + 
                '<td data-val="' + output.data.ExpensesGroupID + '"> ' + getExpensesGroup(output.data.ExpensesGroupID) +  ' </td>' + 
                '<td data-val="' + output.data.cboExpenseTypeID + '"> ' +eName+  ' </td>' + 
				'<td data-val="' + output.data.CashierID + '"> ' + getCashirName(output.data.CashierID) +  ' </td>' + 	
                '<td> ' + output.data.Notes +  ' </td>' + 
                '<td>'
                    +'<button name="EditExpense_' + TransID + '" class="btn btn-flat btn-info btn-sm EditExpense">تعديل</button>'
                    + ' '
                    +'<button name="DelExpense_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvExpense">حذف</button>'+
                '</td>'
                );
                showSuccess('',output.message)
            }else{
                temp = '';
                temp = convert_array_string(output.message)

                showError('',temp);
            }
        })
        .error(function (data) {
            showError('',config.con_error);
        });

}

/*
* Delete Current Row ANd Hide then remove
* @param id Bank ID
* @param output response from server
* */
expenses.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-Expenses').DataTable();
    var index =  t.row(crow.row).remove().draw();

}



$(function(){ _expense = new expenses(); });

$(document).ready(function() {


    crow = {};
    $("#tbl-Expenses").dataTable();

    $('#add-Expense').click(function(){
        _expense.postexpense();
           $("#add-Expense").prop("disabled",true);

    });

    $('body').on('click','#tbl-Expenses .RmvExpense' , function(){

        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
//                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _expense.DeleteExpense(name[1]);
            }

        })
            


    });

    $('body').on('click','#tbl-Expenses .EditExpense' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _expense.EditExpense(row ,name[1]);

    });
    /*
    * Cancel Editable row
    * and back to default status
    * */
    $('body').on('click','#tbl-Expenses .CancelEdit' , function()
    {
        var name = this.name ;
        name = name.split('_');

        $(this).closest('tr').html(crow['tr_' + name[1] ].html());
    })
    /*
    * update spicifc expenses
    * */
    $('body').on('click','#tbl-Expenses .UpdateExpense' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _expense.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _expense.UpdateExpense(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })


    $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        });
//        $( ".datepicker" ).datepicker("setDate", new Date());
    
});
         function getExpensesGroup(ExpenseGroupID)
    {
        var cboExpensesGroupID = $( "#cboExpenseGroupID" ).clone();
        $(cboExpensesGroupID).val(ExpenseGroupID);

       return $('option:selected',cboExpensesGroupID).text() ; //$( "#cboExpensesTypesID option:selected" ).text();

    }
   
	function getExpensesTypeName(ExpenseTypeID)
    {
        var cboExpensesTypeID = $( "#cboExpenseTypeID" ).clone();
        $(cboExpensesTypeID).val(ExpenseTypeID);

        return $('option:selected',cboExpensesTypeID).text(); 
    }





    function getExpenseTypeName(ExpenseTypeID)
    {
        var cboExpenseTypeID = $( "#expense-form #cboExpenseTypeID" ).clone();
        $(cboExpenseTypeID).val(ExpenseTypeID);

        return $('option:selected',cboExpenseTypeID).text() ; 
    }   
function getCashirName(CashierID)
    {
        var cboCashierID = $( "#expense-form #cboCashierID" ).clone();
        $(cboCashierID).val(CashierID);

        return $('option:selected',cboCashierID).text() ; 
    }


    function strFormatDate (_Date){
        var d = new Date(_Date);
        var curr_date = d.getDate();
        var curr_month = d.getMonth() + 1;
        var curr_year = d.getFullYear(curr_year);
        return curr_date + "/" + curr_month + "/" + curr_year;
    };


$(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-Expense").prop("disabled",false);
});
});

