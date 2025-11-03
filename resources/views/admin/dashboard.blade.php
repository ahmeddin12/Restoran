@extends('layouts.admin')

@section('content')

<div class="row">
  <div class="col-md-3 mb-3">
    <div class="card text-white bg-primary">
      <div class="card-body">
        <h6 class="card-subtitle mb-2">Foods</h6>
        <h3 class="card-title mb-0">{{ $foodCount }}</h3>
      </div>
    </div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card text-white bg-success">
      <div class="card-body">
        <h6 class="card-subtitle mb-2">Orders</h6>
        <h3 class="card-title mb-0">{{ $orderCount }}</h3>
      </div>
    </div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card text-white bg-warning">
      <div class="card-body">
        <h6 class="card-subtitle mb-2">Bookings</h6>
        <h3 class="card-title mb-0">{{ $bookingCount }}</h3>
      </div>
    </div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card text-white bg-danger">
      <div class="card-body">
        <h6 class="card-subtitle mb-2">Admins</h6>
        <h3 class="card-title mb-0">{{ $adminCount }}</h3>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-8 mb-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-3">Orders vs Bookings (Last 7 days)</h5>
        <canvas id="ordersBookingsChart" height="120"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-4 mb-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-3">Quick Actions</h5>
        <a href="{{ route('create.food') }}" class="btn btn-primary btn-block mb-2">Create Food</a>
        <a href="{{ route('admins.users.create') }}" class="btn btn-secondary btn-block mb-2">Create User</a>
        <a href="{{ route('admins.create') }}" class="btn btn-dark btn-block">Create Admin</a>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-3">Recent Orders</h5>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Total</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @php $recentOrders = \App\Models\Food\Checkout::orderBy('id','desc')->limit(5)->get(); @endphp
            @foreach($recentOrders as $o)
              <tr>
                <td>{{ $o->id }}</td>
                <td>{{ $o->name }}</td>
                <td>{{ $o->email }}</td>
                <td>${{ $o->price }}</td>
                <td>
                  @php
                    $badge = 'secondary';
                    if ($o->status === 'pending') $badge = 'warning';
                    elseif ($o->status === 'completed') $badge = 'success';
                    elseif ($o->status === 'cancelled') $badge = 'danger';
                  @endphp
                  <span class="badge badge-{{ $badge }}">{{ $o->status }}</span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  (function() {
    var ctx = document.getElementById('ordersBookingsChart');
    if (!ctx || typeof Chart === 'undefined') return;
    // Placeholder demo data; replace with real aggregated series if needed
    var labels = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
    var orders = [3,5,2,6,4,7,5];
    var bookings = [2,3,4,3,5,4,6];
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [
          { label: 'Orders', data: orders, borderColor: '#28a745', backgroundColor: 'rgba(40,167,69,0.1)', tension: 0.3 },
          { label: 'Bookings', data: bookings, borderColor: '#ffc107', backgroundColor: 'rgba(255,193,7,0.1)', tension: 0.3 }
        ]
      },
      options: {
        plugins: { legend: { display: true } },
        responsive: true,
        scales: { y: { beginAtZero: true } }
      }
    });
  })();
  </script>

@endsection