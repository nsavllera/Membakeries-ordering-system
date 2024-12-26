@extends('layouts.master')

@section('content')
<div class="card">
	<div class="card-header d-flex justify-content-between align-items-center">
		<h5 class="mb-0">List Of Items</h5>
        <a href="{{ route('items.create') }}" class="btn btn-primary btn-sm">Add New Item</a>
	</div>
	<div class="card-body">

		@if (session("message"))
		<div class="alert alert-success mt-3">
			<p>{{ session("message") }}</p>
		</div>
		@endif
		
		<table class="table table-bordered">
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
			@foreach($items as $item)
			<tr>
				<td>{{ ++$i }}</td>
				<td>{{ $item->name }}</td>
				<td>{{ $item->category }}</td>
				<td>{{ $item->price }}</td>
                <td>
                    @if($item->photo)
                    <img src="{{ asset('uploads/items/'.$item->photo) }}" style="width:100px;">
                    @else
                    No Photo
                    @endif
                </td>
                <td>{{ $item->created_at}}</td>
                <td>{{ $item->updated_at}}</td>
                <td class="text-center">
					@if(request('action') == 'update')
						<a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">Update</a>
					@elseif(request('action') == 'delete')
						<form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display: inline;">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-danger btn-sm">Delete</button>
						</form>
					@endif
				</td>
			</tr>
			@endforeach
		</table>
		 <!-- Pagination Links -->
		 <div class="d-flex justify-content-center">
            {{ $items->appends(['action' => request('action')])->links() }}
        </div>
	</div>
</div>
@endsection