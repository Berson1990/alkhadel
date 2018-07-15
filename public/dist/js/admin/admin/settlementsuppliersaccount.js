//Define Banks Class
var settlementsuppliersaccount = function () {};

/*
* Validate after Add new Bank
* check Bank Name is required
* check Bank Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
var x=0;
var deptText=0;


settlementsuppliersaccount.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);
			console.log(frm);
    });

    var errors = [];
    if (! data.TransDate ) {

        errors.push(config7.required_transdate);

    }
    if (! data.Mount ) {

        errors.push(config7.required_mount);

    }

    if (! data.Dept ) {
        console.log(data);
        errors.push(config7.required_debt);

    }

    if (! data.SupplierID ) {
        errors.push(config7.required_supplierid);
    }
    else if (data.SupplierID == 0)
    {
        errors.push(config7.required_supplierid);
		
    }  
	
	if (! data.CashierID ) {
		
        errors.push(config7.required_cashierid);
    }
    else if (data.CashierID == 0)
    {
        errors.push(config7.required_cashierid);
    }


//
//    if (! data.Notes ) {
//
//        errors.push(config7.required_notes);
//
//    }
    return errors;
};


function cashiervalidation4(){



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
        
               document.getElementById("validation4").innerHTML="قيمة "+CashierName+" :"+total +" جـــ";
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

var b=0;
// load data

 $(document).ready(function() {
var t = $('#tbl-SettlementSuppliersAccount').DataTable();

});
 $(document).ready(function() {


$("#settlementsuppliersaccount-form #cboSupplierID").select2({
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
	 
//cashier ID 	 
	 
	$("#settlementsuppliersaccount-form  #cboCashierID").select2({
            placeholder: "Search for an cashier Name",
            ajax: {
                url: 'cachierautocomplete',
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

settlementsuppliersaccount.prototype.postsettlementsuppliersaccount = function(){


    var errors = this.Validate($('#settlementsuppliersaccount-form :input').serializeArray());

     x=$('#settlementsuppliersaccount-form :input');
	    console.log(x); 
             console.log(x[4].checked);//maden
             console.log(x[5].checked);//da2en


             if(x[4].checked==true){deptText="له";}
             else{deptText="عليه";}


           
	console.log(deptText);
	
    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{
//            console.log($('#settlementsuppliersaccount-form :input'));
        $.ajax({
            url: "settlementsuppliersaccount" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#settlementsuppliersaccount-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
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

                    settlementsuppliersaccount.prototype.addnewrow(output.id);
$('#settlementsuppliersaccount-form [name=Mount]', $('.box-success')).val('').focus(); $('#settlementsuppliersaccount-form #cboSupplierID', $('.box-success')).val(0);
$('#settlementsuppliersaccount-form #cboSupplierID', $('.box-success')).trigger("chosen:updated");  $('#settlementsuppliersaccount-form #cboCashierID', $('.box-success')).val(0);
$('#settlementsuppliersaccount-form #cboCashierID', $('.box-success')).trigger("chosen:updated");
$('#settlementsuppliersaccount-form [name=Notes]', $('.box-success')).val('').focus();
//$('#settlementsuppliersaccount-form [name=Debt]', $('.box-success')).val('').focus();
$('#settlementsuppliersaccount-form [name=TransDate]', $('.box-success')).val('').focus(); $(".datepicker").datepicker('setDate', new Date());
                }
            })
            .error(function (data) {
                showError('',config7.con_error);
            });
    }
}

settlementsuppliersaccount.prototype.addnewrow = function(id){
  
var t = $('#tbl-SettlementSuppliersAccount').DataTable();

        var cboSupplierID = $( "#settlementsuppliersaccount-form #cboSupplierID" ).clone();
//	  console.log(cboSupplierID);
	
	  console.log(cboSupplierID.text());
        var cboCashierID = $( "#settlementsuppliersaccount-form #cboCashierID" ).clone();

        // $('[name=Debt]').val();

    text = '<tr><td></td>' +
                '<td>' + $('#settlementsuppliersaccount-form [name=TransDate]').val() +  '</td>' + 
                '<td>' + $('#settlementsuppliersaccount-form [name=Mount]').val() +  '</td>' + 
                '<td data-val="' + $('#settlementsuppliersaccount-form #cboSupplierID').val() + '"> ' + cboSupplierID.text() +  '</td>' +
		
		'<td data-val="' + $('#settlementsuppliersaccount-form #cboCashierID').val() + '"> ' + cboCashierID.text() +  '</td>' + 
                '<td>' + $('#settlementsuppliersaccount-form [name=Notes]').val() +  '</td>' + 
                '<td>' + deptText +'</td>' + 
                '<td>'
                    +'<button name="EditSupplierِAccount_' + id + '" class="btn btn-flat btn-info btn-sm EditSupplierِAccount">تعديل</button>'
                    + ' '
                    +'<button name="DelSupplierِAccount_' + id + '" class="btn btn-flat btn-danger btn-sm RmvSupplierِAccount">حذف</button>'+
                '</td>' +
            '</tr>';

    var index =  t.row.add( $(text) ).draw();

}

settlementsuppliersaccount.prototype.DeleteSettlementSuppliersAccount = function(TransID){
    $.ajax({
        url: "settlementsuppliersaccount/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            settlementsuppliersaccount.prototype.deleterow(TransID,output);
        })
        .error(function (data) {
            showError('',config7.con_error);
        });
}

settlementsuppliersaccount.prototype.EditSettlementSuppliersAccount = function(row ,TransID ){


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
                    cntl.html('<select name="SupplierID" style="width:100%" data-placeholder="' + cntl.text() + '" id="cboSupplierIDedit" > </select>');
                    $(document).ready(function() {
$("#cboSupplierIDedit").select2({
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
});


                    break;            
				case 4 :
                    cntl.html('<select name="CashierID" style="width:100%" data-placeholder="' + cntl.text() + '" id="cboCashierIDedit" > </select>');
                    $(document).ready(function() {
$("#cboCashierIDedit").select2({
  placeholder: " ",
        ajax: {
                url: 'cachierautocomplete',
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


                    break;
                case 5 :

                    cntl.html('<input name="Notes" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');


                    break;
                case 6 :

                   
                   
                    cntl.html('<input class="radio-inline dept" id="Debit"  type="radio" name="Debt" data-title="له" value="1"  />'+'<label class="radio-inline" id="Debit_btn" >له</label>'+'</br> '+'<input class="radio-inline" id="Creditor"  type="radio" name="Debt" data-title="عليه" value="0"  />'+'  '+'<label class="radio-inline" id="Creditor_btn" >عليه</label>');

                    break;

                case 7 :

                    cntl.html(
                         '<button name="UpdateSupplierِAccount_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdateSupplierِAccount">حفظ</button>'
                        + ' '
                        +'<button name="CancelEdit_' + TransID + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }


    });

    reloadcbo();

}


// update


settlementsuppliersaccount.prototype.UpdateSettlementSuppliersAccount = function(TransID ,data){

console.log(data)
    $.ajax({
        url: "settlementsuppliersaccount/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
		 console.log(output);
            var temp = null ;

            if (output.status){
                console.log(output);
                var Debt=0;
				console.log(output.data.Debt);
                if(output.data.Debt==1){Debt="له";}
                else {Debt="عليه";}
				
                var cboSupplierID = $( "#cboSupplierIDedit" ).clone();
                var cboCashierID = $( "#cboCashierIDedit" ).clone();
				
                crow['row'].html(
                '<td></td>' +
                '<td> ' + output.data.TransDate +  ' </td>' + 
                '<td> ' + output.data.Mount +  ' </td>' + 
                '<td data-val="' + output.data.SupplierID + '"> ' +  cboSupplierID.text()+  ' </td>' + 
                '<td data-val="' + output.data.CashierID + '"> ' +  cboCashierID.text()+  ' </td>' + 
                '<td> ' + output.data.Notes +  ' </td>' + 
                '<td> ' + Debt +  ' </td>' + 
                '<td>'
                    +'<button name="EditSupplierِAccount_' + TransID + '" class="btn btn-flat btn-info btn-sm EditSupplierِAccount">تعديل</button>'
                    + ' '
                    +'<button name="DelSupplierِAccount_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvSupplierِAccount">حذف</button>'+
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
            showError('',config7.con_error);
        });

}




settlementsuppliersaccount.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-SettlementSuppliersAccount').DataTable();
    var index =  t.row(crow.row).remove().draw();

}






$(function(){ _settlementsuppliersaccount = new settlementsuppliersaccount(); });

$(document).ready(function() {


 $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        });

    crow = {};
    // $("#tbl-SupplierOpeningBalance").dataTable();

    $('#add-settlementsuppliersaccount').click(function(){
//         alert("aaaaaaaaaaaaa");
         $("#add-settlementsuppliersaccount").prop("disabled",true);
        _settlementsuppliersaccount.postsettlementsuppliersaccount();

    });

    $('body').on('click','.RmvSupplierِAccount' , function(){

        

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                 _settlementsuppliersaccount.DeleteSettlementSuppliersAccount(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditSupplierِAccount' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _settlementsuppliersaccount.EditSettlementSuppliersAccount(row ,name[1]);

    });
    /*
    * Cancel Editable row
    * and back to default status
    * */
    $('body').on('click','.CancelEdit' , function()
    {
        var name = this.name ;
        name = name.split('_');

        $(this).closest('tr').html(crow['tr_' + name[1] ].html());
    })
    /*
    * update spicifc supplieropeningbalance
    * */
	//Under Constraction
    $('body').on('click','.UpdateSupplierِAccount' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _settlementsuppliersaccount.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _settlementsuppliersaccount.UpdateSettlementSuppliersAccount(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })


   
        //$( ".datepicker" ).datepicker("setDate", new Date());
    
});



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
     $("#add-settlementsuppliersaccount").prop("disabled",false);
});
});