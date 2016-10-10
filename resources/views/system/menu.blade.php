@extends('layouts.nestable')
@section('title', 'Menu')
@section('widget-title', '<i class="fa fa-list fa-fw "></i> Manage Menu')
@section('widget-desc', 'Manage the sidemenu')

@section('content')
    <div id="nestable-menu">
        <button type="button" class="btn btn-default" data-action="expand-all">
            Expand All
        </button>
        <button type="button" class="btn btn-default" data-action="collapse-all">
            Collapse All
        </button>

        <button type="button" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add Menu
        </button>

        <button type="button" class="btn btn-success">
            <i class="fa fa-save"></i> Save
        </button>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12">

            <h6>Side Menu</h6>

            <div class="dd" id="nestable3">
                <ol class="dd-list">
                    <li class="dd-item dd3-item" data-id="13">
                        <div class="dd-handle dd3-handle">
                            Drag
                        </div>
                        <div class="dd3-content">
                            Item 13

                            <div class="pull-right">
                                <div class="checkbox no-margin">
                                    <label>
                                        {{--<input type="checkbox" class="checkbox style-0" checked="checked">--}}
                                        <span class="font-xs"><a href="#edit-menu" data-dismiss="modal"><i class="fa fa-edit"></i> Edit</a></span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </li>
                    <li class="dd-item dd3-item" data-id="15">
                        <div class="dd-handle dd3-handle">
                            Drag
                        </div>
                        <div class="dd3-content">
                            <i class="fa fa-cogs"></i> System

                            <span class="pull-right">
                                <span class="onoffswitch">
									<input type="checkbox" name="start_interval" class="onoffswitch-checkbox" id="start_interval">
                                    <label class="onoffswitch-label" for="start_interval">
                                        <span class="onoffswitch-inner" data-swchon-text="ON" data-swchoff-text="OFF"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </span>
                                <span class="font-xs"><a href="#edit-menu" data-dismiss="modal"><i class="fa fa-edit"></i> Edit</a></span>
                            </span>

                        </div>
                        <ol class="dd-list">
                            <li class="dd-item dd3-item" data-id="16">
                                <div class="dd-handle dd3-handle">
                                    Drag
                                </div>
                                <div class="dd3-content">
                                    <i class="fa fa-pencil"></i> System

                                    <div class="pull-right">
                                        <div class="checkbox no-margin">
                                            <label>
                                                {{--<input type="checkbox" class="checkbox style-0" checked="checked">--}}
                                                <span class="font-xs"><a href="#edit-menu" data-dismiss="modal"><i class="fa fa-edit"></i> Edit</a></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dd-item dd3-item" data-id="17">
                                <div class="dd-handle dd3-handle">
                                    Drag
                                </div>
                                <div class="dd3-content">
                                    <i class="fa fa-list"></i> Menu

                                    <div class="pull-right">
                                        <div class="checkbox no-margin">
                                            <label>
                                                {{--<input type="checkbox" class="checkbox style-0" checked="checked">--}}
                                                <span class="font-xs"><a href="#edit-menu" data-dismiss="modal"><i class="fa fa-edit"></i> Edit</a></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </li>
                </ol>
            </div>

        </div>

    </div>
    <input type="text" id="nestable2-output" rows="3" class="form-control font-md"/>
@endsection