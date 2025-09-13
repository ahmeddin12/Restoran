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
        <h5 class="card-title mb-4 d-inline">Orders</h5>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Town</th>
              <th scope="col">Country</th>
              <th scope="col">Address</th>
              <th scope="col">Total Price</th>
              <th scope="col">Status</th>
              <th scope="col">Change Status</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)
            <tr>
              <th scope="row">{{ $order->id }}</th>
              <td>{{ $order->name }}</td>
              <td>{{ $order->email }}</td>
              <td>{{ $order->town }}</td>
              <td>{{ $order->country }}</td>
              <td>{{ $order->address }}</td>
              <td>${{ $order->price }}</td>
              <td>{{ $order->status }}</td>
              <td><a href="{{ route('edit.order', $order->id) }}" class="btn btn-warning text-white  text-center ">Change Status</a></td>
              <td><a href="#" class="btn btn-danger  text-center ">delete</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


@endsection