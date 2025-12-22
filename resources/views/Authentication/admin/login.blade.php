<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="pos Admin">
    <meta name="robots" content="index, follow">
    <title>{{ asset($defaultSettings->site_title ?? null) }} - Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset($defaultSettings->favicon ?? null) }}">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset($defaultSettings->favicon ?? null) }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('resource/admin/assets/css/bootstrap.min.css')}}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('resource/admin/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('resource/admin/assets/plugins/fontawesome/css/all.min.css')}}">

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="{{asset('resource/admin/assets/plugins/tabler-icons/tabler-icons.min.css')}}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('resource/admin/assets/css/style.css')}}">

    <style>
        .centered-login {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .login-card {
            width: 100%;
            max-width: 450px;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background: white;
        }
        .login-logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .login-logo img {
            max-height: 60px;
        }
        .login-title {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .social-login {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 1.5rem;
        }
        .social-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        .copyright {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.8rem;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="centered-login">
        <div class="login-card">
            <!-- Logo -->
            <div class="login-logo">
                <img src="{{ asset($defaultSettings->site_logo ?? null) }}" alt="Logo">
            </div>

            <!-- Title -->
            <div class="login-title">
                <h3>Sign In</h3>
                <p class="text-muted">Access the ISICO panel using your email and passcode.</p>
            </div>

            <!-- Error Handling -->
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success!</strong> {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Sorry!</strong> {{ session('error') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="email" class="form-control border-end-0 @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autofocus>
                        <span class="input-group-text border-start-0">
                            <i class="ti ti-mail"></i>
                        </span>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <div class="pass-group">
                        <input type="password" class="pass-input form-control @error('password') is-invalid @enderror"
                               name="password" required>
                        <span class="ti toggle-password ti-eye-off text-gray-9"></span>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <!-- Social Login -->
            <div class="social-login">
                <a href="javascript:void(0);" class="social-btn btn btn-info">
                    <img src="{{asset('resource/admin/assets/img/icons/facebook-logo.svg')}}" alt="Facebook" width="18">
                </a>
                <a href="javascript:void(0);" class="social-btn btn btn-white border">
                    <img src="{{asset('resource/admin/assets/img/icons/google-logo.svg')}}" alt="Google" width="18">
                </a>
                <a href="javascript:void(0);" class="social-btn btn btn-dark">
                    <img src="{{asset('resource/admin/assets/img/icons/apple-logo.svg')}}" alt="Apple" width="18">
                </a>
            </div>

            <!-- Copyright -->
            <div class="copyright">
                <p>{{ $defaultSettings->footer_copyright ?? null }}</p>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('resource/admin/assets/js/jquery-3.7.1.min.js')}}"></script>

    <!-- Feather Icon JS -->
    <script src="{{asset('resource/admin/assets/js/feather.min.js')}}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{asset('resource/admin/assets/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Custom JS -->
    <script src="{{asset('resource/admin/assets/js/script.js')}}"></script>

    <script>
        // Toggle password visibility
        document.querySelector('.toggle-password').addEventListener('click', function() {
            const passwordInput = document.querySelector('.pass-input');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('ti-eye');
            this.classList.toggle('ti-eye-off');
        });
    </script>
</body>
</html>