$(function(){
    $('.usun').click(function(){
        var id = $(this).attr('id');

        $('<div><div class="ui-state-error ui-corner-all">\n\
        <span class="ui-icon ui-icon-alert"/>\n\
        <strong>Czy jesteś pewny/pewna, że chcesz usunąć zdjęcie?<br />\n\
        Nie będzie można go odzyskać!</strong></div></div>')
        .dialog({
            dialogClass : 'myui',
            title       : 'Wymagane potwierdzenie',
            width       : 350,
            resizable   : false,
            modal       : true,
            buttons     : {
                Ok     : function() {
                    $(this).dialog('close');
                    $.ajax({
                        data: "id=" + id,
                        type: "POST",
                        url: "/zdjecia/usun",
                        success: function(msg) {
                            //                        location.reload();
                            //                        return false;
                            $('#'+id).remove();
                        }
                    });
                },
                Anuluj : function() {
                    $(this).dialog('close');
                }
            }
        });
    });
});