<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KK-Tech-Sales - Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/apple-touch-icon.png') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/tabler-icons/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body class="account-page">

<div id="global-loader">
    <div class="whirly-loader"></div>
</div>

<!-- Main Wrapper -->
<div class="main-wrapper">
    <div class="account-content">
        <div class="login-wrapper bg-img">
            <div class="login-content authent-content">

                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf

                    <div class="login-userset">

                        <div class="login-logo logo-normal">
                            <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo">
                        </div>

                        <a href="{{ url('/') }}" class="login-logo logo-white">
                            <img src="{{ asset('assets/img/logo-white.svg') }}" alt="Logo">
                        </a>

                        <div class="login-userheading">
                            <h3>Sign In</h3>
                            <h4 class="fs-16">
                                Access the Dreams POS panel using your email and password.
                            </h4>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">
                                Email <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input 
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    class="form-control border-end-0 @error('email') is-invalid @enderror"
                                    required
                                >
                                <span class="input-group-text border-start-0">
                                    <i class="ti ti-mail"></i>
                                </span>
                            </div>
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label">
                                Password <span class="text-danger">*</span>
                            </label>
                            <div class="pass-group">
                                <input 
                                    type="password" 
                                    name="password"
                                    class="pass-input form-control @error('password') is-invalid @enderror"
                                    required
                                >
                                <span class="ti toggle-password ti-eye-off text-gray-9"></span>
                            </div>
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Submit -->
                        <div class="form-login">
                            <button type="submit" class="btn btn-primary w-100">
                                Sign In
                            </button>
                        </div>

                        <!-- Register -->
                        @if (Route::has('register'))
                            <div class="signinform">
                                <h4>
                                    New on our platform?
                                    <a href="{{ route('register') }}" class="hover-a">
                                        Create an account
                                    </a>
                                </h4>
                            </div>
                        @endif

                        <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                            <p>Copyright &copy; {{ date('Y') }} DreamsPOS</p>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
<!-- /Main Wrapper -->

<!-- JS -->
<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

</body>
</html>