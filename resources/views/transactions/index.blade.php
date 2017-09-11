@extends('layouts.minimal_layout')
@section('title', ' | Locker')

@section('content')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>

<style type="text/css">
    table { width: 100%; }
    td, th { padding: 10px; }
</style>

<h1>Transactions</h1>

<div class="flex one two-1200">
    <div class="full half-1200">
        <canvas id="all-chart"></canvas>
    </div>
    <div class="full half-1200">
        <canvas id="mo-chart"></canvas>
    </div>
</div>

<h1>Transactions List</h1>

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
var cates = {!! json_encode($donutData['categories']) !!};
var amts = {!! json_encode($donutData['amounts']) !!};

var ctx = document.getElementById("all-chart").getContext('2d');
var allChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: cates,
        datasets: [{
            data: amts,
            backgroundColor: [
                'rgba(25, 210, 210, 1)',
                'rgba(210, 25, 25, 1)',
                'rgba(233, 182, 29, 1)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: [
                'rgba(25, 210, 210, 1)',
                'rgba(210, 25, 25, 1)',
                'rgba(233, 182, 29, 1)',
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

var months = {!! json_encode($spm['months']) !!};
var mo_amts = {!! json_encode($spm['mo_amts']) !!};

var ctxTwo = document.getElementById("mo-chart").getContext('2d');
var moChart = new Chart(ctxTwo, {
    type: 'bar',
    data: {
        labels: months,
        datasets: [{
            data: mo_amts,
            backgroundColor: [
                'rgba(25, 210, 210, 1)',
                'rgba(210, 25, 25, 1)',
                'rgba(233, 182, 29, 1)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: [
                'rgba(25, 210, 210, 1)',
                'rgba(210, 25, 25, 1)',
                'rgba(233, 182, 29, 1)',
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
            text: 'Spending Per Month',
            fontSize: 20,
            fontColor: '#EEEEEE',
            padding: 10
        },
        legend: {
            display: false,
        },
    }
});

</script>

@endsection