check= 0;
open=0;
pay=0;
ref=0;


$(document).ready(function() {
    $( ".datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date())
        });
 $('#search-accountstatement').click(function(){
        getData();
        searchfortables();
    });


 });


function getData(){

    var x= $("#fromdate2").val();
        $(".showFrom").text(x);

    var y= $("#todate2").val();
        $(".showTo").text(y);
        
    var z= $('#CustomerIDas option:selected').html();
        $("#showcustomer").text("اسم المورد :"+z);




}
   
    function setObj2(data){ check = data; }
    function setObj3(data){ open = data; }
    function setObj4(data){ pay = data; }
    function setObj5(data){ ref = data; }

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
            url: "loadDb" ,
            type: "post",
            data: $('#accountstatement-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        })
        .done(function (output) {
            var checkpay = eval (output);
             setObj2(checkpay);

            $.ajax({
            url: "loadDb2" ,
            type: "post",
            data: $('#accountstatement-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output){
              var opening = eval (output);
              setObj3(opening);

            $.ajax({
            url: "loadDb3" ,
            type: "post",
            data: $('#accountstatement-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output){
            var payments = eval (output);
            setObj4(payments);
             
             $.ajax({
            url: "loadDb4" ,
            type: "post",
            data: $('#accountstatement-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output){
            var refund = eval (output);
            setObj5(refund);
             
            $.ajax({
            url: "loadDb5" ,
            type: "post",
            data: $('#accountstatement-form :input').serialize().replace(/ *\_[^=]*\= */g, "=") ,
            dataType: "json"
        }).done(function (output){
            var discount = eval (output);

             
            
            for (var i = 0; i < open.length; i++) {
                    if(open[i].Debt==1){
                 text = '<tr> <td>رصيد إفتتاحى</td>'+
                        '<td >'+open[i].Mount+'</td>'+
                        '<td >-</td>'+
                        '<td >'+open[i].Notes+'</td>'+
                        '<td >'+open[i].TransDate+'</td>'+
                         '</tr>';
                      }
                      else {
                        text = '<tr> <td>رصيد إفتتاحى</td>'+
                        '<td >-</td>'+
                        '<td >'+open[i].Mount+'</td>'+
                        '<td >'+open[i].Notes+'</td>'+
                        '<td >'+open[i].TransDate+'</td>'+
                         '</tr>';

                      }  
                t.row.add( $(text) ).draw();

            }

            for (var i = 0; i < check.length; i++) {

                 text2 = '<tr> <td> مدفوعات شيكات</td>'+
                 		 '<td >'+check[i].Mount+'</td>'+
                         '<td >-</td>'+
                        '<td >'+check[i].Notes+'</td>'+
                        '<td >'+check[i].TransDate+'</td>'+
                         '</tr>';
                        
                t.row.add( $(text2) ).draw();

            }

              for (var i = 0; i < pay.length; i++) {

                 text3 = '<tr> <td> مدفوعات نقدية </td>'+
                        '<td >'+pay[i].Mount+'</td>'+
                        '<td >-</td>'+
                        '<td >'+pay[i].Notes+'</td>'+
                        '<td >'+pay[i].TransDate+'</td>'+
                         '</tr>';
                        
                t.row.add( $(text3) ).draw();

            }    

			for (var i = 0; i < ref.length; i++) {

                 text4 = '<tr> <td>مرتجع نقدى </td>'+
                 		'<td >-</td>'+
                        '<td >'+ref[i].Refund+'</td>'+
                        '<td >'+ref[i].Notes+'</td>'+
                        '<td >'+ref[i].RefundDate+'</td>'+
                         '</tr>';
                        
                t.row.add( $(text4) ).draw();

            }    

			for (var i = 0; i < discount.length; i++) {

                 text5 = '<tr> <td> خصم مكتسب </td>'+
                		 '<td >-</td>'+
                        '<td >'+discount[i].Mount+'</td>'+
                        '<td >'+discount[i].Notes+'</td>'+
                        '<td >'+discount[i].TransDate+'</td>'+
                         '</tr>';
                        
                t.row.add( $(text5) ).draw();

            }    

        }).error(function (data) {showError('',data);}); 

        }).error(function (data) {showError('',data);}); 


        }).error(function (data) {showError('',data);}); 


        }).error(function (data) {showError('',data);}); 

            
        }).error(function (data) {showError('',data);}); 

        }

        function PrintAS(){
                

            $(".DTTT").addClass("hide");
            $("#tbl-CustomerReport_filter").addClass("hide");
            $(".dataTables_length").addClass("hide");
            $(".dataTables_filter").addClass("hide");
            $(".pagination").addClass("hide");
            $(".panel-heading").addClass("hide");
            $(".box-header").addClass("hide");
            $(".content-header").addClass("hide");
            $(".main-header").addClass("hide");
            $(".sidebar-menu").addClass("hide");
            $("#dataTables_filter").addClass("hide");

         
            $("#search-accountstatement").css("width","100%");
            $("#CustomerIDas_chosen").css("display","none");
            $("#fromdate2").css("display","none");
            $("#todate2").css("display","none");
            $("#search-accountstatement").css("display","none");
            $(".showTo").css("display","block");
            $(".showFrom").css("display","block");
            $("#showcustomer").css("display","block");
        }

            $(document).keyup(function(e) {
             if (e.keyCode == 27) {

            $("#search-customerbills").removeClass("hide");
            $(".DTTT").removeClass("hide");
            $("#tbl-CustomerReport_filter").removeClass("hide");
            $(".dataTables_length").removeClass("hide");
            $(".dataTables_filter").removeClass("hide");
            $(".pagination").removeClass("hide");
            $(".panel-heading").removeClass("hide");
            $(".box-header").removeClass("hide");
            $(".content-header").removeClass("hide");
            $(".main-header").removeClass("hide");
            $(".sidebar-menu").removeClass("hide");

         
            $("#CustomerIDas_chosen").css("display","block");
            $("#fromdate2").css("display","block");
            $("#todate2").css("display","block");
            $("#search-accountstatement").css("display","block");
            $(".showTo").css("display","none");
            $(".showFrom").css("display","none");
            $("#showcustomer").css("display","none ");
               
                  
    }
});

