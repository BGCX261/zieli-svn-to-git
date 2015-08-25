$(function() {
    /**
     * Wszystkie checkboxy
     */
    var cb = $(this).find(':checkbox');

    /**
     * Zaznacz wszystkie
     */
    $('.zaznacz_wszystkie').click(function() {
        cb.attr('checked', 'true');
    });

    /**
     * Odznacz wszystkie
     */
    $('.odznacz_wszystkie').click(function() {
        cb.removeAttr('checked', 'true');
    });

    /**
     * Odwróć zaznaczenie
     */
    $('.odwroc_zaznaczenie').click(function() {
        $('.cb-element').each( function() {
            $(this).attr('checked', $(this).is(':checked') ? '' : 'checked');
        }).trigger('change');
    });
    /**
     * Błąd - nie zaznaczono zdjęcia
     */
    function nieZaznaczono() {
        $('<div><div class="ui-state-error ui-corner-all">\n\
           <span class="ui-icon ui-icon-alert"/>\n\
           <strong>Musisz zaznaczyć przynajmniej jedno zdjęcie!</strong></div></div>')
        .dialog({
            dialogClass : 'myui',
            title       : 'Nie zaznaczono zdjęcia',
            width       : 350,
            resizable   : false,
            modal       : true,
            buttons     : {
                Ok     : function() {
                    $(this).dialog('close');
                }
            }
        });
    }

    /**
     * Grupowy opis zdjęć.
     */
    $('.opisz').click(function() {
        var all_id = '';
        var count = 0;
        var checked = $(':checked');
        checked.each(function(){
            var id = $(this).attr('id');
            all_id += id + ' ';
            count++;
        });
        if(count > 0) {
            $.ajax({
                data: "id=" + all_id,
                type: "POST",
                url: "/metadane/grupa",
                success: function(msg) {
                    $("#right-column").html(msg);
                }
            });
        } else {
            nieZaznaczono();
        }
    });

    /**
     * Grupowe usuwanie zdjęć.
     */
    $('.usun_zaznaczone').click(function() {
        var all_id = '';
        var count = 0;
        var checked = $(':checked');
        checked.each(function(){
            var id = $(this).attr('id');
            all_id += id + ' ';
            count++;
        });
        if(count > 0) {
            var zdjecie = 'zdjęć';
            if (count == 1) {
                zdjecie = 'zdjęcie';
            } else if (count == 2 || count == 3 || count == 4) {
                zdjecie = 'zdjęcia';
            }
            $('<div><div class="ui-state-error ui-corner-all">\n\
                <span class="ui-icon ui-icon-alert"/>\n\
                <strong>Czy jesteś pewny/pewna, że chcesz usunąć ' + count + ' ' + zdjecie + '?<br />\n\
                Nie będzie można ich odzyskać!</strong></div></div>')
            .dialog({
                dialogClass : 'myui',
                title       : 'Wymagane potwierdzenie',
                width       : 350,
                resizable   : false,
                modal       : true,
                buttons     : {
                    Ok      : function() {
                        $(this).dialog('close');
                        $.ajax({
                            data: "id=" + all_id,
                            type: "POST",
                            url: "/zdjecia/usun",
                            success: function(msg) {
                                checked.each(function(){
                                    var id = $(this).attr('id');
                                    $('#'+id).remove();
                                });
                            }
                        });
                    },
                    Anuluj : function() {
                        $(this).dialog('close');
                    }
                }
            });
        } else {
            nieZaznaczono();
        }
    });
});