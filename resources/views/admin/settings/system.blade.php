@extends('admin.layouts.app_admin')
@section('content')
<main class="main-area">
        <div class="container admin-settings-container">
            <section class="user-filter-section">
                <ul class="list-style-none">
                    <li><a href="{{ route('admin.general.settings') }}" class="btn">General Settings</a></li>
                    <li><a href="{{ route('admin.system.settings') }}" class="btn active">System Settings</a></li>
                </ul>
            </section>

            <div class="section-title">System Settings</div>
            <section class="admin-system-settings-section">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">User Registration</div>
                        <p class="card-text">If you disable this module, no one can register on this system.</p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-enabled">Enabled</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Force SSL</div>
                        <p class="card-text">By enabling Force SSL (Secure Sockets Layer) the system will force a
                            visitor that he/she must have to visit in secure
                            mode. Otherwise, the site will be loaded in secure mode.</p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-disabled">Disabled</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Agree Policy</div>
                        <p class="card-text">If you enable this module, that means a user must have to agree with your
                            system's policies during registration.</p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-enabled">Enabled</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Force Secure Password</div>
                        <p class="card-text">By enabling this module, a user must set a secure password while signing up
                            or changing the password.</p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-enabled">Enabled</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">KYC Verification</div>
                        <p class="card-text">If you enable KYC (Know Your Client) module, users must have to submit the
                            required data. Otherwise, any money out
                            transaction will be prevented by this system.</p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-enabled">Enabled</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Email Verification</div>
                        <p class="card-text">If you enable Email Verification, users have to verify their email to
                            access the dashboard. A 6-digit verification code
                            will be sent to their email to be verified. </p>
                        <p class="card-text"><i>Note: Make sure that the Email
                                Notification module is enabled</i></p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-enabled">Enabled</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Email Notification</div>
                        <p class="card-text">If you enable this module, the system will send emails to users where
                            needed. Otherwise, no email will be sent. </p>
                        <p class="card-text text-danger">
                            <code>So be sure before disabling this module that, the system doesn't need to send any emails.</code>
                        </p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-disabled">Disabled</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Mobile Verification</div>
                        <p class="card-text">If you enable Mobile Verification, users have to verify their mobile to
                            access the dashboard. A 6-digit verification
                            code will be sent to their mobile to be verified</p>
                        <p class="card-text"><i>Note: Make sure that the SMS Notification module is enabled</i></p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-disabled">Disabled</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">SMS Notification</div>
                        <p class="card-text">If you enable this module, the system will send SMS to users where needed.
                            Otherwise, no SMS will be sent. </p>
                        <p class="card-text text-danger">
                            <code>So be sure before disabling this module that, the system doesn't need to send any SMS.</code>
                        </p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-disabled">Disabled</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Push Notification</div>
                        <p class="card-text">If you enable this module, the system will send push notifications to
                            users. Otherwise, no push notification will be
                            sent.</p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-enabled">Enabled</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Language Option</div>
                        <p class="card-text">If you enable this module, users can change the language according to their
                            needs.</p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-disabled">Disabled</a>
                    </div>
                </div>
            </section>

        </div>
    </main>
@endsection