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
            width:900px;
            border-radius:25px;
            overflow:hidden;
            box-shadow:0 10px 30px rgba(0,0,0,.15);
            background:white;
        }

        .left{
            background:#d92525;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .left img{
            width:320px;
        }

        .logo{
            width:180px;
        }

        .btn-login{
            background:#d92525;
            color:white;
            width:100%;
            font-weight:bold;
        }

        .btn-login:hover{
            background:#b91d1d;
            color:white;
        }

    </style>

</head>
<body>

<div class="container h-100">

<div class="row h-100 justify-content-center align-items-center">

<div class="col-lg-9">

<div class="login-card row g-0">

<div class="col-md-5 left">

<img src="{{ asset('images/login-bakso.png') }}">

</div>

<div class="col-md-7 p-5">

<div class="text-center">

<img src="{{ asset('images/logo.png') }}" class="logo mb-3">

<h4 class="fw-bold">
Selamat Datang Kembali
</h4>

<p class="text-muted">
Masuk untuk melanjutkan pesanan Anda
</p>

</div>

<form method="POST" action="{{ route('login') }}">

@csrf

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="d-flex justify-content-between mb-4">

<div>

<input type="checkbox" name="remember">

Ingat Saya

</div>

<a href="{{ route('password.request') }}">

Lupa Password?

</a>

</div>

<button class="btn btn-login">

Masuk

</button>

<div class="text-center mt-3">

Belum punya akun?

<a href="{{ route('register') }}">

Daftar Sekarang

</a>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

</div>

</body>
</html>
