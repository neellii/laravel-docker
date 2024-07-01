@extends('layouts.front')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('styles')
<style>

.search-form {
  position: relative;
}

.search-form .ri-search-line{
position: absolute;
top: 5px;
left: 10px;
color: #9ca3af;
}

.left-pan{
padding-left: 7px;
}

.left-pan i{
padding-left: 10px;
}

.form-input{
height: 40px;
text-indent: 33px;
border-radius: 10px;
}

.form-input:focus{
box-shadow: none;
border:none;
}

#rangeValue {
    position: relative;
    text-align: center;
    width: 60px;
    font-size: 1.25em;
    color: #fff;
    background: #27a0ff;
    margin-left: 15px;
    border-radius: 25px;
    font-weight: 500;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1), -5px -5px 10px #fff, inset 5px 5px 10px rgba(0, 0, 0, 0.1), inset -5px -5px 5px rgba(255, 255, 255, 0.05);
}

.middle {
    position: relative;
    width: 100%;
    max-width: 500px;
    margin-top: 10px;
    display: inline-block;
}

.slider,
.slider-year {
    position: relative;
    z-index: 1;
    height: 5px;
    margin: 0 15px;
}

.slider>.track,
.slider-year>.track {
    position: absolute;
    z-index: 1;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    border-radius: 5px;
    background-color: #b5d7f1;
}

.slider>.range,
.slider-year>.range {
    position: absolute;
    z-index: 2;
    left: 0%;
    right: 0%;
    top: 0;
    bottom: 0;
    border-radius: 5px;
    background-color: var(--bs-primary);
}

.slider>.thumb,
.slider-year>.thumb {
    position: absolute;
    z-index: 3;
    width: 22px;
    height: 22px;
    background-color: var(--bs-primary);
    border-radius: 50%;
}

.slider>.thumb.left,
.slider-year>.thumb.left {
    left: 0%;
    transform: translate(-15px, -10px);
}

.slider>.thumb.right,
.slider-year>.thumb.right {
    right: 0%;
    transform: translate(15px, -10px);
}

.range_slider,
.range_slider-year {
    position: absolute;
    pointer-events: none;
    -webkit-appearance: none;
    appearance: none;
    z-index: 2;
    height: 10px;
    width: 100%;
    opacity: 0;
}

.range_slider::-webkit-slider-thumb,
.range_slider-year::-webkit-slider-thumb {
    pointer-events: all;
    width: 30px;
    height: 30px;
    border-radius: 0;
    border: 0 none;
    background-color: red;
    cursor: pointer;
    -webkit-appearance: none;
}

#multi_range {
    margin: 0 auto;
    background-color: var(--bs-primary);
    border-radius: 20px;
    text-align: center;
    width: 150px;
    font-weight: 500;
    font-size: 1em;
    color: #fff;
}

</style>
  
@endsection

@section('content')
<section id="popular-books" class="bookshelf py-4">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="section-title mb-4">Browse Books</h3>


        <div class="row height d-flex justify-content-center align-items-center">

        <div class="col-md-6">
          <form class="search-form mb-1" method="GET">
            <i class="ri-search-line"></i>
            <input name="title" type="text" class="form-control form-input mb-2" placeholder="Search by title or author">
            <input type="text" name="author" hidden>
            <input type="submit" hidden>
          </form>
        </div>

        <div class="col-md-6 mt-3">
        <select class="form-select category-select" aria-label="Default select example">
          <option selected disabled>Category</option>
          @foreach ($categoriesTree as $category)
            <option value="{{ $category->id }}">{{ $category->title }}</option>
          @endforeach
        </select>
        </div>

          <div class="col-md-6 my-1">
            <div class="middle">
              <span>Price filter</span>
              <div id="multi_range">
                  <span id="left_value">1</span><span> ~ </span><span id="right_value">500</span>
              </div>
              <div class="multi-range-slider my-2">
                  <input type="range" id="input_left" class="range_slider" min="0" max="500" value="0" onmousemove="left_slider(this.value)" ontouchmove="left_slider(this.value)">

                  <input type="range" id="input_right" class="range_slider" min="0" max="500" value="500" onmousemove="right_slider(this.value)" ontouchmove="right_slider(this.value)">
                  <div class="slider">
                      <div class="track"></div>
                      <div class="range"></div>
                      <div class="thumb left"></div>
                      <div class="thumb right"></div>
                  </div>
              </div>
              </div>
          </div>

          <div class="col-md-6 my-1">
            <div class="middle">
              <span>Year filter</span>
              <div id="multi_range">
                  <span id="left_value-year">1950</span><span> ~ </span><span id="right_value-year">2024</span>
              </div>
              <div class="multi-range-slider my-2">
                  <input type="range" id="input_left-year" class="range_slider-year" min="1950" max="2024" value="0" onmousemove="left_slider_year(this.value)" ontouchmove="left_slider_year(this.value)">

                  <input type="range" id="input_right-year" class="range_slider-year" min="1950" max="2024" value="2024" onmousemove="right_slider_year(this.value)" ontouchmove="right_slider_year(this.value)">
                  <div class="slider-year">
                      <div class="track"></div>
                      <div class="range"></div>
                      <div class="thumb left"></div>
                      <div class="thumb right"></div>
                  </div>
              </div>
              </div>
          </div>

        </div>
      </div>

        <div class="products-content mt-4">
            @include('products.products-list')
        </div>

      </div>
    </div>
  </div>

  <span style="display: none;" id="current_url-title"></span>
  <span style="display: none;" id="current_url-price-left"></span>
  <span style="display: none;" id="current_url-price-right"></span>
  <span style="display: none;" id="current_url-category"></span>
  <span style="display: none;" id="current_url-year-right"></span>
  <span style="display: none;" id="current_url-year-left"></span>
  <span style="display: none;" id="current_url">home/product-search</span>

