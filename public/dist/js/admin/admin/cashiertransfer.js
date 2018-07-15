

//Define Banks Class
$(document).ready(function(){
      reloadcbo();
})

var cashiertransfer = function () {};

/*
* Validate after Add new Bank
* check Bank Name is required
* check Bank Type Is required and value is 0 | 1 (Local | imported )
* @param frm is frm.serializeArray()
* */
cashiertransfer.prototype.Validate = function(frm){

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

    if (! data.FromCashierID ) {
        errors.push(config.required_fromcashierid);
    }
    else if (data.FromCashierID == 0)
    {
        errors.push(config.required_fromcashierid);
    }

    if (! data.ToCashierID ) {
        errors.push(config.required_tocashierid);
    }
    else if (data.ToCashierID == 0)
    {
        errors.push(config.required_tocashierid);
    }
    
    // same chshier transfaer test 
    if(data.FromCashierID ==  data.ToCashierID )
    {
       errors.push(config.required_samechshier);
        
    }
        
        
        
        
    if (! data.Mount ) {

        errors.push(config.required_mount);
    }

    if (! data.Notes ) {

        errors.push(config.required_notes);
    }

    return errors;
};

 
function cashiervalidationFROM(){



  $.ajax({
            url: "cvalidationFromCashier",
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data:   $('[name=FromCashierID]').serialize(), 
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
    // var CashierName = '';
    //       var CashDeposit = 0 ;
    //       var CashierOpeningBalance = 0 ;
    //       var SupplierRefund = 0 ;
    //       var BankCashierTransfer = 0 ;
    //       var cashiertransfer = 0 ;
    //       var CustomRefund = 0 ;
    //       var CustomerRefund = 0 ;
    //       var cashierbanktransfer = 0 ;
    //       var cashiertransfer2 = 0 ;
    //       var expenses = 0 ;
    //       var custompayment = 0 ;
    //       var total= 0;
    //       var inc =0;
    //       var dec = 0;

    //    for( var i= 0 ; i < obj.length; i++){

    //              var CashierName = obj[i].CashierName;

    //                     /* increse*/

    //              CashDeposit = obj[i].CD; 
    //              CashierOpeningBalance = obj[i].COB;
    //              SupplierRefund = obj[i].SPR;  
    //              CustomRefund = obj[i].CUR;    
    //              BankCashierTransfer = obj[i].BCT; 
    //              // cashiertransfer = obj[i].CT;  
    //               CustomerRefund = obj[i].CR;    
    //            /*decrise*/

                  
    //              cashierbanktransfer = obj[i].CBT;  
    //              cashiertransfer2 = obj[i].CT;  
    //              CashPayments = obj[i].CP;  
    //              expenses = obj[i].EX; 
    //              custompayment = obj[i].CUSP;  

    //  inc = +CustomerRefund + +CashDeposit + +CashierOpeningBalance + +SupplierRefund + +CustomRefund + +BankCashierTransfer ;
    //  console.log("زيادة  :"+inc);
    //  dec =  +cashierbanktransfer + +cashiertransfer2 + +CashPayments + +expenses + +custompayment;
    //  console.log("نقصان  :"+dec);
    // total = inc - dec;
    //   console.log("Total"+total);
        
    //            document.getElementById("validation").innerHTML="قيمة "+CashierName+" :"+total +" جـــ";
                 // $("#validation").append(obj[i].CashDeposit);



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


/* to  cashier*/
function cashiervalidationTO(){



  $.ajax({
            url: "cvalidationToCashier",
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data:   $('[name=ToCashierID]').serialize(),
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
    // var CashierName = '';
    //       var CashDeposit = 0 ;
    //       var CashierOpeningBalance = 0 ;
    //       var SupplierRefund = 0 ;
    //       var BankCashierTransfer = 0 ;
    //       var cashiertransfer = 0 ;
    //       var CustomRefund = 0 ;
    //       var CustomerRefund = 0 ;
    //       var cashierbanktransfer = 0 ;
    //       var cashiertransfer2 = 0 ;
    //       var expenses = 0 ;
    //       var custompayment = 0 ;
    //       var total= 0;
    //       var inc =0;
    //       var dec = 0;

    //    for( var i= 0 ; i < obj.length; i++){

    //              var CashierName = obj[i].CashierName;

    //                     /* increse*/

    //              CashDeposit = obj[i].CD; 
    //              CashierOpeningBalance = obj[i].COB;
    //              SupplierRefund = obj[i].SPR;  
    //              CustomRefund = obj[i].CUR;    
    //              BankCashierTransfer = obj[i].BCT; 
    //              // cashiertransfer = obj[i].CT;  
    //               CustomerRefund = obj[i].CR;    
    //            /*decrise*/

                  
    //              cashierbanktransfer = obj[i].CBT;  
    //              cashiertransfer2 = obj[i].CT2;  
    //              CashPayments = obj[i].CP;  
    //              expenses = obj[i].EX; 
    //              custompayment = obj[i].CUSP;  

    //  inc = +CustomerRefund + +CashDeposit + +CashierOpeningBalance + +SupplierRefund + +CustomRefund + +BankCashierTransfer + +cashiertransfer2;
    //  console.log("زيادة  :"+inc);
    //  dec =  +cashierbanktransfer + +CashPayments + +expenses + +custompayment;
    //  console.log("نقصان  :"+dec);
    // total = inc - dec;
    //   console.log("Total"+total);
        
    //            document.getElementById("validation2").innerHTML="قيمة "+CashierName+" :"+total +" جـــ";
                 // $("#validation").append(obj[i].CashDeposit);

                 
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
        
               document.getElementById("validation2").innerHTML="قيمة "+CashierName+" :"+total +" جـــ";
   
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

cashiertransfer.prototype.postcashiertransfer = function(){


    var errors = this.Validate($('#cashiertransfer-form :input').serializeArray());

    msg_text = '';
    if (errors.length > 0){
       
        msg_text = convert_array_string(errors);
        showError('',msg_text);

    }else{

        $.ajax({
            url: "cashiertransfer" ,
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type: "post",
            data: $('#cashiertransfer-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
            .done(function (output) {
                if (!output.status){

                    msg_text = convert_array_string(output.message);
                    showError('',msg_text);

                }else{

                    msg_text = output.message;
                    showSuccess('',msg_text);

                    cashiertransfer.prototype.addnewrow(output.id);
                    $('[name=Mount]', $('.box-success')).val('');
                    $('#cboFromCashierID', $('.box-success')).val(0);
                    $('#cboFromCashierID', $('.box-success')).trigger("chosen:updated");
                    $('#cboToCashierID', $('.box-success')).val(0);
                    $('#cboToCashierID', $('.box-success')).trigger("chosen:updated");
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
cashiertransfer.prototype.addnewrow = function(id){

    var t = $('#tbl-CashierTransfer').DataTable();

    text = '<tr><td></td>' +
                '<td>' + $('[name=TransDate]').val() +  '</td>' + 
                '<td data-val="' + $('#cboFromCashierID').val() + '"> ' + getCashierName($('#cboFromCashierID').val()) +  '</td>' +
                '<td data-val="' + $('#cboToCashierID').val() + '"> ' + getCashierName($('#cboToCashierID').val()) +  '</td>' + 
                '<td>' + $('[name=Mount]').val() +  '</td>' + 
                '<td>' + $('[name=Notes]').val() +  '</td>' + 
                '<td>'
                    +'<button name="EditCashierTransfer_' + id + '" class="btn btn-flat btn-info btn-sm EditCashierTransfer">تعديل</button>'
                    + ' '
                    +'<button name="DelCashierTransfer_' + id + '" class="btn btn-flat btn-danger btn-sm RmvCashierTransfer">حذف</button>'+
                '</td>' +
            '</tr>'

    var index =  t.row.add( $(text) ).draw();

}
/*
* Delete Bank ID By Bank Id
* @param Bank ID gets from Spliting On click
* */
cashiertransfer.prototype.DeleteCashierTransfer = function(TransID){
    $.ajax({
        url: "cashiertransfer/" + TransID ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "delete",
        dataType: "json"
    })
        .done(function (output) {
            cashiertransfer.prototype.deleterow(TransID,output);
        })
        .error(function (data) {
            showError('',config.con_error);
        });
}

/*
* Show edit row
* */
cashiertransfer.prototype.EditCashierTransfer = function(row ,TransID ){


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
                    var cboFromCashierID = $( "#cboFromCashierID" ).clone();

                    $(cboFromCashierID).attr('id', 'cboFromCashierID_' + TransID);
                    $(cboFromCashierID).val(cntl.attr('data-val'));
                    cntl.html('');
                    $(cboFromCashierID).appendTo(cntl);

                    break;
                case 3 :
                    var cboToCashierID = $( "#cboToCashierID" ).clone();

                    $(cboToCashierID).attr('id', 'cboToCashierID_' + TransID);
                    $(cboToCashierID).val(cntl.attr('data-val'));
                    cntl.html('');
                    $(cboToCashierID).appendTo(cntl);

                    break;
                case 4 :

                    cntl.html('<input name="Mount" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 5 :

                    cntl.html('<input name="Notes" type="text" placeholder="' + cntl.text() + '" value="' + cntl.text() + '" class="form-control" />');

                    break;
                case 6 :

                    cntl.html(
                         '<button name="UpdateCashierTransfer_' + TransID + '" class="btn btn-flat btn-success btn-sm UpdateCashierTransfer">حفظ</button>'
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
cashiertransfer.prototype.UpdateCashierTransfer = function(TransID ,data){

console.log(data)
    $.ajax({
        url: "cashiertransfer/" + TransID ,
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
                '<td data-val="' + output.data.FromCashierID + '"> ' + getCashierName(output.data.FromCashierID) +  ' </td>' +
                '<td data-val="' + output.data.ToCashierID + '"> ' + getCashierName(output.data.ToCashierID) +  ' </td>' +
                '<td>' + output.data.Mount + '</td>' + 
                '<td>' + output.data.Notes +  ' </td>' + 
                '<td>'
                    +'<button name="EditCashierTransfer_' + TransID + '" class="btn btn-flat btn-info btn-sm EditCashierTransfer">تعديل</button>'
                    + ' '
                    +'<button name="DelCashierTransfer_' + TransID + '" class="btn btn-flat btn-danger btn-sm RmvCashierTransfer">حذف</button>'+
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
cashiertransfer.prototype.deleterow = function(id,output){
    var cls = null;
    if (!output.status){
        showError('',output.message)
    }else{
        showSuccess('',output.message)
    }

    var t = $('#tbl-CashierTransfer').DataTable();
    var index =  t.row(crow.row).remove().draw();

}



$(function(){ _cashiertransfer = new cashiertransfer(); });

$(document).ready(function() {


    crow = {};
         $("#tbl-CashierTransfer").dataTable();

    $('#add-CashierTransfer').click(function(){
        _cashiertransfer.postcashiertransfer();
        // alert("sd/lksdlvjdgb");
        $("#add-CashierTransfer").prop("disabled",true);

    });

    $('body').on('click','.RmvCashierTransfer' , function(){

        // if (confirm("Are you sure u Want Delete This Bank?"))

        var _this = this ;
        Confirmation ('', 'هل تريد الحذف ؟',function(result){
            if (result == true)
            {
                console.log("result : " + result);
                var name = _this.name ;
                name = name.split('_');

                crow['row'] = $(_this).closest('tr');
                _cashiertransfer.DeleteCashierTransfer(name[1]);
            }

        })
            


    });

    $('body').on('click','.EditCashierTransfer' , function(){
        var name = this.name ;
        name = name.split('_');

        crow['tr_' + name[1] ] = $(this).closest('tr').clone();

        var row = $(this).closest('tr');

        _cashiertransfer.EditCashierTransfer(row ,name[1]);

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
    * update spicifc cashiertransfer
    * */
    $('body').on('click','.UpdateCashierTransfer' , function()
    {
        var name = this.name ;
        name = name.split('_');

        crow['row'] = $(this).closest('tr');


        var errors =  _cashiertransfer.Validate(crow['row'].find(':input').serializeArray() );
        if (errors.length > 0){
            var error = '';
            error = convert_array_string(errors);
            showError('',error);
        }else{
            _cashiertransfer.UpdateCashierTransfer(name[1] ,crow['row'].find(':input').serialize().replace(/ *\_[^=]*\= */g, "=") );
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
        var cboToCashierID = $( "#cboToCashierID" ).clone();
        $(cboToCashierID).val(CashierID);

        return $('option:selected',cboToCashierID).text() ; 
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
     $("#add-CashierTransfer").prop("disabled",false);
});
});