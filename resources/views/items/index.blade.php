@extends('layouts.master')

@section('content')
<div class="card">
	<div class="card-header d-flex justify-content-between align-items-center">
		<h3 class="mb-0">List Of Items</h3>
        <a href="{{ route('items.create') }}" class="btn btn-primary btn-sm">Add New Item</a>
		</div>
	</div>
	<div class="card-body">

		@if (session("message"))
		<div class="alert alert-success mt-3">
			<p>{{ session("message") }}</p>
		</div>
		@endif

		<table class="table table-bordered">
			<tr>
			<div class="d-flex flex-row-reverse py-2 gap-1">
			<form action="{{ route('items.index') }}" method="GET">
				<input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
				<button type="submit">Search</button>
			</form>
			</div>
			</tr>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Category</th>
				<th>Price</th>
                <th>Photo</th>
                <th>Date Created</th>
                <th>Date Updated</th>
                <th>Actions</th>
			</tr>
			@php($i = 0)
			@foreach($cakes as $item)
			<tr>
				<td>{{ ++$i }}</td>
				<td>{{ $item->name }}</td>
				<td>{{ $item->category->name }}</td>
				<td>{{ $item->price }}</td>
                <td>
					@if ($item->image_path)
						<img src="{{ asset('images/' . $item->image_path) }}" alt="" style="width: 40px; height: auto;">
					@else
						<span class="text-gray-500">No image</span>
					@endif
                </td>
                <td>{{ $item->created_at}}</td>
                <td>{{ $item->updated_at}}</td>
                <td class="w-24 gap-3 px-2 py-3 whitespace-nowrap flex place-items-center">
					<a href="{{ route('items.edit', $item->id) }}">Edit</a>
					<form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
						@csrf
						@method('DELETE')
						<button type="submit">Delete</button>
					</form>
				</td>
			</tr>
			@endforeach
		</table>
		<div class="mt-6">
            {{ $cakes->links() }}
        </div>
	</div>
</div>
@endsection