@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div style="width: 500px; height: 700px;">
        <h4 class="text-center">Controle de Caixa 2023</h4>
        <canvas id="myChart"></canvas>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> 
        var graficoUrl = @json($graficoUrl);
        var valoresIniciais = [0,0,0,0,0,0,0,0,0,0,0,0,0];
        var coresIniciais = ['#00a65a','#00a65a','#f56954','#00a65a','#00a65a',
            '#00a65a','#00a65a','#00a65a','#00a65a','#00a65a','#00a65a','#00a65a'];
        
        function gerarGraficos(valores, cores){
            const ctx = document.getElementById('myChart');
            const dados = {
                labels: ['jan','fev','mar','abr','mai','jun','jul','ago','set','out','nov','dez'],
                datasets: [
                    {
                        label: 'Dataset 1',
                        data: valores,
                        backgroundColor: cores,
                    }
                ]
            };
            window.myObjBar = new Chart(ctx, {
                type: 'bar',
                data: dados,
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
        }

        gerarGraficos(valoresIniciais, coresIniciais);

        $.ajax({
            type: 'GET',
            url: graficoUrl,
            data: {
                ano: 2023
            },
            success: function(data) {
                gerarGraficos(data.valores, data.cores);
            }
        });

    </script>
@stop