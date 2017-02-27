@extends('layouts.tree_view')
@section('title', 'Inventory Categories')
@section('widget-title', 'Inventory Categories')
@section('widget-desc', 'Categories & subcategories')

@section('button')
    {{--<ul class="list-inline pull-right">--}}
        {{--<li>--}}
            {{--<button class="btn btn-primary btn-sm header-btn hidden-mobile" data-toggle="modal" data-target="#add-user-role">--}}
                {{--<i class="fa fa-plus"></i> Add User Role--}}
            {{--</button>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<button class="btn btn-info btn-sm header-btn hidden-mobile" id="allocate-routes-view"  data-target="#allocate-routes">--}}
                {{--<i class="fa fa-paperclip"></i> Allocate Routes--}}
            {{--</button>--}}
        {{--</li>--}}
    {{--</ul>--}}
@endsection
@section('tree_header','Inventory Categories')
@section('content')
    @include('layouts.includes._messages')
    <div class="row">
        <div class="col-sm-12 col-md-12 text-align-right pull-right">

            <a href="#add-category" class="btn btn-primary btn-xs" style="margin-right: 10px" data-toggle="modal"><i class="fa fa-plus"> </i> Add Category</a>
            <a class="btn btn-success btn-xs" style="margin-right: 10px" data-toggle="modal"><i class="fa fa-edit"> Edit Category </i> </a>
            <a  class="btn btn-danger btn-xs" style="margin-right: 10px" data-toggle="modal"><i class="fa fa-remove"> </i> Delete Category</a>

        </div>

    </div>
    <div class="tree smart-form">

            <?php
            $categories = new \App\Http\Controllers\InventoryController();
            $categories->arrangeTree(NULL);
            ?>

    </div>
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
                                    <label class="label col col-2">Parent Category</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="parent_category" class="form-control select2" required>
                                                <option value="">Choose Parent Category</option>
                                                <option value="Null">No Parent</option>
                                                @if(count($parent_categories))
                                                    @foreach($parent_categories as $parent_category)
                                                        <option value="{{ $parent_category->id }}">{{ $parent_category->category_name }}</option>
                                                        @endforeach
                                                    @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>
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
    <div class="modal fade" id="delete-user-role" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Delete User Role
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="delete-role" class="smart-form" action="{{ url('delete-user-role') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <p class="p col col-10">
                                        Are you sure you want to delete this role?
                                    </p>
                                </div>
                            </section>

                            {{ method_field('DELETE') }}

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
    <div class="modal fade" id="edit-role-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Edit User Role
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="edit-userrole-form" class="smart-form" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Role Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="role_name" id="role_name" >
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Role Code</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="role_code" id="role_code">
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
    <div class="modal fade" id="allocate-routes" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Allocate Routes to <b>{{ strtoupper('Administrator') }}</b>
                    </h4>
                </div>
                <div class="modal-body" style="height: 520px; overflow-y: scroll;">
                    {{ csrf_field() }}
                    <table id="routes-for-allocation" class="table table-striped" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Route</th>
                            <th>Parent</th>
                            <td><input type="checkbox" id="check-all" class="custom_checkbox"/></td>
                        </tr>
                        </thead>
                    </table>

                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection

@push('js')
<script src="{{ URL::asset('custom_js/user_manager/user_roles.js') }}"></script>
@endpush