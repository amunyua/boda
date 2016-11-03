<br>
<h3><strong>Step 2 </strong> - Contact Details</h3>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                <select name="county" class="form-control" id="role">
                    <option value="">Choose Role</option>
                    @if(count($counties))
                        @foreach($counties as $county)
                            <option value="{{ $county->county_code }}" {{ (old('county') == $county->county_code) ? 'selected': '' }}>{{ $county->county_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                <input class="form-control" placeholder="City/Town" type="text" name="city" id="city" value="{{ old('city') }}">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                <input class="form-control" placeholder="Postal Address" type="text" name="postal_address" id="postal_address" value="{{ old('postal_address') }}">
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                <input class="form-control" placeholder="Physical Address" type="text" name="physical_address" id="physical_address" value="{{ old('physical_address') }}">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                <input class="form-control" placeholder="Email" type="text" name="email" id="email" value="{{ old('email') }}">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-mobile-phone fa-fw"></i></span>
                <input class="form-control" placeholder="Mobile Number" type="text" name="phone_no" id="phone_no" value="{{ old('phone_no') }}">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                <input class="form-control" placeholder="Telephone Number" type="text" name="tel_no" id="tel_no" value="{{ old('tel_no') }}">
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-keyboard-o fa-fw"></i></span>
                <select name="contact_type" id="contact_type" class="form-control" readonly="readonly">
                    <option value="{{ $main_ctype->id }}">{{ $main_ctype->contact_type_name }}</option>
                </select>
            </div>
        </div>
    </div>
</div>