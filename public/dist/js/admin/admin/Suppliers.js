//Define Suppliers Class
var suppliers = function () {};

/*
* Validate after Add new Supplier
* check Supplier Name is required
* check Supplier Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
suppliers.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];
    if (! data.SupplierName ) {
        errors.push(config.required_suppliername);
    }
    
//    if (! data.SupplierCommision ) {
//        errors.push(config.required_commission);
//    }
    
//    if (! data.Kalamia ) {
//        errors.push(config.required_kalamia);
//    }

    if ( data.SupplierType > 1 ) {

        errors.push(config.required_suppliertype);

    }

    if ( data.CollectType > 1 ) {

        errors.push(config.required_collecttype);

    }

    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

suppliers.prototype.postsupplier = function(){
//    alert("psotsupplier");
    var errors = this.Validate($('#supplier-form :input').serializeArray());
    console.log($('#supplier-form :input').serializeArray());
    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "supplier" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#supplier-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
            console.log(output);  

                if (!output.status){
                 console.log(output.status);  

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);
    
                }else{
                    console.log(output.status);   
                    msg_text = output.message;
                    showSuccess('',msg_text);

                    suppliers.prototype.addnewrow(output.id);
//                    console.log (suppliers.prototype.addnewrow);
                    $('#supplier-form [name=SupplierCommision]', $('.box-success')).val('');
                    $('#supplier-form [name=Kalamia]', $('.box-success')).val('');
                    $('#supplier-form [name=SupplierName]', $('.box-success')).val('').focus();
                }
             console.log( $('#supplier-form #SuppliersComm', $('.box-success')).val(''));
            })
            .error(function (data) {
                showError('',config.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is Supplier Id to assign in delete and Update (edit)
* */
suppliers.prototype.addnewrow = function(id){
//alert("add new row ");
    var t = $('#tbl-Suppliers').DataTable();

    var index =  t.row.add( [
        '',
        $('#supplier-form [name=SupplierName]').val(),
        $('#supplier-form [name=SupplierType]:checked').attr('data-title'),
        $('#supplier-form [name=CollectType]:checked').attr('data-title'),
        $('#supplier-form [name=SupplierCommision]').val(),
//        $('#supplier-form #SuppliersComm').val(),

        $('#supplier-form [name=Kalamia]').val(),
        '<button name="EditSupplier_' + id + '" class="btn btn-flat btn-info btn-sm EditSupplier">تعديل</button>' +
        ' '+
        '<button name="DelSupplier_' + id +'" class="btn btn-flat btn-danger btn-sm RmvSupplier">حذف</button>'
    ] ).draw();
console.log($('#supplier-form #SuppliersComm').val())
}
/*
* Delete Supplier ID By Supplier Id
* @param Supplier ID gets from Spliting On click
* */
suppliers.prototype.DeleteSupplier = function(Supplierid){
    $.ajax({
        url: "supplier/" + Supplierid ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            suppliers.prototype.deleterow(Supplierid,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
suppliers.prototype.EditSupplier = function(row ,Supplierid){


            row.find('td').each (function(key) {

            var cntl = $(this).closest('tr').find('td').eq(key);

            switch (key){
                case 1 :

                    cntl.html('<input name="SupplierName" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 2 :
                    if (cntl.text().trim() == config.suppliertypein)
                    {
                        cntl.html(
                            '<input class="radio-inline" id="rbtnSupplierTypeIn_' + Supplierid + '" type="radio" name="SupplierType_' + Supplierid + '" data-title="' + config.suppliertypein + '" value="0" checked />' +
                            '<label class="radio-inline" for="rbtnSupplierTypeIn_' + Supplierid + '" >'+config.suppliertypein+'</label>' +
                            ' <br /> ' +
                            '<input class="radio-inline" id="rbtnSupplierTypeOut_' + Supplierid + '" type="radio" name="SupplierType_' + Supplierid + '" data-title="' + config.suppliertypeout + '" value="1"  />' +
                            '<label class="radio-inline" for="rbtnSupplierTypeOut_' + Supplierid + '" >'+config.suppliertypeout+'</label>' 
                        );
                    }
                    else if (cntl.text().trim() == config.suppliertypeout)
                    {
                        cntl.html(
                            '<input class="radio-inline" id="rbtnSupplierTypeIn_' + Supplierid + '" type="radio" name="SupplierType_' + Supplierid + '" data-title="' + config.suppliertypein + '" value="0"  />' +
                            '<label class="radio-inline" for="rbtnSupplierTypeIn_' + Supplierid + '" >'+config.suppliertypein+'</label>' +
                            ' <br /> ' +
                            '<input class="radio-inline" id="rbtnSupplierTypeOut_' + Supplierid + '" type="radio" name="SupplierType_' + Supplierid + '" data-title="' + config.suppliertypeout + '" value="1" checked />' +
                            '<label class="radio-inline" for="rbtnSupplierTypeOut_' + Supplierid + '" >'+config.suppliertypeout+'</label>' 
                        );
                    }
                    else
                    {
                        cntl.html(
                            '<input class="radio-inline" id="rbtnSupplierTypeIn_' + Supplierid + '" type="radio" name="SupplierType_' + Supplierid + '" data-title="' + config.suppliertypein + '" value="0"  />' +
                            '<label class="radio-inline" for="rbtnSupplierTypeIn_' + Supplierid + '" >'+config.suppliertypein+'</label>' +
                            ' <br /> ' +
                            '<input class="radio-inline" id="rbtnSupplierTypeOut_' + Supplierid + '" type="radio" name="SupplierType_' + Supplierid + '" data-title="' + config.suppliertypeout + '" value="1" />' +
                            '<label class="radio-inline" for="rbtnSupplierTypeOut_' + Supplierid + '" >'+config.suppliertypeout+'</label>' 
                        );
                    }
                    
                    break;
                case 3 :
                    
                    if (cntl.text().trim() == config.collecttypenow)
                    {
                        cntl.html(
                            '<input class="radio-inline" id="rbtnCollectTypeNow_' + Supplierid + '" type="radio" name="CollectType_' + Supplierid + '" data-title="' + config.collecttypenow + '" value="0" checked />' +
                            '<label class="radio-inline" for="rbtnCollectTypeNow_' + Supplierid + '" >'+config.collecttypenow+'</label>' +
                            ' <br /> ' +
                            '<input class="radio-inline" id="rbtnCollectTypeAfter_' + Supplierid + '" type="radio" name="CollectType_' + Supplierid + '" data-title="' + config.collecttypeafter + '" value="1"  />' +
                            '<label class="radio-inline" for="rbtnCollectTypeAfter_' + Supplierid + '" >'+config.collecttypeafter+'</label>' 
                        );
                    }
                    else if (cntl.text().trim() == config.collecttypeafter)
                    {
                        cntl.html(
                            '<input class="radio-inline" id="rbtnCollectTypeNow_' + Supplierid + '" type="radio" name="CollectType_' + Supplierid + '" data-title="' + config.collecttypenow + '" value="0" />' +
                            '<label class="radio-inline" for="rbtnCollectTypeNow_' + Supplierid + '" >'+config.collecttypenow+'</label>' +
                            ' <br /> ' +
                            '<input class="radio-inline" id="rbtnCollectTypeAfter_' + Supplierid + '" type="radio" name="CollectType_' + Supplierid + '" data-title="' + config.collecttypeafter + '" value="1" checked  />' +
                            '<label class="radio-inline" for="rbtnCollectTypeAfter_' + Supplierid + '" >'+config.collecttypeafter+'</label>' 
                        );
                    }
                    else
                    {
                        cntl.html(
                            '<input class="radio-inline" id="rbtnCollectTypeNow_' + Supplierid + '" type="radio" name="CollectType_' + Supplierid + '" data-title="' + config.collecttypenow + '" value="0" />' +
                            '<label class="radio-inline" for="rbtnCollectTypeNow_' + Supplierid + '" >'+config.collecttypenow+'</label>' +
                            ' <br /> ' +
                            '<input class="radio-inline" id="rbtnCollectTypeAfter_' + Supplierid + '" type="radio" name="CollectType_' + Supplierid + '" data-title="' + config.collecttypeafter + '" value="1"  />' +
                            '<label class="radio-inline" for="rbtnCollectTypeAfter_' + Supplierid + '" >'+config.collecttypeafter+'</label>' 
                        );
                    }

                    break;
                case 4 :
                    
                    cntl.html('<input name="SupplierCommision" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control only_float" />');

                    break;
                case 5 :
                    
                    cntl.html('<input name="Kalamia" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control only_float" />');

                    break;
                case 6 :

                    cntl.html(
                         '<button name="UpdateSupplier_' + Supplierid + '" class="btn btn-flat btn-success btn-sm UpdateSupplier">حفظ</button>'
                        + ' '
                        +'<button name="CancelEdit_' + Supplierid + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }


    });


}
/*
* Updateing Supplier
* */
suppliers.prototype.UpdateSupplier = function(SupplierId ,data){
alert("Update Supplier");
    $.ajax({
        url: "supplier/" + SupplierId ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
            var temp = null ;
            var temp1 = null ;
            var temp2 = null ;
            if (output.status){
                 console.log(output);
                
                if(output.data.SupplierType == 0)  {temp1 = config.suppliertypein} else if (output.data.SupplierType == 1)  {temp1 = config.suppliertypeout} else {temp1 = ''} ;

                if(output.data.CollectType == 0)  {temp2 = config.collecttypenow} else if (output.data.CollectType == 1)  {temp2 = config.collecttypeafter} else {temp2 = ''} ;

                crow['row'].html(
                '<td></td>'
                +'<td>' + output.data.SupplierName +  '</td>'
                +'<td>' + temp1 +  '</td>'
                +'<td>' + temp2 +  '</td>'
                +'<td>' + output.data.SupplierCommision + '</td>' 
                   
                +'<td>' + output.data.Kalamia + '</td>'
                +'<td>'
                    +'<button name="EditSupplier_' + SupplierId + '" class="btn btn-flat btn-info btn-sm EditSupplier">تعديل</button>'
                    + ' '
                    +'<button name="DelSupplier_' + SupplierId + '" class="btn btn-flat btn-danger btn-sm RmvSupplier">حذف</button>'
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
* @param id Supplier ID
* @param output response from server
* */
suppliers.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-Suppliers').DataTable();
    var index =  t.row(crow.row).remove().draw();

}

$(function(){ _supplier = new suppliers(); });

$(document).ready(function() {
    crow = {};
    $("#tbl-Suppliers").dataTable();

    $('#add-Supplier').click(function(){
 $("#add-Supplier").prop("disabled",true);
        _supplier.postsupplier();

    });

    $('body').on('click','.RmvSupplier' , function(){

        // if (confirm("Are you sure u Want Delete This Supplier?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _supplier.DeleteSupplier(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditSupplier' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _supplier.EditSupplier(row ,name[1]);

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
    * update spicifc supplier
    * */
    $('body').on('click','.UpdateSupplier' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');
        
        var errors =  _supplier.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _supplier.UpdateSupplier(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })
});


$(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-Supplier").prop("disabled",false);
});
});


//=================when change out type supplier

//$("#rbtnSupplierTypeOut").on("click" ,function(){
//    alert("aeeeeaaa");
//
////$("#SuppliersComm").prop("disables",true)
//
//});

 froign_Suppliers =1;
function forignSuppliers() {
//alert("aeeeeaaa")
  $("#SuppliersComm").prop("disabled",true);  
$("#kalamia").prop("disabled",true);  
}
 
function localsuppliers() {
//alert("aeeeeaaa")
  $("#SuppliersComm").prop("disabled",false);  
  $("#kalamia").prop("disabled",false);  
}


//if(froign_Suppliers == 1)
//{
//
// alert("aeeeeaaa")
//}
//
//$('input:radio[name="SupplierType"]').checked(function(){
//        if ($(this).is(':checked') && $(this).val() == '1') {
//           alert("\0\\\0")
//        }
//    });

//$("#rbtnSupplierTypeOut").onclick(function() {
//
// alert("aeeeeaaa")
//
//});

    