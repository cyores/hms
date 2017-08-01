@extends('layouts.auth_layout')
@section('title', ' | Login')

@section('content')
<section class="flex one two-1200 marginT100">

<div>
    <article class="card">
        <header class="text-center">Login</header>
        <footer>
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="marginB10" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
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
                    <button type="submit" class="marginB10">Login</button><br>
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
                <li>Access to picture and video</li>
                <li>News</li>
                <li>Upcoming Events</li>
                <li>Password Manager</li>
            </ul>
            <a href="/register" class="button btn-a">Register Here</a>
        </footer>
    </article>
</div>

</section>

                    

@endsection
