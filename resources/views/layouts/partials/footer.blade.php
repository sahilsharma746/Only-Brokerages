<footer>
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-start r-g-10">
            <div class="logo-area d-flex align-items-center g-4">
                <img src="{{ asset('assets/img/site-logo-footer-only-brokerage.png') }}" alt="Site Logo" class="site-logo">
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
                <dt><a href="javascript:void(0)">Legal Documentations</a></dt>
            </dl>
            <dl>
                <dt><a href="javascript:void(0)">MARKETS</a></dt>
                <dt><a href="javascript:void(0)">Forex</a></dt>
                <dt><a href="javascript:void(0)">Share CFDs</a></dt>
                <dt><a href="javascript:void(0)">Indices</a></dt>
                <dt><a href="javascript:void(0)">Commodities</a></dt>
                <dt><a href="javascript:void(0)">Crypto Currency</a></dt>
            <dl>
            <dl>
                <dt class="text-end"><a href="{{ route('register') }}">Get started</a></dt>
                <dt class="text-end"><a href="{{ route('login') }}">Log in</a></dt>
                <dt class="text-end"><a href="{{ route('register') }}">sign up</a></dt>
            </dl>
        </div>
        <p class="footer-text text-center">&copy; 2024 Only-brokerage. All Rights Reserved.</p>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <h3>RISK WARNING:</h3>
            <p>Trading derivatives and leveraged products carries a high risk, including the potential to lose more than your initial investment. Such trading may not be suitable for everyone. Before making any financial decisions, </p>
            <p>Please review our Product Disclosure Statement (PDS), Risk Disclosure Notice, and Financial Services Guide (FSG) on our website, and seek independent financial advice if necessary.</p>
            <p>CFDs and financial spread trading are complex instruments that involve leverage, which can lead to rapid losses. Currently, 83.5% of retail investor accounts lose money trading CFDs with this provider. Before engaging in spread trading, carefully consider if you fully understand these instruments and are prepared to accept the high risk of loss. Note that CFDs do not grant ownership or interest in the underlying asset.</p>
            <p>Please be aware that the content on this website is for informational purposes only and is not tailored to your individual financial objectives, situation, or needs. Consider this information in light of your personal circumstances.</p>
            <p>Additionally, the value of shares, ETFs, and ETCs purchased through an IG share trading account can fluctuate, potentially resulting in returns lower than your initial investment. Past performance does not guarantee future outcomes.</p>
            <p>This website is operated by IG USA Inc., located at Level 20, Madison & Fifth, 1234 Fifth Avenue, New York, NY 10010. EIN 12-3456789, U.S. Financial Services License No. 876543. Derivatives Issuer License in Canada Reg. No. 123456, CANBN 123456789.
            </p>
            <p>Please ensure you fully understand the risks and manage your exposure responsibly.</p>
        </div>
    </div>
</footer>

