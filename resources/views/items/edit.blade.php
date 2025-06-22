@extends('layouts.master')

@section('content')
<div class="card">
	<div class="card-header" style="text-align:left;">
		<h5 class="mb-0">Add Items</h5>
	</div>
	<div class="card-body">
		@if (session("message"))
		<div class="alert alert-success mt-3">
			<p>{{ session("message") }}</p>
		</div>
		@endif


    	<form method="POST" action="{{ route('items.update', $item->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
			<table class="table custom-table">
				<tr>
					<td>Item name</td>
					<td>
						<input type="text" name="name" value="{{ old('name', $item->name) }}" class="form-control">
						@error('name')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</td>
				</tr>
				<tr>
					<td>Description</td>
					<td>
						<input type="text" name="description" value="{{ old('description', $item->description) }}">
						@error('description')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</td>
				</tr>
				<tr>
					<td>Category</td>
					<td>
					<select name="category_id" class="form-control">
						<option value="">-- Select Category --</option>
						  @foreach ($categories as $category)
							<option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
								{{ $category->name }}
							</option>
						@endforeach
					</select>
					@error('category_id')
						<span class="text-danger">{{ $message }}</span>
					@enderror
					</td>
				</tr>
        		<tr>
					<td>Price</td>
					<td>
						<input type="text" name="price" value="{{ old('price', $item->price) }}">
						@error('price')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</td>
				</tr>
        		<tr>
					<td>Image</td>
					<td>
                        <input type="file" name="image_path" class="form-control">
						@error('image_path')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</td>
				</tr>
				<tr>
					<td>Date Updated</td>
					<td>
                        <input type="datetime-local" name="updated_at" value="{{ old('updated_at', \Carbon\Carbon::parse($item->updated_at)->format('Y-m-d\TH:i')) }}">
						@error('updated_at')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
                        <button type="submit" class="!bg-green-500 hover:bg-pink-300 text-white font-bold py-2 px-4 rounded">
                            Update
                        </button>
                        <a href="{{ route('items.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Cancel
                        </a>
					</td>
				</tr>
			</table>
			
		</form>

	</div>
</div>
@endsection