</section>
@endsection

@section('scripts')
<script>
// ============= ADD TO CART ==============
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

// ============= GET FORM DATA FUNCTION ==============
function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    indexed_array['author'] = indexed_array['title'];

    return indexed_array;
}



// ============= PAGINATION URL HANDLIING ==============
$(window).on('hashchange', function() {
  if (window.location.hash) {
    var page = window.location.hash.replace('#', '');
    if (page == Number.NaN || page <= 0) {
      return false;
    } else {
      getData(page);
    }
  }
});

// ============= AJAX PAGINATION EVENT LISTENER ==============
$(document).ready(function()
{
  $(document).on('click', '.pagination a',function(event) {
    event.preventDefault();
    $('li').removeClass('active');
    $(this).parent('li').addClass('active');
    var myurl = $(this).attr('href');
    var page=$(this).attr('href').split('?')[1];
    getData(page);
  });
});

// ============= PAGINATION AJAX GET DATA FUNCTION  ==============
function getData(page) {
  $.ajax({
    url: 'home/product-search?' + page,
    type: "get",
    datatype: "json"
  })
    .done(function(data){
    $(".products-content").empty().html(data.html);
    location.hash = page;
    $('.products-content').first()[0].scrollIntoView();
  })
    .fail(function(e, ajaxOptions, thrownError){
    console.log(e.responseText);
  });
}

// ============= PRICE INPUT EVENTS ==============
const input_left = document.getElementById("input_left");
const input_right = document.getElementById("input_right");

const thumb_left = document.querySelector(".slider > .thumb.left");
const thumb_right = document.querySelector(".slider > .thumb.right");
const range = document.querySelector(".slider > .range");

const set_left_value = () => {
    const _this = input_left;
    const [min, max] = [parseInt(_this.min), parseInt(_this.max)];

    _this.value = Math.min(parseInt(_this.value), parseInt(input_right.value) - 1);

    const percent = ((_this.value - min) / (max - min)) * 100;
    thumb_left.style.left = percent + "%";
    range.style.left = percent + "%";
};

const set_right_value = () => {
    const _this = input_right;
    const [min, max] = [parseInt(_this.min), parseInt(_this.max)];

    _this.value = Math.max(parseInt(_this.value), parseInt(input_left.value) + 1);

    const percent = ((_this.value - min) / (max - min)) * 100;
    thumb_right.style.right = 100 - percent + "%";
    range.style.right = 100 - percent + "%";
};

input_left.addEventListener("input", set_left_value);
input_right.addEventListener("input", set_right_value);

function left_slider(value) {
    document.getElementById('left_value').innerHTML = value;
}
function right_slider(value) {
    document.getElementById('right_value').innerHTML = value;
}


// ============= YEAR INPUT EVENTS ==============
const input_left_year = document.getElementById("input_left-year");
const input_right_year = document.getElementById("input_right-year");

const thumb_left_year = document.querySelector(".slider-year > .thumb.left");
const thumb_right_year = document.querySelector(".slider-year > .thumb.right");
const range_year = document.querySelector(".slider-year > .range");

const set_left_value_year = () => {
    const _this = input_left_year;
    const [min, max] = [parseInt(_this.min), parseInt(_this.max)];

    _this.value = Math.min(parseInt(_this.value), parseInt(input_right_year.value) - 1);

    const percent = ((_this.value - min) / (max - min)) * 100;
    thumb_left_year.style.left = percent + "%";
    range_year.style.left = percent + "%";
};

const set_right_value_year = () => {
    const _this = input_right_year;
    const [min, max] = [parseInt(_this.min), parseInt(_this.max)];

    _this.value = Math.max(parseInt(_this.value), parseInt(input_left_year.value) + 1);

    const percent = ((_this.value - min) / (max - min)) * 100;
    thumb_right_year.style.right = 100 - percent + "%";
    range_year.style.right = 100 - percent + "%";
};

input_left_year.addEventListener("input", set_left_value_year);
input_right_year.addEventListener("input", set_right_value_year);

