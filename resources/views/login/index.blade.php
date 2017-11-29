@extends('layouts.login')
@section('title', 'Login')
@section('system_name', 'BODA SQUARED')

@section('content')
    <div class="hero">
        <div class="pull-left login-desc-box-l">
            <h4 class="paragraph-header">Boda Squared Management Information System for Bike Riders.</h4>
            <div class="login-app-icons">
                <a href="http://bodasquared.co.ke" class="btn btn-danger btn-sm">Boda Squared</a>
            </div>
        </div>
        <img src="{{ URL::asset('img/demo/bike.jpg') }}" class="pull-right display-image" alt="" style="width:350px; height: 200px; margin-top: 50px;">
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <h5 class="about-heading">Do you have boda bodas of your own?</h5>
            <p>
                <a href="{{ url('register') }}">Register</a> as a client and provide boda bodas to riders.
            </p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <h5 class="about-heading">Not just boda boda!</h5>
            <p>
                We provide motorcycles to our riders.
            </p>
        </div>
    </div>
@endsection

@section('login-form')
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
        <div class="well no-padding">
            <form action="{{ url('/login') }}" id="login-form" class="smart-form client-form" method="post">
                {{ csrf_field() }}
                <header>
                    Sign In
                </header>

                <fieldset>
                    @include('common.success')
                    @if(isset($_GET['status']) && request('status') == 'success')
                        <div class="alert alert-{{ request('status') }}">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Success!</strong> Your account has been successfully verified! Please login to proceed to the second application.
                        </div>
                    @endif
                    @if(isset($_GET['status']) && request('status') == 'danger')
                        <div class="alert alert-{{ request('status') }}">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Whoops!</strong> Account NOT found! Please contact the admin at <b>admin@bodasquared.co.ke.</b>
                        </div>
                    @endif
                    <section>
                        <label class="label">E-mail</label>
                        <label class="input"> <i class="icon-append fa fa-user"></i>
                            <input type="email" name="email" autofocus>
                            <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
                    </section>

                    <section>
                        <label class="label">Password</label>
                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                            <input type="password" name="password">
                            <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
                        <div class="note">
                            <a href="forgotpassword.html">Forgot password?</a>
                        </div>
                    </section>

                    <section>
                        <label class="checkbox">
                            <input type="checkbox" name="remember" checked="">
                            <i></i>Stay signed in</label>
                    </section>
                </fieldset>
                <footer>
                    <button type="submit" class="btn btn-primary">
                        Sign in
                    </button>
                </footer>
            </form>

        </div>

        {{--<h5 class="text-center"> - Or sign in using -</h5>--}}

        {{--<ul class="list-inline text-center">--}}
            {{--<li>--}}
                {{--<a href="javascript:void(0);" class="btn btn-primary btn-circle"><i class="fa fa-facebook"></i></a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="javascript:void(0);" class="btn btn-info btn-circle"><i class="fa fa-twitter"></i></a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="javascript:void(0);" class="btn btn-warning btn-circle"><i class="fa fa-linkedin"></i></a>--}}
            {{--</li>--}}
        {{--</ul>--}}

    </div>
@endsection