<?php

namespace App\backend;

use App\model\InstagramUser;
use App\model\InstagramUserHistory;
use App\util\InstagramAPI;
use App\util\Repository;
use App\util\Telegram;
use Exception;

// Verificar se o valor do sleep foi passado como argumento
if (isset($argv[1])) {
    $sleepTime = (int)$argv[1];  // Converter para inteiro
} else {
    exit;
}

require_once __DIR__ . "/../config.php";

// Definir o nome do arquivo de log como o nome do script atual
$runId = uniqid();
$logFile = basename(__FILE__, '.php') . '.log';

// Função para registrar mensagens no log com data e hora
function logMessage($message, $sendTelegram = false)
{
    global $logFile;
    global $runId;

    // Obter data e hora atuais
    $dateTime = date('Y-m-d H:i:s');  // Formato: Ano-Mês-Dia Hora:Minuto:Segundo

    // Criar a mensagem com a data, hora e o conteúdo
    $logEntry = "[$dateTime][$runId] $message";
    echo $logEntry . PHP_EOL;

    // Abrir o arquivo de log em modo de escrita
    $file = fopen($logFile, 'a');
    if ($file) {
        fwrite($file, $logEntry . PHP_EOL);
        fclose($file);
    } else {
        echo "Não foi possível abrir o arquivo de log.";
    }

    if ($sendTelegram) {
        Telegram::sendMessage($logEntry);
    }
}

logMessage("Iniciando atualização de dados do Instagram, intervalo de $sleepTime segundos...", true);

$instagramApi = new InstagramAPI();
$repInstagramUser = new Repository(InstagramUser::class);
$repInstagramUserHistory = new Repository(InstagramUserHistory::class);

// Buscar participantes que não atualizam a mais de 30 minutos
$now = date('Y-m-d H:i:s');
$thirtyMinutesAgo = date('Y-m-d H:i:s', strtotime('-30 minutes', strtotime($now)));
$instagramUsers = $repInstagramUser->findByQuery(
    "SELECT * FROM instagram_user WHERE updated_at < :thirtyMinutesAgo ORDER BY updated_at;",
    ['thirtyMinutesAgo' => $thirtyMinutesAgo]
);


try {
    foreach ($instagramUsers as $instagramUser /* @var $instagramUser InstagramUser */) {
        $username = $instagramUser->username;
        $instagramUser = $instagramApi->getUserData($username);

        if (!$instagramUser) {
            logMessage("Não foi possível obter os dados do usuário do Instagram.", true);
            continue;
        }

        $repInstagramUser->resetSample();
        $repInstagramUser->sample->username = $username;
        $repInstagramUser->refindBySample();

        if ($repInstagramUser->isEmpty()) {
            $saveResult = $repInstagramUser->save($instagramUser);
        } else {
            $saveResult = $repInstagramUser->update($instagramUser);
        }

        if ($saveResult > 0) {
            logMessage("Dados do usuário $username salvos com sucesso!");
        } else {
            logMessage("Erro ao salvar os dados do usuário $username. Nenhuma linha foi afetada.", true);
        }

        $history = new InstagramUserHistory();
        $history->fromInstagramUser($instagramUser);
        $saveHistory = $repInstagramUserHistory->save($history);

        if ($saveHistory > 0) {
            logMessage("Histórico do usuário $username salvos com sucesso!");
        } else {
            logMessage("Erro ao salvar o histórico do usuário $username. Nenhuma linha foi afetada.", true);
        }

        // Aguardar o tempo de sleep definido, se necessário
        logMessage("Aguardando $sleepTime segundos...");
        sleep($sleepTime);
    }
} catch (Exception $e) {
    logMessage("Erro ao atualizar os dados do Instagram: " . $e->getMessage(), true);
    logMessage("Username: " . $username, true);
}

logMessage("Atualização de dados do Instagram concluida.", true);
