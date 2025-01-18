<?php

namespace App\util;

class Telegram
{

    public function __construct() {}

    public static function sendMessage($message)
    {
        $botToken = $_ENV['TELEGRAM_BOT_TOKEN'];
        $chatId = $_ENV['TELEGRAM_CHAT_ID'];
        // URL da API do Telegram
        $url = "https://api.telegram.org/bot$botToken/sendMessage";

        // Dados a serem enviados via POST
        $data = [
            'chat_id' => $chatId,
            'text' => $message
        ];

        // Inicializa o cURL
        $ch = curl_init();

        // Configura a requisição cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        // Executa a requisição e obtém a resposta
        $response = curl_exec($ch);

        // Verifica se houve erro na requisição
        if (curl_errno($ch)) {
            echo 'Erro cURL: ' . curl_error($ch);
        }

        // Fecha a conexão cURL
        curl_close($ch);

        // Retorna a resposta da API do Telegram (opcional, para debugar)
        return $response;
    }
}
