@extends('layouts.front')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

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

                      <form class="add-form" action="{{ route('shopcart.store') }}" method="post">
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

@section('scripts')
<script>
$('.add-form').each(function() {
  $(this).submit(function(e) {
    e.preventDefault();
    let formData = new FormData(e.target)

    $.ajax({
    url: "{{ route('shopcart.store') }}",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    method: "POST",   
    data: formData,
    processData: false,
    contentType: false,
    success: function(data) {
        $('div.alert-fixed').html(data);
        setTimeout(function() {
            $('div.alert-fixed').find('.alert').fadeOut('0.5', function() {
              $(this).remove()
            });
    }, 1000);
    },
    error: function(error) {
        $('div.alert-fixed').html('');
        $.each(error.responseJSON.errors, function(key,value) {
            $('div.alert-fixed').append('<div class="alert alert-danger">'+value+'</div');
        }); 
    }
    }); 
  })
})
</script>
@endsection