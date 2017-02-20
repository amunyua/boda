@extends('layouts.dt')
@section('title', 'Services')
@section('widget-title', 'Services')
@section('table-title', 'Services List')

@push('js')
    <script src="{{ URL::asset('my_js/services/services.js') }}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{ url('/dashboard') }}"> Home</a></li>
    <li>Services</li>
    <li>Manage Services</li>
@endsection

@section('button')
    {{--<span class="actions">--}}
    <a data-toggle="modal" href="#add-service" id="add-route-btn" class="btn btn-success btn-sm header-btn hidden-mobile">
        <i class="fa fa-plus"></i> Add Service
    </a>

    <a href="#update-service" id="edit-service-btn" class="btn btn-warning btn-sm header-btn hidden-mobile">
        <i class="fa fa-edit"></i> Edit Service
    </a>

    <button data-target="#delete-service" id="delete-service-btn" class="btn btn-danger btn-sm header-btn hidden-mobile">
        <i class="fa fa-trash"></i> Delete Service
    </button>
    {{--</span>--}}
@endsection

@section('content')
    @include('common.success')
    @include('common.error')
    @include('common.warnings')

    @section('table-id', '#dt_basic')
    <table id="dt_basic" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Service#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Service Code</th>
                <th>Price</th>
                <th>Parent</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if(count($services))
                @foreach($services as $service)
                    @php
                        $sc_name = \App\ServiceCategory::find($service->service_category_id)->service_category_name;
                        $parent_service = (!empty($service->parent_service)) ? \App\Service::find($service->parent_service)->service_name : '';
                    @endphp
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->service_name }}</td>
                        <td>{{ $sc_name }}</td>
                        <td>{{ $service->service_code }}</td>
                        <td>{{ $service->price }}</td>
                        <td>{{ $parent_service }}</td>
                        <td>{{ ($service->service_status) ? 'Active' : 'Inactive' }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection

@section('modals')
    <!-- Modal -->
    <div class="modal fade" id="add-service" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Add Service
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form class="smart-form" action="{{ url('add-service') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Service Category</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="service_category" class="form-control" required>
                                                <option value="">--Choose Category--</option>
                                                @if(count($scs))
                                                    @foreach($scs as $sc)
                                                        <option value="{{ $sc->id }}">{{ $sc->service_category_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Service Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="service_name" required>
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Service Code</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="service_code" required>
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Price</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="number" name="price" step="any" required/>
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

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Parent Service</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="parent_service" class="form-control">
                                                <option value="">--Choose Parent--</option>
                                                @if(count($services))
                                                    @foreach($services as $service)
                                                        <option value="{{ $service->id }}">{{ $sc->service_name }}</option>
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
    <div class="modal fade" id="update-service" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Update Service
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form class="smart-form" action="{{ url('update-service') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Service Category</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="service_category" id="service_category" class="form-control" required>
                                                <option value="">--Choose Category--</option>
                                                @if(count($scs))
                                                    @foreach($scs as $sc)
                                                        <option value="{{ $sc->id }}">{{ $sc->service_category_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Service Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="service_name" id="service_name" required>
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Service Code</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" name="service_code" id="service_code" required>
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Price</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="number" name="price" id="price" step="any" required/>
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

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Parent Service</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="parent_service" id="parent_service" class="form-control">
                                                <option value="">--Choose Parent--</option>
                                                @if(count($services))
                                                    @foreach($services as $service)
                                                        <option value="{{ $service->id }}">{{ $sc->service_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>
                        </fieldset>

                        {{--hidden fields--}}
                        <input type="hidden" name="edit_id" id="edit-id"/>
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

    <div class="modal fade" id="delete-service" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Delete Service
                    </h4>
                </div>
                <div class="modal-body no-padding">
                    <form class="smart-form" action="{{ url('delete-scats') }}" method="post">
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