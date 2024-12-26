<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Membakeries</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Alkalami:400" rel="stylesheet" />
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
            background-image: url("bakery-background.jpeg");
            background-size: cover;
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

    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="logo">
            <img src="{{ asset('Membakeries_logo_transparent.png') }}" alt="Logo">
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
        At MemBakeries, we empower bakery businesses to thrive with streamlined, efficient, and easy-to-use management tools. 
        Whether you're managing inventory, tracking sales, organizing staff schedules, or analyzing performance, 
        our platform is tailored to meet the unique needs of your bakery.
        </p>
    </div>
</body>
</html>
