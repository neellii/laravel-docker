@extends('layouts.main')

@section('title', 'Home page')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4 p-2">
      <h3>Add Category</h3>

      <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data" class="mt-4">
        @csrf
        <div class="mb-3">
          <label for="parent_id" class="form-label">Parent Category</label>
          <select name="parent_id" class="form-select" aria-label="Default select example">
            <option value="0" selected>no parent category</option>
            @foreach ($categories as $category)
            @if ($category->id === 1)
              @continue
            @endif
              <option value="{{ $category->id }}">{{ \App\Http\Controllers\Admin\CategoryController::getParentsTree($category, $category->title) }}</option>
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
          @enderror" id="title" placeholder="Title" value="{{ old('title') }}"></input>
          @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="keywords" class="form-label">Keywords</label>
          <input name="keywords" type="text" class="form-control  @error('keywords')
            is-invalid
          @enderror" id="keywords" placeholder="Keywords" value="{{ old('keywords') }}"></input>
          @error('keywords')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <input name="description" type="text" class="form-control @error('description')
            is-invalid
          @enderror" id="description" placeholder="Description" value="{{ old('description') }}"></input>
          @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="image" class="form-label">Image</label>
          <input name="image" class="form-control @error('image')
            is-invalid
          @enderror" type="file" id="image">
          @error('image')
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
        <button class="btn btn-dark" type="submit">Save</button>
      </form>
    </div>
</div>
  
@endsection