//Define Banks Class
var cashierbanktransfer = function () {};

/*
* Validate after Add new Bank
* check Bank Name is required
* check Bank Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
cashierbanktransfer.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];
   
    if (! data.TransDate ) {
        errors.push(config.required_transdate);
    }

    if (! data.Mount ) {

        errors.push(config.required_mount);
    }

    if (! data.CashierID ) {
        errors.push(config.required_cashierid);
    }
    else if (data.CashierID == 0)
    {
        errors.push(config.required_cashierid);
    }

    if (! data.BankID ) {
        errors.push(config.required_bankid);
    }
    else if (data.BankID == 0)
    {
        errors.push(config.required_bankid);
    }

    if (! data.Notes ) {

        errors.push(config.required_notes);
    }

    return errors;
};

function cashiervalidation(){



  $.ajax({
            url: "cvalidation",
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data:  $('[name=CashierID]').serialize(), 
            dataType: "json"
        }).done(function (output) {
            
             console.log(output);
          var  obj = eval(output);

            /*
1-COB => Cashier opening balance
2-CD  => CashDeposit
3-BCT => Bank Cashier Tranfaier
4-SPR => Supplier  Refund
5-CUR =>  Custom refund
6-CP  => Cashpayment
7-CR  => Cutomer Refund
8-CBT =>Cashier Bank Transfair
9-CT  => Cashier Transfair
9-CT2  => Cashier Transfair
9-Ex  => Expenses
9-CUP  => Cuatompayment
 */
    var CashierName = '';
          var CashDeposit = 0 ;
          var CashierOpeningBalance = 0 ;
          var SupplierRefund = 0 ;
          var BankCashierTransfer = 0 ;
          var cashiertransfer = 0 ;
          var CustomRefund = 0 ;
          var CustomerRefund = 0 ;
          var cashierbanktransfer = 0 ;
          var cashiertransfer2 = 0 ;
          var expenses = 0 ;
          var custompayment = 0 ;
          var total= 0;
          var inc =0;
          var dec = 0;

       for( var i= 0 ; i < obj.length; i++){

                 var CashierName = obj[i].CashierName;

                        /* increse*/

                 CashDeposit = obj[i].CD; 
                 CashierOpeningBalance = obj[i].COB;
                 SupplierRefund = obj[i].SPR;  
                 CustomRefund = obj[i].CUR;    
                 BankCashierTransfer = obj[i].BCT; 
                 cashiertransfer = obj[i].CT;  
                  CustomerRefund = obj[i].CR;    
               /*decrise*/

                  
                 cashierbanktransfer = obj[i].CBT;  
                 cashiertransfer2 = obj[i].CT2;  
                 CashPayments = obj[i].CP;  
                 expenses = obj[i].EX; 
                 custompayment = obj[i].CUSP;  

     inc = +CustomerRefund + +CashDeposit + +CashierOpeningBalance + +SupplierRefund + +CustomRefund + +BankCashierTransfer + +cashiertransfer2;
     console.log("زيادة  :"+inc);
     dec =  +cashierbanktransfer + +cashiertransfer + +CashPayments + +expenses + +custompayment;
     console.log("نقصان  :"+dec);
    total = inc - dec;
      console.log("Total"+total);
        
               document.getElementById("validation").innerHTML="قيمة "+CashierName+" :"+total +" جـــ";
                 // $("#validation").append(obj[i].CashDeposit);
   
       }



        }).error(function (data){
        showError('',data);
        }); 
}






/*
* Post New Proudct With name and category(Type)
* @reponse add new row
* */

var msg_text = '';

