<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.styles')

</head>
<body>
    @include('layouts.partials.header')
    @yield('content')
    @include('layouts.partials.footer')


    @include('layouts.partials.scripts')

</body>

</html>
