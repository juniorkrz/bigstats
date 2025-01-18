var duplas = [];
var charts = {}; // Referências para os gráficos

const obterDuplas = async () => {
    try {
        const response = await $.ajax({
            url: 'app/ajax/misc.php',
            method: 'POST',
            dataType: 'json',
            data: { action: 'obterDuplas' },
        });

        if (response.status) {
            duplas = response.data;
        } else {
            console.error('Erro ao obter as duplas:', response.message || 'Resposta inesperada.');
        }
    } catch (error) {
        console.error('Erro na requisição AJAX:', error);
    }
};

const exibirDupla = (dupla) => {
    exibirParticipante(dupla.participanteA, "participanteA");
    exibirParticipante(dupla.participanteB, "participanteB");
    exibirParticipante(dupla, "dupla");

    // Atualizar gráficos de cada participante
    updateChart("chartParticipanteA", dupla.participanteA.historicoInstagram);
    updateChart("chartParticipanteB", dupla.participanteB.historicoInstagram);
    updateChart("chartDupla", dupla.historicoInstagram);
};

const createChart = (chartId) => {
    const ctx = document.getElementById(chartId).getContext("2d");
    const gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(51, 88, 244,0.2)');
    gradientStroke.addColorStop(0.2, 'rgba(51, 88, 244,0.0)');
    gradientStroke.addColorStop(0, 'rgba(51, 88, 244,0)');

    return new Chart(ctx, {
        type: 'line',
        data: {
            labels: [], // Inicialmente vazio
            datasets: [{
                label: "Seguidores",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#237ff7',
                borderWidth: 2,
                pointBackgroundColor: '#237ff7',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#237ff7',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: [] // Inicialmente vazio
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: { display: false },
            tooltips: {
                backgroundColor: '#f5f5f5',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest",
                callbacks: {
                    label: function(tooltipItem, data) {
                        const value = tooltipItem.yLabel;
                        return value.toLocaleString('pt-BR'); // Formatação do número no tooltip
                    }
                }
            },
            responsive: true,
            scales: {
                yAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(29,140,248,0.0)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#9a9a9a",
                        callback: function(value) {
                            return value.toLocaleString('pt-BR'); // Formatação do número no eixo Y
                        }
                    }
                }],
                xAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(225,78,202,0.1)',
                        zeroLineColor: "transparent",
                    },
                    ticks: { 
                        padding: 20, 
                        fontColor: "#9a9a9a" 
                    }
                }]
            }
        }
    });
};

const updateChart = (chartId, historicoInstagram) => {
    const labels = historicoInstagram.map(entry => entry.day); // Presumindo que os dias já estão formatados no backend
    const dataPoints = historicoInstagram.map(entry => entry.followers); // Manter os valores numéricos para o gráfico

    if (!charts[chartId]) {
        charts[chartId] = createChart(chartId);
    }

    const chart = charts[chartId];
    chart.data.labels = labels;
    chart.data.datasets[0].data = dataPoints;
    chart.update(); // Atualizar o gráfico
};

const exibirParticipante = (participante, index) => {
    $(`.${index}`).each(function () {
        const key = $(this).attr('data');

        if (key === 'instagram') {
            $(this).attr('href', 'https://www.instagram.com/' + participante[key]);
        } else if (key === 'foto') {
            // Adicionar o efeito ao alterar o src da foto
            const $img = $(this);
            $img.fadeOut(300, function () { // Reduz a opacidade a 0 em 300ms
                $img.attr('src', "data:image/png;base64," + participante[key]); // Altera o src
                $img.fadeIn(300); // Restaura a opacidade a 1 em 300ms
            });
        } else if (key === 'seguidores') {
            // Formatar seguidores com separador de milhar
            $(this).html(participante[key].toLocaleString('pt-BR'));
        } else {
            $(this).html(participante[key]);
        }
    });
};


async function startApp() {
    $('.btn-instagram').click(function (e) {
        e.preventDefault();
        window.open($(this).attr('href'), '_blank');
    });

    //console.log('Página carregada');
    await obterDuplas();
    //console.log('Duplas carregadas:', duplas);

    // Exibir uma dupla a cada 5 segundos
    let duplaIndex = 0;
    exibirDupla(duplas[duplaIndex]);
    duplaIndex++;

    $('.avatar').removeClass('d-none');
    $('.spinner').addClass('animate__animated animate__fadeOut')
    $('#loader').removeClass('d-flex').addClass('d-none'); // Esconde o loader

    $('#stats')
      .removeClass('d-none') // Remove d-none para torná-lo visível

    setInterval(() => {
        exibirDupla(duplas[duplaIndex]);
        duplaIndex = (duplaIndex + 1) % duplas.length;
    }, 15000);
}
