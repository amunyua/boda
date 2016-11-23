/**
 * Created by alex on 01/11/16.
 */

$('.del_role').on('click', function () {
    var delete_id = $(this).attr('del-id');
    var action = $('#delete-role').attr('action');
    var new_action = action +'/'+delete_id;
    $('#delete-role').attr('action','');
    $('#delete-role').attr('action', new_action);
});

$('#routes-for-allocation').DataTable({
    processing: true,
    serverSide: true,
    ajax: 'load-routes-allocation',
    "aaSorting": [[ 1, 'asc' ]],
    columns: [
        { data: 'route_name', 'name': 'route_name' },
        { data: 'parent_route', 'name': 'parent_route' },
        { data: 'attach_detach', 'name': 'attach_detach' }
    ],
    columnDefs: [
        { searchable: false, targets: [2] },
        { orderable: false, targets: [2] }
    ]
});

$('#allocate-routes-view').on('click', function(){
    var selected = $('table#dt_basic > tbody > tr.select_tr').length;

    if(selected){
        if(selected == 1) {
            $(this).attr('data-toggle', 'modal');
            var role_id = $('#dt_basic > tbody > tr.select_tr').find('td:first').text();
            $('input:checkbox.attach').attr('role-id', role_id);
        }else if(selected > 1){
            alert('You can only allocate routes to one role at a time!');
        }
    }else{
        alert('You must select a route first!');
    }
});

$('table').on('click', 'input:checkbox.attach', function(){
    // check if the checkbox is checked
    var checked = $(this).is(':checked');
    if(checked){
        var route_id = $(this).val();
        var role_id = $(this).attr('role-id');

        if (route_id != ''){
            $.ajax({
                url: 'attach-route',
                type: 'POST',
                data: {
                    'route_id': route_id,
                    '_token': $('input[name="_token"]').val(),
                    'role_id': role_id
                },
                dataType: 'json',
                success: function(data){
                    if(data.success){
                        $.smallBox({
                            title : "Attached",
                            content : data.message,
                            color : "green",
                            iconSmall : "fa fa-check bounce animated",
                            timeout : 4000
                        });
                    }
                }
            });
        }
    }
});