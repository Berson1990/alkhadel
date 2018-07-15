//Define Suppliers Class
var carrying = function () {};

/*
* Validate after Add new Supplier
* check Supplier Name is required
* check Supplier Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
carrying.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];
    if (! data.Local ) {
        errors.push(config.required_local);
    }
    
    if (! data.Imported ) {
        errors.push(config.required_imported);
    }

    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

//carrying.prototype.addnewrow = function(id){
//
//    
//
//  var t = $('#tbl-Carring').DataTable();
//
//     var cboCustomerID = $( "#tbl-Carring" ).clone();
//
//    text = '<tr><td></td>' +
//                '<td>' + $('#customeropeningbalance-form [name=TransDate]').val() +  '</td>' + 
//                '<td>' + $('#customeropeningbalance-form [name=Mount]').val() +  '</td>' + 
//                '<td>'
//                    +'<button name="EditCarrying_' + id + '" class="btn btn-flat btn-info btn-sm EditCarrying">تعديل</button>'
//                    +'</td>'+'</tr>';
//
//    var index =  t.row.add( $(text) ).draw();
//
//
//
//}




var msg_text = '';

/*
* Show edit row
* */
carrying.prototype.EditCarrying = function(row ,Carryingid ){


            row.find('td').each (function(key) {

            var cntl = $(this).closest('tr').find('td').eq(key);

            switch (key){
                case 1 :

                    cntl.html('<input name="Local" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control only_float" />');

                    break;
                case 2 :
                    
                    cntl.html('<input name="Imported" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control only_float" />');

                    break;
                case 3 :

                    cntl.html(
                         '<button name="UpdateCarrying_' + Carryingid + '" class="btn btn-flat btn-success btn-sm UpdateCarrying">حفظ</button>'
                        + ' '
                        +'<button name="CancelEdit_' + Carryingid + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }

    });


}
/*
* Updateing Carrying
* */
carrying.prototype.UpdateCarrying = function(CarryingID ,data){

console.log(data)

    $.ajax({
        url: "carrying/" + CarryingID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
        console.log(output);
            var temp = null ;
            if (output.status){
                crow['row'].html(
                '<td></td>'
                +'<td>' + output.data.Local +  '</td>'
                +'<td>' + output.data.Imported + '</td>'
                +'<td>'
                    +'<button name="EditCarrying_' + CarryingID + '" class="btn btn-flat btn-info btn-sm EditCarrying">تعديل</button>'
                   
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


$(function(){ _carrying = new carrying(); });

$(document).ready(function() {
    crow = {};
    $("#tbl-Carrying").dataTable();

    $('body').on('click','.EditCarrying' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _carrying.EditCarrying(row ,name[1]);

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
    * update spicifc carrying
    * */
    $('body').on('click','.UpdateCarrying' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _carrying.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            $.each( errors, function( key, value ) {

                error += value + '\n' ;

            });
            alert(error);
        }else{
     _carrying.UpdateCarrying(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "="));
        }
    })
});