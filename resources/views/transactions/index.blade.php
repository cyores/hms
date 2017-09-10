@extends('layouts.minimal_layout')
@section('title', ' | Locker')

@section('content')

<style type="text/css">
    tr:nth-child(even) { background-color: rgba(0,0,0,0); }
    td > img { cursor: pointer; }
</style>

<h1>Transactions</h1>

<div class="action-btn-group">
    <label for="modal">
        <div class="action-btn bg-secondary">
            <img class="img-responsive" src="/images/icons/plus.svg">
        </div>
    </label>
</div>


@endsection