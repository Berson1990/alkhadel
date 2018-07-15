//Define Banks Class
var holderdrawals = function () {};

/*
* Validate after Add new Bank
* check Bank Name is required
* check Bank Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
holderdrawals.prototype.Validate = function(frm){

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
    if (! data.Mount ) {

        errors.push(config.required_mount);

    }

    if (! data.StockHolderID ) {
        errors.push(config.required_stockholderid);
    }
    else if (data.StockHolderID == 0)
    {
        errors.push(config.required_stockholderid);
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

holderdrawals.prototype.postholderdrawal = function(){


    var errors = this.Validate($('#holderdrawal-form :input').serializeArray());

    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "holderdrawal" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#holderdrawal-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    holderdrawals.prototype.addnewrow(output.id);
                    $('[name=Mount]', $('.box-success')).val('').focus();
                    $('#cboStockHolderID', $('.box-success')).val(0);
                    $('#cboStockHolderID', $('.box-success')).trigger("chosen:updated");
                    $('[name=Notes]', $('.box-success')).val('').focus();
                    $('[name=TransDate]', $('.box-success')).val('').focus();
					$(".datepicker").datepicker('setDate', new Date());

                }
			
                }).error(function (data) {
                showError('',config.con_error);
            });
}
}		
		
	
	

/*
*  Add New row in datatable
* @param id is Bank Id to assign in delete and Update (edit)
* */
holderdrawals.prototype.addnewrow = function(id){

    var t = $('#tbl-HolderDrawals').DataTable();

    text = '<tr><td></td>' +
                '<td>' + $('[name=TransDate]').val() +  '</td>' + 
                '<td>' + $('[name=Mount]').val() +  '</td>' + 
                '<td data-val="' + $('#cboStockHolderID').val() + '">' + getStockHolderName($('#cboStockHolderID').val()) +  '</td>' + 
                '<td>' + $('[name=Notes]').val() +  ' </td>' + 
                '<td>'
                    +'<button name="EditHolderDrawal_' + id + '" class="btn btn-flat btn-info btn-sm EditHolderDrawal">تعديل</button>'
                    + ' '
                    +'<button name="DelHolderDrawal_' + id + '" class="btn btn-flat btn-danger btn-sm RmvHolderDrawal">حذف</button>'+
                '</td>' +
            '</tr>'

    var index =  t.row.add( $(text) ).draw();

}
/*
* Delete Bank ID By Bank Id
* @param Bank ID gets from Spliting On click
* */
holderdrawals.prototype.DeleteHolderDrawal = function(TransID){
    $.ajax({
        url: "holderdrawal/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            holderdrawals.prototype.deleterow(TransID,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
holderdrawals.prototype.EditHolderDrawal = function(row ,TransID ){


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

                	cntl.html('<input name="Mount" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control only_float" />');

                    break;
                case 3 :
                    // console.log(cntl.attr('data-val'));
                    // console.log(cntl);
                    var cboStockHolderID = $( "#cboStockHolderID" ).clone();

                    $(cboStockHolderID).attr('id', 'cboStockHolderID_' + TransID);
                    $(cboStockHolderID).val(cntl.attr('data-val'));
                    cntl.html('');
                    $(cboStockHolderID).appendTo(cntl);

                    break;
                case 4 :

                    cntl.html('<input name="Notes" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');


                    break;
                case 5 :

                    cntl.html(
                         '<button name="UpdateHolderDrawal_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdateHolderDrawal">حفظ</button>'
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
holderdrawals.prototype.UpdateHolderDrawal = function(TransID ,data){

console.log(data)
    $.ajax({
        url: "holderdrawal/" + TransID ,
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
                '<td> ' + output.data.TransDate +  ' </td>' + 
                '<td> ' + output.data.Mount +  ' </td>' + 
                '<td data-val="' + output.data.StockHolderID + '"> ' + getStockHolderName(output.data.StockHolderID) +  ' </td>' + 
                '<td> ' + output.data.Notes +  ' </td>' + 
                '<td>'
                    +'<button name="EditHolderDrawal_' + TransID + '" class="btn btn-flat btn-info btn-sm EditHolderDrawal">تعديل</button>'
                    + ' '
                    +'<button name="DelHolderDrawal_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvHolderDrawal">حذف</button>'+
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
holderdrawals.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-HolderDrawals').DataTable();
    var index =  t.row(crow.row).remove().draw();

}



$(function(){ _holderdrawal = new holderdrawals(); });

$(document).ready(function() {


    crow = {};
    $("#tbl-HolderDrawals").dataTable();

    $('#add-HolderDrawal').click(function(){
        _holderdrawal.postholderdrawal();
             $("#add-HolderDrawal").prop("disabled",true);
    });

    $('body').on('click','.RmvHolderDrawal' , function(){

        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _holderdrawal.DeleteHolderDrawal(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditHolderDrawal' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _holderdrawal.EditHolderDrawal(row ,name[1]);

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
    * update spicifc holderdrawals
    * */
    $('body').on('click','.UpdateHolderDrawal' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _holderdrawal.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _holderdrawal.UpdateHolderDrawal(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })


    $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        });
   
    
});



    function getStockHolderName(StockHolderID)
    {
        var cboStockHolderID = $( "#cboStockHolderID" ).clone();
        $(cboStockHolderID).val(StockHolderID);

        return $('option:selected',cboStockHolderID).text() ; 
    }


    function strFormatDate (_Date){
        var d = new Date(_Date);
        var curr_date = d.getDate();
        var curr_month = d.getMonth() + 1;
        var curr_year = d.getFullYear(curr_year);
        return curr_date + "/" + curr_month + "/" + curr_year;
    };

	$(document).ready(function(){

		$(".datepicker").datepicker('setDate', new Date());

});

 $(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-HolderDrawal").prop("disabled",false);
});
});


