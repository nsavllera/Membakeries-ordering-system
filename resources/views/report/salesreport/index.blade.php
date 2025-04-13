@extends('layouts.master')

@section('content')
<div class="card">

	<h3 class="mt-4 mb-0">Report</h3>

	<div class="card-body bg-white">

		@if (session("message"))
		<div class="alert alert-success mt-3">
			<p>{{ session("message") }}</p>
		</div>
		@endif
		
        <form action="{{ route('report.salesreport.generateReport') }}" method="GET">
            <table class="table custom-table">
            <tr>
                    <td>From Date</td>
					<td>
						<input type="datetime-local" name="from_date" value="{{ old('from_date') }}" class="form-control">
						@error('from_date')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</td>
				</tr>
				<tr>
					<td>To Date</td>
					<td>
                        <input type="datetime-local" name="to_date" value="{{ old('to_date') }}" class="form-control">
						@error('to_date')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</td>
				</tr>
            </table>
            <button type="submit" class="btn btn-primary btn-sm mt-4">Generate Report</button>
        </form>

</div>
@endsection

