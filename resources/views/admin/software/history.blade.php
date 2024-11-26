@extends('admin.layouts.app_admin')
@section('content')
    <main class="main-area">
        <div class="container" id="trading-bot-page">
            <section class="all-assets-table-area data-table-area">

                <div class="trading-bot-history-area" style="margin-top: 20px; margin-bottom: 40px">
                    <a href="{{ route('admin.software') }}"><i class="fas fa-arrow-left" style="color: black"></i></a>
                    <span class="area-title"> {{ $bot_name }} Trading History</span>
                </div>


                    <table id="all-admin-table" class="all-trade-table display nowrap order-column">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Symbol</th>
                                <th>Date/Time</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Result</th>
                                <th>Trade Action</th>
                                <th>Trade Time</th>
                                <th>Payout</th>
                                <th>%</th>
                                <th>P/L</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tradesData as $trade)
                                <tr>
                                    <td>{{ $trade->id }}</td>
                                    <td>
                                        <div class="name">{{ $trade->user->first_name }} {{ $trade->user->last_name }}
                                        </div>
                                        <div class="email">{{ $trade->user->email }}</div>
                                    </td>
                                    <td class="d-flex align-items-center g-8">
                                        <img src="{{ $trade->image ?: asset('assets/img/crypto.jpeg') }}"
                                            alt="{{ $trade->asset }}" style="max-width: 40px; max-height: 40px;">
                                        {{ $trade->asset }}
                                    </td>
                                    <td>
                                        <div class="date">{{ $trade->created_at->format('d - m - Y') }}</div>
                                        <div class="time">{{ $trade->created_at->format('g:i A') }}</div>
                                    </td>
                                    <td>${{ number_format($trade->capital, 2) }}</td>
                                    <td>{{ ucfirst($trade->trade_type) }}</td>
                                    <td class="{{ $trade->trade_result == 'loss' ? 'text-danger' : 'text-primary' }}">
                                        {{ ucfirst($trade->trade_result) }}
                                    </td>
                                    <td>{{ ucfirst($trade->order_type) }}</td>
                                    <td>{{ $trade->time_frame }}</td>
                                    <td>${{ number_format($trade->pnl) }}</td>
                                    <td>{{ $trade->admin_trade_result_percentage }}%</td>
                                    <td>{{ number_format($trade->trade_win_loss_amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </section>
        </div>
    </main>
@endsection
