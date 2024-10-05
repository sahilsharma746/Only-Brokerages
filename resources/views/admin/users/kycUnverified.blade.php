
@extends('admin.layouts.app_admin')
@section('content')
 
<main class="main-area">
    <div class="container user-manage-container">
        <section class="user-filter-section">
            <ul class="list-style-none">
                <li><a href="" class="btn active">all users</a></li>
                <li><a href="" class="btn">Active Users</a></li>
                <li><a href="" class="btn">KYC Unverified</a></li>
                <li><a href="" class="btn">KYC Verified</a></li>
                <li><a href="" class="btn">Email Verified</a></li>
                <li><a href="" class="btn">Phone Verified</a></li>
                <li><a href="" class="btn">Banned Users</a></li>
            </ul>
        </section>

        <section class="all-user-table-area data-table-area">
            <div class="section-title">All Users</div>

            <table id="all-user-table" class="all-user-table display">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>UserName</th>
                        <th>Country</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                        <td>{{ $data->first_name }} {{ $data->last_name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->phone }}</td>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->country }}</td>
                        <td>
                            <div class="dropdown w-max">
                                <a class="btn-dropdown">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </a>

                                <ul class="list-style-none dropdown-menu d-flex flex-column">
                                    <li class="dropdown-item">
                                        <a class="btn" href="./user-details.html">View User</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a class="btn" href="">Edit balance</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a class="btn" href="">Ban User</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a class="btn" href="">Delete User</a>
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
