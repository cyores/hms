@extends('layouts.minimal_layout')
@section('title', ' | Locker')

@section('content')

<style type="text/css">
    table { width: 100%; }
    td, th { padding: 10px; }
</style>

<h1>All Transactions</h1>

<table>
    <thead>
        <tr>
            <th class="bg-secondary">Vendor</th>
            <th class="bg-secondary">Amount</th>
            <th class="bg-secondary">Type</th>
            <th class="bg-secondary">Category</th>
        </tr>
    </thead>
    <tbody>
        @foreach($all as $key => $value)
            <tr>
                <td>{{ $value['vendor'] }}</td>
                <td>${{ $value['amount'] }}</td>
                <td>{{ $value['type'] }}</td>
                <td>{{ $value['cate'] }}</td>
            </tr>
        @endforeach 
    </tbody>
</table> 



<div class="action-btn-group">
    <label for="modal">
        <div class="action-btn bg-secondary">
            <img class="img-responsive" src="/images/icons/plus.svg">
        </div>
    </label>
</div>


@endsection