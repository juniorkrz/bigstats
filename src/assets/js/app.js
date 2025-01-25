const showDuoTime = 15;// Tempo em segundos que exibe cada dupla
const dataUpdateInterval = 30;// Tempo mínimo em segundos entre atualizações dos dadoss

let duplas = [];
let charts = {};
let intervalId;
let duplaIndex = 0;
var lastUpdate = 0;

// Inicia o loop que exibe as duplas
const iniciarLoop = () => {
    intervalId = setInterval(() => {
        if (duplaIndex >= duplas.length) {
            duplaIndex = 0
            obterDuplas();
        }
        exibirDupla(duplas[duplaIndex]);
    }, showDuoTime * 1000);
}

// Pausa o loop
const pausarLoop = () => {
    clearInterval(intervalId);
}

// Obtém as duplas do servidor
const obterDuplas = async () => {
    // Previne atualização em um intervalo curto
    const now = Date.now();
    if (now - lastUpdate < dataUpdateInterval * 1000) {
        return;
    }

    try {
        const response = await $.ajax({
            url: 'app/ajax/misc.php',
            method: 'POST',
            dataType: 'json',
            data: { action: 'obterDuplas' },
        });

        if (response.status) {
            duplas = response.data;
            lastUpdate = Date.now();
            console.log(`[ Big Stats ]: Dados atualizados em ${new Date(lastUpdate).toLocaleString()}`);
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
const KeyAction = {
    INSTAGRAM: 'instagram',
    VERIFICADO: 'verificado',
    FOTO: 'foto',
    SEGUIDORES: 'seguidores',
};

const exibirParticipante = (participante, index) => {
    $(`.${index}`).each(function () {
        const key = $(this).attr('data');

        switch (key) {
            case KeyAction.INSTAGRAM:
                $(this).attr('href', 'https://www.instagram.com/' + participante[key]);
                break;

            case KeyAction.VERIFICADO:
                if (participante[key]) {
                    $(this).removeClass('d-none');
                } else {
                    $(this).addClass('d-none');
                }
                break;

            case KeyAction.FOTO:
                const $img = $(this);
                $img.fadeOut(300, function () {
                    $img.attr('src', "data:image/png;base64," + participante[key]);
                    $img.fadeIn(300);
                });

                if (participante.eliminado) {
                    $(this).addClass('eliminado');
                } else {
                    $(this).removeClass('eliminado');
                }
                break;

            case KeyAction.SEGUIDORES:
                $(this).html(participante[key].toLocaleString('pt-BR'));
                break;

            default:
                $(this).html(participante[key]);
                break;
        }
    });
};


async function startApp() {
    await obterDuplas();

    // Switch para pausar a exibição de duplas automática
    $('#autoSwitch').on('change', function () {
        if (this.checked) {
            iniciarLoop();
        } else {
            pausarLoop();
        }
    })

    // Cria os botões das duplas
    duplas.forEach((dupla, i) => {
        $('.participantes .row').append(`
            <div class="duo mx-1" data-duo-index="${i}">
                <img class="${dupla.participanteB.eliminado ? 'eliminado ' : ''}mr-1" src="data:image/png;base64,${dupla.participanteA.foto}" alt="Participante A">
                <img class="${dupla.participanteB.eliminado ? 'eliminado' : ''}" src="data:image/png;base64,${dupla.participanteB.foto}" alt="Participante B">
            </div>
        `);
    });

    // Evento de clique em .duo para pausar o loop e exibir a dupla
    $('.duo').click(function (e) {
        if ($('#autoSwitch').is(':checked')) {
            e.preventDefault();
            pausarLoop();
            duplaIndex = $(this).data('duo-index');
            exibirDupla(duplas[duplaIndex]);
            iniciarLoop();
        } else {
            duplaIndex = $(this).data('duo-index');
            exibirDupla(duplas[duplaIndex]);
        }
    });

    $('.btn-instagram').click(function (e) {
        e.preventDefault();
        window.open($(this).attr('href'), '_blank');
    });

    // Modal com informações de um participante
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

    // Inicia o loop se a opção de autoSwitch estiver marcada
    if ($('#autoSwitch').is(':checked')) {
        iniciarLoop();
    }

    $('.avatar').removeClass('d-none');
    $('.spinner').addClass('animate__animated animate__fadeOut');
    $('#loader').removeClass('d-flex').addClass('d-none');
    $('#stats').removeClass('d-none');
}
