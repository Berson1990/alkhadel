//Define Banks Class
var checkpayment = function () {};

/*
* Validate after Add new Bank
* check Bank Name is required
* check Bank Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
checkpayment.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];
   
    if (! data.TransDate ) {
        errors.push(config4.required_transdate);
    }
    
    if (! data.Mount ) {

        errors.push(config3.required_mount);
    }


    if (! data.SupplierID ) {
        errors.push(config4.required_supplierid);
    }
    else if (data.SupplierID == 0)
    {
        errors.push(config4.required_supplierid);
    }

    if (! data.BankID ) {
        errors.push(config4.required_bankid);
    }
    else if (data.BankID == 0)
    {
        errors.push(config4.required_bankid);
    }

    if (! data.CheckNo ) {

        errors.push(config4.required_checkno);
    }

    if (! data.CheckDate ) {
        errors.push(config4.required_checkdate);
    }

//    if (! data.Notes ) {
//
//        errors.push(config4.required_notes);
//    }

    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

$(document).ready(function() {
$("#checkpayment-form  #cboSupplierID").select2({
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
	
	
	$("#checkpayment-form  #cboBankID").select2({
            placeholder: "Search for an cashier Name",
            ajax: {
                url: 'bankautocomplete',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                type : 'post',
                data: function (params) {
                    var queryParameters = {
                        BankName: params.term
                    }
                    return queryParameters;
                },
                processResults: function (output) {
                    if (output.status){
                        return {
                            results: $.map(output.data, function (item) {
                                return {
                                    text: item.BankName,
                                    id: item.BankID,
                                   bankAccount : item.AccountNumber
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

checkpayment.prototype.postcheckpayment = function(){


    var errors = this.Validate($('#checkpayment-form :input').serializeArray());

    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "checkpayment" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#checkpayment-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
            
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    checkpayment.prototype.addnewrow(output.id);
                    $('#checkpayment-form [name=Mount]', $('.box-success')).val('');
                    $('#checkpayment-form  [name=CheckNo]', $('.box-success')).val('');
                    $('#checkpayment-form  #cboSupplierID', $('.box-success')).val(0);
                    $('#checkpayment-form  #cboSupplierID', $('.box-success')).trigger("chosen:updated");
                    $('#checkpayment-form  #cboBankID', $('.box-success')).val(0);
                    $('#checkpayment-form  #cboBankID', $('.box-success')).trigger("chosen:updated");
                    $('#checkpayment-form  [name=Notes]', $('.box-success')).val('');
                    $('#checkpayment-form  [name=CheckDate]', $('.box-success')).val('');
                    $('#checkpayment-form  [name=TransDate]', $('.box-success')).val('').focus();
					$(".datepicker").datepicker('setDate', new Date());
                }
            })
            .error(function (data) {
                showError('',config4.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is Bank Id to assign in delete and Update (edit)
* */
checkpayment.prototype.addnewrow = function(id){

    var t = $('#tbl-CheckPayments').DataTable();

        var cboSupplierID = $( "#checkpayment-form #cboSupplierID" ).clone();
        var cboBankID = $( "#checkpayment-form #cboBankID" ).clone();

    text = '<tr><td></td>' +
                '<td>' + $('#checkpayment-form  [name=TransDate]').val() +  '</td>' + 
                '<td data-val="' + $('#checkpayment-form  #cboSupplierID').val() + '"> ' + cboSupplierID.text() +  '</td>' +
                '<td class="sum">' + $('#checkpayment-form [name=Mount]').val() +  '</td>' + 
                '<td data-val="' + $('#checkpayment-form  #cboBankID').val() + '"> ' + cboBankID.text() +  '</td>' + 
                '<td>' + $('#checkpayment-form  [name=CheckNo]').val() +  '</td>' + 
                '<td>' + $('#checkpayment-form  [name=CheckDate]').val() +  '</td>' + 
                '<td>' + $('#checkpayment-form  [name=Notes]').val() +  '</td>' + 
                '<td>'
                    +'<button name="EditCheckPayment_' + id + '" class="btn btn-flat btn-info btn-sm EditCheckPayment">تعديل</button>'
                    + ' '
                    +'<button name="DelCheckPayment_' + id + '" class="btn btn-flat btn-danger btn-sm RmvCheckPayment">حذف</button>'+
                '</td>' +
            '</tr>'
            
    console.log(text);
                

    var index =  t.row.add( $(text) ).draw();

}
/*
* Delete Bank ID By Bank Id
* @param Bank ID gets from Spliting On click
* */
checkpayment.prototype.DeleteCheckPayment = function(TransID){
    $.ajax({
        url: "checkpayment/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            checkpayment.prototype.deleterow(TransID,output);
        })
        .error(function (data) {
            showError('',config4.con_error);
        });
}

