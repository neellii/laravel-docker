@extends('layouts.front')

@section('content')
<div class="container">
 <div class="row">
 <div class="col-md-12">  
 <h2 class="section-title text-center mt-5">Orders List</h2>
  @if(count($orders))
  <div class="accordion" id="accordionExample">
   @foreach ($orders as $k => $order)
    <div class="accordion-item">
    <h4 class="accordion-header" id="{{ $k . 'heading' }}">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $k }}" aria-expanded="true" aria-controls="{{ $k }}">
        Order #{{ $k }}
      </button>
    </h4>
    <div id="{{ $k }}" class="accordion-collapse collapse show" aria-labelledby="{{ $k . 'heading' }}" data-bs-parent="#accordionExample">
    <div class="accordion-body">
      <p class="m-0">DateTime: {{ $order[0]->created_at }}</p>
      @foreach ($order as $item)
        <ul class="border p-2">
          <li class="list-group-item">Product: <strong><a class="link" href="{{ route('home.product.show', $item->product_id) }}">{{ $item->product->title }}</a></strong></li>
          <li class="list-group-item">
            <img style="max-height: 200px;" src="{{ $item->product->image }}" alt="product img">
          </li>
          <li class="list-group-item">Quantity: {{ $item->quantity }}</li>
          <li class="list-group-item">Price: ${{ $item->price }}</li>
        </ul>
      @endforeach
      <p class="border-top mb-0">Total: ${{ $order[0]->order->total }}</p>
    </div>
    </div>
    </div>
   @endforeach
   <div>
  @else
    <p class="text-center">No Orders Found</p>
  @endif
 </div> 
</div>
</div>
@endsection


