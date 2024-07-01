@extends('layouts.front')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('styles')
<style>
.plus-minus {
    position: relative;
}

.plus {
    position: absolute;
    left: 15px;
    top: -30px;
    cursor: pointer;
}

.minus {
    position: absolute;
    top: 10px;
    left: 15px;
    cursor: pointer;
}

.vsm-text:hover {
    color: #FF5252;
}

.book, .book-img {
    max-width: 120px;
    max-height: 180px;
}

.border-top {
    margin-top: 20px;
    padding-top: 15px;
}

.card {
    margin: 40px 0px;
    padding: 40px 50px;
    border-radius: 20px;
    border: none;
    box-shadow: 1px 5px 10px 1px rgba(0,0,0,0.2);
}

.pay {
    width: 80px;
    height: 40px;
    object-fit: contain;
    border-radius: 5px;
    border: 1px solid #673AB7;
    margin: 0;
    cursor: pointer;
    box-shadow: 1px 5px 10px 1px rgba(0,0,0,0.2);
}

.gray {
    -webkit-filter: grayscale(100%);
    -moz-filter: grayscale(100%);
    -o-filter: grayscale(100%);
    -ms-filter: grayscale(100%);
    filter: grayscale(100%);
    color: #E0E0E0;
}

.gray .pay {
    box-shadow: none;
}

#tax {
    border-top: 1px lightgray solid;
    margin-top: 10px;
    padding-top: 10px;
}

#checkout {
    float: left;
}

#check-amt {
    float: right;
}

@media screen and (max-width: 768px) {
    .book, .book-img {
        width: 100px;
        height: 150px;
    }

    .card {
        padding-left: 15px;
        padding-right: 15px;
    }

    .mob-text {
        font-size: 13px;
    }

    .pad-left { 
        padding-left: 20px;
    }
}
</style>
@endsection

@section('content')
<div class="container px-5 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        @if(count($cart))
        <div class="col-5">
            <h4 class="heading">Shopping Cart</h4>
        </div>
        <div class="col-7">
            <div class="row text-right">
                <div class="col-5">
                    <h5 class="mt-2">Quantity</h5>
                </div>
                <div class="col-5 p-0">
                    <h5 class="mt-2">Total price</h5>
                </div>
                <div class="col-2">
               
                </div>
            </div>
        </div>
    </div>

      @foreach ($cart as $item)
        <div id="{{ $item->id }}" class="row d-flex justify-content-center border-top">
          <div class="col-5">
              <div class="row d-flex">
                  <div class="book">
                      <img src="{{ asset($item->product->image) }}" class="book-img">
                  </div>
                  <div class="my-auto flex-column d-flex pad-left">
                      <h4 class="mob-text mt-2 mb-0">{{ $item->product->title }}</h4>
                      <span class="mob-text">{{ $item->product->author }}</span>
                  </div>
              </div>
          </div>
          <div class="my-auto col-7">
              <div class="row text-right">
                  <div class="col-5 p-0">
                      <div class="d-flex justify-content-end">
                        <input style="width: 80px" class="form-control text-center quantity-input" min="1" max="{{ $item->product->quantity }}" type="number" name="quantity" value="{{ $item->quantity }}">
                        <span class="item-price" style="display: none;">{{ $item->product->price }}</span>
                        <span class="item-id" style="display: none;">{{ $item->product_id }}</span>
                        <span class="cart-id" style="display: none;">{{ $item->id }}</span>
                      </div>
                  </div>
                  <div class="col-5">
                      <h4 class="mob-text mb-0">$<span class="item-price-total">{{ $item->product->price * $item->quantity }}</span></h4>
                  </div>
                  <div class="col-2">
                    <i style="cursor:pointer" class="ri-close-large-line delete-btn"></i>
                    <span class="cart-id" style="display: none;">{{ $item->id }}</span>
                  </div>
              </div>
          </div>
      </div>
      @endforeach

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="row">
                <!-- <div class="col-lg-3 radio-group d-flex">
                    <div class="row d-flex px-3 radio justify-content-center">
                        <img class="pay" src="https://i.imgur.com/WIAP9Ku.jpg">
                        <p class="my-auto text-center">Credit Card</p>
                    </div>
                    <div class="row d-flex px-3 radio gray justify-content-center">
                        <img class="pay" src="https://i.imgur.com/OdxcctP.jpg">
                        <p class="my-auto text-center">Debit Card</p>
                    </div>
                    <div class="row d-flex px-3 radio gray justify-content-center">
                        <img class="pay" src="https://i.imgur.com/cMk1MtK.jpg">
                        <p class="my-auto text-center">PayPal</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="row px-2">
                        <div class="form-group col-md-6">
                            <label class="form-control-label">Name on Card</label>
                            <input type="text" id="cname" name="cname" placeholder="Johnny Doe">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-control-label">Card Number</label>
                            <input type="text" id="cnum" name="cnum" placeholder="1111 2222 3333 4444">
                        </div>
                    </div>
                    <div class="row px-2">
                        <div class="form-group col-md-6">
                            <label class="form-control-label">Expiration Date</label>
                            <input type="text" id="exp" name="exp" placeholder="MM/YYYY">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-control-label">CVV</label>
                            <input type="text" id="cvv" name="cvv" placeholder="***">
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-4 mt-5">
                    <div class="d-flex flex-row justify-content-between align-items-center px-4" id="tax">
                        <p class="mb-1 text-left">Total</p>
                        <h4 class="mb-1 text-right">$ <span class="total-price"> 
                            @if (count($cart))
                            @php
                                $total = 0;
                                foreach($cart as $item) {
                                $total += $item->product->price * $item->quantity;  
                                }
                            @endphp
                            {{ $total }}
                            @endif
                            </span></h4>
                    </div>

                    <form action="{{ route('checkout') }}" method="post">
                        @csrf
                        <input hidden id="total" value="{{ $total }}" name="total" type="text">
                        <button type="submit" id="checkout btn-primary">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @else

    <h3 class="text-center mt-5">No items found</h3>

    @endif
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function(){

$('.radio-group .radio').click(function(){
    $('.radio').addClass('gray');
    $(this).removeClass('gray');
});

function countTotal() {
  let total = 0;
  let totals = document.querySelectorAll('.item-price-total');
  totals.forEach((e) => {
    total += Number(e.innerHTML)
  })
  $('.total-price').html(total);
  $('#total').val(total);
}

$('.quantity-input').each(function() {
    $(this).change(function(e) {
        $(this).parent().parent().next().find('.item-price-total').html($(this).val() * Number($(this).next().text())) 
        countTotal()

        const formData = new FormData();
        formData.append("quantity", Number($(this).val()));
        formData.append("product_id", Number($(this).next().next().text()));
        formData.append("_method", 'PUT');

        $.ajax({
        url: `shopcart/${$(this).next().next().next().text()}`,
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

$('.delete-btn').each(function() { 
    $(this).click(function(e) {
        const formData = new FormData();
        const productId = $(this).next().text();
        formData.append("id", Number(productId));
        formData.append("_method", 'DELETE');
        
        $.ajax({
            url: `shopcart/${Number($(this).next().text())}`,
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
                    $('div.alert-fixed').find('.alert').fadeOut('0.5', function() { $(this).remove()
                    });
                }, 1000);
                $(`#${productId}`).remove()
                countTotal()
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

});
</script>
@endsection