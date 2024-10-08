@extends('admin.layouts.app_admin')
@section('content')
<main class="main-area">
    <div class="container manage-user-container">
        <section class="user-filter-section">
            @include('admin.withdraw.nav')
        </section>
        <section class="all-admin-table-area">
            <div class="section-title">All Withdraw</div>

            <table id="all-admin-table" class="all-admin-table display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Date/Time</th>
                        <th>Amount</th>
                        <th>Getway</th>
                        <th>Address</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($withdrawls as $withdrawl)
                    <tr>
                        <td>{{ $withdrawl->id }}</td>
                        <td>
                            <p>{{ $withdrawl->first_name }} {{ $withdrawl->last_name }}</p>
                            <p>{{ $withdrawl->email }}</p>
                        </td>
                        <td>{{ Carbon\Carbon::parse($withdrawl->created_at)->format('d m, Y') }}</td>
                        <td>${{ $withdrawl->amount }}</td>
                        <td>{{ $withdrawl->payment_method ?? 'N/A' }}</td>
                    
                        @if (strtolower($withdrawl->payment_method) === 'deposit via paypal')
                            <td>{{ $withdrawl->paypal_email ?? 'N/A' }}</td>
                        @elseif (strtolower($withdrawl->payment_method) === 'deposit via bank')
                            <td>
                                {{ $withdrawl->bank_name ?? 'N/A' }} <br>
                                {{ $withdrawl->account_number ?? 'N/A' }}
                            </td>
                        @else
                            <td>{{ $withdrawl->wallet_address ?? 'N/A' }}</td>
                        @endif
                    
                        <td>{{ $withdrawl->remarks ?? 'N/A' }}</td>
                    
                        @php
                            $class = '';
                            if ($withdrawl->status == 'approved') {
                                $class = 'text-success';
                            } elseif ($withdrawl->status == 'rejected' || $withdrawl->status == 'deleted') {
                                $class = 'text-danger';
                            } elseif ($withdrawl->status == 'pending' || $withdrawl->status == 'requested') {
                                $class = 'text-warning';
                            }
                        @endphp
                    
                        <td class="{{ $class }}" style="text-transform:capitalize">{{ $withdrawl->status }}</td>
                        <td>
                            <div class="dropdown w-max">
                                <a class="btn-dropdown">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </a>
                                <ul class="list-style-none dropdown-menu d-flex flex-column">
                                    <li class="dropdown-item">
                                        @if($withdrawl->status != 'approved')
                                            <a class="btn" href="{{ route('admin.withdraw.approved.status', $withdrawl->id) }}">Approve Withdrawal</a>
                                        @endif
                                        @if($withdrawl->status != 'rejected')
                                            <a class="btn" href="{{ route('admin.withdraw.rejected.status', $withdrawl->id) }}">Reject Withdrawal</a>
                                        @endif
                                        @if($withdrawl->status != 'deleted')
                                            <a class="btn" href="{{ route('admin.withdraw.delete', $withdrawl->id) }}">Delete Withdrawal</a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    
                    @empty
                    <tr class="all-admin-table-no-data">
                            <td class="text-center" colspan="9">No data available</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </section>
    </div>
</main>
@endsection
