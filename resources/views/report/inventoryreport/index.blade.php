@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="card p-4">

            <h3 class="mb-3">Inventory Report</h3>

            @if (session("message"))
                <div class="alert alert-success">
                    <p>{{ session("message") }}</p>
                </div>
            @endif

            <form action="{{ route('report.inventoryreport.generateReport') }}" method="GET">
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
                <button type="submit" class="btn btn-primary mt-3">Generate Report</button>
            </form>

        </div>
    </div>
@endsection
