<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bakso Pakde Heru</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f5f5f5;
            height:100vh;
        }

        .login-card{
            width:950px;
            border-radius:25px;
            overflow:hidden;
            background:white;
            box-shadow:0 10px 30px rgba(0,0,0,.15);
        }

        .left{
            background:#fff4dd;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .left img{
            width:330px;
        }

        .logo{
            width:180px;
        }

        .btn-login{
            width:100%;
            background:#d92525;
            color:white;
            font-weight:bold;
        }

        .btn-login:hover{
            background:#b71c1c;
            color:white;
        }
    </style>
</head>

<body>

<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">

        <div class="col-lg-10">

            <div class="login-card row g-0">

                <div class="col-md-5 left">
                    <img src="{{ asset('images/login-bakso.png') }}" alt="">
                </div>

                <div class="col-md-7 p-5">

                    <div class="text-center mb-4">
                        <img src="{{ asset('images/logo.png') }}" class="logo mb-3">

                        <h3>Login</h3>

                        <p class="text-muted">
                            Selamat datang di Bakso Pakde Heru
                        </p>
                    </div>

                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Email</label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                required
                                autofocus>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>
                        </div>

                        <div class="form-check mb-3">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="remember"
                                id="remember">

                            <label class="form-check-label" for="remember">
                                Ingat Saya
                            </label>
                        </div>

                        <button class="btn btn-login">
                            Masuk
                        </button>

                        <div class="text-center mt-3">
                            Belum punya akun?

                            <a href="{{ route('register') }}">
                                Daftar di sini
                            </a>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</div>

</body>
</html>
