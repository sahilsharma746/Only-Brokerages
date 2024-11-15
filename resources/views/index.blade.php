@extends('layouts.app')
@section('styles')
@endsection
@section('content')
<main>
    <section class="hero-section-3">
        <div class="container hero-wrap">
          
                <div class="hero-inner d-flex justify-content-between flex-row align-items-center">
                   <div class="hero-inner-left ">
                        <h2>Reach out to new
                            trading <span>experience</span> </h2>
                            <p>with <span>Only brokerage</span>  control of your financial future. Our platform is a seamless investing experience, from beginner to pro. Explore a diverse range of investment options, gain valuable insights, and watch your portfolio grow. Join the Only-Brokerage today.</p>
                            <a href="{{route('register')}}" class="btn btn-started">Get Started</a>
                   </div>
                   <div class="hero-inner-right">
                        <img src="{{ asset('assets') }}/img/heroImg.png"/>
                   </div>
                </div>
   
        </div>
    
        <div class="trade-counter w-100">
            <div class="container d-grid">
                <div class="item">
                    <span  value="300">300+</span>
                    <span class="text d-inline-block">CFDS to Trade</span>
                </div>
                <div class="item">
                    <span value="500" startWith="1:">1:500</span>
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
    <section class="trusted-awards-section d-flex align-items-center">
        <div class="trusted-awards container">
            <div class="award-item">
              <img alt="award" src="{{ asset('assets') }}/img/award.png"/>
              <p class="award-sub">Best CFD Broker</p>
              <p class="award-par">MaskTop Summit 2015</p>
            </div>
            <div class="award-item">
              <img alt="award" src="{{ asset('assets') }}/img/award.png"/>
              <p class="award-sub">Best Execution Broker</p>
              <p class="award-par">Forex EXPO Dubai 2018</p>
            </div>
            <div class="award-item">
              <img alt="award" src="{{ asset('assets') }}/img/award.png"/>
              <p class="award-sub">Best Trading Platform</p>
              <p class="award-par">London Summit 2019</p>
            </div>
            <div class="award-item">
              <img alt="award" src="{{ asset('assets') }}/img/award.png"/>
              <p class="award-sub">Best Broker Asia</p>
              <p class="award-par">iFX EXPO 2023</p>
            </div>
        </div>
    </section>
 
    <section class="leverage">
        
        <div class="leverage-inner container">
            <div class="leverage-imgBox">
                <img alt="building" src="{{ asset('assets') }}/img//building.png"/>
            </div>
            <div class="leverage-textBox">
                <h2>Leverage Technology Built to Help You Get Ahead</h2>
                <ul>
                    <li>
                        <h4>Trading Platforms 
                        </h4>
                        <p>Powerful enough for the professional trader but designed for everyone. Available on desktop, mobile and web.
                        </p>
                    </li>
                    <li>
                        <h4>Order Types and Algos                    </h4>
                        <p>100+ order types - from limit orders to complex algorithmic trading - help you execute any trading stratagy.
                        </p>
                    </li>
                    <li>
                        <h4>Free Trading Tools 
                        </h4>
                        <p>Spot market opportunities, analyze results, manage your account and make better decisions with our free trading tools.
                        </p>
                    </li>
                    <li>
                        <h4>Comprehensive Reporting 
                        </h4>
                        <p>Real-time trade confirmations, margin details, transaction cost analysis, sophisticated portfolio analysis and more.</p>
                    </li>
                </ul>
            </div>
          
        </div>
    </section>
    <section class="spreads">
        <div class="spread-inner container">
          <div class="spread-imgBox">
              <img alt="spread" src="{{ asset('assets') }}/img//spread.png"/>
          </div>
          <div class="spread-textBox">
            <h2>Tight spreads and ultra-fast execution</h2>
            <p class="spreads-text">Best market prices available so you can receive excellent conditions.</p>
            <ul>
              <li>
                <img alt="tick" src="{{ asset('assets') }}/img//tick.png"/>
                <p>Low commissions starting as low as $10 with no added spreads, ticket charges, platform fees or account minumum</p>
              </li>
              <li>
                <img alt="tick" src="{{ asset('assets') }}/img//tick.png"/>
                <p>Financing rates up to 50%  lower than the industry</p>
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
        <a href="{{ route('register') }}">  <button class="btn">Start Trading Today</button></a>  
          </div>
        </div>
      </section>
    <section class="trusted">
       
        <button class="btn-regulated">Fully Regulated</button>
        <div class="trusted-inner container">
            <div class="trusted-imgBox">
              <img alt="trusted" src="{{ asset('assets') }}/img/vault.jpg"/>
            </div>
            <div class="trusted-textBox">
              <h2 class="trusted-title">Trusted For Over <span>25+ Years</span> </h2>
              <p class="trusted-text">when placing your money with a broker, you need to make sure your broker is secure and can endure through good and bad times. Our strong capital position, conservative balance sheet and automated risk controls are designed to protect Only-Brokerage and our clients from trading losses.</p>
         
              <div class="trade-counter  trusted-innerBox">
                
                    <div class="item trusted-item">
                        <span class="trusted-sub" endWith="%" value="84.9"> 84.9%</span>
                        <span class="trusted-par" >Privately Held</span>
                    </div>
                    <div class="item trusted-item">
                        <span class="trusted-sub" startWith="$" endWith="B" value="7.4" >$7.4B</span>
                        <span class="trusted-par" >Equity Capital </span>
                    </div>
                    <div class="item trusted-item">
                        <span class="trusted-sub" value="4.25" startWith="$" endWith="M">4.25M</span>
                        <span class="trusted-par" >Daily Average Revenue Trades</span>
                    </div>
                    <div class="item trusted-item">
                        <span class="trusted-sub" value="4.6" endWith="B" startWith="$">$4.6B</span>
                        <span class="trusted-par" >Excess Regulatory Capital</span>
                    </div>
             
            </div>
            </div>
        </div>
       
      </section>



 <section class="choose">
          <div class="choose-inner container">
              <div class="choose-left">
                <h2>Why <span>Choose </span> Us</h2>
                <p>Experience the difference. Discover a trading platform that empowers you to make informed decisions and achieve your financial goals.</p>
                <a href="{{ route('register') }}"><button class="btn">Get Started</button></a>
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
               
                <div class="trading-inner">
                  <div class="trading-item trading-item-active">
                    <div>1</div>
                    <h4>Create Your Account</h4>
                    <p>Sign up in minutes. Simply provide your basic information and verify your email and choose an account plan. Start your investment journey today.</p>
                  <a href="{{ route('register') }}">  <button class="btn">Create Account</button></a>
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
                <a href="{{ route('frontend.accountPlan') }}" style="color: #FFFFFF; display: block; text-align: center; width: 100%;padding-top: 30px">
                    <button style="background-color: rgb(58, 163, 26); color: #FFFFFF; border: none; padding: 15px 20px; font-size: 16px; cursor: pointer; border-radius: 5px; text-align: center;">
                        View More Plans
                    </button>
                </a>
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
                    <span>How does  Only-Brokerage work?</span>
                    <a class="btn-collapse"><i class="fa-solid fa-plus"></i></a>
                </div>
                <div class="card-body">
                     Only-Brokerage simplifies your entry into the financial markets by providing a platform
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
                    No problem!  Only-Brokerage is beginner-friendly. We have tons of helpful tutorials and
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
                    <span>What trading tools are available on  Only-Brokerage?</span>
                    <a class="btn-collapse"><i class="fa-solid fa-plus"></i></a>
                </div>
                <div class="card-body"> Only-Brokerage provides a wide range of tools to enhance your trading
                    experience, including advanced charting
                    software, real-time market data, technical indicators, and customizable alerts. These tools
                    are designed to help you
                    make informed decisions and maximize your trading potential.</div>
            </div>
            <div class="card mx-auto">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>What account plans does  Only-Brokerage offer?</span>
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