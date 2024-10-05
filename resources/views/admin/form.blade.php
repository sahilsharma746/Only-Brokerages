@extends('admin.layouts.app_admin')
@section('content')
    <main class="main-area">
        <div class="container user-details-container">
            <div class="partial-view-header">
                <div class="back-btn-area">
                    <a href="./manage-user.html">
                        <span class="icon">
                            <i class="fa-solid fa-arrow-left"></i>
                        </span>
                        <span>Manage Users</span>
                    </a>
                    <span>/</span>
                    <span>Michael Michaelson</span>
                </div>
                <a href="" class="btn">Log in As User</a>
            </div>

            <section class="user-preview-section">
                <div class="section-article">
                    <a href="" class="card">
                        <div class="card-icon">
                            <img src="../assets/img/admin-icon-money.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Balance</div>
                            <div class="card-value">$ 150,000</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                    <a href="" class="card">
                        <div class="card-icon">
                            <img src="../assets/img/admin-icon-card.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Deposit</div>
                            <div class="card-value">$ 100,000</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                    <a href="" class="card">
                        <div class="card-icon">
                            <img src="../assets/img/admin-icon-withdraw.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Withdrawals</div>
                            <div class="card-value">$ 75,000</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                    <a href="" class="card">
                        <div class="card-icon">
                            <img src="../assets/img/admin-icon-sorting.png">
                        </div>
                        <div class="card-body">
                            <div class="card-title">Transactions</div>
                            <div class="card-value">124</div>
                        </div>
                        <span class="arrow-icon">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </a>
                </div>
                <div class="section-article user-controllers">
                    <a class="btn btn-primary">
                        <span class="icon border-rounded"><i class="fa-solid fa-plus"></i></span>
                        <span class="text">Add Balance</span>
                    </a>
                    <a class="btn btn-danger">
                        <span class="icon border-rounded"><i class="fa-solid fa-minus"></i></span>
                        <span class="text">Subtract Balance</span>
                    </a>
                    <a class="btn btn-info">
                        <span class="icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                        <span class="text">Log In History</span>
                    </a>
                    <a class="btn btn-warning">
                        <span class="icon"><i class="fa-solid fa-ban"></i></span>
                        <span class="text">Ban User</span>
                    </a>
                </div>
            </section>
            <section class="user-info-form">
                <div class="section-title">User Information</div>
                <div class="card common-card">
                    <div class="card-body">
                        <div class="input-group">
                            <label class="form-label">First Name</label>
                            <input class="form-control" type="text" placeholder="Enter First Name">
                        </div>
                        <div class="input-group">
                            <label class="form-label">Last Name</label>
                            <input class="form-control" type="text" placeholder="Enter Last Name">
                        </div>
                        <div class="input-group">
                            <label class="form-label">Email address</label>
                            <input class="form-control" type="email" placeholder="Enter email address">
                        </div>
                        <div class="input-group">
                            <label class="form-label">Phone number</label>
                            <input class="form-control" type="text" placeholder="Enter Phone number">
                        </div>
                        <div class="input-group">
                            <label class="form-label">Country</label>
                            <input class="form-control" type="text" placeholder="Enter Country">
                        </div>
                        <div class="input-group">
                            <label class="form-label">State</label>
                            <input class="form-control" type="text" placeholder="Enter State">
                        </div>
                        <div class="input-group">
                            <label class="form-label">City</label>
                            <input class="form-control" type="text" placeholder="Enter City">
                        </div>
                        <div class="input-group">
                            <label class="form-label">Address</label>
                            <input class="form-control" type="text" placeholder="Enter Address">
                        </div>
                    </div>
                </div>
                <br>
                <div class="section-title">Verification Status</div>
                <div class="card check-files-valid-area">
                    <div class="card-header">
                        <div class="verified-qty">1/4 Verified</div>
                    </div>
                    <div class="card-body check-files-valid-grid d-grid">
                        <div class="card d-flex justify-content-between align-items-center">
                            <p>Email</p>
                            <p class="document-verification-status d-flex justify-content-center align-items-center g-5"
                                verified>
                                <!-- use $('.verification-status').attr "verified" for verify -->
                                <span class="icon d-flex justify-content-center align-items-center"><i
                                        class="fa-solid fa-check"></i></span>
                            </p>
                        </div>
                        <div class="card d-flex justify-content-between align-items-center">
                            <p>Phone number</p>
                            <p class="document-verification-status d-flex justify-content-center align-items-center g-5">
                                <!-- use $('.verification-status').attr "verified" for verify -->
                                <span class="icon d-flex justify-content-center align-items-center"><i
                                        class="fa-solid fa-check"></i></span>
                            </p>
                        </div>
                        <div class="card d-flex justify-content-between align-items-center">
                            <p>2FA Verification/p>
                            <p class="document-verification-status d-flex justify-content-center align-items-center g-5">
                                <!-- use $('.verification-status').attr "verified" for verify -->
                                <span class="icon d-flex justify-content-center align-items-center"><i
                                        class="fa-solid fa-check"></i></span>
                            </p>
                        </div>
                        <div class="card d-flex justify-content-between align-items-center">
                            <p>KYC</p>
                            <p class="document-verification-status d-flex justify-content-center align-items-center g-5">
                                <!-- use $('.verification-status').attr "verified" for verify -->
                                <span class="icon d-flex justify-content-center align-items-center"><i
                                        class="fa-solid fa-check"></i></span>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
