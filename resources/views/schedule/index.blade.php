@extends('layouts.master')

@section('content')
<div class="card">

	<h3 class="mt-4 mb-0">Delivery Schedule</h3>

	<div class="card-body bg-white">

		@if (session("message"))
		<div class="alert alert-success mt-3">
			<p>{{ session("message") }}</p>
		</div>
		@endif
		
        <form action="{{ route('schedule.index') }}" method="GET" class="mb-6 justify-content-left">
            <label for="slot" class="mr-4">Slot per week:</label>
            <input type="text" id="slot" name="slot" placeholder="Slots available" required>
        </form>
        <div class="custom-control custom-checkbox py-4">
            <input type="checkbox" class="custom-control-input" id="customCheck1">
            <label class="custom-control-label" for="customCheck1">Mark as "Currently on Holiday"</label>
        </div>
        <a href="{{ route('schedule.store') }}" class="btn btn-primary btn-sm">Save Changes</a>
	</div>
</div>
@endsection