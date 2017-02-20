@extends('layouts.form')
@section('title','Attach Insurance')
@section('page-title','Inventory')
@section('page-title-small', 'Manage Motorbikes')

@section('breadcrumb')
    <li >
        <i class="fa fa-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="">Inventory</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="{{ url('/bikes') }}">Manage Motorbikes</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><span>Attach Insurance to Bike</span></li>
@endsection

@section('widget-title', 'Attach Insurance to Bike')
{{--@section('form-name', '<span style="color: #00a300">'. $mf->surname.' '.$mf->surname.' '.$mf->middlename .'</span>')--}}

@section('content')
    <!-- BEGIN FORM -->
    <form action="" method="post" id="order-form" class="smart-form" novalidate="novalidate"  enctype="multipart/form-data">
        {{ csrf_field() }}
        @include('layouts.includes._messages')

        <header>
            Attach Bike Insurance Info
        </header>
        <fieldset>

            <div class="row">
                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                        <input type="text" name="insurance_name" placeholder="Insurance Name" value="{{ ($ins->insurance_name) }}">
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                        <input type="text" name="insurance_company_name" placeholder="Insurance Company Name" value="{{ ($ins->insurance_company_name) }}">
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-calendar"></i>
                        <input type="text" name="issue_date" placeholder="Issue Date" id="startdate" value="">
                    </label>
                </section>

                <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-calendar"></i>
                        <input type="text" name="expiry_date" placeholder="Expiry Date" id="finishdate" value="">
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="select"><i class="icon-append fa fa-user"></i></label>
                    <select name="status" class="form-control" id="status">
                        <option value="1"  {{  ($ins->gender == 1) ? 'selected': '' }} >Active</option>
                        <option value="0" {{  ($ins->gender == 0) ? 'selected': '' }} >Inactive</option>
                    </select>
                </section>
            </div>

        </fieldset>

        <footer style="">
            <a href="{{ url('edit-mf/'.$ins->id) }}" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </footer>
    </form>
    {{--END FORM--}}
@endsection