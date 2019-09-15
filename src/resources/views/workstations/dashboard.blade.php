@extends('layout')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-xs-12 col-md-8 text-center">

            <style>
            .block-info {
                width: 175px;
                height: 175px;
                margin: 10px;

                background: gray;
                color: white;

                display: inline-flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .block-info h1 {
                text-align: center;
            }

            .block-info small {
                display: block;
                font-size: 0.6em;
            }
            </style>
            
            <div class="block-info bg-danger">
                <h1>{{ $errors }}<small>Błędów</small></h1>
            </div>

            <div class="block-info bg-warning">
                <h1>{{ $warnings }}<small>Ostrzeżeń</small></h1>
            </div>

            <br>

            <div class="block-info bg-success">
                <h1>{{ $vm_success }}<small>Maszyn bez błędów</small></h1>
            </div>

            <div class="block-info bg-warning">
                <h1>{{ $vm_warning }}<small>Maszyn z ostrzeżeniami</small></h1>
            </div>

            <div class="block-info bg-danger">
                <h1>{{ $vm_danger }}<small>Maszyn z błędami</small></h1>
            </div>

        </div>
        <div class="col-xs-12 col-md-4">
            <canvas id="myChart" width="400" height="400" style="width: 100%;"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Maszyny bez błędów', 'Maszyny z ostrzeżeniami', 'Maszyny z błędami'],
        datasets: [{
            label: 'Ilość maszyn',
            data: [{{ $vm_success }}, {{ $vm_warning }}, {{ $vm_danger }}],
            backgroundColor: [
                '#28a745',
                '#ffc107',
                '#dc3545',
            ],
            // borderColor: [
            //     'rgba(255, 99, 132, 1)',
            //     'rgba(54, 162, 235, 1)',
            //     'rgba(255, 206, 86, 1)',
            // ],
            // borderWidth: 1
        }]
    },
    options: {
        // scales: {
        //     yAxes: [{
        //         ticks: {
        //             beginAtZero: true
        //         }
        //     }]
        // }
    }
});
</script>
@endsection