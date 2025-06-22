@extends('layouts.master')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Customer Reviews</h2>

    <form action="{{ route('reviews.index') }}" method="GET" class="mb-3 justify-content-end d-flex gap-2 flex-wrap">
        <input type="text" name="search" class="form-control" style="max-width: 300px;" placeholder="Search order ID..." value="{{ $search }}">
        <button class="btn btn-primary">Search</button>
    </form>

    @if($reviews->count())
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reviews as $review)
                <tr>
                    <td>{{ $loop->iteration + ($reviews->currentPage() - 1) * $reviews->perPage() }}</td>
                    <td>#{{ $review->order_id }}</td>
                    <td>
                        <span class="badge bg-warning text-dark">{{ $review->rating }}/5</span>
                    </td>
                    <td>{{ $review->comment }}</td>
                    <td>{{ $review->created_at->format('d M Y, h:i A') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $reviews->withQueryString()->links() }}
    </div>
    @else
    <div class="alert alert-info">No reviews found.</div>
    @endif
</div>
@endsection
