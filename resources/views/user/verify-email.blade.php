@extends('layouts.front')

@section('title', 'Home page')

@section('content')
<div class="alert alert-info">
  Thank you for registering! A link to confirm your registratiuon has been sent to your email
</div>
<div>
  <form action="{{ route('verification.send') }}" method="post">
    @csrf
    <button type="submit" class="btn btn-link ps-0">Send link again</button>
  </form>
</div>
@endsection