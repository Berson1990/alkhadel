//Define DiscountNotices Class
var discountnotices = function () {};

/*
* Validate after Add new DiscountNotices
* check DiscountNotices Name is required
* check DiscountNotices Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
discountnotices.prototype.Validate = function(frm){

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

    // console.log(errors);

    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

discountnotices.prototype.postdiscountnotice = function(){
    var errors = this.Validate($('#discountnotice-form :input').serializeArray());
    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "discountnotice" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#discountnotice-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    discountnotices.prototype.addnewrow(output.id);
                    $('[name=NoticeNo]', $('.box-success')).val('');
                    $('[name=CheckNo]', $('.box-success')).val('').focus();
                }
            })
            .error(function (data) {
                showError('',config.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is DiscountNotices Id to assign in delete and Update (edit)
* */
discountnotices.prototype.addnewrow = function(id){

    var t = $('#tbl-DiscountNotices').DataTable();

    var index =  t.row.add( [
        '',
        $('[name=CheckNo]').val(),
        $('[name=NoticeNo]').val(),
        '<button name="EditDiscountNotice_' + id + '" class="btn btn-flat btn-info btn-sm EditDiscountNotice">تعديل</button>' +
        ' '+
        '<button name="DelDiscountNotice_' + id +'" class="btn btn-flat btn-danger btn-sm RmvDiscountNotice">حذف</button>'
    ] ).draw();

}
/*
* Delete DiscountNotices ID By DiscountNotices Id
* @param DiscountNotices ID gets from Spliting On click
* */
discountnotices.prototype.DeleteDiscountNotice = function(TransID){
    $.ajax({
        url: "discountnotice/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            discountnotices.prototype.deleterow(TransID,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
discountnotices.prototype.EditDiscountNotice = function(row ,TransID ){


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
                         '<button name="UpdateDiscountNotice_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdateDiscountNotice">حفظ</button>'
                        + ' '
                        +'<button name="CancelDiscountNotice_' + TransID + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }

    });


}
/*
* Updateing DiscountNotices
* */
discountnotices.prototype.UpdateDiscountNotice = function(TransID ,data){

console.log(data)
    $.ajax({
        url: "discountnotice/" + TransID ,
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
                    +'<button name="EditDiscountNotice_' + TransID + '" class="btn btn-flat btn-info btn-sm EditDiscountNotice">تعديل</button>'
                    + ' '
                    +'<button name="DelDiscountNotice_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvDiscountNotice">حذف</button>'
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
* @param id DiscountNotices ID
* @param output response from server
* */
discountnotices.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-DiscountNotices').DataTable();
    var index =  t.row(crow.row).remove().draw();

}

$(function(){ _discountnotice = new discountnotices(); });

$(document).ready(function() {
    crow = {};
    $("#tbl-DiscountNotices").dataTable();

    $('#add-DiscountNotice').click(function(){
          $("#add-DiscountNotice").prop("disabled",true);
        _discountnotice.postdiscountnotice();

    });

    $('body').on('click','.RmvDiscountNotice' , function(){

        // if (confirm("Are you sure u Want Delete This DiscountNotices?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _discountnotice.DeleteDiscountNotice(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditDiscountNotice' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _discountnotice.EditDiscountNotice(row ,name[1]);

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
    * update spicifc discountnotices
    * */
    $('body').on('click','.UpdateDiscountNotice' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _discountnotice.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _discountnotice.UpdateDiscountNotice(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })
});


 $(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-DiscountNotice").prop("disabled",false);
});
});
