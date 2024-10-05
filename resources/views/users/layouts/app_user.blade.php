@include('users.layouts.partials.header')
<main>
    @include('users.layouts.partials.sidebar-nav')
    @yield('content')
</main>
@include('users.layouts.partials.footer')
