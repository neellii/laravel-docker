@extends('layouts.front')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-3 mt-4">
      <h2>Login form</h2>

      <form action="{{ route('login.auth') }}" method="POST">

        @csrf

        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input name="email" type="email" class="form-control" id="email" placeholder="example@mail.com">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input name="password" type="password" class="form-control" id="password" placeholder="Password">
        </div>

        <div class="mb-3 form-check">
          <input name="remember" type="checkbox" class="form-check-input" id="remember">
          <label for="remember" class="form-check-label">
            Remember me
          </label>         
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </div>
  
@endsection