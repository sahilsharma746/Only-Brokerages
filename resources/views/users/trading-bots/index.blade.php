@extends('users.layouts.app_user')
@section('content')
    <article class="tab-content trade-article">
        <section id="payment-method-and-history" class="common-section active payment-method-and-history">
            @include('users.deposit.payment-method-menu')
            <div id="trading-bots-area" class="trading-bots-area collapse">
                <div class="trading-bots-card-group">
                    @forelse ($trading_bots as $bot)
                        <div class="card bot-main-card">
                            <div class="card-body">
                                <div class="icon">
                                    <img class="bot-image" src="{{ asset('uploads/trading_bot/' . $bot->image) }}"
                                        alt="{{ $bot->name }}">
                                </div>
                                <div class="trading-bots-name">{{ $bot->name }}</div>
                            </div>
                            <input type="hidden" name="license_key" id="bot-main-license-key"
                                value="{{ $bot->license_key }}">
                            <input type="hidden" name="" id="bot-deposit-amount" value="{{ $bot->deposit_amount }}">
                            <div class="card-footer">
                                @if (in_array($bot->id, $activatedBots))
                                    <div class="trading-button-group">
                                        <a href="{{ route('users.trading-bots.bot-history', $bot->id) }}"
                                            class="btn btn-view-history trading-button" data-target="#trading-history">
                                            View History
                                        </a>

                                        <a href="{{ route('users.trading-bots-jobs.save', $bot->id) }}"
                                            class="btn btn-auto-trade-button trading-button">
                                            Auto Trade
                                        </a>
                                    </div>
                                @else
                                <div class="trading-button-group">
                                    <a class="btn btn-load-software" data-bot-id="{{ $bot->id }}" data-toggle="modal"
                                        href="#trading-bot-license-modal-{{ $bot->id }}">Load Software</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    @empty

                    <div id="no-bot-message" class="centered-content">
                        <img src="{{ asset('assets/img/admin-icon-kyc-unverified-men.avif') }}" alt="No Trading Bot" class="no-bot-image">
                        <h4 class="message-text">At this time, no trading bots are available</h4>
                    </div>

                    <style>
                    /* Container styling */
                    .centered-content {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        background-color: #01011c;
                        text-align: center;
                        padding: 30px;
                        margin-left: 450px;
                    }

                    /* Image styling */
                    .no-bot-image {
                        max-width: 50px; /* Small image size */
                        height: auto;
                        margin-right: 10px; /* Space between image and text */
                    }

                    /* Text styling */
                    .message-text {
                        color: white;
                        font-size: 1rem;
                        margin: 0;
                    }


                    /* Responsive adjustments */
                    @media screen and (max-width: 768px) {
                        .centered-content {
                            padding: 0 20px;
                            margin:0;
                        }

                        .no-bot-image {
                            max-width: 40px; /* Smaller image on mobile */
                        }

                        .message-text {
                            font-size: 0.9rem; /* Adjust text size on mobile */
                        }
                    }
                    </style>

                    @endforelse


                    <div id="trading-bot-license-modal"
                        class="modal trading-bot-license-modal d-flex flex-column justify-content-center align-items-center">
                        <div class="modal-dialog">
                            <div class="modal-body">
                                <div class="icon">
                                    <img src="" class="bot-modal-image"
                                        alt="">
                                </div>
                                <div class="trading-bots-details">
                                    <div class="modal-title">GunBots Software</div>
                                    <div class="modal-text">To activate this bot,minimun balance of $<span
                                            class="modal-trading-bot-deposit-amount"></span>
                                    </div>
                                    <div class="modal-percentage">
                                        <span class="text">Percentage Gain:</span>
                                        <span class="text-success">20%</span>
                                    </div>
                                    <div class="trading-duration">
                                        <span class="text">Trade Duration:</span>
                                        <span class="time">24 Hours</span>
                                    </div>
                                </div>
                                <a class="btn-modal-close"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                            <div class="modal-footer">
                                <div class="input-group">
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                        <label class="form-label" style="margin-bottom: 0;">License Key</label>
                                        <a id="generate-license-key" class="btn-success generate-license-key-modal"
                                            style="color: green" href="#">Generate License Key</a>
                                    </div>
                                    <input class="form-control form-clone" type="text" id="trading-bot-license-Key"
                                        value="" placeholder="License Key" readonly>
                                    <label for="trading-bot-license-ley" class="form-icon clone-icon">
                                        <i class="fa-regular fa-clone"></i>
                                    </label>
                                </div>
                                <br>
                                <input type="hidden" name="license_key" value="" class="bot-modal-license_key">
                                <input type="hidden" name="bot_id" value="" class="bot_id">
                                <input type="hidden" name="deposit_amount" value="" class="deposit_amount">
                                <a id="btn-confirm-info" class="btn btn-modal-close btn-license-submit">submit</a>
                            </div>
                        </div>
                    </div>

                    <div id="trading-bot-success-modal"
                        class="modal trading-bot-license-modal d-flex flex-column justify-content-center align-items-center">
                        <form id="trading-bot-success-form" action="{{ route('users.trading-bots.save') }}" method="POST">
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-body">
                                    <div class="icon">
                                        <img src=""
                                            class="bot-modal-image" alt="">
                                    </div>
                                    <div class="trading-bots-details">
                                        <div class="modal-title">GunBots Software</div>
                                        <div class="modal-text">
                                            Congratulations! Your trading bot has been successfully activated. You are now
                                            ready to begin auto-trading.
                                        </div>
                                        <div class="modal-percentage">
                                            <span class="text">Percentage Gain:</span>
                                            <span class="text-success">20%</span>
                                        </div>
                                        <div class="trading-duration">
                                            <span class="text">Trade Duration:</span>
                                            <span class="time">24 Hours</span>
                                        </div>
                                    </div>
                                    <a class="btn-modal-close"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                                <div class="modal-footer">
                                    <div class="input-group">
                                        <label class="form-label">License Key</label>
                                        <input class="form-control form-clone sucess-bot-modal-license_key" type="text"
                                            id="trading-bot-license-key" value="" placeholder="License Key readonly"
                                            readonly>
                                        <label for="trading-bot-license-key" class="form-icon clone-icon">
                                            <i class="fa-regular fa-clone"></i>
                                        </label>
                                    </div>
                                    <input type="hidden" name="bot_id" value="" class="bot_id">
                                    <br>
                                    <button type="submit" id="btn-confirm-info"
                                        class="btn btn-modal-close btn-key-success-submit">ok</button>
                                </div>
                            </div>
                        </form>
                    </div>



                </div>
            </div>
        </section>
        @extends('users.user-prompts')
    </article>
@endsection
@section('scripts')
@endsection
