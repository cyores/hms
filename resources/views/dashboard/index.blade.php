@extends('layouts.dash_layout')
@section('title', ' | Dashboard')

@section('content')

<div class="flex two">
    <div><p class="pull-left bgText">Welcome, {{ $user['name'] }}</p></div>
    <div><p class="pull-right bgText">{{ $date }}</p></div>
</div>
@endsection
