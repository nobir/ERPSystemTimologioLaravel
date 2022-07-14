@php
$page_title = 'Create User';
@endphp

@extends('layouts.main')

@section('contents')
    <form id="create-user-form" action="{{ route('admin.createUserSubmit') }}" method="post" class="needs-validation">
        {{ @csrf_field() }}
        <div class="row mb-3 has-validation">
            <label for="verified" class="col-sm-3 col-form-label">Verified</label>
            <div class="col-sm-9">
                <input id="verified" type="text" name="verified"
                    class="@error('verified') is-invalid @enderror form-control {{ old('verified') && !$errors->first('verified') ? 'is-valid' : '' }}"
                    value="{{ old('verified') ? old('verified') : '0' }}" placeholder="e.g 0">

                @error('verified')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="name" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
                <input id="name" type="text" name="name"
                    class="@error('name') is-invalid @enderror form-control {{ old('name') && !$errors->first('name') ? 'is-valid' : '' }}"
                    value="{{ old('name') }}" placeholder="e.g John Doe">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="username" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-9">
                <input id="username" type="text" name="username"
                    class="@error('username') is-invalid @enderror form-control {{ old('username') && !$errors->first('username') ? 'is-valid' : '' }}"
                    value="{{ old('username') }}" placeholder="e.g john">

                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input id="email" type="text" name="email"
                    class="@error('email') is-invalid @enderror form-control {{ old('email') && !$errors->first('email') ? 'is-valid' : '' }}"
                    value="{{ old('email') }}" placeholder="e.g john@gmail.com">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="salary" class="col-sm-3 col-form-label">Salary</label>
            <div class="col-sm-9">
                <input id="salary" type="text" name="salary"
                    class="@error('salary') is-invalid @enderror form-control {{ old('salary') && !$errors->first('salary') ? 'is-valid' : '' }}"
                    value="{{ old('salary') }}" placeholder="e.g 80000">

                @error('salary')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="type" class="col-sm-3 col-form-label">User Type</label>
            <div class="col-sm-9">
                <select id="type"
                    class="@error('type') is-invalid @enderror form-control {{ old('type') && !$errors->first('type') ? 'is-valid' : '' }}"
                    name="type">
                    <option value="">None</option>
                    @foreach ($user_types as $key => $type)
                        <option value="{{ $key }}"{{ old('type') && old('type') == $key ? ' selected' : '' }}>
                            {{ $type }}</option>
                    @endforeach
                </select>
                @error('type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="hire_date" class="col-sm-3 col-form-label">Hire Date</label>
            <div class="col-sm-9">
                <input id="hire_date" type="date" name="hire_date"
                    class="@error('hire_date') is-invalid @enderror form-control {{ old('hire_date') && !$errors->first('hire_date') ? 'is-valid' : '' }}"
                    value="{{ old('hire_date') }}">

                @error('hire_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="region_id" class="col-sm-3 col-form-label">Region</label>
            <div class="col-sm-9">
                <select id="region_id"
                    class="@error('region_id') is-invalid @enderror form-control {{ old('region_id') && !$errors->first('region_id') ? 'is-valid' : '' }}"
                    name="region_id">
                    <option value="">None</option>
                    @foreach ($regions as $region)
                        <option
                            value="{{ $region->id }}"{{ old('region_id') && old('region_id') == $region->id ? ' selected' : '' }}>
                            {{ $region->name }}</option>
                    @endforeach
                </select>
                @error('region_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="branch_id" class="col-sm-3 col-form-label">Branch</label>
            <div class="col-sm-9">
                <select id="branch_id"
                    class="@error('branch_id') is-invalid @enderror form-control {{ old('branch_id') && !$errors->first('branch_id') ? 'is-valid' : '' }}"
                    name="branch_id">
                    <option value="">None</option>
                    @foreach ($branches as $branch)
                        <option
                            value="{{ $branch->id }}"{{ old('branch_id') && old('branch_id') == $branch->id ? ' selected' : '' }}>
                            {{ $branch->name }}</option>
                    @endforeach
                </select>
                @error('branch_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <div class="d-none" id="hidden-permission-list">
                <div class="col-sm-8 mb-2">
                    <select id="permission_ids"
                        class="@error('permission_ids') is-invalid @enderror form-control {{ old('permission_ids') && !$errors->first('permission_ids') ? 'is-valid' : '' }}"
                        name="permission_ids[]">
                        <option value="">None</option>
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4 mb-2 remove-btn-container p-0" id="remove-btn-container">
                    <a id="permission-remove-btn" href="#" class="btn btn-danger permission-remove-btn">
                        <i class="bi bi-dash-circle mr-2"></i>Remove
                    </a>
                </div>
            </div>

            <label for="permission_id" class="col-sm-3 col-form-label">Permission</label>
            <div class="col-sm-7">
                <div id="permissions" class="row">
                    <div class="col-sm-8 mb-2">
                        <select id="permission_id"
                            class="@error('permission_id') is-invalid @enderror form-control {{ old('permission_id') && !$errors->first('permission_id') ? 'is-valid' : '' }}"
                            name="permission_ids[]">
                            <option value="">None</option>
                            @foreach ($permissions as $permission)
                                <option
                                    value="{{ $permission->id }}"{{ old('permission_id') && old('permission_id') == $permission->id ? ' selected' : '' }}>
                                    {{ $permission->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-sm-4 mb-2 d-none" id="remove-btn-container">
                        <a id="permission-remove-btn" href="#" class="btn btn-danger permission-remove-btn">
                            <i class="bi bi-dash-circle mr-2"></i>Remove
                        </a>
                    </div> --}}
                </div>
                @error('permission_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-sm-2">
                <a id="permission-add-btn" href="#" class="btn btn-info"><i
                        class="bi bi-plus-circle mr-2"></i>Add</a>
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="local_address" class="col-sm-3 col-form-label">Local Address</label>
            <div class="col-sm-9">
                <input id="local_address" type="text" name="local_address"
                    class="@error('local_address') is-invalid @enderror form-control {{ old('local_address') && !$errors->first('local_address') ? 'is-valid' : '' }}"
                    value="{{ old('local_address') }}" placeholder="e.g Kuratoli">

                @error('local_address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="police_station" class="col-sm-3 col-form-label">Police Station</label>
            <div class="col-sm-9">
                <input id="police_station" type="text" name="police_station"
                    class="@error('police_station') is-invalid @enderror form-control {{ old('police_station') && !$errors->first('police_station') ? 'is-valid' : '' }}"
                    value="{{ old('police_station') }}" placeholder="e.g Vatara">

                @error('police_station')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="city" class="col-sm-3 col-form-label">City</label>
            <div class="col-sm-9">
                <input id="city" type="text" name="city"
                    class="@error('city') is-invalid @enderror form-control {{ old('city') && !$errors->first('city') ? 'is-valid' : '' }}"
                    value="{{ old('city') }}" placeholder="e.g Dhaka">

                @error('city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="country" class="col-sm-3 col-form-label">Country</label>
            <div class="col-sm-9">
                <input id="country" type="text" name="country"
                    class="@error('country') is-invalid @enderror form-control {{ old('country') && !$errors->first('country') ? 'is-valid' : '' }}"
                    value="{{ old('country') }}" placeholder="e.g Bangladesh">

                @error('country')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="zip_code" class="col-sm-3 col-form-label">Zip Code</label>
            <div class="col-sm-9">
                <input id="zip_code" type="text" name="zip_code"
                    class="@error('zip_code') is-invalid @enderror form-control {{ old('zip_code') && !$errors->first('zip_code') ? 'is-valid' : '' }}"
                    value="{{ old('zip_code') }}" placeholder="e.g 1230">

                @error('zip_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-9 offset-sm-3">
                <button id="create-user-btn" type="submit" class="btn btn-success">Add</button>
            </div>
        </div>
    </form>
@endsection
