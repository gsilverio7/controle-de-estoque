@extends('adminlte::page')

@section('title', 'Movimentações')

@section('content_header')
    <h1>Movimentações</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Lista de Movimentações</h3>
            </div>
            <form id="frmFiltros" class="form">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="nome">Tipo</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-cog"></i>
                                    </span>
                                    <select class="form-control" name="tipo" id="tipo">
                                        <option value="t">Todos</option>
                                        <option value="c">Compra</option>
                                        <option value="v">Venda</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="nome">Inicio</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="datetime-local" class="form-control" name="inicio" id="inicio" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="nome">Fim</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="datetime-local" class="form-control" name="fim" id="fim" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="box-body">
                <table id="listagem" class="table table-bordered table-hover"> 
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Tipo</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor total</th>
                            <th>Responsável</th>
                            <th>Data</th>
                        </tr>
                        <tfoot align="right">
                            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
                        </tfoot>
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
        var gridUrl = @json($gridUrl);
        var nomeDownload = @json($nomeDownload);
    </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="{{ asset('js/movimentacoes-tabela.js') }}"></script>
@stop