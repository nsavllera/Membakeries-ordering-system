@extends('layouts.master')

@section('content')
<div class="card" style="background-color: #fdfaf5;">
  <div class="card-body mx-4">
    <div class="container">

      <!-- Title -->
      <p class="my-5 mx-5 text-center fw-bold" style="font-size: 30px;">ORDER INVOICE</p>

      <!-- Customer & Invoice Info -->
      <div class="row mb-3">
        <ul class="list-unstyled">
          <li class="fw-bold">Bakery Name: Membakeries</li>
          <li class="text-muted mt-1"><span class="fw-bold text-dark">Order ID:</span> #{{ $order->id }}</li>
          <li class="text-dark mt-1"><span class="fw-bold">Order Date:</span> {{ $order->created_at->format('d/m/Y') }}</li>
        </ul>
      </div>

      <div class="row fw-bold border-top border-bottom py-2">
        <div class="col-2">Product</div>
        <div class="col-2">Custom Details</div>
        <div class="col-4">Custom Image</div>
        <div class="col-1 text-center">Qty</div>
        <div class="col-1 text-center">Unit Price</div>
        <div class="col-2 text-end">Amount</div>
      </div>

      @foreach ($order->items as $item)
        <div class="row py-2 border-bottom">
          <!-- Product Name -->
          <div class="col-2">{{ $item->product->name }}</div>

          <!-- Custom Details -->
          <div class="col-2">
            @if (!empty($item->custom_details))
              Flavour: {{ $item->custom_details['flavour'] ?? 'N/A' }}<br>
              Size: {{ $item->custom_details['size'] ?? 'N/A' }}<br>
              Description: {{ $item->custom_details['description'] ?? 'N/A' }}
            @else
              <span class="text-muted">N/A</span>
            @endif
          </div>


          <!-- Custom Image -->
          <div class="col-4">
            @php
                $cloudName = 'dnoeu0ewo';
                $imageFilename = $item->custom_details['image_path']; 
                $imageUrl = "https://res.cloudinary.com/{$cloudName}/image/upload/{$imageFilename}";
            @endphp

            @if (!empty($imageFilename))
              <img src="{{ $imageUrl }}" alt="Custom Cake Design" width="200">

              <a href="{{ $imageUrl }}" class="btn btn-outline-primary" download>
                Download Image
              </a>
            @else
              <span class="text-muted">No image uploaded</span>
            @endif
          </div>

          <!-- Qty -->
          <div class="col-1 text-center">{{ $item->quantity }}</div>

          <!-- Unit Price -->
          <div class="col-1 text-center">RM {{ number_format($item->price, 2) }}</div>

          <!-- Amount -->
          <div class="col-2 text-end">RM {{ number_format($item->subtotal, 2) }}</div>
        </div>
      @endforeach


      <!-- Totals -->
      <div class="row text-dark fw-bold mt-4">
        <div class="col-10 text-end">Subtotal:</div>
        <div class="col-2 text-end">RM {{ number_format($order->total - ($order->delivery->fee ?? 0), 2) }}</div>
      </div>
      <div class="row text-dark fw-bold">
        <div class="col-10 text-end">Delivery Fee:</div>
        <div class="col-2 text-end">RM {{ number_format($order->delivery->fee ?? 0, 2) }}</div>
      </div>
      <hr style="border: 2px solid black;">
      <div class="row text-dark fw-bold">
        <div class="col-10 text-end">Total:</div>
        <div class="col-2 text-end">RM {{ number_format($order->total, 2) }}</div>
      </div>
      <hr style="border: 2px solid black;">

      <!-- Footer -->
      <div class="text-center mt-5">
        <p class="text-muted">Thank you for ordering with Membakeries!</p>
        <a href="{{ route('order.index') }}"><u class="text-info">← Back to Orders</u></a>
      </div>

    </div>
  </div>
</div>

@endsection
