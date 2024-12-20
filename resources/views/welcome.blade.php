<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Alkalami:400" rel="stylesheet" />
    <!-- Styles -->
    <link href="{{ url('/css/style.css') }}" type="text/css" rel="stylesheet">
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #2563eb;
            color: #fff;
            border-radius: 8px 8px 0 0;
                }
        .header .logo {
            display: flex;
            align-items: center;
        }
        .header .logo img {
            height: 40px;
            margin-right: 10px;
        }
        .header .logo .name {
            font-size: 1.5rem;
            font-family: 'Alkalami';
        }
        .header .actions .nav-link{
            background-color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            margin-left: 10px;
            color:black;
            font-family: 'Alkalami';
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .header .actions .nav-link:hover {
            background-color: #e0e7ff;
        }

        /* Main Container */
        .container {
            width: 100%;
            background: #fff;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            font-family: 'Alkalami';
        }
        p {
            font-size: 1rem;
            color: #6b7280;
            line-height: 1.8;
            font-family: 'Alkalami';
        }
        a {
            color: #2563eb;
            text-decoration: none;
            font-family: 'Alkalami';
        }
        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <div class="name">Membakeries</div>
        </div>
        <div class="actions">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/home')}}" class ="nav-link">Home</a>
            @else
                <a href="{{ route('login') }}" class ="nav-link">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class ="nav-link">Register</a>
                @endif
            @endauth
            @endif
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <h1>Welcome to Membakeries</h1>
        <p>
            Laravel is a web application framework with expressive, elegant syntax. 
            If you're just getting started, explore the
        </p>
    </div>
</body>
</html>
