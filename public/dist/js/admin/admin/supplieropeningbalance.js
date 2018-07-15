//Define Banks Class
var supplieropeningbalance = function () {};

/*
* Validate after Add new Bank
* check Bank Name is required
* check Bank Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
var x=0;
var deptText=0;
supplieropeningbalance.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);
		console.log( data);
    });

    var errors = [];
    if (! data.TransDate ) {

        errors.push(config1.required_transdate);

    }
    if (! data.Mount ) {

        errors.push(config1.required_mount);

    }

    if (! data.Debt ) {
        console.log(data);
        errors.push(config1.required_debt);

    }

    if (! data.SupplierID ) {
        errors.push(config1.required_supplierid);
    }
    else if (data.SupplierID == 0)
    {
        errors.push(config1.required_supplierid);
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

 $(document).ready(function() {
var g = $('#tbl-SupplierOpeningBalance').DataTable();

});
 $(document).ready(function() {
// b= $('#tbl-SupplierOpeningBalance').DataTable();

$("#supplieropeningbalance-form #cboSupplierID").select2({
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

supplieropeningbalance.prototype.postsupplieropeningbalance = function(){


    var errors = this.Validate($('#supplieropeningbalance-form :input').serializeArray());

     x=$('#supplieropeningbalance-form :input');
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
            url: "supplieropeningbalance" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#supplieropeningbalance-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    supplieropeningbalance.prototype.addnewrow(output.id);
                    $('#supplieropeningbalance-form [name=Mount]', $('.box-success')).val('').focus();
                    $('#supplieropeningbalance-form #cboSupplierID', $('.box-success')).val(0);
                    $('#supplieropeningbalance-form #cboSupplierID', $('.box-success')).trigger("chosen:updated");
                    $('#supplieropeningbalance-form [name=Notes]', $('.box-success')).val('').focus();
                    // $('#supplieropeningbalance-form [name=Debt]', $('.box-success')).val('').focus();
                    $('#supplieropeningbalance-form [name=TransDate]', $('.box-success')).val('').focus();
					$(".datepicker").datepicker('setDate', new Date());
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
supplieropeningbalance.prototype.addnewrow = function(id){

    
var t = $('#tbl-SupplierOpeningBalance').DataTable();

        var cboSupplierID = $( "#cboSupplierID" ).clone();

        // $('[name=Debt]').val();

    text = '<tr><td></td>' +
                '<td>' + $('#supplieropeningbalance-form [name=TransDate]').val() +  '</td>' + 
                '<td>' + $('#supplieropeningbalance-form [name=Mount]').val() +  '</td>' + 
                '<td data-val="' + $('#supplieropeningbalance-form #cboSupplierID').val() + '"> ' + cboSupplierID.text() +  '</td>' + 
                '<td>' + $('#supplieropeningbalance-form [name=Notes]').val() +  '</td>' + 
                '<td>' + deptText +'</td>' + 
                '<td>'
                    +'<button name="EditSupplierOpeningBalance_' + id + '" class="btn btn-flat btn-info btn-sm EditSupplierOpeningBalance">تعديل</button>'
                    + ' '
                    +'<button name="DelSupplierOpeningBalance_' + id + '" class="btn btn-flat btn-danger btn-sm RmvSupplierOpeningBalance">حذف</button>'+
                '</td>' +
            '</tr>';

    var index =  t.row.add( $(text) ).draw();

}
/*
* Delete Bank ID By Bank Id
* @param Bank ID gets from Spliting On click
* */
supplieropeningbalance.prototype.DeleteSupplierOpeningBalance = function(TransID){
    $.ajax({
        url: "supplieropeningbalance/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            supplieropeningbalance.prototype.deleterow(TransID,output);
        })
        .error(function (data) {
            showError('',config1.con_error);
        });
}

