@extends('layouts.dt')
@section('title', 'Client Wallets')
@section('page-title', 'Client Wallets')
@section('widget-title', 'Client Wallets')
@section('widget-desc', 'A list of all the clients and their wallets')
@section('table-title', 'Client Wallets')

@push('js')
<script src="{{ URL::asset('my_js/client_accounts/client_wallets.js') }}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{ url('/') }}"> Home</a></li>
    <li>Client</li>
    <li>Client Wallets</li>
@endsection

@section('content')
    <table id="client-wallets" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Account#</th>
            <th>Rider</th>
            <th>Balance</th>
            <th>Status</th>
        </tr>
        </thead>
    </table>

@endsection