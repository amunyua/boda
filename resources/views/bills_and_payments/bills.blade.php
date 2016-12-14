@extends('layouts.dt')
@section('title', 'Customer Bills')
@section('widget-title', 'Customer Bills')
@section('table-title', 'Customer Bills')

@push('js')
<script src="{{ URL::asset('my_js/bills_and_payments/bills.js') }}"></script>
@endpush

@section('button')
    {{--<button id="approve-application" class="btn btn-success btn-sm header-btn">--}}
        {{--<i class="fa fa-check"></i> Approve Application--}}
    {{--</button>--}}

    {{--<button id="reject-application" class="btn btn-danger btn-sm header-btn">--}}
        {{--<i class="fa fa-remove"></i> Reject Application--}}
    {{--</button>--}}
@endsection

@section('content')
    <div id="feedback"></div>
    {{ csrf_field() }}
    {{--@section('table-id', '#cbs')--}}
    <table id="cbs" class="table table-bordered">
        <thead>
            <tr>
                <th>Bill#</th>
                <th>Service</th>
                <th>Rider</th>
                <th>Bill Amount</th>
                <th>Amount Paid</th>
                <th>Bill Balance</th>
                <th>Bill Status</th>
            </tr>
        </thead>
    </table>
@endsection