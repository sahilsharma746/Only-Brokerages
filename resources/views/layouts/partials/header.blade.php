<header>
    <div class="marquee">
        <ul class="marquee-content list-style-none" id="site-main-nav">
            <li style="visibility: hidden;"> 
                <div class="price-card d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center g-10">
                        <div class="country-name d-flex align-items-center g-8">
                            <img src="{{ asset('assets') }}/img/country-eur.png" alt="country flag" class="flag">
                            <span>eurusd</span>
                        </div>
                        <div class="price">481.3</div>
                    </div>
                    <div class="percentage-area d-flex align-items-center g-8">
                        <i class="fa-solid fa-chevron-up"></i>
                        <span class="percentage">3.68%</span>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="main-header">
        <div class="container d-flex flex-wrap justify-content-between align-items-center g-10">
            <a href="{{ route('frontend.index') }}" class="logo-area d-flex align-items-center g-4">
                <img src="{{ asset('assets') }}/img/site-logo-footer-only-brokerage.png" alt="Site Logo" class="site-logo" alt="Site Logo" class="site-logo">
            </a>
            <a id="btn-nav-toggle" class="btn-nav-toggle">
                <i class="fa-solid fa-bars"></i>
            </a>
            <div class="header-btns d-flex flex-wrap g-8">
                <a class="btn btn-login" href="{{ route('login') }}">Log in</a>
                <a class="btn btn-started" href="{{ route('register') }}">Get Started</a>
            </div>
        </div>
    </div>
    <div class="navigation-area">
        <div class="container d-flex flex-wrap justify-content-between align-items-center g-10">
            <nav class="nav nav-main">
                <dl class="d-flex flex-wrap g-20">
                    <dt><a href="{{ route('frontend.index') }}" class="{{ Request::url() == route('frontend.index') ? 'active' : '' }}">Home</a></dt>
                    <dt><a href="{{ route('frontend.about') }}" class="{{ Request::url() == route('frontend.about') ? 'active' : '' }}">About Us</a></dt>
                    <dt><a href="{{ route('frontend.accountPlan') }}" class="{{ Request::url() == route('frontend.accountPlan') ? 'active' : '' }}">Account Plans</a></dt>
                    <dt><a href="{{ route('frontend.faq') }}"  class="{{ Request::url() == route('frontend.faq') ? 'active' : '' }}">FAQs</a></dt>
                    <dt class="dropdown">
                        <a> <span>Legal Documentation</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </a>

                        <dl class="dropdown-menu d-flex flex-column r-g-15">
                            <dt class="dropdown-item"><a href="javascript:void(0)">Sec regulations</a></dt>
                            <dt class="dropdown-item"><a href="javascript:void(0)">Security Investors protections</a></dt>
                            <dt class="dropdown-item"><a href="javascript:void(0)">Corporation SIPC</a></dt>
                        </dl>
                    </dt>
                    <dt class="header-btns g-8">
                        <a class="btn btn-login" href="{{ route('login') }}">Log in</a>
                        <a class="btn btn-started" href="{{ route('register') }}">Get Started</a>
                    </dt>
                </dl>
            </nav>
            <div class="contact-details d-flex g-20">
                <p>Opening Hours Mon - Fri: 8AM to 6PM</p>
                <a target="_blank" href="tel:{{ config('settingkeys.phone_number') }}">
                    <i class="fa-solid fa-phone-volume"></i>
                    <span>+1(213)293-2886</span>
                </a>
                <a target="_blank" href="mailto:{{ config('settingkeys.support_email') }}">       
                    <i class="fa-regular fa-envelope"></i>
                    <span>Email</span>
                </a>
            </div>
        </div>
    </div>
</header>