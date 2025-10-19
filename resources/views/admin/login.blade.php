<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Yora Trans</title>

    <!-- Google Font & Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('Admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- SB Admin CSS -->
    <link href="{{ asset('Admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6fa;
            font-family: 'Nunito', sans-serif;
        }

        .login-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .btn-yora {
            background-color: #a40000;
            color: #fff;
        }

        .btn-yora:hover {
            background-color: #880000;
        }

        .logo-circle {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin: 20px auto;
            display: block;
        }

        .register-link {
            margin-top: 10px;
            display: block;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-6 col-lg-5">
                <div class="card login-card p-4">
                    <img src="{{ asset('Admin/img/yoraTrans.jpg') }}" alt="Yora Logo" class="logo-circle">
                    <h4 class="text-center text-dark font-weight-bold mb-4">Welcome Yora Trans</h4>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form Login -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label class="text-left w-100" for="email">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                    class="form-control" placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="text-left w-100" for="password">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" name="password" required
                                    class="form-control" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group d-flex align-items-center">
                            <input type="checkbox" name="remember" id="remember" class="mr-2">
                            <label for="remember" class="mb-0 text-sm text-muted">Remember Me</label>
                        </div>

                        <button type="submit" class="btn btn-yora btn-block mb-3">Masuk</button>

                        <!-- Link ke Register -->
                        <div class="register-link">
                            <span class="text-muted">Belum punya akun?</span>
                            <a href="{{ route('register') }}" class="font-weight-bold">Daftar Sekarang</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="{{ asset('Admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('Admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('Admin/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
