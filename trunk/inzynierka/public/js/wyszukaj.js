$(function() {
    $("#loading").ajaxStart(function(){
        $(this).show();
    }).ajaxStop(function(){
        $(this).hide();
    });

    var szukaj = 'Szukaj..';

    $('#filtersearch').focus(function() {
        var text = $(this).val();
        if(text == szukaj) {
            $(this).val('');
        }
    })
    .blur(function() {
        var text = $(this).val();
        if(text == '') {
            $(this).val(szukaj);
        }
    });

    function wyslij() {
        $('li').removeClass('selected');

        var fraza = $('#filtersearch').val();
        $.ajax({
            data: 'fraza=' + encodeURIComponent(fraza),
            type: "POST",
            url: "/zdjecia/wyszukaj",
            success: function(msg) {
                $("div .container_album").html(msg);
            }
        });
    }

    $('.search_btn').click(function(){
        var fraza = $('#filtersearch').val();
        if (fraza == 'Szukaj..') {
            alert('Podaj przynajmniej 1 słowo kluczowe.');
        } else {
            wyslij();
        }
    });

    $('#filtersearch').bind('keypress', function(e) {
        var code = e.keyCode || e.which;
        if(code == 13) {
            wyslij();
        }
    });
});