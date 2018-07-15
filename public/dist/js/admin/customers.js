//Define Customers Class
var customers = function () {};

/*
* Validate after Add new Customer
* check Customer Name is required
* check Customer Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
customers.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];
    if (! data.CustomerName ) {

    //      var langs = {{json_encode($js_config)}};
    // console.log(langs);
        // var config_ = config ;

        errors.push(config.required_customername);

    }
    if ( data.CustomerType > 2 ) {

        errors.push(config.required_customertype);

    }
//    
//    if( $('[name=CustomerName]').val() == data.CustomerName  )
//    {
//           errors.push(" اسم العميل متواجد من قبل ");
//    }
    

    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

customers.prototype.postcustomer = function(){
    var errors = this.Validate($('#customer-form :input').serializeArray());
    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "customer" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#customer-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    customers.prototype.addnewrow(output.id);
                    $('[name=CustomerName]', $('.box-success')).val('').focus();
                }
            })
            .error(function (data) {
                showError('',config.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is Customer Id to assign in delete and Update (edit)
* */
customers.prototype.addnewrow = function(id){

    var t = $('#tbl-Customers').DataTable();

    var index =  t.row.add( [
        '',
        $('[name=CustomerName]').val(),
        $('[name=CustomerType]:checked').attr('data-title'),
        '<button name="EditCustomer_' + id + '" class="btn btn-flat btn-info btn-sm EditCustomer">تعديل</button>' +
        ' '+
        '<button name="DelCustomer_' + id +'" class="btn btn-flat btn-danger btn-sm RmvCustomer">حذف</button>'
    ] ).draw();

    //console.log(t.rows().nodes);

    //data-val="'+ $('[name=CustomerType]:checked').attr('data-val') // dont forget assign data-val in local td imported

    //$('[name^=DelCustomer_' + id + ']').click(function(){customers.prototype.DeleteCustomer(id);});

}
/*
* Delete Customer ID By Customer Id
* @param Customer ID gets from Spliting On click
* */
customers.prototype.DeleteCustomer = function(Customerid){
    $.ajax({
        url: "customer/" + Customerid ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            customers.prototype.deleterow(Customerid,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
customers.prototype.EditCustomer = function(row ,Customerid ){


            row.find('td').each (function(key) {

            var cntl = $(this).closest('tr').find('td').eq(key);

            switch (key){
                case 1 :

                    cntl.html('<input name="CustomerName" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 2 :

                    if (cntl.text().trim() == config.local)
                    {
                        cntl.html(

                            '<input class="radio-inline" id="rbtnCustomerType_' + Customerid + '" type="radio" name="CustomerType_' + Customerid + '" data-title="محلى" value="0" checked />' +
                            '<label class="radio-inline" for="rbtnCustomerType_' + Customerid + '" >&nbsp; &nbsp; '+config.local+'</label>' + '<br>' +

                            '<input class="radio-inline" id="rbtnCustomerName_' + Customerid + '" type="radio" name="CustomerType_' + Customerid + '" data-title="سفـــر" value="1"  />' +
                            '<label class="radio-inline" for="rbtnCustomerName_' + Customerid + '" >&nbsp; &nbsp; '+config.travel+'</label>' + '<br>' +

                            '<input class="radio-inline" id="rbtnUCustomerName_' + Customerid + '" type="radio" name="CustomerType_' + Customerid + '" data-title="صعيــد" value="2" />' +
                            '<label class="radio-inline" for="rbtnUCustomerName_' + Customerid + '" >&nbsp; &nbsp; '+config.upperegypt+'</label>' + '<br>'

                            
                        );
                    }
                    else if (cntl.text().trim() == config.travel)
                    {
                        cntl.html(
                            '<input class="radio-inline" id="rbtnCustomerType_' + Customerid + '" type="radio" name="CustomerType_' + Customerid + '" data-title="محلى" value="0"  />' +
                            '<label class="radio-inline" for="rbtnCustomerType_' + Customerid + '" >&nbsp; &nbsp; '+config.local+'</label>' +  '<br>' +

                            '<input class="radio-inline" id="rbtnCustomerName_' + Customerid + '" type="radio" name="CustomerType_' + Customerid + '" data-title="سفـــر" value="1" checked />' +
                            '<label class="radio-inline" for="rbtnCustomerName_' + Customerid + '" >&nbsp; &nbsp; '+config.travel+'</label>' + '<br>' +

                            '<input class="radio-inline" id="rbtnUCustomerName_' + Customerid + '" type="radio" name="CustomerType_' + Customerid + '" data-title="صعيــد" value="2" />' +
                            '<label class="radio-inline" for="rbtnUCustomerName_' + Customerid + '" >&nbsp; &nbsp; '+config.upperegypt+'</label>'+ '<br>'
                        );
                    }
                    else if (cntl.text().trim() == config.upperegypt)
                    {
                        cntl.html(
                            '<input class="radio-inline" id="rbtnCustomerType_' + Customerid + '" type="radio" name="CustomerType_' + Customerid + '" data-title="محلى" value="0"  />' +
                            '<label class="radio-inline" for="rbtnCustomerType_' + Customerid + '" >&nbsp; &nbsp; '+config.local+'</label>' + '<br>' +

                            '<input class="radio-inline" id="rbtnCustomerName_' + Customerid + '" type="radio" name="CustomerType_' + Customerid + '" data-title="سفـــر" value="1"  />' +
                            '<label class="radio-inline" for="rbtnCustomerName_' + Customerid + '" >&nbsp; &nbsp; '+config.travel+'</label>' + '<br>' +

                            '<input class="radio-inline" id="rbtnUCustomerName_' + Customerid + '" type="radio" name="CustomerType_' + Customerid + '" data-title="صعيــد" value="2" checked />' +
                            '<label class="radio-inline" for="rbtnUCustomerName_' + Customerid + '" >&nbsp; &nbsp; '+config.upperegypt+'</label>' +  '<br>'
                        );
                    }
                    else
                    {
                        cntl.html(
                            '<input class="radio-inline" id="rbtnCustomerType_' + Customerid + '" type="radio" name="CustomerType_' + Customerid + '" data-title="محلى" value="0"  />' +
                            '<label class="radio-inline" for="rbtnCustomerType_' + Customerid + '" >&nbsp; &nbsp; '+config.local+'</label>' + '<br>'+

                            '<input class="radio-inline" id="rbtnCustomerName_' + Customerid + '" type="radio" name="CustomerType_' + Customerid + '" data-title="سفـــر" value="1"  />' +
                            '<label class="radio-inline" for="rbtnCustomerName_' + Customerid + '" >&nbsp; &nbsp; '+config.travel+'</label>' + '<br>' +

                            '<input class="radio-inline" id="rbtnUCustomerName_' + Customerid + '" type="radio" name="CustomerType_' + Customerid + '" data-title="صعيــد" value="2" />' +
                            '<label class="radio-inline" for="rbtnUCustomerName_' + Customerid + '" >&nbsp; &nbsp; '+config.upperegypt+'</label>' +  '<br>'
                        );
                    }

                    break;
                case 3 :

                    cntl.html(
                         '<button name="UpdateCustomer_' + Customerid + '" class="btn btn-flat btn-success btn-sm UpdateCustomer">حفظ</button>'
                        + ' '
                        +'<button name="CancelEdit_' + Customerid + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }

    });


}
/*
* Updateing Customer
* */
customers.prototype.UpdateCustomer = function(CustomerId ,data){

    $.ajax({
        url: "customer/" + CustomerId ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
            var temp = null ;
            if (output.status){

                if(output.data.CustomerType == 0)  {temp = 'محلى'} else if (output.data.CustomerType == 1)  {temp = 'سفر'} else if (output.data.CustomerType == 2) {temp = 'صعيد'} else {temp = ''} ;

                crow['row'].html(
                '<td></td>'
                    +'<td>' + output.data.CustomerName +  '</td>'
                +'<td>' + temp + '</td>'
                +'<td>'
                    +'<button name="EditCustomer_' + CustomerId + '" class="btn btn-flat btn-info btn-sm EditCustomer">تعديل</button>'
                    + ' '
                    +'<button name="DelCustomer_' + CustomerId + '" class="btn btn-flat btn-danger btn-sm RmvCustomer">حذف</button>'
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
* @param id Customer ID
* @param output response from server
* */
customers.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-Customers').DataTable();
    var index =  t.row(crow.row).remove().draw();

}

$(function(){ _customer = new customers(); });

$(document).ready(function() {
    crow = {};
    $("#tbl-Customers").dataTable();

    $('#add-Customer').click(function(){
$("#add-Customer").prop("disabled",true);
        _customer.postcustomer();

    });

    $('body').on('click','.RmvCustomer' , function(){

        // if (confirm("Are you sure u Want Delete This Customer?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _customer.DeleteCustomer(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditCustomer' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _customer.EditCustomer(row ,name[1]);

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
    * update spicifc customer
    * */
    $('body').on('click','.UpdateCustomer' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _customer.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _customer.UpdateCustomer(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })
});

$(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-Customer").prop("disabled",false);
});
});
