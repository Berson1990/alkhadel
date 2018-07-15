//Define Banks Class
var customrefund = function () {};

/*
* Validate after Add new Bank
* check Bank Name is required
* check Bank Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
customrefund.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];
    if (! data.RefundDate ) {

        errors.push(config5.required_refunddate);

    }
    if (! data.Refund ) {

        errors.push(config5.required_refund);

    }
      if (! data.CashierID ) {

        errors.push(config5.required_cashierid);

    }

    if (! data.CustomID ) {
        errors.push(config5.required_customid);
    }
    else if (data.CustomID == 0)
    {
        errors.push(config5.required_customid);
    }



//    if (! data.Notes ) {
//
//        errors.push(config5.required_notes);
//
//    }
    return errors;
};

/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

$(document).ready(function(){
    // alert("7777777777777777");  
    $("#cboCustomRefundID").select2({   

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

$("#customrefund-form  #cboCashierID").select2({
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








customrefund.prototype.postcustomrefund = function(){

	// console.log('###');
	console.log($('#customrefund-form :input').serializeArray());
    var errors = this.Validate($('#customrefund-form :input').serializeArray());

    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{
//             document.write("daslkdjakldj");
//            stop();
        $.ajax({
            url: "customrefund" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#customrefund-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    customrefund.prototype.addnewrow(output.id);
                    $('#customrefund-form [name=Refund]', $('.box-success')).val('').focus();
                    $('#customrefund-form cboCustomRefundID', $('.box-success')).val(0);
                    $('#customrefund-form cboCustomRefundID', $('.box-success')).trigger("chosen:updated");
                    $('#customrefund-form [name=Notes]', $('.box-success')).val('').focus();
                    $('#customrefund-form #cboCashierID', $('.box-success')).val(0);
                    $('#customrefund-form #cboCashierID', $('.box-success')).trigger("chosen:updated");
                    $('#customrefund-form [name=RefundDate]', $('.box-success')).val('').focus();
					$(".datepicker").datepicker('setDate', new Date());
                }
            })
            .error(function (data) {
           
                showError('',config5.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is Bank Id to assign in delete and Update (edit)
* */
customrefund.prototype.addnewrow = function(id){

    var t = $('#tbl-CustomRefund').DataTable();
    
    var cboCustomerID = $( "#customrefund-form #cboCustomRefundID" ).clone();

        $(cboCustomerID).val("#customrefund-form #cboCustomRefundID");
        
       

    text = '<tr><td></td>' +
                '<td>' + $('#customrefund-form [name=RefundDate]').val() +  '</td>' + 
                '<td>' + $('#customrefund-form [name=Refund]').val() +  '</td>' + 
                '<td data-val="' + $('#customrefund-form #cboCustomRefundID').val() + '"> ' + cboCustomerID.text() +  '</td>' + 
               '<td data-val="' + $('#customrefund-form #cboCashierID').val() + '"> ' + getCashierName($('#customrefund-form #cboCashierID').val()) +  '</td>' + 
                '<td>' + $('#customrefund-form [name=Notes]').val() +  '</td>' + 
                '<td>'
                    +'<button name="EditCustomRefund_' + id + '" class="btn btn-flat btn-info btn-sm EditCustomRefund">تعديل</button>'
                    + ' '
                    +'<button name="DelCustomRefund_' + id + '" class="btn btn-flat btn-danger btn-sm RmvCustomRefund">حذف</button>'+
                '</td>' +
            '</tr>'

    var index =  t.row.add( $(text) ).draw();

}
/*
* Delete Bank ID By Bank Id
* @param Bank ID gets from Spliting On click
* */
customrefund.prototype.Deletecustomrefund = function(RefundID){
    $.ajax({
        url: "customrefund/" + RefundID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            customrefund.prototype.deleterow(RefundID,output);
        })
        .error(function (data) {
            showError('',config5.con_error);
        });
}

