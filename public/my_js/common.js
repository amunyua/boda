/**
 * Created by erico on 11/26/16.
 */
var Common = {
    splash: function(type, message, modal){
        switch(type){
            case 'success':
                var html = '';
                html += '<div class="alert alert-success">';
                html += '<button class="close" data-dismiss="alert">&times;</button>';
                html += '<strong>Success!</strong> '+message;
                html += '</div>';
                $('div#feedback').html(html);
                Common.closeModal(modal);
                break;

            case 'warnings':
                var html = '';
                for(var key in data.errors){
                    var errors = data.errors[key];
                    for(var i = 0; i < errors.length; i++){
                        html += '<li>'+errors[i]+'</li>';
                    }
                }
                $('div#feedback').html(html);
                break;

            case 'error':
                var html = '';
                html += '<div class="alert alert-error">';
                html += '<button class="close" data-dismiss="alert">&times;</button>';
                html += '<strong>Error!</strong> '+message;
                html += '</div>';
                $('div#feedback').html(html);
                Common.closeModal(modal);
                break;
        }
    },
    onEditValidateSelection: function(){
        var selected = $('tr.select_tr').length;
        if (selected){
            if(selected > 1){
                alert('You can only edit one record at a time!');
                return false;
            }else{
                return $('tr.select_tr td:first').text();
            }
        }else{
            alert('You must select at least one record!');
        }
        return false;
    },
    onDeleteValidateSelection: function () {
        var selected = $('tr.select_tr').length;
        var edit_ids = [];
        if (selected){
            $('tr.select_tr').each(function(){
                edit_ids.push($(this).find('td:first').text());
            });
            return edit_ids;
        }else{
            alert('You must select at least one record!');
            return false;
        }
    },
    closeModal: function (modal) {
        if(modal != '')
            $(modal).modal('show');
    }
}