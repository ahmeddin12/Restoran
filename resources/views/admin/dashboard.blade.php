@extends('layouts.admin')

@section('content')

<div class="row">
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Foods</h5>
        <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
        <p class="card-text">number of foods: {{ $foodCount }}</p>

      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Orders</h5>

        <p class="card-text">number of orders: {{ $orderCount }}</p>

      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Bookings</h5>

        <p class="card-text">number of bookings: {{ $bookingCount }}</p>

      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Admins</h5>

        <p class="card-text">number of admins: {{ $adminCount }}</p>

      </div>
    </div>
  </div>
</div>

@endsection