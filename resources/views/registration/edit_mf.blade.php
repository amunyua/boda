@extends('layouts.form')
@section('title','Edit Registration')
@section('page-title','Edit Registration')
@section('page-title-small', 'Registration')

@section('breadcrumb')
    <li >
        <i class="fa fa-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="{{ url('/all-mfs') }}">All Registration</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><span>Edit Registration</span></li>
@endsection

@section('widget-title', 'Edit Registration')
@section('form-name', 'Edit Registration')

@section('content')
    <!-- BEGIN FORM -->
    <form id="order-form" class="smart-form" novalidate="novalidate">
        <header>
            Edit User Registration Info
        </header>
        <fieldset>
            <div class="row">
                <section class="col col-6">
                    <label class="select"> <i class="icon-append fa fa-user"></i>
                        <select name="b_role" id="b_role" class="form-control">
                            <option value="">Select Buss Role</option>
                            <option value="Administrator" {{ (old('b_role') == 'Administrator') ? 'selected': '' }}>System Admin</option>
                            <option value="Staff" {{ (old('b_role') == 'Staff') ? 'selected': '' }}>Staff</option>
                            <option value="Client" {{ (old('b_role') == 'Client') ? 'selected': '' }}>Client</option>
                        </select>
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" name="surname" placeholder="Surname">
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" name="firstname" placeholder="First Name">
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" name="middlename" placeholder="Middle Name">
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" name="id_no" placeholder="Id No.">
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-phone"></i>
                        <input type="tel" name="phone" placeholder="Phone" data-mask="(999) 999-9999">
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                        <input type="email" name="email" placeholder="E-mail">
                    </label>
                </section>
            </div>
        </fieldset>

        <header>
            Edit User Address Info
        </header>
        <fieldset>
            <div class="row">
                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-map-marker fa-fw"></i>
                        <input type="text" name="postal_address" placeholder="Postal Address">
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-map-marker fa-fw"></i>
                        <input type="text" name="postal_code" placeholder="Postal Code">
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-map-marker fa-fw"></i>
                        <input type="text" name="physical_address" placeholder="Physical Address">
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                        <input type="text" name="id_no" placeholder="Address Type">
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-phone"></i>
                        <input type="tel" name="phone" placeholder="Telephone" data-mask="(999) 999-9999">
                    </label>
                </section>
            </div>
        </fieldset>

        <footer>
            <button type="submit" class="btn btn-primary">
                Validate Form
            </button>
        </footer>
    </form>
    {{--END FORM--}}
@endsection
