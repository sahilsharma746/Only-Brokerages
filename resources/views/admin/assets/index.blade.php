@extends('admin.layouts.app_admin')
@section('content')
<main class="main-area">
        <div class="container">
            <section class="all-assets-table-area data-table-area">
                <div class="section-header">
                    <div class="section-title">All Assets</div>
                    <div class="btn-area">
                        <a class="btn btn-new-market" data-toggle="modal" href="#add-market-for-user">
                            <span class="icon"><i class="fa-solid fa-plus"></i></span>
                            <span>new market</span>
                        </a>
                        <a class="btn btn-new-asset" data-toggle="modal" href="#add-asset-for-user">
                            <span class="icon"><i class="fa-solid fa-plus"></i></span>
                            <span>new asset</span>
                        </a>
                    </div>
                </div>
                <div class="drop-down-modal-area">
                    <div id="add-market-for-user" class="modal add-market-for-user">
                        <div class="modal-dialog d-flex flex-column">
                            <div class="modal-header">
                                <div class="modal-title">Add Market</div>
                                <a class="icon btn-modal-close">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            </div>
                            <div class="modal-body">
                                <div class="input-group">
                                    <label class="form-label">Name</label>
                                    <input class="form-control" type="text" placeholder="Enter name">
                                </div>
                                <div class="input-group">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" type="text" placeholder="Enter name"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-modal-close btn-add-market">ad market</a>
                            </div>
                        </div>
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

                <table id="all-assets-table" class="all-assets-table display">
                    <thead>
                        <tr>
                            <th>Symbol</th>
                            <th>Market Type</th>
                            <th>Amount</th>
                            <th>Maximum Chart</th>
                            <th>Minimum Chart</th>
                            <th>Date Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>EUR/USD</td>
                            <td>Forex</td>
                            <td>1.5736</td>
                            <td>100</td>
                            <td>10</td>
                            <td>08 - 08 - 2024</td>
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
                        <tr>
                            <td>Bitcoin</td>
                            <td>Forex</td>
                            <td>56,500</td>
                            <td>100</td>
                            <td>10</td>
                            <td>08 - 08 - 2024</td>
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