/**
 * Created by Alx on 2/25/2017.
 */
var Fas = $('#secn').DataTable({
    processing: false,
    serverSide: true,
    "sScrollX": '100%',
    ajax: 'get-second-application',
    columns: [
        { data: 'id', name: 'id' },
        { data: 'first_application_id', name: 'first_application_id' },
        { data: 'school_cert', name: 'school_cert' },
        { data: 'religious_reference', name: 'religious_reference' },
        { data: 'government_character_reference', name: 'government_character_reference' },
        { data: 'identification_card', name: 'identification_card' },
        { data: 'good_conduct', name: 'good_conduct' },
        { data: 'status', name: 'status' }
    ]
});


$('#approve-application').on('click', function(){
    var ids = Common.onDeleteValidateSelection();

    if(ids != false){
        if(!confirm('Are you sure you want to approve the selected application(s)?'))
            return false;
        console.log(ids);
        $.ajax({
            url: 'approve-second-applications',
            type: 'POST',
            data: {
                app_no: ids,
                _token: $('input[name="_token"]').val()
            },
            dataType: 'json',
            success: function (data) {
                if(data.success){
                    Common.splash('success', data.message, '#no-modal');
                    Fas.ajax.reload();
                }else if(!data.success){
                    if(data.type == 'warning')
                        Common.splash('warning', data.warnings, '#no-modal');
                    else
                        Common.splash('success', data.message, '#no-modal');
                }
            }
        })
    }
});