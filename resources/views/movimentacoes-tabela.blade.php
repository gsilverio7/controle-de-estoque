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
                                    <input data-td-target="#datetimepicker1"
                                    data-td-toggle="datetimepicker" type="text" class="form-control date" name="inicio" id="inicio" />
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
                                    <input type="text" class="form-control date" name="fim" id="fim" />
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
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script> 
        function reloadTable(){
            dt.ajax.reload();
        }

        $(document).ready(function() {
            $('.date').mask('00/00/0000 00:00:00', {placeholder: "__/__/____ __:__:__"});

            var dt = $('#listagem').DataTable( {
                language: {
                    url: 'dataTables.pt-BR.json'
                },
                ajax: {
                    url: "{{ $gridUrl }}",
                    dataSrc: "",
                    data: function(data) {
                            data.tipo = $('#tipo').val(),
                            data.inicio = $('#inicio').val(),
                            data.fim = $('#fim').val()
                    }        
                },
                order: [[0, 'asc']],
                columns: [
                    { data: 'id' },
                    {                         
                        render: function(data, type, row, meta){
                            if (row.tipo == 'c') {
                                return 'Compra';
                            }
                            return 'Venda';
                        }  
                    },
                    { data: 'produto' },
                    { data: 'quantidade' },
                    {                       
                        render: function(data, type, row, meta){
                            if (row.tipo == 'c') {
                                return $.fn.dataTable.render.number('.', ',', 2, 'R$ ').display(row.preco_custo * row.quantidade);
                            }
                            return $.fn.dataTable.render.number('.', ',', 2, 'R$ ').display(row.preco_venda * row.quantidade);
                        }                        
                    },
                    { data: 'responsavel' },
                    { data: 'data' }
                ],
                dom: "Bfrtip",
                buttons: [
                    {
                        action: function (e, dt) {
                            dt.ajax.reload();
                        },
                        text: '<span class="glyphicon glyphicon-refresh"></span>',
                        className: 'btn btn-default tableBtn btnRefresh',
                    }, 
                    {
                        extend: 'copy',
                        text: '<i class="fa fa-copy"></i>',
                        className: 'btn btn-default tableBtn btnCopy',            
                        filename: "{{ $nomeDownload }}"
                    }, 
                    {
                        extend: 'csv',
                        text: '<i class="fa fa-list-alt"></i>',
                        className: 'btn btn-default tableBtn btnCsv',
                        filename: "{{ $nomeDownload }}"
                    }, 
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel"></i>',
                        className: 'btn btn-default tableBtn btnExcel',
                        filename: "{{ $nomeDownload }}"
                    }, 
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf"></i>',
                        className: 'btn btn-default tableBtn btnPdf',
                        filename: "{{ $nomeDownload }}"
                    }, 
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-default tableBtn btnPrint',
                        filename: "{{ $nomeDownload }}"
                    },
                ]
            } );

            $('.btnRefresh').attr('title', 'Atualizar');
            $('.btnCopy').attr('title', 'Copiar');
            $('.btnCsv').attr('title', 'Csv');
            $('.btnExcel').attr('title', 'Excel');
            $('.btnPdf').attr('title', 'Pdf');
            $('.btnPrint').attr('title', 'Imprimir');

            $('.form-control').on('change', function (){
                $('.btnRefresh').click();
            })
        });    
    </script>
@stop