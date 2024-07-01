@extends('layouts.main')

@section('title', 'Home page')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4">
      <h3>Comments/Reviews List</h3>

      <button class="btn btn-dark mt-2">
        <a class="link-light" href="{{ route('admin.comments.create') }}">Add new comment/review</a>
      </button>

      <div class="mt-4">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">User</th>
              <th scope="col">Product</th>
              <th scope="col">Rate</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($comments as $comment)
              <tr>
                <td>
                <a class="link-dark" href="{{ route('admin.products.show', $comment->id) }}">
                  {{ $comment->id }}
                </a>   
                </td>
                <td>
                <a class="link-dark" href="#">
                  {{ $comment->user->name }}
                </a>
                </td>
                <td>
                <a class="link-dark" href="#">
                  {{ $comment->product->title }}
                </a>
                </td>
                <td>
                <a class="link-dark" href="#">
                  {{ $comment->rate }}
                </a>
                </td>
                <td>{{ $comment->status }}</td>
              </tr>  
            @endforeach
          </tbody>
        </table>

        {{ $comments->links() }}
      </div>
    </div>
</div>
  
@endsection