@extends('layouts.main')

@section('title', 'Home page')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4">
      <h3>Categories List</h3>

      <button class="btn btn-dark mt-2">
        <a class="link-light" href="{{ route('admin.categories.create') }}">Add new category</a>
</button>

      <div class="mt-4">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Parent Category</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
              <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>
                <a class="link-dark" href="{{ route('admin.categories.show', $category->id) }}">
                  {{ $category->title }}
                </a>   
                </td>
                <td>
                  @if ($category->parent_id === null)
                    -
                  @else
                    {{ App\Http\Controllers\Admin\CategoryController::getParentsTree($category, $category->title) }}
                  @endif      
                </td>
                <td>{{ $category->status }}</td>
              </tr>  
            @endforeach
          </tbody>
        </table>

        {{ $categories->links() }}
      </div>
    </div>
</div>
  
@endsection