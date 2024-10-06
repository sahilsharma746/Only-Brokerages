@extends('users.layouts.app_user')
@section('content')
    <article class="tab-content trade-article" style="overflow: auto">
            <section id="trade-and-market-common-grid" class="trade-and-market-common-grid d-grid">
                <div class="card trade-and-market-common-card">
                    <div class="card-header">
                    <a href="{{ route('user.trade.index') }}" class="btn-tab">Tradable Assets</a>
                    <a href="{{ route('user.marketWatch.index') }}" class="btn-tab active">Market Watch</a>
                    </div>
                    <div class="card-body">
                        <div class="trade-and-market-common-table-area" id="market-watch-common-table-area">
                          <div class="input-group search-input-group">
                            <input id="searchTableAssetsMarketWatch" class="form-control search-input" type="search" placeholder="Search for assets etc...">
                            <label for="searchTableAssetsMarketWatch" class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></label>
                          </div>
                        </div>
                        <div class="market-watch-table-indicators scroll">
                          <a href="#user-market-watch-table-crypto" class="btn trade-type-market-watch active" data-type="crypto">
                            <span>Crypto</span>
                            <span class="icon"><i class="fa-solid fa-arrow-right-long"></i></span>
                          </a>
                          <a href="#user-market-watch-table-forex" class="btn trade-type-market-watch" data-type="forex">
                            <span>Forex</span>
                            <span class="icon"><i class="fa-solid fa-arrow-right-long"></i></span>
                          </a>
                          {{--  <a href="#user-market-watch-table-indices" class="btn" data-type="indices">
                            <span>Indices</span>
                            <span class="icon"><i class="fa-solid fa-arrow-right-long"></i></span>
                          </a>
                          <a href="#user-market-watch-table-futures" class="btn" data-type="futures">
                            <span>Futures</span>
                            <span class="icon"><i class="fa-solid fa-arrow-right-long"></i></span>
                          </a> --}}
                        </div>
                      </div>
                      
                </div>

                <div id="user-market-watch-area" class="user-market-watch-area w-100" style="max-height: fit-content;">
                    <div class="user-market-watch-table-area table-area scroll w-100" style="max-height: fit-content;">
                        <table class="user-market-watch-table w-100">
                            <thead>
                                <tr>
                                    <th>Asset</th>
                                    <th>Market Cap</th>
                                    <th>Price</th>
                                    <th>Traded Volume</th>
                                    <th>Available Volume</th>
                                    <th>Change</th>
                                </tr>
                            </thead>
                            <tbody id="user-market-watch-table-data">
                                <!-- load data through jquery -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </article>
@endsection
