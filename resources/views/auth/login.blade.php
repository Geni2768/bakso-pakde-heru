<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login - Bakso Pakde Heru</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #fffaf3;
            min-height: 100vh;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: white;
            border-radius: 12px;
            padding: 35px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        }

        .logo {
            text-align: center;
            color: #d62828;
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            color: #777;
            font-size: 13px;
            margin-bottom: 30px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
        }

        .form-control {
            padding: 11px;
            font-size: 13px;
        }

        .btn-login {
            width: 100%;
            background: #d62828;
            border: none;
            color: white;
            padding: 11px;
            border-radius: 6px;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #b71c1c;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
        }

        .register-link a {
            color: #d62828;
            font-weight: 600;
            text-decoration: none;
        }

        .back-home {
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
        }

        .back-home a {
            color: #555;
            text-decoration: none;
        }

    </style>

</head>


<body>


<div class="login-wrapper">

    <div class="login-card">


        <div class="logo">
            🍜 Bakso Pakde Heru
        </div>


        <div class="subtitle">
            Silakan login untuk melanjutkan
        </div>


        @if(session('status'))

            <div class="alert alert-success">
                {{ session('status') }}
            </div>

        @endif


        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            method="POST"
            action="{{ route('login') }}"
        >

            @csrf


            <div class="mb-3">

                <label
                    class="form-label"
                    for="email"
                >
                    Email
                </label>


                <input
                    id="email"
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >

            </div>


            <div class="mb-3">

                <label
                    class="form-label"
                    for="password"
                >
                    Password
                </label>


                <input
                    id="password"
                    type="password"
                    name="password"
                    class="form-control"
                    required
                >

            </div>


            <div class="mb-3 form-check">

                <input
                    type="checkbox"
                    name="remember"
                    class="form-check-input"
                    id="remember"
                >

                <label
                    class="form-check-label"
                    for="remember"
                >
                    Ingat saya
                </label>

            </div>


            <button
                type="submit"
                class="btn-login"
            >
                Login
            </button>


        </form>


        <div class="register-link">

            Belum punya akun?

            <a href="{{ route('register') }}">
                Register sekarang
            </a>

        </div>


        <div class="back-home">

            <a href="{{ route('home') }}">
                ← Kembali ke Beranda
            </a>

        </div>


    </div>

</div>


</body>

</html>
