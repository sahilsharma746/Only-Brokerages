@extends('admin.layouts.app_admin')
@section('content')
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
                    <span>{{ $user->first_name }} {{ $user->last_name }}</span>
                </div>
                <a href="" class="btn">Log in As User</a>
            </div>

            <section class="user-info-form">
                <div class="section-title">Edit Balance</div>
                <form action="{{ route('admin.user.updateBalance', $user->id) }}" method="POST">
                    @csrf
                    <div class="card common-card">
                        <div class="card-body">
                            <div class="input-group">
                                <label class="form-label" for="amount">Amount</label>
                                <input class="form-control" type="number" placeholder="Enter amount" name="amount" value="{{ old('amount') }}">
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label class="form-label" for="type">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option {{ old('type') == 'admin_credit' ? 'selected' : '' }} value="admin_credit">Credit</option>
                                    <option {{ old('type') == 'admin_loan' ? 'selected' : '' }} value="admin_loan">Loan</option>
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="form-label">Remark</label>
                            <textarea class="form-control" name="remark" rows="4" placeholder="Enter Remark Yet" style="height: 150px"></textarea>
                        </div>
                        <br>
                        <button type="submit" class="btn border-0">Add Balance</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
@endsection
