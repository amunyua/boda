@extends('layouts.profile')
@section('title', 'Masterfile Profile')
@section('widget-title', 'User')
@section('widget-desc', 'Profile')

@section('breadcrumb')
    <li >
        <i class="fa fa-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <span href="#">Registration</span>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="{{ url('all-mfs') }}">All Registration Record</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><span href="#">User Profile</span></li>
@endsection

@section('tab-content')
    {{ csrf_field() }}
    @include('layouts.includes._messages')
    <div class="row">
        <div class="col-sm-12">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="well well-light well-sm no-margin no-padding">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="myCarousel" class="carousel fade profile-carousel">
                                        <div class="air air-bottom-right padding-10">
                                            {{--<a href="javascript:void(0);" class="btn txt-color-white bg-color-teal btn-sm"><i class="fa fa-check"></i> Follow</a>&nbsp; <a href="javascript:void(0);" class="btn txt-color-white bg-color-pinkDark btn-sm"><i class="fa fa-link"></i> Connect</a>--}}
                                        </div>
                                        <div class="air air-top-left padding-10">
                                            <h4 class="txt-color-white font-md"><?php echo date('j M Y'); ?></h4>
                                        </div>
                                        <ol class="carousel-indicators">
                                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                            <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                                            <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                                        </ol>
                                        <div class="carousel-inner">
                                            <!-- Slide 1 -->
                                            <div class="item active">
                                                <img src="{{ URL::asset('img/demo/s1.jpg') }}" width="100%" alt="demo user">
                                            </div>
                                            <!-- Slide 2 -->
                                            <div class="item">
                                                <img src="{{ URL::asset('img/demo/s2.jpg') }}" width="100%" alt="demo user">
                                            </div>
                                            <!-- Slide 3 -->
                                            <div class="item">
                                                <img src="{{ URL::asset('img/demo/m3.jpg') }}" width="100%" alt="demo user">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-3 profile-pic">
                                            <img src="{{ URL::asset(empty($mf->image_path) ? 'img/avatars/photo.jpg' : $mf->image_path) }}" alt="" />
                                            {{--<img src="{{ URL::asset('img/avatars/sunny-big.png') }}" alt="demo user">--}}
                                            <div class="padding-10">
                                                {{--<h4 class="font-md"><strong>1,543</strong>--}}
                                                    {{--<br>--}}
                                                    {{--<small>Followers</small></h4>--}}
                                                {{--<br>--}}
                                                {{--<h4 class="font-md"><strong>419</strong>--}}
                                                    {{--<br>--}}
                                                    {{--<small>Connections</small></h4>--}}
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h1>{{ $mf->surname }} <span class="semi-bold">{{ $mf->firstname }}</span> {{ $mf->middlename }}
                                                <br>
                                                <small class="semi-bold"> {{ $mf->b_role }}</small>
                                            </h1>

                                            <ul class="list-unstyled">
                                                <li>
                                                    <p class="text-muted">
                                                        <i class="fa fa-phone"></i>&nbsp;&nbsp;<span class="txt-color-darken">{{ $addr->phone_no }}</span>
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="text-muted">
                                                        <i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="mailto:simmons@smartadmin">{{ $addr->email }}</a>
                                                    </p>
                                                </li>
                                                {{--<li>--}}
                                                    {{--<p class="text-muted">--}}
                                                        {{--<i class="fa fa-skype"></i>&nbsp;&nbsp;<span class="txt-color-darken">john12</span>--}}
                                                    {{--</p>--}}
                                                {{--</li>--}}
                                                <li>
                                                    <p class="text-muted">
                                                        <?php  $registration_date = $mf->registration_date; ?>
                                                        <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span class="txt-color-darken">Reg Date <a href="javascript:void(0);" rel="tooltip" title="" data-placement="top" data-original-title="User Created Date"><?php echo date('j M Y', strtotime($registration_date)); ?></a></span>
                                                    </p>
                                                </li>
                                            </ul>
                                            {{--<br>--}}
                                            {{--<p class="font-md">--}}
                                                {{--<i>A little about me...</i>--}}
                                            {{--</p>--}}
                                            {{--<p>--}}
                                                {{--Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio--}}
                                                {{--cumque nihil impedit quo minus id quod maxime placeat facere--}}
                                            {{--</p>--}}
                                            {{--<br>--}}
                                            {{--<a href="javascript:void(0);" class="btn btn-default btn-xs"><i class="fa fa-envelope-o"></i> Send Message</a>--}}
                                            {{--<br>--}}

                                        </div>
                                        <div class="col-sm-3">
                                            {{--<h1><small>Connections</small></h1>--}}
                                            {{--<ul class="list-inline friends-list">--}}
                                                {{--<li><img src="{{ URL::asset('img/avatars/1.png') }}" alt="friend-1">--}}
                                                {{--</li>--}}
                                                {{--<li><img src="{{ URL::asset('img/avatars/2.png') }}" alt="friend-2">--}}
                                                {{--</li>--}}
                                                {{--<li><img src="{{ URL::asset('img/avatars/3.png') }}" alt="friend-3">--}}
                                                {{--</li>--}}
                                                {{--<li><img src="{{ URL::asset('img/avatars/4.png') }}" alt="friend-4">--}}
                                                {{--</li>--}}
                                                {{--<li><img src="{{ URL::asset('img/avatars/5.png') }}" alt="friend-5">--}}
                                                {{--</li>--}}
                                                {{--<li><img src="{{ URL::asset('img/avatars/male.png') }}" alt="friend-6">--}}
                                                {{--</li>--}}
                                                {{--<li>--}}
                                                    {{--<a href="javascript:void(0);">413 more</a>--}}
                                                {{--</li>--}}
                                            {{--</ul>--}}

                                            {{--<h1><small>Recent visitors</small></h1>--}}
                                            {{--<ul class="list-inline friends-list">--}}
                                                {{--<li><img src="{{ URL::asset('img/avatars/male.png') }}" alt="friend-1">--}}
                                                {{--</li>--}}
                                                {{--<li><img src="{{ URL::asset('img/avatars/female.png') }}" alt="friend-2">--}}
                                                {{--</li>--}}
                                                {{--<li><img src="{{ URL::asset('img/avatars/female.png') }}" alt="friend-3">--}}
                                                {{--</li>--}}
                                            {{--</ul>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">

                                    <hr>
                                    <!-- widget content -->
                                    <div class="widget-body">
                                        <ul id="myTab1" class="nav nav-tabs bordered">
                                            @php
                                                $user = Auth::user();
                                                $b_role = \App\Masterfile::find($user->masterfile_id)->b_role;
                                            @endphp
                                            <li class="active">
                                                <a href="#s1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-user"></i>Basic Details</a>
                                            </li>
                                            <li>
                                                <a href="#s2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-envelope"></i> Manage Addresses</a>
                                            </li>
                                            @php
                                                if($b_role == 'Client'){
                                            @endphp
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Accounts Info <b class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="#s3" data-toggle="tab">@Bills</a>
                                                    </li>
                                                    <li>
                                                        <a href="#s4" data-toggle="tab">@Transaction</a>
                                                    </li>
                                                    <li>
                                                        <a href="#s5" data-toggle="tab">@Statement</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            @php } @endphp
                                            <li class="pull-right">
                                                <a href="javascript:void(0);">
                                                    <div class="sparkline txt-color-pinkDark text-align-right" data-sparkline-height="18px" data-sparkline-width="90px" data-sparkline-barwidth="7">
                                                        5,10,6,7,4,3
                                                    </div> </a>
                                            </li>
                                        </ul>

                                        <div id="myTabContent1" class="tab-content padding-10">
                                            <div class="tab-pane fade in active" id="s1">
                                                @include('registration.profile_info')
                                            </div>

                                            <div class="tab-pane fade" id="s2">
                                                @include('registration.address_info')
                                            </div>

                                            <div class="tab-pane fade" id="s3">
                                                @include('registration.rider_info')
                                            </div>

                                            <div class="tab-pane fade" id="s4">
                                                @include('registration.rider_info')
                                            </div>

                                            <div class="tab-pane fade" id="s5">
                                                @include('registration.rider_info')
                                            </div>

                                            <div class="tab-pane fade" id="s6">
                                                @include('registration.rider_info')
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end widget content -->
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
