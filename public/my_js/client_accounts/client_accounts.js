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