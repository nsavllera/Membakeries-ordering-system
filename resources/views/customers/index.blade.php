@extends('layouts.master')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Customer List</h2>

    <form action="{{ route('customers.index') }}" method="GET" class="mb-4 justify-content-end d-flex gap-2 flex-wrap">
        <input type="text" name="search" class="form-control" style="max-width: 250px;" 
               placeholder="Search name or email..." value="{{ $search }}">
        <button class="btn btn-primary">Search</button>
    </form>

    @if($customers->count())
    <div class="table-responsive">
        <table class="table table-bordered text-nowrap align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $index => $customer)
                <tr>
                    <td>{{ $customers->firstItem() + $index }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phoneNo ?? '—' }}</td>
                    <td>
                    @if (!$customer->is_banned)
                        <form method="POST" action="{{ route('customers.ban', $customer->id) }}" 
                            onsubmit="return confirm('Ban this customer?');">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-danger btn-sm">Ban</button>
                        </form>
                    @else
                        <span class="text-danger fw-bold">Banned</span>
                    @endif
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $customers->withQueryString()->links() }}
    </div>
    @else
    <div class="alert alert-info">No customers found.</div>
    @endif
</div>
@endsection
