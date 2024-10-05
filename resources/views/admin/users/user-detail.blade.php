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
                            <li class="dropdown-item">
                                <a class="btn btn-default" href="">Edit Plan</a>
                            </li>
                            <li class="dropdown-item">
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
                            </li>
                            <li class="dropdown-item">
                                <a class="btn btn-default" data-toggle="modal" href="#user-trade-result">Edit Trade
                                    Result</a>
                            </li>

                            <div id="user-trade-result" class="modal">
                                <div class="modal-dialog">
                                    <div class="modal-header">
                                        <div class="modal-title">Trade Result :
                                            <span>{{ $full_data['user_data']['first_name'] }}
                                                {{ $full_data['user_data']['last_name'] }}</span>
                                        </div>
                                        <button class="btn-modal-close" onclick="closeModal('user-trade-result')">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.trades.result', $full_data['user_data']->id) }}"
                                        method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="input-group">
                                                <label class="form-label">Trade Result</label>
                                                <select class="form-control" id="trade_result" name="trade_result"
                                                    onchange="updateLabel()">
                                                    <option value="win"
                                                        {{ isset($full_data['user_settings']['trade_result']) && $full_data['user_settings']['trade_result'] == 'win' ? 'selected' : '' }}>
                                                        Win</option>
                                                    <option value="loss"
                                                        {{ isset($full_data['user_settings']['trade_result']) && $full_data['user_settings']['trade_result'] == 'loss' ? 'selected' : '' }}>
                                                        Loss</option>
                                                    <option value="random"
                                                        {{ !isset($full_data['user_settings']['trade_result']) || $full_data['user_settings']['trade_result'] == 'random' ? 'selected' : '' }}>
                                                        Random</option>
                                                </select>
                                            </div>
                                            <div class="input-group">
                                                <label class="form-label" id="percentage_label">Percentage Win %</label>
                                                <input type="number" class="form-control" id="percentage_win"
                                                    name="trade_percentage"
                                                    value="{{ isset($full_data['user_settings']['trade_percentage']) ? $full_data['user_settings']['trade_percentage'] : 10 }}"
                                                    required>
                                            </div>



                                            
                                            </head>

                                            <body>
                                                <div class="input-group" style="margin: 20px;">
                                                    <label class="form-label" id="margin">Margin</label>
                                                    <div class="margin-options">
                                                        <button type="button" value="2x"
                                                            class="trade_reult_margin_btn">2x</button>
                                                        <button type="button" value="5x"
                                                            class="trade_reult_margin_btn">5x</button>
                                                        <button type="button" value="10x"
                                                            class="trade_reult_margin_btn">10x</button>
                                                        <button type="button" value="15x"
                                                            class="trade_reult_margin_btn">15x</button>
                                                        <button type="button" value="25x"
                                                            class="trade_reult_margin_btn">25x</button>
                                                        <button type="button" value="50x"
                                                            class="trade_reult_margin_btn">50x</button>
                                                        <button type="button" value="100x"
                                                            class="trade_reult_margin_btn">100x</button>
                                                    </div>
                                                </div>

                                                <script>
                                                    document.querySelectorAll('.trade_reult_margin_btn').forEach(button => {
                                                        button.addEventListener('click', function() {
                                                            // Toggle the 'selected' class on click
                                                            this.classList.toggle('selected');

                                                            // Get the values of the selected buttons
                                                            const selectedValues = Array.from(document.querySelectorAll(
                                                                '.trade_reult_margin_btn.selected')).map(btn => btn.value);
                                                            console.log('Selected margins:', selectedValues); // Log selected values to the console
                                                        });
                                                    });
                                                </script>



                                        </div>

                                        <div class="modal-footer">
                                            <input name="type" type="hidden" value="credit">
                                            <button class="btn btn-confirm-info"
                                                style=" margin-right: 10px; justify-content:center;background-color:white; color:#00b300; border: 1px solid #00b300"
                                                onclick="closeModal('user-trade-result')">Close</button>
                                            {{-- <input name="user_id" type="hidden" value="{{ $user->id }}"> --}}
                                            <button class="btn btn-confirm-info"
                                                style="margin-right: 10px
                                        ; justify-content:center;">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <li class="dropdown-item">
                                <a class="btn btn-default text-danger" style="text-decoration: line-through;">View
                                    Password</a>
                            </li>
                            <form action="{{ route('admin.prompt', $full_data['user_data']->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="prompt_type" value="upgrade_prompt">
                                <input type="hidden" name="action"
                                    value="{{ $full_data['verification_prompts_permissions_data']['upgrade_prompt'] == '1' ? 'off' : 'on' }}">
                                <button type="submit" class="btn btn-default"
                                    style="font-size:initial; font-family: Inter, sans-serif;">
                                    Turn
                                    {{ $full_data['verification_prompts_permissions_data']['upgrade_prompt'] == '1' ? 'Off' : 'On' }}
                                    Upgrade Prompt
                                </button>
                            </form>

                            <form action="{{ route('admin.prompt', $full_data['user_data']->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="prompt_type" value="certificate_prompt">
                                <input type="hidden" name="action"
                                    value="{{ $full_data['verification_prompts_permissions_data']['certificate_prompt'] == '1' ? 'off' : 'on' }}">
                                <button type="submit" class="btn btn-default"
                                    style="font-size:initial; font-family: Inter, sans-serif;">
                                    Turn
                                    {{ $full_data['verification_prompts_permissions_data']['certificate_prompt'] == '1' ? 'Off' : 'On' }}
                                    Certificate Prompt
                                </button>
                            </form>

                            <form action="{{ route('admin.prompt', $full_data['user_data']->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="prompt_type" value="identity_prompt">
                                <input type="hidden" name="action"
                                    value="{{ $full_data['verification_prompts_permissions_data']['identity_prompt'] == '1' ? 'off' : 'on' }}">
                                <button type="submit" class="btn btn-default"
                                    style="font-size:initial; font-family: Inter, sans-serif;">
                                    Turn
                                    {{ $full_data['verification_prompts_permissions_data']['identity_prompt'] == '1' ? 'Off' : 'On' }}
                                    Identity Prompt
                                </button>
                            </form>

                            <form action="{{ route('admin.prompt', $full_data['user_data']->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="prompt_type" value="custom_prompt">
                                <input type="hidden" name="action"
                                    value="{{ $full_data['verification_prompts_permissions_data']['custom_prompt'] == '1' ? 'off' : 'on' }}">
                                <button type="submit" class="btn btn-default"
                                    style="font-size:initial; font-family: Inter, sans-serif;">
                                    Turn
                                    {{ $full_data['verification_prompts_permissions_data']['custom_prompt'] == '1' ? 'Off' : 'On' }}
                                    Custom Prompt
                                </button>
                            </form>

                            <form action="{{ route('admin.prompt', $full_data['user_data']->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="prompt_type" value="demo">
                                <input type="hidden" name="action"
                                    value="{{ $full_data['verification_prompts_permissions_data']['demo'] == '1' ? 'off' : 'on' }}">
                                <button type="submit" class="btn btn-default"
                                    style="font-size:initial; font-family: Inter, sans-serif;">
                                    Turn
                                    {{ $full_data['verification_prompts_permissions_data']['demo'] == '1' ? 'Off' : 'On' }}
                                    Demo
                                </button>
                            </form>
                            <li class="dropdown-item">
                                <a class="btn btn-default" href="">Delete User</a>
                            </li>
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
                            <label class="form-label">Ban</label>
                            <select class="form-control" id="userPermissionBan" searchable="false">
                                <option {{ $full_data['user_data']['status'] == 'active' ? 'selected' : '' }}
                                    value="0">No</option>
                                <option {{ $full_data['user_data']['status'] == 'baned' ? 'selected' : '' }}
                                    value="1">Yes</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label class="form-label">KYC Verified</label>
                            <select class="form-control" id="userPermissionVerified" searchable="false">
                                <option
                                    {{ $full_data['verification_prompts_permissions_data']['kyc_verify_status'] == 'verified' ? 'selected' : '' }}
                                    value="1">Yes</option>
                                <option
                                    {{ $full_data['verification_prompts_permissions_data']['kyc_verify_status'] != 'verified' ? 'selected' : '' }}
                                    value="0">No</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label class="form-label">Upgrade Prompt</label>
                            <select class="form-control" id="userPermissionUpgradePrompt" searchable="false">
                                <option
                                    {{ $full_data['verification_prompts_permissions_data']['upgrade_prompt'] == '0' ? 'selected' : '' }}
                                    value="0">No</option>
                                <option
                                    {{ $full_data['verification_prompts_permissions_data']['upgrade_prompt'] == '1' ? 'selected' : '' }}
                                    value="1">Yes</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label class="form-label">Certificate Prompt</label>
                            <select class="form-control" id="userPermissionCertificatePrompt" searchable="false">
                                <option
                                    {{ $full_data['verification_prompts_permissions_data']['certificate_prompt'] == '0' ? 'selected' : '' }}
                                    value="0">No</option>
                                <option
                                    {{ $full_data['verification_prompts_permissions_data']['certificate_prompt'] == '1' ? 'selected' : '' }}
                                    value="1">Yes</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label class="form-label">Identity Prompt</label>
                            <select class="form-control" id="userPermissionIdentityPrompt" searchable="false">
                                <option
                                    {{ $full_data['verification_prompts_permissions_data']['identity_prompt'] == '0' ? 'selected' : '' }}
                                    value="0">No</option>
                                <option
                                    {{ $full_data['verification_prompts_permissions_data']['identity_prompt'] == '1' ? 'selected' : '' }}
                                    value="1">Yes</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label class="form-label">Custom Prompt</label>
                            <select class="form-control" id="userPermissionCustomPrompy" searchable="false">
                                <option
                                    {{ $full_data['verification_prompts_permissions_data']['custom_prompt'] == '0' ? 'selected' : '' }}
                                    value="0">No</option>
                                <option
                                    {{ $full_data['verification_prompts_permissions_data']['custom_prompt'] == '1' ? 'selected' : '' }}
                                    value="1">Yes</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label class="form-label">Demo</label>
                            <select class="form-control" id="userPermissionDemo" searchable="false">
                                <option
                                    {{ $full_data['verification_prompts_permissions_data']['demo'] == '0' ? 'selected' : '' }}
                                    value="0">No</option>
                                <option
                                    {{ $full_data['verification_prompts_permissions_data']['demo'] == '1' ? 'selected' : '' }}
                                    value="1">Yes</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="section-title">Payment Information</div>
                <div class="card common-card">
                    <form action= "{{ route('admin.user.payments', $full_data['user_data']->id) }}" method="POST">
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
                                <input class="form-control" type="text" name="{{ config('settingkeys.paypal_key') }}"
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
                            <div class="">
                                <button type="submit" class="btn btn-primary btn-sm"> Save Payment Info </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.trade_reult_margin_btn').forEach(button => {
            button.addEventListener('click', function() {
                // Toggle the 'selected' class on click
                this.classList.toggle('selected');

                // Get the values of the selected buttons
                const selectedValues = Array.from(document.querySelectorAll(
                    '.trade_reult_margin_btn.selected')).map(btn => btn.value);
                console.log('Selected margins:', selectedValues); // Log selected values to the console
            });
        });

        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Optionally, close modals if clicked outside
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        }
    </script>
@endsection
