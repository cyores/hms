@extends('layouts.minimal_layout')
@section('title', ' | Transactions')

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
        <div class="full"><canvas id="mo-chart"></canvas></div>
        <div class="full"><canvas id="da-chart"></canvas></div>
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
        <div class="action-btn bg-secondary" onclick="newTAModal()">
            <img class="img-responsive" src="/images/icons/plus.svg">
        </div>
    </label>
</div>

<script type="text/javascript">
var ALL_CATES = {!! json_encode($nta_cates) !!};
var ALL_TYPES = {!! json_encode($nta_types) !!};

function newTAModal() {
    var body =   '<form class="pad30" onsubmit="newTA()">'
                    +'<input id="vendor" class="marginT10" type="text" placeholder="Vendor" autocomplete="off" required>'
                    +'<input id="amt" class="marginT10" type="number" step="0.01" placeholder="Amount" autocomplete="off" required>'
                    +'<select id="type" class="marginT10">'
                        +'<option disabled>Transaction Type</option>'
                        for (var i = 0; i < ALL_TYPES.length; i++) {
                            body+='<option>'+ALL_TYPES[i]+'</option>';
                        }
               body+='</select>'
                    +'<select id="cate" class="marginT10">'
                        +'<option disabled>Category</option>';
                        for (var i = 0; i < ALL_CATES.length; i++) {
                            body+='<option>'+ALL_CATES[i]+'</option>';
                        }
               body+='</select>'
                    +'<input id="desc" class="marginT10" type="text" placeholder="Description" autocomplete="off">'
                    +'<input id="tags" class="marginT10" type="text" placeholder="Tags" autocomplete="off">'
                    +'<input id="date" class="marginT10" type="date">'
                    +'<button class="default marginT10" type="submit">Submit</button>'
                +'</form>';

    $('#model_title').html('New Transaction');
    $('#model_body').html(body);
    $('#model_footer').html('');
}

function newTA() {
    console.log('Creating new transaction');
    var formData = new FormData();

    formData.append('vendor', $('#vendor').val());
    formData.append('amt', $('#amt').val());
    formData.append('type', $('#type').val());
    formData.append('cate', $('#cate').val());
    formData.append('desc', $('#desc').val());
    formData.append('tags', $('#tags').val());
    formData.append('date', $('#date').val());

    $.ajax({
        url: '/transactions/newtransaction',
        type: 'POST',
        xhr: function() {
            var mxXhr = $.ajaxSettings.xhr();
            return mxXhr;
        },
        success: function() {
            console.log('Successfully added new transaction');
        },
        error: function() {
            console.log('There was an error adding new transaction');
        },
        // Actual data
        data: formData,
        // Options to tell jQuery not to process data or worry about content-type.
        cache: false, contentType: false, processData: false
    });
    
}

</script>

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
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
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
                'rgba(25, 210, 210, 0.5)',
                'rgba(210, 25, 25, 0.5)',
                'rgba(233, 182, 29, 0.5)',
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
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                    stepSize: 10
                }
            }],
        },
    }
});

var days = {!! json_encode($sltd['days']) !!};
var da_amts = {!! json_encode($sltd['da_amts']) !!};

for (var i = 0; i < days.length; i++) {
    if(i == 0 || i % 2 == 0) {
        // days[i] = "";
        days[i] = days[i].replace(', 2017', '');
    }
    else {
        days[i] = days[i].replace(', 2017', '');
    }
}

var ctxThree = document.getElementById("da-chart").getContext('2d');
var daChart = new Chart(ctxThree, {
    type: 'line',
    data: {
        labels: days,
        datasets: [{
            data: da_amts,
            backgroundColor: [
                'rgba(25, 210, 210, 0.5)',
            ],
            borderColor: [
                'rgba(25, 210, 210, 1)',

            ],
            borderWidth: 1
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Spending Last Ten Days',
            fontSize: 20,
            fontColor: '#EEEEEE',
            padding: 10
        },
        legend: {
            display: false,
        },
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                    stepSize: 2
                }
            }],
            xAxes: [{
                ticks: {
                    display: true
                }
            }],
        },
    }
});

</script>

@endsection