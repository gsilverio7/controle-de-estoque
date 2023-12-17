$('.date').mask('00/00/0000 00:00:00', {placeholder: "__/__/____ __:__:__"});

function cbo(select) {
    select.select2({
        ajax: {
            url: select.attr('data-cbo'),
            dataType: 'json'
        }
    });
}
cbo($('.componente'));

var i = 0;
$('#btnAddComponente').on('click', function() {
    i++;
    var divId = "componenteRow" + i;
    $('#componenteRow .componente').select2("destroy")
    $('#componenteRow').clone().attr('id', divId).insertBefore('#addComponente');
    $('#' + divId + ' .componente').val(null).trigger('change');
    $('#' + divId + ' .qtd').val(null);
    cbo($('.componente'));

    $('#' + divId + ' .divBtnDel').removeClass('hidden');
    $('#' + divId + ' .divBtnDel .btn').on('click', function() {
        $('#' + divId).remove();
    })

    $('#' + divId + ' .tipoProduto').on('change', function(e) {
        var tipo = $(this).val();
        var row = divId;
        console.log(row);
        var select = $('#' + row + ' .componente');
        select.val(null).trigger('change').empty();
        select.select2('destroy');
        if (tipo == 's') {
            select.attr('data-cbo', "{{ route('produtos_simples.cbo') }}")
            cbo(select);
        } else {
            select.attr('data-cbo', "{{ route('produtos_compostos.cbo') }}")
            cbo(select);
        }
    });
});

$('.btnDelExistente').on('click', function(e) {
    e.preventDefault();
    var rowId = 'componenteExistenteRow' + this.id.slice(3);
    $('#' + rowId).remove();
});

$('.tipoProduto').on('change', function(e) {
    var tipo = $(this).val();
    var row = $(this).parent().parent().parent().parent().attr('id');
    console.log(row);
    var select = $('#' + row + ' .componente');
    select.val(null).trigger('change');
    select.select2('destroy');
    if (tipo == 's') {
        select.attr('data-cbo', "{{ route('produtos_simples.cbo') }}")
        cbo(select);
    } else {
        select.attr('data-cbo', "{{ route('produtos_compostos.cbo') }}")
        cbo(select);
    }
});