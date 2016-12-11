/**
 * Created by erico on 12/10/16.
 */
var Fas = $('#fas').DataTable({
    processing: false,
    serverSide: true,
    ajax: 'all_applications/fas',
    columns: [
        { data: 'id', name: 'id' },
        { data: 'firstname', name: 'firstname' },
        { data: 'middlename', name: 'middlename' },
        { data: 'surname', name: 'surname' },
        { data: 'phone_no', name: 'phone_no' },
        { data: 'email', name: 'email' },
        { data: 'gender', name: 'gender' },
        { data: 'created_at', name: 'created_at' },
        { data: 'approval_status', name: 'approval_status' }
    ]
});

setInterval(function(){
    Fas.ajax.reload();
}, 60000);

var PendingApps = $('#pending-apps').DataTable({
    processing: false,
    serverSide: true,
    ajax: 'pending_applications/pending',
    columns: [
        { data: 'id', name: 'id' },
        { data: 'firstname', name: 'firstname' },
        { data: 'middlename', name: 'middlename' },
        { data: 'surname', name: 'surname' },
        { data: 'phone_no', name: 'phone_no' },
        { data: 'email', name: 'email' },
        { data: 'gender', name: 'gender' },
        { data: 'created_at', name: 'created_at' },
        { data: 'approval_status', name: 'approval_status' }
    ]
});

setInterval(function(){
    PendingApps.ajax.reload();
}, 60000);


var CanceledApps = $('#canceled-apps').DataTable({
    processing: false,
    serverSide: true,
    ajax: 'canceled_applications/canceled',
    columns: [
        { data: 'id', name: 'id' },
        { data: 'firstname', name: 'firstname' },
        { data: 'middlename', name: 'middlename' },
        { data: 'surname', name: 'surname' },
        { data: 'phone_no', name: 'phone_no' },
        { data: 'email', name: 'email' },
        { data: 'gender', name: 'gender' },
        { data: 'created_at', name: 'created_at' },
        { data: 'approval_status', name: 'approval_status' }
    ]
});

setInterval(function(){
    CanceledApps.ajax.reload();
}, 60000);

var ApprovedApps = $('#approved-apps').DataTable({
    processing: false,
    serverSide: true,
    ajax: 'approved_applications/approved',
    columns: [
        { data: 'id', name: 'id' },
        { data: 'firstname', name: 'firstname' },
        { data: 'middlename', name: 'middlename' },
        { data: 'surname', name: 'surname' },
        { data: 'phone_no', name: 'phone_no' },
        { data: 'email', name: 'email' },
        { data: 'gender', name: 'gender' },
        { data: 'created_at', name: 'created_at' },
        { data: 'approval_status', name: 'approval_status' }
    ]
});

setInterval(function(){
    ApprovedApps.ajax.reload();
}, 60000);


$('#approve-application').on('click', function(){
    var ids = Common.onDeleteValidateSelection();

    if(ids != false){
        if(!confirm('Are you sure you want to approve the selected application(s)?'))
            return false;
        console.log(ids);
        $.ajax({
            url: 'approve-applications',
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

$('#reject-application').on('click', function(){
    var ids = Common.onDeleteValidateSelection();

    if(ids != false){
        if(!confirm('Are you sure you want to reject the selected application(s)?'))
            return false;
        console.log(ids);
        $.ajax({
            url: 'reject-applications',
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