@php
$page_title = 'View Verified Users';
@endphp

@extends('layouts.main')

@section('contents')
    <form action="{{ route('admin.searchUsersSubmit') }}" method="post" class="row">
        {{ csrf_field() }}
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" name="search_value" placeholder="Search"
                    value="{{ old('search_value') ? old('search_value') : '' }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <select name="search_by" class="form-control">
                    <option value="id"{{ old('search_by') && old('search_by') == 'id' ? ' selected' : '' }}>ID
                    </option>
                    <option value="name"{{ old('search_by') && old('search_by') == 'name' ? ' selected' : '' }}>
                        Name
                    </option>
                    <option value="username"{{ old('search_by') && old('search_by') == 'username' ? ' selected' : '' }}>
                        Username
                    </option>
                    <option value="email"{{ old('search_by') && old('search_by') == 'email' ? ' selected' : '' }}>
                        Email</option>
                    <option
                        value="local_address"{{ old('search_by') && old('search_by') == 'local_address' ? ' selected' : '' }}>
                        Local Address</option>
                    <option
                        value="police_station"{{ old('search_by') && old('search_by') == 'police_station' ? ' selected' : '' }}>
                        Police Station</option>
                    <option value="city"{{ old('search_by') && old('search_by') == 'city' ? ' selected' : '' }}>
                        City
                    </option>
                    <option value="country"{{ old('search_by') && old('search_by') == 'country' ? ' selected' : '' }}>
                        Country</option>
                    <option value="zip_code"{{ old('search_by') && old('search_by') == 'zip_code' ? ' selected' : '' }}>
                        Zip Code</option>
                    <option value="country"{{ old('search_by') && old('search_by') == 'country' ? ' selected' : '' }}>
                        Country</option>
                    <option value="station"{{ old('search_by') && old('search_by') == 'station' ? ' selected' : '' }}>
                        Station Name</option>
                    <option
                        value="permission"{{ old('search_by') && old('search_by') == 'permission' ? ' selected' : '' }}>
                        Permission Name</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="submit" value="Search" class="form-control btn btn-primary">
            </div>
        </div>
    </form>
    <div class="table-responsive w-100">
        <table class="table table-success table-striped min-width-400px">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Salary</th>
                    <th>Hire Date</th>
                    <th>Address</th>
                    <th>Station Name</th>
                    <th>Permission Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->status }}</td>
                        <td>{{ $user->salary }}</td>
                        <td>{{ $user->hire_date }}</td>
                        <td>{{ $user->address->local_address }}, {{ $user->address->police_station }}, {{ $user->address->city }}, {{ $user->address->country }}, {{ $user->address->zip_code }}</td>
                        <td>{{ $user->branch ? $user->branch->name : ($user->region ? $user->region->name : "") }}</td>
                        <td>@foreach ($user->permissions as $permission)
                            {{ $permission->name }},
                        @endforeach</td>
                        <td>
                            {{-- <a href="{{ route('admin.editUser', $user->id) }}" class="btn btn-primary">Edit</a> --}}
                            <a href="{{ route('admin.editUser', ['id' => $user->id]) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.deleteUser', ['id' => $user->id]) }}" id="delete-btn"
                                class="btn btn-danger delete-btn">Delete</a>
                            <a href="{{ route('admin.unverifyUser', ['id' => $user->id]) }}"
                                class="btn btn-danger">Unverify</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-4">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
@endsection
