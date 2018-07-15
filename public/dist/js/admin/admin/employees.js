//Define Employees Class
var employees = function () {};

/*
* Validate after Add new Employee
* check Employee Name is required
* check Employee Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
employees.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];
    if (! data.EmployeeName ) {
        errors.push(config.required_employeename);
    }
    
    return errors;
};
/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

employees.prototype.postemployee = function(){
    var errors = this.Validate($('#employee-form :input').serializeArray());
    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "employee" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#employee-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    employees.prototype.addnewrow(output.id);
                    $('[name=EmployeeName]', $('.box-success')).val('').focus();
                }
            })
            .error(function (data) {
                showError('',config.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is Employee Id to assign in delete and Update (edit)
* */
employees.prototype.addnewrow = function(id){

    var t = $('#tbl-Employees').DataTable();

    var index =  t.row.add( [
        '',
        $('[name=EmployeeName]').val(),
        '<button name="EditEmployee_' + id + '" class="btn btn-flat btn-info btn-sm EditEmployee">تعديل</button>' +
        ' '+
        '<button name="DelEmployee_' + id +'" class="btn btn-flat btn-danger btn-sm RmvEmployee">حذف</button>'
    ] ).draw();

}
/*
* Delete Employee ID By Employee Id
* @param Employee ID gets from Spliting On click
* */
employees.prototype.DeleteEmployee = function(Employeeid){
    $.ajax({
        url: "employee/" + Employeeid ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            employees.prototype.deleterow(Employeeid,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
employees.prototype.EditEmployee = function(row ,Employeeid ){


            row.find('td').each (function(key) {

            var cntl = $(this).closest('tr').find('td').eq(key);

            switch (key){
                case 1 :

                    cntl.html('<input name="EmployeeName" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 2 :

                    cntl.html(
                         '<button name="UpdateEmployee_' + Employeeid + '" class="btn btn-flat btn-success btn-sm UpdateEmployee">حفظ</button>'
                        + ' '
                        +'<button name="CancelEdit_' + Employeeid + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }

    });


}
/*
* Updateing Employee
* */
employees.prototype.UpdateEmployee = function(EmployeeId ,data){

console.log(data)
    $.ajax({
        url: "employee/" + EmployeeId ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
            var temp = null ;
            if (output.status){
                crow['row'].html(
                '<td></td>'
                    +'<td>' + output.data.EmployeeName +  '</td>'
                +'<td>'
                    +'<button name="EditEmployee_' + EmployeeId + '" class="btn btn-flat btn-info btn-sm EditEmployee">تعديل</button>'
                    + ' '
                    +'<button name="DelEmployee_' + EmployeeId + '" class="btn btn-flat btn-danger btn-sm RmvEmployee">حذف</button>'
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
* @param id Employee ID
* @param output response from server
* */
employees.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-Employees').DataTable();
    var index =  t.row(crow.row).remove().draw();

}

$(function(){ _employee = new employees(); });

$(document).ready(function() {
    crow = {};
    $("#tbl-Employees").dataTable();

    $('#add-Employee').click(function(){
    $("#add-Employee").prop("disabled",true);
        _employee.postemployee();

    });

    $('body').on('click','.RmvEmployee' , function(){

        // if (confirm("Are you sure u Want Delete This Employee?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _employee.DeleteEmployee(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditEmployee' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _employee.EditEmployee(row ,name[1]);

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
    * update spicifc employee
    * */
    $('body').on('click','.UpdateEmployee' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _employee.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _employee.UpdateEmployee(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })
});

$(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-Employee").prop("disabled",false);
});
});