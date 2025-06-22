@extends('layouts.master')

@section('content')
<div class="container mb-4">
    <h4 class="mb-4">Dashboard Overview</h4>
    <div class="row g-3">

        <div class="col-md-4 col-sm-6">
            <a href="{{ route('order.index') }}" class="text-decoration-none text-dark">
                <div class="card info-card bg-light hover-shadow">
                    <div class="card-body d-flex align-items-center">
                        <div class="info-icon bg-primary me-3 text-white p-3 rounded-circle">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Total Orders</h6>
                            <span class="fw-bold">{{ $totalOrders }}</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="{{ route('customers.index') }}" class="text-decoration-none text-dark">
                <div class="card info-card bg-light hover-shadow">
                    <div class="card-body d-flex align-items-center">
                        <div class="info-icon bg-success me-3 text-white p-3 rounded-circle">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Total Customers</h6>
                            <span class="fw-bold">{{ $totalCustomers }}</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="{{ route('items.index') }}" class="text-decoration-none text-dark">
                <div class="card info-card bg-light hover-shadow">
                    <div class="card-body d-flex align-items-center">
                        <div class="info-icon bg-warning me-3 text-white p-3 rounded-circle">
                            <i class="fas fa-box"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Total Products</h6>
                            <span class="fw-bold">{{ $totalProducts }}</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4 text-sm mb-4">
        <div class="bg-yellow-100 mb-2 p-3 rounded shadow">Preparing: {{ $stats['preparing'] }}</div>
        <div class="bg-blue-100 p-3 mb-2 rounded shadow">On Delivery: {{ $stats['on_delivery'] }}</div>
        <div class="bg-purple-100 p-3 mb-2 rounded shadow">Pickup Ready: {{ $stats['pickup_ready'] }}</div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">Recently Added Products</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($recentProducts as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $product->name }}
                                <span class="badge bg-info">{{ $product->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-info mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Weekly Sales Chart</h5>
                </div>
                <div class="card-body">
                    <canvas id="chart-canvas" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const chartLabels = @json($labels);
    const chartData = @json($data);

    const ctx = document.getElementById('chart-canvas').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Weekly Sales (RM)',
                data: chartData,
                borderColor: 'rgba(60,141,188,0.8)',
                backgroundColor: 'rgba(60,141,188,0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    ticks: {
                        maxRotation: 90,
                        minRotation: 45
                    }
                }
            },
        }
    });
</script>
@endpush
