<br>
<h3><strong>Step 1 </strong> - Basic Information</h3>

<div class="row">

    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                {{--<input class="form-control input-lg" placeholder="email@address.com" type="text" name="email" id="email">--}}
                <select name="role" class="form-control" id="role">
                    <option value="">--Choose Role--</option>
                    @if(count($roles))
                        @foreach($roles as $role)
                            <option value="{{ $role->role_code }}" {{ (old('role') == $role->role_code) ? 'selected': '' }}>{{ $role->role_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                <input class="form-control" placeholder="Admission No" type="text" name="id_no" id="adm_no" value="{{ old('id_no') }}">

            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                <input class="form-control" placeholder="First Name" type="text" name="fname" id="fname" value="{{ old('fname') }}">

            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user
                fa-fw"></i></span>
                <input class="form-control" placeholder="Middle Name" type="text" name="mname" id="mname" value="{{ old('mname') }}">

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                <input class="form-control" placeholder="Surname" type="text" name="surname" id="lname" value="{{ old('surname') }}">

            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                <input class="form-control" placeholder="Date of Birth" type="text" name="dob" id="dob" value="{{ old('dob') }}">

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
                    <option value="">--Choose Gender--</option>
                    <option value="Male" {{ (old('gender') == 'Male') ? 'selected': '' }}>Male</option>
                    <option value="Female" {{ (old('gender') == 'Female') ? 'selected': '' }}>Female</option>
                </select>
            </div>
        </div>
    </div>
</div>