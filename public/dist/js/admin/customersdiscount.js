//Define Banks Class
var customersdiscount = function () {};

/*
* Validate after Add new Bank
* check Bank Name is required
* check Bank Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
customersdiscount.prototype.Validate = function(frm){

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

    if (! data.CustomerID ) {
        errors.push(config2.required_customerid);
    }
    else if (data.CustomerID == 0)
    {
        errors.push(config2.required_customerid);
    }


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

//load data 
 $(document).ready(function(){
     $("#customerdiscount-form #cboCustomerID").select2({
            placeholder: "Search for an Customer Name",
            ajax: {
                url: 'autocompleteCustomer',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                type : 'post',
                data: function (params) {
                    var queryParameters = {
                        CustomerName: params.term
                    }
                    return queryParameters;
                },
                processResults: function (output) {
                    if (output.status){
                        return {
                            results: $.map(output.data, function (item) {
                                return {
                                    text: item.CustomerName,
                                    id: item.CustomerID,
                                    CustType : item.CustomerType
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

customersdiscount.prototype.postcustomerdiscount = function(){


    var errors = this.Validate($('#customerdiscount-form :input').serializeArray());

    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "customersdiscount" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#customerdiscount-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
            
        console.log(output);
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    customersdiscount.prototype.addnewrow(output.id);
                    $('#customerdiscount-form [name=Mount]', $('.box-success')).val('').focus();
                    $('#customerdiscount-form #cboCustomerID', $('.box-success')).val(0);
                    $('#customerdiscount-form #cboCustomerID', $('.box-success')).trigger("chosen:updated");
                    $('#customerdiscount-form [name=Notes]', $('.box-success')).val('').focus();
                    $('#customerdiscount-form [name=TransDate]', $('.box-success')).val('').focus();
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
customersdiscount.prototype.addnewrow = function(id){
        

        var cboCustomerID = $( "#customerdiscount-form #cboCustomerID" ).clone();

        $(cboCustomerID).val("#cboCustomerID");
        var cust= $('option:selected',cboCustomerID).text();
       

    var t = $('#tbl-CustomersDiscount').DataTable();

    text = '<tr><td></td>' +
                '<td>' + $('#customerdiscount-form [name=TransDate]').val() +  '</td>' + 
                '<td>' + $('#customerdiscount-form [name=Mount]').val() +  '</td>' + 
                '<td data-val="' + $('#customerdiscount-form #cboCustomerID').val() + '">' + cboCustomerID.text() +  '</td>' + 
                '<td>' + $('#customerdiscount-form [name=Notes]').val() +  '</td>' + 
                '<td>'
                    +'<button name="EditCustomerDiscount_' + id + '" class="btn btn-flat btn-info btn-sm EditCustomerDiscount">تعديل</button>'
                    + ' '
                    +'<button name="DelCustomerDiscount_' + id + '" class="btn btn-flat btn-danger btn-sm RmvCustomerDiscount">حذف</button>'+
                '</td>' +
            '</tr>'

    var index =  t.row.add( $(text) ).draw();

}
/*
* Delete Bank ID By Bank Id
* @param Bank ID gets from Spliting On click
* */
customersdiscount.prototype.DeleteCustomerDiscount = function(TransID){
    $.ajax({
        url: "customersdiscount/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            customersdiscount.prototype.deleterow(TransID,output);
        })
        .error(function (data) {
            showError('',config2.con_error);
        });
}

/*
* Show edit row
* */
customersdiscount.prototype.EditCustomerDiscount = function(row ,TransID ){


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
                  var cboCustomerID = $( "#cboCustomerID" ).clone();
                        
                        cntl.html( '<select name="CustomerID" class="custdisc" style="width:100%" data-placeholder="اسم العميل"id="cboCustomerIDedit" ></select>' );
                       $(document).ready(function(){
                        $("#cboCustomerIDedit").select2({ placeholder: "Search for an Customer Name",
            ajax: {
                url: 'autocompleteCustomer',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                type : 'post',
                data: function (params) {
                    var queryParameters = {
                        CustomerName: params.term
                    }
                    return queryParameters;
                },
                processResults: function (output) {
                    if (output.status){
                        return {
                            results: $.map(output.data, function (item) {
                                return {
                                    text: item.CustomerName,
                                    id: item.CustomerID,
                                    CustType : item.CustomerType
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
            } });
                    });
                    $(cboCustomerID).appendTo(cntl);

                    break;
                case 4 :

                    cntl.html('<input name="Notes" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');


                    break;
                case 5 :

                    cntl.html(
                         '<button name="UpdateCustomerDiscount_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdateCustomerDiscount">حفظ</button>'
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
customersdiscount.prototype.UpdateCustomerDiscount = function(TransID ,data){

console.log(data)
    $.ajax({
        url: "customersdiscount/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
            var temp = null ;
            if (output.status){

                var cboCustomerID = $( "#cboCustomerIDedit" ).clone();
                 $(cboCustomerID).val("#cboCustomerIDedit");
       


                crow['row'].html(
                '<td></td>' +
                '<td> ' + output.data.TransDate +  ' </td>' + 
                '<td> ' + output.data.Mount +  ' </td>' + 
                '<td data-val="' + output.data.CustomerID + '"> ' + cboCustomerID.text()+  ' </td>' + 
                '<td> ' + output.data.Notes +  ' </td>' + 
                '<td>'
                    +'<button name="EditCustomerDiscount_' + TransID + '" class="btn btn-flat btn-info btn-sm EditCustomerDiscount">تعديل</button>'
                    + ' '
                    +'<button name="DelCustomerDiscount_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvCustomerDiscount">حذف</button>'+
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
customersdiscount.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-CustomersDiscount').DataTable();
    var index =  t.row(crow.row).remove().draw();

}



$(function(){ _customerdiscount = new customersdiscount(); });

$(document).ready(function() {


    crow = {};
   $("#tbl-CustomersDiscount").dataTable();

    $('#add-CustomerDiscount').click(function(){
        _customerdiscount.postcustomerdiscount();
              $(this).prop("disabled",true);
    });

    $('body').on('click','.RmvCustomerDiscount' , function(){

        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _customerdiscount.DeleteCustomerDiscount(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditCustomerDiscount' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _customerdiscount.EditCustomerDiscount(row ,name[1]);

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
    * update spicifc customersdiscount
    * */
    $('body').on('click','.UpdateCustomerDiscount' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _customerdiscount.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _customerdiscount.UpdateCustomerDiscount(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })


    $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        });
        //$( ".datepicker" ).datepicker("setDate", new Date());
    
});



    function getCustomerName(CustomerID)
    {
        var cboCustomerID = $( "#customerdiscount-form #cboCustomerID" ).clone();
        $(cboCustomerID).val(CustomerID);
        return $('option:selected',cboCustomerID).text() ; 
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
     $("#add-CustomerDiscount").prop("disabled",false);
});
});