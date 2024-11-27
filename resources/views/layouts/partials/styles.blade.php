<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Only-brokerage | Home Page </title>
<link rel="icon" href="{{ asset('assets') }}/img/site-favicon-only-brokerage.png">
<meta name="description" content="Open up a world of possibilities with Only Brokerage">
<meta name="keywords" content="Investments, Only Brokerage, trade">
<meta name="csrf-token" content="{{ csrf_token() }}">

@yield('styles')

<!-- style added here ================ -->
<link rel="stylesheet" href="{{ asset('assets/css/site-common.css') }}?v={{ env('SITE_CSS_JS_VERSION') }}">
<link rel="stylesheet" href="{{ asset('assets/css/site-layout.css') }}?v={{ env('SITE_CSS_JS_VERSION') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ env('SITE_CSS_JS_VERSION') }}">


@if (Route::currentRouteName() === 'home' || Route::currentRouteName() === 'frontend.index')
<link rel="stylesheet" href="{{ asset('assets/css/mystyle.css?v=' . env('SITE_CSS_JS_VERSION')) }}">
@endif

<!-- font added here (ital + Merriweather) ================ -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">


<!-- font-awesome added here ================ -->
<link rel="stylesheet" href="{{ asset('assets') }}/font-awesome-6.6.6-web/css/all.min.css">

<script src="{{ env('TIDO_APP_JS') ?? '' }}" async></script>

<script>
    var apiUrlCrypto = "{{ url('/crypto.json') }}";
    var apiUrlForex = "{{ url('/forex.json') }}";
    var apiUrlIndices = "{{ url('/indices.json') }}";
    var apiUrlStocks = "{{ url('/stocks.json') }}";
    var apiUrlFutures = "{{ url('/futures.json') }}";
    var apiUrletfs = "{{ url('/etfs.json') }}";
    const countries = [
        "Luxembourg",
        "Switzerland",
        "Ireland",
        "Norway",
        "Qatar",
        "Iceland",
        "United States",
        "Denmark",
        "Singapore",
        "Australia",
        "Sweden",
        "Netherlands",
        "Austria",
        "Finland",
        "Germany",
        "Canada",
        "Belgium",
        "United Arab Emirates",
        "New Zealand",
        "Japan"
    ];
</script>

<!-- jQuery added here ================ -->
<script src="{{ asset('assets') }}/jQuery/jquery-3.7.1.min.js"></script>
