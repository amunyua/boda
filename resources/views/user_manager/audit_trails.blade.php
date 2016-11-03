@extends('layouts.dt')
@section('title', 'Audit Trail')
@section('widget-title', 'General Audit Trail')
@section('widget-desc', 'User Actions')

@section('button')
    {{--<button type="button" class="btn btn-primary pull-right header-btn hidden-mobile" data-toggle="modal" data-target="#add-user-role">--}}
        {{--<i class="fa fa-plus"></i> Add User Role--}}
    {{--</button>--}}
@endsection

@section('content')
    @include('layouts.includes._messages')

    <table id="dt_basic" class="table table-striped table-bordered table-hover audit-trails" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Action Name</th>
            <th>Action Time</th>
            <th>Session Id</th>
            <th>User Name</th>
        </tr>
        </thead>
        <tbody>
            {{--@if(count($audit_trails))--}}
                {{--@foreach($audit_trails as $audit_trail)--}}
                    {{--<tr>--}}
                        {{--<td>{{ $audit_trail->id }}</td>--}}
                        {{--<td>{{ $audit_trail->action_name }}</td>--}}
                        {{--<td>{{ $audit_trail->created_at }}</td>--}}
                        {{--<td>{{ $audit_trail->session_id }}</td>--}}
                        {{--<td>{{ $audit_trail->user_name }}</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
                {{--@endif--}}
        </tbody>
    </table>
@endsection

@push('js')
<script src="{{ URL::asset('custom_js/user_manager/audit-trails.js') }}"></script>
@endpush