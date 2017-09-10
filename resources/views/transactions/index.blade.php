@extends('layouts.minimal_layout')
@section('title', ' | Locker')

@section('content')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>

<style type="text/css">
    table { width: 100%; }
    td, th { padding: 10px; }
</style>

<div class="flex one two-1200 pad50">
    <div class="full half-1200">
        <canvas id="all-chart"></canvas>
    </div>
    <div class="full half-1200">
        <canvas id="mo-chart"></canvas>
    </div>
</div>

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

<script>


var ctx = document.getElementById("all-chart").getContext('2d');
var allChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            data: [12, 19, 3, 5, 2, 3],
        }]
    },
    options: {

    }
});


var ctxTwo = document.getElementById("mo-chart").getContext('2d');
var moChart = new Chart(ctxTwo, {
    type: 'doughnut',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            data: [12, 19, 3, 5, 2, 3],
        }]
    },
    options: {

    }
});

</script>

@endsection