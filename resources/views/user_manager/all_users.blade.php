@extends('layouts.dt')
@section('title', 'All Users')
@section('widget-title', 'Manage User Roles')
@section('widget-desc', 'All Users')

@section('button')
{{--<ul class="list-inline pull-right">--}}
    {{--<li>--}}
        {{--<button class="btn btn-primary btn-sm header-btn hidden-mobile" data-toggle="modal" data-target="#add-user-role">--}}
            {{--<i class="fa fa-plus"></i> Add User Role--}}
        {{--</button>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<button class="btn btn-info btn-sm header-btn hidden-mobile" id="allocate-routes-view"  data-target="#allocate-routes">--}}
            {{--<i class="fa fa-paperclip"></i> Allocate Routes--}}
        {{--</button>--}}
    {{--</li>--}}
{{--</ul>--}}
@endsection

@section('content')
@include('layouts.includes._messages')
@section('table-id', '#dt_basic')
<table id="dt_basic" class="table table-striped table-hover" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Role Name</th>
        <th>Status</th>
        <th>Block</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    @if(count($mfs))
    @foreach($mfs as $mf)
    <tr>
        <td>{{ $mf->user_id }}</td>
        <td>{{ $mf->full_name }}</td>
        <td>{{ $mf->role_name }}</td>
        <td><?php echo ($mf->status == 1)? '<span class="btn btn-success btn-xs "> Active </span>':'<span class="btn btn-success btn-xs">Inactive</span>' ?></td>
        <td><a href="{{ url('block-user/'.$mf->id) }}" edit-id="{{ $mf->id }}" data-toggle="modal"></a>
            {!! ($mf->status == 1)? '<span class="btn btn-warning btn-xs "> Block </span>' : '<span class="btn btn-success btn-xs">Unblock</span>' !!}
        </td>
        <td> <a href="{{ url('delete-user/'.$mf->user_id) }}" class="btn btn-danger btn-xs delete_user" data-toggle="modal" del-id="{{ $mf->user_id }}">Delete </a> </td>
    </tr>
    @endforeach
    @endif
    </tbody>
</table>
@endsection

@push('js')
    <script src="{{ URL::asset('my_js/user_manager/user_manager.js') }}"></script>
@endpush