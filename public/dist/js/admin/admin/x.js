//Define Tags Class
var tags = function () {};

// Add new Tag Category
tags.prototype.newtagcat = function(){
    $.ajax({
        url: "/dashboard/tag-categories/api",
        type: "get",
        data: {
            catname : $('[name=tag-category]').val(),
            csrf : $('[name=csrf]').val()
        } ,
        dataType : "json"
    })
        .done(function(output) {
            alert(output.message)
            if (output.status == true){
                $('#tbl-tag-category').append(
                    '<tr>'
                        +'<td>'+ $('[name=tag-category]').val() +'</td>'
                        +'<td>'
                        +'<button class="btn btn-flat btn-info btn-sm">rename</button>'
                        +'<button class="btn btn-flat btn-danger btn-sm">Delete</button>'
                        +'</td>'
                    +'</tr>'
                );
            }
        })
        .error(function(data) {
            alert("Connection Error");
        });
};
// Validate On POST
tags.prototype.newtag = function(){
    var error = {'tag' : "" ,'Ctag' :""};
    if ($("[name=tag-category]").val() == "0"){
        error.tag = 'Please Select Tag Category' ;
        $('[name=tag-error]').html(error.tag);
    }else if (!$.trim($("[name=tag-name]").val()) ){
        error.Ctag ='Please Type Tag Name';
        $('[name=tag-error]').html(error.Ctag);
    }else{
        $.ajax({
            url: "/dashboard/tag/api",
            type: "get",
            data: {
                tagname : $.trim($("[name=tag-name]").val()),
                tagcatid : $("[name=tag-category]").val(),
                csrf : $('[name=csrf]').val()
            } ,
            dataType : "json"
        })
            .done(function(output) {
                alert(output.message)
                if (output.status == true){
                    $('#tbl-tag').append(
                        '<tr>'
                        +'<td>'+ $('[name=tag-name]').val() +'</td>'
                        +'<td>'+ $('[name=tag-category] option:selected').text() +'</td>'
                        +'<td>'
                        +'<button class="btn btn-flat btn-info btn-sm">Edit</button>'
                        +'<button class="btn btn-flat btn-danger btn-sm">Delete</button>'
                        +'</td>'
                        +'</tr>'
                    );
                }
            })
            .error(function(data) {
                alert("Connection Error");
            });
    }

};

$(function(){ _tag = new tags(); });

$(document).ready(function() {

    $('[name=add-tag]').click(function(){
        _tag.newtag();
    });
    $('[name=add-tag-category]').click(function(){
        _tag.newtagcat();
    });


});