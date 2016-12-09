var DT = $('#client-accounts').DataTable({
    serverSide: true,
    processing: true,
    "aaSorting": [[ 0, 'desc' ]],
    ajax: 'load-accounts',
    columns: [
        { data: 'id', name: 'id'},
        { data: 'bike_id', name: 'bike_id'},
        { data: 'masterfile_id', name: 'masterfile_id'},
        { data: 'client_account_status', name: 'client_account_status'}
    ]
});

$('#delete-account-btn').on('click',function () {
    var edit_ids = Common.onDeleteValidateSelection();

    if(edit_ids != false){
        // open modal
        $('#delete-account-item').modal('show');

        // populate the selected ids
        $('#edit_ids').val(edit_ids);

    }
});

$('#edit-account-btn').on('click',function () {
    var edit_id = Common.onEditValidateSelection();

    if(edit_id != false) {
        $('#edit-account-id').val(edit_id);
        // open modal
        $('#edit-account-modal').modal('show');
        $.ajax({
            url: 'get-client-account-details/'+edit_id,
            dataType: 'json',
            success: function (data) {
                $('#account-status').val(data['client_account_status']);
            }
        });
    }
})