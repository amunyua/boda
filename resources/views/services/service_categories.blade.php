@extends('layouts.dt')
@section('title', 'Service Categories')
@section('widget-title', 'Service Categories')
@section('table-title', 'Service Categories List')

@push('js')
    <script src="{{ URL::asset('my_js/services/service_cats.js') }}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{ url('/dashboard') }}"> Home</a></li>
    <li>Services</li>
    <li>Service Categories</li>
@endsection

@section('button')
    {{--<span class="actions">--}}
    <a data-toggle="modal" href="#add-scat" id="add-route-btn" class="btn btn-success btn-sm header-btn hidden-mobile">
        <i class="fa fa-plus"></i> Add Service Category
    </a>

    <a href="#edit-scat" id="edit-scat-btn" class="btn btn-warning btn-sm header-btn hidden-mobile">
        <i class="fa fa-edit"></i> Edit Service Category
    </a>

    <a id="delete-scat" class="btn btn-danger btn-sm header-btn hidden-mobile">
        <i class="fa fa-trash"></i> Delete
    </a>
    {{--</span>--}}
@endsection

@section('content')
    @include('common.success')
    @include('common.error')
    @section('table-id', '#dt_basic')
    <table id="dt_basic" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Service Category#</th>
                <th>Name</th>
                <th>Code</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if(count($scs))
                @foreach($scs as $sc)
                    <tr>
                        <td>{{ $sc->id }}</td>
                        <td>{{ $sc->service_category_name }}</td>
                        <td>{{ $sc->service_category_code }}</td>
                        <td>{{ ($sc->service_category_status) ? 'Active' : 'Inactive' }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection

@section('modals')
    <!-- Modal -->
    <div class="modal fade" id="add-scat" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Add Service Category
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form class="smart-form" action="{{ url('add-sc-cats') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="service_category_name">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Code</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="service_category_code">
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
    <div class="modal fade" id="edit-scat" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Update Service Category
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="edit-route-form" class="smart-form" action="{{ url('edit-service-cat') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="sc_name" id="sc_name">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Code</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="sc_code" id="sc_code">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Status</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="status" id="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>

                        </fieldset>

                        {{--hidden fields--}}
                        <input type="hidden" id="edit_id" name="edit_id"/>
                        <footer>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Save Changes
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
@endsection