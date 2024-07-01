@extends('layouts.front')

@section('content')
  <div class="row">

      <h2 class="section-title text-center mt-5">{{ $category->title }} Category Books List</h2>

      <div class="row">
      @if(count($products))
      @foreach ($products as $product)
                            
        <div class="col-md-3">
              <div class="product-item">
                  <a href="{{ route('home.product.show', $product->id) }}">
                  <figure class="product-style">
                      <img src="{{ asset($product->image) }}" alt="Books" class="product-item">

                      <form action="{{ route('shopcart.store') }}" method="post">
                        @csrf
                       <input name="quantity" hidden value="1" />
                       <input name="product_id" hidden value="{{ $product->id }}" /> 
                        <button type="submit" class="add-to-cart" data-product-tile="add-to-cart">Add to
                            Cart</button>
                      </form>
                  </figure>
                  </a>
                  <figcaption>
                      <h3>{{ $product->title }}</h3>
                      <span>{{ $product->author }}r</span>
                      <div class="item-price">$ {{ $product->price }}</div>
                  </figcaption>
              </div>
      </div>
      @endforeach
      @else
      <p>No books for this category</p>
      @endif
    </div>
    </div>
  </div>
  
@endsection