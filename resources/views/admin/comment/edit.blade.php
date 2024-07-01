@extends('layouts.main')

@section('title', 'Home page')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4 p-2">
      <h3>Edit Category</h3>

      <form action="{{ route('admin.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
          <label for="parent_id" class="form-label">Parent Category</label>
          <select name="parent_id" class="form-select" aria-label="Default select example">
            <option value="0">no parent category</option>
            @foreach ($categories as $cat)
              <option value="{{ $cat->id }}"
              {{ $category->parent_id === $cat->id ? 'selected' : '' }}
              >{{ \App\Http\Controllers\Admin\CategoryController::getParentsTree($cat, $cat->title) }}</option>
            @endforeach
          </select>
          @error('parent_id')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input name="title" type="text" class="form-control @error('title')
            is-invalid
          @enderror" id="title" placeholder="Title" value="{{ $category->title ?? old('title') }}"></input>
          @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="keywords" class="form-label">Keywords</label>
          <input name="keywords" type="text" class="form-control  @error('keywords')
            is-invalid
          @enderror" id="keywords" placeholder="Keywords" value="{{  $category->keywords ?? old('keywords') }}"></input>
          @error('keywords')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <input name="description" type="text" class="form-control @error('description')
            is-invalid
          @enderror" id="description" placeholder="Description" value="{{ $category->description ?? old('description') }}"></input>
          @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="image" class="form-label">Image</label>
          <input multiple id="image-input" name="image" class="form-control @error('image')
            is-invalid
          @enderror" type="file" accept="image/*">

          @if ($category->image != '' && !old('image'))
            <img id="category_image" src="{{ asset($category->image) }}" alt="category image" style="margin-top: 20px;">
            <div id="preview" style="display: none;"></div>
          @elseif (!$category->image && !old('image'))
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
            <option disabled>Status</option>
            <option value="1" 
            @if ($category->status === 1)
              selected
            @endif
            >Published</option>
            <option value="0"
            @if ($category->status === 0)
              selected
            @endif
            >Unpublished</option>
          </select>
          @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
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