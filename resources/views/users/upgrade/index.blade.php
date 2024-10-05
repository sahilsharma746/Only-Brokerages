@extends('users.layouts.app_user')
@section('content')
    <article class="tab-content trade-article">
        <section id="payment-method-and-history" class="tab-pane common-section in active payment-method-and-history">
            @include('users.upgrade.top-nav')
            <div id="user-upgrade-account" class="user-upgrade-account collapse">
                <div class="account-plan">
                    <style>
                        .account-plan {
                            margin-block: 40px 100px;

                            .card-group {
                                margin-top: 42px;
                            }
                        }
                    </style>
             <div class="container">
                <h1 class="title text-center"><span class="text-primary">Account</span> Plans</h1>
                <div class="card-group d-grid w-100">
                    @foreach ($plans as $plan_id => $features)
                        @php
                            $planName = $features->first()->name;
                            $planPrice = $features->first()->price;
                        @endphp
                        <div class="card d-flex flex-column {{ $user->account_type == $plan_id ? 'my-plan' : '' }}">
                            <div class="card-badge w-max">{{ $planName }}</div>
                            <div class="card-title">${{ number_format($planPrice, 0) }}</div>
                            <dl class="item-list d-grid g-10">
                                @foreach ($features as $feature)
                                @php
                                     $style = ( $feature->feature_available != 1 ) ? 'visibility:hidden' : '';
                                @endphp
                                    @if ($feature->feature_description)
                                        <dt style="{{ $style}}">
                                            <img src="{{ asset('assets/img/right-tick-vector.png') }}" class="card-img">
                                            <span>{!! $feature->feature_description !!}</span> <!-- Display raw HTML -->
                                        </dt>
                                    @endif
                                @endforeach
                            </dl>
                            <input type="hidden" name="planid" value="{{ $plan_id}}">
                            @if ($user->account_type == $plan_id)
                            
                                <button type="button" class="btn w-max">Your Current Account</button>
                            @else
                                <a href="{{ route('user.upgrade.plan', $plan_id) }}" class="btn w-max">Upgrade Account</a>
                            @endif
                        </div>
                    @endforeach
                </div>
                
            </div>
            
        </section>
    </article>
@endsection

@section('scripts')
@endsection
