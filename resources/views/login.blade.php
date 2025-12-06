<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MAS | Log in</title>
    <!-- Favicon for tab/browser icon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('Uploads/logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('Uploads/logo.png') }}">
    <!-- Google Font: Poppins for modern feel -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Bootstrap 5 for better responsiveness -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        :root {
            --main-color: #2C3E50;          /* Your main color */
            --main-color-dark: #1A252F;     /* Slightly darker variant for gradients/hover */
            --main-color-light: #34495E;    /* Lighter variant for accents */
            --light-bg: #F8F9FA;            /* Pleasant light background */
            --card-bg: #FFFFFF;            /* White cards */
            --text-primary: #2C3E50;       /* Main dark color for primary text */
            --text-muted: #7F8C8D;         /* Muted text */
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1); /* Soft shadow */
            --border-radius: 12px;         /* Modern rounded corners */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--light-bg) 0%, #E3F2FD 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
            overflow-x: hidden;
        }

        .login-container {
            width: 100%;
            max-width: 900px;
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-left {
            background: linear-gradient(135deg, var(--main-color) 0%, var(--main-color-dark) 100%);
            color: white;
            min-height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem;
        }

        .login-left h1 {
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 2.5rem;
            line-height: 1.2;
        }

        .login-left p {
            font-size: 1.1rem;
            opacity: 0.95;
            margin-bottom: 0;
        }

        .login-right {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-logo img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid var(--main-color);
            transition: transform 0.3s ease;
        }

        .login-logo img:hover {
            transform: scale(1.05);
        }

        .form-floating {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-floating input {
            border: 2px solid #E9ECEF;
            border-radius: var(--border-radius);
            padding: 12px 50px 12px 15px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            height: calc(3.5rem + 2px);
        }

        .form-floating input:focus {
            border-color: var(--main-color);
            box-shadow: 0 0 0 0.2rem rgba(44, 62, 80, 0.25);
        }

        .form-floating label {
            color: var(--text-muted);
            font-weight: 400;
            padding-left: 15px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--main-color) 0%, var(--main-color-dark) 100%);
            border: none;
            border-radius: var(--border-radius);
            padding: 12px;
            font-weight: 500;
            font-size: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 50px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(44, 62, 80, 0.3);
        }

        .alert {
            border-radius: var(--border-radius);
            border: none;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .footer-text {
            text-align: center;
            color: var(--text-muted);
            font-size: 0.875rem;
            margin-top: 1.5rem;
        }

        .footer-text a {
            color: var(--main-color);
            text-decoration: none;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        /* Password toggle */
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-muted);
            z-index: 10;
            font-size: 1.1rem;
        }

        .password-toggle:hover {
            color: var(--main-color);
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .login-left,
            .login-right {
                padding: 2rem;
            }

            .login-left h1 {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .login-container {
                margin: 1rem;
            }

            .login-left,
            .login-right {
                padding: 2rem 1.5rem;
            }

            .login-left h1 {
                font-size: 1.75rem;
            }

            .login-left p {
                font-size: 1rem;
            }

            .login-right {
                padding-top: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .login-left h1 {
                font-size: 1.5rem;
            }

            .login-left,
            .login-right {
                padding: 1.5rem 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="row g-0">
            <div class="col-lg-6">
                <div class="login-left">
                    <h1>Malabong Archive System</h1>
                    <p>Secure access to archived records and management tools</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login-right">
                    <div class="login-logo">
                        <img src="{{ asset('Uploads/logo.png') }}" alt="Malabong Elementary School Logo">
                    </div>
                    <h5 class="text-center mb-4" style="color: var(--text-primary);">Sign in to your account</h5>
                    <form action="{{route('postLogin')}}" method="post">
                        @csrf
                        @if(session('error'))
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>{{session('error')}}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success">
                                <i class="fas fa-check me-2"></i>{{session('success')}}
                            </div>
                        @endif
                        <div class="form-floating">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username') }}" autofocus>
                            <label for="username">Username</label>
                            <i class="fas fa-user password-toggle" ></i>
                        </div>
                        @error('username')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <label for="password">Password</label>
                            <i class="fas fa-eye-slash password-toggle" onclick="togglePassword(event)"></i>
                        </div>
                        @error('password')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </button>
                    </form>
                    <div class="footer-text">
                        <p>Developed by Edwin Abril Jr. | <a target="_blank" href="https://www.facebook.com/eabril.27">Contact Support</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (if needed for AdminLTE remnants) -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        function togglePassword(event) {
            const passwordInput = document.getElementById('password');
            const toggleIcon = event.target;
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html>