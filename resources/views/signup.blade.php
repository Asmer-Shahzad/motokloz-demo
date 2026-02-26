@extends('layouts.app')

@section('content')
<section class="auth-section">
    <div class="container">
        <div class="auth-card row g-0">

            <!-- Image -->
            <div class="col-lg-6 d-none d-lg-block">
                <div class="auth-image">
                    <img src="/assets/images/truck.png" alt="truck">
                </div>
            </div>

            <!-- Form -->
            <div class="signup-form col-lg-6 col-12">
                <div class="auth-form text-center">

                    <span class="signup-badge">Sign Up</span>

                    <h2>Create an Account</h2>
                    <p>Motokloz your one-stop-shop for all your car buying needs!</p>

                    {{-- ✅ SUCCESS MESSAGE --}}
                    @if(session('success'))
                        <div class="alert alert-success rounded-3 py-2 px-3 text-start">
                            {{ session('success') }}
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

                    <form action="{{ route('signup.post') }}" method="POST" class="user-form">
                        @csrf

                        <div class="form-group">
                            <img src="/assets/images/userlogin.png" alt="">
                            <input type="text" name="name" 
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Username" 
                                   value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <img src="/assets/images/Vector.png" alt="">
                            <input type="email" name="email" 
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Email" 
                                   value="{{ old('email') }}" required autocomplete="email">
                        </div>

                        <div class="form-group">
                            <img src="/assets/images/password.png" alt="">
                            <input type="password" name="password" 
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Password" required autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <img src="/assets/images/password.png" alt="">
                            <input type="password" name="password_confirmation" 
                                   class="form-control"
                                   placeholder="Confirm Password" required>
                        </div>

                        <button type="submit" class="btn btn-auth d-flex align-items-center justify-content-center gap-2">
                            Sign Up
                            <img src="/assets/images/bttnarrow.png" alt="arrow" width="18">
                        </button>
                    </form>

                    <div class="login-text mt-3">
                        Already have an account?
                        <a href="{{ route('login') }}">Login Here!</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection