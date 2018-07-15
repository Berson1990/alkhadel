//Define Banks Class
var suppliersdiscount = function () {};

/*
* Validate after Add new Bank
* check Bank Name is required
* check Bank Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
suppliersdiscount.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];
    if (! data.TransDate ) {

        errors.push(config2.required_transdate);

    }
    if (! data.Mount ) {

        errors.push(config2.required_mount);

    }

    if (! data.SupplierID ) {
        errors.push(config2.required_supplierid);
    }
    else if (data.SupplierID == 0)
    {
        errors.push(config2.required_supplierid);
    }


//
//    if (! data.Notes ) {
//
//        errors.push(config2.required_notes);
//
//    }
    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

$(document).ready(function() {
$("#supplierdiscount-form  #cboSupplierID").select2({
  placeholder: " ",
	  ajax: {
                url: 'supplierautocomplete',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                type : 'post',
                data: function (params) {
                    var queryParameters = {
                        SupplierName: params.term
                    }
                    return queryParameters;
                },
                processResults: function (output) {
                    if (output.status){
                        return {
                            results: $.map(output.data, function (item) {
                                return {
                                    text: item.SupplierName,
                                    id: item.SupplierID,
                                    comm : item.SupplierCommision ,
                                    suptype : item.SupplierType
                                }
                            })
                        };
                    }else{
                        return {
                            results: $.map(output.data, function (item) {
                                return {
                                    text: item.message,
                                    id: item.id
                                }
                            })
                        };
                    }

                }
            }
});
});


suppliersdiscount.prototype.postsupplierdiscount = function(){


    var errors = this.Validate($('#supplierdiscount-form :input').serializeArray());

    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "suppliersdiscount" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#supplierdiscount-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    suppliersdiscount.prototype.addnewrow(output.id);
                    $('#supplierdiscount-form [name=Mount]', $('.box-success')).val('').focus();
                    $('#supplierdiscount-form #cboSupplierID', $('.box-success')).val(0);
                    $('#supplierdiscount-form #cboSupplierID', $('.box-success')).trigger("chosen:updated");
                    $('#supplierdiscount-form [name=Notes]', $('.box-success')).val('').focus();
                    $('#supplierdiscount-form [name=TransDate]', $('.box-success')).val('').focus();
					$(".datepicker").datepicker('setDate', new Date());
                }
            })
            .error(function (data) {
                showError('',config2.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is Bank Id to assign in delete and Update (edit)
* */
suppliersdiscount.prototype.addnewrow = function(id){

    var t = $('#tbl-SuppliersDiscount').DataTable();

 var cboSupplierID = $( "#supplierdiscount-form #cboSupplierID" ).clone();

    text = '<tr><td></td>' +
                '<td>' + $('#supplierdiscount-form [name=TransDate]').val() +  '</td>' + 
                '<td>' + $('#supplierdiscount-form [name=Mount]').val() +  '</td>' + 
                '<td data-val="' + $('#supplierdiscount-form #cboSupplierID').val() + '">' + cboSupplierID.text() +  '</td>' + 
                '<td>' + $('#supplierdiscount-form [name=Notes]').val() +  '</td>' + 
                '<td>'
                    +'<button name="EditSupplierDiscount_' + id + '" class="btn btn-flat btn-info btn-sm EditSupplierDiscount">تعديل</button>'
                    + ' '
                    +'<button name="DelSupplierDIscount_' + id + '" class="btn btn-flat btn-danger btn-sm RmvSupplierDiscount">حذف</button>'+
                '</td>' +
            '</tr>'

    var index =  t.row.add( $(text) ).draw();

}
/*
* Delete Bank ID By Bank Id
* @param Bank ID gets from Spliting On click
* */
suppliersdiscount.prototype.DeleteSupplierDiscount = function(TransID){
    $.ajax({
        url: "suppliersdiscount/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            suppliersdiscount.prototype.deleterow(TransID,output);
        })
        .error(function (data) {
            showError('',config2.con_error);
        });
}