/*
* Show edit row
* */
customrefund.prototype.Editcustomrefund = function(row ,RefundID ){


            row.find('td').each (function(key) {

            var cntl = $(this).closest('tr').find('td').eq(key);

            switch (key){
                case 1 :

                    cntl.html('<input name="RefundDate" id="" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control datepicker" />');

                     $( ".datepicker" ).datepicker({
                        dateFormat: 'yy/mm/dd',
                        currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
                    });

                    break;
                case 2 :

                	cntl.html('<input name="Refund" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control only_float" />');

                    break;
                case 3 :
                  
                    cntl.html('<select name="CustomID" style="width:100%" data-placeholder="' + cntl.text() + '" id="cboCustomRefundIDedit1" > </select>');

                    $(document).ready(function(){
            $("#cboCustomRefundIDedit1").select2({
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

                    break;
                    case 4 :

cntl.html( '<select name="CashierID" style="width:100%" data-placeholder="'+ cntl.text() + ' " id="cboCashierIDedit9" > </select>' );

                $(document).ready(function(){

    $("#cboCashierIDedit9").select2({
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
                    

                    break;


                case 5 :

                    cntl.html('<input name="Notes" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');


                    break;
                case 6 :

                    cntl.html(
                         '<button name="UpdateCustomRefund_' + RefundID + '" class="btn btn-flat btn-success btn-sm UpdateCustomRefund">حفظ</button>'
                        + ' '
                        +'<button name="CancelEdit_' + RefundID + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }


    });

    // reloadcbo();


}
/*
* Updateing Bank
* */
customrefund.prototype.Updatecustomrefund = function(RefundID ,data){

console.log(data)
    $.ajax({
        url: "customrefund/" + RefundID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
            var temp = null ;
            if (output.status){
                var cboCustomerID = $( "#cboCustomRefundIDedit1" ).clone();
                 var cboCashierID = $( "#cboCashierIDedit9" ).clone();

                crow['row'].html(
                '<td></td>' +
                '<td> ' + output.data.RefundDate +  ' </td>' + 
                '<td> ' + output.data.Refund +  ' </td>' + 
                '<td data-val="' + output.data.CustomID + '"> ' + cboCustomerID.text()+  ' </td>' + 
                 '<td data-val="' + output.data.CashierID + '"> ' + cboCashierID.text() +  ' </td>' + 
             
                '<td> ' + output.data.Notes +  ' </td>' + 
                '<td>'
                    +'<button name="EditCustomrefund_' + RefundID + '" class="btn btn-flat btn-info btn-sm EditCustomrefund">تعديل</button>'
                    + ' '
                    +'<button name="DelCustomrefund_' + RefundID + '" class="btn btn-flat btn-danger btn-sm RmvCustomrefund">حذف</button>'+
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
            showError('',config5.con_error);
        });

}

/*
* Delete Current Row ANd Hide then remove
* @param id Bank ID
* @param output response from server
* */
customrefund.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-CustomRefund').DataTable();
    var index =  t.row(crow.row).remove().draw();

}



$(function(){ _customrefund = new customrefund(); });

$(document).ready(function() {


    crow = {};
  $("#tbl-CustomRefund").DataTable();

    $('#add-CustomRefund').click(function(){
        // alert("7777777777777777");
        $(this).prop("disabled",true);
        _customrefund.postcustomrefund();

    });

    $('body').on('click','.RmvCustomRefund' , function(){
// alert("111");
        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _customrefund.Deletecustomrefund(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditCustomRefund' , function(){
        // alert("111");
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _customrefund.Editcustomrefund(row ,name[1]);

    });
    /*
    * Cancel Editable row
    * and back to default status
    * */
    $('body').on('click','.CancelEdit' , function()
    {
        // alert("111");
        var name = this.name ;
        name = name.split('_');

        $(this).closest('tr').html(crow['tr_' + name[1] ].html());
    })
    /*
    * update spicifc customrefund
    * */
    $('body').on('click','.UpdateCustomRefund' , function()
    {
        // alert("111");
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _customrefund.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _customrefund.Updatecustomrefund(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })


    $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        });
        //$( ".datepicker" ).datepicker("setDate", new Date());
    
});



    function getCustomerName(CustomerID)
    {
        var cboCustomerID = $( "#customrefund-form cboCustomRefundID" ).clone();
        $(cboCustomerID).val(CustomerID);

        return $('option:selected',cboCustomerID).text() ; 
    }

    function getCashierName(CashierID)
    {
        var cboCashierID = $( "#customrefund-form #cboCashierID" ).clone();
        
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


//  $(document).ready(function() { 
// $(':input').keypress(function () { 
//   // alert("ayyy")
//      $("#add-customrefund").prop("disabled",false);
// });
// });