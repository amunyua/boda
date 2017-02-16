@extends('layouts.dt')
@section('title', 'Inventory')
@section('page-title', 'Inventory')
@section('widget-title', 'Inventory')
@section('widget-desc', 'Manage All the Motor Bike Model')
@section('table-title', 'Bike Models')

@push('js')
    <script src="{{ URL::asset('my_js/inventory/bike_model.js') }}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{ url('/') }}"> Home</a></li>
    <li>Inventory</li>
    <li>Manage Bike Model</li>
@endsection

@section('button')
    {{--<span class="actions">--}}
    <div class="pull-right">
        <a data-toggle="modal" href="#add-bike-model-mod" id="" class="btn btn-success btn-sm header-btn hidden-mobile">
            <i class="fa fa-plus"></i> Add Model
        </a>

        <a href="#edit-bike-model" id="edit-model-btn" class="btn btn-warning btn-sm header-btn hidden-mobile">
            <i class="fa fa-edit"></i> Edit Model
        </a>
        <a href="#delete-bike-model" id="delete-model-btn" class="btn btn-danger btn-sm header-btn hidden-mobile">
            <i class="fa fa-trash"></i> Delete Model
        </a>
    </div>

    {{--</span>--}}
@endsection

@section('content')
    @include('layouts.includes._messages')
@section('table-id', '#bike-model')

<table id="bike-model" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>Id#</th>
        <th>Model</th>
        <th>Status</th>
    </tr>
    </thead>
</table>

@endsection

@section('modals')
    <!-- Modal -->
    <div class="modal fade" id="add-bike-model-mod" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                    <h4 class="modal-title">
                        Add Bike Model
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="add-model" class="smart-form" action="{{ url('add-bike-model') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Model</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="model" autocomplete="off"  value="{{ old('model') }}">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Status</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>
                        </fieldset>

                        <footer>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Save
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <i class="fa fa-remove"></i> Cancel
                            </button>
                        </footer>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal -->
    <div class="modal fade" id="edit-bike-model" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">
                        Edit Bike Model
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="add-model" class="smart-form" action="{{ url('edit-bike-model') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Model</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="model" autocomplete="off" id="model"  value="{{ old('model') }}">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row ">
                                    <label class="label col col-2">status</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="status" class="form-control" id="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <input type="hidden" name="edit_id" id="edit-model-id">
                            </section>
                        </fieldset>

                        <footer>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Save
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <i class="fa fa-remove"></i> Cancel
                            </button>
                        </footer>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{--modal for delete--}}
    <div class="modal fade" id="delete-bike-model" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">
                        Delete Bike Model
                    </h4>
                </div>
                <div class="modal-body no-padding">
                    <form class="smart-form" action="{{ url('delete-bike-model') }}" method="post">
                        <p>Are you sure you want to delete the selected records?</p>
                        {{ csrf_field() }}

                        {{--hidden fields--}}
                        <input type="hidden" id="edit_ids" name="edit_ids"/>
                        <footer>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Yes
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-remove"></i> No
                            </button>

                        </footer>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection