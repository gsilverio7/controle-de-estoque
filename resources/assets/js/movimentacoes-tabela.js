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
            url: gridUrl ,
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
                data: 'preco'                 
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
                filename: nomeDownload 
            }, 
            {
                extend: 'csv',
                text: '<i class="fa fa-list-alt"></i>',
                className: 'btn btn-default tableBtn btnCsv',
                filename: nomeDownload 
            }, 
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel"></i>',
                className: 'btn btn-default tableBtn btnExcel',
                filename: nomeDownload 
            }, 
            {
                extend: 'pdf',
                text: '<i class="fa fa-file-pdf"></i>',
                className: 'btn btn-default tableBtn btnPdf',
                filename: nomeDownload 
            }, 
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i>',
                className: 'btn btn-default tableBtn btnPrint',
                filename: nomeDownload 
            },
        ],                                            
        rowCallback: function () {
            var api = this.api();

            // convertendo strings para números
            var intVal = function ( i ) {
                if (typeof i === 'string') {
                    //
                    return i.replace(/\D/g,'') * 0.01;
                    //
                } else if (typeof i === 'number') {
                    return i;
                }
                return 0;
            };
            
            // somando valores das colunas
            var qtdTotal = api
                    .column( 3 )
                    .data()
                    .reduce( function (acumulado, atual) {
                        return intVal(acumulado) + intVal(atual);
                    }, 0 );
            
            var capitalTotal = api
                    .column( 4 )
                    .data()
                    .reduce( function (acumulado, atual) {
                        return intVal(acumulado) + intVal(atual);
                    }, 0 );

            // Mostrando valores nos rodapés 
            $( api.column( 0 ).footer() ).html('Total');
            $( api.column( 3 ).footer() ).html(qtdTotal);
            $( api.column( 4 ).footer() ).html('R$ ' + capitalTotal.toLocaleString('pt-br', {minimumFractionDigits: 2}));
        }
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