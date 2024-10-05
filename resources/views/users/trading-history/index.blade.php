@extends('users.layouts.app_user')
@section('content')
    <article class="tab-content trade-article">
        <section id="payment-method-and-history" class="tab-pane common-section in active payment-method-and-history">
            @include('users.deposit.payment-method-menu')

            <div id="trading-history" class="trading-history collapse">
                <div class="area-title">trading history</div>
                <div class="trading-history-table-area table-area scroll w-100">
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
                                    <td>Manual</td> 
                                    <td>{{ $trade->trade_type }}</td> 
                                    <td>${{$trade->capital }}</td>
                                    <td>Currency</td> 
                                    <td>{{$trade->pnl}}</td> 
                                    <td >{{ $trade->trade_result }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </section>
    </article>
@endsection