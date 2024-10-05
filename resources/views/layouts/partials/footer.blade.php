<footer>
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-start r-g-10">
            <div class="logo-area d-flex align-items-center g-4">
                <img src="{{ asset('assets/img/site-logo-footer.png') }}" alt="Site Logo" class="site-logo">
                <span class="site-name">Krust-Markets</span>
            </div>
            <div class="subscribe-area">
                <p class="text">Subscribe To Our Newsletter</p>
                <div class="input-area d-flex g-8">
                    <div class="input-group">
                        <input class="form-control" type="email" name="email" id="subscribeEmail"
                            placeholder="Enter email here">
                    </div>
                    <a href="" class="btn">Subscribe</a>
                </div>
            </div>
        </div>
        <div class="footer-nav d-flex flex-wrap justify-content-between r-g-15">
            <dl>
                <dt><a href="javascript:void(0)">Company</a></dt>
                <dt><a href="{{ route('frontend.about') }}">Who We are</a></dt>
                <dt><a href="{{ route('frontend.contact') }}">Contact Us</a></dt>
                <dt><a href="javascript:void(0)">Legal Documentation</a></dt>
            </dl>
            <dl>
                <dt><a href="">Product</a></dt>
                <dt><a href="{{ route('frontend.accountPlan') }}">Account Plans</a></dt>            </dl>
            <dl>
                <dt class="text-end"><a href="{{ route('register') }}">Get started</a></dt>
                <dt class="text-end"><a href="{{ route('login') }}">Log in</a></dt>
                <dt class="text-end"><a href="{{ route('register') }}">sign up</a></dt>
            </dl>
        </div>
        <p class="footer-text text-center">&copy; 2024 Trust Investments. All Rights Reserved.</p>
    </div>
</footer>

