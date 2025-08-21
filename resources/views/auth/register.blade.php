@extends('layouts.app')

@section('content')
<div class="col-md-12 bg-dark">
    <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Register</h5>
        <h1 class="text-white mb-4">Register for a new user</h1>

        <!-- FIXED FORM -->
        <form method="POST" action="{{ route('register') }}" class="col-md-12">
            @csrf
            <div class="row g-3">

                <!-- Name -->
                <div class="col-md-12 mb-3">
                    <div class="form-floating">
                        <input id="name" type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}"
                               required autocomplete="name" autofocus>
                        <label for="name">Name</label>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-12 mb-3">
                    <div class="form-floating">
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}"
                               required autocomplete="email">
                        <label for="email">Your Email</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div class="col-md-12 mb-3">
                    <div class="form-floating">
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="new-password">
                        <label for="password">Password</label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="col-md-12 mb-3">
                    <div class="form-floating">
                        <input id="password-confirm" type="password"
                               class="form-control"
                               name="password_confirmation" required autocomplete="new-password">
                        <label for="password-confirm">Confirm Password</label>
                    </div>
                </div>

                <!-- Submit -->
                <div class="col-md-12">
                    <button class="btn btn-primary w-100 py-3" type="submit">Register</button>
                </div>

            </div>
        </form>
        <!-- END FIXED FORM -->
    </div>
</div>
@endsection
