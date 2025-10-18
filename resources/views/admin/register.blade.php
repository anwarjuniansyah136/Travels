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
            background-color: #f4f6fa;
        }
        .card {
            border: none;
            border-radius: .75rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .btn-custom {
            background-color: #b30000;
            border: none;
            color: white;
            font-weight: bold;
        }
        .btn-custom:hover {
            background-color: #8b0000;
        }
        .logo {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4" style="width: 100%; max-width: 450px;">
        <div class="text-center">
          <img src="{{ asset('Admin/img/yoraTrans.jpg') }}" alt="Yora Logo" style="width:80px; height:80px; border-radius:50%; object-fit:cover; margin-bottom:15px;">

            <h4 class="mb-3">Create an Account!</h4>
        </div>
        <form class="user" method="POST" action="{{ route('register.post') }}">
            @csrf
        
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="Name" class="form-control" placeholder="Name" required>
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
            <a href="/" class="small">Login</a>
        </div>
    </div>
</div>

<script src="{{ asset('Admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('Admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('Admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('Admin/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
