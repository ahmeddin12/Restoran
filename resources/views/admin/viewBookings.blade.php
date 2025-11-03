@extends('layouts.admin')
@section('content')


<div class="row">
  <div class="col">
    <div class="card">
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
        <h5 class="card-title mb-4 d-inline">Bookings</h5>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Booking date</th>
              <th scope="col">Number of people</th>
              <th scope="col">Special request</th>
              <th scope="col">Status</th>
              <th scope="col">Change Status</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($bookings as $booking)
            <tr>
              <th scope="row">1</th>
              <td>{{$booking->name}}</td>
              <td>{{$booking->email}}</td>
              <td>{{$booking->date}}</td>
              <td>{{$booking->num_people}}</td>
              <td>{{$booking->spe_request}}</td>
              <td>{{$booking->status}}</td>
              <td><a href="{{ route('edit.booking', $booking->id) }}" class="btn btn-warning text-white  text-center ">Change Status</a></td>
              <td><a href="{{route('delete.booking', $booking->id)}}" class="btn btn-danger  text-center ">delete</a></td>
            </tr>
          </tbody>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>

@endsection