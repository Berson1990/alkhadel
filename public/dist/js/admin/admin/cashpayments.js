//Define Banks Class
var cashpayment = function () {};

/*
* Validate after Add new Bank
* check Bank Name is required
* check Bank Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */

$(function(){ _cashpayment = new cashpayment(); });


cashpayment.prototype.CheckTotal = function(){

var totals=[0,0,0];
       
            var $dataRows=$("#tbl-CashPayments tr");

            $dataRows.each(function() {
                $(this).find('.sum').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
                });
            });
            $("#tbl-CashPayments th.total").each(function(i){  
                $('.total').html("اجمالى المبلغ :"+totals[i]);
            });

       

    
    
}
    cashpayment.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];

    if (! data.TransDate ) {
        errors.push(config3.required_transdate);
    }

    if (! data.SupplierID ) {
        errors.push(config3.required_supplierid);
    }
    else if (data.SupplierID == 0)
    {
        errors.push(config3.required_supplierid);
    }


 
     if (data.CashierID == 0 )
    {
        errors.push("ادخل بيانات الخزنة ");
    }

        
        
    if (! data.Mount ) {

        errors.push(config3.required_mount);
    }

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

$(document).ready(function() {
$("#cashpayment-form  #cboSupplierID").select2({
  placeholder: " ",
	  ajax: {   url: 'supplierautocomplete',
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
		$("#cashpayment-form  #cboCashierID").select2({
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

cashpayment.prototype.postcashpayment = function(){


    var errors = this.Validate($('#cashpayment-form :input').serializeArray());

    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "cashpayment" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#cashpayment-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{
                    
                    msg_text = output.message;
                    showSuccess('',msg_text);

                    cashpayment.prototype.addnewrow(output.id);
                    $('#cashpayment-form [name=Mount]', $('.box-success')).val('');
                    $('#cashpayment-form #cboSupplierID', $('.box-success')).val(0);
                    $('#cashpayment-form #cboSupplierID', $('.box-success')).trigger("chosen:updated");
                    $('#cashpayment-form #cboCashierID', $('.box-success')).val(0);
                    $('#cashpayment-form #cboCashierID', $('.box-success')).trigger("chosen:updated");
                    $('#cashpayment-form [name=Notes]', $('.box-success')).val('')
                    $('#cashpayment-form [name=TransDate]', $('.box-success')).val('').focus();
					$(".datepicker").datepicker('setDate', new Date());
                }
            
            })
            .error(function (data) {
                showError('',config3.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is Bank Id to assign in delete and Update (edit)
* */
cashpayment.prototype.addnewrow = function(id){

    var t = $('#tbl-CashPayments').DataTable();


    var cboSupplierID = $( "#cashpayment-form #cboSupplierID" ).clone();
var cboCashierID = $( "#cashpayment-form #cboCashierID" ).clone();
// var cboBankID = $( "#cashpayment-form #cboBankID" ).clone();

    text = '<tr><td></td>' +
                '<td>' + $('#cashpayment-form [name=TransDate]').val() +  '</td>' + 
                '<td data-val="' + $('#cashpayment-form #cboSupplierID').val() + '"> ' + cboSupplierID.text()+  '</td>' +
                '<td class="sum">' + $('#cashpayment-form [name=Mount]').val() +  '</td>' + 
                '<td data-val="' + $('#cashpayment-form #cboCashierID').val() + '"> ' + cboCashierID.text()+  '</td>' +
                '<td>' + $('#cashpayment-form [name=Notes]').val() +  '</td>' + 
                '<td>'
                    +'<button name="EditCashPayment_' + id + '" class="btn btn-flat btn-info btn-sm EditCashPayment">تعديل</button>'
                    + ' '
                    +'<button name="DelCashPayment_' + id + '" class="btn btn-flat btn-danger btn-sm RmvCashPayment">حذف</button>'+
                '</td>' +
            '</tr>'

    var index =  t.row.add( $(text) ).draw();

            _cashpayment.CheckTotal();
}
/*
* Delete Bank ID By Bank Id
* @param Bank ID gets from Spliting On click
* */
cashpayment.prototype.DeleteCashPayment = function(TransID){
    $.ajax({
        url: "cashpayment/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            cashpayment.prototype.deleterow(TransID,output);
             _cashpayment.CheckTotal();
        })
        .error(function (data) {
            showError('',config3.con_error);
        });
}

/*
* Show edit row
* */
cashpayment.prototype.EditCashPayment = function(row ,TransID ){


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
                    cntl.html('<select name="SupplierID" style="width:100%" data-placeholder="' + cntl.text() + '"  id="cboSupplierIDedit" ></select>');
                        $(document).ready(function() {
$("#cboSupplierIDedit").select2({
  placeholder: " ",
      ajax: {   url:'supplierautocomplete',
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
});});

                    break;
                case 3 :

                    cntl.html('<input name="Mount" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control only_float" />');

                    break;
                case 4 :
                    cntl.html('<select name="CashierID" style="width:100%" data-placeholder="' + cntl.text() + '" id="cboCashierIDedit" ></select>');
                    $(document).ready(function() {

                        $("#cboCashierIDedit").select2({
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
                         '<button name="UpdateCashPayment_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdateCashPayment">حفظ</button>'
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
cashpayment.prototype.UpdateCashPayment = function(TransID ,data){

console.log(data)
    $.ajax({
        url: "cashpayment/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
            var temp = null ;
            if (output.status){

                var cboSupplierID = $( "#cboSupplierIDedit" ).clone();
                var cboCashierID = $( "#cboCashierIDedit" ).clone();
                // var cboBankID = $( "#cboBankIDedit" ).clone();

                crow['row'].html(
                '<td></td>' +
                '<td> ' + output.data.TransDate +  ' </td>' + 
                '<td data-val="' + output.data.SupplierID + '"> ' + cboSupplierID.text() +  ' </td>' +
                '<td class="sum"> ' + output.data.Mount +  ' </td>' + 
                '<td data-val="' + output.data.CashierID + '"> ' + cboCashierID.text() +  ' </td>' + 
                '<td> ' + output.data.Notes +  ' </td>' + 
                '<td>'
                    +'<button name="EditCashPayment_' + TransID + '" class="btn btn-flat btn-info btn-sm EditCashPayment">تعديل</button>'
                    + ' '
                    +'<button name="DelCashPayment_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvCashPayment">حذف</button>'+
                '</td>'
                );
                showSuccess('',output.message)
            
            _cashpayment.CheckTotal();
            }else{
                temp = '';
                temp = convert_array_string(output.message)

                showError('',temp);
            }
        })
        .error(function (data) {
            showError('',config3.con_error);
        });

}

/*
* Delete Current Row ANd Hide then remove
* @param id Bank ID
* @param output response from server
* */
cashpayment.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-CashPayments').DataTable();

    var index =  t.row(crow.row).remove().draw();

}





$(document).ready(function() {

   $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        });


    crow = {};

   // $("#tbl-CashPayments").dataTable();

    $('#add-CashPayment').click(function(){
        _cashpayment.postcashpayment();
         $("#add-CashPayment").prop("disabled",true);

    });

    $('body').on('click','.RmvCashPayment' , function(){

        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _cashpayment.DeleteCashPayment(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditCashPayment' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _cashpayment.EditCashPayment(row ,name[1]);
        
        
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
    * update spicifc cashpayment
    * */
    $('body').on('click','.UpdateCashPayment' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _cashpayment.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _cashpayment.UpdateCashPayment(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
            
        }
    })


         //$( ".datepicker" ).datepicker("setDate", new Date());
    
});



    function getSupplierName(SupplierID)
    {
        var cboSupplierID = $( "#cboSupplierID" ).clone();
        $(cboSupplierID).val(SupplierID);

        return $('option:selected',cboSupplierID).text() ; 
    }

    function getCashierName(CashierID)
    {
        var cboCashierID = $( "#cboCashierID" ).clone();
        $(cboCashierID).val(CashierID);

        return $('option:selected',cboCashierID).text() ; 
    }

    // function getBankName(BankID)
    // {
    //     var cboBankID = $( "#cboBankID" ).clone();
    //     $(cboBankID).val(BankID);

    //     return $('option:selected',cboBankID).text() ; 
    // }

    function strFormatDate (_Date){
        var d = new Date(_Date);
        var curr_date = d.getDate();
        var curr_month = d.getMonth() + 1;
        var curr_year = d.getFullYear(curr_year);
        return curr_date + "/" + curr_month + "/" + curr_year;
    };
//-------------------------------------------------------------------------

var totals=[0,0,0];
        $(document).ready(function(){
            var $dataRows=$("#tbl-CashPayments tr");

            $dataRows.each(function() {
                $(this).find('.sum1').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
                });
            });
            $("#tbl-CashPayments th.total").each(function(i){  
                $(this).html("اجمالى المبلغ :"+totals[i]);
            });

        });
//-------------------------------------------------------------------------

 $(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-CashPayment").prop("disabled",false);
});
});