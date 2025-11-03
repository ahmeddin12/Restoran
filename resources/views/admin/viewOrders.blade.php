@extends('layouts.admin')

@section('content')


<div class="row">
  <div class="col">
    <div class="card" style="margin-left: -20px;">
      <div class="card-body">
        @if (\Session::has('success'))
        <div class="alert alert-success">
          <ul>
            <li>{!! \Session::get('success') !!}</li>
          </ul>
        </div>
        @endif
        @if (\Session::has('delete'))
        <div class="alert alert-success">
          <ul>
            <li>{!! \Session::get('delete') !!}</li>
          </ul>
        </div>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Orders</h5>
        </div>

        <div class="table-responsive">
          <table class="table table-hover table-striped align-middle mb-0">
            <thead class="thead-dark">
              <tr>
                <th scope="col" style="width: 70px;">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Town</th>
                <th scope="col">Country</th>
                <th scope="col">Address</th>
                <th scope="col">Total</th>
                <th scope="col">Status</th>
                <th scope="col" class="text-right" style="width: 230px;">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($orders as $order)
              <tr>
                <th scope="row">{{ $order->id }}</th>
                <td>{{ $order->name }}</td>
                <td><a href="mailto:{{ $order->email }}">{{ $order->email }}</a></td>
                <td>{{ $order->town }}</td>
                <td>{{ $order->country }}</td>
                <td>{{ $order->address }}</td>
                <td>${{ $order->price }}</td>
                <td><span class="badge badge-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'secondary') }}">{{ ucfirst($order->status) }}</span></td>
                <td class="text-right">
                  <a href="{{ route('edit.order', $order->id) }}" class="btn btn-sm btn-warning text-white">
                    <i class="fa fa-pen"></i> Change Status
                  </a>
                  <a href="{{ route('delete.order', $order->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this order?');">
                    <i class="fa fa-trash"></i> Delete
                  </a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="9" class="text-center text-muted py-4">No orders found.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection