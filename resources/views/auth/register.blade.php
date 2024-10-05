@extends('layouts.app')
@section('styles')
    <!-- nice select 2 -->
    <link rel="stylesheet" href="{{ asset('assets') }}/nice-select-2/nice-select2.css">
@endsection
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
                        <div id="login-signup-tab-area" class="d-flex justify-content-center g-20">
                            <a href="{{ route('login') }}" class="btn-tab">Log In</a>
                            <span>|</span>
                            <a href="{{ route('register') }}" class="btn-tab active">Sign Up</a>
                        </div>
                    </div>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div id="signup-card" class="card signup-card">
                            <div class="card-body d-grid g-8">
                                <div class="input-group">
                                    <label class="form-label">Account Type</label>
                                    <select class="form-control" name="account_type" id="accountType" searchable="false"
                                        style="opacity: 0; width: 0px; padding: 0px; height: 0px;" required>
                                        @foreach ($user_account_types as $account_type)
                                            <option @if ($requested_account_type == $account_type->id) selected @endif value="{{$account_type->id}}">{{$account_type->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('account_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="d-flex g-15">
                                    <div class="input-group">
                                        <label class="form-label">First Name</label>
                                        <input class="form-control" type="text" placeholder="John" name="first_name" value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="input-group">
                                        <label class="form-label">Last Name</label>
                                        <input class="form-control" type="text" placeholder="Doe" name="last_name" value="{{ old('last_name') }}" required>
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="input-group">
                                    <label class="form-label">Email</label>
                                    <input class="form-control" type="email" placeholder="Enter email address" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <label class="form-label">Username</label>
                                    <input class="form-control" type="text" placeholder="Enter Username" name="username" value="{{ old('username') }}" required>
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <label class="form-label">Country</label>
                                    <select class="form-control" id="userCountry" searchable="true" style="" name="country" required>    
                                        <option value="">Select Country</option>
                                        @foreach($countries as $code => $name)
                                            <option value="{{ $code }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-group">
                                    <label class="form-label">Phone Number :</label>
                                    <input class="form-control" type="tel" placeholder="Enter Phone Number" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <label class="form-label">Referal ID</label>
                                    <input class="form-control" type="text" placeholder="Enter Referal ID" name="referal_id" value="{{ old('referal_id') }}">
                                    @error('referal_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <label class="form-label">Password</label>
                                    <input class="form-control" type="password" id="signupPassword"
                                        placeholder="Enter password" name="password" required>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <label class="form-label">Confirm Password</label>
                                    <input class="form-control" type="password" id="signupPasswordConfirem"
                                        placeholder="Enter password" name="password_confirmation" required>
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="hidden" name="time-zone" id="time-zone" class="time-zone">
                            </div>
                            <div class="card-footer">
                                <button class="btn submit-signup" type="submit">Sign Up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('scripts')
    <!-- nice select 2 -->
    <script src="{{ asset('assets') }}/nice-select-2/nice-select2.js"></script>
@endsection
