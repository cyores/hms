<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="/images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>HMS @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/picnic.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/helper-classes.css') }}" rel="stylesheet" type="text/css"> 

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">       
</head>
<body>
    <nav class="" style="background-color: rgba(0,0,0,0); box-shadow: none;">
        <a href="#" class="brand">
            <img class="logo" src="images/favicon.png">
            <span>HMS</span>
        </a>

        <!-- mobile menu -->
        <input id="bmenub" type="checkbox" class="show">
        <label for="bmenub" class="burger pseudo button">menu</label>

        <div class="menu">
            <a href="/login" class="pseudo button">Login</a>
            <a href="/register" class="pseudo button">Register</a>
        </div>
    </nav>

    <main>
        <section class="container">
            @yield('content')
        </section>
    </main>

</body>
</html>
