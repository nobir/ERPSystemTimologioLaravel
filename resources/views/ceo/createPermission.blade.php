@php
$page_title = 'Create Permission';
@endphp

@extends('layouts.main')

@section('contents')
    <form id="create-permission-form" action="{{ route('admin.createPermissionSubmit') }}" method="post"
        class="needs-validation">
        {{ @csrf_field() }}
        <div class="row mb-3 has-validation">
            <label for="name" class="col-sm-3 col-form-label">Permission Name</label>
            <div class="col-sm-9">
                <input id="name" type="text" name="name"
                    class="@error('name') is-invalid @enderror form-control {{ old('name') && !$errors->first('name') ? 'is-valid' : '' }}"
                    value="{{ old('name') }}" placeholder="e.g Admin">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-3 pt-0">Permission:</legend>
            <div class="col-sm-9">
                <div class="form-check">
                    <input id="invoice_add" type="checkbox" name="invoice_add"
                        class="form-check-input{{ old('invoice_add') ? ' is-valid' : '' }}" value="invoice_add"
                        {{ old('invoice_add') ? 'checked' : '' }}>
                    <label for="invoice_add" class="form-check-label">Invoice Add</label>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input id="invoice_manage" type="checkbox" name="invoice_manage"
                        class="form-check-input{{ old('invoice_manage') ? ' is-valid' : '' }}" value="invoice_manage"
                        {{ old('invoice_manage') ? 'checked' : '' }}>
                    <label for="invoice_manage" class="form-check-label">Invoice Manage</label>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input id="inventory_manage" type="checkbox" name="inventory_manage"
                        class="form-check-input{{ old('inventory_manage') ? ' is-valid' : '' }}" value="inventory_manage"
                        {{ old('inventory_manage') ? 'checked' : '' }}>
                    <label for="inventory_manage" class="form-check-label">Inventory Manage</label>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input id="category_manage" type="checkbox" name="category_manage"
                        class="form-check-input{{ old('category_manage') ? ' is-valid' : '' }}" value="category_manage"
                        {{ old('category_manage') ? 'checked' : '' }}>
                    <label for="category_manage" class="form-check-label">Category Manage</label>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input id="station_manage" type="checkbox" name="station_manage"
                        class="form-check-input{{ old('station_manage') ? ' is-valid' : '' }}" value="station_manage"
                        {{ old('station_manage') ? 'checked' : '' }}>
                    <label for="station_manage" class="form-check-label">Station Manage</label>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input id="operation_manage" type="checkbox" name="operation_manage"
                        class="form-check-input{{ old('operation_manage') ? ' is-valid' : '' }}" value="operation_manage"
                        {{ old('operation_manage') ? 'checked' : '' }}>
                    <label for="operation_manage" class="form-check-label">Operation Manage</label>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input id="user_manage" type="checkbox" name="user_manage"
                        class="form-check-input{{ old('user_manage') ? ' is-valid' : '' }}" value="user_manage"
                        {{ old('user_manage') ? 'checked' : '' }}>
                    <label for="user_manage" class="form-check-label">User Manage</label>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input id="permission_mange" type="checkbox" name="permission_mange"
                        class="form-check-input{{ old('permission_mange') ? ' is-valid' : '' }}" value="permission_mange"
                        {{ old('permission_mange') ? 'checked' : '' }}>
                    <label for="permission_mange" class="form-check-label">Permission Manage</label>
                </div>
            </div>
        </fieldset>

        <div class="row mb-3">
            <div class="col-sm-9 offset-sm-3">
                <button id="create-permission-btn" type="submit" class="btn btn-success">Add</button>
            </div>
        </div>
    </form>
@endsection
