function loadAddress() {
    if (endereco != '') {
        $.ajax({
            url: 'https://maps.googleapis.com/maps/api/geocode/json?address=' 
                + endereco + '&key=' + apiKey,
        }).done(function(data) {
            var coordenada = data.results[0].geometry.location;
            initMap(coordenada);
        });
    } else {
        $('#map').hide();
    }
};

// Initialize and add the map
function initMap(coordenada) {
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 16,
        center: coordenada,
    });
    const marker = new google.maps.Marker({
        position: coordenada,
        map: map,
    });
}

$('.tipoPessoa').on('change', function(e) {
    if ($('.tipoPessoa').val() == 'f') {
        $('.cpf').parent().parent().parent().removeClass('hide');
        $('.cnpj').parent().parent().parent().addClass('hide');
        $('.cpf').prop('required', true);
        $('.cnpj').prop('required', false);
        $('.cnpj').val(null);
    } else {
        $('.cpf').parent().parent().parent().addClass('hide');
        $('.cnpj').parent().parent().parent().removeClass('hide');
        $('.cpf').prop('required', false);
        $('.cnpj').prop('required', true);
        $('.cpf').val(null);
    }
});