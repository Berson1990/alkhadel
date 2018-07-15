//Define Currencies Class
var currencies = function () {};

/*
* Validate after Add new Currency
* check Currency Name is required
* check Currency Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
currencies.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];
    if (! data.CurrencyName ) {
        errors.push(config.required_currencyname);
    }
    
    if (! data.CurrencySymbol ) {
        errors.push(config.required_currencysymbol);
    }

    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

currencies.prototype.postcurrency = function(){
    var errors = this.Validate($('#currency-form :input').serializeArray());
    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "currency" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#currency-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    currencies.prototype.addnewrow(output.id);
                    $('[name=CurrencySymbol]', $('.box-success')).val('');
                    $('[name=CurrencyName]', $('.box-success')).val('').focus();
                }
            })
            .error(function (data) {
                showError('',config.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is Currency Id to assign in delete and Update (edit)
* */
currencies.prototype.addnewrow = function(id){

    var t = $('#tbl-Currencies').DataTable();

    var index =  t.row.add( [
        '',
        $('[name=CurrencyName]').val(),
        $('[name=CurrencySymbol]').val(),
        '<button name="EditCurrency_' + id + '" class="btn btn-flat btn-info btn-sm EditCurrency">تعديل</button>' +
        ' '+
        '<button name="DelCurrency_' + id +'" class="btn btn-flat btn-danger btn-sm RmvCurrency">حذف</button>'
    ] ).draw();

}
/*
* Delete Currency ID By Currency Id
* @param Currency ID gets from Spliting On click
* */
currencies.prototype.DeleteCurrency = function(Currencyid){
    $.ajax({
        url: "currency/" + Currencyid ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            currencies.prototype.deleterow(Currencyid,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
currencies.prototype.EditCurrency = function(row ,Currencyid ){


            row.find('td').each (function(key) {

            var cntl = $(this).closest('tr').find('td').eq(key);

            switch (key){
                case 1 :

                    cntl.html('<input name="CurrencyName" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 2 :
                    
                    cntl.html('<input name="CurrencySymbol" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 3 :

                    cntl.html(
                         '<button name="UpdateCurrency_' + Currencyid + '" class="btn btn-flat btn-success btn-sm UpdateCurrency">حفظ</button>'
                        + ' '
                        +'<button name="CancelEdit_' + Currencyid + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }

    });


}
/*
* Updateing Currency
* */
currencies.prototype.UpdateCurrency = function(CurrencyId ,data){

console.log(data)
    $.ajax({
        url: "currency/" + CurrencyId ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
            var temp = null ;
            if (output.status){
                crow['row'].html(
                '<td></td>'
                    +'<td>' + output.data.CurrencyName +  '</td>'
                +'<td>' + output.data.CurrencySymbol + '</td>'
                +'<td>'
                    +'<button name="EditCurrency_' + CurrencyId + '" class="btn btn-flat btn-info btn-sm EditCurrency">تعديل</button>'
                    + ' '
                    +'<button name="DelCurrency_' + CurrencyId + '" class="btn btn-flat btn-danger btn-sm RmvCurrency">حذف</button>'
                +'</td>'
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
* @param id Currency ID
* @param output response from server
* */
currencies.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-Currencies').DataTable();
    var index =  t.row(crow.row).remove().draw();

}

$(function(){ _currency = new currencies(); });

$(document).ready(function() {
    crow = {};
    $("#tbl-Currencies").dataTable();

    $('#add-Currency').click(function(){
 $("#add-Currency").prop("disabled",true);
        _currency.postcurrency();

    });

    $('body').on('click','.RmvCurrency' , function(){

        // if (confirm("Are you sure u Want Delete This Currency?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _currency.DeleteCurrency(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditCurrency' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _currency.EditCurrency(row ,name[1]);

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
    * update spicifc currency
    * */
    $('body').on('click','.UpdateCurrency' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _currency.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _currency.UpdateCurrency(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })
});

$(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-Currency").prop("disabled",false);
});
});