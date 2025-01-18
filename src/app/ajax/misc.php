<?php

require_once "../config.php";
require_once "bbb.php";

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$result = (object) array(
    "status" => false,
    "message" => "Nenhuma ação realizada."
);


$action = getVar('action');

if ($action == 'obterDuplas') {
    $duplas = obterDuplas();
    $success = !empty($duplas);

    $result->status  = $success;
    $result->message = $success ? "Duplas obtidas com sucesso." : "Nenhuma dupla encontrada.";
    $result->data    = $duplas;
}

echo json_encode($result);
