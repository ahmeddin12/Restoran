@extends('layouts.admin')

@section('content')

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5 d-inline">Edit Admin</h5>
        <form method="POST" action="{{ route('admins.update', $admin->id) }}">
          @csrf
          <div class="form-outline mb-4 mt-4">
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="name" value="{{ old('name', $admin->name) }}" />
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-outline mb-4 mt-4">
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="email" value="{{ old('email', $admin->email) }}" />
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-outline mb-4 mt-4">
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="new password (optional)" />
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
