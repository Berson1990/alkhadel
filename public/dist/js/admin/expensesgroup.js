//Define Expensess Class
var expensesgroup = function () {};

/*
* Validate after Add new Expenses
* check Expenses Name is required
* check Expenses Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
expensesgroup.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });
console.log(data);

    var errors = [];
    if (! data.ExpensesGroupName ) {

        errors.push(config.required_expensegroupname);

    }
   /* if (! data.AccountNumber ) {

        errors.push(config.required_accountnumber);

    }*/
//    
//    if (! data.ExpenseTypeID ) {
//
//       errors.push(config.required_expensetypeid);
//    }
//     else if (data.ExpenseTypeID == 0)
//    {
//        errors.push(config.required_expensetypeid);
//    }

    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

expensesgroup.prototype.postexpensesgroup = function(){
 
    var errors = this.Validate($('#expensesgroup-form :input').serializeArray());
    console.log($('#expensesgroup-form :input').serializeArray());
    //console.log();
    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "expensesgroup" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#expensesgroup-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
          
        })
         
            .done(function (output) {
           
                if (!output.status){
                 console.log(output.status)
                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    expensesgroup.prototype.addnewrow(output.id);
                    $('[name=ExpensesGroupName]', $('.box-success')).val('').focus();
//                    $('#cboExpensesTypesID', $('.box-success')).val(0);
//                    $('#cboExpensesTypesID', $('.box-success')).trigger("chosen:updated");
                   
                   
                }
            })
            .error(function (data) {
              //console.log(data);
                showError('',config.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is Expenses Id to assign in delete and Update (edit)
* */
expensesgroup.prototype.addnewrow = function(ExpensesGroupID){

    var t = $('#tbl-ExpensesGroup').DataTable();
      // console.log($('#tbl-ExpensesGroup').DataTable());
    text = '<tr><td></td>' +
                '<td>' + $('[name=ExpensesGroupName]').val() +  '</td>' + 
                '<td>'
                    +'<button name="EditExpenses_' + ExpensesGroupID + '" class="btn btn-flat btn-info btn-sm EditExpenses">تعديل</button>'
                    + ''
                    +'<button name="DelExpenses_' + ExpensesGroupID + '" class="btn btn-flat btn-danger btn-sm RmvExpenses">حذف</button>'+
                '</td>' +
            '</tr>'

    // var index =  t.row.add( [
    //     '',
    //     $('[name=ExpensesName]').val(),
    //     $('[name=AccountNumber]').val(),
    //     getExpensesTypes($('#cboExpensesTypesID').val()),
    //     '<button name="EditExpenses_' + id + '" class="btn btn-flat btn-info btn-sm EditExpenses">تعديل</button>' +
    //     ' '+
    //     '<button name="DelExpenses_' + id +'" class="btn btn-flat btn-danger btn-sm RmvExpenses">حذف</button>'
    // ] ).draw();

var index =  t.row.add( $(text) ).draw();

 
    //console.log(t.rows().nodes);

    //data-val="'+ $('[name=ExpensesType]:checked').attr('data-val') // dont forget assign data-val in local td imported

    //$('[name^=DelExpenses_' + id + ']').click(function(){expensesgroup.prototype.DeleteExpenses(id);});

}
/*
* Delete Expenses ID By Expenses Id
* @param Expenses ID gets from Spliting On click
* */
expensesgroup.prototype.DeleteExpensesGroup = function(ExpensesGroupID){
    $.ajax({
        url: "expensesgroup/" + ExpensesGroupID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
        console.log(output);
            expensesgroup.prototype.deleterow(ExpensesGroupID,output);
        })
        .error(function (data) {
        console.log(data);
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
expensesgroup.prototype.EditEXpensesGroup = function(row ,ExpensesGroupID ){


            row.find('td').each (function(key) {

            var cntl = $(this).closest('tr').find('td').eq(key);

            switch (key){
                case 1 :

                    cntl.html('<input name="ExpensesGroupName" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
           

                case 2:

                    cntl.html(
              '<button name="UpdateExpenses_' + ExpensesGroupID + '" class="btn btn-flat btn-success btn-sm UpdateExpenses">حفظ</button>'
                      + ' '
                      +'<button name="CancelExpenses_' + ExpensesGroupID + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }

            reloadcbo();

    });


}
/*
* Updateing Bank
* */
expensesgroup.prototype.UpdateExpensesGroup = function(ExpensesGroupID ,data){

console.log(data)
    $.ajax({
        url: "expensesgroup/" + ExpensesGroupID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
        console.log(data);
            var temp = null ;
            if (output.status){
//              temp = output.data.ExpenseTypeID < 1 ? 'محلى' : 'مستورد'
               // temp = output.data.ExpensesGroupid < 1 ? 'محلى' : 'مستورد'
                crow['row'].html(
                '<td></td>' +
                '<td> ' + output.data.ExpensesGroupName +  ' </td>' + 
                '<td>'
                    +'<button name="EditExpenses_' + ExpensesGroupID + '" class="btn btn-flat btn-info btn-sm EditExpenses">تعديل</button>'
                    + ' '
                    +'<button name="DelExpenses_' + ExpensesGroupID + '" class="btn btn-flat btn-danger btn-sm RmvExpenses">حذف</button>'+
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
expensesgroup.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-ExpensesGroup').DataTable();
    var index =  t.row(crow.row).remove().draw();

}



$(function(){ _expensesgroup = new expensesgroup(); });

$(document).ready(function() {


    crow = {};
    $("#tbl-ExpensesGroup").dataTable();

    $('#add-ExpensesGroup').click(function(){
        
        $("#add-ExpensesGroup").prop("disabled",true);
        //console.log("add")
        _expensesgroup.postexpensesgroup();
      console.log( _expensesgroup.postexpensesgroup)
    });

    $('body').on('click','.RmvExpenses' , function(){

        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _expensesgroup.DeleteExpensesGroup(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditExpenses' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _expensesgroup.EditEXpensesGroup(row ,name[1]);

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
    * update spicifc expensesgroup
    * */
    $('body').on('click','.UpdateExpenses' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _expensesgroup.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _expensesgroup.UpdateExpensesGroup(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })
});



//    function getExpensesTypes(ExpenseTypeID)
//    {
//        var cboExpensesTypesID = $( "#cboExpensesTypesID" ).clone();
//        $(cboExpensesTypesID).val(ExpenseTypeID);
//
//       return $('option:selected',cboExpensesTypesID).text() ; //$( "#cboExpensesTypesID option:selected" ).text();
//        
//        // $element.find("option").filter(function(){
//        //   return ( ($(this).val() == CurrencyID) || ($(this).text() == CurrencyID) )
//        // }).prop('selected', true);
//
//
//    }



$(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-ExpensesGroup").prop("disabled",false);
});
});
