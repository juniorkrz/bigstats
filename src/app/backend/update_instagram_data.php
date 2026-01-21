<?php

namespace App\backend;

use App\model\InstagramUser;
use App\model\InstagramUserHistory;
use App\model\Participante;
use App\util\InstagramAPI;
use App\util\Repository;
use App\util\Telegram;
use Exception;

require_once __DIR__ . "/../config.php";

/* ======================== CONFIG ======================== */

$sleepTime = isset($argv[1]) ? (int)$argv[1] : exit;

$runId   = uniqid();
$logDir = '/var/www/logs';

if (!is_dir($logDir)) {
    mkdir($logDir, 0775, true);
}

$logFile = $logDir . '/' . basename(__FILE__, '.php') . '.log';


/* ======================== LOGGER ======================== */

function logMessage(string $message, bool $sendTelegram = false): void
{
    global $runId, $logFile;

    $dateTime = date('Y-m-d H:i:s');
    $entry = "[$dateTime][$runId] $message";

    echo $entry . PHP_EOL;
    file_put_contents($logFile, $entry . PHP_EOL, FILE_APPEND | LOCK_EX);

    if ($sendTelegram) {
        Telegram::sendMessage($entry);
    }
}


/* ======================== INIT ======================== */

logMessage("Iniciando atualização de dados do Instagram, intervalo de $sleepTime segundos...", true);

$instagramApi = new InstagramAPI();

$repInstagramUser        = new Repository(InstagramUser::class);
$repInstagramUserHistory = new Repository(InstagramUserHistory::class);
$repParticipante         = new Repository(Participante::class);

/* ======================== BUSCA DE USUÁRIOS ======================== */

$limitDate = (new \DateTime('-60 minutes'))->format('Y-m-d H:i:s');

/** Usuários desatualizados */
$instagramUsers = $repInstagramUser->findByQuery(
    "SELECT * FROM instagram_user WHERE updated_at < :limitDate ORDER BY updated_at",
    ['limitDate' => $limitDate]
);

/** Participantes que ainda não existem na tabela instagram_user */
$repParticipante->findByQuery(
    "SELECT p.*
     FROM bbb_participante p
     LEFT JOIN instagram_user iu ON iu.username = p.instagram
     WHERE iu.username IS NULL
       AND p.instagram IS NOT NULL
       AND p.instagram <> ''"
);

if (!$repParticipante->isEmpty()) {
    foreach ($repParticipante->objects as $participante) {
        $user = new InstagramUser();
        $user->username = $participante->instagram;
        $instagramUsers[] = $user; // adiciona, não sobrescreve
    }
}

if (empty($instagramUsers)) {
    logMessage("Nenhum usuário para atualizar.");
    exit;
}

/* ======================== PROCESSAMENTO ======================== */

try {
    foreach ($instagramUsers as $i => $item) {

        $username = $item->username;
        $instagramUser = $instagramApi->getUserData($username);
        $apiUser = $instagramApi->getApiUser();

        logMessage("API User: {$apiUser->username} consultou $username");

        if (!$instagramUser) {
            logMessage("Falha ao obter dados de $username", true);
            sleep($sleepTime);
            continue;
        }

        /** Verifica se já existe */
        $repInstagramUser->resetSample();
        $repInstagramUser->sample->username = $username;
        $repInstagramUser->refindBySample();

        if ($repInstagramUser->isEmpty()) {
            $instagramUser->created_at = date('Y-m-d H:i:s');
            $rows = $repInstagramUser->save($instagramUser);
        } else {
            $rows = $repInstagramUser->update($instagramUser);
        }

        if ($rows > 0) {
            logMessage("Usuário $username salvo com sucesso.");
        } else {
            logMessage("Nenhuma linha afetada ao salvar $username", true);
        }

        /** Histórico */
        $history = new InstagramUserHistory();
        $history->fromInstagramUser($instagramUser);

        $rowsHistory = $repInstagramUserHistory->save($history);

        if ($rowsHistory > 0) {
            logMessage("Histórico de $username salvo.");
        } else {
            logMessage("Falha ao salvar histórico de $username", true);
        }

        $isLast = $i === array_key_last($instagramUsers);

        if (!$isLast) {
            logMessage("Aguardando $sleepTime segundos...");
            sleep($sleepTime);
        }
    }

} catch (Exception $e) {
    logMessage("Erro geral: " . $e->getMessage(), true);
    if (!empty($username)) {
        logMessage("Username: $username", true);
    }
}

logMessage("Atualização de dados do Instagram concluída.", true);
