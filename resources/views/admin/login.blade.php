@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card mt-5">
      <div class="card-body p-4">
        <h4 class="card-title mb-4 text-center">Admin Login</h4>
        @if (\Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fa-solid fa-triangle-exclamation mr-2"></i> {{ \Session::get('error') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <form method="POST" action="{{route('check.login')}}">
          @csrf
          <!-- Email input -->
          <div class="form-group mb-3">
            <label for="email" class="small text-muted">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" />

          </div>


          <!-- Password input -->
          <div class="form-group mb-4">
            <label for="password" class="small text-muted">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" class="form-control" />

          </div>



          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>


        </form>

      </div>
    </div>
  </div>
  @endsection