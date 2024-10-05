@extends('users.layouts.app_user')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets') }}/css/user-dashboard.css">
@endsection
@section('content')
    <article class="tab-content trade-article">
        <section id="security-settings" class="tab-pane common-section in active security-settings">
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
                            <select class="form-control" name="dashboard_currency" id="dashboard-currency">
                                <option value="USD">Dollar (USD)</option>
                                <option value="BDT">Taka (BDT)</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label class="form-label">Profile Language</label>
                            <select class="form-control" name="profile_language" id="profile-language">
                                <option value="Arabic">Arabic</option>
                                <option value="English">English</option>
                                <option value="Bangla">Bangla</option>
                                <option value="Hindi">Hindi</option>
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
                            <input class="form-control" type="text" id="generated-qr-code" placeholder="enter code here">
                        </div>
                    </div>
                    <div class="qr-code-area">
                        <div class="input-group">
                            <label class="form-label">QR Code</label>
                            <img class="img-qr-code" src="{{ asset('assets') }}/img/dev-qr-code.png" alt="qr-code">
                        </div>
                    </div>
                    <a href="" class="btn btn-activation-2fa w-max">Activate 2FA Protection</a>
                </div>
            </div>
        </section>



    </article>
@endsection

@section('scripts')
    <script src="{{ asset('assets') }}/js/user-dashboard.js"></script>
@endsection
