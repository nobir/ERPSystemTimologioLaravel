@php
$page_title = 'Edit Category';
@endphp

@extends('layouts.main')

@section('contents')
    <form id="edit-category-form" action="{{ route('manager.editCategorySubmit', ['id' => $category->id]) }}" method="post"
        class="needs-validation">
        {{ @csrf_field() }}

        <div class="row mb-3 has-validation">
            <label for="name" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
                <input id="name" type="text" name="name"
                    class="@error('name') is-invalid @enderror form-control {{ old('name') && !$errors->first('name') ? 'is-valid' : '' }}"
                    value="{{ $category->name }}">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="name" class="col-sm-3 col-form-label">Details</label>
            <div class="col-sm-9">
                <input id="details" type="text" name="details"
                    class="@error('details') is-invalid @enderror form-control {{ old('details') && !$errors->first('details') ? 'is-valid' : '' }}"
                    value="{{ $category->details }}">

                @error('details')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="size" class="col-sm-3 col-form-label">Size</label>
            <div class="col-sm-9">
                <input id="size" type="text" name="size"
                    class="@error('size') is-invalid @enderror form-control {{ old('size') && !$errors->first('size') ? 'is-valid' : '' }}"
                    value="{{ $category->size }}">

                @error('size')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="cost_price" class="col-sm-3 col-form-label">Cost Price</label>
            <div class="col-sm-9">
                <input id="cost_price" type="text" name="cost_price"
                    class="@error('cost_price') is-invalid @enderror form-control {{ old('cost_price') && !$errors->first('cost_price') ? 'is-valid' : '' }}"
                    value="{{ $category->cost_price }}">

                @error('cost_price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="sell_price" class="col-sm-3 col-form-label">Sell Price</label>
            <div class="col-sm-9">
                <input id="sell_price" type="text" name="sell_price"
                    class="@error('sell_price') is-invalid @enderror form-control {{ old('sell_price') && !$errors->first('sell_price') ? 'is-valid' : '' }}"
                    value="{{ $category->sell_price }}">

                @error('sell_price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="discount" class="col-sm-3 col-form-label">Sell discount</label>
            <div class="col-sm-9">
                <input id="discount" type="text" name="discount"
                    class="@error('discount') is-invalid @enderror form-control {{ old('discount') && !$errors->first('discount') ? 'is-valid' : '' }}"
                    value="{{ $category->discount }}">

                @error('discount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-9 offset-sm-3">
                <button id="edit-category-btn" type="submit" class="btn btn-success">Edit</button>
            </div>
        </div>
    </form>
@endsection
