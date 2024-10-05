@extends('admin.layouts.app_admin')
@section('content')
    <main class="main-area scroll">
        <div class="container dashboard-container">
            <section class="user-preview-section">
                <h3 class="section-title">user overview</h3>
                <div class="section-article">
                    <a href="{{ route('admin.user.index') }}" class="card">
                        <div class="card-icon">
                            <img src="{{ asset('assets') }}/img/admin-icon-men-group.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Total Users</div>
                            <div class="card-value">{{ $full_data['total_users'] }}</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                    <a href="{{ route('admin.user.activeUsers') }}" class="card">
                        <div class="card-icon">
                            <img src="{{ asset('assets') }}/img/admin-icon-user.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Active Users</div>
                            <div class="card-value">{{ $full_data['total_active_users'] }}</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                    <a href="{{ route('admin.user.kycVerified') }}" class="card">
                        <div class="card-icon">
                            <img src="{{ asset('assets') }}/img/admin-icon-kyc-verified-men.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">KYC Verified</div>
                            <div class="card-value">{{ $full_data['total_kyc_verified_users'] }}</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                    <a href="{{ route('admin.user.kycUnverified') }}" class="card">
                        <div class="card-icon">
                            <img src="{{ asset('assets') }}/img/admin-icon-kyc-unverified-men.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">KYC Unverified</div>
                            <div class="card-value">{{ $full_data['total_kyc_unverified_users'] }}</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </section>

            <section class="deposit-section">
                <h3 class="section-title">user overview</h3>
                <div class="section-article">
                    <a href="{{ route('admin.deposit.index') }}" class="card">
                        <div class="card-icon">
                            <img src="{{ asset('assets') }}/img/admin-icon-deposit.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Total Deposits</div>
                            <div class="card-value">$ {{ $full_data['total_deposit'] }}</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                    <a href="{{ route('admin.deposit.pending') }}" class="card">
                        <div class="card-icon">
                            <img src="{{ asset('assets') }}/img/admin-icon-load-pending.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Pending Deposits</div>
                            <div class="card-value">$ {{ $full_data['pending_deposit'] }}</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                    <a href="" class="card">
                        <div class="card-icon">
                            <img src="{{ asset('assets') }}/img/admin-icon-deposit.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Total Withdrawals</div>
                            <div class="card-value">$ {{ $full_data['total_withdraw'] }}</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                    <a href="" class="card">
                        <div class="card-icon">
                            <img src="{{ asset('assets') }}/img/admin-icon-load-pending.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Pending Withdrawal</div>
                            <div class="card-value">$ {{ $full_data['pending_withdraw'] }}</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                    <a href="{{ route('admin.deposit.rejected') }}" class="card">
                        <div class="card-icon">
                            <img src="{{ asset('assets') }}/img/admin-icon-cancel-deposit.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Cancelled Deposits</div>
                            <div class="card-value">$ {{ $full_data['rejected_deposit'] }}</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                    <a href="" class="card">
                        <div class="card-icon">
                            <img src="{{ asset('assets') }}/img/admin-icon-percentage-deposit-charge.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Deposit Charge</div>
                            <div class="card-value">$ {{$full_data['deposit_charge']}}</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                    <a href="" class="card">
                        <div class="card-icon">
                            <img src="{{ asset('assets') }}/img/admin-icon-cancel-deposit.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Cancelled Withdrawals</div>
                            <div class="card-value">$ {{ $full_data['rejected_withdraw'] }}</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                    <a href="" class="card">
                        <div class="card-icon">
                            <img src="{{ asset('assets') }}/img/admin-icon-percentage-deposit-charge.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Withdrawal Charge</div>
                            <div class="card-value">$ {{$full_data['withdraw_charge']}}</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </section>

            <section class="dashboard-donate">
                <h3 class="section-title">Log In Stats</h3>
                <div class="dashboard-donate-group">
                    <div class="card">
                        <div class="donate-chart" title="By Browser" series="[50, 25, 25]" labels="['Chrome - 50%', 'Safari - 25%', 'Others - 25%']"></div>
                    </div>
                    <div class="card">
                        <div class="donate-chart" title="By OS (Operating System)" series="[50, 17.5, 25, 32.5]" labels="['Windows - 50%', 'MacOS - 17.5%', 'Android - 25%', 'IOS - 32.5%']"></div>
                    </div>
                    <div class="card">
                        <div class="donate-chart" title="By Country" series="[50, 25, 25]" labels="['United Kingdom - 50%', 'United States - 25%', 'Germany - 25%']"></div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
