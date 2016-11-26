/**
 * Created by erico on 11/26/16.
 */
var Services = {

};

$('#edit-scat-btn').on('click', function(){
    var edit_id = Common.onEditValidateSelection();

    if(edit_id != false){
        // open modal
        $('#edit-scat').modal('show');

        // do ajax that will load the selected item's details
        $.ajax({
            url: 'get-scat-details/'+edit_id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var count = data.length;
                if (count){
                    $('#sc_name').val(data[0].service_category_name);
                    $('#sc_code').val(data[0].service_category_code);
                    $('#status').val(data[0].service_category_status);
                }
            }
        });
    }
});