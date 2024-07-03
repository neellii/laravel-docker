@extends('layouts.front')

@section('content')
<section class="py-1">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="mb-5 mb-md-0" src="{{ asset($product->image) }}" alt="product image" /></div>
            <div class="col-md-6">
                <h1 class="display-6 fw-bolder">{{ $product->title }}</h1>
                <a href="#">{{ $product->author }}</a> |
                <span href="#">{{ $product->published_year }}</span>

                <div class="fs-5 mb-3">
                    <span>${{ $product->price }}</span>
                </div>

                <div class="fs-8 mb-1">
                    <span>Rating: {{ sprintf("%.2f", $comments->pluck('rate')->avg()) }}/5</span>
                </div>

                <div class="fs-8 mb-2">
                    <span>Category: {{ $product->category->title }}</span>
                </div>

                <div class="d-flex">
                    <form class="add-form" action="{{ route('shopcart.store') }}" method="post">
                        @csrf
                        <input name="quantity" class="form-control text-center me-3" id="inputQuantity" min="1" type="num" value="1" style="max-width: 3rem" />
                        <input name="product_id" hidden value="{{ $product->id }}" />
                        <button style="margin-top: 0;" class="btn btn-outline-dark flex-shrink-0" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button> 
                    </form>    
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#des-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Description</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#rev-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Reviews</button>
        </li>
    </ul>

    <div class="tab-content p-5">
        <div class="tab-pane fade show active" id="des-tab-pane" role="tabpanel" aria-labelledby="des-tab" tabindex="0">
            <p>{{ $product->description }}</p>
        </div>

        <div class="tab-pane fade" id="rev-tab-pane" role="tabpanel" aria-labelledby="rev-tab" tabindex="0">
            <div class="row">
                <div class="product-reviews">

                @if (count($comments))

                    @foreach ($comments as $comment)
                    <div class="single-review">
                        <div class="review-heading">
                            <div><a href="#"><i class="icon icon-user me-2"></i></a>{{ $comment->user->name }}</div>
                            <div><a href="#"><i class="ri-time-line"></i></a>
                               {{ $comment->user->created_at }}
                            </div>
                            <div class="review-rating d-flex align-items-center">
                                <div id="1" class="star-rating {{ $comment->rate >= 1 ? 'star-colored' : '' }}"></div>
                                <div id="2" class="star-rating {{ $comment->rate >= 2 ? 'star-colored' : '' }}"></div>
                                <div id="3" class="star-rating {{ $comment->rate >= 3 ? 'star-colored' : '' }}"></div>
                                <div id="4" class="star-rating {{ $comment->rate >= 4 ? 'star-colored' : '' }}"></div>
                                <div id="5" class="star-rating {{ $comment->rate >= 5 ? 'star-colored' : '' }}"></div>
                            </div>
                        </div>
                        <div class="review-body">
                            <p>{{ $comment->review }}</p>
                        </div>
                    </div>                        
                    @endforeach
                    
                @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 p-3">
        <h4 class="text-uppercase">Write Your Review</h4>
        <p>Your email will not be published</p>

        <form action="{{ route('home.store.comment') }}" method="post">
            @csrf
            <input class="form-input" type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="form-group">
                <input name="subject" class="form-control @error('subject')
            is-invalid
          @enderror" type="text" placeholder="Subject" value="{{ old('subject') }}">
                @error('subject')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <textarea name="review" class="form-control @error('review')
            is-invalid
          @enderror" placeholder="Your review">{{ old('review') }}</textarea>
                 @error('review')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-between align-items-start flex-column">
                    <strong class="text-uppercase">Your Rating:</strong>
                    <div class="rate">
                        <input type="radio" id="star5" name="rate" value="5" />
                        <label for="star5">5 stars</label>

                        <input type="radio" id="star4" name="rate" value="4" />
                        <label for="star4" >4 stars</label>

                        <input type="radio" id="star3" name="rate" value="3"/>
                        <label for="star3" >3 stars</label>

                        <input type="radio" id="star2" name="rate" value="2"/>
                        <label for="star2" >2 stars</label>

                        <input type="radio" id="star1" name="rate" value="1"/>
                        <label for="star1">1 star</label>
                    </div>
                </div>
                @error('rate')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @auth
            <button class="btn btn-outline-dark flex-shrink-0">Submit</button>
            @else
            <p class="mt-3">Please <a href="{{ route('login') }}">login</a> to leave a review</p>
            @endauth
        </form>
    </div>
</section>
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