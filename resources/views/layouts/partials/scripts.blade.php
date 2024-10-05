<script src="{{ asset('assets') }}/font-awesome-6.6.6-web/js/all.min.js"></script>

@yield('scripts')

<!-- script added here ======================= -->
<script src="{{ asset('assets/js/site-common.js') }}?v={{ env('SITE_CSS_JS_VERSION') }}"></script>
<script src="{{ asset('assets/js/script.js') }}?v={{ env('SITE_CSS_JS_VERSION') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if (session('success'))
    <script>
        // swal("Good job!", "Your reset password email has been sent to you, Check your inbox and follow the instructions provided!", "success");
    </script>

    {{-- Remove the session variable after showing the alert --}}
    {{ session()->forget('forgot_password_clicked') }}
@endif
