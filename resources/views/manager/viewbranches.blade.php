@php
$page_title = 'View Branches';
@endphp

@extends('layouts.main')

@section('contents')
    {{-- <form action="{{ route('manager.searchEmployeesSubmit') }}" method="post" class="row">
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
    </form> --}}
    <div class="table-responsive w-100">
        <table class="table table-success table-striped min-width-400px">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Region</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($branches as $branch)
                    <tr>
                        <td>{{ $branch->name }}</td>
                        <td>{{ $branch->region->name }}</td>
                        <td>{{ $branch->address->local_address }}, {{ $branch->address->police_station }}, {{ $branch->address->city }}, {{ $branch->address->country }}, {{ $branch->address->zip_code }}</td>
                        <td>
                            <a href="{{ route('manager.editBranch', ['id' => $branch->id]) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('manager.deleteBranch', ['id' => $branch->id]) }}" id="delete-btn"
                                class="btn btn-danger delete-btn">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-4">
        {{ $branches->links('pagination::bootstrap-4') }}
    </div>
@endsection
