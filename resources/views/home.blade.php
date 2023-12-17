@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div style="width: 500px; height: 700px;">
        <h4 class="text-center">Controle de Caixa 
            <input type="number" min="1900" max="2099" step="1" id="ano" value="2023"/>
            <button onclick="buscarDados()">ok</button>
        </h4>
        <canvas id="myChart"></canvas>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
    <script> 
        var graficoUrl = @json($graficoUrl);
    </script>
    <script src="{{ asset('js/home.js') }}"></script>
@stop