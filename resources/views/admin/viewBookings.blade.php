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
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Bookings</h5>
        </div>

        <div class="table-responsive">
          <table class="table table-hover table-striped align-middle mb-0">
            <thead class="thead-dark">
              <tr>
                <th scope="col" style="width: 70px;">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Booking Date</th>
                <th scope="col">People</th>
                <th scope="col">Special Request</th>
                <th scope="col">Status</th>
                <th scope="col" class="text-right" style="width: 230px;">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($bookings as $booking)
              <tr>
                <th scope="row">{{ $booking->id }}</th>
                <td>{{$booking->name}}</td>
                <td><a href="mailto:{{$booking->email}}">{{$booking->email}}</a></td>
                <td>{{$booking->date}}</td>
                <td>{{$booking->num_people}}</td>
                <td>{{$booking->spe_request}}</td>
                <td><span class="badge badge-{{ $booking->status === 'approved' ? 'success' : ($booking->status === 'pending' ? 'warning' : 'secondary') }}">{{ ucfirst($booking->status) }}</span></td>
                <td class="text-right">
                  <a href="{{ route('edit.booking', $booking->id) }}" class="btn btn-sm btn-warning text-white">
                    <i class="fa fa-pen"></i> Change Status
                  </a>
                  <a href="{{route('delete.booking', $booking->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this booking?');">
                    <i class="fa fa-trash"></i> Delete
                  </a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="8" class="text-center text-muted py-4">No bookings found.</td>
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