/*
* Show edit row
* */
checkpayment.prototype.EditCheckPayment = function(row ,TransID ){


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
                    cntl.html('<select name="SupplierID" style="width:100%" data-placeholder="' + cntl.text() + '" id="cboSupplierIDedit" > </select>');
                    
                        $(document).ready(function(){
                                $("#cboSupplierIDedit").select2({
  placeholder: " ",
      ajax: {
                url:'supplierautocomplete',
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
})


                        });
                    break;
                case 3 :
                   cntl.html('<input  name="Mount" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control only_float" />');

                    break;
                case 4 :
                     cntl.html('<select  name="BankID" style="width:100%" data-placeholder="' + cntl.text() + '" id="cboBankIDedit" > </select>');
                    
                     $(document).ready(function(){
                            $("#cboBankIDedit").select2({
            placeholder: "Search for an cashier Name",
            ajax: {
                url: 'bankautocomplete',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                type : 'post',
                data: function (params) {
                    var queryParameters = {
                        BankName: params.term
                    }
                    return queryParameters;
                },
                processResults: function (output) {
                    if (output.status){
                        return {
                            results: $.map(output.data, function (item) {
                                return {
                                    text: item.BankName,
                                    id: item.BankID,
                                   bankAccount : item.AccountNumber
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

                            
                        })
                    

                    break;
                case 5 :
                    cntl.html('<input  class="col-md-12"  name="CheckNo" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="" />');
                   

                    break;
                case 6 :
                     cntl.html('<input name="CheckDate" id="" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control datepicker" />');

                     $( ".datepicker" ).datepicker({
                        dateFormat: 'yy/mm/dd',
                        currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
                    });

                    break;
                case 7 :
                    cntl.html('<input   name="Notes" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    
                    break; 
                case 8 :
                    cntl.html(
                         '<button name="UpdateCheckPayment_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdateCheckPayment">حفظ</button>'
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
checkpayment.prototype.UpdateCheckPayment = function(TransID ,data){

console.log(data)
    $.ajax({
        url: "checkpayment/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
        console.log(output);
            var temp = null ;
            if (output.status){

                var cboSupplierID = $( "#cboSupplierIDedit" ).clone();
                var cboBankID = $( "#cboBankIDedit" ).clone();

                crow['row'].html(
                '<td></td>' +
                '<td>' + output.data.TransDate +  '</td>' + 
                '<td data-val="' + output.data.SupplierID + '"> ' +  cboSupplierID.text()+  ' </td>' +
                '<td class="sum"> ' + output.data.Mount +  ' </td>' +     
                '<td data-val="' + output.data.BankID + '"> ' + cboBankID.text() +  ' </td>' + 
                '<td>' + output.data.CheckNo + '</td>' + 
                '<td>' + output.data.CheckDate + '</td>' + 
                '<td>' + output.data.Notes +  ' </td>' + 
                '<td>'
                    +'<button name="EditCheckPayment_' + TransID + '" class="btn btn-flat btn-info btn-sm EditCheckPayment">تعديل</button>'
                    + ' '
                    +'<button name="DelCheckPayment_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvCheckPayment">حذف</button>'+
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
            showError('',config4.con_error);
        });

}

/*
* Delete Current Row ANd Hide then remove
* @param id Bank ID
* @param output response from server
* */
checkpayment.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-CheckPayments').DataTable();
    var index =  t.row(crow.row).remove().draw();

}



$(function(){ _checkpayment = new checkpayment(); });

$(document).ready(function() {


    crow = {};
    $("#tbl-CheckPayments").dataTable();

    $('#add-CheckPayment').click(function(){
        _checkpayment.postcheckpayment();
        $("#add-CheckPayment").prop("disabled",true);

    });

    $('body').on('click','.RmvCheckPayment' , function(){

        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _checkpayment.DeleteCheckPayment(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditCheckPayment' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _checkpayment.EditCheckPayment(row ,name[1]);

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
    * update spicifc checkpayment
    * */
    $('body').on('click','.UpdateCheckPayment' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _checkpayment.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _checkpayment.UpdateCheckPayment(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })


    $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        });
        //$( ".datepicker" ).datepicker("setDate", new Date());
    
});




    function getSupplierName(SupplierID)
    {
        var cboSupplierID = $( "#cboSupplierID" ).clone();
        $(cboSupplierID).val(SupplierID);

        return $('option:selected',cboSupplierID).text() ; 
    }

    function getBankName(BankID)
    {
        var cboBankID = $( "#cboBankID" ).clone();
        $(cboBankID).val(BankID);

        return $('option:selected',cboBankID).text() ; 
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
     $("#add-CheckPayment").prop("disabled",false);
});
});