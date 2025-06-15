<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts & Libraries -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body, h1, p, a, ul, li, button {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Alkalami', serif;
        }
        body {
            background-color: #f3f4f6;
        }

        .header {
            display: flex;
            flex-wrap: wrap;
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
            height: 60px;
            margin-right: 10px;
        }

        .header .logo .name {
            color: white;
            font-size: 1.5rem;
        }

        .header .actions .nav-link {
            background-color: #FFF7D1;
            border-style: outset;
            padding: 8px 16px;
            border-radius: 12px;
            margin-left: 10px;
            color: #493628;
            transition: 0.3s;
        }

        .header .actions .nav-link:hover {
            background-color: #e0e7ff;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            font-family: 'Alkalami';
            color: #493628;
        }

        .btn-primary {
            background-color: #516249;
            border: none;
            border-radius: 5px;
            transition: 0.3s;
            font-family: 'Alkalami';
        }

        .btn-primary:hover {
            background-color: #b4e2c2;
        }

        .card {
            background-color: #fcdada;
        }

        .custom-table {
            border: 1px solid #6c5a5a;
            border-radius: 15px;
        }

        .custom-table td {
            background-color: #dde5cf;
            border-color: #6c5a5a;
            text-align: left;
        }

        .jumbotron {
            border-style: outset;
            border-color: #e9c2c2;
            background-color: #FFF7D1;
            border-radius: 12px;
        }

        .jumbotron p {
            color: #34261c;
            text-align: left;
        }

        /* Responsive Fixes */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .header .logo .name {
                margin-top: 0;
                font-size: 1.2rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            .btn, .nav-link {
                font-size: 0.9rem;
            }
        }
    </style>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('resources/css/style.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #4a382a;">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto"></ul>
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item me-3" id="notification-icon" style="position: relative;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" stroke="black" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span id="notification-count" style="display:none; position:absolute; top:-6px; right:-6px; background:red; color:white; border-radius:50%; padding:2px 6px; font-size:12px;">0</span>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-12 col-md-2 mb-3 mb-md-0">
                        <a href="{{ route('home')}}" class="btn btn-primary w-100 mb-2">Dashboard</a>
                        <a href="{{ route('category.index')}}" class="btn btn-primary w-100 mb-2">Manage Category</a>
                        <a href="{{ route('items.index') }}" class="btn btn-primary w-100 mb-2">Manage Catalogue</a>
                        <a href="{{ route('order.index')}}" class="btn btn-primary w-100 mb-2">Order List</a>
                        <div class="dropdown">
                            <button class="btn btn-primary w-100 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Report
                            </button>
                            <ul class="dropdown-menu w-100">
                                <li><a class="dropdown-item" href="{{route('report.orderreport.index')}}">Order Report</a></li>
                                <li><a class="dropdown-item" href="{{route('report.inventoryreport.index')}}">Product Report</a></li>
                                <li><a class="dropdown-item" href="{{route('report.salesreport.index')}}">Sales Report</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 col-md-10" style="background-color: #FEF9F2;">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
    @vite('resources/js/app.js')
    <script>
        const beamsClient = new PusherPushNotifications.Client({
            instanceId: '272fef2e-cbe8-4692-b729-9eecae93e7f5',
        });
        beamsClient.start()
            .then(() => beamsClient.addDeviceInterest('hello'))
            .then(() => console.log('Successfully registered and subscribed!'))
            .catch(console.error);
    </script>
    @stack('scripts')
    @yield('scripts')
</body>
</html>
