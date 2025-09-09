@extends('layouts.admin')

@section('content')
<div class="container mt-4" style="margin-top: -150px; margin-left: -200px"> <!-- Add container and margin-top -->
  <div class="row g-4"> <!-- g-4 adds gutter spacing between columns -->
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Foods</h5>
          <p class="card-text">Number of foods: 8</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Orders</h5>
          <p class="card-text">Number of orders: 4</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Bookings</h5>
          <p class="card-text">Number of bookings: 4</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Admins</h5>
          <p class="card-text">Number of admins: 3</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection