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
                                <span>Forgot Password</span></a>
                        </div>
                    </div>
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div id="forgotPass-card" class="card forgotPass-card">
                            <div class="card-body">
                                <div class="input-group">
                                    <label class="form-label">Please submit the email used for registration,
                                        check your inbox and follow
                                        the instructions provided</label>
                                    <input class="form-control" type="email" name="email" id="forgotEmail"
                                        placeholder="Enter email here">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn submit-forgot" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
