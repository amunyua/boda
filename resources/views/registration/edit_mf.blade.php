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
@section('form-name', '<span style="color: #00a300">'. $mf->surname.' '.$mf->surname.' '.$mf->middlename .'</span>')

@section('content')
    <!-- BEGIN FORM -->
    <form action="" method="post" id="order-form" class="smart-form" novalidate="novalidate"  enctype="multipart/form-data">
        {{ csrf_field() }}
        @include('layouts.includes._messages')

        <header>
            Edit User Registration Info
        </header>
        <fieldset>
            <div class="row">
                <section class="col col-6">
                    <label class="select"> <i class="icon-append fa fa-user"></i>
                        <select name="b_role" id="b_role" class="form-control">
                            <option value="">Select Buss Role</option>
                            <option value="Administrator" {{  ($mf->b_role == 'System Administrator') ? 'selected': '' }} >System Admin</option>
                            <option value="Staff" {{  ($mf->b_role == 'Client') ? 'selected': '' }} >Staff</option>
                            <option value="Client" {{  ($mf->b_role == 'Staff') ? 'selected': '' }} >Client</option>
                        </select>
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" name="id_no" placeholder="Id No." value="{{ ($mf->id_no) }}">
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" name="surname" placeholder="Surname" value="{{ ($mf->surname) }}">
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" name="firstname" placeholder="First Name" value="{{ ($mf->firstname) }}">
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" name="middlename" placeholder="Middle Name" value="{{ ($mf->middlename) }}">
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-phone"></i>
                        <input type="tel" name="phone_no" placeholder="Phone" value="{{ ($ad->phone_no) }}">
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                        <input type="email" name="email" placeholder="E-mail" value="{{ ($ad->email) }}">
                    </label>
                </section>

                <section class="col col-6">
                    <label class="select"><i class="icon-append fa fa-user"></i></label>
                    <select name="gender" class="form-control" id="gender">
                        <option value="1"  {{  ($mf->gender == 1) ? 'selected': '' }} >Male</option>
                        <option value="0" {{  ($mf->gender == 0) ? 'selected': '' }} >Female</option>
                    </select>
                </section>
            </div>
            <div class="row">
                <section class="col col-6">
                    <div class="row-fluid" style="margin-left: 20%">
                        <div class="span6">
                            {{--<label class="control-label">Profile Pic</label>--}}
                            <div class="controls">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                                        <img src="{{ URL::asset(empty($mf->image_path) ? 'img/avatars/photo.jpg' : $mf->image_path) }}" alt="" />
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 100px; max-height: 100px; line-height: 20px;"></div>
                                    <div>
                                        <label class="btn btn-file"><span class="fileupload-new">Select image</span>
                                            <span class="fileupload-exists">Change</span>
                                            <input class="span12" type="file" name="image_path"/>
                                        </label>
                                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <input type="text" name="postal_address" placeholder="Postal Address" value="{{ ($ad->postal_address) }}">
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-map-marker fa-fw"></i>
                        <input type="text" name="postal_code" placeholder="Postal Code" value="{{ ($ad->postal_code) }}">
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-map-marker fa-fw"></i>
                        <input type="text" name="physical_address" placeholder="Physical Address" value="{{ ($ad->physical_address) }}">
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-phone"></i>
                        <input type="tel" name="tel_no" placeholder="Telephone" data-mask="(254) 999-999-999" value="{{ ($ad->tel_no) }}">
                    </label>
                </section>
            </div>
        </fieldset>

        <footer style="">
            <a href="{{ url('soft-delete-mf/'.$mf->id) }}" class="btn btn-danger">Delete</a>
            <a href="{{ url('edit-mf/'.$mf->id) }}" class="btn btn-default">Reset</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </footer>
    </form>
    {{--END FORM--}}
@endsection
