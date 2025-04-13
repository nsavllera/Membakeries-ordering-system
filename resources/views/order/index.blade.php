@extends('layouts.master')

@section('content')
<div class="card">

	<h3 class="mt-4 mb-0">List Of Orders</h3>

	<div class="card-body bg-white justify-content-left">

		@if (session("message"))
		<div class="alert alert-success mt-3">
			<p>{{ session("message") }}</p>
		</div>
		@endif
		
        <form action="{{ route('order.index') }}" method="GET" class="mb-6">
            <label for="status" class="mr-4">Filter by Status:</label>
            <select id="status" name="status" onchange="this.form.submit()" class="border rounded-md p-2">
                <option value="">All</option>
                <option value="preparing" {{ $status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                <option value="delivered" {{ $status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="canceled" {{ $status == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
            <noscript><button type="submit" class="btn btn-primary mt-2">Filter</button></noscript>
        </form>

        @if(count($order) > 0)
            @foreach ($order as $orders)
                <div class="jumbotron w-70">
                    <h2 class="text-2xl font-semibold">Order #{{ $orders->id }}</h2>
                    <p>Username: {{ $orders->user->name }}</p>
                    <p>User ID: {{ $orders->user_id }}</p>
                    <p>Status: {{ $orders->status }}</p>
                    <p>Total: RM {{ $orders->total }}</p>
                    <p>Address: {{ $orders->delivery_id }}</p>
                    <p>Created At: {{ $order->timestamps->format('d-m-Y H:i') }}</p>

                    <h3 class="mt-4 text-xl">Items:</h3>
                    <table class="table-auto w-full text-left mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Product</th>
                                <th class="px-4 py-2">Quantity</th>
                                <th class="px-4 py-2">Price</th>
                                <th class="px-4 py-2">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders->items as $item)
                                <tr>
                                    <td class="px-4 py-2">{{ $item->product->name }}</td>
                                    <td class="px-4 py-2">{{ $item->quantity }}</td>
                                    <td class="px-4 py-2">RM {{ $item->price }}</td>
                                    <td class="px-4 py-2">RM {{ $item->subtotal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <form action="{{ route('orders.update-status', $orders->id) }}" method="POST" class="mt-4 mb-4">
                        @csrf
                        <label for="status" class="mr-4">Change Status:</label>
                        <select id="status" name="status" class="border rounded-md p-2">
                            <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                        </select>
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md mt-2">Update Status</button>
                    </form>
                </div>
            @endforeach
        @else
            <p class="text-gray-700">No orders available.</p>
        @endif

	</div>
</div>
@endsection