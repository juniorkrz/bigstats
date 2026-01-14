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