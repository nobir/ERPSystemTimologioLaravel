@php
$page_title = 'Edit Permission';
@endphp

@extends('layouts.main')

@section('contents')
    <form id="edit-permission-form" action="{{ route('admin.editPermissionSubmit', ['id' => $permission->id]) }}"
        method="post" class="needs-validation">
        {{ @csrf_field() }}
        <div class="row mb-3 has-validation">
            <label for="name" class="col-sm-3 col-form-label">Permission Name</label>
            <div class="col-sm-9">
                <input id="name" type="text" name="name"
                    class="@error('name') is-invalid @enderror form-control {{ $permission->name && !$errors->first('name') ? 'is-valid' : '' }}"
                    value="{{ $permission->name }}" placeholder="e.g 154">

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
                        class="form-check-input{{ $permission->invoice_add ? ' is-valid' : '' }}" value="invoice_add"
                        {{ $permission->invoice_add ? 'checked' : '' }}>
                    <label for="invoice_add" class="form-check-label">Invoice Add</label>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input id="invoice_manage" type="checkbox" name="invoice_manage"
                        class="form-check-input{{ $permission->invoice_manage ? ' is-valid' : '' }}"
                        value="invoice_manage" {{ $permission->invoice_manage ? 'checked' : '' }}>
                    <label for="invoice_manage" class="form-check-label">Invoice Manage</label>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input id="inventory_manage" type="checkbox" name="inventory_manage"
                        class="form-check-input{{ $permission->inventory_manage ? ' is-valid' : '' }}"
                        value="inventory_manage" {{ $permission->inventory_manage ? 'checked' : '' }}>
                    <label for="inventory_manage" class="form-check-label">Inventory Manage</label>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input id="category_manage" type="checkbox" name="category_manage"
                        class="form-check-input{{ $permission->category_manage ? ' is-valid' : '' }}"
                        value="category_manage" {{ $permission->category_manage ? 'checked' : '' }}>
                    <label for="category_manage" class="form-check-label">Category Manage</label>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input id="station_manage" type="checkbox" name="station_manage"
                        class="form-check-input{{ $permission->station_manage ? ' is-valid' : '' }}"
                        value="station_manage" {{ $permission->station_manage ? 'checked' : '' }}>
                    <label for="station_manage" class="form-check-label">Station Manage</label>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input id="operation_manage" type="checkbox" name="operation_manage"
                        class="form-check-input{{ $permission->operation_manage ? ' is-valid' : '' }}"
                        value="operation_manage" {{ $permission->operation_manage ? 'checked' : '' }}>
                    <label for="operation_manage" class="form-check-label">Operation Manage</label>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input id="user_manage" type="checkbox" name="user_manage"
                        class="form-check-input{{ $permission->user_manage ? ' is-valid' : '' }}" value="user_manage"
                        {{ $permission->user_manage ? 'checked' : '' }}>
                    <label for="user_manage" class="form-check-label">User Manage</label>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input id="permission_mange" type="checkbox" name="permission_mange"
                        class="form-check-input{{ $permission->permission_mange ? ' is-valid' : '' }}"
                        value="permission_mange" {{ $permission->permission_mange ? 'checked' : '' }}>
                    <label for="permission_mange" class="form-check-label">Permission Manage</label>
                </div>
            </div>
        </fieldset>

        <div class="row mb-3">
            <div class="col-sm-9 offset-sm-3">
                <button id="edit-permission-btn" type="submit" class="btn btn-success">Edit</button>
            </div>
        </div>
    </form>
@endsection
