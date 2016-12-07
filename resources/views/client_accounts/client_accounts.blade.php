@extends('layouts.dt')
@section('title', 'Client Accounts')
@section('page-title', 'Client Accounts')
@section('widget-title', 'Client Accounts')
@section('widget-desc', 'Manage All the Client Accounts')
@section('table-title', 'Client Accounts')

@push('js')
<script src="{{ URL::asset('my_js/client_accounts/client_accounts.js') }}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{ url('/') }}"> Home</a></li>
    <li>Client</li>
    <li>Manage Accounts</li>
@endsection

@section('button')
    {{--<span class="actions">--}}
    <div class="pull-right">
        <a data-toggle="modal" href="#create-client-account-mod" id="" class="btn btn-success btn-sm header-btn hidden-mobile">
            <i class="fa fa-plus"></i> Create Account
        </a>

        <a href="#edit-inventory" id="edit-inventory-btn" class="btn btn-warning btn-sm header-btn hidden-mobile">
            <i class="fa fa-edit"></i> Edit Account
        </a>
        <a href="#delete-inventory-item" id="delete-inventory-btn" class="btn btn-danger btn-sm header-btn hidden-mobile">
            <i class="fa fa-trash"></i> Delete Account
        </a>
    </div>

    {{--</span>--}}
@endsection

@section('content')
    @include('layouts.includes._messages')
@section('table-id', '#client-accounts')

<table id="client-accounts" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>Id#</th>
        <th>Bike</th>
        <th>Client</th>
        <th>Status</th>
    </tr>
    </thead>
</table>

@endsection

@section('modals')
    <!-- Modal -->
    <div class="modal fade" id="create-client-account-mod" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Create client account
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="create-inventory" class="smart-form" action="{{ url('create-client-account') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Motorbike</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="bike_id" class="form-control select2" id="" required>
                                                <option value="">Please select a motorbike</option>
                                                @if(count($bikes))
                                                    @foreach($bikes as $bike)
                                                        <option value="{{ $bike->id }}">{{ $bike->vin }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row others">
                                    <label class="label col col-2">Client</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="masterfile_id" class="form-control select2" required>
                                                <option value="">Please select a client</option>
                                                @if(count($clients))
                                                    @foreach($clients as $client)
                                                        <option value="{{ $client->id }}">{{ $client->surname.' '.$client->firstname.' '.$client->middlename }}</option>
                                                        @endforeach
                                                    @endif
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
                                <div class="row motorbike">
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
                                <div class="row motorbike">
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
                                <div class="row motorbike">
                                    <label class="label col col-2">VIN</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="vin" autocomplete="off"  id="vin" value="{{ old('item_name') }}">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row motorbike">
                                    <label class="label col col-2">Chassis Number</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="chassis_number" id="chassis_number" autocomplete="off"  value="{{ old('item_name') }}">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row others">
                                    <label class="label col col-2">Quantity</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="number" name="quantity" id="quantity" autocomplete="off" value="{{ old('quantity') }}">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row ">
                                    <label class="label col col-2">Cost price</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="number" name="cost_price" id="cost_price" autocomplete="off" value="{{ old('cost_price') }}">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row ">
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
                    <form class="smart-form" action="{{ url('delete-inventory-item') }}" method="post">
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