@extends('layouts.auth_layout')
@section('title', ' | Login')

@section('content')

<section class="flex one">
    <h2>Quick Links</h2>    
</section>

<section class="flex one four-1200">
    
    <div class="full fourth-1200" onclick="navTo('/tv')" style="cursor: pointer;">
        <article class="card card-blue">
            <header class="text-center no-border">TV</header>
            <footer class="text-center">5 TV Shows!</footer>
        </article>
    </div>

    <div class="full fourth-1200" onclick="navTo('/movies')" style="cursor: pointer;">
        <article class="card card-red">
            <header class="text-center no-border" style="color: #F3F3F3;">Movies</header>
            <footer class="text-center" style="color: #F3F3F3;">More than 30 movies!</footer>
        </article>
    </div>
     
</section>

<section class="flex one marginT30 marginB30">
    <p class="text-center">
        <b>Some things don't require an account (like TV and Movies), but creating an account gives you access to more features!</b>
    </p>
    <p class="text-center"><b>Login or signup below.</b></p>
</section>

<section class="flex one two-1200">

<div>
    <article class="card">
        <header class="text-center">Login</header>
        <footer>
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="marginB10" name="email" placeholder="Email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="marginB10" name="password" placeholder="Password" required>                   
                </div>

                @if ($errors->has('password') || $errors->has('email'))
                    <div class="help-block marginB10" style="color: red;">
                        <strong>Incorrect login information.</strong>
                    </div>
                @endif

                <div class="form-group">
                    <label>
                        <input class="marginB10" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="checkable">Remember Me</span>
                    </label>
                </div>

                <div class="form-group">
                    <button type="submit" class="default marginB10">Login</button><br>
                    <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                </div>

            </form>

        </footer>

    </article>
</div>

<div>
    <article class="card">
        <header class="text-center">No Account?</header>
        <footer>
            <h3>Features</h3>
            <ul>
                <li>File Backup</li>
                <li>Access to pictures (coming soon)</li>
                <li>Personal Dashboard</li>
                <li>Upcoming Events</li>
                <li>Password Manager (coming soon)</li>
            </ul>
            <a href="/register" class="button btn-a">Register Here</a>
        </footer>
    </article>
</div>

</section>

<script type="text/javascript">
    function navTo(link) {
        window.location = link;
    }
</script>
@endsection
