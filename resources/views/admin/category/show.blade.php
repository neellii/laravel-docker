@extends('layouts.main')

@section('title', 'Home page')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4">
      <h3>Category ID {{ $category->id }}</h3>

      <div class="mt-4">
        <table class="table table-striped">
          <tbody>
              <tr>
                <th scope="row">Status</th>
                <td>
                    {{ $category->status }}
                </td>
              </tr> 

              <tr>
                <th scope="row">Title</th>
                <td>
                    {{ $category->title }}
                </td>
              </tr> 

              <tr>
                <th scope="row">Parent Category</th>
                <td>
                    {{ App\Http\Controllers\Admin\CategoryController::getParentsTree($category, $category->title) }}
                </td>
              </tr>

              <tr>
                <th scope="row">Description</th>
                <td>
                    {{ $category->description }}
                </td>
              </tr> 

              <tr>
                <th scope="row">Keywords</th>
                <td>
                    {{ $category->keywords }}
                </td>
              </tr>

              <tr>
                <th scope="row">Image</th>
                <td>
                  @if($category->image != false)
                    <img src="{{ asset($category->image) }}" alt="category image" style="max-height: 200px;">
                  @endif
                </td>
              </tr>

          </tbody>
        </table>

        <div class="mt-5 d-flex">
          <a class="btn btn-dark me-5" href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>

          <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
            @csrf
            @method("DELETE")
            <input type="submit" class="btn btn-danger" value="Delete"></input>
          </form>
        </div>
      </div>
    </div>
</div>
  
@endsection