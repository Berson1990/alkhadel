//Define videos Class
var videos = function () {};

// Add new Video Category
videos.prototype.newvidcat = function(){
    if (!$.trim($("[name=video-category]").val()) ){
    $('[name=video-error]').html("Please Type Category Name");
    }else {
        $.ajax({
            url: "/dashboard/video-categories/api",
            type: "get",
            data: {
                catname: $('[name=video-category]').val(),
                csrf: $('[name=csrf]').val()
            },
            dataType: "json"
        })
            .done(function (output) {
                alert(output.message)
                if (output.status == true) {
                     $('#tbl-video-category').append(
                     '<tr>'
                     +'<td>'+ $('[name=video-category]').val() +'</td>'
                     +'<td>'
                     +'<button class="btn btn-flat btn-info btn-sm">Rename</button>'
                     +'<button class="btn btn-flat btn-danger btn-sm">Delete</button>'
                     +'</td>'
                     +'</tr>'
                     );
                }
            })
            .error(function (data) {
                alert("Connection Error");
            });
    }
};
// Add new Video
videos.prototype.newvideo = function(){
    $.ajax({
        url: "/dashboard/add-video/api",
        type: "get",
        data: {
            "frm-data": $('#frm-publish-video').serialize()
        },
        dataType: "json"
    })
        .done(function (output) {
            if (output.status == false){
                var error = '';
                $.each(output.message, function( index, value ) {
                    error += value + '\n';
                });
                alert(error);
            }else if(output.status == true){
                alert(output.message);
                window.location.href="/dashboard/videos";
            }
        })
        .error(function (data) {
            alert("Connection Error");
        });
};
// modify new Video
videos.prototype.modifyvideo = function($id){
    $.ajax({
        url: "/dashboard/videos/" + $id + "/api",
        type: "get",
        data: {
            "frm-data": $('#frm-publish-video').serialize()
        },
        dataType: "json"
    })
        .done(function (output) {
            if (output.status == false){
                var error = '';
                $.each(output.message, function( index, value ) {
                    error += value + '\n';
                });
                alert(error);
            }else if(output.status == true){
                alert(output.message);
                window.location.href="/dashboard/videos";
            }
        })
        .error(function (data) {
            alert("Connection Error");
        });
};

$(function(){ _vid = new videos(); });

$(document).ready(function() {
    $('[name=add-video-category]').click(function(){
        _vid.newvidcat();
    });
    $('[name=publish-video]').click(function(){
        _vid.newvideo();
    });
    $('[name=update-video]').click(function(){
        var url = (window.location).href
        _vid.modifyvideo(url.substring(url.lastIndexOf('/') + 1));
    });
    $('[name=youtube-id]').focusout(function(){
        var YoutubeId = $('[name=youtube-id]').val();
        if ($.trim(YoutubeId) ){
            $('[name=youtube-frame]').attr('src','http://www.youtube.com/embed/' + YoutubeId );
            $('[name=thumb-link]').val('http://img.youtube.com/vi/'+ YoutubeId +'/0.jpg');
        }
    });



});