/*
* Show edit row
* */
supplieropeningbalance.prototype.EditSupplierOpeningBalance = function(row ,TransID ){


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
                    cntl.html('<select name="SupplierID" style="width:100%" data-placeholder="' + cntl.text() + '" id="cboSupplierIDedit" > </select>');
                    $(document).ready(function() {
$(" #cboSupplierIDedit").select2({
  placeholder: " ",
      ajax: {
          //supplierautocomplete
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

                   
                   
                    cntl.html('<input class="radio-inline dept" id="Debit"  type="radio" name="Debt" data-title="مدين" value="1"  />'+'<label class="radio-inline" id="Debit_btn" >مدين</label>'+'</br> '+'<input class="radio-inline" id="Creditor"  type="radio" name="Debt" data-title="مدين" value="0"  />'+'  '+'<label class="radio-inline" id="Creditor_btn" >دائن</label>');

                    break;

                case 6 :

                    cntl.html(
                         '<button name="UpdateSupplierOpeningBalance_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdateSupplierOpeningBalance">حفظ</button>'
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
supplieropeningbalance.prototype.UpdateSupplierOpeningBalance = function(TransID ,data){

console.log(data)
    $.ajax({
        url: "supplieropeningbalance/" + TransID ,
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
                var cboSupplierID = $( "#cboSupplierIDedit" ).clone();
                crow['row'].html(
                '<td></td>' +
                '<td> ' + output.data.TransDate +  ' </td>' + 
                '<td> ' + output.data.Mount +  ' </td>' + 
                '<td data-val="' + output.data.SupplierID + '"> ' +  cboSupplierID.text()+  ' </td>' + 
                '<td> ' + output.data.Notes +  ' </td>' + 
                '<td> ' + Debt +  ' </td>' + 
                '<td>'
                    +'<button name="EditSupplierOpeningBalance_' + TransID + '" class="btn btn-flat btn-info btn-sm EditSupplierOpeningBalance">تعديل</button>'
                    + ' '
                    +'<button name="DelSupplierOpeningBalance_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvSupplierOpeningBalance">حذف</button>'+
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
supplieropeningbalance.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-SupplierOpeningBalance').DataTable();
    var index =  t.row(crow.row).remove().draw();

}


supplieropeningbalance.prototype.getallMountForCusromer = function(){

     var t2 = $("#tbl-totalval").DataTable();


    $.ajax({
            url: "gettotalvalueofopeningbalancesuppliers",
            type: "post",
           // data: $('#onecustomer-repo-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output) {

            obj = eval(output);
            console.log(obj);
            var Mount1 = obj[0].Mount1;
            var Mount2 = obj[1].Mount2 ;
       

                 text = '<tr><td>'+Mount2+'</td>'+
                            '<td>'+Mount1+'</td>'
                   


                           t2.row.add( $(text) ).draw();
           


    }).error(function (data) {
        showError('',data);
        }); 


}



$(function(){ _supplieropeningbalance = new supplieropeningbalance(); });

$(document).ready(function() {

_supplieropeningbalance.getallMountForCusromer()

 $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        });

    crow = {};
    // $("#tbl-SupplierOpeningBalance").dataTable();

    $('#add-SupplierOpeningBalance').click(function(){
        // alert("aaaaaaaaaaaaa");
        
        $(this).prop("disabled",true);
        _supplieropeningbalance.postsupplieropeningbalance();

    });

    $('body').on('click','.RmvSupplierOpeningBalance' , function(){

        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _supplieropeningbalance.DeleteSupplierOpeningBalance(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditSupplierOpeningBalance' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _supplieropeningbalance.EditSupplierOpeningBalance(row ,name[1]);

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
    * update spicifc supplieropeningbalance
    * */
    $('body').on('click','.UpdateSupplierOpeningBalance' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _supplieropeningbalance.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _supplieropeningbalance.UpdateSupplierOpeningBalance(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })


   
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
     $("#add-SupplierOpeningBalance").prop("disabled",false);
});
});