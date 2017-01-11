/**
 * Created by joel on 12/18/16.
 */

$('#table1 > tbody > tr').live('click', function(event){
    if(event.ctrlKey) {
        $(this).toggleClass('info');
    }
    else {
        if ( $(this).hasClass('info') ) {
            $('#table1 > tbody > tr').removeClass('info');
        }
        else {
            $('#table1 > tbody > tr').removeClass('info');
            $(this).toggleClass('info');
        }
    }
});

$('.edit_address').on('click', function(){
    $('#edit-address-form').attr('action','');
    var edit_id = $(this).attr('edit-id');
    var action = $(this).attr('action');
    if(edit_id != ''){
        $('#edit-address-form').attr('action',action);
        // ajax
        $.ajax({
            url: 'address-data/'+edit_id,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                $('#county').val(data['county']);
                $('#city').val(data['city']);
                $('#physical_address').val(data['physical_address']);
                $('#postal_address').val(data['postal_address']);
                $('#postal_code').val(data['postal_code']);
                $('#phone_no').val(data['phone_no']);
            }
        });
    }
});

$('.del-btn').on('click', function(){
    alert('ok');
    if(confirm('Are you sure you want to delete the selected Address?')){
        return true;
    }else{
        return false;
    }
});