/**
 * Created by erico on 11/29/16.
 */
// on edit
$('#edit-service-btn').on('click', function(){
    var id = Common.onEditValidateSelection();
    if(id != false){
        // open edit modal
        $('#update-service').modal('show');

        // get the details by the service id
        $.ajax({
            url: 'get-service/'+id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // populate modal fields
                $('#edit-id').val(data.id);
                $('#service_name').val(data.service_name);
                $('#service_code').val(data.service_code);
                $('#price').val(data.price);
                $('#parent_service').val(data.parent_service);
                $('#service_category').val(data.service_category_id);
                $('#status').val((data.service_status) ? 1 : 0);
            }
        });
    }
});

// on delete
$('#delete-service-btn').on('click', function(){
    var result = Common.onDeleteValidateSelection();
    if(result != false){
        $('#delete-service').modal('show');
        $('#edit_ids').val(result);
    }
});