@extends('layouts.dt')
@section('title', 'Streams')
@section('widget-title', 'Manage Streams')
@section('widget-desc', 'Add / Edit / Delete Streams')
@section('dt-title', 'Streams')
@section('sparks')
    <a href="" data-toggle="modal" data-target="#remoteModal" class="btn btn-success btn-lg pull-right header-btn hidden-mobile">
        <i class="fa fa-circle-arrow-up fa-lg"></i>
        Add Stream
    </a>
@endsection
@section('content')
<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Stream Name</th>
        <th>Stream Code</th>
        <th>Stream status</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    @foreach($streams as $stream)
        <tr>
            <td>{{ $stream->id }}</td>
            <td>{{ $stream->stream_name }}</td>
            <td>{{ $stream->stream_code }}</td>
            <td>{{ ($stream->stream_status == 1 )? 'Active':'Inactive'  }}</td>
            <td>{{ ($stream->stream_status == 1 )? 'Active':'Inactive'  }}</td>
            <td>{{ ($stream->stream_status == 1 )? 'Active':'Inactive'  }}</td>
          </tr>
    @endforeach
    </tbody>
</table>
@endsection

@section('modal')
    {{--many modal as possible--}}
    <!-- MODAL PLACE HOLDER -->
    {{--modal for add--}}
    <div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">Add contact types </h4>
                </div>
                <div class="modal-body no-padding">
                    {!! Form::open(array('route'=>'streams.store', 'class'=>'smart-form')) !!}
                    <fieldset>
                        <section>
                            <div class="row">
                                {{ Form::label('stream_name','Name',array('class'=>"label col col-2")) }}
                                <div class="col col-10">
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        {{ Form::text('stream_name',null,array( )) }}
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="row">
                                {{ Form::label('stream_code','Code',array('class'=>"label col col-2")) }}
                                <div class="col col-10">
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        {{ Form::text('stream_code',null,array( )) }}
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="row">
                                {{ Form::label('stream_status','Status',array('class'=>"label col col-2")) }}
                                <div class="col col-10">
                                    {{ Form::select('stream_status',[ '1'=>'Active', '0'=>'Inactive'],null,[ 'class'=>'select2'] )}}
                                </div>
                            </div>
                        </section>




                    </fieldset>

                    <footer>
                        {{ Form::submit('Save',array('class'=>'btn btn-primary')) }}
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cancel
                        </button>
                    </footer>

                    {!! Form::close() !!}
                    {{--</form>--}}



                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL -->
@endsection