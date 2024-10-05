<nav id="left-nav" class="left-nav">
    <a href="{{ asset('admin/dashboard') }}" class="logo-area">
        <img src="{{ asset('assets') }}/img/site-logo.png" alt="Site Logo" class="site-logo">
        <span class="site-name">Only-brokerage</span>
    </a>
    <ul class="nav-menu list-style-none scroll">
        <li>
            <a class="{{ Request::url() == route('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <span class="icon">
                    <img src="{{ asset('assets') }}/img/icon-menu-category.png">
                </span>
                <span class="name">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="{{ Request::url() == route('admin.user.index') ? 'active' : '' }}" href="{{ route('admin.user.index') }}">
                <span class="icon">
                    <i class="fa-regular fa-circle-user"></i>
                </span>
                <span class="name">Manage Users</span>
            </a>
        </li>
        {{-- <li>
            <a class="{{ Request::url() == route('admin.identyVerification.index') ? 'active' : '' }}" href="{{ route('admin.identyVerification.index') }}">
                <span class="icon">
                    <i class="fa-regular fa-credit-card"></i>
                </span>
                <span class="name">Identy Verification</span>
            </a>
        </li> --}}
        <li>
            <a class="{{ Request::url() == route('admin.deposit.index') ? 'active' : '' }}" href="{{ route('admin.deposit.index') }}">
                <span class="icon">
                    <i class="fa-regular fa-credit-card"></i>
                </span>
                <span class="name">Deposits</span>
            </a>
        </li>
        <li>
            <a class="{{ Request::url() == route('admin.withdraw.index') ? 'active' : '' }}" href="{{ route('admin.withdraw.index') }}">
                <span class="icon">
                    <i class="fa-solid fa-landmark"></i>
                </span>
                <span class="name">Withdrawals</span>
            </a>
        </li>
        
        <li>
            <a class="{{ Request::url() == route('admin.trades') ? 'active' : '' }}" href="{{ route('admin.trades') }}">
                <span class="icon">
                    <i class="fa-solid fa-chart-line"></i>
                </span>
                <span class="name">Trades</span>
            </a>
        </li>
        <li>
        <a class="{{ Request::url() == route('admin.assets') ? 'active' : '' }}" href="{{ route('admin.assets') }}">
                <span class="icon">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </span>
                <span class="name">Assets</span>
            </a>
        </li>
        <li>
        <a class="{{ Request::url() == route('admin.software') ? 'active' : '' }}" href="{{ route('admin.software') }}">
                <span class="icon">
                    <i class="fa-solid fa-server"></i>
                </span>
                <span class="name">Softwares</span>
            </a>
        </li>
        <li>
        <a class="{{ Request::url() == route('admin.general.settings') ? 'active' : '' }}" href="{{ route('admin.general.settings') }}">
                <span class="icon">
                    <i class="fa-solid fa-gear"></i>
                </span>
                <span class="name">Settings</span>
            </a>
        </li>
        <li>
            <a class="" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
                <span class="icon">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </span>
                <span class="name">Log Out</span>
            </a>
        </li>
    </ul>
</nav>
