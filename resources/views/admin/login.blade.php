@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
  <div class="col-sm-10 col-md-8 col-lg-5">
    <div class="card mt-5 shadow-sm">
      <div class="card-body p-4">
        <div class="text-center mb-3">
          <a href="{{ route('home') }}" class="h4 text-decoration-none text-dark">{{ config('app.name', 'Restoran') }} Admin</a>
        </div>

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('check.login') }}" novalidate>
          @csrf

          <div class="form-group mb-3">
            <label for="email" class="small text-muted">Email</label>
            <input
              type="email"
              name="email"
              id="email"
              value="{{ old('email') }}"
              class="form-control @error('email') is-invalid @enderror"
              placeholder="admin@example.com"
              required
              autofocus />
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="password" class="small text-muted">Password</label>
            <input
              type="password"
              name="password"
              id="password"
              class="form-control @error('password') is-invalid @enderror"
              placeholder="Enter your password"
              required />
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group form-check mb-3">
            <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me" {{ old('remember_me') ? 'checked' : '' }}>
            <label class="form-check-label small" for="remember_me">Remember me</label>
          </div>

          <button type="submit" class="btn btn-primary btn-block">Sign In</button>

          <div class="mt-3 text-center">
            <a href="{{ route('home') }}" class="small">Back to site</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection