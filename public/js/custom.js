$(function(){
    $('.preco').mask("#.##0,00", {reverse: true});
    $('.phone').mask('(00) 00000-0000');
    $('.cpf').mask('000.000.000-00');
    $('.cnpj').mask('00.000.000/0000-00');
})

$('.form-produtos').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        type: $(this).attr('type'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(data) {
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                text: 'Registro salvo com sucesso',
                confirmButtonColor: '#3c8dbc'
            }).then((result) => {
                window.location.href = tabelaUrl;
            });
        },
        error: function (xhr, status, error) {
            var valErrors = 0;
            $.each(xhr.responseJSON.errors, function (key, value) {
                $("." + key + "-error").html(value[0]);
                $("#" + key).parent().parent().addClass('has-error');
                valErrors++;
            });

            if (valErrors == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Erro ao salvar registro',
                    confirmButtonColor: '#3c8dbc'
                })
            }
        }
    });
});

$('#btnApagar').on('click', function() {
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
                url: delUrl,
                data: {
                    "_token": $('#token').val(),
                    id: $('#codigo').val()
                },
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Registro apagado com sucesso',
                        confirmButtonColor: '#3c8dbc'
                    }).then((result) => {
                        window.location.href = tabelaUrl;
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
});

