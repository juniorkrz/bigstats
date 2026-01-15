const showParticipantTime = 15; // Tempo em segundos que exibe cada participante
const dataUpdateInterval = 30;  // Tempo mínimo em segundos entre atualizações

let participantes = [];
let charts = {};
let intervalId;
let participanteIndex = 0;
let lastUpdate = 0;

/* =======================
   LOOP
======================= */
const iniciarLoop = () => {
    intervalId = setInterval(() => {
        participanteIndex++;

        if (participanteIndex >= participantes.length) {
            participanteIndex = 0;
        }

        exibirParticipante(participantes[participanteIndex]);
    }, showParticipantTime * 1000);
};

const pausarLoop = () => {
    clearInterval(intervalId);
};

/* =======================
   DADOS
======================= */
const obterParticipantes = async () => {
    try {
        const response = await $.ajax({
            url: 'app/ajax/misc.php',
            method: 'POST',
            dataType: 'json',
            data: { action: 'obterParticipantes' },
        });

        if (response.status) {
            participantes = response.data;
            lastUpdate = Date.now();
            console.log(`[ Big Stats ]: Dados atualizados em ${new Date(lastUpdate).toLocaleString()}`);
        } else {
            console.error('Erro ao obter participantes:', response.message);
        }
    } catch (error) {
        console.error('Erro na requisição AJAX:', error);
    }
};

/* =======================
   EXIBIÇÃO
======================= */
const exibirParticipante = (participante) => {
    console.log(`[ Big Stats ]: Exibindo participante ${participanteIndex + 1} de ${participantes.length}`);

    $('.participante').each(function () {
        const key = $(this).attr('data');

        switch (key) {
            case 'instagram':
                $(this).attr('href', 'https://www.instagram.com/' + participante.instagram);
                break;

            case 'verificado':
                participante.verificado ? $(this).removeClass('d-none') : $(this).addClass('d-none');
                break;

            case 'foto':
                const $img = $(this);
                $img.attr('src', 'data:image/png;base64,' + participante.foto);

                participante.eliminado
                    ? $img.addClass('eliminado')
                    : $img.removeClass('eliminado');
                break;

            case 'seguidores':
                $(this).html(participante.seguidores.toLocaleString('pt-BR'));
                break;

            case 'crescimento_mensal':
                const $icon = $(this).find('i');
                switch (participante.crescimentoTendencia) {
                    case 'up':
                        $icon.removeClass('fa-arrow-down');
                        $icon.removeClass('text-danger');
                        $icon.addClass('fa-arrow-up');
                        break;

                    case 'down':
                        $icon.removeClass('fa-arrow-up');
                        $icon.addClass('fa-arrow-down');
                        $icon.addClass('text-danger');
                        break;

                    default:
                        $icon.removeClass('fa-arrow-up');
                        $icon.removeClass('fa-arrow-down');
                        break;
                }

                const $span = $(this).find('span');
                $span.html(participante.crescimentoMensal.toLocaleString('pt-BR'));
                break;

            case 'crescimento_mensal_percentual':
                $(this).html(participante.crescimentoMensalPercentual);
                break;


            default:
                $(this).html(participante[key]);
        }
    });

    updateChart('followersChart', participante.historicoInstagram);
};

/* =======================
   GRÁFICOS
======================= */
const createChart = (chartId) => {
    const ctx = document.getElementById(chartId).getContext("2d");
    const gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(51, 88, 244,0.2)');
    gradientStroke.addColorStop(0.2, 'rgba(51, 88, 244,0.0)');
    gradientStroke.addColorStop(0, 'rgba(51, 88, 244,0)');

    return new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: "Seguidores",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#237ff7',
                borderWidth: 2,
                pointRadius: 4,
                data: []
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    ticks: {
                        callback: value => value.toLocaleString('pt-BR')
                    }
                }
            }
        }
    });
};

const updateChart = (chartId, historico) => {
    if (!charts[chartId]) charts[chartId] = createChart(chartId);

    charts[chartId].data.labels = historico.map(h => h.day);
    charts[chartId].data.datasets[0].data = historico.map(h => h.followers);
    charts[chartId].update();
};

/* =======================
   START APP
======================= */
async function startApp() {
    await obterParticipantes();

    $('#autoSwitch').on('change', function () {
        this.checked ? iniciarLoop() : pausarLoop();
    }).show();

    // Lista de participantes (avatars)
    participantes.forEach((p, i) => {
        $('.participantes .row').append(`
            <div class="participante avatar-cabecograma mx-1" data-index="${i}">
              <img class="avatar participante mx-1 ${p.eliminado ? 'eliminado' : ''}"
              src="data:image/png;base64,${p.foto}"
              data-index="${i}"
              alt="${p.nome}">
            </div>
        `);
    });

    // Clique manual
    $('.participantes').on('click', '.avatar', function () {
        participanteIndex = $(this).data('index');
        exibirParticipante(participantes[participanteIndex]);
    });

    // Botão Instagram
    $('.btn-instagram').click(function (e) {
        e.preventDefault();
        window.open($(this).attr('href'), '_blank');
    });

    // Modal
    $('.profile-header').on('click', '.profile-avatar', function () {
        const p = participantes[$(this).data('index')];

        Swal.fire({
            title: p.nome,
            text: p.detalhes,
            imageUrl: `data:image/png;base64,${p.foto}`,
            imageWidth: 150,
            imageHeight: 150,
            footer: `Seguidores: ${p.seguidores.toLocaleString('pt-BR')} | @${p.instagram}`,
            confirmButtonText: 'Fechar'
        });
    });

    exibirParticipante(participantes[participanteIndex]);

    if ($('#autoSwitch').is(':checked')) iniciarLoop();

    $('.avatar').removeClass('d-none');
    $('#loader').addClass('d-none');
    $('#stats').removeClass('d-none');

    setInterval(async () => {
        await obterParticipantes();
        if (!$('#autoSwitch').is(':checked')) {
            exibirParticipante(participantes[participanteIndex]);
        }
    }, dataUpdateInterval * 1000);
}
