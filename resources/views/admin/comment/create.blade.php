@extends('layouts.main')

@section('title', 'Home page')

@section('styles')
<style>
  /* ======= Product stars ========== */
.rate {
    float: left;
    height: 46px;
}
.rate:not(:checked) > input {
    position: absolute;
    display: none;
}
.rate:not(:checked) > label {
    float: right;
    width: 1em;
    overflow: hidden;
    white-space: nowrap;
    cursor: pointer;
    font-size: 30px;
    color: #ccc;
}
.rate:not(:checked) > label:before {
    content: "★ ";
}
.rate > input:checked ~ label {
    color: #ffc700;
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}

.review-rating {
    height: 46px;
    width: 1em;
    cursor: pointer;
    font-size: 30px;
    color: #ccc;
}
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 mt-4 p-2">
      <h3>Add Comment</h3>

      <form action="{{ route('admin.comments.store') }}" method="post" class="mt-4">
        @csrf
        <div class="mb-3">
          <label for="subject" class="form-label">Subject</label>
          <input name="subject" type="text" class="form-control @error('subject')
            is-invalid
          @enderror" id="subject" placeholder="Subject" value="{{ old('subject') }}"></input>
          @error('subject')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="title" class="form-label">Review</label>
          <input name="review" type="text" class="form-control @error('review')
            is-invalid
          @enderror" id="review" placeholder="Review" value="{{ old('review') }}"></input>
          @error('review')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
            <div class="d-flex justify-content-between align-items-start flex-column">
                <span>Rating</span>
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
        
        <div class="mb-3">
          <select name="status" class="form-select  @error('status')
            is-invalid
          @enderror" aria-label="Default select example">
            <option selected>Status</option>
            <option value="1">Published</option>
            <option value="0">Unpublished</option>
          </select>
          @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <input type="hidden" name="product_id" value="{{ $_GET['product_id'] }}">

        <button class="btn btn-dark" type="submit">Save</button>
      </form>
    </div>
</div>
  
@endsection