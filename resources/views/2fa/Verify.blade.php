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
               
                <form action="{{ route('2fa.Verify') }}" method="POST">
                    @csrf
                    <div id="login-card" class="card login-card">
                        <div class="card-body d-grid g-8">
                           <div class="input-group">
                                <label class="form-label" for="otp">Verify Your OTP To Procced</label>
                                <input class="form-control" type="text" id="auth_otp" name="otp"   required placeholder="enter OTP here"><br>
                                <p class=auth_text>The OTP in the Google Authenticator app updates in every 30 seconds. Please check the app for the latest code.</p>
                                @csrf
                            </div>
                        
                            <button type="submit" class="btn btn-primary">Verify</button>

                                                @error('otp')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                        </div>
                      
                    </div>

                </form><br>
                <a href="{{ route('reset-2fa') }}" class="text-decoration-none">Forgot Authenticator App Access? Reset 2FA</a>
                </div>
            
        </div>
    </section>
</main>
@endsection
