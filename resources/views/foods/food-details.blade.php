@extends('layouts.app')

@section('content')
<div class="container-xxl py-5 bg-dark hero-header mb-5" style="margin-top: -25px">
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
<div class>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
</div>
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-md-6">
                <div class="row g-3">
                    <div class="col-12 text-start">
                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s" src="{{asset('assets/'.$fooditem->image.'')}}">
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <h1 class="mb-4">{{$fooditem->title}}</h1>
                <p class="mb-4">{{$fooditem->description}}</p>
                <div class="row g-4 mb-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                            <h3>Price: ${{$fooditem->price}}</h3>
                        </div>
                    </div>

                </div>
                @auth
                <form method="POST" action="{{ route('food.cart', $fooditem->id) }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="food_id" value="{{$fooditem->id}}">
                    <input type="hidden" name="name" value="{{$fooditem->title}}">
                    <input type="hidden" name="image" value="{{$fooditem->image}}">
                    <input type="hidden" name="price" value="{{$fooditem->price}}">
                    @if($cartVarifying > 0)
                    <button type="submit" name="submit" class="btn btn-primary py-3 px-5 mt-2" disabled>Added to Cart</button>
                    @else
                    <button type="submit" name="submit" class="btn btn-primary py-3 px-5 mt-2">Add to Cart</button>
                    @endif
                </form>
                @else
                <p class="alert alert-success">Login to add this product to cart</p>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection