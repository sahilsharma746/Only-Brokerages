@extends('admin.layouts.app_admin')
@section('content')
<main class="main-area">
   <div class="container" id="trading-bot-page">
      <section class="all-assets-table-area data-table-area">
         <div class="section-header">
            <div class="section-title">All Trading Bot Trades</div>
            <div class="btn-area">
                <button id="toggleButton" class="btn enalbled_disabled btn-enabled" onclick="toggleButton()">Disable</button>
               <a class="btn btn-new-asset" href="javascript:void(0)" onclick="openModal('trading-bot-modal')">
               <span class="icon"><i class="fa-solid fa-plus"></i></span>
               <span>Add New Trading Bot</span>
               </a>
            </div>
         </div>


         <!-- Trading Bot Modal -->
         <div class="drop-down-modal-area">
            <div id="trading-bot-modal" class="modal trading-bot-modal" style="display: none;">
               <div class="modal-dialog d-flex flex-column">
                  <div class="modal-header">
                     <div class="modal-title">Add Trading Bot</div>
                     <a class="icon btn-modal-close" onclick="closeModal('trading-bot-modal')">
                     <i class="fa-solid fa-xmark"></i>
                     </a>
                  </div>
                  <form action="{{ route('admin.software.save') }}" method="POST" enctype="multipart/form-data">
                     @csrf <!-- Add CSRF token for security -->
                     <div class="modal-body">
                        <div class="input-group">
                           <label for="bot-name" class="form-label">Name</label>
                           <input id="bot-name" name="name" class="form-control" type="text" placeholder="Enter bot name" required>
                        </div>
                        <div class="input-group">
                           <label for="bot-title" class="form-label">Title</label>
                           <input id="bot-title" name="title" class="form-control" type="text" placeholder="Enter title" required>
                        </div>
                        <div class="input-group">
                           <label for="bot-description" class="form-label">Description</label>
                           <textarea id="bot-description" name="description" class="form-control" placeholder="Enter bot description" required></textarea>
                        </div>
                        <div class="input-group attach-file-input-group" style="position: relative;">
                           <label class="form-label">Image</label>
                           <div class="form-control">
                              <label class="attach-icon d-flex justify-content-between align-items-center w-100">
                              <span>Select bot image</span>
                              <input class="d-none" type="file" name="image" accept="image/*" required>
                              <i class="fa-solid fa-link"></i>
                              </label>
                           </div>
                        </div>
                        <div class="input-group">
                           <label for="bot-deposit-amount" class="form-label">Deposit Amount</label>
                           <input id="bot-deposit-amount" name="deposit_amount" class="form-control" type="text" placeholder="Enter deposit amount" required>
                        </div>
                        <div class="input-group">
                            <label for="bot-license-key" class="form-label">License Key</label>
                            <div class="input-group-prepend" style=" margin-left: auto;text-align: center;">
                                <a id="generate-license-key" class=" btn-success" href="#">Generate Key</a>
                            </div>
                            <input id="bot-license-key" name="license_key" class="form-control" type="text" placeholder="Enter license key" readonly required>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-add-bot">Add Trading Bot</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>


         {{-- -----------------------------------------------UPDATE MODAL FOR TRADING BOT-------------------------------------------------}}
         <div id="update-trading-bot-modal" class="modal update-trading-bot-modal">
            <div class="modal-dialog d-flex flex-column">
               <div class="modal-header">
                  <div class="modal-title">UPDATE Trading Bot</div>
                  <a class="icon btn-modal-close" onclick="closeModal('update-trading-bot-modal')">
                  <i class="fa-solid fa-xmark"></i>
                  </a>
               </div>
               {{-- action="{{ route('admin.software.update',$bot->id) }}"  --}}
               <form action="" method="POST" enctype="multipart/form-data" id="update-bot-form">
                @csrf
                <div class="modal-body">
                    <div class="input-group">
                        <label for="bot-name" class="form-label">Name</label>
                        <input id="modal-bot-name" name="name" class="form-control" type="text" placeholder="Enter bot name" value="" required>
                    </div>
                    <div class="input-group">
                        <label for="bot-title" class="form-label">Title</label>
                        <input id="modal-bot-title" name="title" class="form-control" type="text" placeholder="Enter title" value="" required>
                    </div>
                    <div class="input-group">
                        <label for="bot-description" class="form-label">Description</label>
                        <textarea id="modal-bot-description" name="description" class="form-control" placeholder="Enter bot description" required></textarea>
                    </div>
                    <div class="input-group attach-file-input-group" style="position: relative;">
                        <label class="form-label">Image</label>
                        <div class="form-control">
                            <label class="attach-icon d-flex justify-content-between align-items-center w-100">
                                <span id="modal-bot-image-text">No image selected</span>
                                <input type="file" id="modal-bot-image-upload" name="image" class="d-none">
                                <i class="fa-solid fa-link"></i>
                            </label>
                        </div>
                    </div>
                    <img id="image-preview" src="" alt="Image Preview" style="display: none; max-width: 500px; max-height: 100px; margin-top: 10px;" />
                    <div class="input-group">
                        <label for="bot-deposit-amount" class="form-label">Deposit Amount</label>
                        <input id="modal-bot-deposit-amount" name="deposit_amount" class="form-control" type="number" placeholder="Enter deposit amount" value="" required>
                    </div>
                    <div class="input-group">
                        <label for="bot-license-key" class="form-label">License Key</label>
                        <input id="modal-bot-license-key" name="license_key" class="form-control" type="text" placeholder="Enter license key" value="" readonly>
                    </div>
                </div>
                <input type="hidden" name="bot_id" value="" id="bot-id">
                <div class="modal-footer">
                        <button type="submit" class="btn btn-update-bot" tabindex="-1">Update Trading Bot</button>
                </div>
            </form>

            </div>
         </div>


         {{-- ----------------------------------------------------view all trading bots---------------------------------------------------- --}}
         <table id="all-admin-table" class="all-assets-table order-column">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Created Date</th>
                  <th>Title</th>
                  <th>Deposit Amount</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               @forelse ($tradingBots as $bot)
               <tr>
                  <td class="d-flex align-items-center g-8">
                     <img src="{{ asset('uploads/trading_bot/' . $bot->image) }}" alt="{{ $bot->name }}" width="100" height="70">
                     {{ $bot->name }}
                  </td>
                  <td>{{ $bot->created_at->format('Y-m-d H:i:s') }}</td>
                  <td>{{ $bot->title }}</td>
                  <td>{{ $bot->deposit_amount }}</td>
                  <td>
                     <div class="dropdown w-max">
                        <a class="btn-dropdown">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                        </a>
                        <ul class="list-style-none dropdown-menu d-flex flex-column">
                           <li class="dropdown-item">
                            <a href="javascript:void(0);"
                            data-id="{{ $bot->id }}"
                            data-name="{{ $bot->name }}"
                            data-licensekey="{{ $bot->license_key }}"
                            data-description="{{ $bot->description }}"
                            data-title="{{ $bot->title }}"
                            data-deposit_amount="{{ $bot->deposit_amount }}"
                            data-image="{{ asset('uploads/trading_bot/' . $bot->image) }}"
                            data-showimage="{{asset($bot->image)}}"
                            class="btn btn-edit-software">
                            Update
                         </a>
                            <a class="btn btn-generate-license" data-license="{{ $bot->license_key }}" href="#">Generate License Key</a>
                              <a  class="btn" href="{{ route('admin.software.delete', $bot->id) }}">Delete</a>
                              <a  class="btn" href="{{ route('admin.software.history', $bot->id) }}">Bot History</a>
                           </li>
                        </ul>
                     </div>
                  </td>
               </tr>
               @empty
               <tr class="">
                  <td colspan="6" class="text-center">No trading bots available.</td>
               </tr>
               @endforelse
            </tbody>
         </table>
      </section>
   </div>
</main>
@endsection
