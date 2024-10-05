@extends('admin.layouts.app_admin')
@section('content')
<main class="main-area">
        <div class="container bot-software-add-container">
            <section class="bot-software-add-section">
                <div class="card common-card">
                    <div class="card-body">
                        <div class="input-group">
                            <label for="bot-software-name" class="form-label">Name</label>
                            <input id="bot-software-name" class="form-control" type="text"
                                placeholder="Enter Software Name">
                        </div>
                        <div class="input-group">
                            <label for="bot-software-description" class="form-label">Details</label>
                            <textarea id="bot-software-description" class="form-control" type="text"
                                placeholder="Enter Details here"></textarea>
                        </div>
                        <div class="input-group attach-file-input-group">
                            <label class="form-label">Image</label>
                            <div class="form-control">
                                <label for="bot-software-img"
                                    class="attach-icon d-flex justify-content-between align-items-center w-100">
                                    <span type="placeholder">Upload bot icon</span>
                                    <input id="bot-software-img" class="d-none" type="file" accept="image/*">
                                    <i class="fa-solid fa-link"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <br>
                        <a id="btn-add-software" class="btn btn-add-software">Add software</a>
                    </div>
                </div>
            </section>

            <section class="bot-software-table-area">
                <table id="bot-software-table" class="bot-software-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <img src="https://dummyimage.com/64x64/D9D9D9/000000" alt="">
                                <div class="name">Hashbot</div>
                            </td>
                            <td>Description</td>
                            <td>8/26/2024</td>
                            <td>
                                <div class="dropdown w-max">
                                    <a class="btn-dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </a>

                                    <ul class="list-style-none dropdown-menu d-flex flex-column">
                                        <li class="dropdown-item">
                                            <a class="btn btn-delete-tr">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>

        </div>
    </main>
@endsection