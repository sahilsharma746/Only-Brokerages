@extends('users.layouts.app_user')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets') }}/css/user-dashboard.css">
@endsection
@section('content')
    <article class="tab-content trade-article">
        <section id="market-news-section" class="tab-pane in active market-news-section d-grid">
            <div class="card news-search-card">
                <div class="card-header">
                    <div class="card-indicators scroll">
                        <a href="" class="btn-pill active">Forex</a>
                        <a href="" class="btn-pill">Crypto</a>
                        <a href="" class="btn-pill">Indices</a>
                        <a href="" class="btn-pill">Test</a>
                    </div>
                    <div class="input-group search-input-group">
                        <input id="marketNewsSearch" class="form-control search-input" type="search"
                            placeholder="Search for assets etc..." searchFromObj="['#news-title-area .news-title']">
                        <label for="marketNewsSearch" class="search-icon"><i
                                class="fa-solid fa-magnifying-glass"></i></label>
                    </div>
                </div>
                <div id="news-title-area" class="card-body scroll">
                    <ul class="list-style-none">
                        <li><a href="">
                                <span class="news-title">China Consumer Inflation Rises, Factory-Gate
                                    Prices...</span>
                                <span class="news-time">1d ago</span>
                            </a></li>
                        <li><a href="">
                                <span class="news-title">DIS: Disney Stock Sheds 4.5% Despite...</span>
                                <span class="news-time">15d ago</span>
                            </a></li>
                        <li><a class="active" href="">
                                <span class="news-title">BTC/USD: Bitcoin Rockets 15% as Good Jobs Data...</span>
                                <span class="news-time">15d ago</span>
                            </a></li>
                        <li><a href="">
                                <span class="news-title">SPX: S&P 500 Logs 2.3% for Best Day Since 2022...</span>
                                <span class="news-time">15d ago</span>
                            </a></li>
                        <li><a href="">
                                <span class="news-title">UAA: Under Armour Stock Sprints 19% on...</span>
                                <span class="news-time">19d ago</span>
                            </a></li>
                    </ul>
                </div>
            </div>
            <div class="news-page scroll">
                <div id="trading-news-container" class="trading-news-container">
                    <div class="news-title-img">
                        <img src="{{ asset('assets') }}/img/market-news-bitcoins.png">
                    </div>
                    <div class="news-label-area">
                        <span class="label">Crypto</span>
                        <span class="label">Bitcoin</span>
                        <span class="label">Indices</span>
                    </div>
                    <h1 class="news-title">BTC/USD: Bitcoin Rockets 15% as Good Jobs Data Ignites Post-Selloff
                        Bargain Hunt</h1>
                    <p class="news-post-time">Aug 9, 2024 | 08:57 GMT+1</p>
                    <div class="news-body">
                        <p class="article">
                            Crypto enthusiasts snapped up tokens on discount left and right after jobless claims
                            offered glimmer of hope that the
                            economy may not be that bad.
                        </p>
                        <ul>
                            <li>
                                <p>Bitcoin prices <a href="">BTCUSD</a> shot sharply higher Thursday and remained
                                    well-bid Friday morning after a single report sparked a
                                    broad rally in crypto. Following the <a href="">digital asset carnage</a> from
                                    earlier this week, risk takers rushed to snap up
                                    discounted tokens, sending Bitcoin higher by as much as 15%. The OG token
                                    rallied from a Thursday low of $55,000 a piece
                                    to nearly $63,000. What&#x2019s more, Bitcoin jumped 26% from its weekly low to
                                    its
                                    weekly high.</p>
                            </li>
                            <li>
                                <p>Jobless claims, a proxy for layoffs, showed that 233,000 people filed for
                                    unemployment benefits in the week ended August
                                    3. The figure slipped below expectations for 240,000 and offered a glimmer of
                                    hope that the economy might not be
                                    crumbling (as suggested by the <a href="">July jobs report</a> .) To this end,
                                    risk assets were back on the menu. Cryptocurrencies
                                    enjoyed lots of buying appetite as pent-up demand got unleashed.
                                </p>
                            </li>
                            <li>
                                <p>Ethereum, the second-largest digital coin, also added 15% on Thursday with prices
                                    floating near $2,800 a piece, from
                                    $2,350. Following the <a href="">painful Monday rout</a>, a strong recovery has
                                    buoyed Ether to flaunt gains of about 30% on the week.
                                    The token is seeing increased investor interest now that a total of <a
                                        href="">nine spot Ether exchange-traded funds</a> (ETFs) are
                                    trading side by side with traditional assets.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </article>
@endsection
