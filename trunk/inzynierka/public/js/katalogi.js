$(function() {
    $(':submit').button();
    $('.usun').button({
        icons: {
            primary: 'ui-icon-circle-minus'
        }
    });
    $('.dodaj').button({
        icons: {
            primary: 'ui-icon-circle-plus'
        }
    });

    //usuwanie katalogu
    $('.usun').click(function(){
        var id = $(this).attr('id');
        
        $('<div><div class="ui-state-error ui-corner-all">\n\
        <span class="ui-icon ui-icon-alert"/>\n\
        <strong>Czy jesteś pewny/pewna, że chcesz usunąć katalog?<br />\n\
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
                        url: "/katalogi/usun",
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

    //dodawanie nowego katalogu
    var $dialog_nowy = $('#nowy');
    $('.dodaj').click(function(){
        $dialog_nowy.dialog({
            dialogClass : 'myui',
            title       : 'Dodawanie nowego katalogu',
            width       : 350,
            resizable   : false,
            modal       : true,
            buttons     : {
                Anuluj : function() {
                    $(this).dialog('close');
                }
            }
        });
    });

    //edycja katalogu
    $('.jeditable').editable('/katalogi/edytuj', {
        type      : 'text',
        indicator : '<img src="../images/indicator.gif" height="20px" width="20px"/>',
        tooltip   : 'Kliknij, aby edytować...',
        submitdata : function () {
            return {
                'id': $(this).attr('id'),
                'value' : $(this).attr('value')
            };
        }
    });
});