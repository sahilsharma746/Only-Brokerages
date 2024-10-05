@extends('users.layouts.app_user')
@section('content')
    <article class="tab-content trade-article">
        <section id="payment-method-and-history" class="tab-pane common-section in active payment-method-and-history">
            @include('users.deposit.payment-method-menu')

            <div id="user-withdraw-area" class="user-withdraw-area collapse">
                <form action="{{ route('user.withdraw.store') }}" method="POST">
                    @csrf
                    <div class="personal-info-card-area">
                        <div class="area-title">Withdrawal</div>
                        <div class="card common-card">
                            <div class="card-body d-grid">
                                <div class="input-group">
                                    <label class="form-label">Amount</label>
                                    <input class="form-control" type="number" min="0" placeholder="Enter Amount" name="amount">
                                    @error('amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <label class="form-label">Withdrawal Method</label>
                                    <select class="form-control small" id="userWithdrawalMethod" searchable="false" name="getway">
                                        <option value="">Select Method</option>
                                        @foreach ($getways as $getway)
                                            <option value="{{ $getway->id }}">{{ ucfirst(strtolower($getway->name));  }}</option>
                                        @endforeach
                                    </select>
                                    @error('getway')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <label class="form-label">Wallet Address</label>
                                    <input class="form-control" type="text" placeholder="Enter Withdrawal address" name="address">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <label class="form-label"> Address tag</label>
                                    <input class="form-control" type="text" placeholder="Enter Withdrawal address" name="address_tag">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <a data-toggle="modal" href="#withDrawRequestModal" class="btn btn-request-withdrawal w-max">Request Withdrawal</a>
                                <p class="support-text">For other payment methods please <a href="{{ route('frontend.contact') }}">Contact Support</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div id="withDrawRequestModal" class="modal withDrawRequestModal">
                        <div class="modal-dialog d-flex flex-column justify-content-center align-items-center">
                            <div class="modal-body text-center">
                                <h3 class="modal-title">Withdrawal Request</h3>
                                <p class="modal-text">Payment should be received within 20 to 45 minutes. Please check
                                    your email.</p>
                                <div class="btn-area d-flex g-15 justify-content-center">
                                    <button type="submit" class="btn btn-modal-close bg-primary">Finish</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="area-title">Withdrawal History</div>
                <div class="withdraw-table-area table-area scroll">
                    <table class="withdraw-table w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Payment Method</th>
                                <th>Wallet Address</th>
                                <th>Address tag</th>
                                <th>Remarks</th>
                                <th>Amount</th>
                                <th style="width: 140px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($withdrawals as $withdrawal)
                                <tr>
                                    <td>#{{ ++$loop->index }}</td>
                                    <td>{{ Carbon\Carbon::parse($withdrawal->created_at)->format('F j, Y') }}</td>
                                    <td>{{ strtolower($withdrawal->payment_method) ? strtolower($withdrawal->payment_method) : 'NA' }}</td>
                                    <td>{{ $withdrawal->wallet_address ? $withdrawal->wallet_address : 'NA' }}</td>
                                    <td>{{ $withdrawal->address_tag ? $withdrawal->address_tag : 'NA' }}</td>
                                    <td>{{ $withdrawal->remarks ? $withdrawal->remarks : 'NA' }}</td>
                                    <td>${{ $withdrawal->amount }}</td>
                                    @if ($withdrawal->status == 'pending')
                                        <td isConfirmed="false" style="text-transform:capitalize;">pending</td>
                                    @elseif($withdrawal->status == 'approved')
                                        <td isConfirmed="true" style="text-transform:capitalize;">approved</td>
                                    @elseif($withdrawal->status == 'rejected')
                                        <td style="text-transform:capitalize; color:red; background:#a21a1a1a;">rejected</td>
                                    @endif
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="50">No Data Available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </article>
@endsection
