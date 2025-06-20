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


    	<form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
		@csrf
			<table class="table custom-table">
				<tr>
					<td>Item name</td>
					<td>
						<input type="text" name="name" value="{{ old('name') }}" class="form-control">
						@error('name')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</td>
				</tr>
				<tr>
					<td>Description</td>
					<td>
						<input type="text" name="description" value="{{ old('description') }}" class="form-control">
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
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
						<input type="text" name="price" value="{{ old('price') }}" class="form-control">
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
                    <td>Date Created</td>
					<td>
						<input type="datetime-local" name="created_at" value="{{ old('created_at') }}" class="form-control">
						@error('created_at')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</td>
				</tr>
				<tr>
					<td>Date Updated</td>
					<td>
                        <input type="datetime-local" name="updated_at" value="{{ old('updated_at') }}" class="form-control">
						@error('updated_at')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<button type="submit" class="btn btn-primary">
							Submit
						</button>
					</td>
				</tr>
			</table>
			
		</form>

	</div>
</div>
@endsection