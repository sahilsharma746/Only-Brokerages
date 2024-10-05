    <script src="{{ asset('assets') }}/font-awesome-6.6.6-web/js/all.min.js"></script>
    <script src="{{ asset('assets') }}/nice-select-2/nice-select2.js"></script>

    {{-- <!-- <script src="{{ asset('assets') }}/js/admin.js"></script> --> --}}
    <script src="{{ asset('assets/js/user-script.js') }}?v={{ env('SITE_CSS_JS_VERSION') }}"></script>
    <script src="{{ asset('assets/js/user-dashboard.js') }}?v={{ env('SITE_CSS_JS_VERSION') }}"></script>

    @if (Route::currentRouteName() === 'user.dashboard')
        <script src="{{ asset('assets/upload-file/upload-file.js') }}?v={{ env('SITE_CSS_JS_VERSION') }}"></script>
    @endif

    @if (Route::currentRouteName() === 'user.trade.index' || Route::currentRouteName() === 'users.trading-history.index' || Route::currentRouteName() === 'user.marketWatch.index')
        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
        <script src="{{ asset('assets') }}/apexcharts/apexcharts.js"></script>
        <script src="{{ asset('assets/js/user-trade.js') }}?v={{ env('SITE_CSS_JS_VERSION') }}"></script>
    @endif

  

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if (session('success'))
        <script> swal("Good job!", "{{ session('success') }}", "success") ;</script>
    @endif

    @if (session('withdrawl_success'))
        <script> swal("Good job!", "{{ session('withdrawl_success') }}", "success") ;</script>
    @endif

    @if (session('error'))
        <script>swal("Opps!", "{{ session('error') }}", "error");</script>
    @endif
</body>
</html>


