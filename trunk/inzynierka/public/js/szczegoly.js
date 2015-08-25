$(function() {
    $('.zdjecie').mouseover(function(){
        var id = $(this).attr('id');
        $("#" + id + " .szczegoly").addClass('pokaz');
    })
    .mouseout(function() {
        $(".szczegoly").removeClass('pokaz');
    });

    $('.zdjecie').click(function() {
        $('.zdjecie').removeClass('zaznacz');
        $(this).addClass('zaznacz');
    });
});