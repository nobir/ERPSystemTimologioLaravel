@php
$page_title = 'View Permissions';
@endphp

@extends('layouts.main')

@section('contents')
    <div class="table-responsive w-100">
        <table class="table table-success table-striped min-width-400px">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Permissions</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
                            {{ $permission->invoice_add ? 'Invoice Add, ' : '' }}
                            {{ $permission->invoice_manage ? 'Invoice Manage, ' : '' }}
                            {{ $permission->inventory_manage ? 'Inventory Manage, ' : '' }}
                            {{ $permission->category_manage ? 'Category Manage, ' : '' }}
                            {{ $permission->station_manage ? 'Region/Branch Manage, ' : '' }}
                            {{ $permission->operation_manage ? 'Operation Manage, ' : '' }}
                            {{ $permission->user_manage ? 'User Manage, ' : '' }}
                            {{ $permission->Permission_manage ? 'Permission Manage, ' : '' }}
                        </td>
                        <td>
                            {{-- <a href="{{ route('admin.editUser', $user->id) }}" class="btn btn-primary">Edit</a> --}}
                            <a href="{{ route('admin.editPermission', ['id' => $permission->id]) }}" class="btn btn-primary">Edit</a>
                            {{-- <a href="{{ route('admin.deletePermission', ['id' => $permission->id]) }}" class="btn btn-danger">Delete</a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-4">
        {{ $permissions->links('pagination::bootstrap-4') }}
    </div>
@endsection
