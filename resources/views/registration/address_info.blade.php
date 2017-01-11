<form action="" method="post" class="">
    <a data-toggle="modal" href="#add-address" class="btn btn-sm btn-labeled btn-primary" data-original-title="Add New Address">
        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Add Address
    </a><br><br>

    <table id="table1" class="table table-hover">
        <thead>
        <tr>
            <th>Address#</th>
            <th>County</th>
            <th>Town</th>
            <th>Postal Address</th>
            <th>Location</th>
            <th>Address Type</th>
            <th>Phone#</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @if(count($addresses))
            @foreach($addresses as $address)
                <tr>
                    <td>{{ $address->id }}</td>
                    <td>{{ $address->county }}</td>
                    <td>{{ $address->city }}</td>
                    <td>{{ $address->postal_address }}</td>
                    <td>{{ $address->physical_address }}</td>
                    <td>{{ $ctype->contact_type_name }}</td>
                    <td>{{ $address->phone_no }}</td>
                    <td><a href="#edit_address" edit-id="{{ $address->id }}" action="{{ url('update-address/'.$address->id) }}" class="btn btn-xs btn-success edit_address" data-toggle="modal">Edit</a> </td>
                    <td><form method="post" action="{{ url('/delete-address/'.$address->id) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="masterfile_id" value="{{ $mf->id }}" id="del-btn">
                            <input type="submit" name="DELETE" value="Delete" class="btn btn-danger btn-xs delete_address">
                            {{ method_field('DELETE') }}
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</form>

<!-- begin add address modal -->
<div class="modal fade" id="add-address" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Add Address Details </h4>
            </div>
            <div class="modal-body no-padding">

                <form id="add-address" action="{{ url('add-address/'.$mf->id) }}" method="post" class="smart-form">
                    {{ csrf_field() }}
                    <fieldset>
                        <section>
                            <div class="row">
                                <div class="col col-8">
                                        <input type="hidden" name="masterfile_id" value="{{ $mf->id }}">
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="row">
                                <label class="label col col-3">County</label>
                                <div class="col col-8 icon-addon addon-md">
                                    <label class="select">
                                        <select name="county" required>
                                            <option value="">--select county--</option>
                                            @if(count($counties))
                                                @foreach($counties as $county)
                                                    <option value="{{ $county->county_code }}"
                                                            {{ (old('county') == $county->county_code) ? 'selected': '' }}>
                                                        {{ $county->county_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="row">
                                <label class="label col col-3">Town</label>
                                <div class="col col-8">
                                    <label class="input"> <i class="icon-append fa fa-location-arrow"></i>
                                        <input type="text" name="city" value="{{ old('city') }}" required/>
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="row">
                                <label class="label col col-3">Address Type</label>
                                <div class="col col-8 icon-addon addon-md">
                                    <label class="select">
                                        <select name="id" class="live_search" required>
                                            <option value="">--select address type--</option>
                                            @if(count($ctypes))
                                                @foreach($ctypes as $ctype)
                                                    <option value="{{ $ctype->id }}"
                                                            {{ (old('contact_type') == $ctype->id) ? 'selected': '' }}>
                                                        {{ $ctype->contact_type_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="row">
                                <label class="label col col-3">Postal Address</label>
                                <div class="col col-8">
                                    <label class="input"> <i class="icon-append fa fa-map-marker"></i>
                                        <input type="number" name="postal_address" value="{{ old('postal_address') }}" required />
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="row">
                                <label class="label col col-3">Postal Code</label>
                                <div class="col col-8">
                                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                        <input type="number" name="postal_code" value="{{ old('postal_code') }}" required/>
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="row">
                                <label class="label col col-3">Physical Address</label>
                                <div class="col col-8">
                                    <label class="input"> <i class="icon-append fa fa-building"></i>
                                        <input type="text" name="physical_address" value="{{ old('physical_address') }}" required/>
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="row">
                                <label class="label col col-3">Phone</label>
                                <div class="col col-8">
                                    <label class="input"> <i class="icon-append fa fa-phone"></i>
                                        <input type="number" name="phone_no" value="{{ old('phone_no') }}" required/>
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

<!-- Modal edit-->
<div class="modal fade" id="edit_address" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{ csrf_field() }}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Edit Address Details</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category"> County</label>
                            <select name="county" class="form-control live_search" >
                                <option value="">--Select County--</option>
                                @if(count($counties))
                                    @foreach($counties as $county)
                                        <option value="{{ $county->county_code }}" {{ (old('county') == $county->county_code) ? 'selected': '' }}>{{ $county->county_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tags"> City</label>
                            <input type="text" class="form-control" value="{{ $mf->city }}" placeholder="City" />
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel </button>
                <button type="button" class="btn btn-primary"> Save </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@push('js')
    <script src="{{ URL::asset('my_js/registration/address.js') }}"></script>
@endpush