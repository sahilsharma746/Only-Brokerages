@extends('users.layouts.app_user')
@section('content')
    <article class="tab-content trade-article">
        <section id="payment-method-and-history" class=" common-section active payment-method-and-history">

            @include('users.deposit.payment-method-menu')

                <div class="area-title">trading history</div>
                <div class="trading-history-table-area table-area scroll">
                    <table id="trading-history-table" class="trading-history-table w-100">
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
                            @foreach ($trades as $trade)
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
