@extends('layouts.master')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-semibold text-gray-800">Order List</h2>
    <div>
      <a href="#" class="px-3 py-2 bg-blue-600 text-white rounded text-sm">Export</a>
    </div>
  </div>

  <div class="row mb-2">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header text-brown rounded-top">
                    <h5 class="mb-0"><i class="fas fa-filter me-2"></i> Filter Orders by Status</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-tabs flex-wrap border-bottom px-3" id="order-status-tab" role="tablist">
                    @php
                        $filters = [
                            '' => 'All',
                            'preparing' => 'Preparing',
                            'on delivery' => 'On Delivery',
                            'can be pickuped' => 'Can Be Picked Up',
                            'delivered' => 'Delivered',
                            'canceled' => 'Canceled'
                        ];
                        $activeStatus = request('status');
                    @endphp
                    @foreach($filters as $key => $label)
                        <li class="nav-item mb-2 me-2" role="presentation">
                            <a 
                                class="nav-link rounded-pill px-4 py-2 {{ $activeStatus === $key ? 'active bg-brown text-brown' : 'text-brown' }}" 
                                href="{{ route('order.index', ['status' => $key]) }}"
                                style="transition: all 0.2s ease-in-out;"
                            >
                                {{ $label }}
                            </a>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

<div class="flex justify-center">
  <div class="overflow-x-auto bg-white rounded shadow">
    <table class="min-w-full divide-y divide-gray-200 text-sm overflow-visible">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2 text-left">Order #</th>
          <th class="px-4 py-2 text-left">Date</th>
          <th class="px-4 py-2 text-left">Customer</th>
          <th class="px-4 py-2 text-left">Payment</th>
          <th class="px-4 py-2 text-left">Status</th>
          <th class="px-4 py-2 text-left">Total</th>
          <th class="px-4 py-2 text-left">More</th>
          <th class="px-4 py-2 text-left w-60">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($orders as $order)
        <tr class="border-b overflow-visible"">
          <td class="px-4 py-2 font-medium text-gray-800">#{{ $order->id }}</td>
          <td class="px-4 py-2">{{ $order->created_at->format('d M Y H:i') }}</td>
          <td class="px-4 py-2">
            <div>{{ $order->user->name }}</div>
            <div class="text-xs text-gray-500">ID: {{ $order->user_id }}</div>
          </td>
          <td class="px-4 py-2">
            <span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-800">Paid</span>
          </td>
          <td class="px-4 py-2">
            <span class="px-2 py-1 rounded-full text-xs 
              {{
                $order->status == 'delivered' ? 'bg-green-100 text-green-800' :
                ($order->status == 'canceled' ? 'bg-red-100 text-red-800' :
                'bg-blue-100 text-blue-800')
              }}">
              {{ ucfirst($order->status) }}
            </span>
          </td>
          <td class="px-4 py-2">RM {{ number_format($order->total, 2) }}</td>
          <td class="px-4 py-2">
            <a href="{{ route('orders.invoice', $order->id) }}" class="text-blue-600 hover:underline">Details</a>
          </td>
          <td class="px-5 py-3 w-60 relative">
            <div class="dropdown-wrapper">
                <button class="dropdown-button">{{ ucfirst($order->status) }}</button>
                <button class="dropdown-toggle-button">▾</button>
                <div class="dropdown-menu">
                    @php
                        $statuses = ['preparing', 'delivered', 'canceled'];
                        if ($order->delivery->method === 'delivery') {
                            $statuses[] = 'on delivery';
                        } elseif ($order->delivery->method === 'pickup') {
                            $statuses[] = 'can be pickuped';
                        }
                    @endphp

                    @foreach($statuses as $stats)
                    <form action="{{ route('orders.update-status', $order->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="status" value="{{ $stats }}">
                        <button type="submit" class="dropdown-item {{ $order->status == $stats ? 'active' : '' }}">
                            {{ ucfirst($stats) }}
                        </button>
                    </form>
                    @endforeach

                </div>
            </div>
        </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="px-4 py-4 text-center text-gray-500">No orders found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

  <div class="mt-6">
    {{ $orders->links() }}
  </div>
</div>

@endsection
