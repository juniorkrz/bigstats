<?php

require_once "../config.php";
require_once "bbb.php";

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$result = (object) [
    "status"  => false,
    "message" => "Nenhuma ação realizada.",
    "data"    => []
];

$action = getVar('action');

switch ($action) {

    case 'obterParticipantes':
        $participantes = obterParticipantes();
        $success = !empty($participantes);

        $result->status  = $success;
        $result->message = $success
            ? "Participantes obtidos com sucesso."
            : "Nenhum participante encontrado.";
        $result->data = $participantes;
        break;

    default:
        $result->message = "Ação inválida.";
        break;
}

echo json_encode($result);
