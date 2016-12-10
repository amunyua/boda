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
