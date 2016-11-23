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
                <input class="form-control" placeholder="ID/Phone No." type="number" name="id_no" id="adm_no" value="{{ old('id_no') }}">
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
                <input class="form-control" placeholder="Middle Name" type="text" name="middlename" id="mname" value="{{ old('middlename') }}">
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
                    <option value="Male" {{ (old('gender') == 'Male') ? 'selected': '' }}>Male</option>
                    <option value="Female" {{ (old('gender') == 'Female') ? 'selected': '' }}>Female</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                <select name="role" class="form-control" id="role">
                    <option value="">Choose Role</option>
                    @if(count($roles))
                        @foreach($roles as $role)
                            <option value="{{ $role->role_code }}" {{ (old('role') == $role->role_code) ? 'selected': '' }}>{{ $role->role_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
</div>

