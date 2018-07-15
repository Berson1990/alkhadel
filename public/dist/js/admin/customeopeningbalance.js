//Define Banks Class
var customeropeningbalance = function () {};

/*
* Validate after Add new Bank
* check Bank Name is required
* check Bank Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
var x=0;
var deptText=0;
customeropeningbalance.prototype.Validate = function(frm){

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

    if (! data.Debt ) {
        console.log(data);
        errors.push(config2.required_debt);

    }

    if (! data.CustomID ) {
        errors.push(config1.required_customid);
    }
    else if (data.CustomerID == 0)
    {
        errors.push(config2.required_customid);
    }


//
//    if (! data.Notes ) {
//
//        errors.push(config1.required_notes);
//
//    }
    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

var b=0;
// load data



 $("document").ready(function(){

    // $('#tbl-customeropeningbalance').DataTable();

    $("#cboCustomID").select2({       
        placeholder: "Search for an Custom Name",
        ajax: {
            url: 'autocomplete',
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type : 'post',
            data: function (params) {
                var queryParameters = {
                    CustomName: params.term
                }
                return queryParameters;
            },
            processResults: function (output) {
                if (output.status){
                    return {
                        results: $.map(output.data, function (item) {
                            return {
                                text: item.CustomName,
                                id: item.CustomID
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

customeropeningbalance.prototype.postcustomeropeningbalance = function(){


    var errors = this.Validate($('#customopeningbalance-form :input').serializeArray());

     x=$('#customopeningbalance-form :input');
             console.log(x[3].checked);//maden
             console.log(x[4].checked);//da2en


             if(x[3].checked==true){deptText="مدين";}
             else{deptText="دائن";}


             console.log(deptText);
    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{
            
        $.ajax({
            url: "customopeningbalance" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#customopeningbalance-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    customeropeningbalance.prototype.addnewrow(output.id);
                    $('#customopeningbalance-form [name=Mount]', $('.box-success')).val('').focus();
                    $('#customopeningbalance-form cboCustomID', $('.box-success')).val(0);
                    $('#customopeningbalance-form cboCustomID', $('.box-success')).trigger("chosen:updated");
                    $('#customopeningbalance-form [name=Notes]', $('.box-success')).val('').focus();
                    // $('#customeropeningbalance-form [name=Debt]', $('.box-success')).val('').focus();
                    $('#customopeningbalance-form [name=TransDate]', $('.box-success')).val('').focus();
                
//	$(document).ready(function(){
		$(".datepicker").datepicker('setDate', new Date());

//});


  
                }
            })
            .error(function (data) {
                showError('',config1.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is Bank Id to assign in delete and Update (edit)
* */
customeropeningbalance.prototype.addnewrow = function(id){

    

  var t = $('#tbl-CustomOpeningBalance').DataTable();

     var cboCustomerID = $( "#customopeningbalance-form #cboCustomID" ).clone();

    text = '<tr><td></td>' +
                '<td>' + $('#customopeningbalance-form [name=TransDate]').val() +  '</td>' + 
                '<td>' + $('#customopeningbalance-form [name=Mount]').val() +  '</td>' + 
                '<td data-val="' + $('#customopeningbalance-form cboCustomID').val() + '"> ' + cboCustomerID.text() +  '</td>' + 
                '<td>' + $('#customopeningbalance-form [name=Notes]').val() +  '</td>' + 
                '<td>' + deptText +'</td>' + 
                '<td>'
                    +'<button name="EditCustomerOpeningBalance_' + id + '" class="btn btn-flat btn-info btn-sm EditCustomerOpeningBalance">تعديل</button>'
                    + ' '
                    +'<button name="DelCustomerOpeningBalance_' + id + '" class="btn btn-flat btn-danger btn-sm RmvCustomerOpeningBalance">حذف</button>'+
                '</td>' +
            '</tr>';

    var index =  t.row.add( $(text) ).draw();



}
/*
* Delete Bank ID By Bank Id
* @param Bank ID gets from Spliting On click
* */
customeropeningbalance.prototype.DeleteCustomerOpeningBalance = function(TransID){
    $.ajax({
        url: "customopeningbalance/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            customeropeningbalance.prototype.deleterow(TransID,output);
        })
        .error(function (data) {
            showError('',config1.con_error);
        });
}

