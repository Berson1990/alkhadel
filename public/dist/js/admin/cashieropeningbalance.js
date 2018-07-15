//Define Banks Class
var cashieropeningbalance = function () {};

/*
* Validate after Add new Bank
* check Bank Name is required
* check Bank Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
depos= 0;
open=0;
pay=0;
ref=0;
ctob=0 ;
btoc=0;
cref=0;
exp=0;
cashieropeningbalance.prototype.Validate = function(frm){

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

cashieropeningbalance.prototype.postcashieropeningbalance = function(){


    var errors = this.Validate($('#cashieropeningbalance-form :input').serializeArray());

    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "cashieropeningbalance" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#cashieropeningbalance-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    cashieropeningbalance.prototype.addnewrow(output.id);
                    $('[name=Mount]', $('.box-success')).val('').focus();
                    $('#cboCashierID', $('.box-success')).val(0);
                    $('#cboCashierID', $('.box-success')).trigger("chosen:updated");
                    $('[name=Notes]', $('.box-success')).val('').focus();
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
cashieropeningbalance.prototype.addnewrow = function(id){

    var t = $('#tbl-CashierOpeningBalance').DataTable();

    text = '<tr><td></td>' +
                '<td>' + $('[name=TransDate]').val() +  '</td>' + 
                '<td>' + $('[name=Mount]').val() +  '</td>' + 
                '<td data-val="' + $('#cboCashierID').val() + '"> ' + getCashierName($('#cboCashierID').val()) +  '</td>' + 
                '<td>' + $('[name=Notes]').val() +  '</td>' + 
                '<td>'
                    +'<button name="EditCashierOpeningBalance_' + id + '" class="btn btn-flat btn-info btn-sm EditCashierOpeningBalance">تعديل</button>'
                    + ' '
                    +'<button name="DelCashierOpeningBalance_' + id + '" class="btn btn-flat btn-danger btn-sm RmvCashierOpeningBalance">حذف</button>'+
                '</td>' +
            '</tr>'

    var index =  t.row.add( $(text) ).draw();

}
/*
* Delete Bank ID By Bank Id
* @param Bank ID gets from Spliting On click
* */
cashieropeningbalance.prototype.DeleteCashierOpeningBalance = function(TransID){
    $.ajax({
        url: "cashieropeningbalance/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            cashieropeningbalance.prototype.deleterow(TransID,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
cashieropeningbalance.prototype.EditCashierOpeningBalance = function(row ,TransID ){


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
                    // console.log(cntl.attr('data-val'));
                    // console.log(cntl);
                    var cboCashierID = $( "#cboCashierID" ).clone();

                    $(cboCashierID).attr('id', 'cboCashierID' + TransID);
                    $(cboCashierID).val(cntl.attr('data-val'));
                    cntl.html('');
                    $(cboCashierID).appendTo(cntl);

                    break;
                case 4 :

                    cntl.html('<input name="Notes" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');


                    break;
                case 5 :

                    cntl.html(
                         '<button name="UpdateCashierOpeningBalance_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdateCashierOpeningBalance">حفظ</button>'
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
cashieropeningbalance.prototype.UpdateCashierOpeningBalance = function(TransID ,data){

console.log(data)
    $.ajax({
        url: "cashieropeningbalance/" + TransID ,
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
                '<td> ' + output.data.TransDate +  ' </td>' + 
                '<td> ' + output.data.Mount +  ' </td>' + 
                '<td data-val="' + output.data.CashierID + '"> ' + getCashierName(output.data.CashierID) +  ' </td>' + 
                '<td> ' + output.data.Notes +  ' </td>' + 
                '<td>'
                    +'<button name="EditCashierOpeningBalance_' + TransID + '" class="btn btn-flat btn-info btn-sm EditCashierOpeningBalance">تعديل</button>'
                    + ' '
                    +'<button name="DelCashierOpeningBalance_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvCashierOpeningBalance">حذف</button>'+
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
cashieropeningbalance.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-CashierOpeningBalance').DataTable();
    var index =  t.row(crow.row).remove().draw();

}



$(function(){ _cashieropeningbalance = new cashieropeningbalance(); });

$(document).ready(function() {


    crow = {};
    $("#tbl-CashierOpeningBalance").dataTable();

    $('#add-CashierOpeningBalance').click(function(){
        _cashieropeningbalance.postcashieropeningbalance();
          $("#add-CashierOpeningBalance").prop("disabled",true);

    });

    $('body').on('click','.RmvCashierOpeningBalance' , function(){

        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _cashieropeningbalance.DeleteCashierOpeningBalance(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditCashierOpeningBalance' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _cashieropeningbalance.EditCashierOpeningBalance(row ,name[1]);

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
    * update spicifc cashieropeningbalance
    * */
    $('body').on('click','.UpdateCashierOpeningBalance' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _cashieropeningbalance.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _cashieropeningbalance.UpdateCashierOpeningBalance(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
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


    function strFormatDate (_Date){
        var d = new Date(_Date);
        var curr_date = d.getDate();
        var curr_month = d.getMonth() + 1;
        var curr_year = d.getFullYear(curr_year);
        return curr_date + "/" + curr_month + "/" + curr_year;
    };



$(document).ready(function() {
    
 $('#search-accountstatement').click(function(){
        searchfortables();
    });
 });


   
    function setObj(data){ depos = data; }
    function setObj2(data){ open = data; }
    function setObj3(data){ pay = data; }
    function setObj4(data){ ref = data; }
    function setObj5(data){ ctob = data; }
    function setObj6(data){ btoc = data; }
    function setObj7(data){ cref = data; }
    function setObj8(data){ exp = data; }

  function searchfortables () {
  
 var t = $('#tbl-accountstatement').DataTable();
    
     
    try
    {
    t
    .clear()
    .draw();
    }
    catch(ex)
    {
        alert("error");
        console.log(ex);
    }
        $.ajax({
            url: "loadD" ,
            type: "post",
            data: $('#accountstatement-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
        .done(function (output) {
            var deposit = eval (output);
             setObj(deposit);


            $.ajax({
            url: "loadD2" ,
            type: "post",
            data: $('#accountstatement-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output){
              var opening = eval (output);
              setObj2(opening);

            $.ajax({
            url: "loadD3" ,
            type: "post",
            data: $('#accountstatement-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output){
            var payments = eval (output);
             setObj3(payments);

                $.ajax({
            url: "loadD4" ,
            type: "post",
            data: $('#accountstatement-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output){
            var refunds = eval (output);
             setObj4(refunds);

                $.ajax({
            url: "loadD5" ,
            type: "post",
            data: $('#accountstatement-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output){
            var CtoB = eval (output);
             setObj5(CtoB);

                $.ajax({
            url: "loadD6" ,
            type: "post",
            data: $('#accountstatement-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output){
            var BtoC = eval (output);
             setObj6(BtoC);

                 $.ajax({
            url: "loadD7" ,
            type: "post",
            data: $('#accountstatement-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output){
            var Crefund = eval (output);
             setObj7(Crefund);


                $.ajax({
            url: "loadD8" ,
            type: "post",
            data: $('#accountstatement-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output){
            var expenses = eval (output);
            console.log(expenses);
             setObj8(expenses);

            for (var i = 0; i < opening.length; i++) {

                 text = '<tr> <td>رصيد إفتتاحى</td>'+
                        '<td >'+opening[i].Mount+'</td>'+
                        '<td >-</td>'+
                        '<td >'+opening[i].Notes+'</td>'+
                        '<td >'+opening[i].TransDate+'</td>'+
                         '</tr>';
                        
                t.row.add( $(text) ).draw();

            }

            for (var i = 0; i < deposit.length; i++) {

                 text2 = '<tr> <td> إيداع نقدى من عميل</td>'+
                        '<td >-</td>'+
                        '<td >'+deposit[i].Mount+'</td>'+
                        '<td >'+deposit[i].Notes+'</td>'+
                        '<td >'+deposit[i].TransDate+'</td>'+
                         '</tr>';
                        
                t.row.add( $(text2) ).draw();

            }

              for (var i = 0; i < payments.length; i++) {

                 text3 = '<tr> <td> مدفوعات المورد </td>'+
                        '<td >-</td>'+
                        '<td >'+payments[i].Mount+'</td>'+
                        '<td >'+payments[i].Notes+'</td>'+
                        '<td >'+payments[i].TransDate+'</td>'+
                         '</tr>';
                        
                t.row.add( $(text3) ).draw();

            }   

             for (var i = 0; i < refunds.length; i++) {

                 text4 = '<tr> <td> مرتجع نقدى من مورد</td>'+
                        '<td >'+refunds[i].Refund+'</td>'+
                        '<td >-</td>'+
                        '<td >'+refunds[i].Notes+'</td>'+
                        '<td >'+refunds[i].RefundDate+'</td>'+
                         '</tr>';
                        
                t.row.add( $(text4) ).draw();

            }  

           for (var i = 0; i < CtoB.length; i++) { //c2b

                 text5 = '<tr> <td> الصادر</td>'+
                         '<td >-</td>'+
                        '<td >'+CtoB[i].Mount+'</td>'+     
                        '<td >'+CtoB[i].Notes+'</td>'+
                        '<td >'+CtoB[i].TransDate+'</td>'+
                         '</tr>';
                        
                t.row.add( $(text5) ).draw();

            }    

           for (var i = 0; i < BtoC.length; i++) {  //b2c

                 text6 = '<tr> <td> الوارد</td>'+
                        '<td >'+BtoC[i].Mount+'</td>'+
                        '<td >-</td>'+
                        '<td >'+BtoC[i].Notes+'</td>'+
                        '<td >'+BtoC[i].TransDate+'</td>'+
                         '</tr>';
                        
                t.row.add( $(text6) ).draw();

            }  

            for (var i = 0; i < Crefund.length; i++) {  //b2c

                 text7 = '<tr> <td> مرتجع نقدى من عميل</td>'+
                         '<td >-</td>'+
                        '<td >'+Crefund[i].Refund+'</td>'+
                        '<td >'+Crefund[i].Notes+'</td>'+
                        '<td >'+Crefund[i].RefundDate+'</td>'+
                         '</tr>';
                        
                t.row.add( $(text7) ).draw();

            }    
             for (var i = 0; i < expenses.length; i++) {  //b2c

                 text8 = '<tr> <td> المصروفات</td>'+
                         '<td >-</td>'+
                        '<td >'+expenses[i].Mount+'</td>'+
                        '<td >'+expenses[i].Notes+'</td>'+
                        '<td >'+expenses[i].TransDate+'</td>'+
                         '</tr>';
                        
                t.row.add( $(text8) ).draw();

            }    



        }).error(function (data) {showError('',data);}); 




        }).error(function (data) {showError('',data);}); 


        }).error(function (data) {showError('',data);}); 

        }).error(function (data) {showError('',data);}); 

        }).error(function (data) {showError('',data);}); 

        }).error(function (data) {showError('',data);}); 

        }).error(function (data) {showError('',data);}); 

    
            
            
            
            
        })
        .error(function (data) {
        showError('',data);
        }); 

        }
     	//show date of day in input when reloaded the page
	$(document).ready(function(){
//		    $( "#datepicker" ).datepicker( $.datepicker.regional[ "ar" ] );
    
		$(".datepicker").datepicker('setDate', new Date());

});

 $(document).ready(function() { 
$(':input').change(function () { 
//   alert("ayyy")
     $("#add-CashierOpeningBalance").prop("disabled",false);
});
});