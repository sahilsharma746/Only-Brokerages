@extends('users.layouts.app_user')
@section('content')
    <article class="tab-content trade-article">
        <section id="market-news-section" class="tab-pane in active market-news-section d-grid">
            <div class="card news-search-card">
                <div class="card-header">
                    <div class="card-indicators scroll">
                        <a href="#" class="btn-pill active news_type" data-type="crypto-news">Crypto</a>
                        <a href="#" class="btn-pill news_type" data-type="forex-news">Forex</a>
                        <a href="#" class="btn-pill news_type" data-type="indices-news">Indices</a>
                    </div>
                    <div class="input-group search-input-group">
                        <input id="marketNewsSearch" class="form-control search-input" type="search"
                            placeholder="Search for assets etc..." searchFromObj="['#news-title-area .news-title']">
                        <label for="marketNewsSearch" class="search-icon"><i
                                class="fa-solid fa-magnifying-glass"></i></label>
                    </div>
                </div>
                <div id="news-title-area" class="card-body scroll">
                    <ul class="list-style-none crypto-news">
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
                    <ul class="list-style-none forex-news" style="display: none">
                        @foreach($forex_feed_data as $news)
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
                    <ul class="list-style-none indices-news" style="display:none;">
                        @foreach($indices_feed_data as $news)
                            <li class="feed_selected" 
                                data-image="{{ $news['image'] }}" 
                                data-title="{{ $news['title'] }}" 
                                data-description="{{ $news['description'] }}"
                                data-link="{{ $news['link'] }}">
                                <a class="">
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
                        <img id="news-image" style="max-width: -webkit-fill-available;max-height: -webkit-fill-available;" src="{{ asset('assets') }}/img/market-news-bitcoins.png" alt="News Image" style="display: none;">
                    </div>
                    <h1 class="news-title" id="selected-news-title"></h1>
                    <p class="news-post-time" id="selected-news-time"></p>
                    <div class="news-body" id="selected-news-body"></div>
                    <br>
                    <div class="news-body-footer" id="selected-news-body-footer">Click here to read the full <a target="_blank" href="#"> artical </a></div>
                </div>
            </div>
        </section>
    </article>
@endsection
