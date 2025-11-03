@extends('layouts.app')

@section('content')
<div class="container-xxl py-5 bg-dark hero-header mb-5" style="margin-top: -25px">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Verify your email</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item text-white" aria-current="page">Check Email</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container">
    <div class="col-md-12 bg-dark">
        <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
            <h5 class="section-title ff-secondary text-start text-primary fw-normal">Email Verification</h5>
            <h1 class="text-white mb-4">Please check your inbox</h1>
            <p class="text-white-50 mb-4">We've sent a confirmation link to your email. Click the link to complete your registration. If you can't find it, check your spam folder.</p>

            <div class="d-flex gap-2">
                <a href="{{ url('/') }}" class="btn btn-outline-light">Return Home</a>
            </div>
        </div>
    </div>
</div>
@endsection


