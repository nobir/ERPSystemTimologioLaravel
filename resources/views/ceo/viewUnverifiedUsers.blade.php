@php
$page_title = 'View Unverified Users';
@endphp

@extends('layouts.main')

@section('contents')
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
                    <th>Local Address</th>
                    <th>Police Station</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Zip Code</th>
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
                        <td>{{ $user->address->local_address }}</td>
                        <td>{{ $user->address->police_station }}</td>
                        <td>{{ $user->address->city }}</td>
                        <td>{{ $user->address->country }}</td>
                        <td>{{ $user->address->zip_code }}</td>
                        <td>
                            {{-- <a href="{{ route('admin.editUser', $user->id) }}" class="btn btn-primary">Edit</a> --}}
                            <a href="{{ route('admin.verifyUser', ['id' => $user->id]) }}" class="btn btn-success">Verify</a>
                            <a href="{{ route('admin.editUser', ['id' => $user->id]) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.deleteUser', ['id' => $user->id]) }}" id="delete-btn" class="btn btn-danger delete-btn">Delete</a>
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
