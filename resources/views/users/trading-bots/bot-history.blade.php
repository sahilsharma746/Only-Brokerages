@extends('users.layouts.app_user')
@section('content')
    <article class="tab-content trade-article">
        <section id="trading_bot_history trading-history" class="common-section active payment-method-and-history">

            @include('users.deposit.payment-method-menu')

                <div class="area-title"> <span><a href="{{ route('users.trading-bots.index') }}"><i class="fas fa-arrow-left" style="color: white"></i></a>
                </span> {{ $bot_name }} Trading History </div>
                <div class="trading-bot-history-table-area trading-history table-area scroll">
                    <table id="trading-bot-history-table" class="trading-bot-history-table trading_bot_history_niceselect w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Created</th>
                                <th>Asset</th>
                                <th>Manual/Auto</th>
                                <th>Live Demo</th>
                                <th>Trade</th>
                                <th>Market</th>
                                <th>PNL</th>
                                <th>Win/Loss</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tradesData as $trade)
                                <tr>
                                    <td>{{ $trade->id }}</td>
                                    <td>{{ $trade->created_at->format('d-m-y') }}</td>
                                    <td class="d-flex align-items-center g-8">
                                        <img src="{{ $trade->image ?: asset('assets/img/crypto.jpeg') }}"
                                            alt="{{ $trade->asset }}" style="width: 20px; height: 20px;">
                                        {{ $trade->asset }}
                                    </td>
                                    <td style="color: {{ $trade->trade_execution_method === 'manual' ? 'orange' : 'blue' }};">
                                    {{ $trade->trade_execution_method }}
                                    </td>
                                    <td>{{ $trade->trade_type }}</td>
                                    <td>${{$trade->capital }}</td>
                                    <td>{{ ucfirst($trade->market) }}</td>
                                    <td>${{$trade->pnl}}</td>
                                    <td class="{{ $trade->trade_result === 'win' ? 'text-success' : 'text-danger' }}">
                                    {{ $trade->trade_result }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @extends('users.user-prompts')
        </section>
    </article>
@endsection
