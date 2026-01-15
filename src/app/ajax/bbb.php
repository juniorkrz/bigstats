<?php

use App\model\InstagramUser;
use App\model\InstagramUserHistory;
use App\model\Participante;
use App\util\Repository;

function getInstagramHistoryByQuery($instagram_id, $query) {
    $repInstagramUserHistory = new Repository(InstagramUserHistory::class);
    $repInstagramUserHistory->findByQuery($query, ['instagram_id' => $instagram_id]);
    $firstOccurrence = $repInstagramUserHistory->getFirst();

    if (!$firstOccurrence) {
        return null;
    }

    return array(
        "id" => $firstOccurrence->id,
        "instagram_id" => $firstOccurrence->instagram_id,
        "instagram" => $firstOccurrence->username,
        "nome" => $firstOccurrence->full_name,
        "seguidores" => $firstOccurrence->followers_count,
        "data" => $firstOccurrence->created_at
    );
}

function obterHistoricoUltimas24Hrs($instagram_id)
{
    $query = "
    SELECT *
    FROM instagram_user_history
    WHERE instagram_id = :instagram_id
    AND created_at >= CURDATE() - INTERVAL 1 DAY
    AND created_at < CURDATE()
    ORDER BY created_at DESC
    LIMIT 1
";


    return getInstagramHistoryByQuery($instagram_id, $query);
}

function obterHistoricoInstagramMaisAntigo($instagram_id)
{
    $query = "SELECT * FROM instagram_user_history WHERE instagram_id = :instagram_id ORDER BY created_at LIMIT 0,1";

    return getInstagramHistoryByQuery($instagram_id, $query);
}

function obterHistoricoInstagram($instagram_id)
{
    $repInstagramUserHistory = new Repository(InstagramUserHistory::class);
    $query = "
        SELECT iuh.*
        FROM instagram_user_history iuh
        INNER JOIN (
            SELECT
                DATE(created_at) AS record_date,
                MAX(created_at) AS max_created_at
            FROM instagram_user_history
            WHERE instagram_id = :instagram_id
            GROUP BY DATE(created_at)
        ) recent ON DATE(iuh.created_at) = recent.record_date
                AND iuh.created_at = recent.max_created_at
        WHERE iuh.instagram_id = :instagram_id
        AND iuh.created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY);
    ";

    // Executa a consulta com o parâmetro seguro
    $repInstagramUserHistory->findByQuery($query, ['instagram_id' => $instagram_id]);

    $history = [];

    $dayOfWeekMapping = [
        'Monday'    => 'Seg',
        'Tuesday'   => 'Ter',
        'Wednesday' => 'Qua',
        'Thursday'  => 'Qui',
        'Friday'    => 'Sex',
        'Saturday'  => 'Sab',
        'Sunday'    => 'Dom'
    ];

    foreach ($repInstagramUserHistory->objects as $item) {
        $recordDate = DateTime::createFromFormat('Y-m-d H:i:s', $item->created_at);
        $dayOfWeek = $recordDate->format('l'); // Nome do dia da semana (ex: Monday, Tuesday)

        // Mapeia o nome do dia para o nome abreviado em pt-BR
        $dayAbbreviation = $dayOfWeekMapping[$dayOfWeek];

        $history[] = [
            'day' => $dayAbbreviation, // Usa a abreviação do dia
            'followers' => $item->followers_count, // Campo contendo o número de seguidores formatado com separador de milhar
        ];
    }

    return $history;
}

function obterDadosInstagram($username)
{
    $repInstagramUser = new Repository(InstagramUser::class);
    $repInstagramUser->sample->username = $username;
    $repInstagramUser->findBySample();

    return $repInstagramUser->getFirst();
}

