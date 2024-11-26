@extends('admin.layouts.app_admin')
@section('content')
    <main class="main-area">
        <div class="container">
            <section class="all-trade-table-area data-table-area">
                <div class="section-title">All Trades</div>

                <table id="all-admin-table" class="all-trade-table display nowrap order-column">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date Added</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td>{{ $message->id }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->message }}</td>
                                <td>{{ $message->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="dropdown w-max">
                                        <a class="btn-dropdown">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </a>

                                        <ul class="list-style-none dropdown-menu d-flex flex-column">
                                            <li class="dropdown-item">
                                              <a href="{{ route('admin.contact.delete', $message->id) }}" class="btn">Delete</a>
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
    <style>
        .dt-layout-row.dt-layout-table {
            overflow: auto;
        }
    </style>
@endsection
