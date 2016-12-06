@extends('layouts.dt')
@section('title', 'All Registration')
@section('widget-title', 'All Registration')
@section('table-title', 'All Registration List')

@section('breadcrumb')
    <li >
        <i class="fa fa-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <span href="#">Registration</span>
    </li>
    <li><span>All Inactive Users</span></li>
@endsection

@section('content')
    @include('layouts.includes._messages')
    <table id="table1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>Reg#</th>
            <th>Created Date</th>
            <th>Name</th>
            <th>Customer Type</th>
            <th>E-mail</th>
            <th>Restore</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @if(count($mfs))
            @foreach($mfs as $mf)
                <tr>
                    <td>{{ $mf->id }}</td>
                    <td>{{ $mf->registration_date }}</td>
                    <td>{{ $mf->full_name }}</td>
                    <td>{{ $mf->role_name }}</td>
                    <td>{{ $mf->email }}</td>
                    <td><a href="{{ url('restore-mf/'.$mf->id) }}" class="btn btn-warning btn-xs edit_cat"><i class="fa fa-edit"></i> Restore</a> </td>
                    <td><a href="{{ url('delete-masterfile/'.$mf->id) }}" class="btn btn-danger btn-xs edit_cat" ><i class="fa fa-user"></i> Delete</a> </td>

                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection

@push('js')

@endpush