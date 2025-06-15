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
        <!-- Chart.js (v3 or v4 recommended) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


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

        .dropdown-wrapper {
            position: relative;
            display: inline-block;
        }

        .dropdown-button {
            background-color:  #516249; 
            color: white;
            padding: 0.4rem;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            border-radius: 0.25rem 0 0 0.25rem;
        }

        .dropdown-wrapper:hover .dropdown-menu {
            display: block;
        }

        .dropdown-toggle-button {
            background-color: #516249;
            color: white;
            padding: 0.4rem 0.6rem;
            font-size: 0.875rem;
            border: none;
            border-left: 1px solid rgba(0, 0, 0, 0.1);
            cursor: pointer;
            border-radius: 0 0.25rem 0.25rem 0;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            z-index: 10;
            background-color: white;
            border: 1px solid #ccc;
            margin-top: 4px;
            min-width: 160px;
            border-radius: 0.25rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .dropdown-menu form {
            margin: 0;
        }

        .dropdown-item {
            width: 100%;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            text-align: left;
            background-color: white;
            border: none;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
        }

        .nav-tabs .nav-link.bg-brown {
            background-color:rgba(84, 51, 25, 0.68) !important; 
            color:rgb(255, 243, 235) !important;
        }
        .nav-tabs .nav-link.bg-brown:hover {
            background-color:rgb(255, 254, 182) !important; 
            color: #5C3317 !important;
        }
        .nav-tabs .nav-link.text-brown {
            color:rgb(78, 57, 42) !important; 
        }
        .nav-tabs .nav-link.text-brown:hover {
            color:rgb(106, 57, 25) !important; 
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('resources/css/style.css') }}">
  
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Styles-->
    <link href="{{ url('/css/style.css') }}" type="text/css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <!-- You can keep empty or add links here -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">

                        <!-- Notification Icon -->
                        <li class="nav-item me-3" style="position: relative; cursor: pointer;" id="notification-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                                stroke="black" width="24" height="24" style="stroke: black;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>

                            <span id="notification-count"
                                style="display: none; position: absolute; top: -6px; right: -6px; background: red; color: white; border-radius: 50%; padding: 0 6px; font-size: 12px; font-weight: bold;">
                                0
                            </span>
                        </li>

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
              <div class="container px-4">

                <div class="row">
                    <div class="col-md-2">
                        <a href="{{ route('home')}}" class="btn btn-primary w-100 mb-2">Dashboard</a>
                        <a href="{{ route('category.index')}}" class ="btn btn-primary w-100 mb-2">Manage Category</a>
                        <a href="{{ route('items.index') }}" class="btn btn-primary w-100 mb-2">Manage Catalogue</a>
                        <a href="{{ route('order.index')}}" class="btn btn-primary w-100 mb-2">Order List</a>
                    <div class="dropdown">
                        <button class="btn btn-primary w-100 mb-2 dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Report
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="{{route('report.orderreport.index')}}">Order Report</a></li>
                            <li><a class="dropdown-item" href="{{route('report.inventoryreport.index')}}">Product Report</a></li>
                            <li><a class="dropdown-item" href="{{route('report.salesreport.index')}}">Sales Report</a></li>
                        </ul>
                    </div>
                    </div>
                    <div class="col-md-10" style="background-color: #FEF9F2;">
                        @yield('content')
                    </div>
                </div>
                
            </div>
            
        </main>
    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
@yield('scripts')
</body>
</html>