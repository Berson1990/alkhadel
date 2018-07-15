//Define Banks Class
var bankopeningbalance = function () {};

/*
* Validate after Add new Bank
* check Bank Name is required
* check Bank Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
bankopeningbalance.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];
   
    if (! data.TransDate ) {
        errors.push(config.required_transdate);
    }

    if (! data.BankID ) {
        errors.push(config.required_bankid);
    }
    else if (data.BankID == 0)
    {
        errors.push(config.required_bankid);
    }

    if (! data.AccountNumber ) {

        errors.push(config.required_accountnumber);
    }

    if (! data.Mount ) {

        errors.push(config.required_mount);
    }

    if (! data.CurrencyID ) {
        errors.push(config.required_currencyid);
    }
    else if (data.CurrencyID == 0)
    {
        errors.push(config.required_currencyid);
    }

    if (! data.Notes ) {

        errors.push(config.required_notes);
    }

    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

bankopeningbalance.prototype.postbankopeningbalance = function(){


    var errors = this.Validate($('#bankopeningbalance-form :input').serializeArray());

    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "bankopeningbalance" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#bankopeningbalance-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    bankopeningbalance.prototype.addnewrow(output.id);
                    $('[name=Mount]', $('.box-success')).val('');
                    $('#cboBankID', $('.box-success')).val(0);
                    $('#cboBankID', $('.box-success')).trigger("chosen:updated");
                    $('#cboCurrenyID', $('.box-success')).val(0);
                    $('#cboCurrenyID', $('.box-success')).trigger("chosen:updated");
                    $('[name=AccountNumber]', $('.box-success')).val('');
                    $('[name=Notes]', $('.box-success')).val('');
                    $('[name=TransDate]', $('.box-success')).val('').focus();
					$(".datepicker").datepicker('setDate', new Date());

                }
            })
            .error(function (data) {
                showError('',config.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is Bank Id to assign in delete and Update (edit)
* */
bankopeningbalance.prototype.addnewrow = function(id){

    var t = $('#tbl-BankOpeningBalance').DataTable();

    text = '<tr><td></td>' +
                '<td>' + $('[name=TransDate]').val() +  '</td>' + 
                '<td data-val="' + $('#cboBankID').val() + '"> ' + getBankName($('#cboBankID').val()) +  '</td>' + 
                '<td>' + $('[name=AccountNumber]').val() +  '</td>' + 
                '<td>' + $('[name=Mount]').val() +  '</td>' + 
                '<td data-val="' + $('#cboCurrenyID').val() + '"> ' + getCurrencyName($('#cboCurrenyID').val()) +  '</td>' + 
                '<td>' + $('[name=Notes]').val() +  '</td>' + 
                '<td>'
                    +'<button name="EditBankOpeningBalance_' + id + '" class="btn btn-flat btn-info btn-sm EditBankOpeningBalance">تعديل</button>'
                    + ' '
                    +'<button name="DelBankOpeningBalance_' + id + '" class="btn btn-flat btn-danger btn-sm RmvBankOpeningBalance">حذف</button>'+
                '</td>' +
            '</tr>'

    var index =  t.row.add( $(text) ).draw();

}
/*
* Delete Bank ID By Bank Id
* @param Bank ID gets from Spliting On click
* */
bankopeningbalance.prototype.DeleteBankOpeningBalance = function(TransID){
    $.ajax({
        url: "bankopeningbalance/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            bankopeningbalance.prototype.deleterow(TransID,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
bankopeningbalance.prototype.EditBankOpeningBalance = function(row ,TransID ){


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
                    var cboBankID = $( "#cboBankID" ).clone();

                    $(cboBankID).attr('id', 'cboBankID_' + TransID);
                    $(cboBankID).val(cntl.attr('data-val'));
                    cntl.html('');
                    $(cboBankID).appendTo(cntl);

                    break;
                case 3 :

                    cntl.html('<input name="AccountNumber" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 4 :

                    cntl.html('<input name="Mount" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 5 :
                    var cboCurrenyID = $( "#cboCurrenyID" ).clone();

                    $(cboCurrenyID).attr('id', 'cboCurrenyID_' + TransID);
                    $(cboCurrenyID).val(cntl.attr('data-val'));
                    cntl.html('');
                    $(cboCurrenyID).appendTo(cntl);

                    break;
                case 6 :

                    cntl.html('<input name="Notes" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 7 :

                    cntl.html(
                         '<button name="UpdateBankOpeningBalance_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdateBankOpeningBalance">حفظ</button>'
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
bankopeningbalance.prototype.UpdateBankOpeningBalance = function(TransID ,data){

console.log(data)
    $.ajax({
        url: "bankopeningbalance/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
            var temp = null ;
            if (output.status){
                crow['row'].html(
                '<td></td>' +
                '<td>' + output.data.TransDate +  '</td>' + 
                '<td data-val="' + output.data.BankID + '"> ' + getBankName(output.data.BankID) +  ' </td>' +
                '<td>' + output.data.AccountNumber + '</td>' + 
                '<td>' + output.data.Mount + '</td>' + 
                '<td data-val="' + output.data.CurrencyID + '"> ' + getCurrencyName(output.data.CurrencyID) +  ' </td>' +
                '<td>' + output.data.Notes +  ' </td>' + 
                '<td>'
                    +'<button name="EditBankOpeningBalance_' + TransID + '" class="btn btn-flat btn-info btn-sm EditBankOpeningBalance">تعديل</button>'
                    + ' '
                    +'<button name="DelBankOpeningBalance_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvBankOpeningBalance">حذف</button>'+
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
bankopeningbalance.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-BankOpeningBalance').DataTable();
    var index =  t.row(crow.row).remove().draw();

}



$(function(){ _bankopeningbalance = new bankopeningbalance(); });

$(document).ready(function() {


    crow = {};
    $("#tbl-BankOpeningBalance").dataTable();

    $('#add-BankOpeningBalance').click(function(){
             $("#add-BankOpeningBalance").prop("disabled",true);
        _bankopeningbalance.postbankopeningbalance();

    });

    $('body').on('click','.RmvBankOpeningBalance' , function(){

        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _bankopeningbalance.DeleteBankOpeningBalance(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditBankOpeningBalance' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _bankopeningbalance.EditBankOpeningBalance(row ,name[1]);

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
    * update spicifc bankopeningbalance
    * */
    $('body').on('click','.UpdateBankOpeningBalance' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _bankopeningbalance.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _bankopeningbalance.UpdateBankOpeningBalance(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })


    $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        });
        //$( ".datepicker" ).datepicker("setDate", new Date());
    
});

    function getBankName(BankID)
    {
        var cboBankID = $( "#cboBankID" ).clone();
        $(cboBankID).val(BankID);

        return $('option:selected',cboBankID).text() ; 
    }

    function getCurrencyName(CurrencyID)
    {
        var cboCurrenyID = $( "#cboCurrenyID" ).clone();
        $(cboCurrenyID).val(CurrencyID);

        return $('option:selected',cboCurrenyID).text() ; 
    }

    function strFormatDate (_Date){
        var d = new Date(_Date);
        var curr_date = d.getDate();
        var curr_month = d.getMonth() + 1;
        var curr_year = d.getFullYear(curr_year);
        return curr_date + "/" + curr_month + "/" + curr_year;
    };

	$(document).ready(function(){
//		    $( "#datepicker" ).datepicker( $.datepicker.regional[ "ar" ] );
    
		$(".datepicker").datepicker('setDate', new Date());

});
 $(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-BankOpeningBalance").prop("disabled",false);
});
});