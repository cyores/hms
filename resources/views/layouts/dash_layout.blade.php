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
    <link href="{{ asset('css/jquery.timepicker.min.css') }}" rel="stylesheet" type="text/css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">  

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.timepicker.min.js') }}"></script>    
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>
<body>
    <nav>
        <a href="dashboard" class="brand">
            <img class="logo" src="images/favicon.png">
            <span>HMS</span>
        </a>

        <!-- mobile menu -->
        <input id="bmenub" type="checkbox" class="show">
        <label for="bmenub" class="burger pseudo button">menu</label>

        <div class="menu"> 
            <a href="/movies" class="pseudo button">Movies</a>
            <a href="/tv" class="pseudo button">TV Shows</a>
            @if(Auth::check())
                <a href="/pictures" class="pseudo button">Pictures</a>
                <a href="/files" class="pseudo button">Files</a>
                <a href="/locker" class="pseudo button">Locker</a>
                <a href="/account" class="pseudo button">Account</a>
                <a href="/logout" class="button btn-a">Logout</a>
            @endif
        </div>
    </nav>

    <main>
        <div class="flex one two-1200 bg-lt-blue">
            <div class="full half-1200 pad0"><p class="pull-left bgText marginL20">Welcome, {{ $user['name'] }}</p></div>
            <div class="none half-1200 pad0"><p class="pull-right bgText marginR20">{{ $user['date'] }}</p></div>
        </div>
        <section class="container">
            @yield('content')
        </section>
    </main>

    <div class="modal">
        <input id="modal" type="checkbox" />
        <label for="modal" class="overlay"></label>
        <article>
            <header>
                <h3 id="model_title">Modal Title</h3>
                <label for="modal" class="close">&times;</label>
            </header>
            <section id="model_body" class="content">Modal body paragraph or form</section>
            <footer id="model_footer"><label for="modal" class="button dangerous">Cancel</label></footer>
        </article>
    </div>

</body>
</html>
