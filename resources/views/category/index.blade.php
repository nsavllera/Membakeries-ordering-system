@extends('layouts.master')

@section('content')
<div class="card">
    <h3 class="mt-4 mb-0">Manage Categories</h3>

    <div class="card-body bg-white">

        @if (session('message'))
        <div class="alert alert-success mt-3">
            <p>{{ session('message') }}</p>
        </div>
        @endif

        <!-- Add Category Form -->
        <form action="{{ route('category.store') }}" method="POST" class="form-inline mb-4">
            @csrf
            <label for="name" class="mr-2">Category Name:</label>
            <input type="text" name="name" id="name" class="form-control mr-2" placeholder="Enter category name" required>
            <button type="submit" class="btn btn-primary mt-3">Add Category</button>
        </form>

        <!-- List of Categories -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th style="width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2">No categories found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
@endsection
