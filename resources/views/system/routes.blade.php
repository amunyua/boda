@extends('layouts.dt')
@section('title', 'Routes')
@section('page-title', 'Manage Routes')
@section('widget-title', 'Manage Routes')
@section('widget-desc', 'Manage All the System Routes')
@section('table-title', 'Routes')

@push('js')
    <script>
        $('#routes').DataTable({
            serverSide: true,
            processing: true,
            ajax: 'load-routes',
            columns: [
                { data: 'id', name: 'id'},
                { data: 'route_name', name: 'route_name'},
                { data: 'url', name: 'url'},
                { data: 'parent_route', name: 'parent_route'},
                { data: 'route_status', name: 'route_status'}
            ]
        });
    </script>
    <script src="{{ URL::asset('my_js/system/routes.js') }}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{ url('/') }}"> Home</a></li>
    <li>System</li>
    <li>Routes</li>
@endsection

@section('button')
    {{--<span class="actions">--}}
        <a data-toggle="modal" href="#add-route" id="add-route-btn" class="btn btn-success btn-sm header-btn hidden-mobile">
            <i class="fa fa-plus"></i> Add Route
        </a>

        <a data-toggle="modal" id="edit-route-btn" class="btn btn-warning btn-sm header-btn hidden-mobile">
            <i class="fa fa-edit"></i> Edit Route
        </a>

        <a data-toggle="modal" id="delete-route-btn" class="btn btn-danger btn-sm header-btn hidden-mobile">
            <i class="fa fa-trash"></i> Delete Route(s)
        </a>
    {{--</span>--}}
@endsection

@section('content')
    @section('table-id', '#routes')
    <table id="routes" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Route#</th>
                <th>Route Name</th>
                <th>url</th>
                <th>Parent Route</th>
                <th>Status</th>
            </tr>
        </thead>
    </table>
@endsection

@section('modals')
    <!-- Modal -->
    <div class="modal fade" id="add-route" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        <img src="img/logo.png" width="150" alt="SmartAdmin">
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="login-form" class="smart-form">

                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Username</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="email" name="email">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Password</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="password" name="password">
                                        </label>
                                        <div class="note">
                                            <a href="javascript:void(0)">Forgot password?</a>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <div class="col col-2"></div>
                                    <div class="col col-10">
                                        <label class="checkbox">
                                            <input type="checkbox" name="remember" checked="">
                                            <i></i>Keep me logged in</label>
                                    </div>
                                </div>
                            </section>
                        </fieldset>

                        <footer>
                            <button type="submit" class="btn btn-primary">
                                Sign in
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Cancel
                            </button>

                        </footer>
                    </form>


                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection