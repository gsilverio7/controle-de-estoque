@extends('adminlte::page')

@section('title', 'Estoque')

@section('content_header')
    <h1>Estoque</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Itens em estoque</h3>
            </div>
            <div class="box-body">
                <table id="listagem" class="table table-bordered table-hover"> 
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
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
            var dt = $('#listagem').DataTable( {
                language: {
                    url: 'dataTables.pt-BR.json'
                },
                ajax: {
                    url: "{{ $gridUrl }}",
                    dataSrc: ""
                },
                order: [[0, 'asc']],
                columns: [
                    { data: 'produto' },
                    { data: 'nome' },
                    { data: 'quantidade' }
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
        });    
    </script>
@stop