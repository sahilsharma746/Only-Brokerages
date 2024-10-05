<!DOCTYPE html>
<html lang="en" mode="black">

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
