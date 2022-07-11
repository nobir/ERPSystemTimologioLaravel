@php
$page_title = 'Profile Picture';
@endphp

@extends('layouts.main')

@section('contents')
    <form action="{{ route('dashboard.profilePicture') }}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="card text-center">
            <div class="card-body">
                <div class="row mb-3 has-validation">
                    <label for="avatar" class="col-sm-3 col-form-label">Avatar</label>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file"
                                class="custom-file-input form-control @error('avatar') is-invalid @enderror" id="avatar"
                                name="avatar">
                            <label class="custom-file-label" for="avatar">Choose file</label>
                            @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-9 offset-sm-3">
                        <button id="avatar-upload-btn" type="submit" class="btn btn-success">Upload</button>
                    </div>
                </div>
            </div>
            @if (Session::has('user') && Session::get('user')->avatar)
                <div class="card-footer">
                    <img src="{{ url(Session::get('user')->avatar) }}" class="img-thumbnail rounded mx-auto d-block" alt="{{ Session::get('user')->name }}">
                </div>
            @endif
        </div>
    </form>
@endsection
