@extends('admin.layouts.app_admin')
@section('content')
    <main class="main-area">
        <div class="container">
            <section class="all-trade-table-area data-table-area">
                <div class="section-title">All Trades</div>

                <table id="all-trade-table" class="all-trade-table display nowrap order-column">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trades as $trade)
                        <tr>
                            <td>{{ $trade->id }}</td>
                            <td>
                                <div class="name">{{ $trade->user->first_name }} {{ $trade->user->last_name }}</div>
                                <div class="email">{{ $trade->user->email }}</div>
                            </td>
                            <td class="d-flex align-items-center g-8">
                                <img src="{{ $trade->image ?: asset('assets/img/crypto.jpeg') }}"
                                    alt="{{ $trade->asset }}" style="width: 20px; height: 20px;">
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
                            <td>{{$trade->admin_trade_result_percentage }}%</td>
                            <td>{{ number_format($trade->trade_win_loss_amount, 2) }}</td>
                            <td>
                                <div class="dropdown w-max">
                                    <a class="btn-dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </a>

                                    <ul class="list-style-none dropdown-menu d-flex flex-column">
                                        <li class="dropdown-item">
                                            <a href="{{ route('admin.trade.delete', $trade->id) }}" class="btn btn-delete-dt-tr">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>


    </main>
@endsection
