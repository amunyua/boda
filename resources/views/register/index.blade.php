@extends('layouts.login')
@section('title', 'Client Registration')
@section('system_name', 'Client Registration')

@section('login-form')
    <div class="col-md-10 col-md-offset-1">
        <div class="well no-padding">
            <form action="{{ url('client/register') }}" id="login-form" class="smart-form client-form" method="post">
                {{ csrf_field() }}
                <header>
                    Register below to start providing Boda Bodas to riders as well as monitor their daily collections.
                </header>

                <fieldset>
                    @include('common.warnings')
                    @include('common.error')
                    <section>
                        <label class="label">First Name</label>
                        <label class="input"> <i class="icon-append fa fa-user"></i>
                            <input type="text" name="fname" value="{{ old('fname') }}" autofocus required>
                            <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter first name</b></label>
                    </section>

                    <section>
                        <label class="label">Last Name</label>
                        <label class="input"> <i class="icon-append fa fa-user"></i>
                            <input type="text" name="lname" value="{{ old('lname') }}">
                            <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter last name</b></label>
                    </section>

                    <section>
                        <label class="label">Surname</label>
                        <label class="input"> <i class="icon-append fa fa-user"></i>
                            <input type="text" name="surname" value="{{ old('surname') }}" required>
                            <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter surname</b></label>
                    </section>

                    <section>
                        <label class="label">E-mail</label>
                        <label class="input"> <i class="icon-append fa fa-envelope"></i>
                            <input type="email" name="email" value="{{ old('email') }}" required>
                            <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address</b></label>
                    </section>

                    <section>
                        <label class="label">Phone No</label>
                        <label class="input"> <i class="icon-append fa fa-phone"></i>
                            <input type="text" name="phone_no" value="{{ old('phone_no') }}" placeholder="For example, +254712345678" required>
                            <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter your phone number</b></label>
                    </section>

                    <section>
                        <label class="label">Password</label>
                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                            <input type="password" name="password">
                            <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
                    </section>

                    <section>
                        <label class="label">Confirm Password</label>
                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                            <input type="password" name="password_confirmation">
                            <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Repeat the password</b> </label>
                    </section>
                </fieldset>
                <footer>
                    <button type="submit" class="btn btn-primary">
                        Register
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