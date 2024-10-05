<footer>
    <!-- font-awesome added here ================ -->
    <script src="{{ asset('assets') }}/font-awesome-6.6.6-web/js/all.min.js"></script>
    <!-- nice select 2 -->
    <script src="{{ asset('assets') }}/nice-select-2/nice-select2.js"></script>

    <!-- apex charts js added here ======================= -->
    <script type="text/javascript" src="{{ asset('assets') }}/apexcharts/apexcharts.js?v={{ env('SITE_CSS_JS_VERSION') }}"></script>

    <!-- admin script added here ======================= -->
    <script src="{{ asset('assets') }}/js/admin-layout.js?v={{ env('SITE_CSS_JS_VERSION') }}"></script>
    <script src="{{ asset('assets') }}/js/admin-script.js?v={{ env('SITE_CSS_JS_VERSION') }}"></script>

    <!-- font added here (ital + Merriweather) ================ -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('success'))
        <script>swal("Good job!", "{{ session('success') }}", "success");</script>
    @endif

    @if (session('error'))
        <script>swal("Opps!", "{{ session('error') }}", "error");</script>
    @endif
    @yield('scripts')
</footer>
</body>

</html>
