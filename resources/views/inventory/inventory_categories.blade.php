@extends('layouts.dt')
@section('title', 'Inventory Categories')
@section('widget-title', 'Inventory Categories')
@section('widget-desc', 'Categories & subcategories')

@section('button')
    <ul class="list-inline pull-right">
        <li>
            <a href="#add-category" class="btn btn-primary btn-sm"  data-toggle="modal"><i class="fa fa-plus"> </i> Add Category</a>
        </li>
        <li>
            <a href="#edit-category-modal" class="btn btn-success btn-sm" id="edit-cat-btn"  data-toggle="modal"><i class="fa fa-edit"> Edit Category </i> </a>
        </li>
        <li>
            <a href="#delete-cat-modal"  class="btn btn-danger btn-sm" id="delete-cat-btn" data-toggle="modal"><i class="fa fa-remove"> </i> Delete Category</a>
        </li>
    </ul>

@endsection
@section('table-title', 'Inventory Categories')
@section('table-id', '#cats-table')
@section('content')
    @include('layouts.includes._messages')

<table id='cats-table' class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>Id#</th>
        <th>Category Name</th>
        <th>Category code</th>
    </tr>
    </thead>
</table>
@endsection

@section('modals')
    <div class="modal fade" id="add-category" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Add Category
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="add-menu-form" class="smart-form" action="{{ url('add-inventory-category') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Category Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="category_name" value="{{ old('category_name') }}">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Category Code</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="code" value="{{ old('role_code') }}">
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

    {{--modal for delete--}}
    <div class="modal fade" id="delete-cat-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Delete Category
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="delete-role" class="smart-form" action="{{ url('delete-inventory-cat') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <p class="p col col-10">
                                        Are you sure you want to delete this category?
                                    </p>
                                </div>
                            </section>

                            {{--{{ method_field('DELETE') }}--}}
                            <input type="hidden" name="CategoryId" id="delete-id">
                        </fieldset>

                        <footer>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Yes
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-remove"></i> Cancel
                            </button>

                        </footer>
                    </form>


                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    {{--modal for edit--}}
    <div class="modal fade" id="edit-category-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Edit Category
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="edit-userrole-form" action="{{ url('edit-inventory-cat') }}" class="smart-form" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Category Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="category_name" id="cat-name" >
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Code</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="code" id="code">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Status</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="status" class="form-control" id="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <input type="hidden" name="edit_id" id="edit-id">
                            </section>


                        </fieldset>

                        <footer>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Yes
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-remove"></i> Cancel
                            </button>

                        </footer>
                    </form>


                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    {{--modal for allocation--}}

@endsection

@push('js')
<script src="{{ URL::asset('my_js/inventory/inventory_cats.js') }}"></script>
@endpush