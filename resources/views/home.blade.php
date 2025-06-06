@extends('layouts.master')

@section('content')
<div class="row">
    <!-- Card: Recently Added Products -->
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

    <!-- Card: Sales Chart -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">Sales Chart</div>
            <div style="width:75%;">
                 <x-chartjs-component :chart="$chart" />
            </div>
        </div>
    </div>
</div>
@endsection



