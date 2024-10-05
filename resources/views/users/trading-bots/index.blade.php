@extends('users.layouts.app_user')
@section('content')
    <article class="tab-content trade-article">
        <section id="payment-method-and-history" class="common-section payment-method-and-history">
            @include('users.deposit.payment-method-menu')
            <div id="trading-bots-area" class="trading-bots-area collapse">
                <div class="trading-bots-card-group">
                    <div class="card">
                        <div class="card-body">
                            <div class="icon">
                                <img src="{{ asset('assets/img/trading-bots-icon.png') }}">
                            </div>
                            <div class="trading-bots-name">GunBots Software</div>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-view-history d-none" data-target="#trading-history">View History</a>
                            <a class="btn btn-load-software" data-toggle="modal"
                                href="#trading-bot-license-modal">Load Software</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="icon">
                                <img src="{{ asset('assets/img/trading-bots-icon.png') }}">
                            </div>
                            <div class="trading-bots-name">GunBots Software</div>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-view-history d-none" data-target="#trading-history">View History</a>
                            <a class="btn btn-load-software" data-toggle="modal"
                                href="#trading-bot-license-modal">Load Software</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="icon">
                                <img src="{{ asset('assets/img/trading-bots-icon.png') }}">
                            </div>
                            <div class="trading-bots-name">GunBots Software</div>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-view-history d-none" data-target="#trading-history">View History</a>
                            <a class="btn btn-load-software" data-toggle="modal"
                                href="#trading-bot-license-modal">Load Software</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="icon">
                                <img src="{{ asset('assets/img/trading-bots-icon.png') }}">
                            </div>
                            <div class="trading-bots-name">GunBots Software</div>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-view-history d-none" data-target="#trading-history">View History</a>
                            <a class="btn btn-load-software" data-toggle="modal"
                                href="#trading-bot-license-modal">Load Software</a>
                        </div>
                    </div>
                </div>
                <div id="trading-bot-license-modal"
                    class="modal trading-bot-license-modal d-flex flex-column justify-content-center align-items-center">
                    <div class="modal-dialog">
                        <div class="modal-body">
                            <div class="icon">
                                <img src="{{ asset('assets/img/trading-bots-icon.png') }}">
                            </div>
                            <div class="trading-bots-details">
                                <div class="modal-title">GunBots Software</div>
                                <div class="modal-text">Congratulations, your bot is now activated. You can now
                                    start auto trading.</div>
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
                                <input class="form-control form-clone" type="text" id="trading-bot-license-ley"
                                    value="1A827SD286929GB43SGKDEU26DN82BD69MSSM2U2Y" placeholder="License Key">
                                <label for="trading-bot-license-ley" class="form-icon clone-icon">
                                    <i class="fa-regular fa-clone"></i>
                                </label>
                            </div>
                            <a id="btn-confirm-info" class="btn btn-modal-close btn-license-submit">submit</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
    </article>
@endsection

@section('scripts')
@endsection
