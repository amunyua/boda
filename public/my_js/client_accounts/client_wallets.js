/**
 * Created by SATELLITE on 1/16/2017.
 */
var Wallets = $('#client-wallets').DataTable({
    processing: true,
    serverSide: true,
    ajax: 'load-client-wallets', // should always for display
    columns: [
        {'data': 'client_account_id', 'name': 'client_account_id'},
        {'data': 'rider', 'name': 'rider'},
        {'data': 'wallet_balance', 'name': 'wallet_balance'},
        {'data': 'wallet_status', 'name': 'wallet_status'},
    ]
});
