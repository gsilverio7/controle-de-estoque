@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div style="width: 500px; height: 700px;">
        <h4 class="text-center">Controle de Caixa</h4>
        <canvas id="myChart"></canvas>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> 
        const ctx = document.getElementById('myChart');
        const data = {
            labels: ['jan','fev','mar','abr','mai','jun'],
            datasets: [
                {
                    label: 'Dataset 1',
                    data: [100,200,-30,401,575,686],
                    backgroundColor: ['#00a65a','#00a65a','#f56954','#00a65a','#00a65a','#00a65a'],
                }
            ]
        };

        window.myObjBar = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Bar Chart'
                    }
                },
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                    label: function(tooltipItem) {
                            return tooltipItem.yLabel;
                        }
                    }
                }
            },
        }); 
    </script>
@stop