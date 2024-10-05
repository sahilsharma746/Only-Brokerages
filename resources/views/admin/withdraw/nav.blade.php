<ul class="list-style-none">
    <li><a href="{{ route('admin.withdraw.index') }}" class="btn {{ Request::url() == route('admin.withdraw.index') ? 'active' : '' }}">All Withdraw</a></li>
    <li><a href="{{ route('admin.withdraw.pending') }}" class="btn {{ Request::url() == route('admin.withdraw.pending') ? 'active' : '' }}">Pending Withdraw</a></li>
    <li><a href="{{ route('admin.withdraw.approved') }}" class="btn {{ Request::url() == route('admin.withdraw.approved') ? 'active' : '' }}">Approved Withdraw</a></li>
    <li><a href="{{ route('admin.withdraw.rejected') }}" class="btn {{ Request::url() == route('admin.withdraw.rejected') ? 'active' : '' }}">Rejected Withdraw</a></li>
</ul>
