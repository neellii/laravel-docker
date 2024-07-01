@extends('layouts.main')

@section('title', 'Home page')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4 p-2">
      <h3>Products List</h3>

      <button class="btn btn-dark mt-2">
        <a class="link-light" href="{{ route('admin.products.create') }}">Add new product</a>
      </button>

      <div class="mt-4">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
              <th scope="col">Category</th>
              <th scope="col">Keywords</th>
              <th scope="col">Status</th>
              <th scope="col">Rating</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($products as $product)
              <tr>
                <th scope="row">{{ $product->id }}</th>
                <td>
                <a class="link-dark" href="{{ route('admin.products.show', $product->id) }}">
                  {{ $product->title }}
                </a>   
                </td>
                <td>
                {{ '$' . $product->price }}
                </td>
                <td>
                {{ $product->quantity }}
                </td>
                <td>
                {{ App\Http\Controllers\Admin\CategoryController::getParentsTree($product->category, $product->category->title) }}
                </td>
                <td>
                {{ $product->keywords }}
                </td>
                <td>{{ $product->status }}</td>
                <td>
                  @if (count($product->comments))
                  {{ number_format((float)$product->comments->pluck('rate')->avg(), 2, '.') }}
                  @else
                  no rating  
                  @endif
                </td>
              </tr>  
            @endforeach
          </tbody>
        </table>

        {{ $products->links() }}
      </div>
    </div>
</div>
  
@endsection