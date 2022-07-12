@php
$page_title = 'Edit';
@endphp

@extends('layouts.main')

@section('contents')

    <form id="edit-profile-form" action="{{ route('dashboard.profileEditSubmit') }}" method="post" class="needs-validation">
        {{ @csrf_field() }}
        <div class="row mb-3 has-validation">
            <label for="name" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
                <input id="name" type="text" name="name"
                    class="@error('name') is-invalid @enderror form-control {{ old('name') && !$errors->first('name') ? 'is-valid' : '' }}"
                    value="{{ $user->name }}" placeholder="e.g John Doe">

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
                <input readonly id="username" type="text" name="username"
                    class="@error('username') is-invalid @enderror form-control {{ old('username') && !$errors->first('username') ? 'is-valid' : '' }}"
                    value="{{ $user->username }}" placeholder="e.g john">

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
                <input readonly id="email" type="text" name="email"
                    class="@error('email') is-invalid @enderror form-control {{ old('email') && !$errors->first('email') ? 'is-valid' : '' }}"
                    value="{{ $user->email }}" placeholder="e.g john@gmail.com">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        @if ($user->type <= 1)
            <div class="row mb-3 has-validation">
                <label for="salary" class="col-sm-3 col-form-label">Salary</label>
                <div class="col-sm-9">
                    <input id="salary" type="text" name="salary"
                        class="@error('salary') is-invalid @enderror form-control {{ old('salary') && !$errors->first('salary') ? 'is-valid' : '' }}"
                        value="{{ $user->salary }}" placeholder="e.g 80000">

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
                    <select disabled id="type"
                        class="@error('type') is-invalid @enderror form-control {{ old('type') && !$errors->first('type') ? 'is-valid' : '' }}"
                        name="type">
                        <option value="">None</option>
                        @foreach ($user_types as $key => $type)
                            <option
                                value="{{ $key }}"{{ old('type') && old('type') == $key ? ' selected' : (!old('type') && $user->type == $key ? ' selected' : '') }}>
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
        @endif
        <div class="row mb-3 has-validation">
            <label for="hire_date" class="col-sm-3 col-form-label">Hire Date</label>
            <div class="col-sm-9">
                <input id="hire_date" type="date" name="hire_date"
                    class="@error('hire_date') is-invalid @enderror form-control {{ old('hire_date') && !$errors->first('hire_date') ? 'is-valid' : '' }}"
                    value="{{ date('Y-m-d', strtotime($user->hire_date)) }}">

                @error('hire_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        @if ($user->type <= 1)
            <div class="row mb-3 has-validation">
                <label for="station_id" class="col-sm-3 col-form-label">Station</label>
                <div class="col-sm-9">
                    <select id="station_id"
                        class="@error('station_id') is-invalid @enderror form-control {{ old('station_id') && !$errors->first('station_id') ? 'is-valid' : '' }}"
                        name="station_id">
                        <option value="">None</option>
                        @foreach ($stations as $station)
                            <option
                                value="{{ $station->id }}"{{ $user->station_id == $station->id ? ' selected' : '' }}>
                                {{ $station->name }}</option>
                        @endforeach
                    </select>
                    @error('station_id')
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
                    <div class="col-sm-4 mb-2 remove-btn-container" id="remove-btn-container">
                        <a id="permission-remove-btn" href="#" class="btn btn-danger permission-remove-btn">
                            <i class="bi bi-dash-circle mr-2"></i>Remove
                        </a>
                    </div>
                </div>

                <label for="permission_id" class="col-sm-3 col-form-label">Permission</label>
                <div class="col-sm-7">
                    <div id="permissions" class="row">
                        @php
                            $count = 0;
                        @endphp
                        @if (count($user->permissions) > 0)
                            @foreach ($user->permissions as $user_permission)
                                <div class="col-sm-8 mb-2">
                                    <select id="permission_ids"
                                        class="@error('permission_ids') is-invalid @enderror form-control {{ old('permission_ids') && !$errors->first('permission_ids') ? 'is-valid' : '' }}"
                                        name="permission_ids[]">
                                        <option value="">None</option>
                                        @php
                                            $count++;
                                        @endphp
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}"
                                                {{ $user_permission->id == $permission->id ? ' selected' : '' }}>
                                                {{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($count > 1)
                                    <div class="col-sm-4 mb-2 remove-btn-container" id="remove-btn-container">
                                        <a id="permission-remove-btn" href="#"
                                            class="btn btn-danger permission-remove-btn">
                                            <i class="bi bi-dash-circle mr-2"></i>Remove
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        @else
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
                        @endif

                    </div>
                    @error('permission_ids[]')
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
        @endif
        <div class="row mb-3 has-validation">
            <label for="local_address" class="col-sm-3 col-form-label">Local Address</label>
            <div class="col-sm-9">
                <input id="local_address" type="text" name="local_address"
                    class="@error('local_address') is-invalid @enderror form-control {{ old('local_address') && !$errors->first('local_address') ? 'is-valid' : '' }}"
                    value="{{ $user->address->local_address }}" placeholder="e.g Kuratoli">

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
                    value="{{ $user->address->police_station }}" placeholder="e.g Vatara">

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
                    value="{{ $user->address->city }}" placeholder="e.g Dhaka">

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
                    value="{{ $user->address->country }}" placeholder="e.g Bangladesh">

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
                    value="{{ $user->address->zip_code }}" placeholder="e.g 1230">

                @error('zip_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-9 offset-sm-3">
                <button id="edit-user-btn" type="submit" class="btn btn-success">Edit</button>
            </div>
        </div>
    </form>

@endsection
