@extends('layouts.dt')
@section('title', 'Motorbikes')
@section('page-title', 'Manage Motorbikes')
@section('widget-title', 'Manage Motorbikes')
@section('widget-desc', 'Manage All Motorbikes')
@section('table-title', 'Motorbikes')

@push('js')
    <script src="{{ URL::asset('my_js/inventory/inventory_items.js') }}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{ url('/') }}"> Home</a></li>
    <li>Inventory</li>
    <li>Manage Bikes</li>
@endsection

@section('button')
    {{--<span class="actions">--}}
    <a data-toggle="modal" href="#create-inventory" id="add-route-btn" class="btn btn-success btn-sm header-btn hidden-mobile">
        <i class="fa fa-plus"></i> Add Bikes
    </a>

    <a href="#edit-inventory" id="edit-inventory-btn" class="btn btn-warning btn-sm header-btn hidden-mobile">
        <i class="fa fa-edit"></i> Edit bikes
    </a>
    <a href="#delete-inventory-item" id="delete-inventory-btn" class="btn btn-danger btn-sm header-btn hidden-mobile">
        <i class="fa fa-trash"></i> Delete Bike
    </a>
    {{--</span>--}}
@endsection

@section('content')
    @include('layouts.includes._messages')
@section('table-id', '#motorbikes')

<table id="motorbikes" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Id#</th>
            <th>VIN</th>
            <th>Chassis Number</th>
            <th>Make</th>
            <th>Model</th>
            <th>Status</th>
            <th>Cost Price</th>
            <th>Attach</th>
        </tr>
    </thead>
</table>

@endsection

@section('modals')
    <!-- add bike Modal -->
    <div class="modal fade" id="create-inventory" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">
                        Create inventory item
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="create-inventory" class="smart-form" action="{{ url('store-bike') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Make</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="make" class="form-control" id="inventory-make">
                                                <option value="">Please select a category</option>
                                                @if(count($categories))
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Model</label>
                                    <div class="col col-10">
                                        <label class="input"><i class="icon-append fa fa-gears"></i>
                                            <input type="text" name="model" value="{{ old('model') }}">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">VIN</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="vin" autocomplete="off"  value="{{ old('item_name') }}">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Chassis Number</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="chassis_number" autocomplete="off"  value="{{ old('item_name') }}">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Cost price</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-money"></i>
                                            <input type="number" name="cost_price" autocomplete="off" value="{{ old('cost_price') }}">
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

    <!-- Edit Bike Modal -->
    <div class="modal fade" id="edit-inventory" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Edit inventory item
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="create-inventory" class="smart-form" action="{{ url('edit-inventory-item') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Make</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="make" class="form-control inventory-make" id="mk-cat">
                                                <option value="">Please select a category</option>
                                                {{--@if(count($categories))--}}
                                                    {{--@foreach($categories as $category)--}}
                                                        {{--<option value="{{ $category->id }}">{{ $category->category_name }}</option>--}}
                                                    {{--@endforeach--}}
                                                {{--@endif--}}
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Model</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="model" class="form-control inventory-model" id="e-model">
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">VIN</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="vin" autocomplete="off"  id="vin" value="{{ old('item_name') }}">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Chassis Number</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="chassis_number" id="chassis_number" autocomplete="off"  value="{{ old('item_name') }}">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Cost price</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="number" name="cost_price" id="cost_price" autocomplete="off" value="{{ old('cost_price') }}">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">status</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="status" class="form-control" id="inventory-status">
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

    {{--modal for delete--}}
    <div class="modal fade" id="delete-inventory-item" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Delete Inventory Item
                    </h4>
                </div>
                <div class="modal-body no-padding">
                    <form class="smart-form" action="{{ url('delete-bike') }}" method="post">
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

    <!-- Attach Insurance  bike Modal -->
    <div class="modal fade" id="attach-insurance" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Attach Insurance To A Bike
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="attach-insurance" class="smart-form" action="{{ url('attach-bike-insurance') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Insurance Name</label>
                                    <div class="col col-10">
                                        <label class="input"><i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="insurance_name" value="{{ old('insurance_name') }}">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Insurance Company Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="insurance_company_name" autocomplete="off"  value="{{ old('insurance_company_name') }}">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Issue Date</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                            <input type="text" name="issue_date" id="startdate" placeholder="Issue Date" value="">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Expiry Date</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                            <input type="text" name="expiry_date" id="finishdate" placeholder="Expiry Date" value="">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Status</label>
                                    <div class="col col-10">
                                        <label class="select">
                                            <select name="status" required>
                                                <option value="">--select status--</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select><i></i>
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
@endsection

