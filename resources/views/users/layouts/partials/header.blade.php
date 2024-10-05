<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Krust-Markets | Admin</title>
    <link rel="icon" href="{{ asset('assets') }}/img/site-logo.png">
    <meta name="description" content="Open up a world of possibilities with Krust Investments">
    <meta name="keywords" content="Investments, krust, trade">

     <script>
        var apiUrlCrypto = "{{ url('/crypto.json') }}";
        var apiUrlForex = "{{ url('/forex.json') }}";
        var apiUrlIndisis = "{{ url('/indisis.json') }}";

    </script>
    <link rel="stylesheet" href="{{ asset('assets') }}/nice-select-2/nice-select2.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/font-awesome-6.6.6-web/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/data-table-2.1.4/dataTables.dataTables.css">
    
    <link rel="stylesheet" href="{{ asset('assets/css/user-dashboard.css') }}?v={{ env('SITE_CSS_JS_VERSION') }}">
    
    @if (Route::currentRouteName() === 'users.trading-bots.index' || Route::currentRouteName() === 'users.trading-history.index'  )
        <link rel="stylesheet" href="{{ asset('assets/css/user-style.css') }}?v={{ env('SITE_CSS_JS_VERSION') }}">
    @endif

    @if (Route::currentRouteName() === 'user.trade.index' || Route::currentRouteName() === 'user.marketWatch.index')
         <link rel="stylesheet" href="{{ asset('assets/css/user-style.css') }}?v={{ env('SITE_CSS_JS_VERSION') }}">
          <link rel="stylesheet" href="{{ asset('assets/css/trade-and-market.min.css') }}?v={{ env('SITE_CSS_JS_VERSION') }}">
    @endif

    <script src="{{ asset('assets') }}/jQuery/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('assets') }}/data-table-2.1.4/dataTables.js"></script>

    <script src="{{ asset('assets/js/site-common.js') }}?v={{ env('SITE_CSS_JS_VERSION') }}"></script>
    
</head>

<body>
    <header>
        <div class="main-header">
            <div class="container d-flex flex-wrap justify-content-between align-items-center g-10">
                <div>
                    <a href="{{ route('home') }}" class="logo-area d-flex align-items-center g-4">
                        <img src="{{ asset('assets') }}/img/site-logo.png" alt="Site Logo" class="site-logo">
                        <span class="site-name">Krust-Markets</span>
                    </a>
                    <div class="account-status-header d-flex align-items-center g-15" >
                        <span class="dot"></span>
                        <span class="account-status text-primary">Live Account</span>
                    </div>
                </div>

                <a id="btn-nav-toggle" class="btn-nav-toggle">
                    <img src="{{ asset('assets') }}/img/icon-menu-category.png">
                </a>
                <dl class="header-btns d-flex flex-wrap g-8">
                    <dt>
                        <a class="btn btn-deposit g-8" href="{{ route('user.deposit.getway') }}">
                            <i class="fa-regular fa-credit-card"></i>
                            <span>Deposit</span>
                        </a>
                    </dt>
                    <dt class="dropdown">
                        <a class="btn btn-account-balance">
                            <span class="text">Account Balance</span>
                            <span class="account-amount" >${{ number_format(auth()->user()->balance) }}</span>
                            <span class="icon"><i class="fa-solid fa-angle-down"></i></span>
                        </a>

                        <dl class="dropdown-menu d-flex flex-column">
                            <dt class="dropdown-item">Current Plan: <span class="user-plan-name">{{ $user_plan }}</span> </dt>
                            <dt class="dropdown-item">Account Profit : <span class="user-plan-name"  style="color: #3AAC1A"><b>${{ number_format ( $account_profit ) }}</b></span> </dt>

                            <!-- <dt class="dropdown-item">
                                <div class="account-status-header d-flex align-items-center g-10">
                                    <span class="account-status text-primary">Profit</span>
                                </div>
                                <div class="account-amount-header">
                                    ${{ number_format(auth()->user()->balance) }}
                                </div>
                            </dt> -->
                            <dt class="dropdown-item">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    <span>Logout</span>
                                </a>
                                <!-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form> -->
                            </dt>

                            @if(session()->has('admin_id'))
                                <dt class="dropdown-item">
                                    <a href="{{ route('user.admin.restore') }}" class="btn btn-warning">Return to Admin</a>
                                </dt>
                            @endif

                        </dl>
                    </dt>
                </dl>
            </div>
        </div>
    </header>


    <script type="text/javascript">
        // JQUERY FOR DISPLAYING THE MENU ON MOBILE 
        $(document).on('click', '#btn-nav-toggle', function () {
            $(this).toggleClass('nav-displayed');
            $('#left-nav').toggleClass('active');
            $('body').toggleClass('overflowY-hidden');
        });
    </script>
