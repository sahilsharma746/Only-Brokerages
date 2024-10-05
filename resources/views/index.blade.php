@extends('layouts.app')
@section('styles')
@endsection
@section('content')
<main>
        <section class="hero-section-4">
            <div class="container">
                <div class="hero-section-main-area d-flex flex-wrap">
                    <div class="col d-flex flex-column justify-content-center">
                        <h1 class="title">Reach out to new trading <span class="highlight">experience</span></h1>
                        <p class="subtitle">with <span class="highlight">Only brokerage</span> control of your financial
                            future. Our platform is a seamless investing experience, from beginner to
                            pro. Explore a diverse range of investment options, gain valuable insights, and watch your
                            portfolio grow. Join the
                            Only-Brokerage today.
                        </p>
                        <a href="{{route('register')}}" class="btn w-max">Get started</a>
                    </div>
                    <div class="col d-flex">
                        <div class="hero-image-area">
                            <img class="hero-image-1" src="{{ asset('assets') }}/img/hero-section-4-img.png">
                            <img class="hero-image-2" src="{{ asset('assets') }}/img/hero-section-4-img-2.png">
                        </div>
                    </div>
                </div>
            </div>
            <div class="trade-counter w-100">
                <div class="container d-grid">
                    <div class="item">
                        <span value="300" endWith="+">300+</span>
                        <span class="text d-inline-block">CFDS to Trade</span>
                    </div>
                    <div class="item">
                        <span value="800" startWith="1:">1:800</span>
                        <span class="text d-inline-block">Leverage Up To</span>
                    </div>
                    <div class="item">
                        <span value="1000" startWith="$">$1000</span>
                        <span class="text d-inline-block">minimum deposit</span>
                    </div>
                    <div class="item">
                        <span value="0" startWith="$">$0</span>
                        <span class="text d-inline-block">Deposit fees</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="work-policy-2">
            <div class="container">
                <h1 class="title text-center">How it <span class="text-primary">works</span></h1>
                <div class="policy-area d-flex flex-wrap">
                    <div class="col card-group">
                        <div class="card d-flex">
                            <div class="card-header">
                                <span class="card-sn">01</span>
                            </div>
                            <div class="card-body">
                                <div class="card-title">Register and Log In</div>
                                <div class="card-subtitle">Start investing in by first creating your account and log in
                                </div>
                            </div>
                        </div>
                        <div class="card d-flex">
                            <div class="card-header">
                                <span class="card-sn">02</span>
                            </div>
                            <div class="card-body">
                                <div class="card-title">Fund Your Account</div>
                                <div class="card-subtitle">Become an active investor by funding your account with at
                                    little as $50
                                </div>
                            </div>
                        </div>
                        <div class="card d-flex">
                            <div class="card-header">
                                <span class="card-sn">03</span>
                            </div>
                            <div class="card-body">
                                <div class="card-title">Select Assets To Invest In</div>
                                <div class="card-subtitle">Carefully choose the assets and commodities you would like to
                                    trade
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col can-invest-area">
                        <div class="card d-flex flex-column">
                            <div class="card-badge w-max">Who?</div>
                            <div class="card-title">Who Can Invest?</div>
                            <div class="card-text">Individuals (above 18 years), business and cooperation can become
                                investors by filling out the registration and funding
                                their accounts.
                                Explore our platforms vast trading tools and markets to get started.</div>
                            <a href="{{route('register')}}" class="btn w-max">Start Trading Today</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="award-section">
            <div class="container">
                <div class="sliders d-flex flex-wrap justify-content-between align-items-center">
                    <div class="item">
                    <img src="{{ asset('assets') }}/img/awards-2020-investopedia-overall.png" alt="">
                    </div>
                    <div class="item">
                        <img src="{{ asset('assets') }}/img/award-nw-2020-crop.png" alt="">
                    </div>
                    <div class="item">
                        <img src="{{ asset('assets') }}/img/award-benzinga-best-trading-tech-2020.png" alt="">
                    </div>
                    <div class="item">
                        <img src="{{ asset('assets') }}/img/award-barrons-2021-best-online-broker-crop.png" alt="">
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div id="profit-popup" class="popup">
        <button style="visibility: hidden" class="popup-close" onclick="closePopup()">x</button>
        <ul>
            <li id="popup-message">Someone from <span id="popup-country"></span> has withdrawn <span class="amount" id="amount"></span></li>
        </ul>
    </div>

@endsection
@section('scripts')
@endsection