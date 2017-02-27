@extends('layouts.dt')
@section('title', 'All Second Applications')
@section('widget-title', 'All Second Applications')
@section('table-title', 'All Second Applications')

@push('js')
<script src="{{ URL::asset('my_js/second_application/second_application.js') }}"></script>
@endpush

@section('button')
    <button id="approve-application" class="btn btn-success btn-sm header-btn">
        <i class="fa fa-check"></i> Approve Application
    </button>

    <button id="reject-application" class="btn btn-danger btn-sm header-btn">
        <i class="fa fa-remove"></i> Reject Application
    </button>
@endsection

@section('content')
    <div id="feedback"></div>
    {{ csrf_field() }}
@section('table-id', '#secn')
<table id="secn" class="table table-bordered">
    <thead>
    <tr>
        <th><i class="fa fa-hashtag"></i> Applic#</th>
        <th><i class="fa fa-user"></i> Applicant</th>
        <th><i class="fa fa-user"></i> School Living cert</th>
        <th><i class="fa fa-user"></i> Religious Reference</th>
        <th><i class="fa fa-phone"></i> Government Reference</th>
        <th><i class="fa fa-envelope"></i> ID card</th>
        <th><i class="fa fa-genderless"></i> Good Conduct</th>
        <th><i class="fa fa-check"></i>/<i class="fa fa-remove"></i> Approval Status</th>
    </tr>
    </thead>
</table>
@endsection