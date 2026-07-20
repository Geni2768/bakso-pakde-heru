<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Bakso Pakde Heru</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            background:#f5f5f5;
        }

        .sidebar{
            width:250px;
            height:100vh;
            position:fixed;
            left:0;
            top:0;
            background:#b30000;
            color:white;
        }

        .sidebar h3{
            padding:25px;
            text-align:center;
            font-weight:bold;
        }

        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            padding:15px 25px;
            transition:.3s;
        }

        .sidebar a:hover{
            background:#8b0000;
        }

        .content{
            margin-left:250px;
        }

        .navbar-admin{
            background:white;
            padding:18px 30px;
            box-shadow:0 2px 8px rgba(0,0,0,.1);
        }

        .card-dashboard{
            border:none;
            border-radius:15px;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
        }

        .icon-card{
            font-size:35px;
            color:#b30000;
        }
    </style>

</head>
<body>

<div class="sidebar">

    <h3>🍜 Bakso Pakde Heru</h3>

    <a href="{{ route('admin.dashboard') }}">
        <i class="fa fa-home"></i> Dashboard
    </a>

    <a href="#">
        <i class="fa fa-list"></i> Kategori
    </a>

    <a href="#">
        <i class="fa fa-utensils"></i> Menu
    </a>

    <a href="#">
        <i class="fa fa-cart-shopping"></i> Pesanan
    </a>

    <a href="#">
        <i class="fa fa-users"></i> User
    </a>

    <a href="#">
        <i class="fa fa-chart-column"></i> Laporan
    </a>

    <form action="{{ route('logout') }}" method="POST" class="m-3">
        @csrf
        <button class="btn btn-light w-100">
            Logout
        </button>
    </form>

</div>

<div class="content">

    <div class="navbar-admin d-flex justify-content-between">

        <h4>Dashboard Admin</h4>

        <strong>{{ auth()->user()->name }}</strong>

    </div>

    <div class="container mt-4">

        @yield('content')

    </div>

</div>

</body>
</html>