function processarDadosParticipante($participante, $obterHistorico = true, $obterHistoricoMaisAntigo = false, $obterUltimas24Hrs = false)
{
    $dadosInstagram = obterDadosInstagram($participante->instagram);

    if (!$dadosInstagram) {
        return null;
    }

    $dadosParticipante = array(
        "id" => $participante->id,
        "nome" => $participante->nome,
        "eliminado" => $participante->eliminado,
        "grupo" => $participante->grupo,
        "instagram" => $participante->instagram,
        "instagram_id" => $dadosInstagram->instagram_id,
        "detalhes" => $participante->detalhes,
        "seguidores" => $dadosInstagram->followers_count,
        "verificado" => $dadosInstagram->is_verified,
        "foto" => $dadosInstagram->profile_pic_base64,
    );

    if ($obterHistorico) {
        $historicoInstagram = obterHistoricoInstagram($dadosInstagram->instagram_id);
        $dadosParticipante['historicoInstagram'] = $historicoInstagram;
    }

    if ($obterHistoricoMaisAntigo) {
        $historicoInstagramMaisAntigo = obterHistoricoInstagramMaisAntigo($dadosInstagram->instagram_id);
        $dadosParticipante['historicoInstagramMaisAntigo'] = $historicoInstagramMaisAntigo;
    }

    if ($obterUltimas24Hrs) {
        $ultimas24Hrs = obterHistoricoUltimas24Hrs($dadosInstagram->instagram_id);
        $dadosParticipante['historicoUltimas24Hrs'] = $ultimas24Hrs;
    }

    if ($obterCrescimento) {

        $atual = (int) $dadosInstagram->followers_count;

        // tenta pegar dado de ~30 dias atrás
        $historicoMesPassado = obterHistoricoInstagramMesPassado($dadosInstagram->instagram_id);

        // fallback: usa o mais antigo se não existir registro de 30 dias
        if (!$historicoMesPassado && $obterHistoricoMaisAntigo) {
            $historicoMesPassado = obterHistoricoInstagramMaisAntigo($dadosInstagram->instagram_id);
        }

        if ($historicoMesPassado) {
            $antigo = (int) $historicoMesPassado['seguidores'];

            $crescimento = $atual - $antigo;

            if ($antigo > 0) {
                $percentual = ($crescimento / $antigo) * 100;
            } else {
                $percentual = 0;
            }

            // tendência
            if ($crescimento > 0) {
                $tendencia = "up";
            } elseif ($crescimento < 0) {
                $tendencia = "down";
            } else {
                $tendencia = "stable";
            }

            $dadosParticipante["crescimentoMensal"] = $crescimento;

            $sinal = $percentual > 0 ? "+" : "";
            $dadosParticipante["crescimentoMensalPercentual"] =
                $sinal . number_format($percentual, 2, ',', '.') . "%";

            $dadosParticipante["crescimentoTendencia"] = $tendencia;
        } else {
            // sem histórico suficiente
            $dadosParticipante["crescimentoMensal"] = 0;
            $dadosParticipante["crescimentoMensalPercentual"] = "0%";
            $dadosParticipante["crescimentoTendencia"] = "stable";
        }
    }


    return $dadosParticipante;
}

function obterParticipante($id)
{
    $repParticipante = new Repository(Participante::class);
    $repParticipante->sample->id = $id;
    $repParticipante->findBySample();

    $participante = $repParticipante->getFirst();

    return processarDadosParticipante($participante);
}

function obterParticipantes()
{
    $participantes = [];

    $repParticipante = new Repository(Participante::class);
    $repParticipante->findAll();

    $obterHistorico = true;
    $obterHistoricoMaisAntigo = true;
    $obterHistoricoUltimas24Hrs = false;

    foreach ($repParticipante->objects as $participante) {
        $dados = processarDadosParticipante(
            $participante,
            $obterHistorico,
            $obterHistoricoMaisAntigo,
            $obterHistoricoUltimas24Hrs
        );

        if (empty($dados)) {
            continue;
        }

        $participantes[] = $dados;
    }

    return $participantes;
}

function obterHistoricoInstagramMesPassado($instagram_id)
{
    $query = "
        SELECT *
        FROM instagram_user_history
        WHERE instagram_id = :instagram_id
          AND created_at <= DATE_SUB(NOW(), INTERVAL 30 DAY)
        ORDER BY created_at DESC
        LIMIT 1
    ";

    return getInstagramHistoryByQuery($instagram_id, $query);
}
