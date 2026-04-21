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

                    <span class="signup-badge">Forgot Password</span>

                    <h2>Reset Your Password</h2>
                    <p>Enter your email address and we'll send you a link to reset your password.</p>

                    {{-- ✅ SUCCESS ALERT --}}
                    @if (session('status'))
                        <div class="alert alert-success rounded-3 py-2 px-3 text-start">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- ✅ ERROR ALERT --}}
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3 py-2 px-3 text-start">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('password.email') }}" method="POST" class="user-form">
                        @csrf

                        <div class="form-group">
                            <img src="/assets/images/userlogin.png" alt="">
                            <input type="email" 
                                   name="email" 
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Enter your email address" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autocomplete="email"
                                   autofocus>
                        </div>

                        <button type="submit" class="btn btn-auth d-flex align-items-center justify-content-center gap-2">
                            Send Reset Link
                            <img src="/assets/images/bttnarrow.png" alt="arrow" width="18">
                        </button>
                    </form>

                    <div class="login-text mt-3">
                        Remember your password?
                        <a href="{{ route('login') }}">Back to Login</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection