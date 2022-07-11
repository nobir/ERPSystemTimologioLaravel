@php
$page_title = 'Profile';
@endphp

@extends('layouts.main')

@section('contents')
    <ul class="list-group list-group-flush">

        <li class="list-group-item d-block">
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4 w-100">
                    <img src="{{ $user->avatar ? url($user->avatar) : url('images/default-user-avatar.png') }}" class="img-thumbnail rounded mx-auto d-block" alt="{{ $user->name }}">
                </div>
            </div>
        </li>

        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">
                    <spna class="text-dark">Name</spna>
                </div>
                <div class="col-md-9">
                    <span class="text-dark">{{ $user->name }}</span>
                </div>
            </div>
        </li>

        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">
                    <spna class="text-dark">Username</spna>
                </div>
                <div class="col-md-9">
                    <span class="text-dark">{{ $user->username }}</span>
                </div>
            </div>
        </li>

        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">
                    <spna class="text-dark">Email</spna>
                </div>
                <div class="col-md-9">
                    <span class="text-dark">{{ $user->email }}</span>
                </div>
            </div>
        </li>

        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">
                    <spna class="text-dark">Salary</spna>
                </div>
                <div class="col-md-9">
                    <span class="text-dark">{{ "$" . number_format($user->salary, 2, '.', ',') }}</span>
                </div>
            </div>
        </li>

        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">
                    <spna class="text-dark">Post</spna>
                </div>
                <div class="col-md-9">
                    <span
                        class="text-dark">{{ $user->type == 0 ? 'System Admin' : ($user->type == 1 ? 'CEO' : ($user->type == 2 ? 'Manager' : ($user->type == 3 ? 'Employee' : ($user->type == 4 ? 'Receptionist' : '')))) }}</span>
                </div>
            </div>
        </li>

        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">
                    <spna class="text-dark">Station</spna>
                </div>
                <div class="col-md-9">
                    <span class="text-dark">{{ $user->station->name }}</span>
                </div>
            </div>
        </li>

        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">
                    <spna class="text-dark">Permissions</spna>
                </div>
                <div class="col-md-9">
                    @foreach ($user->permissions as $permission)
                        <span class="text-dark">{{ $permission->name }}</span>,&nbsp;
                    @endforeach
                </div>
            </div>
        </li>

        @if ($user->address->local_address)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-3">
                        <spna class="text-dark">Local Address</spna>
                    </div>
                    <div class="col-md-9">
                        <span class="text-dark">{{ $user->address->local_address }}</span>
                    </div>
                </div>
            </li>
        @endif

        @if ($user->address->police_station)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-3">
                        <spna class="text-dark">Police Station</spna>
                    </div>
                    <div class="col-md-9">
                        <span class="text-dark">{{ $user->address->police_station }}</span>
                    </div>
                </div>
            </li>
        @endif

        @if ($user->address->city)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-3">
                        <spna class="text-dark">City</spna>
                    </div>
                    <div class="col-md-9">
                        <span class="text-dark">{{ $user->address->city }}</span>
                    </div>
                </div>
            </li>
        @endif

        @if ($user->address->country)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-3">
                        <spna class="text-dark">Country</spna>
                    </div>
                    <div class="col-md-9">
                        <span class="text-dark">{{ $user->address->country }}</span>
                    </div>
                </div>
            </li>
        @endif

        @if ($user->address->zip_code)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-3">
                        <spna class="text-dark">Zip Code</spna>
                    </div>
                    <div class="col-md-9">
                        <span class="text-dark">{{ $user->address->zip_code }}</span>
                    </div>
                </div>
            </li>
        @endif

    </ul>
@endsection
