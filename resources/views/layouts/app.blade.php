<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .info-card {
            transition: 0.3s;
            cursor: pointer;
        }

        .info-card:hover {
            transform: scale(1.02);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .info-icon {
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            border-radius: 50%;
            margin-right: 15px;
            color: white;
        }
        

        /* General Reset */
        body, h1, p, a, ul, li, button {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Alkalami';
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f3f4f6;
        }
        .header {
            display: flex;
            width: 97%;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #493628;
            border-radius: 8px 8px 0 0;
                }
        .header .logo {
            display: flex;
            align-items: center;
        }
        .header .logo img {
            height: 70px;
            margin-right: 10px;
        }
        .header .logo .name {
            color: white;
            font-size: 1.5rem;
            font-family: 'Alkalami';
            margin-top: 6.5%;
        }
        .header .actions .nav-link{
            background-color: #FFF7D1;
            border-style: outset;
            padding: 8px 16px;
            border-radius: 12px;
            margin-left: 10px;
            color:  #493628;
            font-family: 'Alkalami';
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .header .actions .nav-link:hover {
            background-color: #e0e7ff;
        }

        /* Main Container */
        .container {
            width: 97%;
            background-color: rgba(255,255,255,0.6);
            background-blend-mode: lighten;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        h1 {
            margin-top: 10%;
            font-size: 2rem;
            margin-bottom: 20px;
            font-family: 'Alkalami';
            color: #493628;
        }
        p {
            margin-bottom: 10%;
            font-size: 1rem;
            color: #AB886D;
            line-height: 1.8;
            font-family: 'Alkalami';
            padding-left: 10%;
            padding-right: 10%;
        }
        a {
            color: #493628;
            text-decoration: none;
            font-family: 'Alkalami';
        }
        a:hover {
            text-decoration: underline;
        }


        /* Change background color for the navbar */
        .navbar {
            background-color: #4a382a;
            color: white;
        }

        /* Style buttons */
        .btn-primary {
            background-color: #516249;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-family: 'Alkalami';
        }

        .btn-primary:hover {
            background-color: #b4e2c2;
        }

        /* Add padding to main content */
        main {
            padding: 20px;
            background-color: #FEF9F2;
            font-family: 'Alkalami';
        }

        /* Sidebar styling */
        .col-md-2 {
            background-color: #f0f1d6;
            padding: 15px;
            border-right: 2px solid #ddd;
        }

        /*Card Styling*/
        .card{
            background-color: #fcdada;

        }
        /* style.css */
        .custom-table {
            border: 1px solid #6c5a5a;
            border-radius: 15px;
        }

        .custom-table tr,
        .custom-table td {
            background-color: #dde5cf;
            border-color: #6c5a5a;
            text-align: left;
        }

        .jumbotron{
            border-style: outset;
            border-color: #e9c2c2;
            background-color: #FFF7D1;
            border-radius: 12px;

        }

            .jumbotron .p{
                margin-left: 20px;;
                color: #34261c;
                text-align: left;
            }
            
    </style>

    <!-- Chart.js (v3 or v4 recommended) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Scripts -->
     
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="{{ asset('resources/css/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                           @auth
                                @if (Auth::user()->role === 'admin')
                                    <a href="{{ route('register') }}">Register User</a>
                                @endif
                            @endauth
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
            <!-- jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <!-- Popper.js -->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

            <!-- Bootstrap 5 -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </main>
    </div>
</body>
</html>
