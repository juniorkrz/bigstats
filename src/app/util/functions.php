<?php

function getVar(string $key, string $method = null, $default = null)
{
    $dataSources = [
        'GET' => $_GET,
        'POST' => $_POST,
        'REQUEST' => $_REQUEST,
    ];

    // Se o método for especificado, use apenas ele
    if ($method !== null) {
        $method = strtoupper($method);
        if (isset($dataSources[$method]) && isset($dataSources[$method][$key])) {
            return sanitizeInput($dataSources[$method][$key]);
        }
        return $default;
    }

    // Procurar em GET, POST e REQUEST, nesta ordem
    foreach ($dataSources as $source) {
        if (isset($source[$key])) {
            return sanitizeInput($source[$key]);
        }
    }

    return $default;
}

// Função para limpar entradas contra SQL Injection
function sanitizeInput($value)
{
    if (is_array($value)) {
        // Limpar valores de arrays recursivamente
        return array_map('sanitizeInput', $value);
    }

    // Remover espaços em branco no início e no fim
    $value = trim($value);

    // Adicionar proteção básica contra SQL Injection
    $value = stripslashes($value); // Remove barras invertidas
    $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); // Escapar caracteres HTML
    $value = preg_replace('/[\x00-\x1F\x7F-\x9F]/u', '', $value); // Remover caracteres de controle

    return $value;
}

function getLastCommitHash($owner = 'juniorkrz', $repo = 'bigstats', $token = null) {
    // URL do endpoint da API do GitHub
    $url = "https://api.github.com/repos/{$owner}/{$repo}/commits?per_page=1";

    // Configuração do cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-cURL'); // Definir um User-Agent para evitar erro
    if ($token) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $token",
            "Accept: application/vnd.github.v3+json"
        ]);
    }

    // Executa a requisição e captura a resposta
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Verifica se a requisição foi bem-sucedida
    if ($httpCode === 200) {
        $data = json_decode($response, true);
        if (!empty($data) && isset($data[0]['sha'])) {
            return $data[0]['sha']; // Retorna a hash do commit
        }/*  else {
            throw new Exception("Não foi possível encontrar o commit.");
        } */
    }/*  else {
        throw new Exception("Erro na API: Código HTTP $httpCode. Resposta: $response");
    } */
}