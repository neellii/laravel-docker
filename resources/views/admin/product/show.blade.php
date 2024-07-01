@extends('layouts.main')

@section('title', 'Home page')

@section('content')
<div class="row">
    <div class="col-md-12 my-4 p-2">
      <h3>Product ID {{ $product->id }}</h3>

      <div class="mt-4">
        <table class="table table-striped">
          <tbody>
              <tr>
                <th scope="row">Title</th>
                <td>
                    {{ $product->title }}
                </td>
              </tr> 

              <tr>
                <th scope="row">Author</th>
                <td>
                    {{ $product->author }}
                </td>
              </tr> 

              <tr>
                <th scope="row">Publishing Year</th>
                <td>
                    {{ $product->published_year }}
                </td>
              </tr> 

              <tr>
                <th scope="row">Description</th>
                <td>
                    {{ $product->description }}
                </td>
              </tr> 

              <tr>
                <th scope="row">Price</th>
                <td>
                    {{ $product->price }}
                </td>
              </tr> 

              <tr>
                <th scope="row">Quantity</th>
                <td>
                    {{ $product->quantity }}
                </td>
              </tr>

              <tr>
                <th scope="row">Category</th>
                <td>
                    {{ $product->category->title }}
                </td>
              </tr> 

              <tr>
                <th scope="row">Detail</th>
                <td>
                    {{ $product->detail }}
                </td>
              </tr>

              <tr>
                <th scope="row">Keywords</th>
                <td>
                    {{ $product->keywords }}
                </td>
              </tr>

              <tr>
                <th scope="row">User</th>
                <td>
                    {{ $product->user->name }}
                </td>
              </tr>

              <tr>
                <th scope="row">Status</th>
                <td>
                    {{ $product->status }}
                </td>
              </tr>

              <tr>
                <th scope="row">Created</th>
                <td>
                    {{ $product->created_at }}
                </td>
              </tr>

              <tr>
                <th scope="row">Updated</th>
                <td>
                    {{ $product->updated_at }}
                </td>
              </tr>

              <tr>
                <th scope="row">Image</th>
                <td>
                    <img src="{{ asset($product->image) }}" alt="product image" style="max-height: 200px;">
                </td>
              </tr>

              <tr>
                <th scope="row">Comments/Reviews</th>
                <td>
                  @if (count($product->comments))
                  <div class="accordion" id="accordionExample">

                    @foreach ($product->comments as $comment)
                      <div class="accordion-item">
                        <h2 class="accordion-header">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $comment->id }}" aria-expanded="false" aria-controls="{{ $comment->id }}">
                            {{ $comment->subject }}
                          </button>
                        </h2>
                        <div id="{{ $comment->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                              User: {{ $comment->user->name }} <br>
                              Review: {{ $comment->review }} <br>
                              Rate: {{ $comment->rate }} <br>

                              <div class="d-flex mt-2">
                                <a class="btn btn-dark me-5" href="{{ route('admin.comments.edit', [$comment->id]) }}">Edit</a> 
                                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST">
                                  @csrf
                                  @method("DELETE")
                                  <input type="submit" class="btn btn-danger" value="Delete"></input>
                                </form>
                              </div>
                          </div>  
                        </div>
                      </div>
                      @endforeach
                    </div>
                  @endif
                </td>
              </tr>
          </tbody>
        </table>

        <div class="mt-5 d-flex">
          <a class="btn btn-dark me-5" href="{{ route('admin.products.edit', $product->id) }}">Edit</a>

          <a class="btn btn-dark me-5" href="{{ route('admin.comments.create', ['product_id' => $product->id]) }}">Add Comment/Review</a>

          <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
            @csrf
            @method("DELETE")
            <input type="submit" class="btn btn-danger" value="Delete"></input>
          </form>
        </div>
      </div>
    </div>
</div>
  
@endsection