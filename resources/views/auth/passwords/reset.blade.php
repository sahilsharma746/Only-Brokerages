@extends('layouts.app')

@section('content')
    <main>

        <section class="login-section">
            <div class="container d-flex flex-wrap justify-content-between align-items-center">
                <div class="left-content ">
                    <h1 class="section-title">Your investment journey starts here.</h1>
                    <p class="section-text">Take control of your financial future. Our platform offers a seamless
                        investing experience, from beginner to pro.
                        Explore a diverse range of investment options, gain valuable insights, and watch your
                        portfolio
                        grow. Join the Krust
                        community today.</p>
                </div>
                <div class="right-content w-100">
                    <div class="card-header">
                        <div id="forgotPass-tab-area">
                            <a href="{{ route('login') }}" class="btn-tab d-flex align-items-center g-15 w-max">
                                <i class="fa-solid fa-arrow-left-long"></i>
                                <span>{{ __('Reset Password') }}</span>

                            </a>
                        </div>
                    </div>
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div id="forgotPass-card" class="card forgotPass-card">
                            <div class="card-body">

                                <div class="input-group">
                                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <label for="password" class="form-label text">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>




                            </div>
                            <div class="card-footer">
                                <button type=" submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>




                </div>
            </div>
        </section>
    </main>
@endsection
