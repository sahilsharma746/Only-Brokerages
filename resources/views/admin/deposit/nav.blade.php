<ul class="list-style-none">
    <li><a href="{{ route('admin.deposit.index') }}" class="btn {{ Request::url() == route('admin.deposit.index') ? 'active' : '' }}">All Deposits</a></li>
    <li><a href="{{ route('admin.deposit.pending') }}" class="btn {{ Request::url() == route('admin.deposit.pending') ? 'active' : '' }}">Pending Deposits</a></li>
    <li><a href="{{ route('admin.deposit.approved') }}" class="btn {{ Request::url() == route('admin.deposit.approved') ? 'active' : '' }}">Approved Deposits</a></li>
    <li><a href="{{ route('admin.deposit.rejected') }}" class="btn {{ Request::url() == route('admin.deposit.rejected') ? 'active' : '' }}">Rejected Deposits</a></li>
</ul>
