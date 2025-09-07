@extends('layouts.app')
@section('content')
<div class="container-xxl py-5 bg-dark hero-header mb-5" style="margin-top: -25px">
  <div class="container text-center my-5 pt-5 pb-4">
    <h1 class="display-3 text-white mb-3 animated slideInDown">Write review</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-center text-uppercase">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Write review</a></li>
      </ol>
    </nav>
  </div>
</div>
<!-- Service Start -->
<div class="container">

  <div class="col-md-12 bg-dark">
    <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
      <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
      <h1 class="text-white mb-4">Review</h1>
      <form method="POST" action="{{ route('users.submit.review') }}" class="col-md-12">
        @csrf
        <div class="row g-3">
          <div class="col-md-12">
            <div class="form-floating">
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Your Name" value="{{ old('name') }}">
              <label for="name">Your Name</label>
              @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
          <div class="col-12">
            <div class="form-floating">
              <textarea name="review" class="form-control @error('review') is-invalid @enderror" placeholder="Review" id="message" value="{{ old('review') }}" style="height: 100px"></textarea>
              <label for="message">Review</label>
              @error('review')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
          <div class="col-12">
            <button class="btn btn-primary w-100 py-3" type="submit">Submit Review</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
@endsection