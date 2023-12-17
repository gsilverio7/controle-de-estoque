function format(d) {
    return (
        "<button class='btn btn-info details' onclick=window.location.href='" + showUrl  + "/" + d.id + "'>Visualizar</button>" + 
        "<button class='btn btn-danger details' onclick='tableDelRegister(" + d.id + ")'>Apagar</button>"
    );
}

function reloadTable(){
    dt.ajax.reload();
}

function tableDelRegister(id) {
    Swal.fire({
        icon: 'warning',
        title: 'Deseja mesmo apagar esse registro?',
        text: 'Não será possível recuperar os dados.',
        showCancelButton: true,
        confirmButtonText: 'Apagar',
        confirmButtonColor: '#dd4b39',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken 
                },
                url: delUrl ,
                data: {
                    id: id
                },
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Registro apagado com sucesso',
                        confirmButtonColor: '#3c8dbc'
                    }).then((result) => {
                        $('#listagem').DataTable().ajax.reload();
                    });
                },
                error: function (request, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: 'Falha ao apagar registro',
                        confirmButtonColor: '#3c8dbc'
                    })
                }
            });
        }
    })
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
        order: [[2, 'asc']],
        columns: [
            {
                class: 'details-control text-center',
                orderable: false,
                data: null,
                defaultContent: '',
            },
            { data: 'id' },
            // { data: 'ativo' },
            { data: 'name' },
            { data: 'email' }
        ],
        dom: "Bfrtip",
        buttons: [
            {
                action: function () {
                    window.location.href = novoUrl 
                },
                text: '<i class="fa fa-plus"></i> Novo',
                className: 'btn btn-primary'
            }, 
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
                filename: nomeDownload ,
                exportOptions: {
                    columns: ':not(:first-child)'
                }
            }, 
            {
                extend: 'csv',
                text: '<i class="fa fa-list-alt"></i>',
                className: 'btn btn-default tableBtn btnCsv',
                filename: nomeDownload ,
                exportOptions: {
                    columns: ':not(:first-child)'
                }
            }, 
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel"></i>',
                className: 'btn btn-default tableBtn btnExcel',
                filename: nomeDownload ,
                exportOptions: {
                    columns: ':not(:first-child)'
                }
            }, 
            {
                extend: 'pdf',
                text: '<i class="fa fa-file-pdf"></i>',
                className: 'btn btn-default tableBtn btnPdf',
                filename: nomeDownload ,
                exportOptions: {
                    columns: ':not(:first-child)'
                }
            }, 
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i>',
                className: 'btn btn-default tableBtn btnPrint',
                filename: nomeDownload ,
                exportOptions: {
                    columns: ':not(:first-child)'
                }
            },
        ]
    } );

    $('.btnRefresh').attr('title', 'Atualizar');
    $('.btnCopy').attr('title', 'Copiar');
    $('.btnCsv').attr('title', 'Csv');
    $('.btnExcel').attr('title', 'Excel');
    $('.btnPdf').attr('title', 'Pdf');
    $('.btnPrint').attr('title', 'Imprimir');

    // Array to track the ids of the details displayed rows
    var detailRows = [];

    $('#listagem tbody').on('click', 'tr td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = dt.row(tr);
        var idx = detailRows.indexOf(tr.attr('id'));

        if (row.child.isShown()) {
            tr.removeClass('details');
            row.child.hide();

            // Remove from the 'open' array
            detailRows.splice(idx, 1);
        } else {
            tr.addClass('details');
            row.child(format(row.data())).show();

            // Add to the 'open' array
            if (idx === -1) {
                detailRows.push(tr.attr('id'));
            }
        }
    });

    // On each draw, loop over the `detailRows` array and show any child rows
    dt.on('draw', function () {
        detailRows.forEach(function(id, i) {
            $('#' + id + ' td.details-control').trigger('click');
        });
    });
});    