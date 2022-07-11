@php
$page_title = 'Change Password';
@endphp

@extends('layouts.main')

@section('contents')
    <form id="change-password-form" action="{{ route('dashboard.changePasswordSubmit') }}" method="post" class="needs-validation">
        {{ csrf_field() }}
        <div class="row mb-3 has-validation">
            <label for="currentpass" class="col-sm-3 col-form-label">Current Password</label>
            <div class="col-sm-9">
                <input id="currentpass" type="password" name="currentpass"
                    class="form-control @error('currentpass') is-invalid @enderror" value="">

                @error('currentpass')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="newpass" class="col-sm-3 col-form-label">New Password</label>
            <div class="col-sm-9">
                <input id="newpass" type="password" name="newpass" class="form-control @error('newpass') is-invalid @enderror" value="">

                @error('newpass')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <label for="retypepass" class="col-sm-3 col-form-label">Retype Password</label>
            <div class="col-sm-9">
                <input id="retypepass" type="password" name="retypepass" class="form-control @error('retypepass') is-invalid @enderror" value="">

                @error('retypepass')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 has-validation">
            <div class="col-sm-3 mb-3 text-sm-end">
                <button id="reset-btn" type="reset" class="btn btn-success">Reset</button>
            </div>
            <div class="col-sm-3 mb-3 text-sm-start">
                <button id="change-password-btn" type="submit" class="btn btn-success">Change</button>
            </div>
        </div>
    </form>
@endsection
