//Define Products Class
var Containers = function () {};
Containers.prototype.Init = function() {
    
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
    $("#DriverID").select2({
        placeholder: "Search for an Driver Name",
        ajax: {
            //driverautocomplete
            url: 'driverautocomplete',
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            type : 'post',
            data: function (params) {
                var queryParameters = {
                    DriverName: params.term
                }
                return queryParameters;
            },
            processResults: function (output) {
                if (output.status){
                    return {
                        results: $.map(output.data, function (item) {
                            return {
                                text: item.DriverName,
                                id: item.DriverID
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
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
}
/**
 * Show Notification
 * @param msg
 * @param status
 * @param elementID
 * @constructor
 */

Containers.prototype.ShowNotification = function(msg , status ,elementID ) {
    var alert = $('#' + elementID);
    if ($('#' + elementID).is(':visible')) {
        alert.slideUp();
    }
    if (status) {
        alert.removeClass('alert-danger');
        alert.addClass('alert-success');
    } else {
        alert.removeClass('alert-success');
        alert.addClass('alert-danger');
    }
    alert.find('p').html(msg);
    alert.slideDown();

}
/**
 * Add New Container
 * @constructor
 */


Containers.prototype.AddContainer = function(){
    $.ajax({
        url: 'container' ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "post",
        data: $('#tblcontainermodify').find('select ,input').serialize() ,
        dataType: "json"
    })
        .done(function (output) {
            if (output.status){
//           oepnDate =  $('[name=ContainerOpenDate]').val();             
//           EndDate =  $('[name=ContainerEndDate]').val(); 
         


                _container.ShowNotification(output.message ,true ,'errorboxCModal');
                var container = output.container;

               
				var index =  $('#tbl-Containers').DataTable().row.add( [
                    '0',    
                    $('[name=SupplierID]').find(':selected').text(),
                    parseInt(container.ContainerType) ? 'Brad' : 'Ship' ,
                    container.ContainerIntNum,
                    container.ContainerLocalNum,
                    container.Commision,
                    $('[name=ContainerOpenDate]').val(),
                    $('[name=ContainerEndDate]').val(),
//                    $("#maxcontnum").container.ContainerLocalNum,
                    container.OtherExpenses,
                    container.CarNumber ? container.CarNumber : 'empty',
                    container.Nowlon,
                    '<input class="ContainerStatus" value="'+container.ContainerID+'" type="checkbox" '+ (parseInt(container.ContainerStatus) > 0 ? 'checked' : '' ) + ' />',
                    '<button value="'+container.ContainerID+'"  class="btn btn-flat btn-info btn-sm EditContainer">تعديل</button>'
                   +' '
                   +'<button value="'+container.ContainerID+'"  class="btn btn-flat btn-danger btn-sm RmvContainer">حذف</button>'
//reloadcbo();

                ]).draw();
                

            
            }else{
                var errors = '';

                $.each( output.message, function( key, value ) {

                    errors += "* " + value + '<br />';

                });
                _container.ShowNotification(errors ,false ,'errorboxCModal');
            }
        })
        .error(function (data) {
            alert("Connection Error");
        });

}
/**
 * Get Max Container In Last Year
 * @constructor
 */
Containers.prototype.GetMaxContainer = function(){
    $.ajax({
        url: 'container/getmaxcontainer' ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "post",
        data: $('#tblcontainermodify').find('[name=SupplierID] ,[name=ContainerOpenDate]').serialize() ,
        dataType: "json"
    })
        .done(function (output) {
            if (output.status){

                $('#maxcontnum').text(output.data.max);
                $('#maxyear').text(output.data.year);

            }else{
                var errors = '';

                $.each( output.message, function( key, value ) {

                    errors += "* " + value + '<br />';

                });
                $('#maxcontnum').text('0');
                $('#maxyear').text('');
                _container.ShowNotification(errors ,false ,'errorboxCModal');
            }
        })
        .error(function (data) {
            console.log("Connection Error");
        });
}
/**
 * Edit Container bt request in ajax and return all data for Selected Containers
 * @param id
 * @constructor
 */
Containers.prototype.EditContainer = function(id){

    $.ajax({
        url: 'container/'+id+'/edit' ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "get",
        dataType: "json"
    })
        .done(function (output) {
            // console.log(output['Container']);
            // console.log(output);

            if (output.status){
                var data = output.data.Container;
                // console.log(data['ContainerType']);
                if(data['ContainerType']==1){
                    $('[name=SupplierID]').val(data.SupplierID).trigger("chosen:updated");
                    $('[name=ContainerEndDate]').val(data.ContainerEndDate);
                    $('[name=Commision]').val(data.Commision);
                    $('[name=ContainerIntNum]').val(data.ContainerIntNum);
                    $('[name=ContainerOpenDate]').val(data.ContainerOpenDate);
                    $('[name=OtherExpenses]').val(data.OtherExpenses);
                    $('[name=CarNumber]').val(data.CarNumber);
                    $('[name=Nowlon]').val(data.Nowlon);
//                    $("#DriverID").empty().append('<option value="'+output.data.Driver.DriverID+'" selected>'+output.data.Driver.DriverName+'</option>').trigger("change");
                    $('[name=ContainerStatus][value='+data.ContainerStatus+']').prop('checked', true);
                    $('[name=ContainerType][value='+data.ContainerType+']').prop('checked', true);
                    $('#ContainerModalKey').val(data.ContainerID).text(' عدل البراد رقم ('+data.ContainerLocalNum+')');
                    $('#addContainer').modal();
                   
                   $('#statusShip').click(function(){
                        alert("aaa");
                        $('[name=CarNumber]').val('Empty');
                        $("#DriverID").empty().trigger("change");
                        $('[name=Nowlon]').val('0');
                    });
                }
          else if(data['ContainerType']==0){

                    $('[name=SupplierID]').val(data.SupplierID).trigger("chosen:updated");
                    $('[name=ContainerEndDate]').val(data.ContainerEndDate);
                    $('[name=Commision]').val(data.Commision);
                    $('[name=ContainerIntNum]').val(data.ContainerIntNum);
                    $('[name=ContainerOpenDate]').val(data.ContainerOpenDate);
                    $('[name=OtherExpenses]').val(data.OtherExpenses);
                    $('[name=ContainerStatus][value='+data.ContainerStatus+']').prop('checked', true);
                    $('[name=ContainerType][value='+data.ContainerType+']').prop('checked', true);
                    $('#ContainerModalKey').val(data.ContainerID).text('Update Container Num ('+data.ContainerLocalNum+')');
                    $('#addContainer').modal();


            } 

            }else{
                var errors = '';

                $.each( output.message, function( key, value ) {

                    errors += "* " + value + '<br />';

                });
                _container.ShowNotification(errors ,false ,'errorboxPrimary');
            }
        })
        .error(function (data) {
            console.log("Connection Error");
        });
}
/**
 * Edit Custom Container bt request in ajax and return all data for Selected Containers Custom
 * @param cntrl
 * @constructor
 */
Containers.prototype.EditCContainer = function(cntrl){
    $.ajax({
        url: 'containercustoms/'+cntrl.val()+'/edit' ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "get",
        dataType: "json"
    })
        .done(function (output) {
            if (output.status){
                var data = output.data;
                var customname = cntrl.closest('tr').find('td').eq(1).text();
                $('#CustomModalKey').val(data.Serial).text('Update Custom Name ( '+customname+' ) ' + '.');
                $("#CustomID").empty().append('<option value="'+data.CustomID+'" selected>'+customname+'</option>').trigger("change");
                $('[name=ContainerID]').val(data.ContainerID);
                $('[name=CustomMount]').val(data.CustomMount);
                $('#addContainerCustom').modal();
            }else{
                var errors = '';

                $.each( output.message, function( key, value ) {

                    errors += "* " + value + '<br />';

                });
                _container.ShowNotification(errors ,false ,'errorboxPrimary');
//                reloadcbo();
            }
        })
        .error(function (data) {
            console.log("Connection Error");
        });
}
/**
 * Clear All Fields In modal and change button name
 * @constructor
 */
Containers.prototype.ClearModalFields = function(){

    $('#addContainer , #addContainerCustom').find('input').not('[name=ContainerStatus],[name=ContainerType]').val('');
    $('#ContainerModalKey ,#CustomModalKey').val('').text('Add');
    $('[name=ContainerID]').val('');
    // in Container Model
    $('#maxyear').text('Year');
    $('#maxcontnum').text('0');
    // in Container Customs Model
    $('#mcintnum').text('0');
    $('#mclocalnum').text('0');
    $('#errorboxCCModal').slideUp();

}
/**
 * Update Container Details
 * @param id => ContainerID
 * @constructor
 */
Containers.prototype.UpdateContainer = function(id){
    $.ajax({
        url: 'container/' + id ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: $('#tblcontainermodify').find('select ,input').serialize() ,
        dataType: "json"
    })
        .done(function (output) {
            var data=output.data;
            if (output.status){
                var obj = $('#tblcontainermodify').find('select ,input');

                     console.log(obj);
                   
                    if(obj[7].checked== true){ // brad
                        var updatedrow = $('.EditContainer[value='+id+']').closest('tr').find('td');
                        updatedrow.eq(1).text($('[name=SupplierID]').find(":selected").text());
                        updatedrow.eq(2).text('Brad');
                        updatedrow.eq(3).text($('[name=ContainerIntNum]').val());
                        updatedrow.eq(5).text($('[name=Commision]').val());
                        updatedrow.eq(6).text($('[name=ContainerOpenDate]').val());
                        updatedrow.eq(7).text($('[name=ContainerEndDate]').val());
                        updatedrow.eq(8).text($('[name=OtherExpenses]').val());
                        updatedrow.eq(9).text($('[name=CarNumber]').val());
                        updatedrow.eq(10).text($('[name=Nowlon]').val());

                    }

                    else if(obj[8].checked== true){//ship
                        var updatedrow = $('.EditContainer[value='+id+']').closest('tr').find('td');
                        updatedrow.eq(1).text($('[name=SupplierID]').find(":selected").text());
                        updatedrow.eq(2).text('Ship');
                        updatedrow.eq(3).text($('[name=ContainerIntNum]').val());
                        updatedrow.eq(5).text($('[name=Commision]').val());
                        updatedrow.eq(6).text($('[name=ContainerOpenDate]').val());
                        updatedrow.eq(7).text($('[name=ContainerEndDate]').val());
                        updatedrow.eq(8).text($('[name=OtherExpenses]').val());
                        updatedrow.eq(9).text('Empty');
                        updatedrow.eq(10).text('0');
                        //  updatedrow.eq(9).text($('[name=CarNumber]'));
                        // updatedrow.eq(10).text($('[name=Nowlon]'));


                    }

          
                _container.ShowNotification(output.message ,true ,'errorboxCModal');


            }else{
                var errors = '';

                $.each( output.message, function( key, value ) {

                    errors += "* " + value + '<br />';

                });
                _container.ShowNotification(errors ,false ,'errorboxCModal');
            }
        })
        .error(function (data) {
            console.log("Connection Error");
        });
}
/**
 * Update Container Custom Details
 * @param id => ContainerID
 * @constructor
 */
Containers.prototype.UpdateContainerCustoms = function(id){
    $.ajax({
        url: 'containercustoms/' + id ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "PUT",
        data: $('#tblc-custommodify').find('select ,input').serialize() ,
        dataType: "json"
    })
        .done(function (output) {
            if (output.status){

                var updatedrow = $('.EditCContainer[value='+id+']').closest('tr').find('td');
                // Customer Name
                updatedrow.eq(1).text($('#CustomID').find(":selected").text());
                updatedrow.eq(2).text($('[name=CustomMount]').val());

                _container.ShowNotification(output.message ,true ,'errorboxCCModal');

            }else{
                var errors = '';

                $.each( output.message, function( key, value ) {

                    errors += "* " + value + '<br />';

                });
                _container.ShowNotification(errors ,false ,'errorboxCCModal');
            }
        })
        .error(function (data) {
            console.log("Connection Error");
        });
}
/**
 * Remove Container
 * @param id
 * @constructor
 */
Containers.prototype.RemoveContainer = function(cntrl){
    $.ajax({
        url: 'container/' + cntrl.val() ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "DELETE",
        data: null ,
        dataType: "json"
    })
        .done(function (output) {
            if (output.status){

                _container.ShowNotification(output.message ,true ,'errorboxPrimary');
                cntrl.closest('tr').fadeOut('slow',function(){
                    $('#tbl-Containers').DataTable()
                        .row( $(this) )
                        .remove()
                        .draw();
                });
            }else{
                var errors = '';

                $.each( output.message, function( key, value ) {

                    errors += "* " + value + '<br />';

                });
                _container.ShowNotification(errors ,false ,'errorboxPrimary');
            }
        })
        .error(function (data) {
            console.log("Connection Error");
        });
}
/**
 * Remove Custom Container
 * @param id
 * @constructor
 */
Containers.prototype.RemoveCContainer = function(cntrl){
    $.ajax({
        url: 'containercustoms/' + cntrl.val() ,
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "DELETE",
        data: null ,
        dataType: "json"
    })
        .done(function (output) {
            if (output.status){

                _container.ShowNotification(output.message ,true ,'errorboxPrimary');
                cntrl.closest('tr').fadeOut('slow',function(){
                    $('#tbl-ContainersCustoms').DataTable()
                    .row( $(this) )
                    .remove()
                    .draw();
                });
            }else{
                var errors = '';

                $.each( output.message, function( key, value ) {

                    errors += "* " + value + '<br />';

                });
                _container.ShowNotification(errors ,false ,'errorboxPrimary');
            }
        })
        .error(function (data) {
            console.log("Connection Error");
        });
}
/**
 * Change Container Status
 * @param cntrl
 * @constructor
 */
Containers.prototype.ChangeContainerStatus = function(cntrl){
    $.ajax({
        url: 'container/' + cntrl.val() + '/changeCstatus',
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "post",
        data: cntrl.serialize() ,
        dataType: "json"
    })
        .done(function (output) {
            // console.log(output);
            if (output.status){

                _container.ShowNotification(output.message ,true ,'errorboxCCModal');
                cntrl.prop('checked' ,output.container)
            }else{
                var errors = '';

                $.each( output.message, function( key, value ) {

                    errors += "* " + value + '<br />';

                });
                _container.ShowNotification(errors ,false ,'errorboxCCModal');
            }
        })
        .error(function (data) {
            console.log("Connection Error");
        });
}
/**
 * Add new Row To Tbody if found Container Products
 * @param id
 * @constructor
 */
Containers.prototype.GetContainerProducts = function(id){

    $.ajax({
        url: 'container/' + id + '/getCCustomsandProducts',
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "post",
        data: null ,
        dataType: "json"
    })
        .done(function (output) {
            if (output.status){
                var t = $('#tbl-ContainersProducts').DataTable();t.clear().draw();
                var total = 0;

                $.each(output.data.products , function( k , row){
                    console.log(row.sales.customer.CustomerName);
                    var index =  t.row.add( [
                        k + 1,
                        row.sales.customer.CustomerName,
                        row.product.ProductName,
                        row.Weight,
                        row.Quantity,
                        row.ProductPrice,
                        row.Total
                    ] ).draw();
                    total += parseInt(row.Total);
                });
                var table = $('#tbl-ContainersProducts').DataTable().column(4).footer()
                // declare Container Customs to add new rows
                t = $('#tbl-ContainersCustoms').DataTable();t.clear().draw();
                $.each(output.data.ccustoms , function( k , row){
                    var index =  t.row.add( [
                        k + 1,
                        row.customs.CustomName,
                        row.CustomMount,
                        '<button value="'+ row.Serial +'"  class="btn btn-flat btn-info btn-sm EditCContainer">Edit</button> '
                       +'<button value="'+ row.Serial +'"  class="btn btn-flat btn-danger btn-sm RmvCContainer">Delete</button>'
                    ] ).draw();
                });

                $(table).find('span').html(total);
            }else{
                var errors = '';

                $.each( output.message, function( key, value ) {

                    errors += "* " + value + '<br />';

                });
                _container.ShowNotification(errors ,false ,'errorboxCCModal');
            }
        })
        .error(function (data) {
            console.log("Connection Error");
        });

}
/**
 * Get All Container Details
 * @param id
 * @constructor
 */
Containers.prototype.RetrieveContainerDetails = function(id){
    $.ajax({
        url: 'container/' + id + '/details',
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "post",
        data: null ,
        dataType: "json"
    })
        .done(function (output) {
		// console.log(output);
            if (output.status){
                $('#mcintnum').text(output.data.ContainerIntNum);
                $('#mclocalnum').text(output.data.ContainerLocalNum);
                $('#addContainerCustom').find('table tr').eq(0).find('input select').val('0')
                $('#tblc-custommodify').find('input:hidden').eq(0).val(id);
            }else{
                $('#addContainerCustom').find('table tr').next().find('span').text('0')
                $('#tblc-custommodify').find('input:hidden').eq(0).val('0')
            }

        })
        .error(function (data) {
            console.log("Connection Error");
        });

}

/**
 * AddContainerCustom
 * @constructor
 */
Containers.prototype.AddContainerCustoms = function(){
	$.ajax({
        url: 'containercustoms',
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        type: "post",
        data: $('#tblc-custommodify').find('input ,select').serialize() ,
        dataType: "json"
    })
        .done(function (output) {

            if (output.status){

                _container.ShowNotification(output.message ,true ,'errorboxCCModal');
                 var index =  $('#tbl-ContainersCustoms').DataTable().row.add( [
                     '',
                     $('#CustomID').find(":selected").text(),
                     $('[name=CustomMount]').val(),
                     '<button value="'+ output.Serial +'"  class="btn btn-flat btn-info btn-sm EditCContainer">Edit</button> '
                    +'<button value="'+ output.Serial +'"  class="btn btn-flat btn-danger btn-sm RmvCContainer">Delete</button>'

                 ] ).draw();
                // console.log(output);

            }else{
                var errors = '';

                $.each( output.message, function( key, value ) {

                    errors += "* " + value + '<br />';

                });
                _container.ShowNotification(errors ,false ,'errorboxCCModal');
            }

        })
        .error(function (data) {
            console.log("Connection Error");
        });

}
$(function(){ _container = new Containers(); });

$(document).ready(function() {
    _container.Init();

    $('#ContainerModalKey').click(function(){
        
        
        
        
         $(this).prop('disabled', true);
    
        var ContainerID = $(this).val();
        if (!isNaN(ContainerID) && ContainerID > 0){
            _container.UpdateContainer(ContainerID);
        }else{
            _container.AddContainer();
        }

    });
    $('[name=SupplierID] ,[name=ContainerOpenDate]').change(function(){

        _container.GetMaxContainer();

    });
    $('body').on('click' ,'.EditContainer',function(){

        _container.EditContainer($(this).val());

    });
    $('body').on('click','.RmvContainer',function(){

        if( confirm('Do You Want To Remove Container ?') ){
            _container.RemoveContainer($(this));
        }else{
            console.log('press no')
        }

    });

    $('#addContainer ,#addContainerCustom').on('hide.bs.modal', function () {
        _container.ClearModalFields();
    })

    $('body').on('change','.ContainerStatus', function () {
        if( confirm('Do You Want To Change Container Status ?') ){
            _container.ChangeContainerStatus($(this));
        }else{
            $(this).prop('checked' , $(this).is(':checked') ? false : true );
        }
    })

    $('#tbl-Containers tbody').on('click', 'tr', function () {

        var table = $('#tbl-Containers').DataTable();

        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
            $('#tbl-ContainersProducts').DataTable().clear().draw();
            $('#tbl-ContainersCustoms').DataTable().clear().draw();

            $('#showContainerCustomModal').removeAttr('data-target').addClass('btn-danger').removeClass('btn-success');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            $('#tbl-ContainersProducts').DataTable().rows().remove().draw();
            var trvalue = $(this).find('input:checkbox').val();
            _container.GetContainerProducts(trvalue);
            $('#showContainerCustomModal').attr('data-target','#addContainerCustom').addClass('btn-success').removeClass('btn-danger');
        }
    } );

    $('#showContainerCustomModal').click(function(){

        var id = $('#tbl-Containers').find('tr.selected').find('input:checkbox').val();
        if(typeof id != "undefined" &&  !isNaN(id)){
            _container.RetrieveContainerDetails(id);
        }
    });

    $('#').click(function(){

    });
    $('#CustomModalKey').click(function(){
        var Serial = $(this).val();
        if (!isNaN(Serial) && Serial > 0){
            _container.UpdateContainerCustoms(Serial);
        }else{
            _container.AddContainerCustoms();
        }

    });
    /**
     * Delete Custom From Container
     */
    $('body').on('click','.RmvCContainer',function(){

        if( confirm('Do You Want To Remove Container Custom ?') ){
            _container.RemoveCContainer($(this));
        }

    });
    /**
     * Edit Custom Container
     */
     $('body').on('click','.EditCContainer',function(){

        _container.EditCContainer($(this));

     });
    /**
     * Show Car number and nowlon when container type equal brad
     */
    $('[name=ContainerType]').change(function(){

        if($(this).is(':checked')){

            if ( parseInt($(this).val()) == 1 ){
                $('.tr_containertype').removeClass('hide');
            }else{
                $('.tr_containertype').addClass('hide');
            }


        }

    });

});


$("input").keypress(function() {
   
$("#ContainerModalKey").prop('disabled', false);   

}); 

$("#cboforignsupplers").change(function(){

 $("#ContainerModalKey").prop('disabled', false);


}); 
    
 $("#newcontiner").on("click" ,function(){    
    
   $("#ContainerModalKey").prop('disabled', false);

});
     $(".datepicker").on("click" ,function(){    
    
   $("#ContainerModalKey").prop('disabled', false);

});

//$(document).ready(function(){
//    
//     
//    
//});