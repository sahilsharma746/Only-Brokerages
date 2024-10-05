@extends('admin.layouts.app_admin')
@section('content')
<main class="main-area">
    <div class="container manage-user-container">
        <section class="user-filter-section">
            @include('admin.deposit.nav')
        </section>
        <section class="all-admin-table-area">
            <div class="section-title">All deposits</div>

            <table id="all-admin-table" class="all-admin-table display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date/Time</th>
                        <th>User</th>
                        <!-- <th>Email</th> -->
                        <th>Getway</th>
                        <th>Amount</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($deposits as $deposit)
                        <tr>
                            <td>{{ $deposit->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($deposit->created_at)->format('d M, Y ') }}</td>
                            <td>
                                <p>{{ $deposit->first_name }} {{ $deposit->last_name }}</p>
                                <p>{{ $deposit->email }}</p>
                            </td>
                            <td>{{ ucfirst( strtolower(str_replace('_', ' ',$deposit->payment_method) ) ) }}</td> 
                            <td>${{ number_format($deposit->amount, 2) }}</td>
                            <td>{{ $deposit->remarks ?? 'N/A' }}</td> 
                            @php
                                $class = '';
                                if( $deposit->status == 'approved' ) {
                                    $class = 'text-success';
                                }else if( $deposit->status == 'rejected' || $deposit->status == 'deleted' ) {
                                    $class = 'text-danger';
                                }else if( $deposit->status == 'pending' || $deposit->status == 'requested' ){
                                    $class = 'text-warning';
                                }
                            @endphp
                            <td class="{{$class}}" style="text-transform:capitalize">{{ $deposit->status }}</td>
                            <td>
                                <div class="dropdown w-max">
                                    <a class="btn-dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </a>
                                    <ul class="list-style-none dropdown-menu d-flex flex-column">
                                        <li class="dropdown-item">
                                            @if($deposit->status != 'requested')
                                                @if($deposit->status != 'approved')
                                                    <a class="btn" href="{{ route('admin.deposit.approved.status', $deposit->id) }}">Approve Deposit</a>
                                                @endif
                                                @if($deposit->status != 'rejected')
                                                    <a class="btn" href="{{ route('admin.deposit.rejected.status', $deposit->id) }}">Reject Deposit</a>
                                                @endif
                                                @if($deposit->status != 'deleted')
                                                    <a class="btn" href="{{ route('admin.deposit.delete', $deposit->id) }}">Delete Deposit</a>
                                                @endif
                                                <a class="btn" target="_blank" href="{{ asset('uploads/deposit_receipt/' . $deposit->user_id . '/' . basename($deposit->receipt)) }}">View Receipt</a>
                                                <a class="btn" href="{{ route('admin.deposit.download', $deposit->id) }}">Download Receipt</a>
                                            @else
                                                <a class="btn" href="{{ route('admin.deposit.delete', $deposit->id) }}">Delete Deposit</a>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="all-admin-table-no-data">
                            <td class="text-center" colspan="8">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </div>
</main>
@endsection
