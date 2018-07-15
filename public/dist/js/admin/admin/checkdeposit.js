//Define Banks Class
var checkdeposit = function () {};

/*
* Validate after Add new Bank
* check Bank Name is required
* check Bank Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
checkdeposit.prototype.Validate = function(frm){

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

        errors.push(config4.required_mount);
    }


    if (! data.CustomerID ) {
        errors.push(config4.required_customerid);
    }
    else if (data.CustomerID == 0)
    {
        errors.push(config4.required_customerid);
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
$(document).ready(function(){
     $("#checkdeposit-form  #cboCustomerID").select2({
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
	$("#checkdeposit-form  #cboBankID").select2({
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


checkdeposit.prototype.postcheckdeposit = function(){


    var errors = this.Validate($('#checkdeposit-form :input').serializeArray());

    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "checkdeposit" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#checkdeposit-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){
                    
                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    checkdeposit.prototype.addnewrow(output.id);
                    $('#checkdeposit-form [name=Mount]', $('.box-success')).val('');
                    $('#checkdeposit-form [name=CheckNo]', $('.box-success')).val('');
                    $('#checkdeposit-form #cboCustomerID', $('.box-success')).val(0);
                    $('#checkdeposit-form #cboCustomerID', $('.box-success')).trigger("chosen:updated");
                    $('#checkdeposit-form #cboBankID', $('.box-success')).val(0);
                    $('#checkdeposit-form #cboBankID', $('.box-success')).trigger("chosen:updated");
                    $('#checkdeposit-form [name=Notes]', $('.box-success')).val('');
                    $('#checkdeposit-form [name=CheckDate]', $('.box-success')).val('');
                    $('#checkdeposit-form [name=TransDate]', $('.box-success')).val('').focus();
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
checkdeposit.prototype.addnewrow = function(id){

    var t = $('#tbl-CheckDeposit').DataTable();
    var cboCustomerID = $( "#checkdeposit-form #cboCustomerID" ).clone();
     
var cboBankID = $( "#checkdeposit-form #cboBankID" ).clone();
    


    text = '<tr><td></td>' +
                '<td>' + $('#checkdeposit-form [name=TransDate]').val() +  '</td>' + 
                '<td data-val="' + $('#checkdeposit-form #cboCustomerID').val() + '"> ' + cboCustomerID.text() +  '</td>' +
                '<td class="sum">' + $('#checkdeposit-form [name=Mount]').val() +  '</td>' + 
                '<td data-val="' + $('#checkdeposit-form #cboBankID').val() + '"> ' + cboBankID.text() +  '</td>' + 
                '<td>' + $('#checkdeposit-form [name=CheckNo]').val() +  '</td>' + 
                '<td>' + $('#checkdeposit-form [name=CheckDate]').val() +  '</td>' + 
                '<td>' + $('#checkdeposit-form [name=Notes]').val() +  '</td>' + 
                '<td>'
                    +'<button  id="change" name="EditCheckDeposit_' + id + '" class="btn btn-flat btn-info btn-sm EditCheckDeposit">تعديل</button>'
                    + ' '
                    +'<button name="DelCheckDeposit_' + id + '" class="btn btn-flat btn-danger btn-sm RmvCheckDeposit">حذف</button>'+
                '</td>' +
            '</tr>'

    var index =  t.row.add( $(text) ).draw();

}
//$(document).ready(function(){ 
//$(".EditCheckDeposit").click(function(){
//alert("aaaa")
//    
// $('#tbl-CheckDeposit').css("width", "100%");

//}):
//}):



/*
* Delete Bank ID By Bank Id
* @param Bank ID gets from Spliting On click
* */
checkdeposit.prototype.DeleteCheckDeposit = function(TransID){
    $.ajax({
        url: "checkdeposit/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            checkdeposit.prototype.deleterow(TransID,output);
        })
        .error(function (data) {
            showError('',config4.con_error);
        });
}

