@extends('admin.layouts.app_admin')
@section('content')
    <main class="main-area">
        <div class="container manage-user-container">
            <section class="user-filter-section">
                @include('admin.users.manage-user-nav')
            </section>
            <section class="all-admin-table-area">
                <div class="section-title">All Users</div>
                <table id="all-admin-table" class="all-admin-table display">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>UserName</th>
                            <th>Country</th>
                            <th>Balance</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($all_users as $user)
                            <tr>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?? '(N/A)' }}</td>
                                <td>{{ '@' . $user->username }}</td>
                                <td>{{ config('countries.' . $user->addresses->country) }}</td>
                                <td>${{ $user->balance }}</td>
                                <td>{{ $user->status }}</td>
                                <td>
                                    <div class="dropdown w-max">
                                        <a class="btn-dropdown">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </a>

                                        <ul class="list-style-none dropdown-menu d-flex flex-column">
                                            <li class="dropdown-item">
                                                <a class="btn" href="{{ route('admin.user.details', $user->id) }}">View
                                                    User</a>
                                                <a class="btn"
                                                    href="{{ route('admin.user.editBalance', $user->id) }}">Edit balance</a>
                                                @if ($user->status != 'baned')
                                                    <a class="btn" href="{{ route('admin.user.banUser', $user->id) }}">Ban
                                                    User</a>
                                                @endif
                                                @if ($user->status == 'baned')
                                                    <a class="btn" href="{{ route('admin.user.unBanUser', $user->id) }}">Un Ban
                                                    User</a>
                                                @endif  
                                                <a class="btn"
                                                    href="{{ route('admin.user.deleteUser', $user->id) }}">Delete User</a>
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
