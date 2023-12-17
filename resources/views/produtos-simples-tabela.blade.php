@extends('adminlte::page')

@section('title', 'Produtos Simples')

@section('content_header')
    <h1>Produtos Simples</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Lista de Produtos</h3>
            </div>
            <div class="box-body">
                <table id="listagem" class="table table-bordered table-hover"> 
                    <thead>
                        <tr>
                            <th>Ações</th>
                            <th>Código</th>
                            <th>Produto</th>
                            <th>Preço Custo</th>
                            <th>Preço Venda</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
    <script>
        var csrfToken = @json(csrf_token());
        var delUrl = @json($delUrl);
        var gridUrl = @json($gridUrl);
        var novoUrl = @json($novoUrl);
        var showUrl = @json($showUrl);
        var nomeDownload = @json($nomeDownload);
    </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script src="{{ asset('js/produtos-simples-tabela.js') }}"></script>
@stop