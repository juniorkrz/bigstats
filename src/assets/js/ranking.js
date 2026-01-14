var participantes = [];
var lastUpdate = 0;

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
            console.error('Erro ao obter as duplas:', response.message || 'Resposta inesperada.');
        }
    } catch (error) {
        console.error('Erro na requisição AJAX:', error);
    }
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

                if ($('#autoSwitch').is(':checked')) {
                    $img.fadeOut(300, function () {
                        $img.attr('src', "data:image/png;base64," + participante[key]);
                        $img.fadeIn(300);
                    });
                } else {
                    $img.attr('src', "data:image/png;base64," + participante[key]);
                }

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
    // Carregar os participantes pela primeira vez
    await obterParticipantes();

    const table = $('#participantsTable').DataTable({
        paging: false,
        searching: false,
        info: false,
        data: participantes,
        order: [
            [8, 'desc'] // Ordenação inicial baseada na coluna de seguidores
        ],
        columns: [
            // Coluna de índice fixado
            {
                title: '#', // Título da coluna
                data: null, // Não vem de dados específicos
                orderable: false, // Desabilita ordenação dessa coluna
                className: 'dt-center', // Centraliza o texto
                render: function (data, type, row, meta) {
                    return meta.row + 1; // Retorna o índice (1, 2, 3...)
                }
            },
            { data: 'id', visible: false },
            {
                data: 'nome',
                title: 'Participante',
                render: function (data, type, row) {
                    return `<img style="width: 25px;" class="${row.eliminado ? 'eliminado ' : ''}mr-1 rounded-image cursor-pointer mini-avatar" src="data:image/png;base64,${row.foto}" alt="Participante ${row.id}" data-participante-id="${row.id}">${row.nome}${row.verificado ? ' <img src="./assets/img/verificado.webp" style="width: 15px" class="">' : ''}`;
                }
            },
            { data: 'eliminado', visible: false },
            { data: 'grupo', visible: false },
            { data: 'instagram', visible: false },
            { data: 'instagram_id', visible: false },
            { data: 'detalhes', visible: false },
            {
                data: 'seguidores',
                title: 'Seguidores',
                className: 'text-info',
                render: $.fn.dataTable.render.number('.', '.', 0)
            },
            {
                data: 'ganhos',
                title: 'Ganhos',
                render: function (data, type, row) {
                    const diff = row.seguidores - row.historicoInstagramMaisAntigo.seguidores;
                    const color = diff > 0 ? 'success' : 'danger';

                    return ` <small class="text-${color}">` + (diff >= 0 ? '+' : '-') + (diff).toLocaleString('pt-BR') + '</small>';
                }
            },
            { data: 'verificado', visible: false },
            { data: 'foto', visible: false },
            { data: 'historicoInstagramMaisAntigo', visible: false }
        ]
    });

    // Ajusta os índices após ordenação ou atualização da tabela
    table.on('order.dt', function () {
        // Remove a classe 'text-info' de todas as colunas visíveis no cabeçalho
        $('#participantsTable thead th').removeClass('text-info');

        // Obtém as informações de ordenação e mapeia para as colunas visíveis
        const order = table.order(); // Obtém o índice e a direção da ordenação
        const visibleColumns = table.columns(':visible').indexes(); // Índices das colunas visíveis

        // Verifica qual coluna visível corresponde à ordenação
        const columnIndex = order[0][0]; // Índice da coluna na tabela
        const visibleIndex = visibleColumns.indexOf(columnIndex); // Mapeia para índice visível

        // Adiciona a classe 'text-info' ao cabeçalho da coluna ordenada (se estiver visível)
        if (visibleIndex !== -1) {
            $('#participantsTable thead th')
                .eq(visibleIndex)
                .addClass('text-info');
        }
    }).draw();

    // Ajusta os índices após ordenação ou atualização da tabela
    table.on('order.dt search.dt', function () {
        table
            .column(0, { order: 'applied' }) // Coluna de índice
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1; // Atualiza os índices
            });
    }).draw();

    // Modal com informações de um participante
    $('.mini-avatar').click(function () {
        const participanteId = $(this).data('participante-id');
        // find the participant object based on its id
        const participante = participantes.find(participante => participante.id === participanteId);
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

    // Esconde o spinner e exibe as duplas quando o carregamento terminar
    $('.spinner').addClass('animate__animated animate__fadeOut');
    $('#loader').removeClass('d-flex').addClass('d-none');
    $('#stats').removeClass('d-none');
}
