//Define ExpensesTypes Class
var expensestypes = function () {};

/*
* Validate after Add new ExpenseType
* check ExpenseType Name is required
* check ExpenseType Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
expensestypes.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];
    if (! data.ExpenseTypeName ) {
        errors.push(config.required_expensetypename);
    }
					
		if (! data.ExpensesGroupID ) {
//		alert("00");
        errors.push(config.required_expensegroupid);
    }
    else if (data.ExpensesGroupID == 0)
    {
        errors.push(config.required_expensegroupid);
    }

    return errors;
};

/*
Print Mode
*/
//$(document).ready(function() {
//    var t= $('#tbl-ExpensesTypes').DataTable( {
//        dom: 'T<"clear">lfrtip',
//    } );
//    var printBtn = document.getElementById("ToolTables_tbl-ExpensesTypes_4");
//    printBtn.addEventListener("click",function(){
//        t.column(2).visible(false);
////        $("table").css("text-align","justify");
//        $("table").css("width","100%");
//        $("#cms_module_uptime_monitors_wrapper").css("display","flex");
//        var element = document.getElementById("cms_module_uptime_monitors_wrapper");
//        element.innerHTML = "<h3>طباعة المصروفات</h3>";
//                
//    });       
//});


/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

expensestypes.prototype.postexpensetype = function(){

    var errors = this.Validate($('#expensetype-form :input').serializeArray());

    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "expensestypes" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#expensetype-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text); 

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    expensestypes.prototype.addnewrow(output.id);
                    $('#expensetype-form [name=ExpenseTypeName]',$('.box-success')).val('').focus();
					$('#expensetype-form #cboExpenseGroupID', $('.box-success')).val(0);
                    $('#expensetype-form #cboExpenseGroupID', $('.box-success')).trigger("chosen:updated");
                }
            })
            .error(function (data) {
                showError('',config.con_error);
            });
    
    }
}

/*
*  Add New row in datatable
* @param id is ExpenseType Id to assign in delete and Update (edit)
* */

expensestypes.prototype.addnewrow = function(id){

    var t = $('#tbl-ExpensesTypes').DataTable();

//    var index =  t.row.add( [
//        '',
//        $('#expensetype-form [name=ExpenseTypeName]').val(),
//		$('#expensetype-form [name=ExpensesGroupID]').val(),
////		 '<td data-val="' + output.data.ExpensesGroupID + '"> ' + getExpensesGroup(output.data.ExpensesGroupID) +  ' </td>' + 
//        '<button name="EditExpenseType_' + id + '" class="btn btn-flat btn-info btn-sm EditExpenseType">تعديل</button>' +
//        ' '+
//        '<button name="DelExpenseType_' + id +'" class="btn btn-flat btn-danger btn-sm RmvExpenseType">حذف</button>'
//    ] ).draw();
	
	
	 text = '<tr><td></td>' +
                '<td>' + $('[name=ExpenseTypeName]').val() +  '</td>' + 
               
             '<td data-val="' + $('#cboExpenseGroupID').val() + '"> ' + getExpensesGroup($('#cboExpenseGroupID').val()) +  '</td>' +  				
             '<td>'
              +'<button name="EditExpenseType_' + id + '" class="btn btn-flat btn-info btn-sm EditExpenseType">تعديل</button>'
              + ' '
              +'<button name="DelExpenseType_' + id + '" class="btn btn-flat btn-danger btn-sm RmvExpenseType">حذف</button>'+
             '</td>' +
             '</tr>'

    var index =  t.row.add( $(text) ).draw();


}
/*
* Delete ExpenseType ID By ExpenseType Id
* @param ExpenseType ID gets from Spliting On click
* */
expensestypes.prototype.DeleteExpenseType = function(ExpenseTypeid){
    $.ajax({
        url: "expensestypes/" + ExpenseTypeid ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            expensestypes.prototype.deleterow(ExpenseTypeid,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
expensestypes.prototype.EditExpenseType = function(row ,ExpenseTypeid ){


            row.find('td').each (function(key) {

            var cntl = $(this).closest('tr').find('td').eq(key);

            switch (key){
                case 1 :

                    cntl.html('<input name="ExpenseTypeName" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break; 
					
				case 2 :
						 
                      var cboExpensesGroupID = $( "#expensetype-form #cboExpenseGroupID" ).clone();

                    $(cboExpensesGroupID).attr('id', 'cboExpenseGroupID_' + ExpenseTypeid);
                    $(cboExpensesGroupID).val(cntl.attr('data-val'));
                    cntl.html('');
                    $(cboExpensesGroupID).appendTo(cntl);
					$(cboExpensesGroupID).chosen().change( function()
											  {
		  				});

                    break;
					
					
                case 3 :

                    cntl.html(
                         '<button name="UpdateExpenseType_' + ExpenseTypeid + '" class="btn btn-flat btn-success btn-sm UpdateExpenseType">حفظ</button>'
                        + ' '
                        +'<button name="CancelEdit_' + ExpenseTypeid + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }

    });


}
/*
* Updateing ExpenseType
* */
expensestypes.prototype.UpdateExpenseType = function(ExpenseTypeId ,data){

//console.log(data)
    $.ajax({
        url: "expensestypes/" + ExpenseTypeId ,
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
                    +'<td>' + output.data.ExpenseTypeName +  '</td>'
					+ '<td data-val="' + output.data.ExpensesGroupID + '"> ' + getExpensesGroup(output.data.ExpensesGroupID) +  ' </td>' 
                +'<td>'
                    +'<button name="EditExpenseType_' + ExpenseTypeId + '" class="btn btn-flat btn-info btn-sm EditExpenseType">تعديل</button>'
                    + ' '
                    +'<button name="DelExpenseType_' + ExpenseTypeId + '" class="btn btn-flat btn-danger btn-sm RmvExpenseType">حذف</button>'
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
* @param id ExpenseType ID
* @param output response from server
* */
expensestypes.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-ExpensesTypes').DataTable();
    var index =  t.row(crow.row).remove().draw();

}

$(function(){ _expensetype = new expensestypes(); });




     


$(document).ready(function() {
    crow = {};
    $("#tbl-ExpensesTypes").dataTable();
//    $("#tbl-ExpensesTypes").dataTable({dom: 'T<"clear">lfrtip'});

    $('#add-ExpenseType').click(function(){
  $("#add-ExpenseType").prop("disabled",true);
        _expensetype.postexpensetype();

    });

    $('body').on('click','.RmvExpenseType' , function(){

        // if (confirm("Are you sure u Want Delete This ExpenseType?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _expensetype.DeleteExpenseType(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditExpenseType' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _expensetype.EditExpenseType(row ,name[1]);

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
    * update spicifc expensetype
    * */
    $('body').on('click','.UpdateExpenseType' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _expensetype.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _expensetype.UpdateExpenseType(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })
});
 
   function getExpensesGroup(ExpenseGroupID)
    {
        var cboExpensesGroupID = $( "#cboExpenseGroupID" ).clone();
        $(cboExpensesGroupID).val(ExpenseGroupID);

       return $('option:selected',cboExpensesGroupID).text() ; 

    }





function printing(){
window.location("#print");
    
}


function printing(){
    
var prtContent = document.getElementById("tbl-ExpensesTypes");
    
var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');

    
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
    
}

$(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-ExpenseType").prop("disabled",false);
});
})
;$(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#add-ExpenseType").prop("disabled",false);
});
});

