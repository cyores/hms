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
            <th class="bg-secondary">Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($all as $key => $value)
            <tr>
                <td>{{ $value['vendor'] }}</td>
                <td>${{ $value['amount'] }}</td>
                <td>{{ $value['type'] }}</td>
                <td>{{ $value['cate'] }}</td>
                <td>{{ $value['date'] }}</td>
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
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }],
    },
    options: {
        title: {
            display: true,
            text: 'All Time',
            fontSize: 20,
            fontColor: '#EEEEEE',
            padding: 10,
        },
        legend: {
            position: 'bottom',
            labels: {
                fontSize: 15,
                fontColor: '#EEEEEE',
                padding: 10
            }
        },
    }
});


var ctxTwo = document.getElementById("mo-chart").getContext('2d');
var moChart = new Chart(ctxTwo, {
    type: 'doughnut',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Past Month',
            fontSize: 20,
            fontColor: '#EEEEEE',
            padding: 10
        },
        legend: {
            position: 'bottom',
            labels: {
                fontSize: 15,
                fontColor: '#EEEEEE',
                padding: 10
            }
        },
    }
});

</script>

@endsection