@php
$page_title = 'View Catogories';
@endphp

@extends('layouts.main')

@section('contents')
    <div class="table-responsive w-100">
        <table class="table table-success table-striped min-width-400px">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Size</th>
                    <th>Cost Price</th>
                    <th>Sell Price</th>
                    <th>Discount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->details }}</td>
                        <td>{{ $category->size }}</td>
                        <td>{{ $category->cost_price }}</td>
                        <td>{{ $category->sell_price }}</td>
                        <td>{{ $category->discount }}</td>
                        <td>
                            <a href="{{ route('manager.editCategory', ['id' => $category->id]) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('manager.deleteCategory', ['id' => $category->id]) }}" id="delete-btn"
                                class="btn btn-danger delete-btn">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-4">
        {{ $categories->links('pagination::bootstrap-4') }}
    </div>
@endsection
