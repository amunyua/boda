@extends('layouts.dt')
@section('title', 'Inventory Allocation')
@section('page-title', 'Inventory Allocation')
@section('widget-title', 'Inventory Allocation')
@section('widget-desc', 'Allocate Inventory items')
@section('table-title', 'Inventory Allocations')

@push('js')
<script src="{{ URL::asset('my_js/client_accounts/client_accounts.js') }}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{ url('/') }}"> Home</a></li>
    <li>Inventory</li>
    <li>Inventory Allocation</li>
@endsection

@section('button')
    {{--<span class="actions">--}}
    <div class="pull-right">
        <a data-toggle="modal" href="#create-client-account-mod" id="" class="btn btn-success btn-sm header-btn hidden-mobile">
            <i class="fa fa-plus"></i> Allocate Inventory Items
        </a>
    </div>

    {{--</span>--}}
@endsection

@section('content')
    @include('layouts.includes._messages')
@section('table-id', '#inventory-allocations')

<table id="inventory-allocations" class="table table-striped table-bordered table-hover">
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
                        Allocate Inventory Items
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="create-inventory" class="smart-form" action="{{ url('create-cli-account') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Motorbike</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="bike_id" class="form-control select2" id="" required>
                                                <option value="">Please select a motorbike</option>
                                                {{--@if(count($bikes))--}}
                                                    {{--@foreach($bikes as $bike)--}}
                                                        {{--<option value="{{ $bike->id }}">{{ $bike->vin }}</option>--}}
                                                    {{--@endforeach--}}
                                                {{--@endif--}}
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
                                                {{--@if(count($clients))--}}
                                                    {{--@foreach($clients as $client)--}}
                                                        {{--<option value="{{ $client->id }}">{{ $client->surname.' '.$client->firstname.' '.$client->middlename }}</option>--}}
                                                    {{--@endforeach--}}
                                                {{--@endif--}}
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
@endsection