/*
* Show edit row
* */
checkdeposit.prototype.EditCheckDeposit = function(row ,TransID ){


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
                    var cboCustomerID = $( "#cboCustomerID" ).clone();

                    cntl.html('<select name="CustomerID"style="width:100%"data-placeholder="' + cntl.text() + '"  id="cboCustomerIDedit" > </select>');
                    $(document).ready(function(){
     $("#cboCustomerIDedit").select2({
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

                    break;

                case 3 :
               cntl.html('<input    name="Mount" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class=" form-control only_float" />');

                break;

                case 4 :
                    var cboBankID = $( "#cboBankID" ).clone();
                    cntl.html('<select name="BankID"  style="width:100%"  data-placeholder="' + cntl.text() + '" id="cboBankIDedit" > </select>');
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
});
                    break;
                case 5 :

                    cntl.html('<input class="col-md-12" name="CheckNo" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="" />');

                    break;
                case 6 :

                    cntl.html('<input  name="CheckDate" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control datepicker" />');

                     $( ".datepicker" ).datepicker({
                        dateFormat: 'yy/mm/dd',
                        currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
                    });

                    break;
                case 7 :

                    cntl.html('<input  name="Notes" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 8 :

                    cntl.html(
                         '<button name="UpdateCheckDeposit_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdateCheckDeposit">حفظ</button>'
                        + ' '
                        +'<button name="CancelEdit_' + TransID + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }


    });

    reloadcbo();

$('#tbl-CheckDeposit').css({"max-width": "100%",
//                             "background": "#000"
                           });
}

/*
* Updateing Bank
* */
checkdeposit.prototype.UpdateCheckDeposit = function(TransID ,data){

console.log(data)
    $.ajax({
        url: "checkdeposit/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
            var temp = null ;
            if (output.status){

    var cboCustomerID = $( "#cboCustomerIDedit" ).clone();
      

var cboBankID = $( "#cboBankIDedit" ).clone();
     


                crow['row'].html(
                '<td></td>' +
                '<td>' + output.data.TransDate +  '</td>' + 
                '<td data-val="' + output.data.CustomerID + '"> ' + cboCustomerID.text()+  ' </td>' +
                '<td class="sum"> ' + output.data.Mount +  ' </td>' +  
                '<td data-val="' + output.data.BankID + '"> ' + cboBankID.text() +  ' </td>' + 
                '<td>' + output.data.CheckNo + '</td>' + 
                '<td>' + output.data.CheckDate + '</td>' + 
                '<td>' + output.data.Notes +  ' </td>' + 
                '<td>'
                    +'<button name="EditCheckDeposit_' + TransID + '" class="btn btn-flat btn-info btn-sm EditCheckDeposit">تعديل</button>'
                    + ' '
                    +'<button name="DelCheckDeposit_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvCheckDeposit">حذف</button>'+
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
checkdeposit.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-CheckDeposit').DataTable();
    var index =  t.row(crow.row).remove().draw();

}



$(function(){ _checkdeposit = new checkdeposit(); });

$(document).ready(function() {


    crow = {};
    $("#tbl-CheckDeposit").dataTable();

    $('#add-CheckDeposit').click(function(){
        _checkdeposit.postcheckdeposit();
               $(this).prop("disabled",true);
    });

    $('body').on('click','.RmvCheckDeposit' , function(){

        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _checkdeposit.DeleteCheckDeposit(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditCheckDeposit' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _checkdeposit.EditCheckDeposit(row ,name[1]);

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
    * update spicifc checkdeposit
    * */
    $('body').on('click','.UpdateCheckDeposit' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _checkdeposit.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _checkdeposit.UpdateCheckDeposit(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })


    $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        });
        //$( ".datepicker" ).datepicker("setDate", new Date());
    
});



//$(".EditCheckDeposit").click(function(){
////alert("aaaa")
//    
// $('#tbl-CheckDeposit').css({"width": "50%",
////                             "background": "#000"
//                            });
//
//});

    function getCustomerName(CustomerID)
    {
        var cboCustomerID = $( "#checkdeposit-form #cboCustomerID" ).clone();
        $(cboCustomerID).val(CustomerID);

        return $('option:selected',cboCustomerID).text() ; 
    }


    function getBankName(BankID)
    {
        var cboBankID = $( "#checkdeposit-form #cboBankID" ).clone();
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
     $("#add-CheckDeposit").prop("disabled",false);
});
});