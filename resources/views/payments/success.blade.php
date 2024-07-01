@extends('layouts.front')


@section('content')
<div class="container px-5 py-5 mx-auto">
    <div class="row d-flex justify-content-center">

    <h3 class="text-center mt-5">Thank you for your order!</h3>
    <a class="btn btn-primary" href="{{ route('orders.list') }}">My Orders</a>
</div>
@endsection