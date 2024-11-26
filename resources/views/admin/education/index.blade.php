@extends('admin.layouts.app_admin')
@section('content')
<main class="main-area">
        <div class="container">
            <section class="all-assets-table-area data-table-area">
                <div class="section-header">
                    <div class="section-title">All Educations</div>
                    <div class="btn-area">
                        <a class="btn btn-new-market open_add_education_type_modal" data-toggle="modal" href="#add-market-for-user">
                            <span class="icon"><i class="fa-solid fa-plus"></i></span>
                            <span>new market</span>
                        </a>
                        <a class="btn btn-new-asset" href="{{ route('admin.education.add') }}">
                            <span class="icon"><i class="fa-solid fa-plus"></i></span>
                            <span>education posts</span>
                        </a>
                    </div>
                </div>
                <div class="drop-down-modal-area">
                    <div id="add-market-for-user" class="modal add-market-for-user">
                        <form method="post" action="{{ route('admin.education.save.type') }}">
                        @csrf
                        <div class="modal-dialog d-flex flex-column">
                            <div class="modal-header">
                                <div class="modal-title">Add Education Market</div>
                                <a class="icon btn-modal-close">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            </div>
                            <div class="modal-body">
                                <div class="input-group">
                                    <label class="form-label">Name</label>
                                    <input class="form-control" name="name" type="text" placeholder="Enter name">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- <a class="btn btn-add-market education_type_submit" type="submit">ad market</a> -->
                                <button class="btn btn-add-market education_type_submit" type="submit">Add Market</button>
                            </div>
                        </div>
                        <form>
                    </div>
                    <div id="add-asset-for-user" class="modal add-asset-for-user">
                        <div class="modal-dialog d-flex flex-column">
                            <div class="modal-header">
                                <div class="modal-title">Add Asset</div>
                                <a class="icon btn-modal-close">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            </div>
                            <div class="modal-body">
                                <div class="input-group">
                                    <label for="add-asset-for-user-percentage" class="form-label">Symbol</label>
                                    <input id="add-asset-for-user-percentage"
                                        class="form-control add-asset-for-user-percentage" type="text"
                                        placeholder="Enter symbol">
                                </div>
                                <div class="input-group">
                                    <label class="form-label">Market</label>
                                    <select class="form-control" id="user-market-selector" searchable="false">
                                        <option value="Cryptocurrency">Cryptocurrency</option>
                                        <option value="Bitcoin">Bitcoin</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label class="form-label">Amount</label>
                                    <input class="form-control" type="text" placeholder="Enter Amount">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-modal-close btn-add-asset">add asset</a>
                            </div>
                        </div>
                    </div>
                </div>

                <table id="all-admin-table" class="all-assets-table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Title</th>
                            <th>Short Description</th>
                            <th>Image</th>
                            <th>Type</th>
                            <th>Date Added</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($educationPosts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->short_description }}</td>
                            <td>
                                @if($post->image)
                                    <img src="{{ asset('uploads/education_images/' . $post->image) }}" alt="Image" width="100">
                                @else
                                    No image
                                @endif
                            </td>
                            <td>{{ $post->educationType->name }}</td>
                            <td>{{ $post->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="dropdown w-max">
                                    <a class="btn-dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </a>

                                    <ul class="list-style-none dropdown-menu d-flex flex-column">
                                        <li class="dropdown-item">
                                                    <a href="{{ route('admin.education.edit', $post->id) }}" class="btn">Edit</a>
                                                    <a href="{{ route('admin.education.delete', $post->id) }}" class="btn">Delete</a>

                                                </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">No education posts available.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </section>
        </div>
    </main>
@endsection
