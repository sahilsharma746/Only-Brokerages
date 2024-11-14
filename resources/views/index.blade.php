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


        <section class="trusted">
            <div class="trusted-awards container">
                <div class="award-item">
                  <img alt="award" src="{{ asset('assets') }}/img/award.png"/>
                  <p class="award-sub">Best CFD Broker</p>
                  <p class="award-par">TradeON Summit 2023</p>
                </div>
                <div class="award-item">
                  <img alt="award" src="{{ asset('assets') }}/img/award.png"/>
                  <p class="award-sub">Best Execution Broker</p>
                  <p class="award-par">Forex EXPO Dubai 2021</p>
                </div>
                <div class="award-item">
                  <img alt="award" src="{{ asset('assets') }}/img/award.png"/>
                  <p class="award-sub">Best Trading Platform</p>
                  <p class="award-par">London Summit 2019</p>
                </div>
                <div class="award-item">
                  <img alt="award" src="{{ asset('assets') }}/img/award.png"/>
                  <p class="award-sub">Best Broker Asia</p>
                  <p class="award-par">iFX EXPO 2015</p>
                </div>
            </div>
            <button class="btn-regulated">Fully Regulated</button>
            <div class="trusted-inner container">
                <div class="trusted-imgBox">
                  <img alt="trusted" src="{{ asset('assets') }}/img/vault.jpg"/>
                </div>
                <div class="trusted-textBox">
                  <h2 class="trusted-title">Trusted For Over <span>25+ Years</span> </h2>
                  <p class="trusted-text">when placing your money with a broker, you need to make sure your broker is secure and can endure through good and bad times. Our strong capital position, conservative balance sheet and automated risk controls are designed to protect only] Brokerage and our clients from trading losses.</p>
    
                  <div class="trade-counter  trusted-innerBox">
    
                        <div class="item trusted-item">
                            <span class="trusted-sub" endWith="%" value="79.4"> 79.4%</span>
                            <span class="trusted-par" >Privately Held</span>
                        </div>
                        <div class="item trusted-item">
                            <span class="trusted-sub" startWith="$" endWith="B" value="8.7" >$8.7B</span>
                            <span class="trusted-par" >Equity Capital </span>
                        </div>
                        <div class="item trusted-item">
                            <span class="trusted-sub" value="3.45" startWith="$" endWith="M">3.45M</span>
                            <span class="trusted-par" >Daily Average Revenue Trades</span>
                        </div>
                        <div class="item trusted-item">
                            <span class="trusted-sub" value="5.8" endWith="B" startWith="$">$5.8B</span>
                            <span class="trusted-par" >Excess Regulatory Capital</span>
                        </div>
    
                </div>
                </div>
            </div>
          </section>
    
          <section class="spreads">
            <div class="spread-inner container">
              <div class="spread-imgBox">
                  <img alt="spread" src="{{ asset('assets') }}/img//spread.png"/>
              </div>
              <div class="spread-textBox">
                <h2>Tight spreads and ultra-fast execution</h2>
                <p class="spreads-text">Best market prices available so you can receive excellent conditions.</p>
                <ul>
                  <li>
                    <img alt="tick" src="{{ asset('assets') }}/img//tick.png"/>
                    <p>Low commissions starting as low as $10 with no added spreads, ticket charges, platform fees or account minumum</p>
                  </li>
                  <li>
                    <img alt="tick" src="{{ asset('assets') }}/img//tick.png"/>
                    <p>Financing rates up to <span>50%</span>  lower than the industry</p>
                  </li>
                  <li>
                    <img alt="tick" src="{{ asset('assets') }}/img//tick.png"/>
                    <p>Earn extra income on your lendable shares</p>
                  </li>
                  <li>
                    <img alt="t
    
    oygul, [12 Nov 2024 at 16:56:17]:
    ick" src="{{ asset('assets') }}/img//tick.png"/>
                    <p>Negative balance protection</p>
                  </li>
                </ul>
                <button class="btn"><a href="{{ route('register') }}" style="color: #FFFFFF">Start Trading Today</a></button>
              </div>
            </div>
          </section>
        </section>
        <section class="leverage">
            <div class="leverage-inner container">
                <div class="leverage-imgBox">
                    <img alt="building" src="{{ asset('assets') }}/img/building.png"/>
                </div>
                <div class="leverage-textBox">
                    <h2>Leverage Technology Built to Help You Get Ahead</h2>
                    <ul>
                        <li>
                            <h4>Trading Platforms >
                            </h4>
                            <p>Powerful enough for the professional trader but designed for everyone. Available on desktop, mobile and web.
                            </p>
                        </li>
                        <li>
                            <h4>Order Types and Algos > </h4>
                            <p>100+ order types - from limit orders to complex algorithmic trading - help you execute any trading stratagy.
                            </p>
                        </li>
                        <li>
                            <h4>Free Trading Tools >
                            </h4>
                            <p>Spot market opportunities, analyze results, manage your account and make better decisions with our free trading tools.
                            </p>
                        </li>
                        <li>
                            <h4>Comprehensive Reporting >
                            </h4>
                            <p>Real-time trade confirmations, margin details, transaction cost analysis, sophisticated portfolio analysis and more.</p>
                        </li>
                    </ul>
                </div>
    
            </div>
        </section>
    
    
     <section class="choose">
        <div class="choose-inner container">
            <div class="choose-left">
              <h2>Why <span>Choose </span> Us</h2>
              <p>Experience the difference. Discover a trading platform that empowers you to make informed decisions and achieve your financial goals.</p>
              <a href="{{ route('register') }}" style="color: #FFFFFF"><button class="btn">Get Started</button></a>
                      <img alt="choose" src="{{ asset('assets') }}/img/choose.png"/>
            </div>
            <div class="choose-right">
                <div class="choose-item">
                  <div>
                    <img alt="net" src="{{ asset('assets') }}/img/net.png"/>
                  </div>
                  <p class="choose-sub">High Efficiency Platform</p>
                  <p class="choose-par">We have a client first approach. We are committed to giving you one of the the best trading experiences at the tip of your fingers.</p>
                </div>
                <div class="choose-item">
                  <div>
                    <img alt="net" src="{{ asset('assets') }}/img/rocket.png"/>
                  </div>
                  <p class="choose-sub">Trading Instruments</p>
                  <p class="choose-par">Access a variety of trading instruments through one trading platforms. Ours.</p>
                </div>
                <div class="choose-item">
                  <div>
                    <img alt="net" src="{{ asset('assets') }}/img/mingcute_safe-lock-fill.png"/>
                  </div>
                  <p class="choose-sub">Safe And Secure</p>
                  <p class="choose-par">Client fund is kept in segregated accounts and separate from broker funds. We also have safety measures is place for all traders.</p>
                </div>
                <div class="choose-item">
                  <div>
                    <img alt="net" src="{{ asset('assets') }}/img/support.png"/>
                  </div>
                  <p class="choose-sub">Dedicated Customer Support</p>
                  <p class="choose-par">Receive expert assistance from our dedicated support team. Get timely solutions to your questions and concerns.</p>
                </div>
            </div>
        </div>
    
    
      </section>
      <section class="features-main">
          <div class="features container">
              <div class="feature-textBox">
                  <h2 class="features-title">Key Features</h2>
                  <p class="features-text">Experience the difference. Discover a trading platform that empowers you to make informed decisions and achieve your financial goals.</p>
              </div>
              <div class="feature-inner">
                <div class="feature-item">
                  <img src="{{ asset('assets') }}/img/Frame 1171278429.png" alt="feature"/>
                  <h4>Portfolio Management Tools</h4>
                  <p>Track, analyze, and optimize your investment portfolio. Make data-driven decisions to achieve your financial goals.</p>
                </div>
                <div class="feature-item">
                  <img src="{{ asset('assets') }}/img/Frame 1171278429 (1).png" alt="feature"/>
                  <h4>Advanced Charting</h4>
                  <p>Identify trends, patterns, and potential trading opportunities and powerful charting tools for technical analysis.</p>
                </div>
                <div class="feature-item">
                  <img src="{{ asset('assets') }}/img//Frame 1171278429 (2).png" alt="feature"/>
                  <h4>Real Time Market Data</h4>
                  <p>Real-time trade confirmations, margin details, transaction cost analysis, sophisticated portfolio analysis and more. </p>
                </div>
                <div class="feature-item">
                  <img src="{{ asset('assets') }}/img/Frame 1171278429 (3).png" alt="feature"/>
                  <h4>Secure Trading Environment</h4>
                  <p>Protect your investments with our robust security measures, including encryption and two-factor authentication.</p>
                </div>
              </div>
          </div>
      </section>
      <section>
          <div class="trading container">
              <h2>Simplified Trading with <span>only Brokerage</span>  </h2>
              <div class="trading-inner">
                <div class="trading-item trading-item-active">
                  <div>1</div>
                  <h4>Create Your Account</h4>
                  <p>Sign up in minutes. Simply provide your basic information and verify your email and choose an account plan. Start your investment journey today.</p>
                <a style="color:rgb(58, 163, 26);" href="{{ route('register') }}">  <button class="btn">Create Account</button></a>
                </div>
                <div class="trading-item">
                  <div>2</div>
                  <h4>Fund Your Wallet</h4>
                  <p>Deposit funds securely. Choose from a variety of convenient payment methods. Get ready to trade.</p>
                </div>
                <div class="trading-item">
                  <div>3</div>
                  <h4>Execute Trades</h4>
                  <p>Use our powerful search function to find stocks, cryptocurrencies, and more. Select your preferred order type and execute your trade.</p>
                </div>
              </div>
            </div>
      </section>
    
    <section class="accaount">
        <div class="container">
            <h2>Choose The Best Account For You</h2>
            <p>Tailor Your Trading Experience. Choose the account that best suits your investment goals and risk tolerance.</p>
            <ul>
              @foreach ($plans as $plan_id => $features)
                @php
                    $planName = $features->first()->name;
                    $planPrice = $features->first()->price;
                @endphp
    
                <li>
                   <button class="accaount-basic">{{ $planName }}</button>
                   <h4>${{ number_format($planPrice, 0) }}</h4>
                   <div class="tickLists">
                    @foreach ($features as $feature)
    
                    <div class="tickItem">
                        <img alt="tick" src="{{ asset('assets/img/tick.png') }}"/>
                        <p>{!! $feature->feature_description !!}</p>
                    </div>
                    @endforeach
                   </div>
                   <a style="color:#FFFFFF;" href="{{ route('register', ['plan_type' => $plan_id]) }}"><button class="accaount-open">Open Account </button></a>
                </li>
              @endforeach
            </ul>
          </div>
    
    </section>
    
    <section class="faq-section">
        <div class="container">
            <h1 class="section-title text-center">
                Frequent Asked Questions
            </h1>
    
            <div class="card-collapsible-group">
                <div class="card mx-auto">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>How does  only brokerage work?</span>
                        <a class="btn-collapse"><i class="fa-solid fa-plus"></i></a>
                    </div>
                    <div class="card-body">
                         only brokerage simplifies your entry into the financial markets by providing a platform
                        where you can trade a variety
                        of assets, including stocks, cryptocurrencies, and forex. We offer tools that help you make
                        informed decisions, whether
                        you're just starting or have been trading for years.
                    </div>
                </div>
                <div class="card mx-auto">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>What if I am a beginner in trading?</span>
                        <a class="btn-collapse"><i class="fa-solid fa-plus"></i></a>
                    </div>
                    <div class="card-body">
                        No problem!  only brokerage is beginner-friendly. We have tons of helpful tutorials and
                        articles to get you started.
                    </div>
                </div>
                <div class="card mx-auto">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>What is the minimum deposit amount?</span>
                        <a class="btn-collapse"><i class="fa-solid fa-plus"></i></a>
                    </div>
                    <div class="card-body">
                        You can start trading with a minimum deposit of $1000. This is to ensure you have enough
                        capital to make meaningful
                        trades and take full advantage of our platform’s features.
                    </div>
                </div>
                <div class="card mx-auto">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Can I start trading with just $250?</span>
                        <a class="btn-collapse"><i class="fa-solid fa-plus"></i></a>
                    </div>
                    <div class="card-body">No. Our minimum deposit is $1000 so as to allow you explore different
                        markets and strategies on our platform without
                        committing too much capital.</div>
                </div>
                <div class="card mx-auto">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>What trading tools are available on  only brokerage?</span>
                        <a class="btn-collapse"><i class="fa-solid fa-plus"></i></a>
                    </div>
                    <div class="card-body"> only brokerage provides a wide range of tools to enhance your trading
                        experience, including advanced charting
                        software, real-time market data, technical indicators, and customizable alerts. These tools
                        are designed to help you
                        make informed decisions and maximize your trading potential.</div>
                </div>
                <div class="card mx-auto">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>What account plans does  only brokerage offer?</span>
                        <a class="btn-collapse"><i class="fa-solid fa-plus"></i></a>
                    </div>
                    <div class="card-body">We offer several account plans tailored to different trading needs and
                        experience levels. Whether you’re a beginner,
                        intermediate, or advanced trader, there’s an account plan for you. Each plan includes
                        varying levels of access to
                        trading tools, educational resources, and customer support, so you can choose the one that
                        best suits your goals</div>
                </div>
            </div>
        </div>
    </section>

        {{-- <section class="work-policy-2">
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
        </section> --}}
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