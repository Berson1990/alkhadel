 
function cashiervalidation (){
  $.ajax({
            url: "cvalidation",
            type: "post",
            data:  $('[name=CashierID]').val(), ,
            dataType: "json"
        }).done(function (output) {
            
            obj = eval(output);









  }).error(function (data) {
        showError('',data);
        }); 
}