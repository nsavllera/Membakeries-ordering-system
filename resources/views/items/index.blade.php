@extends('layouts.master')

@section('content')
<div class="card">
	<div class="card-header d-flex justify-content-between align-items-center flex-wrap">
		<h3 class="mb-2 mb-md-0">List Of Items</h3>
        <a href="{{ route('items.create') }}" class="btn btn-primary btn-sm">Add New Item</a>
	</div>

	<div class="card-body">
		@if (session("message"))
		<div class="alert alert-success mt-3">
			<p>{{ session("message") }}</p>
		</div>
		@endif

		<div class="d-flex justify-content-end py-2 gap-2">
			<form action="{{ route('items.index') }}" method="GET" class="d-flex align-items-center gap-2">
				<input 
					type="text" 
					name="search" 
					class="form-control mb-2" 
					placeholder="Search..." 
					value="{{ request('search') }}"
					style="min-width: 100px;"
				>
				<button type="submit" class="btn btn-primary mb-2">Search</button>
			</form>
		</div>


		<div class="table-responsive">
			<table class="table table-bordered align-middle text-nowrap">
				<thead class="table-light">
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
				</thead>
				<tbody>
					@php($i = 0)
					@foreach($cakes as $item)
					<tr>
						<td>{{ ++$i }}</td>
						<td>{{ $item->name }}</td>
						<td>{{ $item->category->name }}</td>
						<td>RM{{ number_format($item->price, 2) }}</td>
						<td>
							@if ($item->image_path)
								<img src="{{ asset('images/' . $item->image_path) }}" alt="Cake Image" style="width: 40px; height: auto;">
							@else
								<span class="text-muted">No image</span>
							@endif
						</td>
						<td>{{ $item->created_at->format('Y-m-d') }}</td>
						<td>{{ $item->updated_at->format('Y-m-d') }}</td>
						<td>
							<div class="d-flex gap-2">
								<a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
								<form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-sm btn-danger">Delete</button>
								</form>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<div class="mt-4">
			{{ $cakes->links() }}
		</div>
	</div>
</div>
@endsection
