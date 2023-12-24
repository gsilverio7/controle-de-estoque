function cbo(select) {
    select.select2({
        ajax: {
            url: produtoSimplesCbo,
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
});

$('.btnDelExistente').on('click', function(e) {
    e.preventDefault();
    var rowId = 'componenteExistenteRow' + this.id.slice(3);
    $('#' + rowId).remove();
});