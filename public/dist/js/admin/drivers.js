//Define Drivers Class
var drivers = function () {};

/*
 * Validate after Add new Driver
 * check Driver Name is required
 * check Driver Type Is required and value is 0 | 1 (Local | imported )
 * @param frm is frm.serializeArray()
 * */
drivers.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ;
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];
    if (! data.DriverName ) {
        errors.push(config.required_drivername);
    }

    return errors;
};
/*
 * Post New Proudct With name and category(Type)
 * @reponse add new row
 * */

var msg_text = '';

drivers.prototype.postdriver = function(){
    var errors = this.Validate($('#driver-form :input').serializeArray());
    msg_text = '';
    if (errors.length > 0){

        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "driver" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#driver-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    drivers.prototype.addnewrow(output.id);
                    $('[name=DriverName]', $('.box-success')).val('').focus();
                }
            })
            .error(function (data) {
                showError('',config.con_error);
            });
    }
}
/*
 *  Add New row in datatable
 * @param id is Driver Id to assign in delete and Update (edit)
 * */
drivers.prototype.addnewrow = function(id){

    var t = $('#tbl-Drivers').DataTable();

    var index =  t.row.add( [
        '',
        $('[name=DriverName]').val(),
        '<button name="EditDriver_' + id + '" class="btn btn-flat btn-info btn-sm EditDriver">تعديل</button>' +
        ' '+
        '<button name="DelDriver_' + id +'" class="btn btn-flat btn-danger btn-sm RmvDriver">حذف</button>'
    ] ).draw();

}
/*
 * Delete Driver ID By Driver Id
 * @param Driver ID gets from Spliting On click
 * */
drivers.prototype.DeleteDriver = function(Driverid){
    $.ajax({
        url: "driver/" + Driverid ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            drivers.prototype.deleterow(Driverid,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
 * Show edit row
 * */
drivers.prototype.EditDriver = function(row ,Driverid ){


    row.find('td').each (function(key) {

        var cntl = $(this).closest('tr').find('td').eq(key);

        switch (key){
            case 1 :

                cntl.html('<input name="DriverName" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                break;
            case 2 :

                cntl.html(
                    '<button name="UpdateDriver_' + Driverid + '" class="btn btn-flat btn-success btn-sm UpdateDriver">حفظ</button>'
                    + ' '
                    +'<button name="CancelEdit_' + Driverid + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                );

                break;
        }

    });


}
/*
 * Updateing Driver
 * */
drivers.prototype.UpdateDriver = function(DriverId ,data){

    console.log(data)
    $.ajax({
        url: "driver/" + DriverId ,
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
                    +'<td>' + output.data.DriverName +  '</td>'
                    +'<td>'
                    +'<button name="EditDriver_' + DriverId + '" class="btn btn-flat btn-info btn-sm EditDriver">تعديل</button>'
                    + ' '
                    +'<button name="DelDriver_' + DriverId + '" class="btn btn-flat btn-danger btn-sm RmvDriver">حذف</button>'
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
 * @param id Driver ID
 * @param output response from server
 * */
drivers.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-Drivers').DataTable();
    var index =  t.row(crow.row).remove().draw();

}

$(function(){ _driver = new drivers(); });

$(document).ready(function() {
    crow = {};
    $("#tbl-Drivers").dataTable();

    $('#add-Driver').click(function(){
 $("#add-Driver").prop("disabled",true);
        _driver.postdriver();

    });

    $('body').on('click','.RmvDriver' , function(){

        // if (confirm("Are you sure u Want Delete This Driver?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _driver.DeleteDriver(name[1]);
            }

        })



    });

    $('body').on('click','.EditDriver' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _driver.EditDriver(row ,name[1]);

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
     * update spicifc driver
     * */
    $('body').on('click','.UpdateDriver' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _driver.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _driver.UpdateDriver(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })
});

$(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-Driver").prop("disabled",false);
});
});