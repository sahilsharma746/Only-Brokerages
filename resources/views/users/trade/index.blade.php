@extends('users.layouts.app_user')
@section('content')
    <article class="tab-content trade-article">
        <section id="trade-and-market-common-grid" class="trade-and-market-common-grid d-grid">
            <div class="card trade-and-market-common-card">
                <div class="card-header">
                    <a href="{{ route('user.trade.index') }}" class="btn-tab active">Tradable Assets</a>
                    <a href="{{ route('user.marketWatch.index') }}" class="btn-tab ">Market Watch</a>
                </div>
                <div class="card-body">
                    <div class="card-indicators scroll">
                        <a data-type="crypto" class="btn-pill trade-type active btn-crypto">Crypto</a>
                        <a data-type="forex" class="btn-pill trade-type btn-forex ">Forex</a>
                        <!-- <a data-type="indices" class="btn-pill trade-type btn-indices">Indices</a> -->
                    </div>
                    <div class="trade-and-market-common-table-area">
                        <div class="input-group search-input-group">
                            <input id="searchTableAssets" class="form-control search-input" type="search"
                                placeholder="Search for assets etc...">
                            <label for="searchTableAssets" class="search-icon"><i
                                    class="fa-solid fa-magnifying-glass"></i></label>
                        </div>
                        <dl id="trade-and-market-common-table" class="trade-and-market-common-table scroll">
                        </dl>
                    </div>
                </div>
            </div>

            <div id="user-trade-chart-area" class="user-trade-chart-area d-grid scroll">
                <div class="market-watch-chart-parent">
                    <div id="market-watch-chart" class="market-watch-chart">
                    </div>
                </div>
                <form id="tradeForm" action="{{ route('user.trade.store') }}" method="POST" class="user-trade-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="user-trade-chart-filter scroll">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="d-flex g-8 selected-asset">
                                    <img src="" alt="country flag" class="flag_image" name="trade_image"
                                        style="width: 30px; height:30px; border-radius: 50%;">
                                    <div class="d-grid">
                                        <span class="name"></span>
                                        <span class="details fullname"></span>
                                        <input type="hidden" class="name_input" name="name" value="">
                                        <input type="hidden" name="price" value="" class="asset-unitprice">
                                        <input type="hidden" name="image" value="" class="image">
                                    </div>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </div>
                            </div>
                            <div class="card-body d-grid g-10">
                                <div class="input-group">
                                    <label class="form-label">Margin</label>
                                    <select class="form-control small asset-margin" id="marketViewChartFrame"
                                        name="margin">
                                        <option value="1">1x</option>
                                        <option value="2">2x</option>
                                        <option value="5">5x</option>
                                        <option value="10">10x</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label class="form-label">Units</label>
                                    <input class="form-control asset-unit-price" readonly type="text" name="units">
                                </div>
                                <div class="input-group">
                                    <label class="form-label">Amount</label>
                                    <input class="form-control asset-trade-amount" type="number" min="0"
                                        name="amount" placeholder="Enter Amount">
                                    @if ($errors->has('amount'))
                                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <label class="form-label">Time Frame</label>
                                    <select class="form-control small" id="marketViewChartTimeFrame" name="time_frame">
                                        <option value="0">Select Time Frame</option>
                                        <option value="5minutes">5 Minutes</option>
                                        <option value="30minutes">30 Minutes</option>
                                        <option value="1hour">1 Hour</option>
                                        <option value="4hours">4 Hours</option>
                                        <option value="1day">1 day</option>
                                        <option value="1week">1 Week</option>
                                        <option value="1month">1 Month</option>
                                        <option value="1year">1 Year</option>
                                    </select>
                                    @if ($errors->has('time_frame'))
                                        <span class="text-danger">{{ $errors->first('time_frame') }}</span>
                                    @endif
                                </div>
                                <table class="user-trade-short-history w-100">
                                    <tbody>
                                        <tr>
                                            <td>Contract Size</td>
                                            <td>-</td>
                                            <td class="text-end">$<span class="asset-contract-size">0</span></td>
                                            <input type="hidden" name="contract_size" value=""
                                                class="asset-contract-size">
                                        </tr>
                                        <tr>
                                            <td>Volatility</td>
                                            <td>-</td>
                                            <td class="text-end">High</td>
                                        </tr>
                                        <tr>
                                            <td>Fees</td>
                                            <td>-</td>
                                            <td class="text-end">$0</td>
                                            <input type="hidden" name="fees" value="0">
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="btn-area d-flex g-10">
                                    <button type="submit" class="btn d-grid btn-buy" name="action" value="bullish">
                                        <span class="name">Buy</span>
                                        <span class="buy_price" value=""></span>
                                    </button>
                                    <button type="submit" class="btn d-grid btn-sell" name="action" value="bearish">
                                        <span class="name">Sell</span>
                                        <span class="sell_price" value=""></span>
                                    </button>
                                </div>

                                <div class="payout-area d-grid">
                                    <input type="hidden" name="payout" value="" class="payout">
                                    <span>Your Payout</span>
                                    <span class="text-center">=</span>
                                    <span class="text-end text-primary">$<b><span class="asset-payout">0</span></b></span>
                                    <input type="hidden" value="{{ $user_balance }}" class="asset-user_balance"
                                        name="user_balance">
                                    <input type="hidden" value="{{ $user_trade_percentage }}"
                                        class="asset-trade_result_percentage" name="trade_result_percentage">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div id="insufficientBalanceModal" class="modal custom-modal">
                    <div class="modal-dialog d-flex flex-column justify-content-center align-items-center">
                        <div class="modal-body text-center">
                            <h3 class="modal-title">Insufficient Balance</h3>
                            <p class="modal-title">Your balance is not sufficient to proceed with this trade.</p>
                            <p class="modal-text">Please ensure that you have enough funds in your account to complete this
                                transaction.
                                You can add funds to your account through the available deposit methods.</p>
                            <div class="modal-footer">
                                <a class="btn btn-modal-close btn-add-asset close-button">Close</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="trade-details-summery">
                    <div class="card">
                        <div class="card-header d-flex g-25">
                            <a class="active" data-toggle="tab" href="#trade-details-summery-current">Current
                                Trade</a>
                            <a href="{{ route('users.trading-history.index') }}">Trade History</a>
                        </div>
                        <div class="card-body scroll">
                            <table id="trade-details-summery-current">
                                <thead>
                                    <tr>
                                        <th>ASSETS</th>
                                        <th>MARGIN</th>
                                        <th>SIZE</th>
                                        <th>CAPITAL</th>
                                        <th>TRADE TYPE</th>
                                        <th>ENTRY</th>
                                        <th>PNL</th>
                                        <th>DATE CREATED</th>
                                        <th>TIME FRAME</th>
                                        <th>ORDER TYPE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trades as $trade)
                                        <tr data-id="{{ $trade->id }}" class="trade_{{ $trade->id }}">
                                            <td class="d-flex align-items-center g-8">
                                                <img src="{{ $trade->image ?: asset('assets/img/crypto.jpeg') }}"
                                                    alt="{{ $trade->asset }}" style="width: 20px; height: 20px;">
                                                {{ $trade->asset }}
                                            </td>

                                            <td>{{ $trade->margin }}x</td>
                                            <td style="color:  #F8E40F;">${{ $trade->contract_size }}</td>
                                            <td>${{ $trade->capital }}</td>
                                            <td
                                                style="color: {{ $trade->trade_type == 'live' ? '#FF683E' : 'inherit' }};">
                                                {{ $trade->trade_type }}</td>
                                            <td>${{ $trade->entry }}</td>
                                            <td>
                                                <span class="trade_pnl_value" style="font-weight: bolder"><span
                                                        class="sign"></span><span class="amount">0</span></span>
                                                <input type="hidden" class="pnl_value" value="{{ $trade->pnl }}">
                                                <input type="hidden" class="trade_created"
                                                    value="{{ $trade->created_at }}">
                                                <input type="hidden" class="current_date_time"
                                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}">
                                                <input type="hidden" class="timeframe "
                                                    value="{{ $trade->time_frame }}">
                                            </td>
                                            <td>{{ $trade->created_at->format('d-m-Y h:iA') }}</td>
                                            <td class="remaining_time">00:00</td>

                                            <td
                                                style="
                                                @if ($trade->order_type == 'bullish') color: #EFB90B; 
                                                @elseif($trade->order_type == 'bearish') 
                                                color: #F32524; @endif
                                                ">
                                                {{ $trade->order_type }}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
@endsection
