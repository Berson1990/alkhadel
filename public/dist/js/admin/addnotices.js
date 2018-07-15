
var addnotices = function () {};


addnotices.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });
    var errors = [];
    if (! data.CheckNo ) {
        errors.push(config.required_checkno);
    }
    
    if (! data.NoticeNo ) {
        errors.push(config.required_noticeno);
    }

  
    return errors;
};


var msg_text = '';

addnotices.prototype.postaddnotice = function(){
    var errors = this.Validate($('#addnotice-form :input').serializeArray());
    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "addnotice" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#addnotice-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    addnotices.prototype.addnewrow(output.id);
                    $('[name=NoticeNo]', $('.box-success')).val('');
                    $('[name=CheckNo]', $('.box-success')).val('').focus();
                }
            })
            .error(function (data) {
                showError('',config.con_error);
            });
    }
}

addnotices.prototype.addnewrow = function(id){

    var t = $('#tbl-AddNotices').DataTable();

    var index =  t.row.add( [
        '',
        $('[name=CheckNo]').val(),
        $('[name=NoticeNo]').val(),
        '<button name="EditAddNotice_' + id + '" class="btn btn-flat btn-info btn-sm EditAddNotice">تعديل</button>' +
        ' '+
        '<button name="DelAddNotice_' + id +'" class="btn btn-flat btn-danger btn-sm RmvAddNotice">حذف</button>'
    ] ).draw();

}

addnotices.prototype.DeleteAddNotice = function(TransID){
    $.ajax({
        url: "addnotice/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            addnotices.prototype.deleterow(TransID,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}


addnotices.prototype.EditAddNotice = function(row ,TransID ){


            row.find('td').each (function(key) {

            var cntl = $(this).closest('tr').find('td').eq(key);

            switch (key){
                case 1 :

                    cntl.html('<input name="CheckNo" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 2 :
                    
                    cntl.html('<input name="NoticeNo" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 3 :

                    cntl.html(
                         '<button name="UpdateAddNotice_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdateAddNotice">حفظ</button>'
                        + ' '
                        +'<button name="CancelAddNotice_' + TransID + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }

    });


}

addnotices.prototype.UpdateAddNotice = function(TransID ,data){

console.log(data)
    $.ajax({
        url: "addnotice/" + TransID ,
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
                    +'<td>' + output.data.CheckNo +  '</td>'
                +'<td>' + output.data.NoticeNo + '</td>'
                +'<td>'
                    +'<button name="EditAddNotice_' + TransID + '" class="btn btn-flat btn-info btn-sm EditAddNotice">تعديل</button>'
                    + ' '
                    +'<button name="DelAddNotice_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvAddNotice">حذف</button>'
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


addnotices.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-AddNotices').DataTable();
    var index =  t.row(crow.row).remove().draw();

}

$(function(){ _addnotice = new addnotices(); });

$(document).ready(function() {
    crow = {};
    $("#tbl-AddNotices").dataTable();

    $('#add-AddNotice').click(function(){
             $("#add-AddNotice").prop("disabled",true);
        _addnotice.postaddnotice();

    });

    $('body').on('click','.RmvAddNotice' , function(){



        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _addnotice.DeleteAddNotice(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditAddNotice' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _addnotice.EditAddNotice(row ,name[1]);

    });

    $('body').on('click','.CancelEdit' , function()
    {
        var name = this.name ;
        name = name.split('_');

        $(this).closest('tr').html(crow['tr_' + name[1] ].html());
    })
   
    $('body').on('click','.UpdateAddNotice' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _addnotice.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _addnotice.UpdateAddNotice(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })
});

 $(document).ready(function() { 
$(':input').keypress(function () { 
     $("#add-AddNotice").prop("disabled",false);
});
});