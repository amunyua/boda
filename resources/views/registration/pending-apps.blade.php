@extends('layouts.dt')
@section('title', 'Pending Applications')
@section('widget-title', 'Pending Applications')
@section('table-title', 'Pending Applications')

@push('js')
<script src="{{ URL::asset('my_js/applications/applications.js') }}"></script>
@endpush

@section('content')
    <table id="pending-apps" class="table table-bordered">
        <thead>
        <tr>
            <th><i class="fa fa-hashtag"></i> Applic#</th>
            <th><i class="fa fa-user"></i> F. Name</th>
            <th><i class="fa fa-user"></i> M. Name</th>
            <th><i class="fa fa-user"></i> Surname</th>
            <th><i class="fa fa-phone"></i> Phone</th>
            <th><i class="fa fa-envelope"></i> Email</th>
            <th><i class="fa fa-genderless"></i> Gender</th>
            <th><i class="fa fa-calendar"></i> Applic. Date</th>
            <th><i class="fa fa-check"></i>/<i class="fa fa-remove"></i> Approval Status</th>
        </tr>
        </thead>
    </table>
@endsection