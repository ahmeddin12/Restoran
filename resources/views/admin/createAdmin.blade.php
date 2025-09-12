@extends('layouts.admin')

@section('content')

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5 d-inline">Create Admins</h5>
        <form method="POST" action="{{ route('admins.store') }}" enctype="multipart/form-data">
          @csrf
          <!-- Email input -->
          <div class="form-outline mb-4 mt-4">
            <input type="email" name="email" id="form2Example1" class="form-control @error('email') is-invalid @enderror" placeholder="email" value="{{ old('email') }}" />
          </div>
          @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror

          <div class="form-outline mb-4">
            <input type="text" name="name" id="form2Example1" class="form-control @error('name') is-invalid @enderror" placeholder="name" value="{{ old('name') }}" />
          </div>
          @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror

          <div class="form-outline mb-4">
            <input type="password" name="password" id="form2Example1" class="form-control @error('password') is-invalid @enderror" placeholder="password" value="{{ old('password') }}" />
          </div>
          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror

          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


        </form>

      </div>
    </div>
  </div>
</div>
@endsection