/*
* Show edit row
* */
customeropeningbalance.prototype.EditCustomerOpeningBalance = function(row ,TransID ){


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
                    cntl.html('<select name="CustomID" style="width:100%" data-placeholder="' + cntl.text() + '" id="cboCustomIDedit" > </select>');
                    $(document).ready(function() {

$(" #cboCustomIDedit").select2({
  placeholder: "Search for an Custom Name",
        ajax: {
            url: 'autocomplete',
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type : 'post',
            data: function (params) {
                var queryParameters = {
                    CustomName: params.term
                }
                return queryParameters;
            },
            processResults: function (output) {
                if (output.status){
                    return {
                        results: $.map(output.data, function (item) {
                            return {
                                text: item.CustomName,
                                id: item.CustomID
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

                   
                   
                    cntl.html('<input class="radio-inline dept" id="Debit"  type="radio" name="Debt" data-title="مدين" value="1"  />'+'<label class="radio-inline" id="Debit_btn" >مدين</label>'+'</br> '+'<input class="radio-inline" id="Creditor"  type="radio" name="Debt" data-title="مدين" value="0"  />'+'  '+'<label class="radio-inline" id="Creditor_btn" >دائن</label>');

                    break;

                case 6 :

                    cntl.html(
                         '<button name="UpdateCustomerOpeningBalance_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdateCustomerOpeningBalance">حفظ</button>'
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
customeropeningbalance.prototype.UpdateCustomerOpeningBalance = function(TransID ,data){

console.log(data)
    $.ajax({
        url: "customopeningbalance/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
            var temp = null ;

            if (output.status){
                console.log(output);
                var Debt=0;
                if(output.data.Debt==1){Debt="مدين";}
                else {Debt="دائن";}
                var cboCustomerID = $( "#cboCustomIDedit" ).clone();
                crow['row'].html(
                '<td></td>' +
                '<td> ' + output.data.TransDate +  ' </td>' + 
                '<td> ' + output.data.Mount +  ' </td>' + 
                '<td data-val="' + output.data.CustomerID + '"> ' +  cboCustomerID.text()+  ' </td>' + 
                '<td> ' + output.data.Notes +  ' </td>' + 
                '<td> ' + Debt +  ' </td>' + 
                '<td>'
                    +'<button name="EditCustomerOpeningBalance_' + TransID + '" class="btn btn-flat btn-info btn-sm EditCustomerOpeningBalance">تعديل</button>'
                    + ' '
                    +'<button name="DelCustomerOpeningBalance_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvCustomerOpeningBalance">حذف</button>'+
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
            showError('',config1.con_error);
        });

}

/*
* Delete Current Row ANd Hide then remove
* @param id Bank ID
* @param output response from server
* */
customeropeningbalance.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-CustomOpeningBalance').DataTable();
    var index =  t.row(crow.row).remove().draw();

}



$(function(){ _customeropeningbalance = new customeropeningbalance(); });

$(document).ready(function() {


 $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())

        });
	
	
	
	
	

    crow = {};
    // $("#tbl-customeropeningbalance").dataTable();

    $('#add-CustomOpeningBalance').click(function(){
        // alert("aaaaaaaaaaaaa");
//          $(this).prop("disabled",true );
        _customeropeningbalance.postcustomeropeningbalance();

    });

    $('body').on('click','.RmvCustomerOpeningBalance' , function(){

        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _customeropeningbalance.DeleteCustomerOpeningBalance(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditCustomerOpeningBalance' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _customeropeningbalance.EditCustomerOpeningBalance(row ,name[1]);

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
    * update spicifc customeropeningbalance
    * */
    $('body').on('click','.UpdateCustomerOpeningBalance' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _customeropeningbalance.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _customeropeningbalance.UpdateCustomerOpeningBalance(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })


});



    function getCustomerName(CustomerID)
    {
        var cboCustomerID = $( "#cboCustomerID" ).clone();
        $(cboCustomerID).val(CustomerID);
        return $('option:selected',cboCustomerID).text() ; 
    }


    function strFormatDate (_Date)
    {
        var d = new Date(_Date);
        var curr_date = d.getDate();
        var curr_month = d.getMonth() + 1;
        var curr_year = d.getFullYear(curr_year);
        return curr_date + "/" + curr_month + "/" + curr_year;
    }

//$(document).ready(function){





/* http://keith-wood.name/datepick.html
   Arabic localisation for jQuery Datepicker.
   Mahmoud Khaled -- mahmoud.khaled@badrit.com
   NOTE: monthNames are the new months names */

//});


// $(document).ready(function() { 
//$(':input').keypress(function () { 
////   alert("ayyy")
//     $("#add-CustomerOpeningBalance").prop("disabled",false);
//});
//});