@extends('layouts.app')
@section('styles')
@endsection
@section('content')
<main>
        <section class="identity-section">
            <div class="container">
                <h1 class="title text-center">Who <span class="text-primary">we</span> are</h1>
                <div class="card-group d-flex flex-wrap justify-content-evenly w-100">
                    <div class="card d-flex flex-column">
                        <div class="card-badge w-max">Service</div>
                        <div class="card-title">Leading the Way in Financial Services</div>
                        <div class="card-text">Manage your portfolio effortlessly across multiple exchanges. Get instant
                            access to real-time data, empowering you to
                            make informed decisions and stay ahead in the market.</div>
                        <img src="{{ asset('assets') }}/img/identity-coin_prev_ui.png" class="card-img">
                    </div>
                    <div class="card d-flex flex-column">
                        <div class="card-badge w-max">Product</div>
                        <div class="card-title">We understand what you need</div>
                        <div class="card-text">We specialize in advising clients on mergers, acquisitions, investment
                            research, financial analysis, and other financial
                            transactions.</div>
                        <img src="{{ asset('assets') }}/img/identity-business-money.png" class="card-img w-max">
                    </div>
                    <div class="card d-flex flex-column">
                        <div class="card-badge w-max">The World’s</div>
                        <div class="card-title">Fastest growing forex trading platform</div>
                        <div class="card-text">Access over 1,000+ instruments across Forex, CFDs on crypto, stocks,
                            commodities, indices, and more, all on the
                            fastest-growing trading platform.</div>
                        <img src="{{ asset('assets') }}/img/identity-globe_prev_ui.png" class="card-img">
                    </div>
                </div>
            </div>
        </section>

        <section class="review-section">
            <style>
                section.review-section .card-group {
                    margin-bottom: 50px;
                }

                section.review-section .card-group .card .card-title {
                    font-size: 15px;
                    font-weight: 600;
                    color: var(--secondary-color);
                }

                section.review-section .card-group .card .card-text {
                    font-size: 15px;
                    font-weight: 400;
                    margin-top: -2px;
                }
            </style>
            <div class="container">
                <div class="card-group d-flex flex-wrap r-g-15">
                    <div class="card d-flex flex-column g-4 text-center">
                        <div class="card-star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <!-- <i class="fa-solid fa-star-half-stroke"></i> -->
                            <!-- <i class="fa-regular fa-star"></i> -->
                        </div>
                        <div class="card-title">Web & Mobile Trading</div>
                        <div class="card-text">Web Trader 4 could be used on all Web & Mobile, compatible with Mac,
                            Linux or
                            Windows.</div>
                    </div>
                    <div class="card d-flex flex-column g-4 text-center">
                        <div class="card-star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <!-- <i class="fa-solid fa-star-half-stroke"></i> -->
                            <!-- <i class="fa-regular fa-star"></i> -->
                        </div>
                        <div class="card-title">Security & Privacy</div>
                        <div class="card-text">All information, transaction history and date encryptions are carefully
                            stored and secured in our database.</div>
                    </div>
                    <div class="card d-flex flex-column g-4 text-center">
                        <div class="card-star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <!-- <i class="fa-solid fa-star-half-stroke"></i> -->
                            <!-- <i class="fa-regular fa-star"></i> -->
                        </div>
                        <div class="card-title">Trading Academy</div>
                        <div class="card-text">If you need assistance with your trading operations, we have a
                            professional staff, ready to guide you.</div>
                    </div>
                    <div class="card d-flex flex-column g-4 text-center">
                        <div class="card-star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <!-- <i class="fa-solid fa-star-half-stroke"></i> -->
                            <!-- <i class="fa-regular fa-star"></i> -->
                        </div>
                        <div class="card-title">Charts & Analysis</div>
                        <div class="card-text">We can provide you with advanced technical charts and analysis.</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="text-section">
            <div class="container">
                <p class="section-text">At <b>Only brokerage</b>, we've dedicated years to providing you with the
                    best tools
                    and guidance for navigating the
                    financial markets. Our mission is straightforward: whether you're a seasoned professional or just
                    starting out, we equip
                    you with everything you need to make informed decisions and smart choices in the market. With our
                    user-friendly
                    platform, we believe anyone can become a successful trader.
                    2024 has been a milestone year for us. With a growing user base and our cutting-edge trading tools,
                    Only brokerage is
                    on track to become one of the world’s leading trading platforms. Join us as we continue to innovate
                    and empower traders
                    worldwide.</p>
            </div>
        </section>
    </main>
@endsection
@section('scripts')
@endsection
