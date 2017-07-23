@extends('layouts.auth_layout')
@section('title', ' | Register')

@section('content')
<section class="flex one two-1200 marginT100">
<div>
    <article class="card">
        <header class="center-text">Register</header>
        <footer>
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input id="name" type="text" class="form-control marginB10" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control marginB10" name="email" placeholder="Email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="form-control marginB10" name="password" placeholder="Password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="marginB10">
                    <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password" required>
                </div>

                <div class="marginB10">
                    <button type="submit">Register</button>
                </div>

            </form>
        </footer>
    </article>
</div>
<div>
    <article class="card">
        <header>Features</header>
        <footer>
            <ul>
                <li>File Backup</li>
                <li>Access to picture and video</li>
                <li>News</li>
                <li>Upcoming Events</li>
                <li>Password Manager</li>
            </ul>
        </footer>
    </article>
</div>
</section>
                    

@endsection
