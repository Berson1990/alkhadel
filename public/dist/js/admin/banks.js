//Define Banks Class
var banks = function () {};

/*
* Validate after Add new Bank
* check Bank Name is required
* check Bank Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
banks.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });


    var errors = [];
    if (! data.BankName ) {

        errors.push(config.required_bankname);

    }
    if (! data.AccountNumber ) {

        errors.push(config.required_accountnumber);

    }
    if (! data.CurrencyID ) {

        errors.push(config.required_currencyid);

    }
    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

banks.prototype.postbank = function(){

    var errors = this.Validate($('#bank-form :input').serializeArray());
    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "banks" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#bank-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    banks.prototype.addnewrow(output.id);
                    $('[name=AccountNumber]', $('.box-success')).val('');
                    $('#cboCurrencyID', $('.box-success')).val(0);
                    $('#cboCurrencyID', $('.box-success')).trigger("chosen:updated");
                    $('[name=BankName]', $('.box-success')).val('').focus();
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
banks.prototype.addnewrow = function(id){

    var t = $('#tbl-Banks').DataTable();

    text = '<tr><td></td>' +
                '<td>' + $('[name=BankName]').val() +  '</td>' + 
                '<td>' + $('[name=AccountNumber]').val() +  '</td>' + 
                '<td data-val="' + $('#cboCurrencyID').val() + '">' + getCurrencyName($('#cboCurrencyID').val()) +  '</td>' + 
                '<td>'
                    +'<button name="EditBank_' + id + '" class="btn btn-flat btn-info btn-sm EditBank">تعديل</button>'
                    + ' '
                    +'<button name="DelBank_' + id + '" class="btn btn-flat btn-danger btn-sm RmvBank">حذف</button>'+
                '</td>' +
            '</tr>'

    // var index =  t.row.add( [
    //     '',
    //     $('[name=BankName]').val(),
    //     $('[name=AccountNumber]').val(),
    //     getCurrencyName($('#cboCurrencyID').val()),
    //     '<button name="EditBank_' + id + '" class="btn btn-flat btn-info btn-sm EditBank">تعديل</button>' +
    //     ' '+
    //     '<button name="DelBank_' + id +'" class="btn btn-flat btn-danger btn-sm RmvBank">حذف</button>'
    // ] ).draw();

var index =  t.row.add( $(text) ).draw();


    //console.log(t.rows().nodes);

    //data-val="'+ $('[name=BankType]:checked').attr('data-val') // dont forget assign data-val in local td imported

    //$('[name^=DelBank_' + id + ']').click(function(){banks.prototype.DeleteBank(id);});

}
/*
* Delete Bank ID By Bank Id
* @param Bank ID gets from Spliting On click
* */
banks.prototype.DeleteBank = function(Bankid){
    $.ajax({
        url: "banks/" + Bankid ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            banks.prototype.deleterow(Bankid,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
banks.prototype.EditBank = function(row ,Bankid ){


            row.find('td').each (function(key) {

            var cntl = $(this).closest('tr').find('td').eq(key);

            switch (key){
                case 1 :

                    cntl.html('<input name="BankName" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 2 :

                	cntl.html('<input name="AccountNumber" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 3 :

                    //cboCurrencyID , Bankid
                    var cboCurrencyID = $( "#cboCurrencyID" ).clone();
                    $(cboCurrencyID).attr('id', 'cboCurrencyID_' + Bankid);
                    $(cboCurrencyID).val(cntl.attr('data-val'));
                    cntl.html('');
                    $(cboCurrencyID).appendTo(cntl);

                    break;
                case 4 :

                    cntl.html(
                         '<button name="UpdateBank_' + Bankid + '" class="btn btn-flat btn-success btn-sm UpdateBank">حفظ</button>'
                        + ' '
                        +'<button name="CancelEdit_' + Bankid + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }

            reloadcbo();

    });


}
/*
* Updateing Bank
* */
banks.prototype.UpdateBank = function(BankId ,data){

console.log(data)
    $.ajax({
        url: "banks/" + BankId ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
            var temp = null ;
            if (output.status){
                temp = output.data.BankType < 1 ? 'محلى' : 'مستورد'
                crow['row'].html(
                '<td></td>' +
                '<td> ' + output.data.BankName +  ' </td>' + 
                '<td> ' + output.data.AccountNumber +  ' </td>' + 
                '<td data-val="' + output.data.CurrencyID + '"> ' + getCurrencyName(output.data.CurrencyID) +  ' </td>' + 
                '<td>'
                    +'<button name="EditBank_' + BankId + '" class="btn btn-flat btn-info btn-sm EditBank">تعديل</button>'
                    + ' '
                    +'<button name="DelBank_' + BankId + '" class="btn btn-flat btn-danger btn-sm RmvBank">حذف</button>'+
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
banks.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-Banks').DataTable();
    var index =  t.row(crow.row).remove().draw();

}



$(function(){ _bank = new banks(); });

$(document).ready(function() {


    crow = {};
    $("#tbl-Banks").dataTable();

    $('#add-Bank').click(function(){
        _bank.postbank();
          $("#add-Bank").prop("disabled",true);

    });

    $('body').on('click','.RmvBank' , function(){

        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _bank.DeleteBank(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditBank' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _bank.EditBank(row ,name[1]);

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
    * update spicifc bank
    * */
    $('body').on('click','.UpdateBank' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _bank.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _bank.UpdateBank(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })
});



    function getCurrencyName(CurrencyID)
    {
        var cboCurrencyID = $( "#cboCurrencyID" ).clone();
        $(cboCurrencyID).val(CurrencyID);

       return $('option:selected',cboCurrencyID).text() ; //$( "#cboCurrencyID option:selected" ).text();
        
        // $element.find("option").filter(function(){
        //   return ( ($(this).val() == CurrencyID) || ($(this).text() == CurrencyID) )
        // }).prop('selected', true);


    }

$(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-Bank").prop("disabled",false);
});
});