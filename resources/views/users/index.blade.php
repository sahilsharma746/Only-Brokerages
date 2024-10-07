@extends('users.layouts.app_user')
@section('content')
    <article class="tab-content trade-article">
        <section id="admin-account-grid" class="tab-pane in active admin-account-grid d-grid">
            <div class="balance-board d-grid align-items-center">
                <div class="btn-area d-grid g-25">
                    <a class="btn btn-deposit g-8" href="{{ route('user.deposit.getway') }}">
                        <i class="fa-regular fa-credit-card"></i>
                        <span>Deposit</span>
                    </a>
                    <a class="btn btn-withdraw g-8" href="{{ route('user.withdraw.index') }}">
                        <i class="fa-solid fa-landmark"></i>
                        <span>Withdraw</span>
                    </a>
                </div>
                <div class="card-group d-grid w-100 align-items-start">
                    <div class="card d-grid g-4">
                        <div class="card-title">Total balance</div>
                        <div class="card-price d-flex align-items-center g-8">
                            <img src="{{ asset('assets/img/flag-eur.png') }}" alt="Eur currency">
                            <div class="amount">${{ number_format(auth()->user()->balance) }}</div>
                        </div>
                        <div class="card-status d-flex align-items-center g-3 {{ $full_data['usertotoalpercentage'] > 0 ? 'text-primary' : 'text-danger' }}">
                            <div class="percentage">{{ $full_data['usertotoalpercentage'] }}%</div>
                            <span class="status {{($full_data['usertotoalpercentage'] > 0) ? 'up' : 'down'}}">
                                <i class="fa-solid {{ ($full_data['usertotoalpercentage'] > 0) ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                            </span>
                        </div>
                    </div>
                    <div class="card d-grid g-4">
                        <div class="card-title">Total Deposit</div>
                        <div class="card-price d-flex align-items-center g-8">
                            <img src="{{ asset('assets/img/flag-eur.png') }}" alt="Eur currency">
                            <div class="amount">${{ number_format( $full_data['total_deposit'] ) }}</div>
                        </div>
                    </div>
                    <div class="card d-grid g-4">
                        <div class="card-title">Profitable Trades</div>
                        <div class="card-price d-flex align-items-center g-8">
                            <img src="{{ asset('assets/img/flag-eur.png') }}" alt="Eur currency">
                            <div class="amount">{{ $full_data['totalWinTradesCount']}}/{{$full_data['totalTradesCount']}}</div>
                        </div>
                        <div class="card-status d-flex align-items-center g-4 {{ $full_data['winPercentage'] > 0 ? 'text-primary' : 'text-danger' }}">
                            <div class="percentage">{{ $full_data['winPercentage'] }}</div>
                                <span class="status {{($full_data['winPercentage'] > 0) ? 'up' : 'down'}}">
                                    <i class="fa-solid {{($full_data['winPercentage'] > 0) ? 'fa-arrow-up' : 'fa-arrow-down'}}"></i>
                                </span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="company-trade-percentage-card-group d-grid">
                <div class="card d-grid align-items-center bitcoin-dashboard-data">
                    <img src="{{ asset('assets/img/bitcoin.png') }}" alt="company logo">
                    <div class="card-title-area ">
                        <div class="card-title">Bitcoin</div>
                        <div class="card-price">
                            <span>USD</span>
                            <span class="amount">0</span>
                        </div>
                    </div>
                    <div class="card-status d-flex align-items-center g-4 percentage-data">
                        <div class="percentage">0%</div>
                        <span class="status">
                            <i class="fa-solid fa-arrow-up"></i>
                        </span>
                    </div>
                </div>
                <div class="card d-grid align-items-center ethereum-dashboard-data">
                    <img src="{{ asset('assets/img/ethereum.png') }}" alt="company logo">
                    <div class="card-title-area">
                        <div class="card-title">Ethereum</div>
                        <div class="card-price">
                            <span>USD</span>
                            <span class="amount">0</span>
                        </div>
                    </div>
                    <div class="card-status d-flex align-items-center g-4 percentage-data">
                        <div class="percentage">0%</div>
                        <span class="status">
                            <i class="fa-solid fa-arrow-down"></i>
                        </span>
                    </div>
                </div>
                <div class="card d-grid align-items-center solana-dashboard-data">
                    <img src="{{ asset('assets/img/solana.png') }}" alt="company logo">
                    <div class="card-title-area">
                        <div class="card-title">Solana</div>
                        <div class="card-price">
                            <span>USD</span>
                            <span class="amount">0</span>
                        </div>
                    </div>
                    <div class="card-status d-flex align-items-center g-4 percentage-data">
                        <div class="percentage">0%</div>
                        <span class="status">
                            <i class="fa-solid fa-arrow-up"></i>
                        </span>
                    </div>
                </div>
                <div class="card d-grid align-items-center tether-dashboard-data">
                    <img src="{{ asset('assets/img/Tether.png') }}" alt="company logo">
                    <div class="card-title-area">
                        <div class="card-title">Tether</div>
                        <div class="card-price">
                            <span>USD</span>
                            <span class="amount">0</span>
                        </div>
                    </div>
                    <div class="card-status d-flex align-items-center g-4 percentage-data">
                        <div class="percentage">0%</div>
                        <span class="status">
                            <i class="fa-solid fa-arrow-down"></i>
                        </span>
                    </div>
                </div>
            </div>

            
            <div class="company-trade-percentage-card-group d-grid">
                <div class="card d-grid align-items-center">
                    <img src="{{ asset('assets/img/profit.png') }}" alt="company logo">
                    <div class="card-title-area">
                        <div class="card-title">Profit</div>
                        <div class="card-price">
                            <span>USD</span>
                            <span class="amount">{{ number_format( $full_data['totalWinAmount'] ) }}</span>
                        </div>
                    </div>
                    <div class="card-status d-flex align-items-center g-4 {{ $full_data['win_percentage'] > 0 ? 'text-primary' : 'text-danger' }}">
                        <div class="percentage">{{$full_data['win_percentage']}}%</div>
                        <span class="status up">
                        <i class="fa-solid {{($full_data['win_percentage'] > 0) ? 'fa-arrow-up' : 'fa-arrow-down'}}"></i>
                        </span>
                    </div>
                </div>
                <div class="card d-grid align-items-center">
                    <img src="{{ asset('assets/img/loan.png') }}" alt="company logo">
                    <div class="card-title-area">
                        <div class="card-title">Loss</div>
                        <div class="card-price">
                            <span>USD</span>
                            <span class="amount">{{ number_format ( $full_data['totalLossAmount'] ) }}</span>
                        </div>
                    </div>
                    <div class="card-status d-flex align-items-center g-4 {{ $full_data['loss_percentage'] > 0 ? 'text-primary' : 'text-danger' }}">
                        <div class="percentage">{{  $full_data['loss_percentage']}}%</div>
                        <span class="status">
                            <i class="fa-solid {{($full_data['loss_percentage'] > 0) ? 'fa-arrow-up' : 'fa-arrow-down'}}"></i>
                        </span>
                    </div>
                </div>
                <div class="card d-grid align-items-center">
                    <img src="{{ asset('assets/img/insurance.png') }}" alt="company logo">
                    <div class="card-title-area">
                        <div class="card-title">Loan</div>
                        <div class="card-price">
                            <span>USD</span>
                            <span class="amount">{{ number_format($full_data['totalAdminLoanDeposits']) }}</span>
                        </div>
                    </div>
                    <div class="card-status d-flex align-items-center g-4 {{ $full_data['adminLoanPercentage'] > 0 ? 'text-primary' : 'text-danger' }}">
                        <div class="percentage">{{ $full_data['adminLoanPercentage']}}%</div>
                        <span class="status">
                            <i class="fa-solid {{($full_data['adminLoanPercentage'] > 0) ? 'fa-arrow-up' : 'fa-arrow-down'}}"></i>
                        </span>
                    </div>
                </div>
                <div class="card d-grid align-items-center">
                    <img src="{{ asset('assets/img/credit.png') }}" alt="company logo">
                    <div class="card-title-area">
                        <div class="card-title">Credit</div>
                        <div class="card-price">
                            <span>USD</span>
                            <span class="amount">{{ number_format( $full_data['totalAdminCreditDeposits'] ) }}</span>
                        </div>
                    </div>
                    <div class="card-status d-flex align-items-center g-4 {{ $full_data['adminCreditPercentage'] > 0 ? 'text-primary' : 'text-danger' }}">
                        <div class="percentage">{{$full_data['adminCreditPercentage']}}%</div>
                        <span class="status">
                            <i class="fa-solid {{( $full_data['adminCreditPercentage'] > 0) ? 'fa-arrow-up' : 'fa-arrow-down'}}"></i>
                        </span>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs navigation-card-group list-style-none d-grid">
                <li class="nav-item">
                    <a class="card d-grid align-items-center g-8" data-toggle="tab" href="#personal-information">
                        <div class="icon">
                            <i class="fa-regular fa-circle-user"></i>
                        </div>
                        <p>Personal information</p>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="card d-grid align-items-center g-8" data-toggle="tab" href="#account-verification">
                        <div class="icon">
                            <i class="fa-solid fa-fingerprint"></i>
                        </div>
                        <p>Verification</p>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="card d-grid align-items-center g-8" data-toggle="tab" href="#security-settings">
                        <div class="icon">
                            <i class="fa-solid fa-gear"></i>
                        </div>
                        <p>Security settings</p>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="card d-grid align-items-center g-8" href="{{ route('user.trade.index') }}">
                        <div class="icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <p>Trade</p>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="card d-grid align-items-center g-8 live-chat-section" data-toggle="tab" href="#live-chat-section">
                        <div class="icon">
                            <i class="fa-brands fa-rocketchat"></i>
                        </div>
                        <p>Live Chat</p>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>
            </ul>
        </section>
        <section id="personal-information" class="tab-pane in personal-information common-section">
            <div class="back-btn-area">
                <ul class="nav nav-tabs list-style-none">
                    <li class="nav-item d-flex align-items-center g-15">
                        <a class="btn-tab d-flex align-items-center g-15 active" data-toggle="tab"
                            href="#admin-account-grid">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span class="text">Account</span>
                        </a>
                        <p class="section-name d-flex g-15">
                            <span>/</span>
                            <span>Personal Information</span>
                        </p>
                    </li>
                </ul>
            </div>
            @php
                $country_code = $full_data['user_data']->addresses->country;
                $country_name = config('countries.' . $country_code);
                @endphp
            <div class="personal-info-card-area">
                <form action="{{ route('user.personal.info.update') }}" method="POST">
                    @csrf
                    <div class="area-title">personal information</div>
                    <div class="card common-card">
                        <div class="card-body d-grid">
                            <div class="input-group">
                                <label class="form-label">First Name</label>
                                <input class="form-control" type="text" name="first_name"
                                    value="{{ $user_data->first_name }}" placeholder="Enter First Name">
                                @error('f$irst_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label class="form-label">Last Name</label>
                                <input class="form-control" type="text" name="last_name"
                                    value="{{ $user_data->last_name }}" placeholder="Enter Last Name">
                                @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label class="form-label">Email address</label>
                                <input class="form-control" type="email" placeholder="Enter email address" readonly
                                    name="email" value="{{ $user_data->email }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label class="form-label">Phone number</label>
                                <input class="form-control" type="text" placeholder="Enter Phone number"
                                    name="phone" value="{{ $user_data->phone }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label class="form-label">Country</label>
                                <select class="form-control" id="userCountry" searchable="true" name="country">
                                    <option>Select Country</option>
                                    @foreach ($full_data['countries'] as $code => $name)
                                        <option {{ $country_code == $code ? 'selected' : '' }}
                                            value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-update-profile w-max" type="submit">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="profile-picture-card-area">
                <div class="area-title">Profile picture</div>
                <form action="{{ route('user.profile.avatarUpdate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card common-card">
                        <div class="card-body d-grid">
                            <div class="upload-files-container w-100 overflowY-hidden">
                                <div class="drag-file-area align-content-center">
                                    <img id="user-image" class="user-image d-none"
                                        src="https://picsum.photos/300/200?grayscale" alt="">
                                    <label for="upload-dp-input"
                                        class="upload-icon attach-icon mx-auto d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-link"></i>
                                    </label>
                                    <p class="attach-note dynamic-message">
                                        Drop a file here to upload <br> Photo must be 5MB or less
                                    </p>
                                    <label class="label d-none">
                                        <span class="browse-files">
                                            <input id="upload-dp-input" type="file" name="avatar" accept="image/*"
                                                class="default-file-input" />
                                        </span>
                                    </label>
                                </div>
                                <p class="cannot-upload-message">
                                    <strong>Error : </strong> <span> Please select a file first</span>
                                    <span class="cancel-alert-button btn-close">❌</span>
                                </p>

                                <div class="file-block">
                                    <div class="file-info">
                                        <span class="file-name"
                                            style="max-width: 230px; padding-right: 5px; overflow: hidden;"> </span>
                                        | <span class="file-size"> </span>
                                    </div>
                                    <span class="material-icons remove-file-icon">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </span>
                                    <div class="progress-bar"> </div>
                                </div>
                                @error('avatar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <fieldset>
                                <p>Prohibited Pictures:</p>
                                <ul>
                                    <li>Photos explicit or inappropriate nature</li>
                                    <li>Photos involving people younger than 18 years old</li>
                                    <li>Third-party copyrighted protected photos</li>
                                    <li>AI generated photos</li>
                                    <li class="text-danger">Images not in JPG, PNG or GIF</li>
                                    <li>Photos larger than 5MB</li>
                                </ul>
                                <p>Your face must be shown clearly. All photos uploaded must abide by these
                                    guideline or the photo will be removed.</p>
                            </fieldset>
                            {{-- <a type="button" id="dp-upload-btn" class="btn upload-button w-max">Upload picture</a> --}}
                            <button id="dp-upload-btn" class="btn upload-button w-max" type="submit">Upload
                                Picture</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>



        <section id="account-verification" class="tab-pane in account-verification common-section">
            <form action="{{ route('user.save.kyc') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="back-btn-area">
                    <ul class="nav nav-tabs list-style-none">
                        <li class="nav-item d-flex align-items-center g-15">
                            <a class="btn-tab d-flex align-items-center g-15" data-toggle="tab"
                                href="#admin-account-grid">
                                <i class="fa-solid fa-arrow-left"></i>
                                <span class="text">Account</span>
                            </a>
                            <p class="section-name d-flex g-15">
                                <span>/</span>
                                <span>Verification</span>
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="area-title d-flex justify-content-between">
                    <h3>Identification</h3>
                    <p class="verification-status d-flex align-items-center g-5">
                        <!-- use $('.verification-status').attr "verified" for verify -->
                        <span class="icon d-flex justify-content-center align-items-center"><i
                                class="fa-solid fa-check"></i></span>
                        <span class="status-text">{{ $full_data['user_verifications']->kyc_verify_status }}</span>
                    </p>
                </div>
                <div class="card common-card">
                    <div class="card-header">
                        <div class="card-title">Profile Status:
                            {{ ucfirst($full_data['user_verifications']->kyc_verify_status) }}</div>
                    </div>
                    <div class="card-body d-grid">
                        <div class="input-group">
                            <label class="form-label">Identity Card Type</label>
                            <select class="form-control" id="identity-card-type"  name="kyc_type">
                                @foreach(config('settingkeys.kyc_type') as $key => $value)
                                <option value="{{ $key }} ">{{ $value }}</option>
                            @endforeach
                            
                            </select>
                        </div>
                        <div></div>
                        <!-- Upload ID Front -->
                        <div class="input-group attach-file-input-group">
                            <label class="form-label">Upload ID Front</label>
                            <div class="form-control">
                                <label for="identification-front-id"
                                    class="attach-icon d-flex justify-content-between align-items-center w-100">
                                    <span type="placeholder">Upload ID card Front</span>
                                    <input id="identification-front-id" class="d-none"
                                        name="{{ config('settingkeys.kyc_id_front') }}" type="file">
                                    <i class="fa-solid fa-link"></i>
                                </label>
                            </div>
                            {{-- @if ($full_data['userVerifiedStatus']['kyc_id_front'] == 2)
                                <p style="color: red; font-size: 16px; margin-top: 20px; font-weight: bold;">Please upload again</p>
                            @elseif ($full_data['userVerifiedStatus']['kyc_id_front'] == 3)
                                <p style="color: green; font-size: 16px; margin-top: 20px; font-weight: bold;">Document verified</p>
                            @endif --}}
                        </div>
                    
                        <!-- Upload ID Back -->
                        <div class="input-group attach-file-input-group">
                            <label class="form-label">Upload ID Back</label>
                            <div class="form-control">
                                <label for="identification-back-id"
                                    class="attach-icon d-flex justify-content-between align-items-center w-100">
                                    <span type="placeholder">Upload ID card Back</span>
                                    <input id="identification-back-id" class="d-none"
                                        name="{{ config('settingkeys.kyc_id_back') }}" type="file">
                                    <i class="fa-solid fa-link"></i>
                                </label>
                            </div>
                            {{-- @if ($full_data['userVerifiedStatus']['kyc_id_back'] == 2)
                                <p style="color: red; font-size: 16px; margin-top: 10px; font-weight: bold;">Please upload again</p>
                            @elseif ($full_data['userVerifiedStatus']['kyc_id_back'] == 3)
                                <p style="color: green; font-size: 16px; margin-top: 10px; font-weight: bold;">Document verified</p>
                            @endif --}}
                        </div>
                    
                        <!-- Upload Proof Of Address -->
                        <div class="input-group attach-file-input-group">
                            <label class="form-label">Upload Proof Of Address</label>
                            <div class="form-control">
                                <label for="user-proof-of-address"
                                    class="attach-icon d-flex justify-content-between align-items-center w-100">
                                    <span type="placeholder">Upload Proof Of Address</span>
                                    <input id="user-proof-of-address" class="d-none"
                                        name="{{ config('settingkeys.kyc_address_proof') }}" type="file">
                                    <i class="fa-solid fa-link"></i>
                                </label>
                            </div>
                            {{-- @if ($full_data['userVerifiedStatus']['kyc_address_proof'] == 2)
                                <p style="color: red; font-size: 16px; margin-top: 20px; font-weight: bold;">Please upload again</p>
                            @elseif ($full_data['userVerifiedStatus']['kyc_address_proof'] == 3)
                                <p style="color: green; font-size: 16px; margin-top: 20px; font-weight: bold;">Document verified</p>
                            @endif --}}
                        </div>
                    
                        <!-- Upload Selfie -->
                        <div class="input-group attach-file-input-group">
                            <label class="form-label">Upload Selfie</label>
                            <div class="form-control">
                                <label for="attach-user-selfie"
                                    class="attach-icon d-flex justify-content-between align-items-center w-100">
                                    <span type="placeholder">Upload Selfie</span>
                                    <input id="attach-user-selfie" class="d-none" type="file"
                                        name="{{ config('settingkeys.kyc_selfie_proof') }}" accept="image/*" capture="environment">
                                    <i class="fa-solid fa-camera"></i>
                                </label>
                            </div>
                            {{-- @if ($full_data['userVerifiedStatus']['kyc_selfie_proof'] == 2)
                                <p style="color: red; font-size: 16px; margin-top: 20px; font-weight: bold;">Please upload again</p>
                            @elseif ($full_data['userVerifiedStatus']['kyc_selfie_proof'] == 3)
                                <p style="color: green; font-size: 16px; margin-top: 20px; font-weight: bold;">Document verified</p>
                            @endif --}}
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-submit-identification w-max">Submit identification</button>
                    </div>
                </div>
                <div class="card common-card">
                    <div class="card-header">
                        <div class="card-title">Documents Uploaded and Confirmed</div>
                    </div>
                    <div class="card-footer check-files-valid-grid d-grid">
                        <div class="card d-flex justify-content-between align-items-center">
                            <p>ID Front</p>
                            <p class="document-verification-status d-flex justify-content-center align-items-center g-5"
                                @if ($full_data['userVerifiedStatus']['kyc_id_front'] == 3) verified @endif>
                                <span class="icon d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </p>

                        </div>
                        <div class="card d-flex justify-content-between align-items-center">
                            <p>ID Back</p>
                            <p class="document-verification-status d-flex justify-content-center align-items-center g-5"
                                @if ($full_data['userVerifiedStatus']['kyc_id_back'] == 3) verified @endif>
                                <span class="icon d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </p>
                        </div>
                        <div class="card d-flex justify-content-between align-items-center">
                            <p>proof of address</p>
                            <p class="document-verification-status d-flex justify-content-center align-items-center g-5"
                                @if ($full_data['userVerifiedStatus']['kyc_address_proof'] == 3) verified @endif>
                                <span class="icon d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </p>
                        </div>
                        <div class="card d-flex justify-content-between align-items-center">
                            <p>upload selfie</p>
                            <p class="document-verification-status d-flex justify-content-center align-items-center g-5"
                                @if ($full_data['userVerifiedStatus']['kyc_selfie_proof'] == 3) verified @endif>
                                <span class="icon d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </section>


        <section id="security-settings" class="tab-pane common-section in security-settings">
            <div class="back-btn-area">
                <ul class="nav nav-tabs list-style-none">
                    <li class="nav-item d-flex align-items-center g-15">
                        <a class="btn-tab d-flex align-items-center g-15" data-toggle="tab" href="#admin-account-grid">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span class="text">Account</span>
                        </a>
                        <p class="section-name d-flex g-15">
                            <span>/</span>
                            <span>Settings</span>
                        </p>
                    </li>
                </ul>
            </div>
            <div class="area-title">Change Password</div>
            <form action="{{ route('user.profile.updatePassword') }}" method="POST">
                @csrf
                <div class="card common-card">
                    <div class="card-body d-grid">
                        <div class="input-group">
                            <label class="form-label">new Password</label>
                            <input class="form-control form-eye" type="password" name="password" id="set-new-password"
                                placeholder="Enter password">
                            <label for="set-new-password" class="eye-icon">
                                <i class="fa-regular fa-eye-slash"></i>
                            </label>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label class="form-label">Re-type Password</label>
                            <input class="form-control form-eye" type="password" name="confirmation_password"
                                id="set-new-password-retype" placeholder="Enter password">
                            <label for="set-new-password-retype" class="eye-icon">
                                <i class="fa-regular fa-eye-slash"></i>
                            </label>
                        </div>
                        @error('confirmation_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-update-password w-max">Update password</button>
                    </div>
                </div>
            </form>
            <div class="area-title">Language and Currency</div>
            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                <div class="card common-card">
                    <div class="card-body d-grid">
                        <div class="input-group">
                            <label class="form-label">Currency</label>
                            <select class="form-control" name="dashboard_currency" searchable="true"
                                id="dashboard-currency">
                                @foreach ($full_data['currencies'] as $code => $name)
                                    <option value="{{ $code }}"
                                        {{ isset($full_data['setting_info']['dashboard_currency']) && $full_data['setting_info']['dashboard_currency'] == $code ? 'selected' : '' }}>
                                        {{ $code }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group">
                            <label class="form-label">Profile Language</label>
                            <select class="form-control" name="profile_language" searchable="true"
                                id="profile-language">
                                @foreach ($full_data['languages'] as $code => $name)
                                    <option
                                        {{ isset($full_data['setting_info']['profile_language']) && $full_data['setting_info']['profile_language'] == $code ? 'selected' : '' }}
                                        value="{{ $code }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-update-lang-currancy w-max">Save changes</button>
                    </div>
                </div>
            </form>

            <div class="area-title">Activate Two Factor (2FA) Authentication</div>
            <div class="card common-card card-2fa">
                <div class="card-body d-grid">
                    <div class="input-group-area d-flex flex-column justify-content-between">
                        <div class="input-group">
                            <label class="form-label">Activation code for Google Authentication</label>
                            <input class="form-control form-clone" type="text" id="activation-code-for-auth"
                                placeholder="Activation code">
                            <label for="activation-code-for-auth" class="form-icon clone-icon">
                                <i class="fa-regular fa-clone"></i>
                            </label>
                        </div>
                        <div class="input-group">
                            <label class="form-label">Activate Authenticator and enter generated code in field
                                below</label>
                            <input class="form-control" type="text" id="generated-qr-code"
                                placeholder="enter code here">
                        </div>
                    </div>
                    <div class="qr-code-area">
                        <div class="input-group">
                            <label class="form-label">QR Code</label>
                            <img class="img-qr-code" src="../assets/img/dev-qr-code.png" alt="qr-code">
                        </div>
                    </div>
                    <a href="" class="btn btn-activation-2fa w-max">Activate 2FA Protection</a>
                </div>
            </div>
        </section>
        <!-- <section id="live-chat-section" class="tab-pane common-section in live-chat-section">
            <div class="back-btn-area">
                <ul class="nav nav-tabs list-style-none">
                    <li class="nav-item d-flex align-items-center g-15">
                        <a class="btn-tab d-flex align-items-center g-15" data-toggle="tab" href="#admin-account-grid">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span class="text">Account</span>
                        </a>
                        <p class="section-name d-flex g-15">
                            <span>/</span>
                            <span>Live chat</span>
                        </p>
                    </li>
                </ul>
            </div>
            <div class="card d-grid scroll">
                <div id="chat-body" class="card-body chat-body d-flex flex-column align-items-start w-100 g-20">
                    <div class="admin-text-box d-flex align-items-start g-8">
                        <div class="icon-area d-flex justify-content-center align-items-center">
                            <img class="admin-icon" src="../assets/img/site-logo.png" alt="admin name">
                        </div>
                        <p class="message">Hello! How can i help you today?</p>
                    </div>
                    <div class="user-text-box d-flex align-items-start g-8">
                        <p class="message">I want to make an enquiry about the account plans.</p>
                        <div class="icon-area d-flex justify-content-center align-items-center">
                            <img class="user-icon" src="../assets/img/site-logo.png" alt="user name">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="input-group live-chat-input-group">
                        <input class="form-control" type="text" id="live-chat-input"
                            placeholder="Type your message here" autocomplete="off" autofocus>
                        <a id="send-message" class="form-icon">
                            <i class="fa-regular fa-paper-plane"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section> -->

    </article>
@endsection
