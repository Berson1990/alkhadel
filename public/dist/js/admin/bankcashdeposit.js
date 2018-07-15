
var bankcashdeposit = function () {};

bankcashdeposit.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

        console.log("data");
        console.log(data);
    });

    var errors = [];

    if (! data.TransDate ) {
        errors.push(config6.required_transdate);
    }

    if (! data.CustomerID ) {
        errors.push(config6.required_customerid);
    }
    else if (data.CustomerID == 0)
    {
        errors.push(config6.required_customerid);
    }


    if (! data.BankID ) {
        errors.push(config6.required_bankid);
    }
    else if (data.BankID == 0)
    {
        errors.push(config6.required_bankid);
    }

    if (! data.Mount ) {

        errors.push(config6.required_mount);
    }

//    if (! data.Notes ) {
//
//        errors.push(config6.required_notes);
//    }
    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';


$(document).ready(function(){
     $("#bankcashdeposit-form  #cboCustomerID4").select2({
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

	
	$("#bankcashdeposit-form  #cboBankID4").select2({
            placeholder: "Search for an bank Name",
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

bankcashdeposit.prototype.postcashdeposit = function(){


    var errors = this.Validate($('#bankcashdeposit-form :input').serializeArray());

    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "bankcashdeposit" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#bankcashdeposit-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
            console.log(output);
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    bankcashdeposit.prototype.addnewrow(output.id);
                    $('#bankcashdeposit-form [name=Mount]', $('.box-success')).val('');
                    $('#bankcashdeposit-form #cboCustomerID4', $('.box-success')).val(0);
                    $('#bankcashdeposit-form #cboCustomerID4', $('.box-success')).trigger("chosen:updated");
                    $('#cboBankID4', $('.box-success')).val(0);
                    $('#cboBankID4', $('.box-success')).trigger("chosen:updated");
                    $('[name=Notes]', $('.box-success')).val('')
                    $('[name=TransDate]', $('.box-success')).val('').focus();
					$(".datepicker").datepicker('setDate', new Date());
                }
            })
            .error(function (data) {
                showError('',config6.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is Bank Id to assign in delete and Update (edit)
* */
bankcashdeposit.prototype.addnewrow = function(id){

    var t = $('#tbl-BankCashDeposit').DataTable();

        var cboCustomerID = $( "#bankcashdeposit-form #cboCustomerID4" ).clone();
        $(cboCustomerID).val("#bankcashdeposit-form #cboCustomerID4");
        
       
        // return $('option:selected',cboCustomerID).text() ; 

    text = '<tr><td></td>' +
                '<td>' + $('#bankcashdeposit-form [name=TransDate]').val() +  '</td>' + 
                '<td data-val="' + $('#bankcashdeposit-form #cboCustomerID4').val() + '"> ' + cboCustomerID.text() +  '</td>' +
                '<td>' + $('#bankcashdeposit-form [name=Mount]').val() +  '</td>' + 
                '<td data-val="' + $('#bankcashdeposit-form #cboBankID4').val() + '"> ' + getBankName($('#bankcashdeposit-form #cboBankID4').val()) +  '</td>' + 
                '<td>' + $('#bankcashdeposit-form [name=Notes]').val() +  '</td>' + 
                '<td>'
                    +'<button name="EditbankCashDeposit_' + id + '" class="btn btn-flat btn-info btn-sm EditbankCashDeposit">تعديل</button>'
                    + ' '
                    +'<button name="DelbCashDeposit_' + id + '" class="btn btn-flat btn-danger btn-sm RmvbCashDeposit">حذف</button>'+
                '</td>' +
            '</tr>';  
    

    var index =  t.row.add( $(text) ).draw();

}
/*
* Delete Bank ID By Bank Id
* @param Bank ID gets from Spliting On click
* */
bankcashdeposit.prototype.DeleteCashDeposit = function(TransID){
    $.ajax({
        url: "bankcashdeposit/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            bankcashdeposit.prototype.deleterow(TransID,output);
        })
        .error(function (data) {
            showError('',config6.con_error);
        });
}

/*
* Show edit row
* */
bankcashdeposit.prototype.EditbankCashDeposit = function(row ,TransID ){


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

        cntl.html( '<select name="CustomerID" style="width:100%"  data-placeholder="'+ cntl.text() + '" id="cboCustomerIDedit4" > </select>' );

                $(document).ready(function(){
     $("#cboCustomerIDedit4").select2({
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
        });});
                    break;
                case 3 :

                	cntl.html('<input name="Mount" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control only_float" />');

                    break;
               
                case 4 :
                    cntl.html('<select name="BankID" style="width:100%" data-placeholder="'+ cntl.text() + '" id="cboBankIDedit"></select>');
                    // cntl.html('<select name="BankID" style="width:100%" data-placeholder="'+ cntl.text() + '" id="cboBankIDedit"> <option id="foo3"> '+ cntl.text() + ' </option> </select>');
                    // $("#foo3").select2();
                   $(document).ready(function(){
                        $("#cboBankIDedit").select2({
            placeholder: "Search for an bank Name",
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

                    cntl.html('<input name="Notes" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');


                    break;
                case 6 :

                    cntl.html(
                         '<button name="UpdatebCashDeposit_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdatebCashDeposit">حفظ</button>'
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
bankcashdeposit.prototype.UpdatebCashDeposit = function(TransID ,data){

console.log(data)
    $.ajax({
        url: "bankcashdeposit/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) 
            {   

                console.log(output);

            var temp = null ;
            if (output.status){
                  var cboCustomerID1 = $( "#cboCustomerIDedit4" ).clone();
                  var cboBankID = $( "#cboBankIDedit" ).clone();
              
                 
                crow['row'].html(
                '<td></td>' +
                '<td> ' + output.data.TransDate +  ' </td>' + 
                '<td data-val="' + output.data.CustomerID + '"> ' + cboCustomerID1.text() +  ' </td>' +
                '<td> ' + output.data.Mount +  ' </td>' + 
                '<td data-val="' + output.data.BankID + '"> ' +  cboBankID.text()+  ' </td>' + 
                '<td> ' + output.data.Notes +  ' </td>' + 
                '<td>'
                    +'<button name="EditbankCashDeposit_' + TransID + '" class="btn btn-flat btn-info btn-sm EditbankCashDeposit">تعديل</button>'
                    + ' '
                    +'<button name="DelbCashDeposit_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvbCashDeposit">حذف</button>'+
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
            showError('',config6.con_error);
        });

}

/*
* Delete Current Row ANd Hide then remove
* @param id Bank ID
* @param output response from server
* */
bankcashdeposit.prototype.deleterow = function(id,output){
    var cls = null;
    console.log(output);
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-BankCashDeposit').DataTable();
    var index =  t.row(crow.row).remove().draw();

}



$(function(){ _bankcashdeposit = new bankcashdeposit(); });

$(document).ready(function() {


    crow = {};
   // $("#tbl-BankCashDeposit").dataTable();

    $('#add-BankCashDeposit').click(function(){

        _bankcashdeposit.postcashdeposit();
             $(this).prop("disabled",true);
    });

    $('body').on('click','.RmvbCashDeposit' , function(){

        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _bankcashdeposit.DeleteCashDeposit(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditbankCashDeposit' , function(){
        // alert("cc");
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _bankcashdeposit.EditbankCashDeposit(row ,name[1]);

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
    });
    /*
    * update spicifc cashdeposit
    * */
    $('body').on('click','.UpdatebCashDeposit' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _bankcashdeposit.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _bankcashdeposit.UpdatebCashDeposit(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
            
        }
    });


    $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        });
        //$( ".datepicker" ).datepicker("setDate", new Date());
    
});


//getCustomerName
    function getCustomerName2(CustomerID)
    {
        var cboCustomerID = $( "#bankcashdeposit-form #cboCustomerID4" ).clone();
        $(cboCustomerID).val(CustomerID);
        
       
        return $('option:selected',cboCustomerID).text() ; 
    }


    function getBankName(BankID)
    {
        var cboBankID = $( "#bankcashdeposit-form #cboBankID4" ).clone();
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
     $("#add-BankCashDeposit").prop("disabled",false);
});


$(':input').change(function () { 
//   alert("ayyy")
     $("#add-BankCashDeposit").prop("disabled",false);

});
     
});