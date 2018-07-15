

//Define Banks Class
var customepayment = function () {};

 $("document").ready(function(){
  $("#CustomID").select2({       
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

    $("#CashierID").select2({
            placeholder: "Search for an cashier Name",
            ajax: {
                url: 'cachierautocomplete',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                type : 'post',
                data: function (params) {
                    var queryParameters = {
                        CashierName: params.term
                    }
                    return queryParameters;
                },
                processResults: function (output) {
                    if (output.status){
                        return {
                            results: $.map(output.data, function (item) {
                                return {
                                    text: item.CashierName,
                                    id: item.CashierID,
                                    cachierAccount : item.CashierAccountID
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



function cashiervalidation3(){
// alert("cashiervalidation3");
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
        
               document.getElementById("validation3").innerHTML="قيمة "+CashierName+" :"+total +" جـــ";
                 // $("#validation").append(obj[i].CashDeposit);
   
       }
        }).error(function (data){
        showError('',data);
        }); 
}




var x=0;
var deptText=0;
customepayment.prototype.Validate = function(frm){

    var data = {};
    $.each(frm, function(element){

        var elm = frm[element]['name'] + "=" ; 
        elm = elm.replace(/ *\_[^=]*\= */g, "=")
        elm = elm.replace("=", "");
        data[elm]  = $.trim(frm[element]['value']);

    });

    var errors = [];
    if (! data.TransDate ) {

        errors.push(config1.required_transdate);

    }
    if (! data.Mount ) {

        errors.push(config1.required_mount);

    }
     if (! data.CashierID ) {

        errors.push(config5.required_cashierid);

    }


//    if (! data.Debt ) {
//        console.log(data);
//        errors.push(config1.required_debt);
//
//    }

    if (! data.CustomID ) {
        errors.push(config1.required_customid);
    }
    else if (data.CustomID == 0)
    {
        errors.push(config1.required_customid);
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

customepayment.prototype.postcustomepayment = function(){


    var errors = this.Validate($('#customPayment-form :input').serializeArray());

//     x=$('#customPayment-form :input');
//             console.log(x[3].checked);//maden
//             console.log(x[4].checked);//da2en


//             if(x[3].checked==true){deptText="مدين";}
//             else{deptText="دائن";}


             console.log(deptText);
    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{
            
        $.ajax({
            url: "customepayment" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#customPayment-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    customepayment.prototype.addnewrow(output.id);
                    $('#customPayment-form [name=Mount]', $('.box-success')).val('').focus();
                    $('#customPayment-form #CustomID', $('.box-success')).val(0);
                    $('#customPayment-form #CustomID', $('.box-success')).trigger("chosen:updated");
                    $('#customPayment-form [name=Notes]', $('.box-success')).val('').focus();
                    $('#customPayment-form #CashierID', $('.box-success')).val(0);
                    $('#customPayment-form #CashierID', $('.box-success')).trigger("chosen:updated");
                    // $('#customeropeningbalance-form [name=Debt]', $('.box-success')).val('').focus();
                    $('#customPayment-form [name=TransDate]', $('.box-success')).val('').focus();
                
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

customepayment.prototype.addnewrow = function(id){

    

  var t = $('#tbl-customPayment').DataTable();

     var cboCustomerID = $( "#customPayment-form #CustomID" ).clone();
     var cboCashierID = $( "#customPayment-form #CashierID" ).clone();

    text = '<tr><td></td>' +
                '<td>' + $('#customPayment-form [name=TransDate]').val() +  '</td>' + 
                '<td>' + $('#customPayment-form [name=Mount]').val() +  '</td>' + 
                '<td data-val="' + $('#customPayment-form #CustomID').val() + '"> ' + cboCustomerID.text() +  '</td>' + 
                '<td data-val="' + $('#customPayment-form #CashierID').val() + '"> ' + cboCashierID.text() +  '</td>' + 
                '<td>' + $('#customPayment-form [name=Notes]').val() +  '</td>' + 
//                '<td>' + deptText +'</td>' + 
                '<td>'
                    +'<button name="EditcustomPayment_' + id + '" class="btn btn-flat btn-info btn-sm EditcustomPayment">تعديل</button>'
                    + ' '
                    +'<button name="DelcustomPayment_' + id + '" class="btn btn-flat btn-danger btn-sm RmvcustomPayment">حذف</button>'+
                '</td>' +
            '</tr>';

    var index =  t.row.add( $(text) ).draw();



}

customepayment.prototype.Deletecustomepayment = function(TransID){
    $.ajax({
        url: "customepayment/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            customepayment.prototype.deleterow(TransID,output);
        })
        .error(function (data) {
            showError('',config1.con_error);
        });
}


customepayment.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-customPayment').DataTable();
    var index =  t.row(crow.row).remove().draw();

}

customepayment.prototype.Editcustomepayment = function(row ,TransID ){


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
                    cntl.html('<select name="CustomID" style="width:100%" data-placeholder="' + cntl.text() + '" id="CustomIDedit" > </select>');
                    $(document).ready(function() {

$(" #CustomIDedit").select2({
  placeholder: " ",
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

                    case 4:

cntl.html( '<select name="CashierID" style="width:100%" data-placeholder="'+ cntl.text() + ' " id="CashierIDedit9" > </select>' );

                $(document).ready(function(){

    $("#CashierIDedit9").select2({
            placeholder: "Search for an cashier Name",
            ajax: {
                url: 'cachierautocomplete',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                type : 'post',
                data: function (params) {

                    var queryParameters = {
                        CashierName: params.term
                    }
                    return queryParameters;
                },
                processResults: function (output) {

                    if (output.status){
                        return {
                            results: $.map(output.data, function (item) {
                                return {
                                    text: item.CashierName,
                                    id: item.CashierID,
                                    cachierAccount : item.CashierAccountID
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
                case 5 :

                    cntl.html('<input name="Notes" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');


                    break;
//                case 5 :
//
//                   
//                   
//                    cntl.html('<input class="radio-inline dept" id="Debit"  type="radio" name="Debt" data-title="مدين" value="1"  />'+'<label class="radio-inline" id="Debit_btn" >مدين</label>'+'</br> '+'<input class="radio-inline" id="Creditor"  type="radio" name="Debt" data-title="مدين" value="0"  />'+'  '+'<label class="radio-inline" id="Creditor_btn" >دائن</label>');
//
//                    break;

                case 6 :

                    cntl.html(
                         '<button name="UpdatecustomPayment_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdatecustomPayment">حفظ</button>'
                        + ' '
                        +'<button name="CancelEdit_' + TransID + '" class="btn btn-flat btn-warning btn-sm CancelEdit">الغاء</button>'
                    );

                    break;
            }


    });

    reloadcbo();


}

customepayment.prototype.Updatecustomepayment = function(TransID ,data){

console.log(data)
    $.ajax({
        url: "customepayment/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: data ,
        dataType: "json"
    })
        .done(function (output) {
            var temp = null ;

            if (output.status){
                console.log(output);
//                var Debt=0;
//                if(output.data.Debt==1){Debt="مدين";}
//                else {Debt="دائن";}
                var CustomIDedit = $( "#CustomIDedit" ).clone();
                var CashierIDIDedit = $( "#CashierIDedit" ).clone();
                crow['row'].html(
                '<td></td>' +
                '<td> ' + output.data.TransDate +  ' </td>' + 
                '<td> ' + output.data.Mount +  ' </td>' + 
                '<td data-val="' + output.data.CustomID + '"> ' +  CustomIDedit.text()+  ' </td>' + 
                '<td data-val="' + output.data.CashierID + '"> ' +  CashierIDIDedit.text()+  ' </td>' + 
                '<td> ' + output.data.Notes +  ' </td>' + 
//                '<td> ' + Debt +  ' </td>' + 
                '<td>'
                    +'<button name="EditCcustomPayment_' + TransID + '" class="btn btn-flat btn-info btn-sm EditcustomPayment">تعديل</button>'
                    + ' '
                    +'<button name="DelcustomPayment_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvcustomPayment">حذف</button>'+
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




	
 $(function(){ _customepayment = new customepayment(); });






$(document).ready(function(){


 $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())

        });    
    
    
 crow = {};
    $('#add-customPayment').click(function(){
        // alert("aaaaaaaaaaaaa");
//          $(this).prop("disabled",true );
     _customepayment.postcustomepayment();

    });
    

    $('body').on('click','.RmvcustomPayment' , function(){

        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _customepayment.Deletecustomepayment(name[1]);
            }

        });

    });
        
    
      $('body').on('click','.EditcustomPayment' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _customepayment.Editcustomepayment(row ,name[1]);

    });
    
    
      $('body').on('click','.CancelEdit' , function()
    {
        var name = this.name ;
        name = name.split('_');

        $(this).closest('tr').html(crow['tr_' + name[1] ].html());
    })
    
        $('body').on('click','.UpdatecustomPayment' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _customepayment.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _customepayment.Updatecustomepayment(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
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