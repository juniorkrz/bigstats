let duplas = [];
let charts = {};
const loopTime = 15000;
let intervalId;
let duplaIndex = 0;

// Inicia o loop que exibe as duplas
const iniciarLoop = () => {
    intervalId = setInterval(() => {
        if (duplaIndex >= duplas.length) duplaIndex = 0;
        exibirDupla(duplas[duplaIndex]);
    }, loopTime);
}

// Pausa o loop
const pausarLoop = () => {
    clearInterval(intervalId);
}

// Obtém as duplas do servidor
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

    // Remove a classe .active de todas as duplas
    $('.duo').removeClass('active');

    // Adiciona a classe .active à dupla atual
    const duoElement = $(`.duo[data-duo-index="${duplaIndex}"]`);
    duoElement.addClass('active');

    exibirParticipante(dupla.participanteA, "participanteA");
    exibirParticipante(dupla.participanteB, "participanteB");
    exibirParticipante(dupla, "dupla");

    // Atualiza gráficos
    updateChart("chartParticipanteA", dupla.participanteA.historicoInstagram);
    updateChart("chartParticipanteB", dupla.participanteB.historicoInstagram);
    updateChart("chartDupla", dupla.historicoInstagram);

    duplaIndex++;
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

    if (!charts[chartId]) charts[chartId] = createChart(chartId);

    const chart = charts[chartId];
    chart.data.labels = labels;
    chart.data.datasets[0].data = dataPoints;
    chart.update(); // Atualizar o gráfico
};

// Exibe informações de um participante
const exibirParticipante = (participante, index) => {
    $(`.${index}`).each(function () {
        const key = $(this).attr('data');

        if (key === 'instagram') {
            $(this).attr('href', 'https://www.instagram.com/' + participante[key]);
        } else if (key === 'verificado') {
            if (participante[key]) {
                $(this).removeClass('d-none');
            } else {
                $(this).addClass('d-none');
            }
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
    await obterDuplas();

    duplas.forEach((dupla, i) => {
        $('.participantes .row').append(`
            <div class="duo mx-1" data-duo-index="${i}">
                <img class="mr-1" src="data:image/png;base64,${dupla.participanteA.foto}" alt="Participante A">
                <img class="" src="data:image/png;base64,${dupla.participanteB.foto}" alt="Participante B">
            </div>
        `);
    });

    // Evento de clique em .duo para pausar o loop
    $('.duo').click(function (e) {
        e.preventDefault();
        pausarLoop();
        duplaIndex = $(this).data('duo-index');
        exibirDupla(duplas[duplaIndex]);
        iniciarLoop();
    });

    $('.btn-instagram').click(function (e) {
        e.preventDefault();
        window.open($(this).attr('href'), '_blank');
    });

    $('.avatar').click(function () {
        const dupla = duplas[duplaIndex - 1];
        const participante = $(this).hasClass('participanteA') ? dupla.participanteA : dupla.participanteB;
        const badge = participante.verificado ? ' <img src="./assets/img/verificado.webp" class="verified-badge-modal" alt="Verificado">' : '';

            Swal.fire({
                title: `${participante.nome}${badge}`,
                text: participante.detalhes,
                imageUrl: `data:image/png;base64,${participante.foto}`,
                imageWidth: 150,
                imageHeight: 150,
                imageAlt: participante.nome,
                footer: `${participante.grupo} | Seguidores: ${participante.seguidores.toLocaleString('pt-BR')} | @${participante.instagram}`,
                confirmButtonText: 'Fechar',
                customClass: {
                    image: 'rounded-image'  // Adiciona uma classe personalizada à imagem
                }
            });
    });

    // Inicializa a exibição inicial e inicia o loop
    exibirDupla(duplas[duplaIndex]);
    iniciarLoop();

    $('.avatar').removeClass('d-none');
    $('.spinner').addClass('animate__animated animate__fadeOut');
    $('#loader').removeClass('d-flex').addClass('d-none');
    $('#stats').removeClass('d-none');
}
