function reloadTable(){
    dt.ajax.reload();
}

$(document).ready(function() {
    var dt = $('#listagem').DataTable( {
        language: {
            url: 'dataTables.pt-BR.json'
        },
        ajax: {
            url: gridUrl ,
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
        ]
    } );

    $('.btnRefresh').attr('title', 'Atualizar');
    $('.btnCopy').attr('title', 'Copiar');
    $('.btnCsv').attr('title', 'Csv');
    $('.btnExcel').attr('title', 'Excel');
    $('.btnPdf').attr('title', 'Pdf');
    $('.btnPrint').attr('title', 'Imprimir');
});  