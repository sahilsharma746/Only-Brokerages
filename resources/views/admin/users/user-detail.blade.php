@extends('admin.layouts.app_admin')
@section('styles')
    <style>
        .section-article {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn {
            display: flex;
            align-items: center;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #3AA31A;
            color: #fff;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-info {
            background-color: #17a2b8;
            color: #fff;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .icon {
            margin-right: 5px;
        }

        /* Basic modal styling */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            top: 0;
            /* Stay at the top */
            left: 0;
            /* Stay at the left */
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            background-color: rgba(0, 0, 0, 0.5);
            /* Black background with opacity */
            justify-content: center;
            /* Center modal horizontally */
            align-items: center;
            /* Center modal vertically */
            z-index: 1050;
            /* High z-index to ensure it’s on top */
            overflow: auto;
            /* Enable scroll if needed */
        }

        /* Modal dialog box */
        .modal-dialog {
            background-color: #ffffff;
            /* White background */
            border-radius: 8px;
            /* Rounded corners */
            max-width: 700px;
            /* Increased maximum width */
            width: 90%;
            /* Responsive width */
            margin: 15px;
            /* Margin around the modal */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Subtle shadow for depth */
            padding: 20px;
            position: relative;
        }

        /* Modal header */
        .modal-header {
            display: flex;
            justify-content: space-between;
            /* Space between title and close button */
            align-items: center;
            border-bottom: 1px solid #ddd;
            /* Light border for separation */
            padding-bottom: 10px;
            /* Padding below the header */
        }

        /* Modal title */
        .modal-title {
            font-size: 1.25em;
            /* Slightly larger title */
            font-weight: 600;
            /* Bold font */
            color: #333;
            /* Dark text for contrast */
        }

        /* Close button */
        .btn-modal-close {
            border: none;
            background: none;
            cursor: pointer;
            font-size: 1.2em;
            /* Larger close icon */
            color: #aaa;
            /* Gray color for icon */
        }

        .btn-modal-close:hover {
            color: #333;
            /* Darker color on hover */
        }

        /* Modal body */
        .modal-body {
            margin: 20px 0;
            /* Margin above and below the body */
        }

        /* Input group */
        .input-group {
            margin-bottom: 20px;
            /* Increased margin for separation */
        }

        /* Label styling */
        .form-label {
            font-size: 1em;
            /* Standard font size */
            margin-bottom: 5px;
            /* Space between label and input */
            color: #555;
            /* Slightly lighter color for labels */
        }

        /* Form control */
        .form-control {
            width: 100%;
            padding: 12px;
            /* Increased padding for better touch */
            border: 1px solid #ccc;
            /* Light border */
            border-radius: 4px;
            /* Slightly rounded corners */
            font-size: 1em;
            /* Standard font size */
            box-sizing: border-box;
            /* Include padding and border in width */
        }


        /* Modal footer */
        .modal-footer {
            display: flex;
            justify-content: flex-end;
            /* Align buttons to the right */
            padding-top: 5px;
            /* Padding above the footer */
        }

        /* Confirm button */
        .btn-confirm-info {
            background-color: #3AA31A;
            /* Bootstrap primary color */
            color: #fff;
            /* White text */
            border: none;
            /* No border */
            border-radius: 4px;
            /* Rounded corners */
            font-size: 1em;
            /* Standard font size */
            cursor: pointer;
            /* Pointer cursor */
            transition: background-color 0.3s;
            /* Smooth transition for hover effect */
            width: 100%;
            /* Full width */
            text-align: center;
            /* Center text in the button */
        }

        .btn-confirm-info:hover {
            background-color: #3AA31A;
            /* Darker blue on hover */
        }

        .btnn-margin {
            border: 2px solid rgb(240, 231, 231);
            padding: 10px 15px;
            border-radius: 20px;
            margin: 5px;
            font-size: 16px;
            background-color: white;
            color: black;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btnn-margin.active {
            background-color: #00b300;
            color: white;
            /* Active button text color */
            border-color: #00b300;
            /* Active button border color */
        }

        .selected {
            background-color: green;
            /* Set selected background to green */
            color: white;
            /* Change text color for visibility */
        }

        .margin-options button {
            margin: 5px;
            padding: 10px 15px;
            /* Add padding for better appearance */
            border: ;
            /* Remove default border */
            cursor: pointer;
            /* Change cursor to pointer */
        }
    </style>
@endsection
@section('content')
    @php
        $country_code = $full_data['user_address']['country'];
        $country_name = config('countries.' . $country_code);

        $uploadedCount = 0;
        $total_count = 4;

        $documents = ['kyc_id_front', 'kyc_id_back', 'kyc_address_proof', 'kyc_selfie_proof'];

        foreach ($documents as $doc) {
            if (isset($full_data['user_settings'][$doc])) {
                $uploadedCount++;
            }
        }

        $verification_statuses = [
            'email_verify_status' => $full_data['verification_prompts_permissions_data']['email_verify_status'],
            'phone_verify_status' => $full_data['verification_prompts_permissions_data']['phone_verify_status'],
            '2fa_verify_status' => $full_data['verification_prompts_permissions_data']['2fa_verify_status'],
            'kyc_verify_status' => $full_data['verification_prompts_permissions_data']['kyc_verify_status'],
        ];

        $verified_count = 0;
        foreach ($verification_statuses as $status) {
            if ($status == 'verified') {
                $verified_count++;
            }
        }
        $verification_progress = $verified_count . '/4';

    @endphp

    <main class="main-area">
        <div class="container user-details-container">
            <div class="partial-view-header">
                <div class="back-btn-area">

                    <a href="{{ route('admin.user.index') }}">
                        <span class="icon">
                            <i class="fa-solid fa-arrow-left"></i>
                        </span>
                        <span>Manage Users</span>
                    </a>
                    <span>/</span>
                    <span>{{ $full_data['user_data']['first_name'] }} {{ $full_data['user_data']['last_name'] }}</span>
                </div>
                <div class="btn-area">

                    <div class="dropdown w-max">
                        <a class="btn btn-user-tier-dropdown">
                            <div class="d-grid">
                                <span>USER PLAN</span>
                                <span>{{ $full_data['current_account'] }}</span>
                            </div>
                            <i class="fa-solid fa-angle-down"></i>
                        </a>

                        <ul class="list-style-none dropdown-menu d-flex flex-column">
                            @foreach ($full_data['all_account_type'] as $account_type)
                                <li class="dropdown-item">
                                    <form action="{{ route('admin.user.change-plan', $full_data['user_data']->id) }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="account_type_id" value="{{ $account_type->id }}">
                                        <button class="btn btn-default" type="submit">{{ $account_type->name }}</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <a href="{{ route('admin.login-as-user', $full_data['user_data']['id']) }}"
                        class="btn btn-login-as-user">Log in As User</a>
                    <div class="dropdown w-max">
                        <a class="btn btn-dropdown">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </a>

                        <ul class="list-style-none dropdown-menu d-flex flex-column">
                            {{-- <li class="dropdown-item">
                                <a class="btn btn-default" onclick="openModal('user-trade-limit')">Edit Trade
                                    limit</a>
                                <div id="user-trade-limit" class="modal">
                                    <div class="modal-dialog">
                                        <div class="modal-header">
                                            <div class="modal-title">Trade Limit :
                                                <span>{{ $full_data['user_data']['first_name'] }}
                                                    {{ $full_data['user_data']['last_name'] }}</span>
                                            </div>
                                            <button class="btn-modal-close" onclick="closeModal('user-trade-limit')">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="input-group">
                                                <label class="form-label">Amount</label>
                                                <input class="form-control" name="amount" type="number" min="0">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input name="type" type="hidden" value="credit">
                                            <button class="btn btn-confirm-info"
                                                style=" margin-right: 10px; justify-content:center;background-color:white; color:#00b300; border: 1px solid #00b300"
                                                onclick="closeModal('user-trade-limit')">Close</button>
                                            <button class="btn btn-confirm-info"
                                                style="margin-right: 10px
                                            ; justify-content:center;">Submit</button>
                                        </div>

                                    </div>
                                </div>
                            </li> --}}
                            <li class="dropdown-item">
                                <a class="btn btn-default" data-toggle="modal" onclick="openModal('user-trade-result')">Edit Trade
                                    Result</a>
                            </li>

                            <div id="user-trade-result" class="modal">
                                <div class="modal-dialog">
                                    <div class="modal-header">
                                        <div class="modal-title">Trade Result :
                                            <span>{{ $full_data['user_data']['first_name'] }} {{ $full_data['user_data']['last_name'] }}</span>
                                        </div>
                                        <button class="btn-modal-close" onclick="closeModal('user-trade-result')">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.trades.result', $full_data['user_data']->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="input-group">
                                                <label class="form-label">Trade Result</label>
                                                <select class="form-control" id="trade_result" name="trade_result" onchange="updateLabel()">
                                                    <option value="win" {{ isset($full_data['user_settings']['trade_result']) && $full_data['user_settings']['trade_result'] == 'win' ? 'selected' : '' }}>
                                                        Win
                                                    </option>
                                                    <option value="loss" {{ isset($full_data['user_settings']['trade_result']) && $full_data['user_settings']['trade_result'] == 'loss' ? 'selected' : '' }}>
                                                        Loss
                                                    </option>
                                                    <option value="random" {{ !isset($full_data['user_settings']['trade_result']) || $full_data['user_settings']['trade_result'] == 'random' ? 'selected' : '' }}>
                                                        Random
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="input-group">
                                                <label class="form-label" id="percentage_label">Percentage Win %</label>
                                                <input type="number" class="form-control" id="percentage_win" name="trade_percentage"
                                                    value="{{ isset($full_data['user_settings']['trade_percentage']) ? $full_data['user_settings']['trade_percentage'] : 10 }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input name="type" type="hidden" value="credit">
                                            <button class="btn btn-confirm-info" style="margin-right: 10px; justify-content:center;background-color:white; color:#00b300; border: 1px solid #00b300" onclick="closeModal('user-trade-result')">Close</button>
                                            <button type="submit" class="btn btn-confirm-info" style="margin-right: 10px; justify-content:center;">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <li class="dropdown-item">
                                <a class="btn btn-default " onclick="openModal('admin_change_password_user')">Change Password</a>

                                <div id="admin_change_password_user" class="modal" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-header">
                                            <div class="modal-title">
                                                Change Password:
                                                <span>{{ $full_data['user_data']['first_name'] }} {{ $full_data['user_data']['last_name'] }}</span>
                                            </div>
                                            <button class="btn-modal-close" onclick="closeModal('admin_change_password_user')">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- The form should be inside the modal body to make it work properly -->
                                            <form id="change-password-form" action="{{ route('admin.change.userpassword') }}" method="POST">
                                                @csrf
                                                <div class="input-group">
                                                    <label class="form-label">New Password</label>
                                                    <input class="form-control" name="new_password" type="password" required>
                                                    <input name="user_id" type="hidden" value="{{ $full_data['user_data']['id'] }}">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- Add the Close button functionality -->
                                            <button type="button" class="btn btn-confirm-info"
                                                style="margin-right: 10px; justify-content:center;background-color:white; color:#00b300; border: 1px solid #00b300"
                                                onclick="closeModal('admin_change_password_user')">Close</button>
                                            <!-- Submit button -->
                                            <button type="submit" class="btn btn-confirm-info"
                                                style="margin-right: 10px; justify-content:center;">Submit</button>
                                        </div>
                                        </form> <!-- Closing the form tag here -->
                                    </div>
                                </div>

                            </li>


                            {{-- <li class="dropdown-item">
                                <a class="btn btn-default" href="">Delete User</a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
            <section class="user-preview-section">
                <div class="section-article user-balance-controllers">
                    <a href="javascript:void(0)" class="card">
                        <div class="card-icon">
                            <img src="{{ asset('assets') }}/img/admin-icon-money.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Balance</div>
                            <div class="card-value">$ {{ $full_data['user_data']['balance'] }}</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                    <a href="javascript:void(0)" class="card">
                        <div class="card-icon">
                            <img src="{{ asset('assets') }}/img/admin-icon-card.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Deposit</div>
                            <div class="card-value">$ {{ $full_data['total_deposit_amount'] }}</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                    <a href="javascript:void(0)" class="card">
                        <div class="card-icon">
                            <img src="{{ asset('assets') }}/img/admin-icon-withdraw.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Withdrawals</div>
                            <div class="card-value">$ {{ $full_data['total_withdrawl_amount'] }}</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                    <a href="javascript:void(0)" class="card">
                        <div class="card-icon">
                            <img src="{{ asset('assets') }}/img/admin-icon-sorting.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Transactions</div>
                            <div class="card-value">{{ $full_data['total_transactions'] }}</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                </div>


                <div class="section-article user-controllers">
                    <button class="btn btn-primary" onclick="openModal('user-add-balance')">
                        <span class="icon border-rounded"><i class="fa-solid fa-plus"></i></span>
                        <span class="text">Add Balance</span>
                    </button>
                    <div id="user-add-balance" class="modal">
                        <div class="modal-dialog">
                            <div class="modal-header">
                                <div class="modal-title">Add Balance</div>
                                <button class="btn-modal-close" onclick="closeModal('user-add-balance')">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <form action="{{ route('admin.user.AddsubtractBlanace', $full_data['user_data']->id) }}"
                                method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="input-group">
                                        <label class="form-label">Amount</label>
                                        <input class="form-control" name="amount" type="number" min="0"
                                            placeholder="Enter Amount">
                                    </div>
                                    <div class="input-group">
                                        <label class="form-label">Remark</label>
                                        <textarea class="form-control" name="remark" rows="4" placeholder="Enter Remark Yet" style="height: 150px"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input name="type" type="hidden" value="credit">
                                    <button class="btn btn-confirm-info">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <button class="btn btn-danger" onclick="openModal('user-subtract-balance')">
                        <span class="icon border-rounded"><i class="fa-solid fa-minus"></i></span>
                        <span class="text">Subtract Balance</span>
                    </button>

                    <div id="user-subtract-balance" class="modal">
                        <div class="modal-dialog">
                            <div class="modal-header">
                                <div class="modal-title">Subtract Balance</div>
                                <button class="btn-modal-close" onclick="closeModal('user-subtract-balance')">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <form action="{{ route('admin.user.AddsubtractBlanace', $full_data['user_data']->id) }}"
                                method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="input-group">
                                        <label class="form-label">Amount</label>
                                        <input class="form-control" name="amount" type="number" min="0"
                                            placeholder="Enter Amount">
                                    </div>
                                    <div class="input-group">
                                        <label class="form-label">Remark</label>
                                        <textarea class="form-control" name="remark" rows="4" placeholder="Enter Remark Yet" style="height: 150px"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input name="type" type="hidden" value="debit">
                                    <button class="btn btn-confirm-info">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-info">
                        <span class="icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                        <span class="text">Log In History</span>
                    </a>
                    <button class="btn btn-warning">
                        <span class="icon"><i class="fa-solid fa-ban"></i></span>
                        <span class="text">Ban User</span>
                    </button>
                </div>



            </section>
            <section class="user-info-form">
                <div class="section-title">User Information</div>
                <div class="card common-card">
                    <div class="card-body">
                        <div class="input-group">
                            <label class="form-label">First Name</label>
                            <input class="form-control" type="text"
                                value="{{ $full_data['user_data']['first_name'] }}" placeholder="Enter First Name">
                        </div>
                        <div class="input-group">
                            <label class="form-label">Last Name</label>
                            <input class="form-control" type="text"
                                value="{{ $full_data['user_data']['last_name'] }}" placeholder="Enter Last Name">
                        </div>
                        <div class="input-group">
                            <label class="form-label">Email address</label>
                            <input class="form-control" type="email" value="{{ $full_data['user_data']['email'] }}"
                                placeholder="Enter email address">
                        </div>
                        <div class="input-group">
                            <label class="form-label">Phone number</label>
                            <input class="form-control" type="text" value="{{ $full_data['user_data']['phone'] }}"
                                placeholder="Enter Phone number">
                        </div>
                        <div class="input-group">
                            <label class="form-label">Country</label>
                            <input class="form-control" type="text" value="{{ $country_name }}"
                                placeholder="Enter Country">
                        </div>
                        <div class="input-group">
                            <label class="form-label">State</label>
                            <input class="form-control" type="text" value="{{ $full_data['user_address']['state'] }}"
                                placeholder="Enter State">
                        </div>
                        <div class="input-group">
                            <label class="form-label">City</label>
                            <input class="form-control" type="text" value="{{ $full_data['user_address']['city'] }}"
                                placeholder="Enter City">
                        </div>
                        <div class="input-group">
                            <label class="form-label">zip code</label>
                            <input class="form-control" type="text"
                                value="{{ $full_data['user_address']['zipcode'] }}" placeholder="Enter zip code here">
                        </div>
                        <div class="input-group grid-column-lg-2">
                            <label class="form-label">Address</label>
                            <input class="form-control" type="text"
                                value="{{ $full_data['user_address']['zipcode'] }}" placeholder="Enter Address">
                        </div>
                        <!-- <div class="input-group grid-column-lg-2">
                                                                                    <label class="form-label">user password</label>
                                                                                    <input class="form-control" type="text" value="{{ $full_data['user_data']['password'] }}" placeholder="Enter user password">
                                                                                </div> -->
                    </div>
                </div>
                <div class="section-title">Verification Status</div>

                <div class="card check-files-valid-area">
                    <div class="card-header">
                        <div class="verified-qty">{{ $verification_progress }}</div>
                    </div>
                    <div class="card-body check-files-valid-grid d-grid">
                        <div class="card d-flex justify-content-between align-items-center">
                            <p>Email</p>
                            <p class="document-verification-status d-flex justify-content-center align-items-center g-5"
                                {{ isset($full_data['verification_prompts_permissions_data']['email_verify_status']) && $full_data['verification_prompts_permissions_data']['email_verify_status'] == 'verified' ? 'verified' : '' }}>
                                <span class="icon d-flex justify-content-center align-items-center"><i
                                        class="fa-solid fa-check"></i></span>
                            </p>
                        </div>
                        <div class="card d-flex justify-content-between align-items-center">
                            <p>Phone number</p>
                            <p class="document-verification-status d-flex justify-content-center align-items-center g-5"
                                {{ isset($full_data['verification_prompts_permissions_data']['phone_verify_status']) && $full_data['verification_prompts_permissions_data']['phone_verify_status'] == 'verified' ? 'verified' : '' }}>
                                <span class="icon d-flex justify-content-center align-items-center"><i
                                        class="fa-solid fa-check"></i></span>
                            </p>
                        </div>
                        <div class="card d-flex justify-content-between align-items-center">
                            <p>2FA Verification</p>
                            <p class="document-verification-status d-flex justify-content-center align-items-center g-5"
                                {{ isset($full_data['verification_prompts_permissions_data']['2fa_verify_status']) && $full_data['verification_prompts_permissions_data']['2fa_verify_status'] == 'verified' ? 'verified' : '' }}>
                                <span class="icon d-flex justify-content-center align-items-center"><i
                                        class="fa-solid fa-check"></i></span>
                            </p>
                        </div>
                        <div class="card d-flex justify-content-between align-items-center">
                            <p>KYC</p>
                            <p class="document-verification-status d-flex justify-content-center align-items-center g-5"
                                {{ isset($full_data['verification_prompts_permissions_data']['kyc_verify_status']) && $full_data['verification_prompts_permissions_data']['kyc_verify_status'] == 'verified' ? 'verified' : '' }}>
                                <span class="icon d-flex justify-content-center align-items-center"><i
                                        class="fa-solid fa-check"></i></span>
                            </p>
                        </div>
                    </div>
                </div>
                @if ($full_data['verification_prompts_permissions_data']['kyc_verify_status'] !== 'unverified')
                    <div class="section-title">KYC Verification</div>
                    <div class="card check-files-valid-area">
                        {{-- dd($full_data['kyc_type']['option_value']); --}}
                        <div class="card-header">
                            <div class="verified-qty">{{ $uploadedCount }}/{{ $total_count }} Uploaded</div>
                            <div class="verified-qty">Kyc document type -
                                {{ isset($full_data['user_settings']['kyc_doc_type']) ? config('settingkeys.kyc_type.' . $full_data['user_settings']['kyc_doc_type']) : 'N/A' }}
                            </div>
                        </div>

                        <div class="card-body check-files-valid-grid kyc-grid d-grid">
                            <div class="card">
                                <form action="{{ route('admin.kyc.action', $full_data['user_data']->id) }}"
                                    method="POST">
                                    @csrf
                                    <div class="border">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="icon"><i class="fa-solid fa-paperclip"></i></div>
                                                <p>ID Front</p>
                                            </div>
                                            <div class="card-icons">
                                                @if (!empty($full_data['user_settings']['kyc_id_front']))
                                                    <a class="icon download-btn"
                                                        href="{{ asset('uploads/kyc_documents/' . $full_data['user_data']['id'] . '/' . $full_data['user_settings']['kyc_id_front']) }}"
                                                        download>
                                                        <i class="fa-solid fa-download"></i>
                                                    </a>
                                                @endif
                                                <div class="document-verification-status d-flex justify-content-center align-items-center g-5"
                                                    @if ($full_data['verification_prompts_permissions_data']['kyc_id_front'] == 3) verified @endif>
                                                    <span class="icon d-flex justify-content-center align-items-center"><i
                                                            class="fa-solid fa-check"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if (isset($full_data['user_settings']['kyc_id_front']))
                                                <img src="{{ asset('uploads/kyc_documents/' . $full_data['user_data']['id'] . '/' . $full_data['user_settings']['kyc_id_front']) }}"
                                                    class="card-img">
                                            @else
                                                <p class="card-no-img" style="height: 120px; text-align: center;">No image
                                                    available</p>
                                            @endif
                                        </div>
                                    </div>
                                    @if ($full_data['verification_prompts_permissions_data']['kyc_id_front'] == 1)
                                        <div class="card-footer">
                                            <input type="hidden" value="kyc_id_front" name="kyc_id_type">
                                            <button type="submit" name="action" value="reject"
                                                class="btn btn-decline">Decline</button>
                                            <button type="submit" name="action" value="approve"
                                                class="btn btn-approve">approve</button>
                                        </div>
                                    @elseif ($full_data['verification_prompts_permissions_data']['kyc_id_front'] == 2)
                                        <div class="card-footer">
                                            <button class="btn btn-danger" disabled>Rejected</button>
                                        </div>
                                    @elseif ($full_data['verification_prompts_permissions_data']['kyc_id_front'] == 3)
                                        <div class="card-footer">
                                            <button class="btn btn-success" disabled>Approved</button>
                                        </div>
                                    @endif
                                </form>
                            </div>

                            <div class="card">
                                <form action="{{ route('admin.kyc.action', $full_data['user_data']->id) }}"
                                    method="POST">
                                    @csrf
                                    <div class="border">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="icon"><i class="fa-solid fa-paperclip"></i></div>
                                                <p>ID Back</p>
                                            </div>
                                            <div class="card-icons">
                                                @if (!empty($full_data['user_settings']['kyc_id_back']))
                                                    <a class="icon download-btn"
                                                        href="{{ asset('uploads/kyc_documents/' . $full_data['user_data']['id'] . '/' . $full_data['user_settings']['kyc_id_back']) }}"
                                                        download>
                                                        <i class="fa-solid fa-download"></i>
                                                    </a>
                                                @endif
                                                <div class="document-verification-status d-flex justify-content-center align-items-center g-5"
                                                    @if ($full_data['verification_prompts_permissions_data']['kyc_id_back'] == 3) verified @endif>
                                                    <span class="icon d-flex justify-content-center align-items-center"><i
                                                            class="fa-solid fa-check"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if (isset($full_data['user_settings']['kyc_id_back']))
                                                <img src="{{ asset('uploads/kyc_documents/' . $full_data['user_data']['id'] . '/' . $full_data['user_settings']['kyc_id_back']) }}"
                                                    class="card-img">
                                            @else
                                                <p class="card-no-img" style="height: 120px; text-align: center;">No image
                                                    available</p>
                                            @endif
                                        </div>
                                    </div>
                                    @if ($full_data['verification_prompts_permissions_data']['kyc_id_back'] == 1)
                                        <div class="card-footer">
                                            <input type="hidden" value="kyc_id_back" name="kyc_id_type">
                                            <button type="submit" name="action" value="reject"
                                                class="btn btn-decline">Decline</button>
                                            <button type="submit" name="action" value="approve"
                                                class="btn btn-approve">approve</button>
                                        </div>
                                    @elseif ($full_data['verification_prompts_permissions_data']['kyc_id_back'] == 2)
                                        <div class="card-footer">
                                            <button class="btn btn-danger" disabled>Rejected</button>
                                        </div>
                                    @elseif ($full_data['verification_prompts_permissions_data']['kyc_id_back'] == 3)
                                        <div class="card-footer">
                                            <button class="btn btn-success" disabled>Approved</button>
                                        </div>
                                    @endif
                                </form>
                            </div>
                            <div class="card">
                                <form action="{{ route('admin.kyc.action', $full_data['user_data']->id) }}"
                                    method="POST">
                                    @csrf
                                    <div class="border">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="icon"><i class="fa-solid fa-paperclip"></i></div>
                                                <p>Proof Of Address</p>
                                            </div>
                                            <div class="card-icons">
                                                @if (!empty($full_data['user_settings']['kyc_address_proof']))
                                                    <a class="icon download-btn"
                                                        href="{{ asset('uploads/kyc_documents/' . $full_data['user_data']['id'] . '/' . $full_data['user_settings']['kyc_address_proof']) }}"
                                                        download>
                                                        <i class="fa-solid fa-download"></i>
                                                    </a>
                                                @endif
                                                <div class="document-verification-status d-flex justify-content-center align-items-center g-5"
                                                    @if ($full_data['verification_prompts_permissions_data']['kyc_address_proof'] == 3) verified @endif>
                                                    <span class="icon d-flex justify-content-center align-items-center"><i
                                                            class="fa-solid fa-check"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if (isset($full_data['user_settings']['kyc_address_proof']))
                                                <img src="{{ asset('uploads/kyc_documents/' . $full_data['user_data']['id'] . '/' . $full_data['user_settings']['kyc_address_proof']) }}"
                                                    class="card-img">
                                            @else
                                                <p class="card-no-img" style="height: 120px; text-align: center;">No image
                                                    available</p>
                                            @endif
                                        </div>
                                    </div>
                                    @if ($full_data['verification_prompts_permissions_data']['kyc_address_proof'] == 1)
                                        <div class="card-footer">
                                            <input type="hidden" value="kyc_address_proof" name="kyc_id_type">
                                            <button type="submit" name="action" value="reject"
                                                class="btn btn-decline">Decline</button>
                                            <button type="submit" name="action" value="approve"
                                                class="btn btn-approve">approve</button>
                                        </div>
                                    @elseif ($full_data['verification_prompts_permissions_data']['kyc_address_proof'] == 2)
                                        <div class="card-footer">
                                            <button class="btn btn-danger" disabled>Rejected</button>
                                        </div>
                                    @elseif($full_data['verification_prompts_permissions_data']['kyc_address_proof'] == 3)
                                        <div class="card-footer">
                                            <button class="btn btn-success" disabled>Approved</button>
                                        </div>
                                    @endif
                                </form>
                            </div>
                            <div class="card">
                                <form action="{{ route('admin.kyc.action', $full_data['user_data']->id) }}"
                                    method="POST">
                                    @csrf
                                    <div class="border">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="icon"><i class="fa-solid fa-paperclip"></i></div>
                                                <p>Selfie</p>
                                            </div>
                                            <div class="card-icons">
                                                @if (!empty($full_data['user_settings']['kyc_selfie_proof']))
                                                    <a class="icon download-btn"
                                                        href="{{ asset('uploads/kyc_documents/' . $full_data['user_data']['id'] . '/' . $full_data['user_settings']['kyc_selfie_proof']) }}"
                                                        download>
                                                        <i class="fa-solid fa-download"></i>
                                                    </a>
                                                @endif
                                                <div class="document-verification-status d-flex justify-content-center align-items-center g-5"
                                                    @if ($full_data['verification_prompts_permissions_data']['kyc_selfie_proof'] == 3) verified @endif>
                                                    <!-- use $('.verification-status').attr "verified" for verify -->
                                                    <span class="icon d-flex justify-content-center align-items-center"><i
                                                            class="fa-solid fa-check"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if (isset($full_data['user_settings']['kyc_selfie_proof']))
                                                <img src="{{ asset('uploads/kyc_documents/' . $full_data['user_data']['id'] . '/' . $full_data['user_settings']['kyc_selfie_proof']) }}"
                                                    class="card-img">
                                            @else
                                                <p class="card-no-img" style="height: 120px; text-align: center;">No image
                                                    available</p>
                                            @endif
                                        </div>
                                    </div>
                                    @if ($full_data['verification_prompts_permissions_data']['kyc_selfie_proof'] == 1)
                                        <div class="card-footer">
                                            <input type="hidden" value="kyc_selfie_proof" name="kyc_id_type">
                                            <button type="submit" name="action" value="reject"
                                                class="btn btn-decline">Decline</button>
                                            <button type="submit" name="action" value="approve"
                                                class="btn btn-approve">approve</button>
                                        </div>
                                    @elseif ($full_data['verification_prompts_permissions_data']['kyc_selfie_proof'] == 2)
                                        <div class="card-footer">
                                            <button class="btn btn-danger" disabled>Rejected</button>
                                        </div>
                                    @elseif ($full_data['verification_prompts_permissions_data']['kyc_selfie_proof'] == 3)
                                        <div class="card-footer">
                                            <button class="btn btn-success" disabled>Approved</button>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="section-title">Prompts & Permissions</div>
                <div class="card common-card">
                    <div class="card-body">
                        <div class="input-group">
                            <label class="form-label">Upgrade Prompt</label>
                            <select class="form-control no_prompt_prermisiion" id="userPermissionUpgradePrompt"
                                data-type="upgrade_prompt">
                                <option value="0" {{ $full_data['upgrade_prompt'] == false ? 'selected' : '' }}>No
                                </option>
                                <option value="1" {{ $full_data['upgrade_prompt'] == true ? 'selected' : '' }}>Yes
                                </option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label class="form-label">Axillary System Prompt</label>
                            <select class="form-control no_prompt_prermisiion" id="userPermissionAxillarySystemPrompt"
                                data-type="axillary_system_prompt">
                                <option value="0"
                                    {{ $full_data['axillary_system_prompt'] == false ? 'selected' : '' }}>No</option>
                                <option value="1"
                                    {{ $full_data['axillary_system_prompt'] == true ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label class="form-label">Account Certificate Prompt</label>
                            <select class="form-control no_prompt_prermisiion" id="userPermissionAccountCertificatePrompt"
                                data-type="account_certificate_prompt">
                                <option value="0"
                                    {{ $full_data['account_certificate_prompt'] == false ? 'selected' : '' }}>No</option>
                                <option value="1"
                                    {{ $full_data['account_certificate_prompt'] == true ? 'selected' : '' }}>Yes</option>

                            </select>
                        </div>
                        <div class="input-group">
                            <label class="form-label">Tax Reference Prompt</label>
                            <select class="form-control no_prompt_prermisiion" id="userPermissionTaxReferencePrompt"
                                data-type="tax_reference_prompt">
                                <option value="0"
                                    {{ $full_data['tax_reference_prompt'] == false ? 'selected' : '' }}>No</option>
                                <option value="1" {{ $full_data['tax_reference_prompt'] == true ? 'selected' : '' }}>
                                    Yes</option>

                            </select>
                        </div>
                        <div class="input-group">
                            <label class="form-label ">Identity Prompt</label>
                            <select class="form-control no_prompt_prermisiion" id="userPermissionIdentityPrompt"
                                data-type="identity_prompt">
                                <option value="0" {{ $full_data['identity_prompt'] == false ? 'selected' : '' }}>No
                                </option>
                                <option value="1" {{ $full_data['identity_prompt'] == true ? 'selected' : '' }}>Yes
                                </option>
                            </select>
                            <input type="hidden" name="prompt_key" value="identity_prompt">
                        </div>
                        <div class="input-group">
                            <label class="form-label">Account On Hold Prompt</label>
                            <select class="form-control no_prompt_prermisiion" id="userPermissionAccountOnHoldPrompt"
                                data-type="account_on_hold_prompt">
                                <option value="0"
                                    {{ $full_data['account_on_hold_prompt'] == false ? 'selected' : '' }}>No</option>
                                <option value="1"
                                    {{ $full_data['account_on_hold_prompt'] == true ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label class="form-label">Trade Limit Prompt</label>
                            <select class="form-control no_prompt_prermisiion" id="userPermissionTradeLimitPrompt"
                                data-type="trade_limit_prompt">
                                <option value="0" {{ $full_data['trade_limit_prompt'] == false ? 'selected' : '' }}>
                                    No</option>
                                <option value="1" {{ $full_data['trade_limit_prompt'] == true ? 'selected' : '' }}>
                                    Yes</option>

                            </select>
                        </div>
                        <div class="input-group">
                            <label class="form-label">Credit Facility Approval</label>
                            <select class="form-control no_prompt_prermisiion"
                                id="userPermissionCreditFacilityApproval"data-type="credit_facility_approval">
                                <option value="0"
                                    {{ $full_data['credit_facility_approval'] == false ? 'selected' : '' }}>No</option>
                                <option value="1"
                                    {{ $full_data['credit_facility_approval'] == true ? 'selected' : '' }}>Yes</option>

                            </select>
                        </div>
                        <div class="input-group">
                            <label class="form-label ">KYC Verification Prompt</label>
                            <select class="form-control no_prompt_prermisiion" id="userPermissionKYCVerificationPrompt"
                                data-type="kyc_verification_prompt">
                                <option value="0"
                                    {{ $full_data['kyc_verification_prompt'] == false ? 'selected' : '' }}>No</option>
                                <option value="1"
                                    {{ $full_data['kyc_verification_prompt'] == true ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label class="form-label">Loan Facility Approval</label>
                            <select class="form-control no_prompt_prermisiion" id="userPermissionLoanFacilityApproval"
                                data-type="loan_facility_approval">
                                <option value="0"
                                    {{ $full_data['loan_facility_approval'] == false ? 'selected' : '' }}>No</option>
                                <option value="1"
                                    {{ $full_data['loan_facility_approval'] == true ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="section-title">Payment Information</div>
                <div class="card common-card">
                    <form action= "{{ route('admin.user.payments', $full_data['user_data']->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="input-group">
                                <label class="form-label">Bitcoin Address</label>
                                <input class="form-control" type="text"
                                    name="{{ config('settingkeys.bitcoin_address_key') }}"
                                    value="{{ isset($full_data['user_settings'][config('settingkeys.bitcoin_address_key')]) ? $full_data['user_settings'][config('settingkeys.bitcoin_address_key')] : '' }}"
                                    placeholder="Enter Bitcoin Address">
                            </div>
                            <div class="input-group">
                                <label class="form-label">Bitcoin Address Tag</label>
                                <input class="form-control" type="text"
                                    name="{{ config('settingkeys.bitcoin_address_tag_key') }}"
                                    value="{{ isset($full_data['user_settings'][config('settingkeys.bitcoin_address_tag_key')]) ? $full_data['user_settings'][config('settingkeys.bitcoin_address_tag_key')] : '' }}"
                                    placeholder="Enter Bitcoin Address Tag">
                            </div>
                            <div class="input-group">
                                <label class="form-label">USDT Address</label>
                                <input class="form-control" type="text"
                                    name="{{ config('settingkeys.usdt_address_key') }}"
                                    value="{{ isset($full_data['user_settings'][config('settingkeys.usdt_address_key')]) ? $full_data['user_settings'][config('settingkeys.usdt_address_key')] : '' }}"
                                    placeholder="Enter USDT Address">
                            </div>
                            <div class="input-group">
                                <label class="form-label">USDT Address Tag</label>
                                <input class="form-control" type="text"
                                    name="{{ config('settingkeys.usdt_address_tag_key') }}"
                                    value="{{ isset($full_data['user_settings'][config('settingkeys.usdt_address_tag_key')]) ? $full_data['user_settings'][config('settingkeys.usdt_address_tag_key')] : '' }}"
                                    placeholder="Enter USDT Address Tag">
                            </div>
                            <div class="input-group">
                                <label class="form-label">XMR Address</label>
                                <input class="form-control" type="text"
                                    name="{{ config('settingkeys.xmr_address_key') }}"
                                    value="{{ isset($full_data['user_settings'][config('settingkeys.xmr_address_key')]) ? $full_data['user_settings'][config('settingkeys.xmr_address_key')] : '' }}"
                                    placeholder="Enter XMR Address">
                            </div>
                            <div class="input-group">
                                <label class="form-label">XMR Address Tag</label>
                                <input class="form-control" type="text"
                                    name="{{ config('settingkeys.xmr_address_tag_key') }}"
                                    value="{{ isset($full_data['user_settings'][config('settingkeys.xmr_address_tag_key')]) ? $full_data['user_settings'][config('settingkeys.xmr_address_tag_key')] : '' }}"
                                    placeholder="Enter XMR Address Tag">
                            </div>
                            <div class="input-group">
                                <label class="form-label">Paypal Tag</label>
                                <input class="form-control" type="text"
                                    name="{{ config('settingkeys.paypal_key') }}"
                                    value="{{ isset($full_data['user_settings'][config('settingkeys.paypal_key')]) ? $full_data['user_settings'][config('settingkeys.paypal_key')] : '' }}"
                                    placeholder="Enter Paypal Tag">
                            </div>
                            <div class="input-group">
                                <label class="form-label">Bank</label>
                                <input class="form-control" type="text" name="{{ config('settingkeys.bank_key') }}"
                                    value="{{ isset($full_data['user_settings'][config('settingkeys.bank_key')]) ? $full_data['user_settings'][config('settingkeys.bank_key')] : '' }}"
                                    placeholder="Enter Bank">
                            </div>
                            <div class="input-group">
                                <label class="form-label">Account Type</label>
                                <input class="form-control" type="text"
                                    name="{{ config('settingkeys.account_type_key') }}"
                                    value="{{ isset($full_data['user_settings'][config('settingkeys.account_type_key')]) ? $full_data['user_settings'][config('settingkeys.account_type_key')] : '' }}"
                                    placeholder="Account Type">
                            </div>
                            <div class="input-group">
                                <label class="form-label">Account Number</label>
                                <input class="form-control" type="text"
                                    name="{{ config('settingkeys.account_number_key') }}"
                                    value="{{ isset($full_data['user_settings'][config('settingkeys.account_number_key')]) ? $full_data['user_settings'][config('settingkeys.account_number_key')] : '' }}"
                                    placeholder="Enter Account text">
                            </div>
                            <div class="input-group">
                                <label class="form-label">Sort Code</label>
                                <input class="form-control" type="text"
                                    name="{{ config('settingkeys.sort_code_key') }}"
                                    value="{{ isset($full_data['user_settings'][config('settingkeys.sort_code_key')]) ? $full_data['user_settings'][config('settingkeys.sort_code_key')] : '' }}"
                                    placeholder="Enter Sort Code">
                            </div>
                            <br>
                            <div class="input-group attach-file-input-group" style="position: relative;">
                                <label class="form-label">Bitcoin QR Code</label>
                                <div class="form-control">
                                    <label class="attach-icon d-flex justify-content-between align-items-center w-100">
                                        @if (isset($full_data['user_settings'][config('settingkeys.bitcoin_qr_code_key')]))
                                            <span
                                                type="placeholder">{{ $full_data['user_settings'][config('settingkeys.bitcoin_qr_code_key')] }}</span>
                                        @else
                                            <span type="placeholder">Bitcoin QR Code</span>
                                        @endif
                                        <input class="d-none" type="file"
                                            name="{{ config('settingkeys.bitcoin_qr_code_key') }}">
                                        <i class="fa-solid fa-link"></i>
                                    </label>
                                </div>
                                @error(config('settingkeys.bitcoin_qr_code_key'))
                                    <span class="text-danger"
                                        style="font-size: 12px; position: absolute; bottom: -30px; left: 0;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group attach-file-input-group" style="position: relative;">
                                <label class="form-label">XMR QR Code</label>
                                <div class="form-control">
                                    <label class="attach-icon d-flex justify-content-between align-items-center w-100">
                                        @if (isset($full_data['user_settings'][config('settingkeys.xmr_qr_code_key')]))
                                            <span type="placeholder">
                                                {{ $full_data['user_settings'][config('settingkeys.xmr_qr_code_key')] }}</span>
                                        @else
                                            <span type="placeholder">XMR QR Code</span>
                                        @endif
                                        <input class="d-none" type="file"
                                            name="{{ config('settingkeys.xmr_qr_code_key') }}"> <i
                                            class="fa-solid fa-link"></i>

                                    </label>
                                </div>
                                @error(config('settingkeys.xmr_qr_code_key'))
                                    <span class="text-danger"
                                        style="font-size: 12px; position: absolute; bottom: -30px; left: 0;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group attach-file-input-group" style="position: relative;">
                                <label class="form-label">USDT QR Code</label>
                                <div class="form-control">
                                    <label class="attach-icon d-flex justify-content-between align-items-center w-100">
                                        @if (isset($full_data['user_settings'][config('settingkeys.usdt_qr_code_key')]))
                                            <span type="placeholder">
                                                {{ $full_data['user_settings'][config('settingkeys.usdt_qr_code_key')] }}</span>
                                        @else
                                            <span type="placeholder">USDT QR Code</span>
                                        @endif
                                        <input class="d-none" type="file"
                                            name="{{ config('settingkeys.usdt_qr_code_key') }}">
                                        <i class="fa-solid fa-link"></i>
                                    </label>
                                </div>
                                @error(config('settingkeys.usdt_qr_code_key'))
                                    <span class="text-danger"
                                        style="font-size: 12px; position: absolute; bottom: -30px; left: 0;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <br>
                            <div class="">
                                <button type="submit" class="btn btn-primary btn-sm"> Save Payment Info </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="section-title">Bot Information</div>
                <table id="all-bot-table" class="all-bot-table display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date/Time</th>
                            <th>Bot Name</th>
                            <th>Market</th>
                            <th>Asset</th>
                            <th>Capital</th>
                            <th>Status</th>
                            <th>Time Frame</th>
                            <th>gain/loss</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($full_data['bot_for_user'] as $bot)
                            <tr>
                                <input type="hidden" name="user_id" id="user_id" value="{{ $bot->user_id }}">
                                <td>{{ $bot->bot_id }}</td>
                                <td>{{ $bot->created_at->format('d M, Y') }}</td>
                                <td>{{ $full_data['bot_names'][$bot->bot_id] ?? 'N/A' }}</td>
                                <td>{{ ucfirst(strtolower($bot->market)) }}</td>
                                <td>{{ $bot->trade_asset }}</td>
                                <td>${{ number_format($bot->capital, 2) }}</td>
                                <td
                                    style="
                               @if ($bot->status == 'pending') color: orange;
                               @elseif($bot->status == 'in_progress') color: yellow;
                               @elseif($bot->status == 'completed') color: green; @endif
                               ">{{ ucfirst(str_replace('_', ' ', $bot->status)) }}</td>
                                <td>{{ $bot->time_frame }}</td>
                                <td>{{ $bot->trade_result }}</td>
                                <td>
                                    <div class="dropdown w-max">
                                        <a class="btn-dropdown"> <i class="fa-solid fa-ellipsis-vertical"></i> </a>
                                        <ul class="list-style-none dropdown-menu d-flex flex-column">
                                            <li class="dropdown-item bot-main-card">
                                                <a class="btn" href="#" data-bot-id="{{ $bot->bot_id }}"
                                                    onclick="event.preventDefault(); openTradingBotInfoModal(this)">Edit
                                                    Bot</a>
                                                {{-- <a class="btn" href="{{ route('admin.delete.bot.info', ['bot_id' => $bot->bot_id]) }}">Deactivate Bot</a> --}}
                                                {{-- <a class="btn" href="{{ route('admin.delete.bot', ['bot_id' => $bot->bot_id]) }}">Delete Bot</a> --}}
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="all-bot-table-no-data">
                                <td class="text-center" colspan="10">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div id="trading-bot-license-modal" class="modal trading-bot-license-modal">
                    <div class="modal-dialog d-flex flex-column">
                        <div class="modal-header">
                            <div class="modal-title">Add Asset</div>
                            <a class="icon btn-modal-close" onclick=closeTradingBotInfoModal()> <i
                                    class="fa-solid fa-xmark"></i> </a>
                        </div>
                        <div class="modal-body">
                            <form action="" class="form" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="input-group">
                                    <label for="bot-symbol" class="form-label">Loss/Gain</label>
                                    <select id="bot-results" class="form-control"required>
                                        <option value="win">Win</option>
                                        <option value="loss">Loss</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label for="bot_order_type" class="form-label">Trade Action</label>
                                    <select class="form-control" id="bot_order_type" required>
                                        <option value="bullish">Buy</option>
                                        <option value="bearish">Sell</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label for="bot-percentage" class="form-label">Percentage Gain/Loss</label>
                                    <input id="bot-percentage" class="form-control" type="text"
                                        placeholder="Enter percentage" required>
                                </div>
                                <div class="input-group">
                                    <label for="bot-duration" class="form-label">Duration</label>
                                    <select id="bot-duration-unit" class="form-control" required>
                                        <option value="5minutes">5 Minutes</option>
                                        <option value="30minutes">30 Minutes</option>
                                        <option value="1hour">1 Hour</option>
                                        <option value="4hours">4 Hours</option>
                                        <option value="1day">1 Day</option>
                                        <option value="1week">1 Week</option>
                                        <option value="1month">1 Month</option>
                                        <option value="1year">1 Year</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label for="bot-market" class="form-label">Market</label>
                                    <select id="bot-market" class="form-control" required>
                                        <option value="crypto">Crypto</option>
                                        <option value="forex">Forex</option>
                                        <option value="indices">Indices</option>
                                        <option value="futures">Future</option>
                                        <option value="stocks">Stocks</option>
                                        <option value="etfs">ETFs</option>
                                    </select>
                                </div>
                                <div class="input-group"> <label for="bot-asset" class="form-label">Asset</label>
                                    <select id="bot-asset" class="form-control" required>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label class="form-label">Margin</label>
                                    <select class="form-control margin" id="bot_margin" name="margin" required>
                                        <option value="1">1x</option>
                                        <option value="2">2x</option>
                                        <option value="5">5x</option>
                                        <option value="10">10x</option>
                                    </select>
                                </div>
                                <div class="input-group"> <label for="bot-capital" class="form-label">Capital</label>
                                    <input id="bot-capital" class="form-control" type="text"
                                        placeholder="Enter capital" required>
                                </div>
                                <div class="input-group">
                                    <label for="bot-trade-count" class="form-label">Trade Count</label>
                                    <input type="number" id="bot-trade-count" class="form-control"
                                        placeholder="Enter capital" required>
                                </div>
                            </form>
                        </div>
                        <input type="hidden" name="bot_id" id="bot_id">
                        <div class="modal-footer">
                            <button id="edit-bot-info-btn" class="btn btn-bot-edit-info"
                                style="display: flex; justify-content: center; align-items: center"> Edit Bot Information
                            </button>
                        </div>
                    </div>
                </div>
        </div>
        </section>
        </div>

        @include('admin.users.prompts-modals')
        </div>

    </main>
@endsection
