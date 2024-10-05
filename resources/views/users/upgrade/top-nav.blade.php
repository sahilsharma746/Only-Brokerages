<ul class="nav navigation-card-group list-style-none d-flex w-100 scroll">
    <li class="nav-item d-flex">
        <a class="card {{ Request::url() == route('user.deposit.getway') ? 'active' : '' }}" href="{{ route('user.deposit.getway') }}">
            <p>Deposit</p>
        </a>
    </li>
    <li class="nav-item d-flex">
        <a class="card {{ Request::url() == route('user.withdraw.index') ? 'active' : '' }}" href="{{ route('user.withdraw.index') }}">
            <p>Withdraw</p>
        </a>
    </li>
    <li class="nav-item d-flex">
        <a class="card" href="{{ route('user.trade.index') }}">
            <p>Trade</p>
        </a>
    </li>
    <li class="nav-item d-flex">
        <a class="card {{ Request::url() == route('users.trading-history.index') ? 'active' : '' }}" href="{{ route('users.trading-history.index') }}">
            <p>Trading History</p>
        </a>
    </li>
    <li class="nav-item d-flex">
        <a class="card {{ Request::url() == route('users.trading-bots.index') ? 'active' : '' }}" href="{{ route('users.trading-bots.index') }}">
            <p>Tradings Bots</p>
        </a>
    </li>
    <li class="nav-item d-flex">
        <a class="card" href="{{ route('user.dashboard') }}">
            <p>Account</p>
        </a>
    </li>
    <li class="nav-item d-flex">
        <a class="card" href="{{ route('user.marketWatch.index') }}">
            <p>Market Watch</p>
        </a>
    </li>
    <li class="nav-item d-flex">
        <a class="card" href="#">
            <p>Education</p>
        </a>
    </li>
    <li class="nav-item d-flex">
        <a class="card {{ Request::url() == route('user.upgrade.index') ? 'active' : '' }}" href="{{ route('user.upgrade.index') }}">
            <p>Upgrade</p>
        </a>
    </li>
    <li class="nav-item d-flex">
        <a class="card" href="#">
            <p>Payment Settings</p>
        </a>
    </li>
</ul>
