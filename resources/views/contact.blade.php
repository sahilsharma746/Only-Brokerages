@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <main>

        <section class="login-section">
            <div class="container d-flex flex-wrap justify-content-between align-items-center">
                <div class="left-content ">
                    <h1 class="section-title">Contact Us</h1>
                    <p class="section-text">Here are ways to reach iusGot a question? Need some help? We're here for
                        you! Drop us a line and let's chat.</p>
                </div>
                <div class="right-content w-100">
                    <div class="card-header">
                        <div id="login-signup-tab-area" class="d-flex justify-content-center g-20">
                            <div class="card-title">Leave A Message</div>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div id="login-card" class="card login-card">
                        <form action="{{ route('contact.store') }}" method="post">
                            @csrf
                            <div class="card-body d-grid g-8">
                                <div class="input-group">
                                    <label class="form-label">Email</label>
                                    <input class=" form-control" type="email" name="email"
                                        placeholder="Enter email address">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" rows="6" name="message" placeholder="your message here"></textarea>
                                    @error('message')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer leave-message-footer">
                                <button class="btn submit-contact-us">Submit</button>


                                <p class="text-center"> - OR - </p>
                                <div class="btn-group d-flex justify-content-center g-25">
                                    <a class="btn" href="javascript:void(0)">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                    <a class="btn" href="javascript:void(0)">
                                        <i class="fa-regular fa-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('scripts')
@endsection
