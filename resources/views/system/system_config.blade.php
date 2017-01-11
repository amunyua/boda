@extends('layouts.form')
@section('title','Manage System Configuration')
@section('page-title','Manage System')
@section('page-title-small', 'Configuration')

@section('breadcrumb')
<li >
    <i class="fa fa-home"></i>
    <a href="{{ url('/home') }}">Home</a>
    <span class="icon-angle-right"></span>
</li>
<li>
    <a href="">System</a>
    <span class="icon-angle-right"></span>
</li>
<li><span>System Config</span></li>
@endsection

@section('widget-title', 'Manage System Configurations')