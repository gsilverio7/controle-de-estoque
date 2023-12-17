var valoresIniciais = [0,0,0,0,0,0,0,0,0,0,0,0,0];
var coresIniciais = ['#00a65a','#00a65a','#f56954','#00a65a','#00a65a',
    '#00a65a','#00a65a','#00a65a','#00a65a','#00a65a','#00a65a','#00a65a'];

function gerarGraficos(valores, cores){
    const ctx = document.getElementById('myChart');
    const dados = {
        labels: ['jan','fev','mar','abr','mai','jun','jul','ago','set','out','nov','dez'],
        datasets: [
            {
                label: 'Dataset 1',
                data: valores,
                backgroundColor: cores,
            }
        ]
    };
    window.myObjBar = new Chart(ctx, {
        type: 'bar',
        data: dados,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Bar Chart'
                }
            },
            legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                label: function(tooltipItem) {
                        return tooltipItem.yLabel;
                    }
                }
            }
        },
    }); 
}

gerarGraficos(valoresIniciais, coresIniciais);
buscarDados();

function buscarDados() {
    $.ajax({
        type: 'GET',
        url: graficoUrl,
        data: {
            ano: $('#ano').val()
        },
        success: function(data) {
            gerarGraficos(data.valores, data.cores);
        }
    });
} 