@extends('layouts.master')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Customer Inquiries</h2>

    <form action="{{ route('message.index') }}" method="GET" class="mb-3 d-flex gap-2 flex-wrap">
        <input type="text" name="search" class="form-control" style="max-width: 300px;"
               placeholder="Search subject or message..." value="{{ $search }}">
        <button class="btn btn-primary">Search</button>
    </form>

    @if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if($messages->count())
    <div class="table-responsive">
        <table class="table table-bordered align-middle text-nowrap">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Reply</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $index => $msg)
                <tr>
                    <td>{{ $messages->firstItem() + $index }}</td>
                    <td>{{ $msg->user->name }}<br><small>{{ $msg->user->email }}</small></td>
                    <td>{{ $msg->subject }}</td>
                    <td>{{ $msg->message }}</td>
                    <td>
                        @if($msg->reply)
                            <span class="text-success">{{ $msg->reply }}</span>
                        @else
                            <span class="text-muted">No reply</span>
                        @endif
                    </td>
                    <td>{{ $msg->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        @if(!$msg->reply)
                        <form action="{{ route('message.reply', $msg->id) }}" method="POST">
                            @csrf
                            <textarea name="reply" class="form-control mb-2" rows="2" required></textarea>
                            <button type="submit" class="btn btn-success btn-sm">Send Reply</button>
                        </form>
                        @else
                        <em class="text-secondary">Answered</em>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $messages->withQueryString()->links() }}</div>
    @else
    <div class="alert alert-info">No messages found.</div>
    @endif
</div>
@endsection
