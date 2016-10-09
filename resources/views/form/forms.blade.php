@extends('layouts.dt')
@section('title', 'Forms')
@section('widget-title', 'Manage Forms')
@section('widget-desc', 'Add/ Edit/ Delete Form')
@section('dt-title', 'Forms')
@section('sparks')
    <a href="" data-toggle="modal" data-target="#remoteModal" class="btn btn-success btn-lg pull-right header-btn hidden-mobile">
        <i class="fa fa-circle-arrow-up fa-lg"></i>
        Add Form
    </a>
@endsection
@push('js')
<script src="{{ URL::asset('js/form.js') }}"></script>
@endpush
@section('content')
    {{--contains the grid--}}
    {{-- show success message if any--}}
    @include('layouts.includes._messages')
    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Form Name</th>
            <th>Form Code</th>
            <th>Form Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @if(count($forms))
            @foreach($forms as $form)
                <tr>
                    <td>{{ $form->id }}</td>
                    <td>{{ $form->form_name }}</td>
                    <td>{{ $form->form_code }}</td>
                    <td>{{ $form->form_status }}</td>
                    <td><button class="btn btn-warning btn-xs edit_form"><i class="fa fa-edit"></i> Edit</button> </td>
                    <td><button class="btn btn-danger btn-xs delete_form" delete-id="{{ $form->id }}"><i class="fa fa-trash"></i> Delete</button></td>
                </tr>
            @endforeach
        @endif
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
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Form </h4>
                </div>
                <div class="modal-body no-padding">

                    <form action="{{ url('add_form') }}" method="post" class="smart-form">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">name</label>
                                    <div class="col col-10">
                                        <label class="input"> </i>
                                            <input type="text" name="form_name">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">code</label>
                                    <div class="col col-10">
                                        <label class="input"></i>
                                            <input type="text" name="form_code">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Status</label>
                                    <div class="col col-10">
                                        <label class="select"></i>
                                            <select name="form_status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>

                        </fieldset>

                        <footer>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </footer>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END MODAL -->

    {{--modal for edit--}}
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">Edit Class</h4>
                </div>
                <div class="modal-body no-padding">
                    {!! Form::open(array('route'=>'contact_types.store', 'class'=>'smart-form')) !!}
                    <fieldset>
                        <section>
                            <div class="row">
                                {{ Form::label('contact_type_name','Type',array('class'=>"label col col-2")) }}
                                <div class="col col-10">
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        {{ Form::text('contact_type_name',null,array( )) }}
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="row">
                                {{ Form::label('contact_type_code','Code',array('class'=>"label col col-2")) }}
                                <div class="col col-10">
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        {{ Form::text('contact_type_code',null,array( )) }}
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="row">
                                {{ Form::label('contact_type_status','Status',array('class'=>"label col col-2")) }}
                                <div class="col col-10">
                                    {{ Form::select('contact_type_status',[ '1'=>'Active', '0'=>'Inactive'],null,[ 'class'=>'select2'] )}}
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="row">
                                {{ Form::label('subject_mandatory','mandatory',array('class'=>"label col col-2")) }}
                                <div class="col col-10">
                                    {{ Form::select('subject_mandatory',[ '1'=>'Active', '0'=>'Inactive'],null,[ 'class'=>'select2'] )}}
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