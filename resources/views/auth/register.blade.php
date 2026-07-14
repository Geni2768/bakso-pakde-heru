<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Register</title>

@vite(['resources/css/app.css','resources/js/app.js'])

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

background:#f5f5f5;

height:100vh;

}

.register-card{

width:950px;

border-radius:25px;

overflow:hidden;

background:white;

box-shadow:0 10px 30px rgba(0,0,0,.15);

}

.left{

background:#fff4dd;

display:flex;

align-items:center;

justify-content:center;

}

.left img{

width:340px;

}

.logo{

width:180px;

}

.btn-register{

background:#d92525;

color:white;

font-weight:bold;

width:100%;

}

</style>

</head>

<body>

<div class="container h-100">

<div class="row h-100 justify-content-center align-items-center">

<div class="col-lg-10">

<div class="register-card row g-0">

<div class="col-md-5 left">

<img src="{{ asset('images/register-bakso.png') }}">

</div>

<div class="col-md-7 p-5">

<div class="text-center">

<img src="{{ asset('images/logo.png') }}" class="logo mb-3">

<h4>Buat Akun Baru</h4>

<p class="text-muted">

Daftar untuk mulai memesan

</p>

</div>

<form method="POST" action="{{ route('register') }}">

@csrf

<div class="mb-3">

<label>Nama Lengkap</label>

<input
type="text"
name="name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>No HP</label>

<input
type="text"
name="no_hp"
class="form-control">

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Konfirmasi Password</label>

<input
type="password"
name="password_confirmation"
class="form-control"
required>

</div>

<button class="btn btn-register">

Daftar

</button>

<div class="text-center mt-3">

Sudah punya akun?

<a href="{{ route('login') }}">

Masuk di sini

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
