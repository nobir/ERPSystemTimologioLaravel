@php
$page_title = 'Login';
@endphp

@extends('layouts.main')

@section('contents')

<form id="login-form" action="{{ route('home.loginSubmit') }}" method="post" class="needs-validation">
    {{ @csrf_field() }}
    <div class="row mb-3 has-validation">
        <label for="email" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
            <input id="email" type="text" name="email" class="@error('email') is-invalid @enderror form-control {{ old('email') && !$errors->first('email') ? "is-valid" : "" }}" value="{{ old('email') }}" placeholder="sasuke@uchiha.com">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="password" class="col-sm-3 col-form-label">Password</label>
        <div class="col-sm-9">
            <input id="password" type="password" name="password" class="@error('password') is-invalid @enderror form-control {{ old('password') && !$errors->first('password') ? "is-valid" : "" }}" value="{{ old('password') }}" placeholder="sasuke@uchiha.com">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-9 offset-sm-3">
            <button id="login-btn" type="submit" class="btn btn-success">Login</button>
        </div>
    </div>
</form>

@endsection
