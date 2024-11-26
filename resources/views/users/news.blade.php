@extends('users.layouts.app_user')
@section('content')
    <article class="tab-content trade-article main-news-area">
        <section id="market-news-section" class="tab-pane in active market-news-section d-grid">
            <div class="card news-search-card">
                <div class="card-header">
                    <div class="card-indicators scroll">
                        <a href="#" class="btn-pill active news_type" data-type="crypto-news">Crypto</a>
                        <a href="#" class="btn-pill news_type" data-type="forex-news">Forex</a>
                        <a href="#" class="btn-pill news_type" data-type="indices-news">Indices</a>
                        <a href="#" class="btn-pill news_type" data-type="stocks-news">Stocks</a>
                        <a href="#" class="btn-pill news_type" data-type="futures-news">Futures</a>
                    </div>
                </div>
                <div id="news-title-area" class="card-body scroll" style="height: calc(-224px + 110vh); overflow: auto; margin-top: 10px;">
                    <ul class="list-style-none news">
                        @foreach($crypto_feed_data as $news)
                            <li class="feed_selected"
                                data-image="{{ $news['image'] }}"
                                data-title="{{ $news['title'] }}"
                                data-description="{{ $news['description'] }}"
                                data-link="{{ $news['link'] }}">
                                <a class="" >
                                    <span class="news-title">
                                        {{ strlen($news['title']) > 30 ? substr($news['title'], 0, 30) . '...' : $news['title'] }}
                                    </span>
                                    <span class="news-time">{{ $news['pub_date'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="news-page scroll">
                <div id="trading-news-container" class="trading-news-container">
                        <div class="news-title-img" style="text-align: center">
                            <div id="loader-image" style="display: none; justify-content: center; align-items: center; height: 100%;">
                            <img src="{{ asset('assets/img/100x-loader.gif') }}" alt="Loading...">
                            </div>
                            <img id="news-image" style="max-width: 460px;max-height:260px;" alt="News Image" style="display: none;">
                        </div>
                    <h1 class="news-title" id="selected-news-title"></h1>
                    <p class="news-post-time" id="selected-news-time"></p>
                    <div class="news-body" id="selected-news-body"></div>
                    <br>
                    <div class="news-body-footer" id="selected-news-body-footer" style="display: none">Click here to read the full <a target="_blank" href="#"> article </a></div>


                </div>

            </div>
        </section>

    </article>
@endsection
