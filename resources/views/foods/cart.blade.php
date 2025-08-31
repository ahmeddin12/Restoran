@extends('layouts.app')
@section('content')
<div class="container-xxl py-5 bg-dark hero-header mb-5" style="margin-top:-25px">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Cart</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Cart</a></li>
            </ol>
        </nav>
    </div>
</div>

@if (\Session::has('delete'))
<div class="alert alert-success">
    <ul>
        <li>{!! \Session::get('delete') !!}</li>
    </ul>
</div>
@endif
<div class="container">

    <div class="col-md-12">
        <table class="table">

            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @if($cartItems->count() > 0)
                @foreach($cartItems as $food)
                <tr>
                    <th><img width="40" height="40" src="{{asset('assets/'.$food->image.'')}}" </th>
                    <td>{{$food->name}}</td>
                    <td>${{$food->price}}</td>
                    <td><a href="{{route('food.delete.cart' , $food->food_id)}}" class="btn btn-danger text-white">delete</td>
                </tr>
                @endforeach
                @else
                <h6 class="alert alert-success">You have no items in cart yet</h6>
                @endif

    </div>
    </tbody>
    </table>
    <div class="position-relative mx-auto" style="max-width: 400px; padding-left: 679px;">
        <p style="margin-left: -7px;" class="w-19 py-3 ps-4 pe-5" type="text">Total: ${{$totalPrice}}</p>
        @if($totalPrice == 0)
        <div style="display: flex; align-items: center; text-align: center; margin: 20px 0;">
            <hr style="flex: 1; border: none; border-top: 1px solid #ccc; margin: 0;">
            <span style="padding: 0 10px; color: #856404; font-weight: 500;">
                No items in cart. You can't checkout.
            </span>
            <hr style="flex: 1; border: none; border-top: 1px solid #ccc; margin: 0;">
        </div>
        @else
        <form method="POST" action="{{route('prepare.checkout') }}">
            @csrf
            <input type="text" value={{$totalPrice}} name="price">

            <button type="submit" name="submit" class="btn btn-primary py-2 top-0 end-0 mt-2 me-2">Checkout</button>
        </form>

        @endif
    </div>
</div>
@endsection