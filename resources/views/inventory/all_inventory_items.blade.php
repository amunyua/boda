@extends('layouts.dt')
@section('title', 'Inventory')
@section('page-title', 'Manage Inventory')
@section('widget-title', 'Manage Inventory')
@section('widget-desc', 'Manage All the Inventory Items')
@section('table-title', 'Inventory Items')

@push('js')
<script src="{{ URL::asset('my_js/inventory/inventory_items.js') }}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{ url('/') }}"> Home</a></li>
    <li>Inventory</li>
    <li>Manage Inventory</li>
@endsection

@section('button')
    {{--<span class="actions">--}}
    <ul class="list-unstyled list-inline pull-right">
        <li>
            <a data-toggle="modal" href="#create-inventory" id="add-route-btn" class="btn btn-success btn-sm header-btn hidden-mobile">
                <i class="fa fa-plus"></i> Add Inventory
            </a>
        </li>
        <li>
            <a href="#edit-inventory" id="edit-inventory-btn" class="btn btn-warning btn-sm header-btn hidden-mobile">
                <i class="fa fa-edit"></i> Edit Inventory
            </a>
        </li>
        <li>
            <a href="#delete-inventory-item" id="delete-inventory-btn" class="btn btn-danger btn-sm header-btn hidden-mobile">
                <i class="fa fa-trash"></i> Delete Inventory
            </a>
        </li>
    </ul>

    {{--</span>--}}
@endsection
@section('table-id', '#inventory-items')

@section('content')
@include('layouts.includes._messages')

<table id="inventory-items" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>Id#</th>
        <th>Item Name</th>
        <th>Item Code</th>
        <th>Item category</th>

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
                        Create inventory item
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="create-inventory" class="smart-form" action="{{ url('create-inventory-item') }}" method="post">
                        {{ csrf_field() }}

                        <fieldset>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Category</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="category_id" class="form-control select2" id="cat-id">
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
                                <div class="row ">
                                    <label class="label col col-2">Item Name</label>
                                    <div class="col col-10">
                                        <label class="input">
                                           <input name="item_name" id="item-name" class="form-control">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row ">
                                    <label class="label col col-2">Item Code</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <input name="item_code" id="item-code" class="form-control">
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

                    <form id="edit-inventory" class="smart-form" action="{{ url('edit-inventory-item') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Inventory Category</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="category_id" class="form-control inventory-make" id="category-id-edit">
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
                                <div class="row ">
                                    <label class="label col col-2">Item Name</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <input name="item_name" id="item-name-edit" class="form-control">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row ">
                                    <label class="label col col-2">Item Code</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <input name="item_code" id="item-code-edit" class="form-control">
                                        </label>
                                    </div>
                                </div>
                                <input type="text" name="edit_id" id="edit-item-id">
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
                       <fieldset>
                        <section>
                        <p>Are you sure you want to delete the selected record?</p>
                        {{ csrf_field() }}

                        {{--hidden fields--}}

                        <input type="hidden" id="edit_ids" name="edit_ids"/>
                        </section>
                       </fieldset>
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