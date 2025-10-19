<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Yora Trans - Register</title>

    <!-- Fonts & Styles -->
    <link href="{{ asset('Admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('Admin/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6fa;
            font-family: 'Nunito', sans-serif;
        }

        .card-register {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 2rem;
        }

        .btn-custom {
            background-color: #a40000;
            color: #fff;
            font-weight: bold;
        }

        .btn-custom:hover {
            background-color: #880000;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .form-group input {
            border-radius: .5rem;
        }

        .text-center a {
            color: #a40000;
            font-weight: bold;
            text-decoration: none;
        }

        .text-center a:hover {
            color: #880000;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card card-register" style="width: 100%; max-width: 450px;">
        <div class="text-center">
            <img src="{{ asset('Admin/img/yoraTrans.jpg') }}" alt="Yora Logo" class="logo-circle">
            <h4 class="mb-3 font-weight-bold text-dark">Create an Account</h4>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
            @csrf

            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
            </div>

            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
            </div>

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="col-sm-6">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat Password" required>
                </div>
            </div>

            <button type="submit" class="btn btn-custom btn-block">Register Account</button>
        </form>

        <div class="mt-3 text-center">
            <span class="text-muted">Already have an account?</span>
            <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
</div>

<script src="{{ asset('Admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('Admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('Admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('Admin/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
