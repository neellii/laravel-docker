<div id="all-genre products-container">
  <div class="row products">

  @foreach ($products as $product)
  
  <div class="col-md-3">
    <div class="product-item">
      <figure class="product-style mb-0">
        <a href="{{ route('home.product.show', [$product->id]) }}">
        <img src="{{ asset($product->image) }}" alt="Books" class="product-item">
        </a>

        <form class="add-form" action="{{ route('shopcart.store') }}" method="post">
          <input name="quantity" type="number" hidden value="1" min="1">
          <input name="product_id" hidden value="{{ $product->id }}">
          <button type="submit" class="add-to-cart" data-product-tile="add-to-cart">Add to
          Cart</button>
        </form>
          
      </figure>
      <figcaption class="mb-0">
        <h3>{{ $product->title }}</h3>
        <span>{{ $product->author }}r</span>
        <div class="item-price">$ {{ $product->price }}</div>
      </figcaption>
    </div>
  </div>

  @endforeach

  </div>

  {{ $products->withQueryString()->links() }}
</div>