//Define StockHolders Class
var stockHolders = function () {};

/*
* Validate after Add new StockHolder
* check StockHolder Name is required
* check StockHolder Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
stockHolders.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];
    if (! data.StockHolderName ) {
        errors.push(config.required_stockHoldername);
    }
    
    if (! data.StockHolderPercentage ) {
        errors.push(config.required_stockholderpercentage);
    }

    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

stockHolders.prototype.poststockHolder = function(){
    var errors = this.Validate($('#stockHolder-form :input').serializeArray());
    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "stockholder" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#stockHolder-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    stockHolders.prototype.addnewrow(output.id);
                    $('[name=StockHolderPercentage]', $('.box-success')).val('');
                    $('[name=StockHolderName]', $('.box-success')).val('').focus();
                }
            })
            .error(function (data) {
                showError('',config.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is StockHolder Id to assign in delete and Update (edit)
* */
stockHolders.prototype.addnewrow = function(id){

    var t = $('#tbl-StockHolders').DataTable();

    var index =  t.row.add( [
        '',
        $('[name=StockHolderName]').val(),
        $('[name=StockHolderPercentage]').val(),
        '<button name="EditStockHolder_' + id + '" class="btn btn-flat btn-info btn-sm EditStockHolder">تعديل</button>' +
        ' '+
        '<button name="DelStockHolder_' + id +'" class="btn btn-flat btn-danger btn-sm RmvStockHolder">حذف</button>'
    ] ).draw();

}
/*
* Delete StockHolder ID By StockHolder Id
* @param StockHolder ID gets from Spliting On click
* */
stockHolders.prototype.DeleteStockHolder = function(StockHolderid){
    $.ajax({
        url: "stockholder/" + StockHolderid ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            stockHolders.prototype.deleterow(StockHolderid,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
stockHolders.prototype.EditStockHolder = function(row ,StockHolderid ){


            row.find('td').each (function(key) {

            var cntl = $(this).closest('tr').find('td').eq(key);

            switch (key){
                case 1 :

                    cntl.html('<input name="StockHolderName" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 2 :
                    
                    cntl.html('<input name="StockHolderPercentage" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control only_float" />');

                    break;
                case 3 :

                    cntl.html(
                         '<button name="UpdateStockHolder_' + StockHolderid + '" class="btn btn-flat btn-success btn-sm UpdateStockHolder">حفظ</button>'
                        + ' '
                        +'<button name="CancelEdit_' + StockHolderid + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }

    });


}
/*
* Updateing StockHolder
* */
stockHolders.prototype.UpdateStockHolder = function(StockHolderId ,data){

console.log(data)
    $.ajax({
        url: "stockholder/" + StockHolderId ,
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
                    +'<td>' + output.data.StockHolderName +  '</td>'
                +'<td>' + output.data.StockHolderPercentage + '</td>'
                +'<td>'
                    +'<button name="EditStockHolder_' + StockHolderId + '" class="btn btn-flat btn-info btn-sm EditStockHolder">تعديل</button>'
                    + ' '
                    +'<button name="DelStockHolder_' + StockHolderId + '" class="btn btn-flat btn-danger btn-sm RmvStockHolder">حذف</button>'
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
* @param id StockHolder ID
* @param output response from server
* */
stockHolders.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-StockHolders').DataTable();
    var index =  t.row(crow.row).remove().draw();

}

$(function(){ _stockHolder = new stockHolders(); });

$(document).ready(function() {
    crow = {};
    $("#tbl-StockHolders").dataTable();

    $('#add-StockHolder').click(function(){
            $("#add-StockHolder").prop("disabled",true);
        _stockHolder.poststockHolder();

    });

    $('body').on('click','.RmvStockHolder' , function(){

        // if (confirm("Are you sure u Want Delete This StockHolder?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _stockHolder.DeleteStockHolder(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditStockHolder' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _stockHolder.EditStockHolder(row ,name[1]);

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
    * update spicifc stockHolder
    * */
    $('body').on('click','.UpdateStockHolder' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _stockHolder.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _stockHolder.UpdateStockHolder(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })
});
$(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-StockHolder").prop("disabled",false);
});
});