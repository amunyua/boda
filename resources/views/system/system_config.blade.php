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

@section('widget-title', 'System Configurations')
@section('form-name', 'Manage System Configurations')

@section('content')
    <form action="" method="post" id="order-form" class="smart-form" enctype="multipart/form-data">

        {{ csrf_field() }}
        @include('layouts.includes._messages')

        <header>Edit/Update System Configuration's</header>
        <fieldset>
            <div class="row">
                <section class="col col-6">
                    <label class="input"><i class="icon-append fa fa-bank"></i>
                        <input type="text" name="company_name" value="" placeholder="Company Name">
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"><i class="icon-append fa fa-envelope-o"></i>
                        <input type="text" name="email" value="" placeholder="Company Email">
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"><i class="icon-append fa fa-phone"></i>
                        <input type="text" name="tel_one" value="" placeholder="Company Telephone 1">
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"><i class="icon-append fa fa-phone"></i>
                        <input type="text" name="tel_two" value="" placeholder="Company Telephone 2">
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"><i class="icon-append fa fa-phone"></i>
                        <input type="text" name="tel_three" value="" placeholder="Company Telephone 3">
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"><i class="icon-append fa fa-building"></i>
                        <input type="text" name="physical_address" value="" placeholder="Company Physical Address">
                    </label>
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
                                        <img src="{{ URL::asset(empty($mf->image_path) ? 'img/avatars/item.png' : $mf->image_path) }}" alt="" />
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

        <footer style="">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ url('load-config') }}" class="btn btn-default">Reset</a>
        </footer>
    </form>
@endsection