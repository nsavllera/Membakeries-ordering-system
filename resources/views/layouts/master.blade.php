<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Alkalami&display=swap" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])



    <style>
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
        
        }

        .btn-primary:hover {
            background-color: #b4e2c2;
        }

        /* Add padding to main content */
        main {
            padding: 20px;
            background-color: #FEF9F2;
        
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
                        @php
                            $unreadCount = \App\Models\Message::whereNull('reply')->count();
                        @endphp

                        <li class="nav-item position-relative">
                            <a class="nav-link" href="{{ route('message.index') }}">
                                <i class="fas fa-inbox"></i> Inbox
                                @if($unreadCount > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </a>
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
                        <a href="{{ route('customers.index')}}" class="btn btn-primary w-100 mb-2">Manage Customer</a>
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