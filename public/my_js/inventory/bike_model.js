var DT = $('#bike-model').DataTable({
    serverSide: true,
    processing: true,
    "aaSorting": [[ 0, 'desc' ]],
    ajax: 'load-models',
    columns: [
        { data: 'id', name: 'id'},
        { data: 'model', name: 'model'},
        { data: 'status', name: 'status'}
    ]
});

$('#delete-model-btn').on('click',function () {
    var edit_ids = Common.onDeleteValidateSelection();

    if(edit_ids != false){
        // open modal
        $('#delete-bike-model').modal('show');

        // populate the selected ids
        $('#edit_ids').val(edit_ids);

    }
});

$('#edit-model-btn').on('click',function () {
    var edit_id = Common.onEditValidateSelection();

    if(edit_id != false) {
        $('#edit-model-id').val(edit_id);
        // open modal
        $('#edit-model-modal').modal('show');
        $.ajax({
            url: 'get-bike-model-details/'+edit_id,
            dataType: 'json',
            success: function (data) {
                $('#model').val(data['model']);
                $('#status').val(data['status']);
            }
        });
    }
})