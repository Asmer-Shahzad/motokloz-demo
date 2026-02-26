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

                    <span class="signup-badge">Sign In</span>

                    <h2>Welcome back</h2>
                    <p>Motokloz your one-stop-shop for all your car buying needs!</p>

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

                    <form action="{{ route('login.post') }}" method="POST" class="user-form">
                        @csrf

                        <div class="form-group">
                            <img src="/assets/images/userlogin.png" alt="">
                            <input type="text" name="email" 
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Email / Username" 
                                   value="{{ old('email') }}" required autocomplete="username">
                        </div>

                        <div class="form-group">
                            <img src="/assets/images/password.png" alt="">
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Password" required autocomplete="current-password">
                        </div>

                        <div class="remember-row mb-3">
                            <label class="remember-me">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span>Remember me</span>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-auth d-flex align-items-center justify-content-center gap-2">
                            Login
                            <img src="/assets/images/bttnarrow.png" alt="arrow" width="18">
                        </button>
                    </form>

                    <div class="login-text mt-3">
                        Don’t have an account?
                        <a href="{{ route('signup') }}">Register Here!</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection