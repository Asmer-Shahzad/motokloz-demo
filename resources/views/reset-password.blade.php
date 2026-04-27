@extends('layouts.app')

@section('content')
<section class="auth-section">
    <div class="container">
        <div class="auth-card row g-0">

            <!-- Image -->
            <div class="col-lg-6 d-none d-lg-block">
                <div class="auth-image">
                    <img src="/assets/images/Main.png" alt="main image">
                </div>
            </div>

            <!-- Form -->
            <div class="signup-form col-lg-6 col-12">
                <div class="auth-form text-center">

                    <span class="signup-badge">Reset Password</span>

                    <h2>Create New Password</h2>
                    <p>Please enter your new password below.</p>

                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3 py-2 px-3 text-start">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('password.update') }}" method="POST" class="user-form">
                        @csrf
                        
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                        <div class="form-group">
                            <img src="/assets/images/password.png" class="light-dark" alt="">
                            <input type="password" 
                                   name="password" 
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="New Password" 
                                   required>
                        </div>

                        <div class="form-group">
                            <img src="/assets/images/password.png" class="light-dark" alt="">
                            <input type="password" 
                                   name="password_confirmation" 
                                   class="form-control"
                                   placeholder="Confirm New Password" 
                                   required>
                        </div>

                        <button type="submit" class="btn btn-auth d-flex align-items-center justify-content-center gap-2">
                            Reset Password
                            <img src="/assets/images/bttnarrow.png" alt="arrow" width="18">
                        </button>
                    </form>

                    <div class="login-text mt-3">
                        <a href="{{ route('login') }}">Back to Login</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection