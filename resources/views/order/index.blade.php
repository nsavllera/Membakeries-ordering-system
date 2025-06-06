@extends('layouts.master')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">

    <h3 class="mb-4 text-lg font-semibold text-gray-800">List Of Orders</h3>

    <div class="p-4 bg-white rounded-md border shadow">

        @if (session("message"))
        <div class="alert alert-success mb-4 py-2 px-4 text-sm bg-green-100 text-green-800 rounded">
            <p class="m-0">{{ session("message") }}</p>
        </div>
        @endif

        <form action="{{ route('order.index') }}" method="GET" class="mb-3 flex items-center space-x-3 text-sm bg-pink-50 p-3 rounded">
            <label for="status" class="font-medium">Filter by Status:</label>
            <select id="status" name="status" onchange="this.form.submit()" class="border rounded px-2 py-1 text-sm">
                <option value="">All</option>
                <option value="preparing" {{ $status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                <option value="delivered" {{ $status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="canceled" {{ $status == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
            <button type="submit" class="btn btn-primary py-1 px-2 text-xs">Filter</button>
        </form>

        @if($orders->count() > 0)
            @foreach ($orders as $order)
                <div class="w-full border border-gray-200 rounded-lg mb-4 p-4 shadow-sm bg-pink-100 min-h-[250px]">
                    <h3 class="text-base font-semibold text-gray-800 mb-2">Order #{{ $order->id }}</h3>

                    <table class="w-full border text-sm mb-4 bg-white rounded">
                        <thead class="bg-green-100">
                            <tr>
                                <th class="border px-2 py-1 text-left">Username</th>
                                <th class="border px-2 py-1 text-left">User ID</th>
                                <th class="border px-2 py-1 text-left">Status</th>
                                <th class="border px-2 py-1 text-left">Total</th>
                                <th class="border px-2 py-1 text-left">Address ID</th>
                                <th class="border px-2 py-1 text-left">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border px-2 py-1">{{ $order->user->name }}</td>
                                <td class="border px-2 py-1">{{ $order->user_id }}</td>
                                <td class="border px-2 py-1 capitalize">{{ $order->status }}</td>
                                <td class="border px-2 py-1">RM {{ number_format($order->total, 2) }}</td>
                                <td class="border px-2 py-1">{{ $order->delivery_id }}</td>
                                <td class="border px-2 py-1">{{ $order->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    @if($order->items->count() > 0)
                        <table class="w-full border text-sm mb-2 bg-white rounded">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-2 py-1 text-left">Product</th>
                                    <th class="border px-2 py-1 text-right">Qty</th>
                                    <th class="border px-2 py-1 text-right">Price</th>
                                    <th class="border px-2 py-1 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td class="border px-2 py-1">{{ $item->product->name }}</td>
                                        <td class="border px-2 py-1 text-right">{{ $item->quantity }}</td>
                                        <td class="border px-2 py-1 text-right">{{ number_format($item->price, 2) }}</td>
                                        <td class="border px-2 py-1 text-right">{{ number_format($item->subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="italic text-gray-500 text-sm mb-2">No items for this order.</p>
                    @endif

                    <form action="{{ route('orders.update-status', $order->id) }}" method="POST" class="flex items-center space-x-2 text-sm">
                        @csrf
                        <label for="status-{{ $order->id }}" class="font-medium">Change Status:</label>
                        <select id="status-{{ $order->id }}" name="status" class="border rounded px-2 py-1">
                            <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                        </select>
                        <button type="submit" class="btn btn-primary py-1 px-2 text-xs">
                            Update
                        </button>

                    </form>
                </div>
            @endforeach
         <div class="mt-6">
            {{ $orders->links() }}
        </div>
        @else
            <p class="italic text-gray-600 text-sm">No orders available.</p>
        @endif
    </div>
    
</div>
@endsection
