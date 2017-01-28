<br>
<h3><strong>Step 1 </strong> - Basic Information</h3>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                <select name="b_role" id="b_role" class="form-control">
                    <option value="">Select Buss Role</option>
                    <option value="Administrator" {{ (old('b_role') == 'Administrator') ? 'selected': '' }}>System Admin</option>
                    <option value="Staff" {{ (old('b_role') == 'Staff') ? 'selected': '' }}>Staff</option>
                    <option value="Client" {{ (old('b_role') == 'Client') ? 'selected': '' }}>Client</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                <input class="form-control" placeholder="ID Number." type="number" name="id_no" id="id_no" value="{{ old('id_no') }}">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                <input class="form-control" placeholder="Surname" type="text" name="surname" id="surname" value="{{ old('surname') }}">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                <input class="form-control" placeholder="First Name" type="text" name="firstname" id="firstname" value="{{ old('firstname') }}">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                <input class="form-control" placeholder="Middle Name" type="text" name="middlename" id="middlename" value="{{ old('middlename') }}">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                <input class="form-control regdate" placeholder="Date of Registration" type="text" name="registration_date" id="reg_date" value="@php
                     if(isset($_POST['registration_date'])){
                            echo $_POST['registration_date'];
                        }else{
                            echo date('d-m-Y');
                        }
                    @endphp">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                <select name="gender" id="gender" class="form-control">
                    <option value="">Choose Gender</option>
                    <option value="1" {{ (old('1') == 'Male') ? 'selected' : '' }}>Male</option>
                    <option value="0" {{ (old('0') == 'Female') ? 'selected' : '' }}>Female</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                <select class="form-control" id="role" disabled>
                    <option value="">Choose Role</option>
                    @if(count($roles))
                        @foreach($roles as $role)
                            <option role-code="{{ $role->role_code }}" value="{{ $role->id }}" {{ (old('role') == $role->id) ? 'selected': '' }}>{{ $role->role_name }}</option>
                        @endforeach
                    @endif
                </select>
                <input type="hidden" name="role" id="selected_role"/>
            </div>
        </div>
    </div>
</div>

<div class="row-fluid" style="margin-left: 20%">
    <div class="span6">
        {{--<label class="control-label">Profile Pic</label>--}}
        <div class="controls">
            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                    <img src="{{asset('img/avatars/photo.jpg')}}" alt="" />
                </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 100px; max-height: 100px; line-height: 20px;"></div>
                <div>
                    <label class="btn btn-file"><span class="fileupload-new">Select image</span>
                        <span class="fileupload-exists">Change</span>
                        <input class="span12" type="file" name="image_path"/>
                    </label>
                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                </div>
            </div>
        </div>
    </div>
</div>

