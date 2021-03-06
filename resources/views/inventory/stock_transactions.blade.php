@extends('layouts.dt')
@section('title', 'Stock Transactions')
@section('page-title', 'Manage Transactions')
@section('widget-title', 'Manage Stock Transactions')
@section('widget-desc', 'All Stock Transactions')
@section('table-title', 'Stock Transactions')

@push('js')
<script src="{{ URL::asset('my_js/inventory/inventory_items.js') }}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{ url('/') }}"> Home</a></li>
    <li>Inventory</li>
    <li>Stock Transactions</li>
@endsection

@section('button')
    {{--<span class="actions">--}}
    <a data-toggle="modal" href="#create-inventory" id="add-route-btn" class="btn btn-success btn-sm header-btn hidden-mobile pull-right">
        <i class="fa fa-plus"></i> Create Stock Transaction
    </a>


    {{--</span>--}}
@endsection

@section('content')
    @include('layouts.includes._messages')
@section('table-id', '#stock-transactions')

<table id="stock-transactions" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>Id#</th>
        <th>Inventory item</th>
        <th>Transaction Category</th>
        <th>Transaction Type</th>
        <th>Quantity</th>
        <th>New Stock</th>
        <th>Transacted by</th>
    </tr>
    </thead>
</table>

@endsection

@section('modals')
    <!-- Modal -->
    <div class="modal fade" id="create-inventory" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Create Stock Transaction
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="create-inventory" class="smart-form" action="{{ url('create-transaction') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Inventory Item</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="inventory_item" class="form-control select2" id="" required>
                                                <option value="">Please select inventory item</option>
                                                @if(count($items))
                                                    @foreach($items as $item)
                                                        <?php
                                                        $item_name = App\Category::find($item->parent_category_id)->category_name;
                                                        ?>
                                                        <option value="{{ $item->id }}">{{ $item_name}}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row others">
                                    <label class="label col col-2">Transaction Category</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="transaction_category" class="form-control" id="">
                                                <option value="">Please select transaction Category</option>
                                                <option value="purchase">Purchase</option>
                                                <option value="reconciliation">Reconciliation</option>

                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row others">
                                    <label class="label col col-2">Transaction type</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="transaction_type" class="form-control" id="">
                                                <option value="">Please select transaction type</option>
                                                <option value="add">Add</option>
                                                <option value="subtract">Subtact</option>

                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Quantity</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="quantity" autocomplete="off"  value="{{ old('quantity') }}">
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