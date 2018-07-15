//Define Customs Class
var customs = function () {};

/*
* Validate after Add new Custom
* check Custom Name is required
* check Custom Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
customs.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];
    if (! data.CustomName ) {

    //      var langs = {{json_encode($js_config)}};
    // console.log(langs);
        // var config_ = config ;

        errors.push(config.required_customname);

    }

    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

customs.prototype.postcustom = function(){
    var errors = this.Validate($('#custom-form :input').serializeArray());
    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "custom" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#custom-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    customs.prototype.addnewrow(output.id);
                    $('[name=CustomName]', $('.box-success')).val('').focus();
                }
            })
            .error(function (data) {
                showError('',config.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is Custom Id to assign in delete and Update (edit)
* */
customs.prototype.addnewrow = function(id){

    var t = $('#tbl-Customs').DataTable();

    var index =  t.row.add( [
        '',
        $('[name=CustomName]').val(),
        '<button name="EditCustom_' + id + '" class="btn btn-flat btn-info btn-sm EditCustom">تعديل</button>' +
        ' '+
        '<button name="DelCustom_' + id +'" class="btn btn-flat btn-danger btn-sm RmvCustom">حذف</button>'
    ] ).draw();


}
/*
* Delete Custom ID By Custom Id
* @param Custom ID gets from Spliting On click
* */
customs.prototype.DeleteCustom = function(Customid){
    $.ajax({
        url: "custom/" + Customid ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            customs.prototype.deleterow(Customid,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
customs.prototype.EditCustom = function(row ,Customid ){


            row.find('td').each (function(key) {

            var cntl = $(this).closest('tr').find('td').eq(key);

            switch (key){
                case 1 :

                    cntl.html('<input name="CustomName" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 2 :

                    cntl.html(
                         '<button name="UpdateCustom_' + Customid + '" class="btn btn-flat btn-success btn-sm UpdateCustom">حفظ</button>'
                        + ' '
                        +'<button name="CancelEdit_' + Customid + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }

    });


}
/*
* Updateing Custom
* */
customs.prototype.UpdateCustom = function(CustomId ,data){

    $.ajax({
        url: "custom/" + CustomId ,
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
                +'<td>' + output.data.CustomName +  '</td>'
                +'<td>'
                    +'<button name="EditCustom_' + CustomId + '" class="btn btn-flat btn-info btn-sm EditCustom">تعديل</button>'
                    + ' '
                    +'<button name="DelCustom_' + CustomId + '" class="btn btn-flat btn-danger btn-sm RmvCustom">حذف</button>'
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
* @param id Custom ID
* @param output response from server
* */
customs.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-Customs').DataTable();
    var index =  t.row(crow.row).remove().draw();

}

$(function(){ _custom = new customs(); });

$(document).ready(function() {
    crow = {};
    $("#tbl-Customs").dataTable();

    $('#add-Custom').click(function(){
$("#add-Custom").prop("disabled",true);
        _custom.postcustom();

    });

    $('body').on('click','.RmvCustom' , function(){

        // if (confirm("Are you sure u Want Delete This Custom?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _custom.DeleteCustom(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditCustom' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _custom.EditCustom(row ,name[1]);

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
    * update spicifc custom
    * */
    $('body').on('click','.UpdateCustom' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _custom.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _custom.UpdateCustom(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })
});


 $(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-Custom").prop("disabled",false);
});
});