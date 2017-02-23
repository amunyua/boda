@extends('layouts.form')
@section('title','Manage My Wallet')
@section('page-title','Deposit to Wallet')
@section('page-title-small', 'Deposit to My Wallet')
@section('widget-title', 'Deposit to My Wallet')
@section('form-name', 'Deposit')

@push('js')
    <script src="{{ URL::asset('my_js/wallet/wallet.js') }}"></script>
@endpush

@section('breadcrumb')
    <li >
        <i class="fa fa-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="">Client</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><span>My Wallet</span></li>
@endsection

@section('content')
    <div id="feedback"></div>
    <form action="{{ url('/deposit-to-wallet') }}" method="post" class="smart-form" id="deposit-form">
        {{ csrf_field() }}
        <header>
            Deposit Funds from M-Pesa to your Wallet
        </header>
        <fieldset style="align-content: center;">
            <section class="col-md-6">
                <label class="input"> <i class="icon-append fa fa-money"></i>
                    <input type="text" name="deposit_amount" id="deposit_amount" placeholder="Amount to Deposit" min="10">
                </label>
            </section>
        </fieldset>
        <footer>
            <button type="submit" class="btn btn-info pull-left">
                <i class="fa fa-money"></i> Deposit
            </button>
        </footer>
    </form>
@endsection
