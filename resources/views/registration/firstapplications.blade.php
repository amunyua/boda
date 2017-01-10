@extends('layouts.dt')
@section('title', 'All Applications')
@section('widget-title', 'All Applications')
@section('table-title', 'All Applications')

@push('js')
    <script src="{{ URL::asset('my_js/applications/applications.js') }}"></script>
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
    @section('table-id', '#fas')
    <table id="fas" class="table table-bordered">
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