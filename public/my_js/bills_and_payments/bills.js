/**
 * Created by erico on 12/11/16.
 */
var CustomerBills = $('#cbs').DataTable({
    processing: true,
    serverSide: true,
    ajax: 'load-customer-bills',
    columns: [
        { data: 'id', name: 'id' },
        { data: 'service_name', name: 'service_name' },
        { data: 'rider', name: 'rider' },
        { data: 'bill_amount', name: 'bill_amount' },
        { data: 'amount_paid', name: 'amount_paid' },
        { data: 'bill_balance', name: 'bill_balance' },
        { data: 'bill_status', name: 'bill_status' }
    ]
});