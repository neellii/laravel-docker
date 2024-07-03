@extends('layouts.main')

@section('title', 'Home page')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4 p-2">
      <h3>Edit Product</h3>

      <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
          <label for="title" class="form-label">Title</label>

          <input name="title" type="text" class="form-control @error('title')
            is-invalid
          @enderror" id="title" placeholder="Title" value="{{ $product->title ?? old('title') }}"></input>
          @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="author" class="form-label">Author</label>

          <input name="author" type="text" class="form-control @error('author')
            is-invalid
          @enderror" id="author" placeholder="Author" value="{{ $product->author ?? old('author') }}"></input>
          @error('author')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="published_year" class="form-label">Published Year</label>

          <input name="published_year" type="text" class="form-control @error('published_year')
            is-invalid
          @enderror" id="published_year" placeholder="Published Year" value="{{ $product->published_year ?? old('published_year') }}"></input>
          @error('published_year')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <input name="description" type="text" class="form-control @error('description')
            is-invalid
          @enderror" id="description" placeholder="Description" value="{{ $product->description ?? old('description') }}"></input>
          @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">Price</label>

          <input name="price" type="number" class="form-control @error('price')
            is-invalid
          @enderror" id="price" placeholder="Price" value="{{ $product->price ?? old('price') }}"></input>
          @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="mb-3">
          <label for="quantity" class="form-label">Quantity</label>

          <input name="quantity" type="number" class="form-control @error('quantity')
            is-invalid
          @enderror" id="quantity" placeholder="Quantity" value="{{ $product->quantity ?? old('quantity') }}"></input>
          @error('quantity')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="mb-3">
          <label for="category_id" class="form-label">Category</label>

          <select name="category_id" class="form-select">
            <option value="0" selected disabled>Select Category</option>
            @foreach ($categories as $cat)
            @if ($cat->id === 1)
              @continue
            @endif
              <option value="{{ $cat->id }}" {{ $product->category_id === $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>
            @endforeach
          </select>
          @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="mb-3">
          <label for="detail" class="form-label">Detail</label>
          <textarea name="detail" type="text" class="form-control  @error('detail')
            is-invalid
          @enderror" id="detail" placeholder="Detail">{{ $product->detail ?? old('detail') }}</textarea>
          @error('detail')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="keywords" class="form-label">Keywords</label>
          <input name="keywords" type="text" class="form-control  @error('keywords')
            is-invalid
          @enderror" id="keywords" placeholder="Keywords" value="{{ $product->keywords ?? old('keywords') }}"></input>
          @error('keywords')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>      

        <div class="mb-3">
          <label for="image" class="form-label">Image</label>
          <input multiple id="image-input" name="image" class="form-control @error('image')
            is-invalid
          @enderror" type="file" accept="image/*">

          @if (isset($product->image) && !old('image'))
            <img id="category_image" src="{{ asset($product->image) }}" alt="product image" style="margin-top: 20px;">
            <div id="preview" style="display: none;"></div>
          @elseif (is_null($product->image) && !old('image'))
            <div id="preview" style="display: none;"></div>
          @endif

          @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="mb-3">
          <select name="status" class="form-select  @error('status')
            is-invalid
          @enderror" aria-label="Default select example">
            <option selected disabled>Status</option>
            <option value="1">Published</option>
            <option value="0">Unpublished</option>
          </select>
          @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <input name="user_id" type="hidden" value="{{ auth()->id() }}">

        <button class="btn btn-dark" type="submit">Save</button>
      </form>
    </div>
</div>


<script defer>
const preview = (file) => {
  const fr = new FileReader();
  fr.onload = () => {
    const img = document.createElement("img");
    img.src = fr.result;  // String Base64 
    img.alt = file.name;
    document.querySelector('#preview').innerHTML = '';
    img.style.maxHeight = '200px';
    img.style.marginTop = '20px';
    document.getElementById("category_image").style.display = "none";
    document.querySelector('#preview').append(img);
    document.querySelector('#preview').style.display = 'initial';
  };
  fr.readAsDataURL(file);

};

document.querySelector("#image-input").addEventListener("change", (ev) => {
  if (!ev.target.files) return; // Do nothing.
  [...ev.target.files].forEach(preview);
});
</script>
  
@endsection