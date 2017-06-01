var DT = $('#cats-table').DataTable({
    serverSide: true,
    processing: true,
    "aaSorting": [[ 0, 'desc' ]],
    ajax: 'load-inv-cats',
    columns: [
        { data: 'id', name: 'id'},
        { data: 'category_name', name: 'category_name'},
        { data: 'status', name: 'status'}
    ]
});

$('#edit-cat-btn').on('click', function(e){
    var count = $('tr.select_tr').length;

    if(count){
        if(count > 1) {
            alert('You can only edit one record at a time!');
            $('#edit-route-btn').removeAttr('data-toggle');
        }else{
            var id = $('tr.select_tr').find('td:first').text();
            $('#edit-id').val(id);

            $.ajax({
                url: 'get-cat-edit/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#cat-name').val(data['category_name']);
                    $('#status').val(data['status']);
                    $('#code').val(data['code']);
                }
            });
        }
    }else{
        alert('You select a record first!');
        return false;
    }
});

$('#delete-cat-btn').on('click', function(){
    var count = $('tr.select_tr').length;

    if(count) {
        var id = $('tr.select_tr').find('td:first').text();
        $("#delete-id").val(id);
    }else{
        alert('You must select at least one record!');
        return false;
    }
});