cashierbanktransfer.prototype.postcashierbanktransfer = function(){


    var errors = this.Validate($('#cashierbanktransfer-form :input').serializeArray());

    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "cashierbanktransfer" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#cashierbanktransfer-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    cashierbanktransfer.prototype.addnewrow(output.id);
                    $('[name=Mount]', $('.box-success')).val('');
                    $('#cboCashierID', $('.box-success')).val(0);
                    $('#cboCashierID', $('.box-success')).trigger("chosen:updated");
                    $('#cboBankID', $('.box-success')).val(0);
                    $('#cboBankID', $('.box-success')).trigger("chosen:updated");
                    $('[name=Notes]', $('.box-success')).val('');
                    $('[name=TransDate]', $('.box-success')).val('').focus();
					$(".datepicker").datepicker('setDate', new Date());
                }
            })
            .error(function (data) {
                showError('',config.con_error);
            });
    }
}
/*
*  Add New row in datatable
* @param id is Bank Id to assign in delete and Update (edit)
* */
cashierbanktransfer.prototype.addnewrow = function(id){

    var t = $('#tbl-CashierBankTransfer').DataTable();

    text = '<tr><td></td>' +
                '<td>' + $('[name=TransDate]').val() +  '</td>' + 
                '<td>' + $('[name=Mount]').val() +  '</td>' + 
                '<td data-val="' + $('#cboCashierID').val() + '"> ' + getCashierName($('#cboCashierID').val()) +  '</td>' +
                '<td data-val="' + $('#cboBankID').val() + '"> ' + getBankName($('#cboBankID').val()) +  '</td>' + 
                '<td>' + $('[name=Notes]').val() +  '</td>' + 
                '<td>'
                    +'<button name="EditCashierBankTransfer_' + id + '" class="btn btn-flat btn-info btn-sm EditCashierBankTransfer">تعديل</button>'
                    + ' '
                    +'<button name="DelCashierBankTransfer_' + id + '" class="btn btn-flat btn-danger btn-sm RmvCashierBankTransfer">حذف</button>'+
                '</td>' +
            '</tr>'

    var index =  t.row.add( $(text) ).draw();

}
/*
* Delete Bank ID By Bank Id
* @param Bank ID gets from Spliting On click
* */
cashierbanktransfer.prototype.DeleteCashierBankTransfer = function(TransID){
    $.ajax({
        url: "cashierbanktransfer/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            cashierbanktransfer.prototype.deleterow(TransID,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
cashierbanktransfer.prototype.EditCashierBankTransfer = function(row ,TransID ){


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

                    cntl.html('<input name="Mount" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 3 :
                    var cboCashierID = $( "#cboCashierID" ).clone();

                    $(cboCashierID).attr('id', 'cboCashierID_' + TransID);
                    $(cboCashierID).val(cntl.attr('data-val'));
                    cntl.html('');
                    $(cboCashierID).appendTo(cntl);

                    break;
                case 4 :
                    var cboBankID = $( "#cboBankID" ).clone();

                    $(cboBankID).attr('id', 'cboBankID_' + TransID);
                    $(cboBankID).val(cntl.attr('data-val'));
                    cntl.html('');
                    $(cboBankID).appendTo(cntl);

                    break;
                case 5 :

                    cntl.html('<input name="Notes" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 6 :

                    cntl.html(
                         '<button name="UpdateCashierBankTransfer_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdateCashierBankTransfer">حفظ</button>'
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
cashierbanktransfer.prototype.UpdateCashierBankTransfer = function(TransID ,data){

console.log(data)
    $.ajax({
        url: "cashierbanktransfer/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
            var temp = null ;
            if (output.status){
                crow['row'].html(
                '<td></td>' +
                '<td>' + output.data.TransDate +  '</td>' + 
                '<td>' + output.data.Mount + '</td>' + 
                '<td data-val="' + output.data.CashierID + '"> ' + getCashierName(output.data.CashierID) +  ' </td>' +
                '<td data-val="' + output.data.BankID + '"> ' + getBankName(output.data.BankID) +  ' </td>' +
                '<td>' + output.data.Notes +  ' </td>' + 
                '<td>'
                    +'<button name="EditCashierBankTransfer_' + TransID + '" class="btn btn-flat btn-info btn-sm EditCashierBankTransfer">تعديل</button>'
                    + ' '
                    +'<button name="DelCashierBankTransfer_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvCashierBankTransfer">حذف</button>'+
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
cashierbanktransfer.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-CashierBankTransfer').DataTable();
    var index =  t.row(crow.row).remove().draw();

}



$(function(){ _cashierbanktransfer = new cashierbanktransfer(); });

$(document).ready(function() {


    crow = {};
    $("#tbl-CashierBankTransfer").dataTable();

    $('#add-CashierBankTransfer').click(function(){
        _cashierbanktransfer.postcashierbanktransfer();

          $("#add-CashierBankTransfer").prop("disabled",true);
    });

    $('body').on('click','.RmvCashierBankTransfer' , function(){

        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _cashierbanktransfer.DeleteCashierBankTransfer(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditCashierBankTransfer' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _cashierbanktransfer.EditCashierBankTransfer(row ,name[1]);

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
    * update spicifc cashierbanktransfer
    * */
    $('body').on('click','.UpdateCashierBankTransfer' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _cashierbanktransfer.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _cashierbanktransfer.UpdateCashierBankTransfer(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
        }
    })


    $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        });
        //$( ".datepicker" ).datepicker("setDate", new Date());
    
});


    function getCashierName(CashierID)
    {
        var cboCashierID = $( "#cboCashierID" ).clone();
        $(cboCashierID).val(CashierID);

        return $('option:selected',cboCashierID).text() ; 
    }

    function getBankName(BankID)
    {
        var cboBankID = $( "#cboBankID" ).clone();
        $(cboBankID).val(BankID);

        return $('option:selected',cboBankID).text() ; 
    }

    function strFormatDate (_Date){
        var d = new Date(_Date);
        var curr_date = d.getDate();
        var curr_month = d.getMonth() + 1;
        var curr_year = d.getFullYear(curr_year);
        return curr_date + "/" + curr_month + "/" + curr_year;
    };

	//show date of day in input when reloaded the page
	$(document).ready(function(){
//		    $( "#datepicker" ).datepicker( $.datepicker.regional[ "ar" ] );
    
		$(".datepicker").datepicker('setDate', new Date());

});

 $(document).ready(function() { 
$(':input').keypress(function () { 
//   alert("ayyy")
     $("#add-CashierBankTransfer").prop("disabled",false);
});
});