/*
* Show edit row
* */
suppliersdiscount.prototype.EditSupplierDiscount = function(row ,TransID ){


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
         
                            cntl.html('<select name="SupplierID" style="width:100%" data-placeholder="' + cntl.text() + '" id="cboSupplierIDedit6" > </select>');
         $(document).ready(function() {
        $("#cboSupplierIDedit6").select2({
          placeholder: " ",
              ajax: {
                        url: 'supplierautocomplete',
                        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                        type : 'post',
                        data: function (params) {
                            var queryParameters = {
                                SupplierName: params.term
                            }
                            return queryParameters;
                        },
                        processResults: function (output) {
                            if (output.status){
                                return {
                                    results: $.map(output.data, function (item) {
                                        return {
                                            text: item.SupplierName,
                                            id: item.SupplierID,
                                            comm : item.SupplierCommision ,
                                            suptype : item.SupplierType
                                        }
                                    })
                                };
                            }else{
                                return {
                                    results: $.map(output.data, function (item) {
                                        return {
                                            text: item.message,
                                            id: item.id
                                        }
                                    })
                                };
                            }

                        }
                    }
        });

        });



                    break;
                case 4 :

                    cntl.html('<input name="Notes" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');


                    break;
                case 5 :

                    cntl.html(
                         '<button name="UpdateSupplierDiscount_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdateSupplierDiscount">حفظ</button>'
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
suppliersdiscount.prototype.UpdateSupplierDiscount = function(TransID ,data){

console.log(data)
    $.ajax({
        url: "suppliersdiscount/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
            var temp = null ;
            if (output.status){
                 var cboSupplierID = $( " #cboSupplierIDedit6" ).clone();

                crow['row'].html(
                '<td></td>' +
                '<td> ' + output.data.TransDate +  ' </td>' + 
                '<td> ' + output.data.Mount +  ' </td>' + 
                '<td data-val="' + output.data.SupplierID + '"> ' + cboSupplierID.text() +  ' </td>' + 
                '<td> ' + output.data.Notes +  ' </td>' + 
                '<td>'
                    +'<button name="EditSupplierDiscount_' + TransID + '" class="btn btn-flat btn-info btn-sm EditSupplierDiscount">تعديل</button>'
                    + ' '
                    +'<button name="DelSupplierDiscount_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvSupplierDiscount">حذف</button>'+
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
            showError('',config2.con_error);
        });

}

/*
* Delete Current Row ANd Hide then remove
* @param id Bank ID
* @param output response from server
* */
suppliersdiscount.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-SuppliersDiscount').DataTable();
    var index =  t.row(crow.row).remove().draw();

}



$(function(){ _supplierdiscount = new suppliersdiscount(); });

$(document).ready(function() {


    crow = {};
    $("#tbl-SuppliersDiscount").dataTable();

    $('#add-SupplierDiscount').click(function(){
          $(this).prop("disabled",true);
        _supplierdiscount.postsupplierdiscount();

    });

    $('body').on('click','.RmvSupplierDiscount' , function(){

        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _supplierdiscount.DeleteSupplierDiscount(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditSupplierDiscount' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _supplierdiscount.EditSupplierDiscount(row ,name[1]);

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
    * update spicifc suppliersdiscount
    * */
    $('body').on('click','.UpdateSupplierDiscount' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _supplierdiscount.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _supplierdiscount.UpdateSupplierDiscount(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })


    $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        });
        //$( ".datepicker" ).datepicker("setDate", new Date());
    
});



    function getSupplierName(SupplierID)
    {
        var cboSupplierID = $( "#cboSupplierID" ).clone();
        $(cboSupplierID).val(SupplierID);

        return $('option:selected',cboSupplierID).text() ; 
    }


    function strFormatDate (_Date){
        var d = new Date(_Date);
        var curr_date = d.getDate();
        var curr_month = d.getMonth() + 1;
        var curr_year = d.getFullYear(curr_year);
        return curr_date + "/" + curr_month + "/" + curr_year;
    };

 $(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-SupplierDiscount").prop("disabled",false);
});
});