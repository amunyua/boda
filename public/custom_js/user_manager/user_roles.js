/**
 * Created by alex on 01/11/16.
 */

$('.del_role').on('click', function () {
    var delete_id = $(this).attr('del-id');
    var action = $('#delete-role').attr('action');
    var new_action = action +'/'+delete_id;
    $('#delete-role').attr('action','');
    $('#delete-role').attr('action', new_action);


})
