<ul class="list-style-none">
    <li><a href="{{ route('admin.user.index') }}" class="btn {{ Request::url() == route('admin.user.index') ? 'active' : '' }}">all users</a></li>
    <li><a href="{{ route('admin.user.activeUsers') }}" class="btn {{ Request::url() == route('admin.user.activeUsers') ? 'active' : '' }}">Active Users</a></li>
    <li><a href="{{ route('admin.user.kycUnverified') }}" class="btn {{ Request::url() == route('admin.user.kycUnverified') ? 'active' : '' }}">KYC Unverified</a></li>
    <li><a href="{{ route('admin.user.kycVerified') }}" class="btn {{ Request::url() == route('admin.user.kycVerified') ? 'active' : '' }}">KYC Verified</a></li>
    <li><a href="{{ route('admin.user.emailVerified') }}" class="btn {{ Request::url() == route('admin.user.emailVerified') ? 'active' : '' }}">Email Verified</a></li>
    <li><a href="{{ route('admin.user.phoneVerified') }}" class="btn {{ Request::url() == route('admin.user.phoneVerified') ? 'active' : '' }}">Phone Verified</a></li>
    <li><a href="{{ route('admin.user.bannedVerified') }}" class="btn {{ Request::url() == route('admin.user.bannedVerified') ? 'active' : '' }}">Banned Users</a></li>
    <li><a href="{{ route('admin.user.deletedUsers') }}" class="btn {{ Request::url() == route('admin.user.deletedUsers') ? 'active' : '' }}">Deleted Users</a></li>
</ul>