function left_slider_year(value) {
    document.getElementById('left_value-year').innerHTML = value;
}
function right_slider_year(value) {
    document.getElementById('right_value-year').innerHTML = value;
}





// ============= PRICE RANGE AJAX REQUEST ==============
$('.range_slider').on('change', function() {
  let values = [$('#input_left').val(), $('#input_right').val()]

  $.ajax({
    // $('#current_url').text() == '' ? 'home/product-search' : $('#current_url').text(),
    // replaceUrlValues($('#current_url').text(), 'price', values)

      url: replaceUrlValues('price', $('#current_url').text()),
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type:"GET",
      datatype: "json",
      data:{
        price: {
          left_value_price: values[0], 
          right_value_price: values[1]
        },
      },
      success:function(data){
        console.log(data);
        $('.products-content').children().remove();
        $('.products-content').append(data.html);
        $('#current_url-price-right').html(values[1]);
        $('#current_url-price-left').html(values[0]);
        $('#current_url').html(this.url);
        console.log(this.url);
        console.log(replaceUrlValues('price', this.url) + '_price')
      }
  });
})

// ============= YEAR RANGE AJAX REQUEST ==============
$('.range_slider-year').on('change', function() {
  let values = [$('#input_left-year').val(), $('#input_right-year').val()];

  // $('#current_url').text() == '' ? 'home/product-search' : $('#current_url').text()

  $.ajax({
      url: replaceUrlValues('year', $('#current_url').text()),
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type:"GET",
      datatype: "json",
      data:{
        published_year: {
          left_value_year:values[0], 
          right_value_year:values[1]
        },
      },
      success:function(data){
        $('.products-content').children().remove();
        $('.products-content').append(data.html);
        $('#current_url-year-left').html(values[0]);
        $('#current_url-year-right').html(values[1]);
        $('#current_url').html(this.url);
        console.log(this.url);
        console.log(replaceUrlValues('year', this.url) + '_year')
      },
      error: function(e) {
        console.log(e.responseText);
      }
  });
})


// ============= CATEGORY AJAX REQUEST ==============
$('.category-select').on('change', function() {

  let value = $(this).val();

  $.ajax({
    url: replaceUrlValues('category', $('#current_url').text()),
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "GET",
    dataType: 'json',
    data: { category_id: $(this).val() },
    success: function(data) {
      $('.products-content').children().remove();
      $('.products-content').append(data.html);
      $('#current_url-category').html(value);
      $('#current_url').html(this.url);
      console.log(this.url);
      console.log(replaceUrlValues('category', this.url) + '_category')
    },
    error: function(e) {
      console.log(e.responseText);
    }
  })
})

// ============= TITLE & AUTHOR AJAX SEARCH  ==============
$('.search-form').submit(function(e) {
  e.preventDefault();

  let formData = getFormData($(this));
  // replaceUrlValues($('#current_url').text(), 'title', formData['title']);

  $.ajax({
    url: replaceUrlValues('title', $('#current_url').text()),
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "GET",
    dataType: 'json',
    data: formData,
    success: function(data) {
      $('.products-content').children().remove();
      $('.products-content').append(data.html);
      $('#current_url-title').html(formData['title']);
      $('#current_url').html(this.url);
      console.log(this.url);
      console.log(replaceUrlValues('title', this.url) + '_title')
    },
    error: function(e) {
      console.log(e.responseText);
    }
  })
})


function replaceUrlValues(queryParam, url) {

  let base_url = 'home/product-search';

  if(url.includes('title') && queryParam != 'title') {
    let symbol = ifFirstOrSecondQueryParam(base_url, 'title');
    base_url += symbol + 'title=' + $('#current_url-title').text() + '&author=' + $('#current_url-title').text();
  }


  if(url.includes('price') && queryParam != 'price') {
    let symbol = ifFirstOrSecondQueryParam(base_url, 'price');

    base_url += symbol + 'price%5Bleft_value_price%5D=' + $('#current_url-price-left').text() + '&price%5Bright_value_price%5D=' + $('#current_url-price-right').text();
  }

  if(url.includes('published_year') && queryParam != 'year') {
    let symbol = ifFirstOrSecondQueryParam(base_url, 'published_year');

    base_url += symbol + 'published_year%5Bleft_value_year%5D=' + $('#current_url-year-left').text() + '&published_year%5Bright_value_year%5D=' + $('#current_url-year-right').text();
  }

  if(url.includes('category_id') && queryParam != 'category') {
    let symbol = ifFirstOrSecondQueryParam(base_url, 'category_id');

    base_url += symbol + 'category_id=' + $('#current_url-category').text();
  }


  return base_url;
}

function ifFirstOrSecondQueryParam(url, queryParam) {
  let arr = ['title', 'category_id', 'price', 'published_year'];
 
  arr = arr.filter(item => item !== queryParam);

  return !arr.some(el => url.includes(el)) ? '?' : '&';
}


</script>
@endsection