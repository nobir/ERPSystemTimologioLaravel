@php
$page_title = 'Send email verification mail';
@endphp

@extends('layouts.main')

@section('contents')
    <form id="send-verify-link-form" action="{{ route('admin.sendEmailVerifyLinkSubmit') }}" method="post" class="needs-validation">
        {{ @csrf_field() }}
        <div class="row mb-3 has-validation">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input id="email" type="text" name="email"
                    class="@error('email') is-invalid @enderror form-control {{ old('email') && !$errors->first('email') ? 'is-valid' : '' }}"
                    value="{{ old('email') }}" placeholder="e.g sasuke@uchiha.com">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-9 offset-sm-3">
                <button id="send-verify-link-btn" type="submit" class="btn btn-success">Send</button>
            </div>
        </div>
    </form>
@endsection
