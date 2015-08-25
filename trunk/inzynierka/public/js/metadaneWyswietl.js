$(function() {
    //wczytywanie metadanych
    $('.scroller_album img').click(function(){
        var id = $(this).attr('id');
        $.ajax({
            data: "id=" + id,
            type: "POST",
            url: "/metadane",
            success: function(msg) {
                $("#right-column").html(msg);
            }
        });
    });
});