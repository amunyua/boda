/**
 * Created by erico on 11/29/16.
 */
$('#delete-service-btn').on('click', function(){
    var result = Common.onDeleteValidateSelection();
    if(result != false){
        $('#delete-service').modal('show');
        $('#edit_ids').val(result);
    }
});