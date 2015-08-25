//edycja metadanych
$(function() {
    $('.metadane').editable('/metadane/edytuj', {
        placeholder : '...............',
        type        : 'text',
        indicator   : '<img src="../images/indicator.gif" height="20px" width="20px"/>',
        tooltip     : 'Kliknij, aby edytować...',
        submitdata  : function () {
            return {
                'id'    : $('table').attr('id'),
                'pole'  : $(this).attr('id'),
                'value' : $(this).attr('value')
            };
        }
    });
});