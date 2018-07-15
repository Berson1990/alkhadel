//Define Products Class
var products = function () {};

/*
* Validate after Add new Product
* check Product Name is required
* check Product Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
products.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];
    if (! data.ProductName ) {

    //      var langs = {{json_encode($js_config)}};
    // console.log(langs);
        // var config_ = config ;

        errors.push(config.required_productname);

    }
    if ( data.ProductType > 1 ) {

        errors.push(config.required_producttype);

    }
    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

products.prototype.postproduct = function(){
    var errors = this.Validate($('#product-form :input').serializeArray());
    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "product" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#product-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    products.prototype.addnewrow(output.id);
                    $('[name=ProductName]', $('.box-success')).val('').focus();
                }
            })
            .error(function (data) {
                showError('',config.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is Product Id to assign in delete and Update (edit)
* */
products.prototype.addnewrow = function(id){

    var t = $('#tbl-Products').DataTable();

    var index =  t.row.add( [
        '',
        $('[name=ProductName]').val(),
        $('[name=ProductType]:checked').attr('data-title'),
        '<button name="EditProduct_' + id + '" class="btn btn-flat btn-info btn-sm EditProduct">تعديل</button>' +
        ' '+
        '<button name="DelProduct_' + id +'" class="btn btn-flat btn-danger btn-sm RmvProduct">حذف</button>'
    ] ).draw();

    //console.log(t.rows().nodes);

    //data-val="'+ $('[name=ProductType]:checked').attr('data-val') // dont forget assign data-val in local td imported

    //$('[name^=DelProduct_' + id + ']').click(function(){products.prototype.DeleteProduct(id);});

}
/*
* Delete Product ID By Product Id
* @param Product ID gets from Spliting On click
* */
products.prototype.DeleteProduct = function(Productid){
    $.ajax({
        url: "product/" + Productid ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            products.prototype.deleterow(Productid,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
products.prototype.EditProduct = function(row ,Productid ){


            row.find('td').each (function(key) {

            var cntl = $(this).closest('tr').find('td').eq(key);

            switch (key){
                case 1 :

                    cntl.html('<input name="ProductName" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 2 :

                    if (cntl.text().trim() == config.export)
                    {
                        cntl.html(
                            '<label class="radio-inline" for="rbtnProductType_' + Productid + '" >'+config.local+'</label>'

                            +'<input class="radio-inline" id="rbtnProductType_' + Productid + '" type="radio" name="ProductType_' + Productid + '" data-title="Local" value="0"  />'

                            +'<label class="radio-inline" for="rbtnProductName_' + Productid + '" >'+config.export+'</label>'

                            +'<input class="radio-inline" id="rbtnProductName_' + Productid + '" type="radio" name="ProductType_' + Productid + '" data-title="Imported" value="1" checked />'
                        );
                    }
                    else if (cntl.text().trim() == config.local)
                    {
                        cntl.html(
                            '<label class="radio-inline" for="rbtnProductType_' + Productid + '" >'+config.local+'</label>'

                            +'<input class="radio-inline" id="rbtnProductType_' + Productid + '" type="radio" name="ProductType_' + Productid + '" data-title="Local" value="0"  checked />'

                            +'<label class="radio-inline" for="rbtnProductName_' + Productid + '" >'+config.export+'</label>'

                            +'<input class="radio-inline" id="rbtnProductName_' + Productid + '" type="radio" name="ProductType_' + Productid + '" data-title="Imported" value="1"  />'
                        );
                    }
                    else
                    {
                        cntl.html(
                            '<label class="radio-inline" for="rbtnProductType_' + Productid + '" >'+config.local+'</label>'

                            +'<input class="radio-inline" id="rbtnProductType_' + Productid + '" type="radio" name="ProductType_' + Productid + '" data-title="Local" value="0"  />'

                            +'<label class="radio-inline" for="rbtnProductName_' + Productid + '" >'+config.export+'</label>'

                            +'<input class="radio-inline" id="rbtnProductName_' + Productid + '" type="radio" name="ProductType_' + Productid + '" data-title="Imported" value="1"  />'
                        );
                    }

                    break;
                case 3 :

                    cntl.html(
                         '<button name="UpdateProduct_' + Productid + '" class="btn btn-flat btn-success btn-sm UpdateProduct">حفظ</button>'
                        + ' '
                        +'<button name="CancelEdit_' + Productid + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }

    });


}
/*
* Updateing Product
* */
products.prototype.UpdateProduct = function(ProductId ,data){

console.log(data)
    $.ajax({
        url: "product/" + ProductId ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
            var temp = null ;
            if (output.status){
                temp = output.data.ProductType < 1 ? 'محلى' : 'مستورد'
                crow['row'].html(
                '<td></td>'
                    +'<td>' + output.data.ProductName +  '</td>'
                +'<td>' + temp + '</td>'
                +'<td>'
                    +'<button name="EditProduct_' + ProductId + '" class="btn btn-flat btn-info btn-sm EditProduct">تعديل</button>'
                    + ' '
                    +'<button name="DelProduct_' + ProductId + '" class="btn btn-flat btn-danger btn-sm RmvProduct">حذف</button>'
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
* @param id Product ID
* @param output response from server
* */
products.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-Products').DataTable();
    var index =  t.row(crow.row).remove().draw();

}

$(function(){ _product = new products(); });

$(document).ready(function() {
    crow = {};
    $("#tbl-Products").dataTable();

    $('#add-Product').click(function(){
        //add by me 
    $("#add-Product").prop("disabled",true);
        _product.postproduct();

    });

    $('body').on('click','.RmvProduct' , function(){

        // if (confirm("Are you sure u Want Delete This Product?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _product.DeleteProduct(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditProduct' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _product.EditProduct(row ,name[1]);

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
    * update spicifc product
    * */
    $('body').on('click','.UpdateProduct' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _product.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _product.UpdateProduct(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })
});


//===========================handel el PAGE ==========================
$(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-Product").prop("disabled",false);
});
});
