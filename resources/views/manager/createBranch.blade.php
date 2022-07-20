@php
    $page_title = "Create Branch";
@endphp

@extends('layouts.main')

@section('contents')

<form id="create-branch-form" action="{{ route('manager.createBranchSubmit') }}" method="post" class="needs-validation">
    {{ @csrf_field() }}
    <div class="row mb-3 has-validation">
        <label for="name" class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-9">
            <input id="name" type="text" name="name" class="@error('name') is-invalid @enderror form-control {{ old('name') && !$errors->first('name') ? "is-valid" : "" }}" value="{{ old('name') }}">

            @error('name')
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
        <label for="local_address" class="col-sm-3 col-form-label">Local Address</label>
        <div class="col-sm-9">
            <input id="local_address" type="text" name="local_address" class="@error('local_address') is-invalid @enderror form-control {{ old('local_address') && !$errors->first('local_address') ? "is-valid" : "" }}" value="{{ old('local_address') }}">

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
            <input id="police_station" type="text" name="police_station" class="@error('police_station') is-invalid @enderror form-control {{ old('police_station') && !$errors->first('police_station') ? "is-valid" : "" }}" value="{{ old('police_station') }}">

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
            <input id="city" type="text" name="city" class="@error('city') is-invalid @enderror form-control {{ old('city') && !$errors->first('city') ? "is-valid" : "" }}" value="{{ old('city') }}">

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
            <input id="country" type="text" name="country" class="@error('country') is-invalid @enderror form-control {{ old('country') && !$errors->first('country') ? "is-valid" : "" }}" value="{{ old('country') }}">

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
            <input id="zip_code" type="text" name="zip_code" class="@error('zip_code') is-invalid @enderror form-control {{ old('zip_code') && !$errors->first('zip_code') ? "is-valid" : "" }}" value="{{ old('zip_code') }}">

            @error('zip_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-9 offset-sm-3">
            <button id="create-branch-btn" type="submit" class="btn btn-success">Create</button>
        </div>
    </div>
</form>

@endsection
