@extends('users.layouts.app_user')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets') }}/css/user-dashboard.css">
@endsection
@section('content')
    <article class="tab-content trade-article">
        <section id="payment-method-and-history" class="tab-pane common-section in active payment-method-and-history">
            @include('users.deposit.payment-method-menu')

            <div id="user-deposit-area" class="user-deposit-area collapse">
                <div class="area-title">Choose Payment Method</div>

                <div class="collapsible-card-group">

                    @foreach ($getways as $key => $getway)
                        <form action="{{ route('user.deposit.store', $getway->id) }}" method="POST"
                            enctype="multipart/form-data" class="card">
                            @csrf
                            <div class="card-header">
                                @if (trim(strtolower($getway->name)) == 'bitcoin' ||
                                        trim(strtolower($getway->name)) == 'xmr' ||
                                        trim(strtolower($getway->name)) == 'usdt')
                                    <a data-toggle="collapse" href="#payment-{{ $getway->tab_id }}-tab"
                                        name="{{ $getway->name }}"
                                        class="deposit-{{ $getway->tab_id }} d-flex align-items-center g-8 {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('assets/img/' . $getway->logo) }}" alt="{{ $getway->tab_id }}">
                                        <span>{{ $getway->name }}</span>
                                    </a>
                                @else
                                    <a data-toggle="modal" href="#depositConfirmationModal{{ $key }}"
                                        name="{{ $getway->name }}"
                                        class="d-flex align-items-center g-8 {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('assets/img/' . $getway->logo) }}" alt="{{ $getway->tab_id }}">
                                        <span>{{ $getway->name }}</span>
                                    </a>
                                @endif
                            </div>
                            @php
                                if (trim(strtolower($getway->name)) == 'bitcoin') {
                                    $bitcoin_id = $getway->tab_id;
                                }
                            @endphp

                            <div id="payment-{{ $getway->tab_id }}-tab"
                                class="payment-{{ $getway->tab_id }}-tab card-body collapse {{ $key == 0 ? 'active' : 'd-none' }}">
                                <p class="card-title">Make payment to the {{ $getway->name }} address below and upload
                                    receipt.</p>
                                @if (trim(strtolower($getway->name)) == 'bitcoin' ||
                                        trim(strtolower($getway->name)) == 'xmr' ||
                                        trim(strtolower($getway->name)) == 'usdt')
                                    <div class="payment-details-area d-grid align-items-center">
                                        <div class="input-group-area d-flex flex-column justify-content-between">
                                            <div class="input-group">
                                                <label class="form-label">Amount</label>
                                                <input class="form-control" type="text" placeholder="Enter amount to pay"
                                                    name="amount" value="{{ $plan_price > 0 ? $plan_price : '' }}">
                                                @error('amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="input-group">
                                                <label class="form-label">Wallet Address</label>
                                                <input class="form-control form-clone" type="text" name="wallet_address"
                                                    readonly id="wallet-address{{ $key }}"
                                                    value="{{ isset($user_settings[$getway->address_setting_key]) ? $user_settings[$getway->address_setting_key] : '' }}">
                                                <label for="wallet-address{{ $key }}"
                                                    class="form-icon clone-icon">
                                                    <i class="fa-regular fa-clone"></i>
                                                </label>
                                            </div>
                                            <div class="input-group">
                                                <label class="form-label">Address Tag</label>
                                                <input class="form-control form-clone" type="text" name="address_tag"
                                                    readonly id="address_tag-{{ $getway->id }}"
                                                    value="{{ isset($user_settings[$getway->address_tag_setting_key]) ? $user_settings[$getway->address_tag_setting_key] : '' }}">
                                                <label for="address_tag-{{ $getway->id }}" class="form-icon clone-icon">
                                                    <i class="fa-regular fa-clone"></i>
                                                </label>
                                            </div>
                                            <div class="input-group attach-file-input-group">
                                                <label class="form-label">Upload Receipt</label>
                                                <div class="form-control">
                                                    <label
                                                        class="attach-icon d-flex justify-content-between align-items-center w-100">
                                                        <span type="placeholder">Upload payment receipt</span>
                                                        <input class="d-none" type="file" name="receipt">
                                                        <i class="fa-solid fa-link"></i>
                                                    </label>
                                                </div>
                                            </div>
                                            @error('receipt')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="qr-code-area">
                                            <div class="input-group">
                                                <label class="form-label">QR Code</label>
                                                <img class="img-qr-code" src="{{ asset('assets/img/dev-qr-code.png') }}"
                                                    alt="qr-code">
                                            </div>
                                        </div>
                                        @if (isset( $plan->id))
                                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                        @else
                                        <input type="hidden" name="plan_id" value="">
                                        @endif

                                        <button class="btn w-max" type="submit">Deposit</button>
                                    </div>
                                @endif

                            </div>

                            <!-- Modal for non-Bitcoin payment methods -->
                            <div id="depositConfirmationModal{{ $key }}"
                                class="modal depositConfirmationModal{{ $key }}">
                                <div class="modal-dialog d-flex flex-column justify-content-center align-items-center">
                                    <div class="modal-body text-center">
                                        <h3 class="modal-title">Requesting Payment Info</h3>
                                        <p class="modal-text">You are requesting {{ $getway->name }} Payment Information
                                            in order to fund your wallet</p>
                                        <div class="btn-area d-flex g-15 justify-content-center">
                                            <button data-gatewayid="{{ $getway->id }}"
                                                class="btn btn-modal-close btn-confirm-deposit" type="button">Yes</button>
                                            <a class="btn btn-modal-close text-bg-primary">No</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    @endforeach
                </div>

                <!-- on submit the first popup -->
                <div id="depositSecondModal" class="modal depositSecondModal">
                    <div class="modal-dialog d-flex flex-column justify-content-center align-items-center">
                        <div class="modal-body text-center">
                            <h3 class="modal-title">Requesting Payment Info</h3>
                            <p class="modal-text">You request has been received. Please note that we only receive bank wire
                                transfer for payments above $150,000. Any lesser payment must be processed via bitcoin</p>
                            <div class="btn-area d-flex g-15 justify-content-center">
                                <button data-gatewayid="" class="btn btn-modal-close confirm-deposit-success"
                                    type="button">Yes</button>
                                <button class="btn btn-modal-close text-bg-primary deposit-use-bitcoin"
                                    data-bitcointabid="{{ $bitcoin_id }}">Use Bitcoin</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="clear-fix"></div>
                <div class="area-title">Deposit History</div>
                <div class="deposit-table-area table-area scroll">

                    <table class="deposit-table w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Payment Method</th>
                                <th>Wallet Address</th>
                                <th>Address Tag</th>
                                <th>Currency</th>
                                <th>Amount</th>
                                <th>Remarks</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deposits as $deposit)
                                <tr>
                                    <td>#{{ ++$loop->index }}</td>
                                    <td>{{ Carbon\Carbon::parse($deposit->created_at)->format('F j, Y') }}</td>
                                    <td>{{ ucfirst(strtolower(str_replace('_', ' ', $deposit->payment_method))) }}</td>
                                    <td>{{ $deposit->wallet_address ? $deposit->wallet_address : 'NA' }}</td>
                                    <td>{{ $deposit->address_tag ? $deposit->address_tag : 'NA' }}</td>
                                    <td>USD</td>
                                    <td>${{ $deposit->amount }}</td>
                                    <td>{{ $deposit->remarks ? $deposit->remarks : 'NA' }}</td>
                                    @if ($deposit->status == 'pending')
                                        <td isConfirmed="false" style="text-transform:capitalize;">Pending</td>
                                    @elseif ($deposit->status == 'requested')
                                        <td isConfirmed="false" style="text-transform:capitalize;">Requested</td>
                                    @elseif($deposit->status == 'approved')
                                        <td isConfirmed="true" style="text-transform:capitalize;">Succesfull</td>
                                    @elseif($deposit->status == 'rejected' || $deposit->status == 'deleted')
                                        <td style="text-transform:capitalize; color:red; background:#a21a1a1a;">rejected
                                        </td>
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

@section('scripts')
@endsection
