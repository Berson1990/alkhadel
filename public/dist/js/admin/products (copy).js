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
        data[frm[element]['name']]  = $.trim(frm[element]['value']);
    });

    var errors = [];
    if (! data.ProductName ) {

        errors.push('Product Name Cannot Set Empty');

    }
    if ( data.ProductType > 1 ) {

        errors.push('Please Select Type From Select Boxs');

    }
    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */
products.prototype.postproduct = function(){
    var errors = this.Validate($('#product-form :input').serializeArray());
    if (errors.length > 0){
        $('#Producterror').attr('class','container col-xs-3 form-control alert-danger')

        $('#Producterror').html('');

        $.each( errors, function( key, error ) {

            $('#Producterror').html($('#Producterror').html() + "* " + error + '<br/>' )

        });
    }else{

        $('#Producterror').removeClass('form-control alert-danger');
        $('#Producterror').html('');

        $.ajax({
            url: "product" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#product-form :input').serialize() ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){
                    $('#Producterror').removeClass('form-control alert-success')
                    $('#Producterror').addClass('form-control alert-danger')

                    $('#Producterror').html('');

                    $.each( output.message, function( key, value ) {

                        $('#Producterror').html($('#Producterror').html() + "* " + value + '<br/>' )

                    });

                }else{
                    $('#Producterror').removeClass('form-control alert-danger')
                    $('#Producterror').addClass('form-control alert-success');
                    $('#Producterror').html(output.message);
                    products.prototype.addnewrow(output.id);
                    $('[name=ProductName]').val('').focus();
                }
            })
            .error(function (data) {
                alert("Connection Error");
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
        '<button name="EditProduct_' + id + '" class="btn btn-flat btn-info btn-sm EditProduct">Edit</button>' +
        ' '+
        '<button name="DelProduct_' + id +'" class="btn btn-flat btn-danger btn-sm RmvProduct">Delete</button>'
    ] ).draw();

    $('#tbl-Products > tbody').find('tr:eq(' + index[0][0] + ')').attr('id','tr_' + id);


    console.log( $('#tbl-Products > tbody').find('tr:eq(' + index[0][0] + ')') );



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
            alert("Connection Error");
        });

}

/*
* Show edit row
* */
products.prototype.EditProduct = function(Productid){
    console.log(Productid);
    $('#tr_' + Productid).find('td').each (function(key) {

        var cntl = $('#tr_'+ Productid +' td:eq( ' + key + ' )');
            switch (key){
                case 1 :

                    cntl.html('<input name="ProductName" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 2 :

                    var type = function(){
                        if ($('#tr_'+ Productid +' td:eq( ' + key + ' )').attr('data-val') == '1' ){
                            return {
                                local: '',
                                imported: 'checked'
                            }
                        }else{
                            return {
                                local: 'checked',
                                imported: '0'
                            }
                        }
                    };
                    cntl.html(
                        '<label class="radio-inline" for="rbtnProductType_' + Productid + '" >Local</label>'

                        +'<input class="radio-inline" id="rbtnProductType_' + Productid + '" type="radio" name="ProductType" data-title="Local" value="0" '+type().local+' />'

                        +'<label class="radio-inline" for="rbtnProuductName_' + Productid + '" >Imported</label>'

                        +'<input class="radio-inline" id="rbtnProuductName_' + Productid + '" type="radio" name="ProductType" data-title="Imported" value="1" '+type().imported+' />'
                    );

                    break;
                case 3 :

                    cntl.html(
                         '<button name="UpdateProduct_' + Productid + '" class="btn btn-flat btn-success btn-sm UpdateProduct">Update</button>'
                        + ' '
                        +'<button name="CancelEdit_' + Productid + '" class="btn btn-flat btn-warning btn-sm CancelEdit">Cancel</button>'
                    );

                    break;
            }

    });


}
/*
* Updateing Product
* */
products.prototype.UpdateProduct = function(ProductId ,data){

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
                temp = output.data.ProductType < 1 ? 'Local' : 'Imported'
                $('#tr_' + ProductId).html(
                '<td></td>'
                    +'<td> ' + output.data.ProductName +  ' </td>'
                +'<td>' + temp + '</td>'
                +'<td>'
                    +'<button name="EditProduct_' + ProductId + '" class="btn btn-flat btn-info btn-sm EditProduct">Edit</button>'
                    + ' '
                    +'<button name="DelProduct_' + ProductId + '" class="btn btn-flat btn-danger btn-sm">Delete</button>'
                +'</td>'
                );
                alert(output.message);
            }else{
                temp = '';
                $.each( output.message, function( key, value ) {

                    temp += value + '\n';

                });
                alert(temp);
            }
        })
        .error(function (data) {
            alert("Connection Error");
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
        cls = 'container col-xs-3 form-control alert-danger';
    }else{
        cls = 'container col-xs-3 form-control alert-success';
    }
    $('#Producterror').removeClass()
    $('#Producterror').addClass(cls);
    $('#Producterror').html(output.message);
    $('#tr_' + id).hide('7000').queue(function(){$(this).remove();});
}

$(function(){ _product = new products(); });

$(document).ready(function() {
    var crow = {};
    $("#tbl-Products").dataTable();

    $('#add-Product').click(function(){

        _product.postproduct();

    });

    $('body').on('click','.RmvProduct' , function(){
        var name = this.name ;
        name = name.split('_');

        _product.DeleteProduct(name[1]);

    });

    $('body').on('click','.EditProduct' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        _product.EditProduct(name[1]);
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
        var errors =  _product.Validate($('#tr_' + name[1] + ' :input').serializeArray());
        if (errors.length > 0){
            var error = '';
            $.each( errors, function( key, value ) {

                error += value + '\n' ;

            });
            alert(error);
        }else{
            _product.UpdateProduct(name[1] ,$('#tr_' + name[1] + ' :input').serialize() );
        }
    })
});