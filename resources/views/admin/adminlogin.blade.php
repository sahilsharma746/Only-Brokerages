<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin | Login</title>
    <link rel="icon" href="{{ asset('assets') }}/img/site-logo.png">
    <meta name="description" content="Open up a world of possibilities with Krust Investments">
    <meta name="keywords" content="Investments, krust, trade">

    <!-- style added here ================ -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/admin-layout.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/admin-style.css">

    <!-- font-awesome added here ================ -->
    <link rel="stylesheet" href="{{ asset('assets') }}/font-awesome-6.6.6-web/css/all.min.css">

    <!-- jQuery added here ================ -->
    <script src="{{ asset('assets') }}/jQuery/jquery-3.7.1.min.js"></script>

</head>

<body>

    <div class="card admin-login-card">
        <div class="card-header">
            <img src="{{ asset('assets/img/admin-login-logo.png') }}" class="login-logo" width="60" alt="Admin Login Logo">
            <h1>Admin Portal</h1>
        </div>
        <form action="{{ route('login') }}" method="POST">
        <div class="card-body">
                @csrf
                <div class="input-group">
                    <label for="loginEmail" class="form-label">Email <sup class="text-danger">*</sup></label>
                    <input class="form-control" type="email" name="email" id="loginEmail" placeholder="Enter email address" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="loginPassword" class="form-label">Password <sup class="text-danger">*</sup></label>
                    <input class="form-control form-eye" type="password" name="password" id="loginPassword" placeholder="Enter password" required>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <label for="loginPassword" class="eye-icon">
                        <i class="fa-regular fa-eye-slash"></i>
                    </label>
                </div>
                <p class="input-group">
                    <label>
                        <input type="checkbox" name="remember"> <span>Remember me</span>
                    </label>
                </p>
                <div class="card-footer">
                    <button type="submit" class="btn">Sign in</button>
                </div>
        </div>
    </form>
    </div>
    

    <footer>
        <!-- upload file js add ======================= -->
        {{-- <script src="{{ asset('assets') }}/upload-file/upload-file.js"></script> --}}

        <!-- admin script added here ======================= -->
        <script src="{{ asset('assets') }}/js/admin-layout.js"></script>
        <script src="{{ asset('assets') }}/js/admin-script.js"></script>


        <!-- font added here (ital + Merriweather) ================ -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
            rel="stylesheet">
    </footer>

</body>

</html>