$(function() {
    $("#loading").ajaxStart(function(){
            $(this).show();
        }).ajaxStop(function(){
            $(this).hide();
        });

    $("li").click(function(){
        $('li').removeClass('selected');
        $(this).addClass('selected');

        var id = $(this).attr('id')
        $.ajax({
            data: "id=" + id,
            type: "POST",
            url: "/zdjecia/pokaz-zdjecia",
            success: function(msg) {
                $("div .container_album").html(msg);
            }
        });
    });
});