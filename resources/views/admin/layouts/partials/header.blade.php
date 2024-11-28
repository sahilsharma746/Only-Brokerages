<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(isset($page_title))
        <title>Admin | {{ $page_title }}</title>
    @else
        <title>Only-brokerage | Admin</title>
    @endif
    <link rel="icon" href="{{ asset('assets') }}/img/site-favicon-only-brokerage.png">
    <meta name="description" content="Open up a world of possibilities with Only Brokerage">
    <meta name="keywords" content="Investments, Only Brokerage, trade">
    <meta name="robots" content="noindex, nofollow">

    <link rel="stylesheet" href="{{ asset('assets') }}/nice-select-2/nice-select2.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/font-awesome-6.6.6-web/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/data-table-2.1.4/dataTables.dataTables.css">
    
    <link rel="stylesheet" href="{{ asset('assets') }}/css/admin-layout.css?v={{ env('SITE_CSS_JS_VERSION') }}">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/admin-style.css?v={{ env('SITE_CSS_JS_VERSION') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        var apiUrlCrypto = "{{ url('/crypto.json') }}";
        var apiUrlForex = "{{ url('/forex.json') }}";
        var apiUrlIndices = "{{ url('/indices.json') }}";
        var apiUrlStocks = "{{ url('/stocks.json') }}";
        var apiUrlFutures = "{{ url('/futures.json') }}";
        var apiUrletfs = "{{ url('/etfs.json') }}";
        var urlSaveSoftware = "{{ route('admin.software.save') }}";
        var urlUpdateTradingBot = "{{ route("admin.software.update") }}";
        var urlEditTradingBot = "{{ route("admin.edit.bot.info") }}";
        var enableDisableTradingBot = "{{ route("admin.software.enable-disable") }}";

        @if(isset($full_data['user_data']) && isset($full_data['user_data']->id))
            var upgradePromptUrl = "{{ route('admin.user.upgradeprompt', $full_data['user_data']->id) }}";
            var DeletePromptUrl = "{{ route('admin.user.RemovePrompt', $full_data['user_data']->id) }}";
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
        @endif

    </script>
    <script src="{{ asset('assets') }}/jQuery/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('assets/js/admin-head-foot.js') }}?v={{ env('SITE_CSS_JS_VERSION') }}"></script>
    <script src="{{ asset('assets') }}/data-table-2.1.4/dataTables.js"></script>

    <style>
        .form-control::placeholder {
            color: #aaa !important;
        }

        .form-control {
            color: #000 !important;
        }

        .text-dagner{
            color: red !important;
        }
    </style>
    @yield('styles')
</head>

<body>
    @include('admin.layouts.partials.sidebar')
    <header class="top-header">
        <div class="container">
            <h1 class="page-title">Overview</h1>
            <a id="btn-nav-toggle" class="btn-nav-toggle">
                <i class="fa-solid fa-bars"></i>
            </a>
            <div class="dropdown w-max">
                <a class="btn btn-admin-dropdown">
                    <span class="icon">
                        <img src="{{ asset('assets') }}/img/avatar.png" alt="{{ auth()->user()->name }}">
                    </span>
                    <span>{{ $user_data->first_name  . ' '. $user_data->last_name }}</span>
                    <i class="fa-solid fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu d-flex flex-column">
                    <li class="dropdown-item">
                        <a href="javascript:void(0)">
                            <span class="icon"><svg class="svg-inline--fa fa-circle-user" aria-hidden="true" focusable="false" data-prefix="far" data-icon="circle-user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M406.5 399.6C387.4 352.9 341.5 320 288 320l-64 0c-53.5 0-99.4 32.9-118.5 79.6C69.9 362.2 48 311.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208c0 55.7-21.9 106.2-57.5 143.6zm-40.1 32.7C334.4 452.4 296.6 464 256 464s-78.4-11.6-110.5-31.7c7.3-36.7 39.7-64.3 78.5-64.3l64 0c38.8 0 71.2 27.6 78.5 64.3zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-272a40 40 0 1 1 0-80 40 40 0 1 1 0 80zm-88-40a88 88 0 1 0 176 0 88 88 0 1 0 -176 0z"></path></svg><!-- <i class="fa-regular fa-circle-user"></i> Font Awesome fontawesome.com --></span>
                            <span class="text">Profile</span>
                        </a>
                    </li>
                    {{-- <li class="dropdown-item">
                        <a href="javascript:void(0)">
                            <span class="icon"><svg class="svg-inline--fa fa-bell" aria-hidden="true" focusable="false" data-prefix="far" data-icon="bell" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224 0c-17.7 0-32 14.3-32 32l0 19.2C119 66 64 130.6 64 208l0 25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416l400 0c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4l0-25.4c0-77.4-55-142-128-156.8L256 32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112l0 25.4c0 47.9 13.9 94.6 39.7 134.6L72.3 368C98.1 328 112 281.3 112 233.4l0-25.4c0-61.9 50.1-112 112-112zm64 352l-64 0-64 0c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z"></path></svg><!-- <i class="fa-regular fa-bell"></i> Font Awesome fontawesome.com --></span>
                            <span class="text">Notifications</span>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="{{ route('frontend.index') }}" target="_blank">
                            <span class="icon"><svg class="svg-inline--fa fa-globe" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="globe" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M352 256c0 22.2-1.2 43.6-3.3 64l-185.3 0c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64l185.3 0c2.2 20.4 3.3 41.8 3.3 64zm28.8-64l123.1 0c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64l-123.1 0c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32l-116.7 0c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0l-176.6 0c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0L18.6 160C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192l123.1 0c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64L8.1 320C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6l176.6 0c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352l116.7 0zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6l116.7 0z"></path></svg><!-- <i class="fa-solid fa-globe"></i> Font Awesome fontawesome.com --></span>
                            <span class="text">Go To Site</span>
                        </a>
                    </li> --}}
                    <li class="dropdown-item">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="icon">
                                <svg class="svg-inline--fa fa-arrow-right-from-bracket" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right-from-bracket" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"></path></svg>
                            </span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
