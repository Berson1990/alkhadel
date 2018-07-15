//Define Cashiers Class
var cashiers = function () {};

/*
* Validate after Add new Cashier
* check Cashier Name is required
* check Cashier Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
cashiers.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];
    if (! data.CashierName ) {

        errors.push(config.required_cashiername);

    }

    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

cashiers.prototype.postcashier = function(){
    var errors = this.Validate($('#cashier-form :input').serializeArray());
    msg_text = '';
    if (errors.length > 0){
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "cashier" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#cashier-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    cashiers.prototype.addnewrow(output.id);
                    $('[name=CashierName]', $('.box-success')).val('').focus();
                }
            })
            .error(function (data) {
                showError('',config.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is Cashier Id to assign in delete and Update (edit)
* */
cashiers.prototype.addnewrow = function(id){

    var t = $('#tbl-Cashiers').DataTable();

    var index =  t.row.add( [
        '',
        $('[name=CashierName]').val(),
        '<button name="EditCashier_' + id + '" class="btn btn-flat btn-info btn-sm EditCashier">تعديل</button>' +
        ' '+
        '<button name="DelCashier_' + id +'" class="btn btn-flat btn-danger btn-sm RmvCashier">حذف</button>'
    ] ).draw();

}
/*
* Delete Cashier ID By Cashier Id
* @param Cashier ID gets from Spliting On click
* */
cashiers.prototype.DeleteCashier = function(Cashierid){
    $.ajax({
        url: "cashier/" + Cashierid ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            cashiers.prototype.deleterow(Cashierid,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
cashiers.prototype.EditCashier = function(row ,Cashierid ){


            row.find('td').each (function(key) {

            var cntl = $(this).closest('tr').find('td').eq(key);

            switch (key){
                case 1 :

                    cntl.html('<input name="CashierName" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 2 :

                    cntl.html(
                         '<button name="UpdateCashier_' + Cashierid + '" class="btn btn-flat btn-success btn-sm UpdateCashier">حفظ</button>'
                        + ' '
                        +'<button name="CancelEdit_' + Cashierid + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }

    });


}
/*
* Updateing Cashier
* */
cashiers.prototype.UpdateCashier = function(CashierId ,data){

console.log(data)
    $.ajax({
        url: "cashier/" + CashierId ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
            var temp = null ;
            if (output.status){
                temp = output.data.CashierType < 1 ? 'محلى' : 'مستورد'
                crow['row'].html(
                '<td></td>' +
                '<td>' + output.data.CashierName +  '</td>' +
                '<td>'
                    +'<button name="EditCashier_' + CashierId + '" class="btn btn-flat btn-info btn-sm EditCashier">تعديل</button>'
                    + ' '
                    +'<button name="DelCashier_' + CashierId + '" class="btn btn-flat btn-danger btn-sm RmvCashier">حذف</button>' 
                    +
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
* @param id Cashier ID
* @param output response from server
* */
cashiers.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-Cashiers').DataTable();
    var index =  t.row(crow.row).remove().draw();

}

$(function(){ _cashier = new cashiers(); });

$(document).ready(function() {
    crow = {};
    $("#tbl-Cashiers").dataTable();

    $('#add-Cashier').click(function(){
             $("#add-Cashier").prop("disabled",true);
        _cashier.postcashier();

    });

    $('body').on('click','.RmvCashier' , function(){

        // if (confirm("Are you sure u Want Delete This Cashier?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _cashier.DeleteCashier(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditCashier' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _cashier.EditCashier(row ,name[1]);

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
    * update spicifc cashier
    * */
    $('body').on('click','.UpdateCashier' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _cashier.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _cashier.UpdateCashier(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })
});
$(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-Cashier").prop("disabled",false);
});
});