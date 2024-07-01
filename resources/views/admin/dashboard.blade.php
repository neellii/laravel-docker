@extends('layouts.main')

@section('title', 'Home page')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4">
      <ul class="list-group">
        <li class="list-group-item">
          <a href="{{ route('admin.categories.index') }}">Categories</a>
        </li>
        <li class="list-group-item">
          <a href="{{ route('admin.products.index') }}">Products</a>
        </li>
      </ul>
    </div>
</div>
  
@endsection